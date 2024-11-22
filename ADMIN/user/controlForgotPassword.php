<?php
session_start();
require '../database/db_connect.php';  // Kết nối cơ sở dữ liệu
require 'PHPMailer-6.9.2/src/Exception.php';
require 'PHPMailer-6.9.2/src/PHPMailer.php';
require 'PHPMailer-6.9.2/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$email = $_POST['email'] ?? '';

if (empty($email)) {
    header("Location: forgot_password.php?error=Vui lòng nhập email.");
    exit();
}

// Kiểm tra xem email có tồn tại trong cơ sở dữ liệu không
$sql = "SELECT * FROM taikhoan WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Tạo OTP ngẫu nhiên
    $otp = rand(100000, 999999);  // OTP 6 chữ số

    // Lưu OTP vào session
    $_SESSION['otp'] = $otp;
    $_SESSION['email'] = $email;

    // Gửi OTP qua email

    $mail = new PHPMailer;
    $mail->isSMTP();  // Sử dụng giao thức SMTP
    $mail->Host = 'smtp.gmail.com';  // Cấu hình SMTP server (ví dụ: Gmail)
    $mail->SMTPAuth = true;
    $mail->Username = 'nhaquyenvo2003@gmail.com';  // Thay bằng email của bạn
    $mail->Password = 'twzk oifq bshn tfbx'; 
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('nhaquyenvo2003@gmail.com', 'Hệ thống');
    $mail->addAddress($email);
    $mail->Subject = 'Mã OTP để khôi phục mật khẩu';
    $mail->Body = "Mã OTP của bạn là: $otp";
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    if ($mail->send()) {
        header("Location: verifyOTP.php");
        exit();
    } else {
        header("Location: emailResetPassword.php?error=Gửi OTP thất bại. Vui lòng thử lại.");
        exit();
    }
} else {
    header("Location: emailResetPassword.php?error=Tài khoản không tồn tại.");
    exit();
}
?>

