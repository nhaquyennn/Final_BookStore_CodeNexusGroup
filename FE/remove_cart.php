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

// Kiểm tra phương thức yêu cầu
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
    $maNguoiDung = $_SESSION['maNguoiDung'] ?? null;

    // Lấy thông tin sản phẩm để hiển thị trong thông báo xác nhận
    if ($maNguoiDung) {
        $product = get_product_info($product_id); // Sử dụng hàm hiện có
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
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }

            .container {
                max-width: 500px;
                margin: 100px auto;
                padding: 20px;
                background: #fff;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                text-align: center;
            }

            .product-info {
                display: flex;
                align-items: center;
                margin-bottom: 20px;
            }

            .product-info img {
                width: 80px;
                height: 80px;
                object-fit: cover;
                margin-right: 20px;
                border: 1px solid #ddd;
                border-radius: 5px;
            }

            .buttons {
                display: flex;
                justify-content: space-around;
                margin-top: 20px;
            }

            .buttons form {
                width: 45%;
            }

            .buttons button {
                width: 100%;
                padding: 10px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
            }

            .confirm {
                background-color: #d9534f;
                color: #fff;
            }

            .cancel {
                background-color: #5bc0de;
                color: #fff;
            }

            .confirm:hover {
                background-color: #c9302c;
            }

            .cancel:hover {
                background-color: #31b0d5;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <h2>Xác Nhận Xóa Sản Phẩm</h2>
            <div class="product-info">
                <img src="img/products/<?php echo htmlspecialchars($product['hinhAnh_dauap'] ?? 'default.png'); ?>" alt="<?php echo htmlspecialchars($product['TenAnPham']); ?>">
                <div>
                    <h4><?php echo htmlspecialchars($product['TenAnPham']); ?></h4>
                    <p>Giá: <?php echo number_format($product['Giathue'], 0, ',', '.'); ?> VND</p>
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

    if ($maNguoiDung) {
        // Người dùng đã đăng nhập, xóa sản phẩm khỏi DB
        if (remove_from_cart_db($maNguoiDung, $product_id)) {
            $_SESSION['shopping_cart'] = get_cart_from_db($maNguoiDung);
            $_SESSION['success_remove'] = "Sản phẩm đã được xóa khỏi giỏ hàng.";
        } else {
            $_SESSION['errors'][] = "Không thể xóa sản phẩm khỏi giỏ hàng.";
        }
    } else {
        // Người dùng chưa đăng nhập, xóa sản phẩm khỏi session
        if (remove_from_cart_session($product_id)) {
            $_SESSION['success_remove'] = "Sản phẩm đã được xóa khỏi giỏ hàng.";
        } else {
            $_SESSION['errors'][] = "Sản phẩm không tồn tại trong giỏ hàng.";
        }
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