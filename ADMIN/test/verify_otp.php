<?php
// verify_otp.php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enteredOtp = $_POST['otp'] ?? '';
    $error = '';

    // Kiểm tra nếu OTP đúng
    if (empty($enteredOtp)) {
        $error = "Vui lòng nhập mã OTP.";
    } elseif ($enteredOtp == $_SESSION['otp']) {
        // OTP chính xác, cho phép thay đổi mật khẩu
        header("Location: reset_password.php");
        exit();
    } else {
        $error = "Mã OTP không đúng.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận OTP</title>
</head>
<body>
    <h2>Xác nhận OTP</h2>
    <form method="post">
        <label for="otp">Mã OTP:</label>
        <input type="text" name="otp" id="otp" required>
        <button type="submit">Xác nhận</button>
    </form>
    <?php if (!empty($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
</body>
</html>
