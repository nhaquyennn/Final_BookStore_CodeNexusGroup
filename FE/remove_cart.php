<?php
// remove_cart.php

// Kích hoạt hiển thị lỗi PHP để dễ dàng debug (Chỉ nên sử dụng trong môi trường phát triển)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Bắt đầu phiên làm việc nếu chưa bắt đầu
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Bao gồm kết nối cơ sở dữ liệu và các hàm giỏ hàng
include_once 'database/db_connect.php';
include_once 'cart_functions.php';

// Kiểm tra nếu kết nối đã được thiết lập
if (isset($connection_failed) && $connection_failed) {
    // Thiết lập thông báo lỗi và chuyển hướng
    $_SESSION['errors'][] = "Lỗi. Vui lòng thử lại sau.";
    header("Location: shopping_cart.php");
    exit();
}

// Tiếp tục với phần xử lý xóa sản phẩm
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
    $maNguoiDung = $_SESSION['maNguoiDung'] ?? null;

    if ($maNguoiDung) {
        // Người dùng đã đăng nhập, lấy thông tin sản phẩm từ DB
        $product = get_product_info($product_id);
    } else {
        // **Đã Chỉnh Sửa từ Ver2: Lấy thông tin sản phẩm trực tiếp từ session**
        if (isset($_SESSION['shopping_cart'][$product_id])) {
            // Không có khóa 'product_info' trong session, truy cập trực tiếp các trường thông tin sản phẩm
            $product = $_SESSION['shopping_cart'][$product_id];
        } else {
            $product = null;
        }
    }

    if (!$product) {
        $_SESSION['errors'][] = "Sản phẩm không tồn tại trong giỏ hàng.";
        header("Location: shopping_cart.php");
        exit();
    }

    // Hiển thị trang xác nhận
?>
    <!DOCTYPE html>
    <html lang="vi">

    <head>
        <meta charset="UTF-8">
        <title>Xác Nhận Xóa Sản Phẩm</title>
        <link rel="stylesheet" href="../FE/css/remove_cart.css">
    </head>

    <body>
        <div class="container">
            <h2>Xác Nhận Xóa Sản Phẩm</h2>
            <div class="product-info">
                <img src="img/products/<?php echo htmlspecialchars($product['hinhAnh_dauap'] ?? 'default.png'); ?>" alt="<?php echo htmlspecialchars($product['TenAnPham'] ?? ''); ?>">
                <div>
                    <h4><?php echo htmlspecialchars($product['TenAnPham'] ?? ''); ?></h4>
                    <p>Giá: <?php echo number_format($product['Giathue'] ?? 0, 0, ',', '.'); ?> VND</p>
                </div>
            </div>
            <p>Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng không?</p>
            <div class="buttons">
                <!-- Nút Xác Nhận Xóa -->
                <form method="POST" action="remove_cart.php">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($product_id); ?>">
                    <button type="submit" class="confirm">Xác Nhận</button>
                </form>

                <!-- Nút Hủy Bỏ -->
                <form method="GET" action="shopping_cart.php">
                    <button type="submit" class="cancel">Hủy Bỏ</button>
                </form>
            </div>
        </div>
    </body>

    </html>
<?php
    exit();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $product_id = intval($_POST['id']);
    $maNguoiDung = $_SESSION['maNguoiDung'] ?? null;

    try {
        if ($maNguoiDung) {
            // Người dùng đã đăng nhập, xóa sản phẩm khỏi DB
            $removeSuccess = remove_from_cart_db($maNguoiDung, $product_id);
            if ($removeSuccess) {
                $_SESSION['shopping_cart'] = get_cart_from_db($maNguoiDung);
                $_SESSION['success_remove'] = "Sản phẩm đã được xóa khỏi giỏ hàng.";
            } else {
                // Nếu hàm remove_from_cart_db trả về false, giả sử có lỗi kỹ thuật
                throw new Exception("Không thể xóa sản phẩm khỏi giỏ hàng.");
            }
        } else {
            // ** Xóa sản phẩm từ session mà không cần 'product_info'**
            $removeSuccess = remove_from_cart_session($product_id);
            if ($removeSuccess) {
                $_SESSION['success_remove'] = "Sản phẩm đã được xóa khỏi giỏ hàng.";
            } else {
                $_SESSION['errors'][] = "Sản phẩm không tồn tại trong giỏ hàng.";
            }
        }
    } catch (Exception $e) {
        // Xử lý lỗi kỹ thuật
        $_SESSION['errors'][] = "Lỗi. Vui lòng thử lại sau.";
    }

    // Chuyển hướng trở lại trang giỏ hàng
    header("Location: shopping_cart.php");
    exit();
} else {
    // Nếu không có dữ liệu GET hoặc POST hợp lệ
    $_SESSION['errors'][] = "Yêu cầu không hợp lệ.";
    header("Location: shopping_cart.php");
    exit();
}
?>