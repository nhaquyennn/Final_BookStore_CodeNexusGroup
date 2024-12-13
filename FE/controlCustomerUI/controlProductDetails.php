<?php
// controlCustomerUI/controlProductDetails.php

// Bắt đầu phiên làm việc nếu chưa bắt đầu
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Bao gồm kết nối cơ sở dữ liệu bằng đường dẫn tuyệt đối
include_once __DIR__ . '/../database/db_connect.php';

// Bao gồm các hàm giỏ hàng bằng đường dẫn tuyệt đối
include_once __DIR__ . '/../cart_functions.php';

// Kiểm tra xem id đã được truyền qua GET chưa
if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);

    // Truy vấn để lấy thông tin sản phẩm cùng với các liên kết
    $sql = "SELECT 
    a.maAnPham,
    a.TenAnPham,
    a.Giathue,
    a.tinhTrang,
    a.soLuongChoThue,
    a.soLuongTonKho,
    a.ngayXB,
    d.moTa AS moTa_dauap,
    d.TenDauAnPham,
    d.Tacgia,
    d.NXB,
    dm.TenDanhMuc,
    dm.MoTa AS MoTaDanhMuc,
    d.hinhAnh AS hinhAnh_dauap
            FROM anpham a
            INNER JOIN dauap d ON a.madauAP = d.madauAP
            INNER JOIN danhmucap dm ON d.MaDanhMuc = dm.MaDanhMuc
            WHERE a.maAnPham = ?";

    // Chuẩn bị câu truy vấn để tránh SQL Injection
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $product_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Kiểm tra xem sản phẩm có tồn tại không
        if (mysqli_num_rows($result) > 0) {
            $product = mysqli_fetch_assoc($result);
        } else {
            $product = null;
        }

        mysqli_stmt_close($stmt);
    } else {
        // Nếu câu truy vấn bị lỗi
        die("Lỗi truy vấn: " . mysqli_error($conn));
    }

    // Truy vấn các đánh giá từ bảng 'danhgia'
    $sql_reviews = "
        SELECT 
            d.id,
            d.maNguoiDung,
            n.tenNguoiDung,
            d.diemSo,
            d.binhLuan,
            d.hinhAnh,
            d.ngayDanhGia
        FROM 
            danhgia d
        INNER JOIN 
            nguoidung n ON d.maNguoiDung = n.maNguoiDung
        WHERE 
            d.maAnPham = ?
        ORDER BY 
            d.ngayDanhGia DESC
    ";

    $reviews = [];

    if ($stmt_reviews = mysqli_prepare($conn, $sql_reviews)) {
        mysqli_stmt_bind_param($stmt_reviews, "i", $product_id);
        mysqli_stmt_execute($stmt_reviews);
        $result_reviews = mysqli_stmt_get_result($stmt_reviews);
        while ($review = mysqli_fetch_assoc($result_reviews)) {
            $reviews[] = $review;
        }
        mysqli_stmt_close($stmt_reviews);
    } else {
        // Nếu câu truy vấn bị lỗi
        error_log("Lỗi truy vấn đánh giá: " . mysqli_error($conn));
    }

    // Tính toán $max_addable_quantity
    if ($product) {
        // Lấy giỏ hàng hiện tại
        $cart = get_cart();

        // Lấy sản phẩm đã có trong giỏ hàng
        $existing_product = get_product_by_id($cart, $product['maAnPham']);
        $existing_quantity_in_cart = $existing_product ? $existing_product['quantity'] : 0;

        // Tính số lượng tối đa có thể thêm
        $max_addable_quantity = $product['soLuongTonKho'] - $existing_quantity_in_cart;
        if ($max_addable_quantity < 1) {
            $max_addable_quantity = 0; // Không thể thêm thêm sản phẩm nào
        }

        // Lấy thông báo lỗi cho sản phẩm này, nếu có
        $quantity_error = '';
        $return_date_error = '';
        if (!empty($_SESSION['errors'][$product['maAnPham']])) {
            $errors = $_SESSION['errors'][$product['maAnPham']];
            if (!empty($errors['quantity'])) {
                $quantity_error = $errors['quantity'][0]; // Lấy lỗi đầu tiên cho quantity
            }
            if (!empty($errors['return_date'])) {
                $return_date_error = $errors['return_date'][0]; // Lấy lỗi đầu tiên cho return_date
            }
            // Bạn cũng có thể xử lý các lỗi khác nếu cần
            unset($_SESSION['errors'][$product['maAnPham']]);
        }
    } else {
        // Nếu sản phẩm không tồn tại
        $max_addable_quantity = 0;
        $existing_quantity_in_cart = 0;
        $quantity_error = '';
        $return_date_error = '';
    }
} else {
    // Nếu không có id trong GET
    $product = null;
    $reviews = [];
    $max_addable_quantity = 0;
    $existing_quantity_in_cart = 0;
    $quantity_error = '';
    $return_date_error = '';
}

// Đóng kết nối nếu chưa đóng (tùy chọn, thường được đóng ở cuối trang)




