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

// Truy vấn thông tin người dùng
$sql = "SELECT nguoidung.tenNguoiDung, nguoidung.diaChi, nhanvien.chucVu, nhanvien.maNhanVien, taikhoan.email 
        FROM nguoidung 
        INNER JOIN nhanvien ON nguoidung.maNguoiDung = nhanvien.maNguoiDung 
        INNER JOIN taikhoan ON nguoidung.maNguoiDung = taikhoan.maNguoiDung 
        WHERE taikhoan.email = ?";
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

// Xử lý khi người dùng nhấn nút "Lưu thay đổi"
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
                    alert('Thay đổi thành công!');
                    window.location.href = '../profile.php';
                </script>";
            exit();
        } else {
            $error = "Lỗi khi cập nhật thông tin.";
        }
    }
}
?>

