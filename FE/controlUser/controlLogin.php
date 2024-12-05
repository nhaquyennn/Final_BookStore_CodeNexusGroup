<?php
include_once '../database/db_connect.php';
session_start();

// Lấy dữ liệu từ biểu mẫu
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Kiểm tra nếu rỗng
if (empty($email) || empty($password)) {
    header("Location: ../user/login.php?error=Vui lòng nhập email và mật khẩu.");
    exit();
}

// Truy vấn cơ sở dữ liệu để lấy thông tin người dùng
$sql = "SELECT * FROM taikhoan WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

// Kiểm tra xem tài khoản có tồn tại không
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Mã hóa mật khẩu người dùng nhập vào với MD5
    $hashedPassword = md5($password);

    // So sánh mật khẩu đã mã hóa với mật khẩu trong cơ sở dữ liệu
    if ($hashedPassword === $user['matkhau']) {
        // Kiểm tra vai trò là khách hàng
        if ($user['vaitro'] === 'khachhang') {
            // Lấy thông tin từ bảng khách hàng
            $sql_khachhang = "SELECT tenKH FROM khachhang WHERE maNguoiDung = ?";
            $stmt_khachhang = $conn->prepare($sql_khachhang);
            $stmt_khachhang->bind_param('i', $user['maNguoiDung']);
            $stmt_khachhang->execute();
            $result_khachhang = $stmt_khachhang->get_result();

            if ($result_khachhang->num_rows > 0) {
                $khachhang = $result_khachhang->fetch_assoc();

                // Lưu thông tin vào session
                $_SESSION['user'] = $user['email'];
                $_SESSION['maTK'] = $user['maTK'];
                $_SESSION['tenKH'] = $khachhang['tenKH']; // Lưu tên khách hàng
            }
            header("Location: ../index.php");
            exit();
        } else {
            header("Location: ../user/login.php?error=Bạn không có quyền truy cập.");
            exit();
        }
    } else {
        // Mật khẩu không đúng
        header("Location: ../user/login.php?error=Mật khẩu không đúng.");
        exit();
    }
} else {
    // Tài khoản không tồn tại
    header("Location: ../user/login.php?error=Tài khoản không tồn tại.");
    exit();
}
