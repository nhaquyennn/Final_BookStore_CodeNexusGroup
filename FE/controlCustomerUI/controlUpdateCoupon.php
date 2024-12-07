<?php
require_once 'controlCheckout.php'; // Đảm bảo kết nối database và các hàm

if (isset($_POST['coupon_code'])) {
    $couponCode = $_POST['coupon_code'];

    // Lấy danh sách sản phẩm trong giỏ hàng
    $cartItems = getCartDetails($conn);

    // Tính tổng tiền gốc từ giỏ hàng
    $totalAmount = 0;
    foreach ($cartItems as $item) {
        $totalAmount += $item['Giathue'] * $item['SoLuong']; // Giá thuê * Số lượng
    }

    // Gọi hàm tính giá sau giảm giá
    $discountedPrice = calculateDiscountedPrice($totalAmount, $couponCode, $conn);

    // Tính số tiền giảm giá
    $discountAmount = $totalAmount - $discountedPrice;

    // Trả về JSON
    echo json_encode([
        'discountText' => number_format($discountAmount, 0, '', '.') . ' VND',
        'totalPrice' => number_format($discountedPrice, 0, '', '.') . ' VND'
    ]);
}
?>
