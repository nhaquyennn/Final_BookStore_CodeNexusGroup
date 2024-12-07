<?php
// update_cart.php

// Kích hoạt hiển thị lỗi PHP để dễ dàng debug (Chỉ nên sử dụng trong môi trường phát triển)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Bắt đầu phiên làm việc để lưu trữ thông báo
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Bao gồm kết nối cơ sở dữ liệu và các hàm giỏ hàng
include_once 'database/db_connect.php';
include_once 'cart_functions.php';

// Kiểm tra nếu có dữ liệu từ POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_cart']) && isset($_POST['quantities']) && is_array($_POST['quantities'])) {
    $maNguoiDung = $_SESSION['maNguoiDung'] ?? null;

    foreach ($_POST['quantities'] as $product_id => $quantity) {
        $product_id = intval($product_id);
        $quantity = intval($quantity);

        if ($quantity < 1) {
            // Nếu số lượng nhỏ hơn 1, xóa sản phẩm khỏi giỏ hàng
            if ($maNguoiDung) {
                if (remove_from_cart_db($maNguoiDung, $product_id)) {
                    $_SESSION['success_remove'] = "Một số sản phẩm đã được xóa khỏi giỏ hàng.";
                } else {
                    $_SESSION['errors'][] = "Không thể xóa sản phẩm với ID: " . htmlspecialchars($product_id);
                }
            } else {
                if (remove_from_cart_session($product_id)) {
                    $_SESSION['success_remove'] = "Một số sản phẩm đã được xóa khỏi giỏ hàng.";
                } else {
                    $_SESSION['errors'][] = "Sản phẩm không tồn tại trong giỏ hàng.";
                }
            }
        } else {
            // Cập nhật số lượng sản phẩm
            if ($maNguoiDung) {
                update_cart_db($maNguoiDung, $product_id, $quantity);
                $_SESSION['success_update'] = "Giỏ hàng đã được cập nhật.";
            } else {
                update_cart_session($product_id, $quantity);
                $_SESSION['success_update'] = "Giỏ hàng đã được cập nhật.";
            }
        }
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
