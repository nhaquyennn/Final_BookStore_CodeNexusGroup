<?php
include_once '../database/db_connect.php';
session_start();  // Khởi tạo session

// Lấy dữ liệu từ biểu mẫu
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

// Kiểm tra nếu rỗng
if (empty($email) || empty($password)) {
    $_SESSION['error'] = "Vui lòng điền đầy đủ thông tin đăng nhập.";
    header("Location: ../user/login.php");
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

    $hashedPassword = md5($password);  // Chỉ mã hóa mật khẩu nhập vào bằng MD5

    // So sánh mật khẩu đã mã hóa với mật khẩu trong cơ sở dữ liệu
    if ($hashedPassword === $user['matkhau']) {
        // Kiểm tra vai trò là admin
        if ($user['vaitro'] === 'admin') {
            // Đăng nhập thành công, lưu session và chuyển hướng
            $_SESSION['user'] = $user['email'];  // Lưu email vào session
            $_SESSION['maTK'] = $user['maTK'];  // Lưu maTK vào session
            header("Location: ../index.php");
            exit();
        } else {
            // Vai trò không phải admin
            $_SESSION['error'] = "Bạn không có quyền truy cập.";
            header("Location: ../user/login.php");
            exit();
        }
    } else {
        // Mật khẩu không đúng
        $_SESSION['error'] = "Mật khẩu không đúng.";
        header("Location: ../user/login.php");
        exit();
    }
} else {
    // Tài khoản không tồn tại
    $_SESSION['error'] = "Tài khoản không tồn tại.";
    header("Location: ../user/login.php");
    exit();
}
