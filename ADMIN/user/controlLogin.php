<?php
include_once '../database/db_connect.php';  // Kết nối cơ sở dữ liệu

// Lấy dữ liệu từ biểu mẫu
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Kiểm tra nếu rỗng
if (empty($email) || empty($password)) {
    header("Location: login.php?error=Vui lòng nhập email và mật khẩu.");
    exit();
}

// Truy vấn cơ sở dữ liệu để lấy thông tin người dùng
$sql = "SELECT * FROM taikhoan WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $email);  // Liên kết tham số
$stmt->execute();
$result = $stmt->get_result();

// Kiểm tra xem tài khoản có tồn tại không
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Mã hóa mật khẩu người dùng nhập vào với MD5
    $hashedPassword = md5($password);  // Chỉ mã hóa mật khẩu nhập vào bằng MD5

    // So sánh mật khẩu đã mã hóa với mật khẩu trong cơ sở dữ liệu
    if ($hashedPassword === $user['matkhau']) {
        // Đăng nhập thành công, chuyển hướng đến trang chủ
        session_start();
        $_SESSION['user'] = $user['email'];  // Lưu email vào session
        header("Location: ../index.php");
        exit();
    } else {
        // Mật khẩu không đúng
        header("Location: login.php?error=Mật khẩu không đúng.");
        exit();
    }
} else {
    // Tài khoản không tồn tại
    header("Location: login.php?error=Tài khoản không tồn tại.");
    exit();
}
?>
