<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPassword = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    $error = '';

    // Kiểm tra mật khẩu và xác nhận mật khẩu có trùng nhau không
    if (empty($newPassword) || empty($confirmPassword)) {
        $error = "Vui lòng nhập đầy đủ mật khẩu.";
    } elseif ($newPassword !== $confirmPassword) {
        $error = "Mật khẩu xác nhận không trùng khớp.";
    } else {
        // Mã hóa mật khẩu và cập nhật vào cơ sở dữ liệu
        require '../database/db_connect.php'; // Kết nối cơ sở dữ liệu
        $hashedPassword = md5($newPassword); // Mã hóa mật khẩu

        // Cập nhật mật khẩu vào cơ sở dữ liệu
        $sql = "UPDATE taikhoan SET matkhau = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $hashedPassword, $_SESSION['email']);
        $stmt->execute();

        // Đăng nhập và chuyển hướng về trang đăng nhập
        session_destroy();
        header("Location: ../user/login.php?success=Mật khẩu đã được thay đổi.");
        exit();
    }
}
?>