<?php
// Kết nối cơ sở dữ liệu
require_once __DIR__ . '/../database/db_connect.php';

// // Lấy dữ liệu từ form
// $hoTen = $_POST['hoTen'];
// $soDienThoai = $_POST['soDienThoai'];
// $diaChi = $_POST['diaChi'];
// $ghiChu = $_POST['ghiChu'];
// $phuongThucThanhToan = 'Chuyển khoản';
// $tongTien = $_POST['tongTien'];
// $giamGia = $_POST['giamGia'];
// $maKH = $_POST['maKH'];
// $cartItems = json_decode($_POST['cartItems'], true); // Giỏ hàng dưới dạng JSON

// var_dump($_POST);
// try {
//     // Bắt đầu giao dịch
//     mysqli_begin_transaction($conn);

//     // 1. Chèn chi tiết vào bảng `chitietpm`
//     foreach ($cartItems as $item) {
//         $maAnPham = $item['maAnPham']; // Mã ấn phẩm
//         $soLuong = $item['SoLuong']; // Số lượng
//         $giathue = $item['Giathue']; // Giá thuê
//         $phiThue = $item['PhiThue']; // Phí thuê
//         $ngayMuon = $item['NgayMuon']; // Ngày mượn
//         $ngayTra = $item['NgayTra']; // Ngày trả

//         $queryInsertChiTiet = "
//             INSERT INTO chitietpm (maAnPham, soLuong, Dongia, PhiThue, ngayMuon, ngayTra)
//             VALUES ('$maAnPham', '$soLuong', '$giathue', '$phiThue', '$ngayMuon', '$ngayTra')
//         ";

//         if (!mysqli_query($conn, $queryInsertChiTiet)) {
//             throw new Exception('Lỗi chèn thông tin vào bảng chitietpm');
//         }

//         // Lấy maCTPM của bản ghi đã chèn vào chitietpm
//         $maCTPM = mysqli_insert_id($conn);

//         // 2. Chèn thông tin vào bảng `phieumuon`
//         $queryInsertPhieuMuon = "
//             INSERT INTO phieumuon (maKH, hoTen, soDienThoai, diaChi, ghiChu, phuongThucThanhToan, tongTien, giamGia, ngayTao, maCTPM)
//             VALUES ('$maKH', '$hoTen', '$soDienThoai', '$diaChi', '$ghiChu', '$phuongThucThanhToan', '$tongTien', '$giamGia', NOW(), '$maCTPM')
//         ";

//         if (!mysqli_query($conn, $queryInsertPhieuMuon)) {
//             throw new Exception('Lỗi chèn thông tin vào bảng phieumuon');
//         }
//     }

//     // Commit giao dịch nếu không có lỗi
//     mysqli_commit($conn);

//     // Trở về trang thành công hoặc chuyển hướng
//     header("Location: successPage.php?status=success"); // Chuyển hướng tới trang thành công
//     exit();
// } catch (Exception $e) {
//     // Rollback giao dịch nếu có lỗi
//     mysqli_rollBack($conn);
//     echo "Lỗi: " . $e->getMessage();
// }

// Dữ liệu từ form hoặc từ các bước xử lý trước
$hoTen = $_POST['hoTen'];
$soDienThoai = $_POST['soDienThoai'];
$diaChi = $_POST['diaChi'];
$ghiChu = $_POST['ghiChu'];
$phuongThucThanhToan = 'Chuyển khoản';
$tongTien = $_POST['tongTien'];
$giamGia = $_POST['giamGia'];
$maKH = $_POST['maKH'];
$cartItems = json_decode($_POST['cartItems'], true); // Giỏ hàng dưới dạng JSON // Mảng các chi tiết phiếu mượn, ví dụ: array('maAnPham' => '123', 'SoLuong' => 2, 'Giathue' => 10, 'PhiThue' => 5, 'NgayMuon' => '2024-12-01', 'NgayTra' => '2024-12-10')

mysqli_begin_transaction($conn);

try {
    // Chèn phiếu mượn vào bảng phieumuon
    $queryInsertPhieuMuon = "
        INSERT INTO phieumuon (maKH, hoTen, soDienThoai, diaChi, ghiChu, phuongThucThanhToan, tongTien, giamGia, ngayTao)
        VALUES ('$maKH', '$hoTen', '$soDienThoai', '$diaChi', '$ghiChu', '$phuongThucThanhToan', '$tongTien', '$giamGia', NOW())
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
        $phiThue = $item['PhiThue'];
        $ngayMuon = $item['NgayMuon'];
        $ngayTra = $item['NgayTra'];

        $queryInsertChiTiet = "
            INSERT INTO chitietpm (MaPhieuMuon, maAnPham, soLuong, Dongia, PhiThue, ngayMuon, ngayTra)
            VALUES ('$maPhieuMuon', '$maAnPham', '$soLuong', '$giathue', '$phiThue', '$ngayMuon', '$ngayTra')
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
