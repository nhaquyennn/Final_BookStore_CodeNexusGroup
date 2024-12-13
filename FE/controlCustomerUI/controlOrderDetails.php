<?php
// controlOrderDetails.php

// Kết nối cơ sở dữ liệu
include_once 'database/db_connect.php';
include_once 'cart_functions.php';

// Bắt đầu phiên làm việc nếu chưa bắt đầu
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['maKH'])) {
    header('Location: ../user/login.php?error=Vui lòng đăng nhập để xem chi tiết đơn hàng.');
    exit();
}

$maKH = intval($_SESSION['maKH']);

// Kiểm tra xem MaPhieuMuon có được truyền qua GET không
if (!isset($_GET['MaPhieuMuon']) || empty($_GET['MaPhieuMuon'])) {
    $_SESSION['errors'][] = "Không tìm thấy đơn hàng.";
    header('Location: ../errorPage.php');
    exit();
}

$MaPhieuMuon = intval($_GET['MaPhieuMuon']);

// Câu truy vấn để lấy thông tin đơn hàng
$sql_order = "
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
        pm.MaPhieuMuon = ? AND pm.maKH = ?
    LIMIT 1
";

// Chuẩn bị và thực thi câu truy vấn đơn hàng
$stmt_order = $conn->prepare($sql_order);
if (!$stmt_order) {
    $_SESSION['errors'][] = "Lỗi chuẩn bị câu truy vấn đơn hàng: " . $conn->error;
    header('Location: ../errorPage.php');
    exit();
}
$stmt_order->bind_param("ii", $MaPhieuMuon, $maKH);
if (!$stmt_order->execute()) {
    $_SESSION['errors'][] = "Lỗi thực thi câu truy vấn đơn hàng: " . $stmt_order->error;
    header('Location: ../errorPage.php');
    exit();
}
$result_order = $stmt_order->get_result();

if ($result_order->num_rows === 0) {
    $_SESSION['errors'][] = "Không tìm thấy đơn hàng hoặc đơn hàng không thuộc về bạn.";
    header('Location: ../errorPage.php');
    exit();
}

$orderDetails = $result_order->fetch_assoc();
$orderDetails['GiaTienDaThanhToan'] = $orderDetails['TongTien'] - ($orderDetails['TongTien'] * ($orderDetails['GiamGia'] / 100));

$stmt_order->close();

// Câu truy vấn để lấy danh sách sản phẩm trong đơn hàng với hình ảnh từ bảng dauap
$sql_products = "
    SELECT 
        ct.SoLuong,
        ct.DonGia,
        ct.GiamGia,
        ct.tinhTrangMuon,
        d.hinhAnh AS hinhAnh_dauap,
        a.TenAnPham,
        a.Giathue,
        d.TenDauAnPham,
        d.madauAP,
        ct.ngayTra,
        ct.phiThue
    FROM 
        chitietpm ct
    INNER JOIN 
        anpham a ON ct.maAnPham = a.maAnPham
    INNER JOIN 
        dauap d ON a.madauAP = d.madauAP
    WHERE 
        ct.MaPhieuMuon = ?
";

// Chuẩn bị và thực thi câu truy vấn sản phẩm
$stmt_products = $conn->prepare($sql_products);
if (!$stmt_products) {
    $_SESSION['errors'][] = "Lỗi chuẩn bị câu truy vấn sản phẩm: " . $conn->error;
    header('Location: ../errorPage.php');
    exit();
}
$stmt_products->bind_param("i", $MaPhieuMuon);
if (!$stmt_products->execute()) {
    $_SESSION['errors'][] = "Lỗi thực thi câu truy vấn sản phẩm: " . $stmt_products->error;
    header('Location: ../errorPage.php');
    exit();
}
$result_products = $stmt_products->get_result();

$products = [];
$totalPhiThue = 0; // Biến để tính tổng phí thuê

while ($product = $result_products->fetch_assoc()) {
    $products[] = $product;
    $totalPhiThue += floatval($product['phiThue']);
}

$orderDetails['TotalPhiThue'] = $totalPhiThue;

$stmt_products->close();

// Lấy dữ liệu giỏ hàng
$cart = get_cart_from_db($maKH);

// Không đóng kết nối ở đây
