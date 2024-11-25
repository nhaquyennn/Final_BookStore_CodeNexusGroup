<?php
session_start();
include_once '../database/db_connect.php';

// Kiểm tra người dùng đã đăng nhập chưa
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['user'];

// Xử lý khi người dùng nhấn nút "Lưu thay đổi"
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newName = $_POST['tenNguoiDung'] ?? '';
    $newEmail = $_POST['email'] ?? '';

    if (empty($newName) || empty($newEmail)) {
        $error = "Vui lòng điền đầy đủ thông tin.";
    } else {
        // Cập nhật thông tin trong cơ sở dữ liệu
        $updateSql = "UPDATE nguoidung 
                      INNER JOIN taikhoan ON nguoidung.maNguoiDung = taikhoan.maNguoiDung 
                      SET nguoidung.tenNguoiDung = ?, taikhoan.email = ? 
                      WHERE taikhoan.email = ?";
        $stmt = $conn->prepare($updateSql);
        $stmt->bind_param('sss', $newName, $newEmail, $email);

        if ($stmt->execute()) {
            $_SESSION['user'] = $newEmail;  // Cập nhật email trong session
            echo "<script>
                    alert('Thay đổi thành công!');
                    window.location.href = 'profile.php';
                  </script>";
            exit();
        } else {
            $error = "Lỗi khi cập nhật thông tin.";
        }
    }
}

// Truy vấn thông tin hiện tại để điền vào biểu mẫu
$sql = "SELECT nguoidung.tenNguoiDung, taikhoan.email 
        FROM nguoidung 
        INNER JOIN taikhoan ON nguoidung.maNguoiDung = taikhoan.maNguoiDung 
        WHERE taikhoan.email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
} else {
    die("Không tìm thấy thông tin người dùng.");
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật thông tin</title>
</head>
<body>
    <h1>Cập nhật thông tin cá nhân</h1>
    <?php if (!empty($error)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <form method="POST" action="update_user_info.php">
        <label for="tenNguoiDung">Họ tên:</label>
        <input type="text" id="tenNguoiDung" name="tenNguoiDung" value="<?php echo htmlspecialchars($user['tenNguoiDung']); ?>" required><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>
        
        <button type="submit">Lưu thay đổi</button>
    </form>

    <a href="profile.php">Quay lại</a>
</body>
</html>
