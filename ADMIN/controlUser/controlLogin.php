<?php


include_once '../database/db_connect.php';

// Lấy kết nối từ hàm getDbConnection()
$conn = getDbConnection();

session_start();

// Xử lý dữ liệu đăng nhập
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    header("Location: ../user/login.php?error=Vui lòng nhập email và mật khẩu.");
    exit();
}

$sql = "SELECT * FROM taikhoan WHERE email = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Chuẩn bị truy vấn thất bại: " . $conn->error);
}

$stmt->bind_param('s', $email);
if (!$stmt->execute()) {
    die("Thực thi truy vấn thất bại: " . $stmt->error);
}

$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $hashedPassword = md5($password);

    if ($hashedPassword === $user['matkhau']) {
        if ($user['vaitro'] === 'admin') {
            $_SESSION['user'] = $user['email'];
            $_SESSION['maTK'] = $user['maTK'];
            header("Location: ../index.php");
            exit();
        } else {
            header("Location: ../user/login.php?error=Bạn không có quyền truy cập.");
            exit();
        }
    } else {
        header("Location: ../user/login.php?error=Mật khẩu không đúng.");
        exit();
    }
} else {
    header("Location: ../user/login.php?error=Tài khoản không tồn tại.");
    exit();
}

// Đóng kết nối cơ sở dữ liệu
closeDbConnection($conn);
