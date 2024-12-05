<?php
// cart_functions.php

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
function get_product_info($product_id)
{
    // Kết nối cơ sở dữ liệu
    include_once 'database/db_connect.php'; // Đảm bảo đường dẫn đúng
    $sql = "SELECT 
                a.maAnPham,
                a.TenAnPham,
                a.Giathue,
                a.soLuongTonKho,
                d.moTa AS moTa_dauap,
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
            mysqli_close($conn);
            return $product;
        } else {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return null;
        }
    } else {
        // Nếu câu truy vấn bị lỗi
        die("Lỗi truy vấn: " . mysqli_error($conn));
    }
}

// Hàm tính tổng tiền giỏ hàng
function calculate_total($cart)
{
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    return $total;
}
// Hàm lấy giỏ hàng từ DB
function get_cart_from_db($maNguoiDung)
{
    global $conn;
    $sql = "SELECT g.*, a.TenAnPham, a.Giathue, d.hinhAnh 
            FROM giohang g 
            JOIN anpham a ON g.maAnPham = a.maAnPham 
            JOIN dauap d ON a.madauAP = d.madauAP 
            WHERE g.maNguoiDung = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $maNguoiDung);
    $stmt->execute();
    $result = $stmt->get_result();
    $cart = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $cart;
}
// Hàm thêm vào giỏ hàng trong DB
function add_to_cart_db($maNguoiDung, $maAnPham, $soLuong)
{
    global $conn;
    // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
    $sql = "SELECT * FROM giohang WHERE maNguoiDung = ? AND maAnPham = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $maNguoiDung, $maAnPham);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Cập nhật số lượng
        $sql_update = "UPDATE giohang SET SoLuong = SoLuong + ? WHERE maNguoiDung = ? AND maAnPham = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("iii", $soLuong, $maNguoiDung, $maAnPham);
        $stmt_update->execute();
        $stmt_update->close();
    } else {
        // Thêm mới
        $sql_insert = "INSERT INTO giohang (maNguoiDung, maAnPham, SoLuong) VALUES (?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("iii", $maNguoiDung, $maAnPham, $soLuong);
        $stmt_insert->execute();
        $stmt_insert->close();
    }
    $stmt->close();
}
// Hàm cập nhật giỏ hàng trong DB
function update_cart_db($maNguoiDung, $maAnPham, $soLuong)
{
    global $conn;
    if ($soLuong > 0) {
        $sql = "UPDATE giohang SET SoLuong = ? WHERE maNguoiDung = ? AND maAnPham = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii", $soLuong, $maNguoiDung, $maAnPham);
        $stmt->execute();
        $stmt->close();
    } else {
        // Nếu số lượng <= 0, xóa sản phẩm khỏi giỏ hàng
        remove_from_cart_db($maNguoiDung, $maAnPham);
    }
}
// Hàm xóa sản phẩm khỏi giỏ hàng trong DB
function remove_from_cart_db($maNguoiDung, $maAnPham)
{
    global $conn;
    $sql = "DELETE FROM giohang WHERE maNguoiDung = ? AND maAnPham = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $maNguoiDung, $maAnPham);
    $stmt->execute();
    $stmt->close();
}
// Hàm lấy giỏ hàng từ session
function get_cart_from_session()
{
    return $_SESSION['shopping_cart'] ?? [];
}
// Hàm thêm vào giỏ hàng trong session
function add_to_cart_session($maAnPham, $soLuong)
{
    if (isset($_SESSION['shopping_cart'])) {
        $cart = $_SESSION['shopping_cart'];
    } else {
        $cart = [];
    }

    $found = false;
    foreach ($cart as &$item) {
        if ($item['id'] == $maAnPham) {
            $item['quantity'] += $soLuong;
            $found = true;
            break;
        }
    }
    unset($item);

    if (!$found) {
        // Bạn cần truy vấn thông tin sản phẩm từ DB để thêm vào session
        global $conn;
        $sql = "SELECT a.*, d.hinhAnh 
                FROM anpham a 
                JOIN dauap d ON a.madauAP = d.madauAP 
                WHERE a.maAnPham = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $maAnPham);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
            $cart[] = [
                'id' => $product['maAnPham'],
                'name' => $product['TenAnPham'],
                'price' => $product['Giathue'],
                'image' => $product['hinhAnh'],
                'quantity' => $soLuong,
                'soLuongTonKho' => $product['soLuongTonKho']
            ];
        }
        $stmt->close();
    }

    $_SESSION['shopping_cart'] = $cart;
}
// Hàm cập nhật giỏ hàng trong session
function update_cart_session($maAnPham, $soLuong)
{
    if (isset($_SESSION['shopping_cart'])) {
        foreach ($_SESSION['shopping_cart'] as &$item) {
            if ($item['id'] == $maAnPham) {
                if ($soLuong > 0) {
                    $item['quantity'] = $soLuong;
                } else {
                    // Xóa sản phẩm nếu số lượng <= 0
                    unset($item);
                }
                break;
            }
        }
        unset($item);
        $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
    }
}
function remove_from_cart_session($maAnPham)
{
    if (isset($_SESSION['shopping_cart'])) {
        foreach ($_SESSION['shopping_cart'] as $key => $item) {
            if ($item['id'] == $maAnPham) {
                unset($_SESSION['shopping_cart'][$key]);
                break;
            }
        }
        // Reset lại chỉ số mảng để tránh các lỗ hổng khi xóa phần tử
        $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
    }
}
// Hàm lấy thông báo và lỗi từ session
function get_messages()
{
    $messages = [];

    if (isset($_SESSION['errors'])) {
        $messages['errors'] = $_SESSION['errors'];
    }

    if (isset($_SESSION['success_update'])) {
        $messages['success_update'] = $_SESSION['success_update'];
    }

    if (isset($_SESSION['success_remove'])) {
        $messages['success_remove'] = $_SESSION['success_remove'];
    }

    return $messages;
}

// Hàm xóa thông báo sau khi đã lấy
function clear_messages()
{
    unset($_SESSION['errors']);
    unset($_SESSION['success_update']);
    unset($_SESSION['success_remove']);
}

// Hàm lấy sản phẩm trong giỏ hàng theo ID
function get_product_by_id($cart, $product_id)
{
    foreach ($cart as $item) {
        if ($item['id'] == $product_id) {
            return $item;
        }
    }
    return null;
}
// ...lá ghi
