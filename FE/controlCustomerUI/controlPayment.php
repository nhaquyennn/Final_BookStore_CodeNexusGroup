<?php
// Kết nối cơ sở dữ liệu
require_once __DIR__ . '/../database/db_connect.php';

// Dữ liệu từ form hoặc từ các bước xử lý trước

$hoTen = $_POST['hoTen'];
$soDienThoai = $_POST['soDienThoai'];
$diaChi = $_POST['diaChi'];
$ghiChu = $_POST['ghiChu'];
$phuongThucThanhToan = 'Chuyển khoản';
$tongTien = $_POST['finalPrice'];
$giamGia = $_POST['discountAmount'];
$phiShip = $_POST['shippingFee'];
$maKH = $_POST['maKH'];
$khuyenMai = $_POST['coupon_code'];
$phiThue = $_POST['totalRentalFee'];
$cartItems = json_decode($_POST['cartItems'], true); // Giỏ hàng dưới dạng JSON // Mảng các chi tiết phiếu mượn, ví dụ: array('maAnPham' => '123', 'SoLuong' => 2, 'Giathue' => 10, 'PhiThue' => 5, 'NgayMuon' => '2024-12-01', 'NgayTra' => '2024-12-10')

mysqli_begin_transaction($conn);

try {
    // Chèn phiếu mượn vào bảng phieumuon
    $queryInsertPhieuMuon = "
        INSERT INTO phieumuon (maKH, hoTen, soDienThoai, diaChi, ghiChu, phuongThucThanhToan, tongTien, GiamGia, ngayTao, MaKhuyenMai, PhiShip)
        VALUES ('$maKH', '$hoTen', '$soDienThoai', '$diaChi', '$ghiChu', '$phuongThucThanhToan', '$tongTien', '$giamGia', NOW(),'$khuyenMai', '$phiShip')
    ";

    if (!mysqli_query($conn, $queryInsertPhieuMuon)) {
        throw new Exception("Lỗi khi chèn phiếu mượn: " . mysqli_error($conn));
    }

    // Lấy mã phiếu mượn vừa tạo
    $maPhieuMuon = mysqli_insert_id($conn);

    // Chèn các chi tiết phiếu mượn vào bảng chitietpm
    foreach ($cartItems as $item) {
        $maAnPham = $item['maAnPham'];
        $soLuong = $item['SoLuong'];
        $giathue = $item['Giathue'];
        $ngayMuon = $item['NgayMuon'];
        $ngayTra = $item['NgayTra'];
        $tinhTrang = $item['tinhTrang'];
        $hinhAnh = $item['hinhAnh'];

        $queryInsertChiTiet = "
            INSERT INTO chitietpm (MaPhieuMuon, maAnPham, soLuong, Dongia, GiamGia, PhiThue, ngayMuon, ngayTra, tinhTrangMuon, hinhAnh, MaKhuyenMai)
            VALUES ('$maPhieuMuon', '$maAnPham', '$soLuong', '$giathue', '$giamGia' ,'$phiThue', '$ngayMuon', '$ngayTra','$tinhTrang', '$hinhAnh','$khuyenMai')
        ";

        if (!mysqli_query($conn, $queryInsertChiTiet)) {
            throw new Exception("Lỗi khi chèn chi tiết phiếu mượn: " . mysqli_error($conn));
        }
    }

    // Commit giao dịch nếu không có lỗi
    mysqli_commit($conn);
    header("Location: successPage.php?status=success");
} catch (Exception $e) {
    // Rollback giao dịch nếu có lỗi
    mysqli_rollBack($conn);
    echo "Lỗi: " . $e->getMessage();
}

// Đóng kết nối
mysqli_close($conn);


?>