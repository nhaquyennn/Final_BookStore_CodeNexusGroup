<?php
session_start();
require_once "../database/db_connect.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Truy vấn để kiểm tra email
    $sql = "SELECT * FROM taikhoan WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row["matkhau"]; // Lấy mật khẩu mã hóa từ CSDL

        // Kiểm tra mật khẩu
        if (password_verify($password, $hashed_password)) {
            // Lưu thông tin vào session
            $_SESSION["email"] = $email;
            $_SESSION["maNguoiDung"] = $row["maNguoiDung"];
            header("Location: thong_tin_ca_nhan.php");
            exit();
        } else {
            echo "Email hoặc mật khẩu không đúng!";
        }
    } else {
        echo "Email hoặc mật khẩu không đúng!";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
</head>
<body>
    <h1>Đăng nhập</h1>
    <form action="login.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="matkhau">Mật khẩu:</label>
        <input type="password" id="matkhau" name="matkhau" required><br><br>

        <button type="submit">Đăng nhập</button>
    </form>
</body>
</html>
