<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "layout/header.php" ?>
</head>

<body class="bg-theme bg-theme2">
    <div class="clearfix"></div>
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Start wrapper-->
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

                <!-- CODE Ở ĐÂY -->
                <div class="container">
                    <h3 class="text-center mt-5">MẪU TẠO THÀNH VIÊN</h3>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="customerName" class="text-white">Tên khách hàng</label>
                            <input type="text" class="form-control" id="customerName" name="customerName" placeholder="Nhập tên khách hàng" required>
                        </div>
                        <div class="mb-3">
                            <label for="customerPhone" class="text-white">Số điện thoại</label>
                            <input type="text" class="form-control" id="customerPhone" name="customerPhone" placeholder="Nhập số điện thoại" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email khách hàng" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ khách hàng" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu (ít nhất 8 ký tự)" required>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Tạo</button>
                            <a href="javascript:history.back()" class="btn btn-secondary">Quay lại</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $tenNguoiDung = isset($_POST['customerName']) ? $_POST['customerName'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $SDT = isset($_POST['customerPhone']) ? $_POST['customerPhone'] : null;
    $diachi = isset($_POST['address']) ? $_POST['address'] : null;
    $matkhau = isset($_POST['password']) ? $_POST['password'] : null;

    // Kiểm tra các trường bắt buộc
    if (!$tenNguoiDung || !$email || !$SDT || !$matkhau || !$diachi) {
        die("Lỗi: Vui lòng nhập đầy đủ thông tin.");
    }

    // Băm mật khẩu bằng MD5
    $hashedPassword = md5($matkhau);

    // 1. Thêm thông tin vào bảng nguoidung
    $sqlNguoiDung = "INSERT INTO nguoidung (tenNguoiDung, email, SDT, diachi) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sqlNguoiDung);
    $stmt->bind_param("ssss", $tenNguoiDung, $email, $SDT, $diachi);

    if ($stmt->execute()) {
        // Lấy maNguoiDung tự động tạo sau khi insert vào nguoidung
        $maNguoiDung = $stmt->insert_id;

        // 2. Thêm thông tin vào bảng taikhoan
        $sqlTaiKhoan = "INSERT INTO taikhoan (maNguoiDung, email, matkhau, vaitro) VALUES (?, ?, ?, 'khachhang')";
        $stmtTaiKhoan = $conn->prepare($sqlTaiKhoan);
        $stmtTaiKhoan->bind_param("iss", $maNguoiDung, $email, $hashedPassword); // Dùng mật khẩu đã băm

        if ($stmtTaiKhoan->execute()) {
            // 3. Thêm thông tin vào bảng khachhang
            $sqlKhachHang = "INSERT INTO khachhang (maNguoiDung, tenKH, diachi) VALUES (?, ?, ?)";
            $stmtKhachHang = $conn->prepare($sqlKhachHang);
            $stmtKhachHang->bind_param("iss", $maNguoiDung, $tenNguoiDung, $diachi);

            if ($stmtKhachHang->execute()) {
                echo "<script>
                     alert('Thành viên đã được tạo thành công!');
                    window.location.href = 'quanlyKH.php';
                </script>";
                exit();
            } else {
                echo "Lỗi khi thêm thông tin vào bảng khachhang: " . $conn->error;
            }
        } else {
            echo "Lỗi khi thêm tài khoản: " . $conn->error;
        }
    } else {
        echo "Lỗi khi thêm người dùng: " . $conn->error;
    }

    // Đóng kết nối
    $stmt->close();
    $conn->close();
}
?>