<?php
// update_cart.php

// Bắt đầu phiên làm việc và kết nối
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Bao gồm kết nối cơ sở dữ liệu và các hàm giỏ hàng
include_once 'database/db_connect.php';
include_once 'cart_functions.php';

// Kiểm tra nếu có dữ liệu từ POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_cart']) && isset($_POST['quantities']) && is_array($_POST['quantities'])) {
    $maNguoiDung = $_SESSION['maNguoiDung'] ?? null;
    $has_error = false; // Biến để theo dõi có lỗi hay không

    foreach ($_POST['quantities'] as $product_id => $quantity) {
        $product_id = intval($product_id);
        $quantity = intval($quantity);

        // Kiểm tra nếu người dùng không nhập số lượng
        if ($quantity < 1) {
            $_SESSION['errors'][] = "Vui lòng nhập số lượng cho sản phẩm ID: " . htmlspecialchars($product_id);
            $has_error = true;
            continue; // Bỏ qua việc xử lý sản phẩm này
        }

        // Lấy thông tin sản phẩm từ DB
        $product_info = get_product_info($product_id);

        if (!$product_info) {
            // Nếu sản phẩm không tồn tại
            $_SESSION['errors'][] = "Sản phẩm với ID: " . htmlspecialchars($product_id) . " không tồn tại.";
            $has_error = true;
            continue; // Bỏ qua việc xử lý sản phẩm này
        }

        $soLuongTonKho = intval($product_info['soLuongTonKho']);

        if ($quantity > $soLuongTonKho) {
            // Nếu số lượng yêu cầu vượt quá tồn kho
            $_SESSION['errors'][] = "Số lượng sản phẩm \"" . htmlspecialchars($product_info['TenAnPham']) . "\" không đủ. Số lượng tối đa có thể chọn là " . $soLuongTonKho . ".";
            $has_error = true;
            continue; // Bỏ qua việc cập nhật sản phẩm này
        }

        if ($quantity < 1) {
            // Nếu số lượng nhỏ hơn 1, xóa sản phẩm khỏi giỏ hàng
            if ($maNguoiDung) {
                if (remove_from_cart_db($maNguoiDung, $product_id)) {
                    $_SESSION['success_remove'] = "Một số sản phẩm đã được xóa khỏi giỏ hàng.";
                } else {
                    $_SESSION['errors'][] = "Không thể xóa sản phẩm \"" . htmlspecialchars($product_info['TenAnPham']) . " \" khỏi giỏ hàng.";
                    $has_error = true;
                }
            } else {
                if (remove_from_cart_session($product_id)) {
                    $_SESSION['success_remove'] = "Một số sản phẩm đã được xóa khỏi giỏ hàng.";
                } else {
                    $_SESSION['errors'][] = "Sản phẩm \"" . htmlspecialchars($product_info['TenAnPham']) . " \" không tồn tại trong giỏ hàng.";
                    $has_error = true;
                }
            }
        } else {
            // Cập nhật số lượng sản phẩm
            if ($maNguoiDung) {
                // Người dùng đã đăng nhập, cập nhật trong DB
                update_cart_db($maNguoiDung, $product_id, $quantity);
                $_SESSION['success_update'] = "Giỏ hàng đã được cập nhật.";
            } else {
                // Người dùng chưa đăng nhập, cập nhật trong session
                update_cart_session($product_id, $quantity);
                $_SESSION['success_update'] = "Giỏ hàng đã được cập nhật.";
            }
        }
    }

    if ($has_error) {
        // Nếu có lỗi, có thể tùy chỉnh thêm hành động
    }

    // Chuyển hướng trở lại trang giỏ hàng
    header("Location: shopping_cart.php");
    exit();
} else {
    // Nếu không có dữ liệu POST hợp lệ
    $_SESSION['errors'][] = "Yêu cầu không hợp lệ.";
    header("Location: shopping_cart.php");
    exit();
}
