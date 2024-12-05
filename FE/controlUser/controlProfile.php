<?php
session_start();
require_once __DIR__ . '/../database/db_connect.php';

// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['user'])) {
    header("Location: ../user/login.php");
    exit();
}

$email = $_SESSION['user']; // Lấy email từ session
$user = null; // Khởi tạo biến chứa thông tin người dùng

$sql = "SELECT khachhang.tenKH, khachhang.maKH, khachhang.diaChi, nguoidung.email, nguoidung.gioiTinh 
        FROM khachhang 
        INNER JOIN nguoidung ON khachhang.maNguoiDung = nguoidung.maNguoiDung 
        WHERE nguoidung.email = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc(); // Lấy thông tin người dùng
    $_SESSION['userData'] = $user;  // Lưu thông tin vào session
} else {
    die("Không tìm thấy thông tin người dùng.");
}

// Xử lý khi người dùng nhấn nút "Lưu thay đổi thông tin"
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $newName = $_POST['tenNguoiDung'] ?? '';
    $newEmail = $_POST['email'] ?? '';

    if (empty($newName) || empty($newEmail)) {
        $error = "Vui lòng điền đầy đủ thông tin.";
    } else {
        // Cập nhật thông tin người dùng
        $updateSql = "UPDATE nguoidung 
                    INNER JOIN taikhoan ON nguoidung.maNguoiDung = taikhoan.maNguoiDung 
                    SET nguoidung.tenNguoiDung = ?, taikhoan.email = ? 
                    WHERE taikhoan.email = ?";
        $stmt = $conn->prepare($updateSql);
        $stmt->bind_param('sss', $newName, $newEmail, $email);

        if ($stmt->execute()) {
            $_SESSION['user'] = $newEmail; // Cập nhật email trong session
            echo "<script>
                    alert('Thay đổi thông tin thành công!');
                    window.location.href = 'profile.php';
                </script>";
            exit();
        } else {
            $error = "Lỗi khi cập nhật thông tin.";
        }
    }
}

// Xử lý đổi mật khẩu
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    $old_password = $_POST['old_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    $old_password_hashed = md5($old_password); // Mã hóa mật khẩu cũ
    if ($old_password_hashed !== $user['matkhau']) {
        $error = "Mật khẩu cũ không chính xác."; // Lỗi sai mật khẩu cũ
    } elseif ($new_password !== $confirm_password) {
        $error = "Mật khẩu mới và xác nhận không khớp."; // Lỗi xác nhận không khớp
    } else {
        $new_password_hashed = md5($new_password); // Mã hóa mật khẩu mới
        $updatePasswordSql = "UPDATE taikhoan SET matkhau = ? WHERE email = ?";
        $stmt = $conn->prepare($updatePasswordSql);
        $stmt->bind_param('ss', $new_password_hashed, $email);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Đổi mật khẩu thành công!');
                    window.location.href = 'profile.php';
                </script>";
            exit();
        } else {
            $error = "Đã xảy ra lỗi khi đổi mật khẩu.";
        }
    }
}


?>