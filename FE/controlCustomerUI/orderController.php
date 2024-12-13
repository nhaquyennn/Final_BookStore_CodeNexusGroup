<?php
// FE/controlCustomerUI/orderController.php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include_once 'database/db_connect.php';
include_once 'cart_functions.php';



$maKH = intval($_SESSION['maNguoiDung']);

// Chuẩn bị câu truy vấn SQL để lấy danh sách đơn hàng của khách hàng từ bảng phieumuon
$sql = "
    SELECT 
        pm.MaPhieuMuon,
        pm.hoTen AS HoTen,
        pm.SoDienThoai AS SoDienThoai,
        pm.email AS Email,
        pm.diaChi AS DiaChi,
        pm.ghiChu AS GhiChu,
        pm.TongTien AS TongTien,
        pm.GiamGia AS GiamGia,
        pm.PhuongThucThanhToan AS PhuongThucThanhToan,
        pm.tinhTrang AS tinhTrang,
        pm.lyDoHuy AS lyDoHuy,
        pm.soTaiKhoan AS soTaiKhoan,
        kh.tenKH AS TenKH,
        km.PhanTramGiamgia AS PhanTramGiamgia,
        pm.NgayTao AS NgayTao
    FROM 
        phieumuon pm
    INNER JOIN 
        khachhang kh ON pm.maKH = kh.maKH
    INNER JOIN 
        nguoidung nd ON kh.maNguoiDung = nd.maNguoiDung
    INNER JOIN 
        khuyenmai km ON pm.MaKhuyenMai = km.MaKhuyenMai
    WHERE 
        pm.maKH = ?
    ORDER BY 
        pm.NgayTao DESC
";

// Sử dụng prepared statements để tránh SQL Injection
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Lỗi chuẩn bị câu truy vấn: " . $conn->error);
}
$stmt->bind_param("i", $maKH);

if (!$stmt->execute()) {
    die("Lỗi thực thi câu truy vấn: " . $stmt->error);
}

$result = $stmt->get_result();

$orders = [];
if ($result->num_rows > 0) {
    while ($order = $result->fetch_assoc()) {
        $order['GiaTienDaThanhToan'] = $order['TongTien'] - ($order['TongTien'] * ($order['GiamGia'] / 100));
        $orders[] = $order;
    }
}

$stmt->close();

// Lấy dữ liệu giỏ hàng
$cart = get_cart_from_db($conn, $maKH);

// Không đóng kết nối ở đây, để nó vẫn mở cho các truy vấn khác
