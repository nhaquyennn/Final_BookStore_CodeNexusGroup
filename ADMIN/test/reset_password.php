<?php
// reset_password.php
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
        header("Location: login.php?success=Mật khẩu đã được thay đổi.");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt lại mật khẩu</title>
</head>
<body>
    <h2>Đặt lại mật khẩu</h2>
    <form method="post">
        <label for="new_password">Mật khẩu mới:</label>
        <input type="password" name="new_password" id="new_password" required>
        <br>
        <label for="confirm_password">Xác nhận mật khẩu mới:</label>
        <input type="password" name="confirm_password" id="confirm_password" required>
        <br>
        <button type="submit">Lưu mật khẩu mới</button>
    </form>
    <?php if (!empty($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
</body>
</html>
