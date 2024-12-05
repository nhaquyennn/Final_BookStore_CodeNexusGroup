<?php
// controlCustomerUI/controlShopGrid.php

// Bao gồm kết nối cơ sở dữ liệu
require_once 'database/db_connect.php'; // Điều chỉnh đường dẫn nếu cần

// Truy vấn lấy dữ liệu từ các bảng và thêm trường moTa từ bảng dauap
$sql = "SELECT 
            a.TenAnPham, 
            a.Giathue, 
            a.maAnPham, 
            a.tinhTrang, 
            d.TenDauAnPham AS TenDauAp, 
            d.Tacgia, 
            d.NXB, 
            d.hinhAnh, 
            d.ngayXB, 
            dm.TenDanhMuc,
            d.moTa
        FROM anpham a
        INNER JOIN dauap d ON a.madauAP = d.madauAP
        INNER JOIN danhmucap dm ON d.MaDanhMuc = dm.MaDanhMuc";

$result = $conn->query($sql);

$products = [];
$product_names = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Kiểm tra nếu sản phẩm chưa được thêm vào mảng $product_names
        if (!in_array($row['TenAnPham'], $product_names)) {
            // Thêm tên sản phẩm vào mảng kiểm tra
            $product_names[] = $row['TenAnPham'];
            // Thêm sản phẩm vào mảng $products
            $products[] = $row;
        }
    }
} else {
    $products = []; // Không có dữ liệu
}

// Lấy danh sách tác giả
$query_authors = "SELECT DISTINCT Tacgia FROM dauap";
$result_authors = mysqli_query($conn, $query_authors);

$authors = [];
if ($result_authors) {
    while ($row = mysqli_fetch_assoc($result_authors)) {
        $authors[] = $row['Tacgia'];
    }
    mysqli_free_result($result_authors);
} else {
    die("Lỗi truy vấn tác giả: " . mysqli_error($conn));
}

// Lấy danh sách nhà xuất bản
$query_publishers = "SELECT DISTINCT NXB FROM dauap";
$result_publishers = mysqli_query($conn, $query_publishers);

$publishers = [];
if ($result_publishers) {
    while ($row = mysqli_fetch_assoc($result_publishers)) {
        $publishers[] = $row['NXB'];
    }
    mysqli_free_result($result_publishers);
} else {
    die("Lỗi truy vấn nhà xuất bản: " . mysqli_error($conn));
}

// Lấy danh sách năm xuất bản
$query_years = "SELECT DISTINCT YEAR(ngayXB) AS Year FROM dauap ORDER BY Year DESC";
$result_years = mysqli_query($conn, $query_years);

$years = [];
if ($result_years) {
    while ($row = mysqli_fetch_assoc($result_years)) {
        $years[] = $row['Year'];
    }
    mysqli_free_result($result_years);
} else {
    die("Lỗi truy vấn năm xuất bản: " . mysqli_error($conn));
}

// Lấy danh sách sản phẩm mới
$query_new_products = "
    SELECT 
        a.maAnPham, 
        a.TenAnPham, 
        a.Giathue, 
        d.hinhAnh
    FROM anpham a
    JOIN dauap d ON a.madauAP = d.madauAP
    WHERE a.tinhTrang = 'Mới'
    ORDER BY a.maAnPham DESC
    LIMIT 6
";
$result_new_products = mysqli_query($conn, $query_new_products);

$new_products = []; // Sử dụng biến khác để tránh ghi đè $products
if ($result_new_products) {
    while ($row = mysqli_fetch_assoc($result_new_products)) {
        $new_products[] = [
            'maAnPham' => $row['maAnPham'],
            'TenAnPham' => $row['TenAnPham'],
            'Giathue' => $row['Giathue'],
            'hinhAnh' => $row['hinhAnh']
        ];
    }
    mysqli_free_result($result_new_products);
} else {
    die("Lỗi truy vấn sản phẩm mới: " . mysqli_error($conn));
}

// Lấy danh sách tất cả sản phẩm để hiển thị trong main grid
$where_clauses = [];

// Lấy các tham số lọc từ GET
if (isset($_GET['category']) && !empty($_GET['category'])) {
    $category = mysqli_real_escape_string($conn, $_GET['category']);
    $where_clauses[] = "dm.TenDanhMuc = '$category'";
}

if (isset($_GET['author']) && !empty($_GET['author'])) {
    $author = mysqli_real_escape_string($conn, $_GET['author']);
    $where_clauses[] = "d.Tacgia = '$author'";
}

if (isset($_GET['publisher']) && !empty($_GET['publisher'])) {
    $publisher = mysqli_real_escape_string($conn, $_GET['publisher']);
    $where_clauses[] = "d.NXB = '$publisher'";
}

if (isset($_GET['year']) && !empty($_GET['year'])) {
    $year = intval($_GET['year']);
    $where_clauses[] = "YEAR(d.ngayXB) = $year";
}

if (isset($_GET['min_price']) && is_numeric($_GET['min_price'])) {
    $min_price = floatval($_GET['min_price']);
    $where_clauses[] = "a.Giathue >= $min_price";
}

if (isset($_GET['max_price']) && is_numeric($_GET['max_price'])) {
    $max_price = floatval($_GET['max_price']);
    $where_clauses[] = "a.Giathue <= $max_price";
}

// Xây dựng câu lệnh SQL
$sql_products = "
    SELECT 
        a.maAnPham, 
        d.TenDauAnPham, 
        a.TenAnPham, 
        a.Giathue, 
        d.hinhAnh
    FROM anpham a
    JOIN dauap d ON a.madauAP = d.madauAP
";

if (!empty($where_clauses)) {
    $sql_products .= " WHERE " . implode(" AND ", $where_clauses);
}

// Xử lý sắp xếp
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'default';
switch ($sort) {
    case 'price_low_high':
        $sql_products .= " ORDER BY a.Giathue ASC";
        break;
    case 'price_high_low':
        $sql_products .= " ORDER BY a.Giathue DESC";
        break;
    default:
        $sql_products .= " ORDER BY a.maAnPham DESC";
        break;
}

// Thực thi truy vấn
$result_all_products = mysqli_query($conn, $sql_products);

$all_products = [];
if ($result_all_products) {
    while ($row = mysqli_fetch_assoc($result_all_products)) {
        $all_products[] = [
            'maAnPham' => $row['maAnPham'],
            'TenDauAnPham' => $row['TenDauAnPham'],
            'TenAnPham' => $row['TenAnPham'],
            'Giathue' => $row['Giathue'],
            'hinhAnh' => $row['hinhAnh']
        ];
    }
    mysqli_free_result($result_all_products);
} else {
    die("Lỗi truy vấn sản phẩm: " . mysqli_error($conn));
}

// Lấy tổng số lượng sản phẩm
$query_total_products = "SELECT COUNT(*) AS total FROM anpham a JOIN dauap d ON a.madauAP = d.madauAP";
if (!empty($where_clauses)) {
    $query_total_products .= " WHERE " . implode(" AND ", $where_clauses);
}
$result_total_products = mysqli_query($conn, $query_total_products);

$totalQuantity_dauap = 0;
if ($result_total_products) {
    $row = mysqli_fetch_assoc($result_total_products);
    $totalQuantity_dauap = $row['total'];
    mysqli_free_result($result_total_products);
} else {
    die("Lỗi truy vấn tổng số lượng sản phẩm: " . mysqli_error($conn));
}
