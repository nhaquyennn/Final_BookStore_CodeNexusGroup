<?php
// shopping_cart.php

// Bắt đầu phiên làm việc nếu chưa bắt đầu
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Bao gồm cart_functions.php để sử dụng các hàm liên quan đến giỏ hàng
include_once 'cart_functions.php';

// Lấy giỏ hàng hiện tại
$maNguoiDung = $_SESSION['maNguoiDung'] ?? null;
if ($maNguoiDung) {
    $cart = get_cart_from_db($maNguoiDung);
} else {
    $cart = get_cart();
}

// Tính tổng tiền giỏ hàng
$total_price = calculate_total($cart);
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <?php require_once 'layout/header.php'; ?>
    <link rel="stylesheet" href="css/shopping-cart.css">
    <!-- Thêm Font Awesome để sử dụng icon xóa (nếu cần) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Thêm Bootstrap CSS từ CDN (nếu chưa được bao gồm trong header.php) -->
</head>

<body>

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <!-- Hiển thị thông báo thành công khi cập nhật giỏ hàng -->
            <?php if (!empty($_SESSION['success_update'])): ?>
                <div class="alert alert-success fade-out">
                    <?php echo htmlspecialchars($_SESSION['success_update']); ?>
                </div>
                <?php unset($_SESSION['success_update']); ?>
            <?php endif; ?>

            <!-- Hiển thị thông báo thành công khi xóa sản phẩm -->
            <?php if (!empty($_SESSION['success_remove'])): ?>
                <div class="alert alert-success fade-out">
                    <?php echo htmlspecialchars($_SESSION['success_remove']); ?>
                </div>
                <?php unset($_SESSION['success_remove']); ?>
            <?php endif; ?>

            <!-- Hiển thị thông báo lỗi chung (nếu có) -->
            <?php if (!empty($_SESSION['errors']) && is_array($_SESSION['errors'])): ?>
                <div class="alert alert-danger fade-out">
                    <ul>
                        <?php foreach ($_SESSION['errors'] as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php unset($_SESSION['errors']); ?>
            <?php endif; ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <!-- Form để cập nhật giỏ hàng -->
                        <form method="POST" action="update_cart.php">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="shoping__product">Sản phẩm</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Tổng tiền</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($cart)): ?>
                                        <?php foreach ($cart as $index => $item): ?>
                                            <tr>
                                                <td class="shoping__cart__item">
                                                    <?php
                                                    // **Thêm cập nhật: Kiểm tra người dùng đã đăng nhập hay chưa để lấy hình ảnh**
                                                    if (isset($item['product_info'])) {
                                                        // Người dùng chưa đăng nhập
                                                        $product_info = $item['product_info'];
                                                    } else {
                                                        // Người dùng đã đăng nhập
                                                        $product_info = get_product_info($item['id']); // Hoặc lấy từ DB
                                                    }

                                                    // Kiểm tra nếu hình ảnh không tồn tại, sử dụng hình ảnh mặc định
                                                    $image = !empty($product_info['hinhAnh_dauap']) ? $product_info['hinhAnh_dauap'] : 'default.png';
                                                    ?>
                                                    <img src="img/products/<?php echo htmlspecialchars($image); ?>"
                                                        alt="<?php echo htmlspecialchars($product_info['TenAnPham'] ?? ''); ?>"
                                                        class="product-image">
                                                    <div class="sp">
                                                        <h5><?php echo htmlspecialchars($product_info['TenAnPham'] ?? ''); ?></h5>
                                                    </div>
                                                </td>
                                                <td class="shoping__cart__price">
                                                    <?php
                                                    // **Thêm cập nhật: Lấy giá từ product_info nếu có**
                                                    $price = isset($product_info['Giathue']) ? $product_info['Giathue'] : $item['price'];
                                                    echo number_format($price, 0, ',', '.') . ' VND';
                                                    ?>
                                                </td>
                                                <td class="shoping__cart__quantity">
                                                    <!-- Hiển thị lỗi nếu có -->
                                                    <?php if (isset($_SESSION['errors'][$item['id']])): ?>
                                                        <div class="error text-danger">
                                                            <?php echo htmlspecialchars($_SESSION['errors'][$item['id']]); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <!-- **Thêm cập nhật: Xác thực nhập liệu bằng JavaScript** -->
                                                    <input type="number"
                                                        name="quantities[<?php echo htmlspecialchars($item['id']); ?>]"
                                                        value="<?php echo htmlspecialchars($item['quantity']); ?>"
                                                        min="1"
                                                        max="<?php echo htmlspecialchars($product_info['soLuongTonKho'] ?? 1000); ?>"
                                                        required
                                                        oninvalid="this.setCustomValidity('Số lượng không hợp lệ! Vui lòng nhập lại')"
                                                        oninput="this.setCustomValidity('')"
                                                        onchange="if (this.value < 1 || this.value > <?php echo htmlspecialchars($product_info['soLuongTonKho'] ?? 1000); ?>) {this.setCustomValidity('Số lượng không hợp lệ. Vui lòng chọn lại.');} else {this.setCustomValidity('');}">
                                                </td>
                                                <td class="shoping__cart__total">
                                                    <?php
                                                    $total_item = $price * $item['quantity'];
                                                    echo number_format($total_item, 0, ',', '.') . ' VND';
                                                    ?>
                                                </td>
                                                <td class="shoping__cart__item__close">
                                                    <!-- Link để yêu cầu xác nhận xóa sản phẩm -->
                                                    <a href="remove_cart.php?id=<?php echo htmlspecialchars($item['id']); ?>"
                                                        class="remove-btn" title="Xóa">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5">Giỏ hàng của bạn đang trống.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                            <div class="shoping__cart__btns">
                                <button type="submit" name="update_cart" class="primary-btn">Cập nhật giỏ hàng</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Hiển thị tổng tiền giỏ hàng -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__checkout">
                        <h5>Tổng tiền: <?php echo number_format($total_price, 0, ',', '.') . ' VND'; ?></h5>
                        <!-- nút thanh toán  -->
                        <a href="checkout.php" class="primary-btn">Thanh toán</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->

    <?php require_once 'layout/footer.php'; ?>
    <!-- **Thêm cập nhật: Nhúng file JavaScript tùy chỉnh để cải thiện giao diện và chức năng** -->
    <script src="../FE/js/main1.js"></script>



</body>

</html>
<?php
// Đóng kết nối cơ sở dữ liệu nếu chưa đóng
if (isset($conn) && $conn) {
    // **Đã Thêm từ Ver2: Sử dụng phương thức đóng kết nối phù hợp**
    $conn->close();
}
?>