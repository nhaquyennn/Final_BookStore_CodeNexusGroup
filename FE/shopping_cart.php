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
                                                    // Kiểm tra nếu hình ảnh không tồn tại, sử dụng hình ảnh mặc định
                                                    $image = !empty($item['image']) ? $item['image'] : 'default.png';
                                                    ?>
                                                    <img src="img/products/<?php echo htmlspecialchars($image); ?>"
                                                        alt="<?php echo htmlspecialchars($item['name']); ?>"
                                                        class="product-image">
                                                    <div class="sp">
                                                        <h5><?php echo htmlspecialchars($item['name']); ?></h5>
                                                    </div>
                                                </td>
                                                <td class="shoping__cart__price">
                                                    <?php echo number_format($item['price'], 0, ',', '.'); ?> VND
                                                </td>
                                                <td class="shoping__cart__quantity">
                                                    <!-- Hiển thị lỗi nếu có -->
                                                    <?php if (isset($_SESSION['errors'][$item['id']])): ?>
                                                        <div class="error">
                                                            <?php echo htmlspecialchars($_SESSION['errors'][$item['id']]); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <input type="number"
                                                        name="quantities[<?php echo htmlspecialchars($item['id']); ?>]"
                                                        value="<?php echo htmlspecialchars($item['quantity']); ?>"
                                                        min="1" max="<?php echo htmlspecialchars($item['soLuongTonKho']); ?>"
                                                        required>
                                                </td>
                                                <td class="shoping__cart__total">
                                                    <?php echo number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?> VND
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
                        <h5>Tổng tiền: <?php echo number_format($total_price, 0, ',', '.'); ?> VND</h5>
                        <!-- Bạn có thể thêm các nút thanh toán hoặc tiếp tục mua sắm ở đây -->
                        <a href="checkout.php" class="primary-btn">Thanh toán</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->

    <?php require_once 'layout/footer.php'; ?>

    <!-- Nhúng file CSS đã tách ra -->
    <!-- Loại bỏ việc bao gồm lại CSS ở cuối body -->
    <!-- <link rel="stylesheet" href="css/shopping-cart.css"> -->

    <!-- Thêm JavaScript để tự động ẩn thông báo -->

</body>

</html>