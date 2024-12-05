<?php
include_once '../database/db_connect.php';
session_start();

$error = '';

// Kiểm tra yêu cầu Ajax để kiểm tra email
if (isset($_POST['check_email'])) {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';

    // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu chưa
    $sqlCheckEmail = "SELECT * FROM taikhoan WHERE email = ? UNION SELECT * FROM nguoidung WHERE email = ?";
    $stmt = $conn->prepare($sqlCheckEmail);
    $stmt->bind_param('ss', $email, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Email này đã có người sử dụng. Vui lòng nhập email khác.";
    } else {
        echo "Email có thể sử dụng.";
    }
    exit();  // Dừng lại để không xử lý tiếp nếu là yêu cầu Ajax
}

// Xử lý dữ liệu đăng ký
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['check_email'])) {
    $fullName = isset($_POST['fullName']) ? trim($_POST['fullName']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $confirmPassword = isset($_POST['confirmPassword']) ? trim($_POST['confirmPassword']) : '';
    $role = 'khachhang'; // Mặc định là user

    // Kiểm tra các trường không được để trống
    if (empty($fullName) || empty($email) || empty($password) || empty($confirmPassword)) {
        header("Location: ../user/signUp.php?error=Vui lòng điền đầy đủ thông tin.");
        exit();
    } else {
        // Kiểm tra mật khẩu và mật khẩu xác nhận có trùng khớp
        if ($password !== $confirmPassword) {
            header("Location: ../user/signUp.php?error=Mật khẩu và mật khẩu xác nhận không trùng khớp.");
            exit();
        } else {
            // Mã hóa mật khẩu
            $hashedPassword = md5($password);

            // Thêm người dùng vào bảng `ngoidung`
            $sqlNguoiDung = "INSERT INTO nguoidung (tenNguoiDung, email) 
                             VALUES ('$fullName', '$email')";
            if ($conn->query($sqlNguoiDung) === TRUE) {
                $maNguoiDung = $conn->insert_id;

                // Thêm tài khoản vào bảng `taikhoan`
                $sqlTaiKhoan = "INSERT INTO taikhoan (email, matkhau, maNguoiDung, vaiTro) 
                                VALUES ('$email', '$hashedPassword', $maNguoiDung, '$role')";
                if ($conn->query($sqlTaiKhoan) === TRUE) {
                    // Thêm thông tin vào bảng `khachhang`
                    $sqlKhachHang = "INSERT INTO khachhang (maNguoiDung, tenKH) 
                                        VALUES ('$maNguoiDung', '$fullName')";
                    if ($conn->query($sqlKhachHang) === TRUE) {
                        // Thêm thông báo đăng ký thành công và quay lại trang đăng nhập
                        echo "<script>
                                alert('Đăng ký thành công!'); 
                                window.location.href = '../user/login.php'; 
                                </script>";
                        exit();
                    } else {
                        header("Location: ../user/signUp.php?error=Lỗi khi thêm khách hàng.");
                        exit();
                    }
                } else {
                    header("Location: ../user/signUp.php?error=Lỗi khi thêm tài khoản.");
                    exit();
                }
            } else {
                header("Location: ../user/signUp.php?error=Lỗi khi thêm người dùng.");
                exit();
            }
        }
    }
}
?>