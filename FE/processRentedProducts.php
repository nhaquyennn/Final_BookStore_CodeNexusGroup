<?php
// FE/rentedProducts.php

// Bật hiển thị lỗi (chỉ trong môi trường phát triển)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Bao gồm kết nối cơ sở dữ liệu và các hàm cần thiết
include_once 'database/db_connect.php';
include_once 'cart_functions.php';

// Bắt đầu phiên làm việc nếu chưa bắt đầu
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


$maKH = intval($_SESSION['maNguoiDung']);

// Câu truy vấn để lấy danh sách ấn phẩm đã thuê với trạng thái "Đã hoàn tất"
$sql = "
    SELECT 
        ct.maAnPham,
        a.TenAnPham,
        d.hinhAnh AS hinhAnh_dauap,
        ct.soLuong,
        ct.ngayTra
    FROM 
        chitietpm ct
    INNER JOIN 
        anpham a ON ct.maAnPham = a.maAnPham
    INNER JOIN 
        dauap d ON a.madauAP = d.madauAP
    INNER JOIN 
        phieumuon pm ON ct.MaPhieuMuon = pm.MaPhieuMuon
    WHERE 
        pm.maKH = ? AND pm.tinhTrang = 'Đã hoàn tất'
";

$products = [];

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $maKH);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($product = $result->fetch_assoc()) {
        $products[] = $product;
    }
    $stmt->close();
}
