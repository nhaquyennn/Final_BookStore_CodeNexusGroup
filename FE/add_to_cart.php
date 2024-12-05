<?php
// add_to_cart.php

// Kích hoạt hiển thị lỗi PHP để dễ dàng debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Bắt đầu phiên làm việc để lưu trữ thông báo
session_start();

// Bao gồm kết nối cơ sở dữ liệu
include_once 'database/db_connect.php'; // Điều chỉnh đường dẫn nếu cần
include_once '../cart_functions.php';

// Hàm lấy thông tin sản phẩm từ cơ sở dữ liệu
function get_product_info($conn, $product_id)
{
    $sql = "SELECT 
                a.maAnPham,
                a.TenAnPham,
                a.Giathue,
                a.soLuongTonKho,
                d.hinhAnh AS hinhAnh_dauap
            FROM anpham a
            JOIN dauap d ON a.madauAP = d.madauAP
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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    // Lấy dữ liệu từ form
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    if ($product_id > 0 && $quantity > 0) {
        // Lấy thông tin sản phẩm từ cơ sở dữ liệu để kiểm tra số lượng tồn kho
        $product_info = get_product_info($conn, $product_id);

        if ($product_info) {
            // Kiểm tra xem số lượng yêu cầu có vượt quá tồn kho không
            if ($quantity > $product_info['soLuongTonKho']) {
                // Vượt quá tồn kho
                $_SESSION['errors'][$product_id] = "Số lượng yêu cầu cho sản phẩm \"" . htmlspecialchars($product_info['TenAnPham']) . "\" vượt quá tồn kho. Tồn kho hiện tại: " . htmlspecialchars($product_info['soLuongTonKho']) . ".";
            } else {
                // Lấy giỏ hàng hiện tại
                if (isset($_SESSION['shopping_cart']) && is_array($_SESSION['shopping_cart'])) {
                    $cart = $_SESSION['shopping_cart'];
                } else {
                    $cart = [];
                }

                $found = false;

                foreach ($cart as &$item) {
                    if ($item['id'] == $product_id) {
                        $found = true;
                        $new_quantity = $item['quantity'] + $quantity;
                        if ($new_quantity > $product_info['soLuongTonKho']) {
                            $_SESSION['errors'][$product_id] = "Tổng số lượng yêu cầu cho sản phẩm \"" . htmlspecialchars($product_info['TenAnPham']) . "\" vượt quá tồn kho. Tồn kho hiện tại: " . htmlspecialchars($product_info['soLuongTonKho']) . ".";
                        } else {
                            $item['quantity'] = $new_quantity;
                            $_SESSION['success_update'] = "Sản phẩm đã được cập nhật trong giỏ hàng.";
                        }
                        break;
                    }
                }
                unset($item); // Hủy tham chiếu

                if (!$found) {
                    // Thêm sản phẩm mới vào giỏ hàng
                    $cart[] = [
                        'id' => $product_id,
                        'name' => $product_info['TenAnPham'],
                        'price' => $product_info['Giathue'],
                        'image' => $product_info['hinhAnh_dauap'], // Sử dụng alias hinhAnh_dauap
                        'quantity' => $quantity,
                        'soLuongTonKho' => $product_info['soLuongTonKho']
                    ];
                    $_SESSION['success_update'] = "Sản phẩm đã được thêm vào giỏ hàng.";
                }

                // Lưu lại giỏ hàng vào session
                $_SESSION['shopping_cart'] = $cart;
            }
        } else {
            // Sản phẩm không tồn tại
            $_SESSION['errors'][$product_id] = "Sản phẩm không tồn tại.";
        }
    } else {
        // Dữ liệu không hợp lệ
        $_SESSION['errors'][] = "Dữ liệu sản phẩm không hợp lệ.";
    }

    // Chuyển hướng trở lại trang chi tiết sản phẩm với id để hiển thị thông báo
    header("Location: shop-details.php?id=" . $product_id);
    exit();
} else {
    // Nếu không phải là POST request hoặc không có dữ liệu add_to_cart
    header("Location: shop-grid.php");
    exit();
}
// Kiểm tra nếu người dùng đã đăng nhập
$maNguoiDung = $_SESSION['maNguoiDung'] ?? null;

// Lấy dữ liệu từ biểu mẫu
$maAnPham = $_POST['maAnPham'] ?? '';
$soLuong = $_POST['soLuong'] ?? 1;

if ($maAnPham && $soLuong) {
    if ($maNguoiDung) {
        // Người dùng đã đăng nhập, lưu vào DB
        add_to_cart_db($maNguoiDung, $maAnPham, $soLuong);
        // Cập nhật lại giỏ hàng trong session
        $_SESSION['shopping_cart'] = get_cart_from_db($maNguoiDung);
    } else {
        // Người dùng chưa đăng nhập, lưu vào session
        add_to_cart_session($maAnPham, $soLuong);
    }
}

header("Location: ../shopping-cart.php");
exit();
