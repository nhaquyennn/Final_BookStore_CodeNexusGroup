<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    // Kết nối database
    require_once "db_connect.php";
    require_once "layout/header.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            // Lấy dữ liệu từ form
            $maKH = $_POST['maKH'];
            $TongTien = $_POST['TongTien'];
            $ngayTao = date('Y-m-d H:i:s'); // Lấy thời gian hiện tại
            $tinhTrang = "Đang mượn";

            // Chuyển danh sách ấn phẩm từ JSON sang mảng PHP
            $selectedItems = isset($_POST['selectedItems']) ? json_decode($_POST['selectedItems'], true) : [];

            // Kiểm tra dữ liệu cơ bản
            if (empty($maKH) || empty($TongTien) || empty($selectedItems)) {
                throw new Exception("Không đủ dữ liệu để tạo phiếu mượn!");
            }

            // Bắt đầu transaction
            $db->beginTransaction();

            // 1. Lưu vào bảng `phieumuon`
            $sqlPhieuMuon = "INSERT INTO phieumuon (ngayTao, TongTien, maKH, tinhTrang) VALUES (:ngayTao, :TongTien, :maKH, :tinhTrang)";
            $stmtPhieuMuon = $db->prepare($sqlPhieuMuon);
            $stmtPhieuMuon->execute([
                ':ngayTao' => $ngayTao,
                ':TongTien' => $TongTien,
                ':maKH' => $maKH,
                ':tinhTrang' => $tinhTrang
            ]);

            // Lấy `MaPhieuMuon` vừa tạo
            $maPhieuMuon = $db->lastInsertId();

            // 2. Lưu vào bảng `chitietphieumuon`
            $sqlChiTietPhieuMuon = "INSERT INTO chitietpm (MaPhieuMuon, maAnPham, SoLuong, DonGia) VALUES (:MaPhieuMuon, :maAnPham, :SoLuong, :DonGia)";
            $stmtChiTietPhieuMuon = $db->prepare($sqlChiTietPhieuMuon);

            foreach ($selectedItems as $item) {
                $stmtChiTietPhieuMuon->execute([
                    ':MaPhieuMuon' => $maPhieuMuon,
                    ':maAnPham' => $item['maAnPham'],
                    ':SoLuong' => $item['soLuong'],
                    ':DonGia' => $item['giaThue']
                ]);
            }

            // Commit transaction
            $db->commit();

            // Chuyển hướng hoặc hiển thị thông báo thành công
            // header("Location: success.php?message=Tạo phiếu mượn thành công!");
            // exit();
            echo "<script>
                     alert('Tạo phiếu mượn thành công!');
                    window.location.href = 'dsphieumuon.php';
            </script>";
        } catch (Exception $e) {
            // Rollback nếu có lỗi
            $db->rollBack();
            die("Lỗi: " . $e->getMessage());
        }
    }
    ?>
</head>

