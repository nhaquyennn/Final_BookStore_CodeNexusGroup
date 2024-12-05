<?php
// update_cart.php

// Kích hoạt hiển thị lỗi PHP để dễ dàng debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Bắt đầu phiên làm việc để lưu trữ thông báo
session_start();

// Bao gồm kết nối cơ sở dữ liệu
include_once 'database/db_connect.php'; // Điều chỉnh đường dẫn nếu cần
include_once '../cart_functions.php';

// Hàm lấy giỏ hàng từ session
function get_cart()
{
    if (isset($_SESSION['shopping_cart']) && is_array($_SESSION['shopping_cart'])) {
        return $_SESSION['shopping_cart'];
    } else {
        return [];
    }
}

// Hàm lưu giỏ hàng vào session
function save_cart($cart)
{
    $_SESSION['shopping_cart'] = $cart;
}

// Hàm lấy thông tin sản phẩm từ cơ sở dữ liệu
function get_product_info($conn, $product_id)
{
    $sql = "SELECT 
                a.maAnPham,
                a.TenAnPham,
                a.Giathue,
                a.soLuongTonKho
            FROM anpham a
            WHERE a.maAnPham = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $product_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $product = mysqli_fetch_assoc($result);
            mysqli_stmt_close($stmt);
            return $product;
        } else {
            mysqli_stmt_close($stmt);
            return null;
        }
    } else {
        die("Lỗi chuẩn bị câu truy vấn: " . mysqli_error($conn));
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['quantity']) && is_array($_POST['quantity'])) {
        $cart = get_cart();
        $errors = [];

        // Lặp qua các sản phẩm trong giỏ hàng
        foreach ($_POST['quantity'] as $product_id => $new_quantity) {
            $product_id = intval($product_id);
            $new_quantity = intval($new_quantity);

            // Lấy thông tin sản phẩm từ cơ sở dữ liệu
            $product_info = get_product_info($conn, $product_id);

            if ($product_info) {
                // Kiểm tra số lượng mới có hợp lệ không
                if ($new_quantity > 0) {
                    if ($new_quantity <= $product_info['soLuongTonKho']) {
                        // Cập nhật số lượng trong giỏ hàng
                        foreach ($cart as &$item) {
                            if ($item['id'] == $product_id) {
                                $item['quantity'] = $new_quantity;
                                // Cập nhật lại soLuongTonKho từ cơ sở dữ liệu nếu cần
                                $item['soLuongTonKho'] = $product_info['soLuongTonKho'];
                                break;
                            }
                        }
                        unset($item); // Hủy tham chiếu
                    } else {
                        // Số lượng yêu cầu vượt quá tồn kho
                        $errors[$product_id] = "Số lượng yêu cầu cho sản phẩm \"" . htmlspecialchars($product_info['TenAnPham']) . "\" vượt quá tồn kho. Tồn kho hiện tại: " . htmlspecialchars($product_info['soLuongTonKho']) . ".";
                    }
                } else {
                    // Số lượng không hợp lệ
                    $errors[$product_id] = "Số lượng không hợp lệ cho sản phẩm \"" . htmlspecialchars($product_info['TenAnPham']) . "\".";
                }
            } else {
                // Sản phẩm không tồn tại
                $errors[$product_id] = "Sản phẩm không tồn tại trong giỏ hàng.";
            }
        }

        if (!empty($errors)) {
            // Lưu lỗi vào session
            $_SESSION['errors'] = $errors;

            // Lưu lại giỏ hàng đã cập nhật (có thể bao gồm các thay đổi)
            save_cart($cart);

            // Chuyển hướng lại trang giỏ hàng để hiển thị lỗi
            header("Location: shopping-cart.php");
            exit();
        } else {
            // Nếu không có lỗi, cập nhật giỏ hàng và hiển thị thông báo thành công
            save_cart($cart);
            $_SESSION['success_update'] = "Giỏ hàng đã được cập nhật thành công.";
            header("Location: shopping-cart.php");
            exit();
        }
    } else {
        // Nếu không có dữ liệu quantity trong POST
        $_SESSION['errors'] = ["Không có sản phẩm nào để cập nhật."];
        header("Location: shopping-cart.php");
        exit();
    }
} else {
    // Nếu không phải là POST request
    $_SESSION['errors'] = ["Phương thức yêu cầu không hợp lệ."];
    header("Location: shopping-cart.php");
    exit();
}
$maNguoiDung = $_SESSION['maNguoiDung'] ?? null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quantity'])) {
    $quantities = $_POST['quantity'];

    foreach ($quantities as $maAnPham => $soLuong) {
        if ($maNguoiDung) {
            // Cập nhật trong DB
            update_cart_db($maNguoiDung, $maAnPham, $soLuong);
        } else {
            // Cập nhật trong session
            update_cart_session($maAnPham, $soLuong);
        }
    }

    // Cập nhật lại giỏ hàng trong session nếu đã đăng nhập
    if ($maNguoiDung) {
        $_SESSION['shopping_cart'] = get_cart_from_db($maNguoiDung);
    }
}

header("Location: ../shopping-cart.php");
exit();
