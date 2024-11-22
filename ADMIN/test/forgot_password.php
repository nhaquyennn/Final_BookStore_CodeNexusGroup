<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
</head>

<body>
    <h2>Quên mật khẩu</h2>
    <?php
    // Hiển thị lỗi nếu có
    if (isset($_GET['error'])) {
        echo "<p style='color: red;'>" . htmlspecialchars($_GET['error']) . "</p>";
    }
    ?>
    <form action="forgot_password_process.php" method="post">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <button type="submit">Gửi OTP</button>
    </form>
</body>

</html>