<body class="bg-theme bg-theme2">
    <div class="clearfix"></div>
    <div class="content-wrapper">
        <div class="container-fluid">
            <!--Start wrapper-->
            <div id="wrapper">

                <!--Start sidebar-wrapper-->
                <?php require_once "layout/left_sidebar.php" ?>
                <!--End sidebar-wrapper-->

                <!--Start topbar header-->
                <header class="topbar-nav">
                    <?php require_once "layout/topbar.php" ?>
                </header>
                <!--End topbar header-->

                <!--Start main content-->
                <div class="container">
                    <h3 class="text-center mt-3 mb-3">TẠO PHIẾU MƯỢN</h3>
                    <form id="form-create-phieumuon" method="POST" action="">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="phone">Số điện thoại</label>
                                <input type="tel" id="SoDienThoai" name="SoDienThoai" class="form-control" placeholder="Nhập số điện thoại" required>
                            </div>
                            <div class="col-md-6">
                                <label for="customerName">Mã khách hàng</label>
                                <input type="text" id="maKH" name="maKH" class="form-control" placeholder="Nhập mã khách hàng" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="ngaymuon">Ngày mượn</label>
                                <input type="datetime-local" class="form-control" id="ngaymuon" name="ngaymuon">
                            </div>
                            <div class="col-md-6">
                                <label for="ngaytra">Ngày trả</label>
                                <input type="datetime-local" class="form-control" id="ngaytra" name="ngaytra">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="search_anpham">Tìm ấn phẩm</label>
                            <div class="d-flex">
                                <input type="text" id="search_anpham" class="form-control" placeholder="Nhập tên ấn phẩm">
                                <button type="button" id="search-button" class="btn btn-warning ml-2">Tìm</button>
                            </div>
                        </div>

                        <div id="anpham-list" class="mb-3"></div>

                        <div class="mb-3">
                            <h5 class="text-white">Danh sách ấn phẩm được chọn</h5>
                            <table class="table table-light table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã ấn phẩm</th>
                                        <th>Tên ấn phẩm</th>
                                        <th>Giá thuê</th>
                                        <th>Số lượng</th>
                                        <th>Tổng tiền</th>
                                    </tr>
                                </thead>
                                <tbody id="selected-anpham"></tbody>
                                <input type="hidden" name="selectedItems" id="selected-items-hidden">
                            </table>
                        </div>

                        <div class="mb-3 ">
                            <label>Tổng tiền:</label>
                            <span id="TongTien" class="text-warning">0</span>
                            <input type="hidden" name="TongTien" id="TongTien-hidden">
                        </div>

                        <div class="justify-content-between">
                            <a href="javascript:history.back()" class="btn btn-secondary">Quay lại</a>
                            <button type="submit" class="btn btn-primary">Tạo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Tìm kiếm ấn phẩm
        document.getElementById("search-button").addEventListener("click", function(event) {
            event.preventDefault(); // Ngăn hành động mặc định
            const query = document.getElementById("search_anpham").value.trim();

            if (query === "") {
                alert("Vui lòng nhập tên ấn phẩm để tìm kiếm!");
                return;
            }

            fetch(`search_anpham.php?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    const listContainer = document.getElementById("anpham-list");
                    listContainer.innerHTML = ""; // Xóa danh sách cũ

                    if (data.length === 0) {
                        listContainer.innerHTML = "<p class='text-white'>Không tìm thấy ấn phẩm phù hợp.</p>";
                    } else {
                        let htmlContent = `<table class="table table-light table-striped">
                        <thead>
                            <tr>
                                <th>Mã ấn phẩm</th>
                                <th>Tên ấn phẩm</th>
                                <th>Giá thuê</th>
                                <th>Tình trạng</th>
                                <th>Thêm</th>
                            </tr>
                        </thead>
                        <tbody>`;

                        data.forEach(item => {
                            htmlContent += `
                            <tr>
                                <td>${item.maAnPham}</td>
                                <td>${item.TenAnPham}</td>
                                <td>${item.giaThue} ₫</td>                                
                                <td>${item.tinhTrang}</td>
                                <td>
                                    <button class="btn btn-success btn-sm" type="button" onclick="addToSelected('${item.maAnPham}', '${item.TenAnPham}', ${item.giaThue})">Thêm</button>
                                </td>
                            </tr>`;
                        });

                        htmlContent += `</tbody></table>`;
                        listContainer.innerHTML = htmlContent;
                    }
                })
                .catch(error => {
                    console.error("Error fetching data:", error);
                    alert("Đã xảy ra lỗi khi tìm kiếm ấn phẩm!");
                });
        });


        //Hiển thị danh sách ấn phẩm được chọn
        function addToSelected(maAnPham, TenAnPham, giaThue) {
            const selectedList = document.getElementById("selected-anpham");
            let exists = false;

            selectedList.querySelectorAll("tr").forEach(row => {
                const currentMaAnPham = row.children[1].textContent.trim();
                if (currentMaAnPham === maAnPham) {
                    exists = true;
                    const qtyInput = row.querySelector("input");
                    qtyInput.value = parseInt(qtyInput.value) + 1;
                    updateTotal();
                }
            });


            if (!exists) {
                const newRow = document.createElement("tr");
                newRow.innerHTML = `
                    <td>${selectedList.children.length + 1}</td>
                    <td>${maAnPham}</td>
                    <td>${TenAnPham}</td>
                    <td>${giaThue} ₫</td>
                    <td><input type="number" class="form-control" value="1" min="1" onchange="updateTotal(this, ${giaThue})"></td>
                    <td>${giaThue}</td>
                    <td><button class="btn btn-danger btn-sm" type="button" onclick="removeItem(this)">Xóa</button></td>
                `;
                selectedList.appendChild(newRow);
            }

            updateTotal();
        }

        // Cập nhật tổng tiền
        function updateTotal() {
            let total = 0;

            // Lặp qua tất cả các dòng trong danh sách ấn phẩm
            document.querySelectorAll("#selected-anpham tr").forEach(row => {
                const qty = parseInt(row.querySelector("input").value) || 0; // Lấy số lượng
                const price = parseFloat(row.children[3].textContent.replace(/[^0-9.-]+/g, "")) || 0; // Lấy giá thuê (bỏ ký tự không phải số)
                const rowTotal = qty * price; // Tính tổng cho dòng

                row.children[5].textContent = rowTotal.toLocaleString('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                }); // Định dạng tiền tệ
                total += rowTotal; // Cộng tổng cho tất cả các dòng
            });

            // Hiển thị tổng tiền ở dưới cùng
            document.getElementById("TongTien").textContent = total.toLocaleString('vi-VN', {
                style: 'currency',
                currency: 'VND'
            });
            document.getElementById("TongTien-hidden").value = total.toFixed(2); // Lưu tổng tiền vào input hidden
        }


        // Xóa ấn phẩm không muốn khỏi danh sách
        function removeItem(button) {
            const row = button.parentNode.parentNode; // Dòng hiện tại
            row.remove(); // Xóa dòng
            updateTotal(); // Cập nhật tổng tiền sau khi xóa
        }

        // Cập nhật danh sách các mục được chọn khi gửi form
        function updateSelectedItems() {
            const rows = document.querySelectorAll("#selected-anpham tr");
            const items = Array.from(rows).map(row => {
                return {
                    maAnPham: row.children[1].textContent.trim(),
                    TenAnPham: row.children[2].textContent.trim(),
                    giaThue: parseFloat(row.children[3].textContent.trim()),
                    soLuong: parseInt(row.querySelector("input").value)
                };
            });
            document.getElementById("selected-items-hidden").value = JSON.stringify(items);
        }

        // Gắn sự kiện submit form
        document.getElementById("form-create-phieumuon").addEventListener("submit", function() {
            updateSelectedItems();
        });
    </script>
</body>

</html>