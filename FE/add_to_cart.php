<?php
// add_to_cart.php

// Bắt đầu phiên làm việc nếu chưa bắt đầu
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Bao gồm kết nối cơ sở dữ liệu và các hàm liên quan đến giỏ hàng
include_once 'database/db_connect.php';
include_once 'cart_functions.php';

// Kiểm tra nếu form đã được gửi qua phương thức POST và có thuộc tính 'add_to_cart'
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    // Lấy dữ liệu từ form và làm sạch dữ liệu
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
    $return_date = isset($_POST['return_date']) ? trim($_POST['return_date']) : '';

    // Khởi tạo mảng lỗi với cấu trúc phân loại theo trường
    $errors = [
        'product' => [],
        'quantity' => [],
        'return_date' => []
    ];

    // Kiểm tra dữ liệu bắt buộc
    if ($product_id <= 0) {
        $errors['product'][] = "Sản phẩm không hợp lệ.";
    }
    if ($quantity <= 0) {
        $errors['quantity'][] = "Số lượng phải lớn hơn 0.";
    }
    if (empty($return_date)) {
        $errors['return_date'][] = "Vui lòng chọn ngày trả sách.";
    }

    if ($product_id > 0 && $quantity > 0 && !empty($return_date)) {
        // Kiểm tra định dạng ngày trả sách
        $return_timestamp = strtotime($return_date);
        if (!$return_timestamp) {
            $errors['return_date'][] = "Ngày trả sách không hợp lệ.";
        }

        // Tính ngày hiện tại và ngày tối đa (15 ngày sau)
        $current_timestamp = time();
        $max_timestamp = strtotime("+15 days", $current_timestamp);

        // Kiểm tra ngày trả sách không vượt quá 15 ngày kể từ ngày hiện tại
        if ($return_timestamp > $max_timestamp) {
            $errors['return_date'][] = "Ngày trả sách không được vượt quá 15 ngày kể từ hôm nay.";
        }

        // Nếu không có lỗi về ngày, tiếp tục kiểm tra số lượng tồn kho
        if (empty($errors['return_date'])) {
            // Lấy thông tin sản phẩm từ cơ sở dữ liệu
            $product_info = get_product_info($product_id);

            if ($product_info) {
                $soLuongTonKho = intval($product_info['soLuongTonKho']);
                $tenAnPham = htmlspecialchars($product_info['TenAnPham']);

                // Lấy giỏ hàng hiện tại
                if (isset($_SESSION['maNguoiDung'])) {
                    // Người dùng đã đăng nhập, lấy giỏ hàng từ DB
                    $maNguoiDung = $_SESSION['maNguoiDung'];
                    $cart = get_cart_from_db($maNguoiDung);
                } else {
                    // Người dùng chưa đăng nhập, lấy giỏ hàng từ session
                    $cart = isset($_SESSION['shopping_cart']) ? $_SESSION['shopping_cart'] : [];
                }

                // Lấy số lượng đã có trong giỏ hàng
                $existing_product = get_product_by_id($cart, $product_id);
                $existing_quantity_in_cart = $existing_product ? intval($existing_product['quantity']) : 0;

                // Tính số lượng tối đa có thể thêm
                $max_addable_quantity = $soLuongTonKho - $existing_quantity_in_cart;
                if ($max_addable_quantity <= 0) {
                    $errors['product'][] = "Sản phẩm \"$tenAnPham\" hiện không còn trong kho.";
                } elseif ($quantity > $max_addable_quantity) {
                    $errors['quantity'][] = "Số lượng bạn chọn cho sản phẩm \"$tenAnPham\" vượt quá số lượng hiện tại. Bạn chỉ có thể thêm tối đa $max_addable_quantity cuốn.";
                }
            } else {
                // Sản phẩm không tồn tại
                $errors['product'][] = "Sản phẩm không tồn tại.";
            }
        }
    }

    // Loại bỏ các nhóm lỗi mà không có lỗi thực sự
    foreach ($errors as $field => $field_errors) {
        if (empty($field_errors)) {
            unset($errors[$field]);
        }
    }

    // Nếu không có lỗi, tiến hành thêm vào giỏ hàng
    if (empty($errors)) {
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
    } else {
        // Nếu có lỗi, thiết lập thông báo lỗi trong session theo cấu trúc phân loại
        $_SESSION['errors'][$product_id] = $errors;
    }

    // Chuyển hướng trở lại trang chi tiết sản phẩm với id để hiển thị thông báo
    header("Location: shop-details.php?id=" . urlencode($product_id));
    exit();
} else {
    // Nếu không phải là POST request hoặc không có dữ liệu add_to_cart
    header("Location: shop-grid.php");
    exit();
}
