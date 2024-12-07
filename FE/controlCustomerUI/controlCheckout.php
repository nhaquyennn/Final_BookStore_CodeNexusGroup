<?php
require_once __DIR__ . '/../database/db_connect.php';
function getCoupons($conn)
{
    // Truy vấn dữ liệu từ bảng khuyenmai
    $sql = "SELECT MaKhuyenMai, TenKhuyenMai, PhanTramGiamGia, NgayKetThuc, NgayBatDau, maCTPM
            FROM khuyenmai";

    // Thực thi truy vấn
    $result = mysqli_query($conn, $sql);

    // Khởi tạo mảng chứa dữ liệu khuyến mãi
    $coupons = [];

    // Kiểm tra nếu có dữ liệu
    if ($result && mysqli_num_rows($result) > 0) {
        // Lấy dữ liệu từ kết quả truy vấn và thêm vào mảng $coupons
        while ($row = mysqli_fetch_assoc($result)) {
            $coupons[] = $row;
        }
    }

    // Trả về mảng dữ liệu khuyến mãi
    return $coupons;
}
function calculateDiscountedPrice($originalPrice, $couponCode, $conn)
{
    // Lấy danh sách khuyến mãi
    $coupons = getCoupons($conn);

    // Kiểm tra nếu mã khuyến mãi hợp lệ
    foreach ($coupons as $coupon) {
        if ($coupon['MaKhuyenMai'] == $couponCode) {
            $discountPercent = $coupon['PhanTramGiamGia']; // Phần trăm giảm giá
            $discountAmount = $originalPrice * ($discountPercent / 100); // Tính số tiền giảm
            $discountedPrice = $originalPrice - $discountAmount; // Giá sau khuyến mãi

            // Trả về giá sau khuyến mãi
            return $discountedPrice;
        }
    }

    // Nếu không tìm thấy mã khuyến mãi, trả về giá gốc
    return $originalPrice;
}

function getCartDetails($conn)
{
    // Truy vấn kết hợp bảng giỏ hàng và bảng anpham qua khóa maAnPham
    $query = "  SELECT giohang.*, anpham.TenAnPham, anpham.Giathue, dauap.hinhAnh,
                    NOW() AS NgayMuon
            FROM giohang
            INNER JOIN anpham ON giohang.maAnPham = anpham.maAnPham
            INNER JOIN dauap ON anpham.maDauAp = dauap.maDauAp";


    $result = mysqli_query($conn, $query);

    // Kiểm tra nếu có kết quả
    if ($result) {
        $cartItems = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $cartItems[] = $row;  // Thêm từng sản phẩm vào mảng $cartItems
        }
        return $cartItems;
    } else {
        return [];  // Trả về mảng rỗng nếu không có dữ liệu hoặc có lỗi
    }
}

?>