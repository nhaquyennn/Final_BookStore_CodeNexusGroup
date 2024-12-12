<?php
// controlCustomerUI/controlProductDetails.php

// Bắt đầu phiên làm việc nếu chưa bắt đầu
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Bao gồm kết nối cơ sở dữ liệu
include_once 'database/db_connect.php';

// Kiểm tra xem id đã được truyền qua GET chưa
if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);

    // Truy vấn để lấy thông tin sản phẩm cùng với tác giả, nhà xuất bản và danh mục từ các bảng liên kết
    $sql = "SELECT 
                a.maAnPham,
                a.TenAnPham,
                a.Giathue,
                a.tinhTrang,
                a.soLuongChoThue,
                a.soLuongTonKho,
                d.moTa AS moTa_dauap,
                d.TenDauAnPham,
                d.Tacgia,
                d.NXB,
                dm.TenDanhMuc,
                dm.MoTa AS MoTaDanhMuc,
                d.ngayXB,
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
} else {
    // Nếu không có id trong GET
    $product = null;
}
