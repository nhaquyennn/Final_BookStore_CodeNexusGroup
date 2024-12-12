<?php
require_once 'controlCheckout.php'; 

if (isset($_POST['coupon_code'])) {
    $couponCode = $_POST['coupon_code'];
    $cartItems = getCartDetails($conn); // Lấy danh sách sản phẩm trong giỏ hàng

    // Tính tổng tiền gốc từ giỏ hàng
    $totalAmount = 0;
    foreach ($cartItems as $item) {
        $totalAmount += $item['Giathue'] * $item['SoLuong'];
    }

    // Kiểm tra số lượng sách khách hàng đã thuê trong tháng
    $customerId = getCustomerId(); // Lấy id của khách hàng từ session hoặc cơ sở dữ liệu
    $month = date('m'); // Tháng hiện tại
    $year = date('Y'); // Năm hiện tại
    $query = "
    SELECT SUM(ct.SoLuong) AS totalBooks
    FROM chitietpm ct
    JOIN phieumuon pm ON ct.MaPhieuMuon = pm.MaPhieuMuon
    WHERE MONTH(pm.NgayTao) = '$month' 
    AND YEAR(pm.NgayTao) = '$year' 
    AND pm.maKH = '$customerId'
    ";

    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    $totalBooks = $row['totalBooks'];
    $discountedPrice = $totalAmount;

    // Kiểm tra nếu khách hàng đã thuê >= 10 cuốn sách trong tháng, áp dụng khuyến mãi
    if ($totalBooks >= 10) {
        $couponCode = 4; // Mã khuyến mãi 10%
    }

    // Tính giá sau khi áp dụng mã giảm giá
    $discountedPrice = calculateDiscountedPrice($totalAmount, $couponCode, $conn);

    // Tính số tiền giảm giá
    $discountAmount = $totalAmount - $discountedPrice;

    // Định nghĩa phí giao hàng mặc định
    $shippingFee = 20000;

    // Tính giá trị sau khi giảm giá và cộng phí giao hàng
    $finalPrice = $discountedPrice + $shippingFee;

    // Trả về JSON
    echo json_encode([
        'discountText' => number_format($discountAmount, 0, '', '.') . ' VND',
        'totalPrice' => number_format($finalPrice, 0, '', '.') . ' VND',
        'coupon_code' => $couponCode, // Trả mã khuyến mãi áp dụng
        'totalBooks' => $totalBooks // Trả số lượng sách đã thuê
    ]);
    exit; // Đảm bảo không xuất thêm dữ liệu
} else {
    echo json_encode(['error' => 'Coupon code not provided']);
    exit;
}
?>
