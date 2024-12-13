<?php
// Kết nối database
require_once __DIR__ . '/../database/db_connect.php';

if (isset($_GET['search']) && !empty($_GET['query'])) {
    $query = trim($_GET['query']); // Lấy từ khóa tìm kiếm
    $query = htmlspecialchars($query); // Ngăn ngừa XSS

    // Tìm kiếm sản phẩm trong database
    $stmt = $conn->prepare("SELECT anpham.*, dauap.hinhAnh FROM anpham 
    JOIN dauap ON anpham.maDauAp = dauap.maDauAp 
    WHERE anpham.TenAnPham LIKE ? OR anpham.tinhTrang LIKE ?");
    $searchTerm = "%" . $query . "%";
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    // Chuyển dữ liệu sản phẩm qua session để hiển thị trên `shop-grid.php`
    session_start();
    $_SESSION['search_results'] = $result->fetch_all(MYSQLI_ASSOC);
    $_SESSION['search_query'] = $query;

    // Chuyển hướng đến trang shop-grid.php
    header("Location: ../shop-grid.php");
    exit();
} else {
    // Nếu không có từ khóa, quay lại trang chủ hoặc hiển thị thông báo
    header("Location: ../index.php");
    exit();
}
?>