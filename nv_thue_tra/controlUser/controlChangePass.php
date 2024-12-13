<?php
session_start();
require_once '../db_connect.php';

// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['user'])) {
    header("Location: ../user/login.php");
    exit();
}

$email = $_SESSION['user']; // Lấy email từ session
$user = null;

// Truy vấn thông tin người dùng
$sql = "SELECT nguoidung.tenNguoiDung, nguoidung.diaChi, nhanvien.chucVu, nhanvien.maNhanVien, taikhoan.email, taikhoan.matkhau 
        FROM nguoidung 
        INNER JOIN nhanvien ON nguoidung.maNguoiDung = nhanvien.maNguoiDung 
        INNER JOIN taikhoan ON nguoidung.maNguoiDung = taikhoan.maNguoiDung 
        WHERE taikhoan.email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc(); 
    $_SESSION['userData'] = $user; 
} else {
    die("Không tìm thấy thông tin người dùng.");
}

// Xử lý đổi mật khẩu
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old_password = $_POST['old_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    $old_password_hashed = md5($old_password); // Mã hóa mật khẩu cũ
    if ($old_password_hashed !== $user['matkhau']) {
        $error = "Mật khẩu cũ không chính xác.";
    } elseif ($new_password !== $confirm_password) {
        $error = "Mật khẩu mới và xác nhận mật khẩu không khớp.";
    } else {
        $new_password_hashed = md5($new_password); // Mã hóa mật khẩu mới
        $updatePasswordSql = "UPDATE taikhoan SET matkhau = ? WHERE email = ?";
        $stmt = $conn->prepare($updatePasswordSql);
        $stmt->bind_param('ss', $new_password_hashed, $email);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Đổi mật khẩu thành công!');
                    window.location.href = '../profile.php';
                </script>";
            exit();
        } else {
            $error = "Đã xảy ra lỗi khi đổi mật khẩu.";
        }
    }
}
?>
