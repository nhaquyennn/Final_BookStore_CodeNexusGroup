
<?php
session_start();
// Kiểm tra nếu session 'user' không tồn tại 
if (!isset($_SESSION['user'])) {
  // Nếu chưa đăng nhập, chuyển hướng về trang login
header("Location: user/login.php?error=Vui lòng đăng nhập.");
exit();
}
?>
<?php
require_once "db_connect.php";

if (isset($_GET['query'])) {
    $query = $_GET['query'];
    $sql = "SELECT maAnPham, TenAnPham, PhiThue, tinhTrang 
            FROM anpham 
            WHERE TenAnPham LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%" . $query . "%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
    $stmt->close();
}
$conn->close();
