<?php
// shopping_cart.php

// Bao gồm các chức năng giỏ hàng
include_once 'database/db_connect.php';
include_once 'cart_functions.php';
// Bắt đầu phiên làm việc để lấy và lưu trữ thông báo
session_start();

// Lấy giỏ hàng từ session
$cart = get_cart();

// Tính tổng tiền
$total_price = calculate_total($cart);

// Lấy thông báo và lỗi từ session
$messages = get_messages();

// Xóa thông báo sau khi đã lấy
clear_messages();

// Kiểm tra xem có yêu cầu xóa sản phẩm không
$delete_id = isset($_GET['delete_id']) ? intval($_GET['delete_id']) : 0;
$product_to_delete = null;

if ($delete_id > 0) {
    $product_to_delete = get_product_by_id($cart, $delete_id);
    if (!$product_to_delete) {
        // Nếu sản phẩm không tồn tại trong giỏ hàng
        $_SESSION['errors'][] = "Sản phẩm không tồn tại trong giỏ hàng.";
        header("Location: shopping-cart.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <?php require_once 'layout/header.php'; ?>
    <!-- Nhúng file CSS riêng cho shopping-cart -->
    <link rel="stylesheet" href="css/shopping-cart.css">
    <!-- Thêm Font Awesome để sử dụng icon xóa (nếu cần) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <!-- Hiển thị thông báo thành công khi cập nhật giỏ hàng -->
            <?php if (!empty($messages['success_update'])): ?>
                <div class="alert alert-success fade-out">
                    <?php echo htmlspecialchars($messages['success_update']); ?>
                </div>
            <?php endif; ?>

            <!-- Hiển thị thông báo thành công khi xóa sản phẩm -->
            <?php if (!empty($messages['success_remove'])): ?>
                <div class="alert alert-success fade-out">
                    <?php echo htmlspecialchars($messages['success_remove']); ?>
                </div>
            <?php endif; ?>

            <!-- Hiển thị thông báo lỗi chung (nếu có) -->
            <?php if (!empty($messages['errors']) && is_array($messages['errors'])): ?>
                <div class="alert alert-danger fade-out">
                    <ul>
                        <?php foreach ($messages['errors'] as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Hiển thị thông báo xác nhận xóa sản phẩm -->
            <?php if ($delete_id > 0 && $product_to_delete): ?>
                <div class="confirmation-box">
                    <p>Bạn có chắc chắn muốn xóa sản phẩm "<strong><?php echo htmlspecialchars($product_to_delete['name']); ?></strong>" khỏi giỏ hàng không?</p>
                    <div class="confirmation-buttons">
                        <!-- Form để xác nhận xóa sản phẩm -->
                        <form method="POST" action="remove_cart.php" style="display: inline;">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($product_to_delete['id']); ?>">
                            <button type="submit" class="btn-confirm">Có, Xóa Sản Phẩm</button>
                        </form>
                        <!-- Liên kết để hủy bỏ hành động và quay lại giỏ hàng -->
                        <a href="shopping-cart.php" class="btn-cancel">Không, Hủy Bỏ</a>
                    </div>
                </div>
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
                                                    <img src="img/products/<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="product-image">
                                                    <div class="sp">
                                                        <h5><?php echo htmlspecialchars($item['name']); ?></h5>
                                                    </div>
                                                </td>
                                                <td class="shoping__cart__price">
                                                    <?php echo number_format($item['price'], 0, ',', '.'); ?> VND
                                                </td>
                                                <td class="shoping__cart__quantity">
                                                    <!-- Hiển thị lỗi nếu có -->
                                                    <?php if (isset($messages['errors'][$item['id']])): ?>
                                                        <div class="error">
                                                            <?php echo htmlspecialchars($messages['errors'][$item['id']]); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <input type="number" name="quantity[<?php echo htmlspecialchars($item['id']); ?>]" value="<?php echo htmlspecialchars($item['quantity']); ?>" min="1" max="<?php echo htmlspecialchars($item['soLuongTonKho']); ?>" required>
                                                </td>
                                                <td class="shoping__cart__total">
                                                    <?php echo number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?> VND
                                                </td>
                                                <td class="shoping__cart__item__close">
                                                    <!-- Link để yêu cầu xác nhận xóa sản phẩm -->
                                                    <a href="shopping-cart.php?delete_id=<?php echo htmlspecialchars($item['id']); ?>" class="remove-btn" title="Xóa">
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
                                <button type="submit" class="primary-btn">Cập nhật giỏ hàng</button>
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
    <link rel="stylesheet" href="css/shopping-cart.css">
</body>

</html>