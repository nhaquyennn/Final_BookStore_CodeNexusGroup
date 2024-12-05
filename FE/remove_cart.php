<?php
// remove_cart.php

// Kích hoạt hiển thị lỗi PHP để dễ dàng debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Bắt đầu phiên làm việc để lưu trữ thông báo
session_start();

// Bao gồm kết nối cơ sở dữ liệu
include_once 'database/db_connect.php'; // Điều chỉnh đường dẫn nếu cần
include_once '../cart_functions.php';

// Kiểm tra nếu có dữ liệu từ POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $product_id = intval($_POST['id']);

    // Lấy giỏ hàng hiện tại
    if (isset($_SESSION['shopping_cart']) && is_array($_SESSION['shopping_cart'])) {
        $cart = $_SESSION['shopping_cart'];
    } else {
        $cart = [];
    }

    // Tìm và xóa sản phẩm khỏi giỏ hàng
    $found = false;
    foreach ($cart as $key => $item) {
        if ($item['id'] == $product_id) {
            unset($cart[$key]);
            $_SESSION['success_remove'] = "Sản phẩm \"" . htmlspecialchars($item['name']) . "\" đã được xóa khỏi giỏ hàng.";
            $found = true;
            break;
        }
    }

    if ($found) {
        // Lưu lại giỏ hàng sau khi xóa
        $_SESSION['shopping_cart'] = array_values($cart); // Reset các chỉ số mảng
    } else {
        $_SESSION['errors'][] = "Sản phẩm không tồn tại trong giỏ hàng.";
    }

    // Chuyển hướng trở lại trang giỏ hàng
    header("Location: shopping-cart.php");
    exit();
} else {
    // Nếu không có dữ liệu POST hợp lệ
    $_SESSION['errors'][] = "Yêu cầu không hợp lệ.";
    header("Location: shopping-cart.php");
    exit();
}
$maNguoiDung = $_SESSION['maNguoiDung'] ?? null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $maAnPham = $_POST['id'];

    if ($maNguoiDung) {
        // Xóa khỏi DB
        remove_from_cart_db($maNguoiDung, $maAnPham);
        // Cập nhật lại giỏ hàng trong session
        $_SESSION['shopping_cart'] = get_cart_from_db($maNguoiDung);
    } else {
        // Xóa khỏi session
        remove_from_cart_session($maAnPham);
    }
}

header("Location: ../shopping-cart.php");
exit();
