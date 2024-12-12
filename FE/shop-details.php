<?php
// shop-details.php

// Kích hoạt hiển thị lỗi PHP để dễ dàng debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Bao gồm các control files và chức năng giỏ hàng
include 'controlCustomerUI/controlProductDetails.php'; // Đảm bảo đường dẫn đúng
include_once 'cart_functions.php'; // Bao gồm các hàm giỏ hàng

// Kiểm tra nếu sản phẩm đã được lấy thành công
if ($product) {
    // Lấy giỏ hàng hiện tại
    $cart = get_cart();

    // Lấy sản phẩm đã có trong giỏ hàng
    $existing_product = get_product_by_id($cart, $product['maAnPham']);
    $existing_quantity_in_cart = $existing_product ? $existing_product['quantity'] : 0;

    // Tính số lượng tối đa có thể thêm
    $max_addable_quantity = $product['soLuongTonKho'] - $existing_quantity_in_cart;
    if ($max_addable_quantity < 1) {
        $max_addable_quantity = 0; // Không thể thêm thêm sản phẩm nào
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <?php require_once 'layout/header.php'; ?>
    <link rel="stylesheet" href="css/shop-details.css">
    <!-- Thêm Font Awesome để sử dụng icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Thêm Bootstrap CSS từ CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Chi tiết Sản phẩm</title>
</head>

<body>
    <!-- Navbar -->

    <div class="container my-5">
        <!-- Hiển thị thông báo thành công khi cập nhật giỏ hàng -->
        <?php if (!empty($_SESSION['success_update'])): ?>
            <div class="alert alert-success fade-out">
                <?php
                echo htmlspecialchars($_SESSION['success_update']);
                unset($_SESSION['success_update']); // Xóa thông báo sau khi hiển thị
                ?>
            </div>
        <?php endif; ?>

        <!-- Hiển thị thông báo lỗi chung (nếu có) -->
        <?php if (!empty($_SESSION['errors']) && is_array($_SESSION['errors'])): ?>
            <div class="alert alert-danger fade-out">
                <ul>
                    <?php
                    foreach ($_SESSION['errors'] as $error):
                        echo "<li>" . htmlspecialchars($error) . "</li>";
                    endforeach;
                    unset($_SESSION['errors']); // Xóa thông báo sau khi hiển thị
                    ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if ($product): ?>
            <div class="row">
                <div class="col-md-6">
                    <!-- Sử dụng alias 'hinhAnh_dauap' để hiển thị hình ảnh từ bảng 'dauap' -->
                    <img src="img/products/<?php echo htmlspecialchars($product['hinhAnh_dauap'] ?? 'default.png'); ?>"
                        alt="<?php echo htmlspecialchars($product['TenAnPham']); ?>"
                        class="img-fluid rounded product-image">
                </div>
                <div class="col-md-6">
                    <h2><?php echo htmlspecialchars($product['TenAnPham']); ?></h2>
                    <p class="text-muted">Giá thuê: <?php echo number_format($product['Giathue'], 0, ',', '.') ?> VNĐ</p>

                    <!-- Hiển thị thông tin tác giả, nhà xuất bản và danh mục -->
                    <p><strong>Tác giả:</strong> <?php echo htmlspecialchars($product['Tacgia']); ?></p>
                    <p><strong>Nhà xuất bản:</strong> <?php echo htmlspecialchars($product['NXB']); ?></p>
                    <p><strong>Danh mục:</strong> <?php echo htmlspecialchars($product['TenDanhMuc']); ?></p>

                    <p><?php echo nl2br(htmlspecialchars($product['moTa_dauap'])); ?></p>

                    <!-- Thông tin số lượng trong kho và trong giỏ hàng -->
                    <p><strong>Số lượng trong kho:</strong> <?php echo htmlspecialchars($product['soLuongTonKho']); ?></p>
                    <p><strong>Số lượng đã có trong giỏ hàng:</strong> <?php echo htmlspecialchars($existing_quantity_in_cart); ?></p>
                    <p><strong>Số lượng tối đa bạn có thể thêm:</strong> <?php echo htmlspecialchars($max_addable_quantity); ?></p>

                    <?php if ($max_addable_quantity > 0): ?>
                        <form action="add_to_cart.php" method="POST" class="mt-4">
                            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['maAnPham']); ?>">
                            <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['TenAnPham']); ?>">
                            <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($product['Giathue']); ?>">
                            <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($product['hinhAnh_dauap']); ?>">

                            <div class="mb-3">
                                <label for="quantity" class="form-label">Số lượng:</label>
                                <input type="number" name="quantity" id="quantity"
                                    class="form-control" value="1" min="1"
                                    max="<?php echo htmlspecialchars($max_addable_quantity); ?>" required>
                                <small class="form-text text-muted">Bạn có thể thêm tối đa <?php echo htmlspecialchars($max_addable_quantity); ?> cuốn.</small>
                            </div>

                            <div class="mb-3">
                                <label for="return_date" class="form-label">Ngày trả sách:</label>
                                <input type="date" name="return_date" id="return_date" class="form-control" required
                                    min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+15 days')); ?>">
                            </div>

                            <button type="submit" name="add_to_cart" class="btn btn-primary">
                                <i class="fa fa-cart-plus"></i> Thêm vào giỏ hàng
                            </button>
                        </form>
                    <?php else: ?>
                        <div class="alert alert-warning" role="alert">
                            Bạn đã thêm tối đa số lượng sản phẩm này vào giỏ hàng. Vui lòng kiểm tra lại số lượng hoặc liên hệ với chúng tôi nếu bạn cần thêm.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-warning" role="alert">
                Sản phẩm không tồn tại.
            </div>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center py-4">
        <?php require_once 'layout/footer.php'; ?>
    </footer>

    <!-- Thêm Bootstrap JS và các phụ thuộc từ CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
// Đóng kết nối cơ sở dữ liệu nếu chưa đóng
if (isset($conn) && $conn) {
    mysqli_close($conn);
}
?>