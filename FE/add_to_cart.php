<?php
// add_to_cart.php

// Bắt đầu output buffering (tạm thời)


// Bắt đầu phiên làm việc nếu chưa bắt đầu
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Bao gồm cart_functions.php để sử dụng các hàm liên quan đến giỏ hàng
include_once 'database/db_connect.php';
include_once 'cart_functions.php';

// Xử lý thêm vào giỏ hàng
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    // Lấy dữ liệu từ form
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
    $return_date = isset($_POST['return_date']) ? trim($_POST['return_date']) : '';

    // Kiểm tra dữ liệu bắt buộc
    if ($product_id > 0 && $quantity > 0 && !empty($return_date)) {
        // Kiểm tra định dạng ngày trả sách
        $return_timestamp = strtotime($return_date);
        if (!$return_timestamp) {
            $_SESSION['errors'][] = "Ngày trả sách không hợp lệ.";
            header("Location: shop-details.php?id=" . $product_id);
            exit();
        }

        // Tính ngày hiện tại và ngày tối đa (15 ngày sau)
        $current_timestamp = time();
        $max_timestamp = strtotime("+15 days", $current_timestamp);

        // Kiểm tra ngày trả sách không vượt quá 15 ngày kể từ ngày hiện tại
        if ($return_timestamp > $max_timestamp) {
            $_SESSION['errors'][] = "Ngày trả sách không được vượt quá 15 ngày kể từ hôm nay.";
            header("Location: shop-details.php?id=" . $product_id);
            exit();
        }

        // Lấy thông tin sản phẩm từ cơ sở dữ liệu để kiểm tra số lượng tồn kho
        $product_info = get_product_info($product_id);

        if ($product_info) {
            // Kiểm tra xem số lượng yêu cầu có vượt quá tồn kho không
            if ($quantity > $product_info['soLuongTonKho']) {
                // Vượt quá tồn kho
                $_SESSION['errors'][$product_id] = "Số lượng yêu cầu cho sản phẩm \"" . htmlspecialchars($product_info['TenAnPham']) . "\" vượt quá tồn kho. Tồn kho hiện tại: " . htmlspecialchars($product_info['soLuongTonKho']) . ".";
            } else {
                // Thêm hoặc cập nhật sản phẩm trong giỏ hàng
                if (isset($_SESSION['maNguoiDung'])) {
                    // Người dùng đã đăng nhập, thêm vào DB với return_date
                    add_to_cart_db($_SESSION['maNguoiDung'], $product_id, $quantity, $return_date);
                    // Cập nhật lại giỏ hàng trong session từ DB
                    $_SESSION['shopping_cart'] = get_cart_from_db($_SESSION['maNguoiDung']);
                } else {
                    // Người dùng chưa đăng nhập, thêm vào session với return_date
                    add_to_cart_session($product_id, $quantity, $return_date);
                }
                $_SESSION['success_update'] = "Sản phẩm đã được thêm vào giỏ hàng.";
            }
        } else {
            // Sản phẩm không tồn tại
            $_SESSION['errors'][$product_id] = "Sản phẩm không tồn tại.";
        }
    } else {
        // Dữ liệu không hợp lệ hoặc thiếu trường return_date
        if (empty($return_date)) {
            $_SESSION['errors'][] = "Vui lòng chọn ngày trả sách.";
        } else {
            $_SESSION['errors'][] = "Dữ liệu sản phẩm không hợp lệ.";
        }
    }

    // Chuyển hướng trở lại trang chi tiết sản phẩm với id để hiển thị thông báo
    header("Location: shop-details.php?id=" . $product_id);
    exit();
} else {
    // Nếu không phải là POST request hoặc không có dữ liệu add_to_cart
    header("Location: shop-grid.php");
    exit();
}

// Kết thúc output buffering và gửi output
