<?php
require_once __DIR__ . '/../database/db_connect.php';

// Lấy danh sách tên danh mục
$sql_categories = "SELECT TenDanhMuc FROM danhmucap";
$result_categories = $conn->query($sql_categories);

$categories = [];
if ($result_categories && $result_categories->num_rows > 0) {
    while ($row = $result_categories->fetch_assoc()) {
        $categories[] = $row['TenDanhMuc'];
    }
} else {
    echo "Không thể lấy danh mục hoặc không có dữ liệu.";
}

// Lấy danh sách tác giả
$sql_authors = "SELECT DISTINCT Tacgia FROM dauap";
$result_authors = $conn->query($sql_authors);

$authors = [];
if ($result_authors && $result_authors->num_rows > 0) {
    while ($row = $result_authors->fetch_assoc()) {
        $authors[] = $row['Tacgia'];
    }
} else {
    echo "Không thể lấy tác giả hoặc không có dữ liệu.";
}

// Lấy danh sách NXB
$sql_publishers = "SELECT DISTINCT TRIM(REPLACE(NXB, 'NXB', '')) AS NXB FROM dauap";
$result_publishers = $conn->query($sql_publishers);

$publishers = [];
if ($result_publishers && $result_publishers->num_rows > 0) {
    while ($row = $result_publishers->fetch_assoc()) {
        $publishers[] = $row['NXB'];
    }
} else {
    echo "Không thể lấy NXB hoặc không có dữ liệu.";
}

//Lấy danh sách năm xuất bản
$sql_years = "SELECT DISTINCT YEAR(ngayXB) AS NamXB FROM anpham";
$result_years = $conn->query($sql_years);

$years = [];
if ($result_years && $result_years->num_rows > 0) {
    while ($row = $result_years->fetch_assoc()) {
        $years[] = $row['NamXB'];
    }
} else {
    echo "Không thể lấy năm xuất bản hoặc không có dữ liệu.";
}

//Lấy tổng số lượng ấn phẩm
$sql_total_dauap = "SELECT COUNT(*) AS TongSoLuong FROM dauap";
$result_total_dauap = $conn->query($sql_total_dauap);

$totalQuantity_dauap = 0;
if ($result_total_dauap && $result_total_dauap->num_rows > 0) {
    $row = $result_total_dauap->fetch_assoc();
    $totalQuantity_dauap = $row['TongSoLuong'];
} else {
    echo "Không thể lấy tổng số lượng hoặc không có dữ liệu.";
}

// Truy vấn lấy dữ liệu từ các bảng, chỉ lấy các sản phẩm có tinhTrang là "Mới"
$sql = "SELECT a.TenAnPham, a.Giathue, a.ngayXB, a.tinhTrang, d.TenDauAnPham AS TenDauAp, d.Tacgia, d.NXB, d.hinhAnh, dm.TenDanhMuc
        FROM anpham a
        INNER JOIN dauap d ON a.madauAP = d.madauAP
        INNER JOIN danhmucap dm ON d.MaDanhMuc = dm.MaDanhMuc
        WHERE a.tinhTrang = 'Mới'";  // Điều kiện lọc sản phẩm có tinhTrang là "Mới"

$result = $conn->query($sql);

$products = []; // Mảng lưu dữ liệu sản phẩm
$product_names = []; // Mảng dùng để kiểm tra tên sản phẩm đã xuất hiện chưa

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

?>