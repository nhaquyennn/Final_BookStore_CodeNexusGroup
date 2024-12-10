<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "layout/header.php"; ?>
    <?php require_once "db_connect.php"; ?>
</head>

<body class="bg-theme bg-theme2">
    <div class="clearfix"></div>
    <div class="content-wrapper">
        <div class="container-fluid">
            <div id="wrapper">
                <?php require_once "layout/left_sidebar.php"; ?>
                <header class="topbar-nav">
                    <?php require_once "layout/topbar.php"; ?>
                </header>

                <div class="container">
                    <h3 class="text-center mt-4 mb-4">TRẢ SÁCH</h3>

                    <!-- Form nhập số điện thoại -->
                    <form action="" method="POST">
                        <div class="mb-3 d-flex">
                            <input type="text" class="form-control" id="customerPhone" name="customerPhone" placeholder="Nhập số điện thoại khách hàng" required>
                            <button type="submit" id="search_button" class="btn btn-warning ml-2">Tìm</button>
                        </div>
                    </form>

                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['customerPhone'])) {
                        $customerPhone = $_POST['customerPhone'];

                        // Truy vấn để lấy thông tin phiếu mượn
                        $query = "SELECT pm.MaPhieuMuon, pm.NgayMuon, pm.NgayTra, pm.TongTien, nd.tenNguoiDung 
                                    FROM phieumuon pm 
                                    JOIN nguoidung nd ON pm.SoDienThoai = nd.SoDienThoai 
                                    WHERE pm.SoDienThoai = ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("s", $customerPhone);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            echo '<h4 class="text-center mt-5">THÔNG TIN PHIẾU MƯỢN</h4>';
                            echo '<form method="POST" action="">';
                            echo '<table class="table table-bordered mt-3">';
                            echo '<thead><tr><th>MÃ PHIẾU MƯỢN</th><th>TÊN KHÁCH HÀNG</th><th>NGÀY MƯỢN</th><th>NGÀY TRẢ</th><th>TỔNG TIỀN</th><th>CHỌN</th></tr></thead>';
                            echo '<tbody>';

                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>' . $row['MaPhieuMuon'] . '</td>';
                                echo '<td>' . $row['tenNguoiDung'] . '</td>';
                                echo '<td>' . $row['NgayMuon'] . '</td>';
                                echo '<td>' . $row['NgayTra'] . '</td>';
                                echo '<td>' . $row['TongTien'] . '</td>';
                                echo '<td><input type="radio" name="maPhieuMuon" value="' . $row['MaPhieuMuon'] . '" required></td>';
                                echo '</tr>';
                            }

                            echo '</tbody></table>';
                            echo '<button type="submit" class="btn btn-primary mt-3">Xử Lý</button>';
                            echo '</form>';
                        } else {
                            echo '<div class="alert alert-danger mt-3">Không tìm thấy phiếu mượn cho số điện thoại này.</div>';
                        }

                        $stmt->close();
                    }
                    // Xử lý trả sách
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['maPhieuMuon'])) {
                        $maPhieuMuon = $_POST['maPhieuMuon'];

                        // Lấy thông tin phiếu mượn cụ thể
                        $query = "SELECT NgayTra, TongTien FROM phieumuon WHERE MaPhieuMuon = ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("i", $maPhieuMuon);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();

                        $ngayTra = $row['NgayTra'];
                        $tongTien = $row['TongTien'];
                        $ngayHienTai = date('Y-m-d');
                        $phiPhat = 0; // Khởi tạo phí phạt mặc định

                        // Kiểm tra ngày trả
                        if (strtotime($ngayTra) < strtotime($ngayHienTai)) {
                            // Tính phí phạt
                            $soNgayTre = (strtotime($ngayHienTai) - strtotime($ngayTra)) / (60 * 60 * 24);
                            $phiPhat = $soNgayTre * 5000;
                            $tinhTrang = "Trả muộn";
                            $thongBao = "Khách trả muộn! Phí phạt là: " . number_format($phiPhat, 0, ',', '.') . " VNĐ";
                        } else {
                            $tinhTrang = "Đã trả";
                            $thongBao = "Khách trả đúng hạn. Không có phí phạt.";
                        }

                        // Cập nhật trạng thái và tổng tiền
                        $updateQuery = "UPDATE phieumuon SET tinhTrang = ? WHERE MaPhieuMuon = ?";
                        $updateStmt = $conn->prepare($updateQuery);
                        $updateStmt->bind_param("si", $tinhTrang, $maPhieuMuon);
                        $updateStmt->execute();
                        $updateStmt->close();

                        // Hiển thị thông báo phí phạt hoặc trạng thái
                        echo '<div class="alert alert-info mt-3">' . $thongBao . '</div>';
                        echo '<div class="mt-3">';
                        echo '<a href="dsphieumuon.php" class="btn btn-secondary">Quay lại</a>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>