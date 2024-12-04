<?php
require_once __DIR__ . '/../database/db_connect.php';

// Lấy danh sách tên danh mục và hình ảnh
$sql_categories = "SELECT DISTINCT TenDanhMuc, image FROM danhmucap;";
$result_categories = $conn->query($sql_categories);

$categories_name_only = []; // Mảng chỉ chứa tên danh mục
$categories_with_image = []; // Mảng chứa tên và hình ảnh

if ($result_categories && $result_categories->num_rows > 0) {
    while ($row = $result_categories->fetch_assoc()) {
        // Lưu tên danh mục vào mảng chỉ chứa tên
        $categories_name_only[] = $row['TenDanhMuc'];

        // Lưu tên và hình ảnh vào mảng chứa tên và hình ảnh
        $categories_with_image[] = [
            'TenDanhMuc' => $row['TenDanhMuc'],
            'image' => $row['image']
        ];
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
$sql_years = "SELECT DISTINCT YEAR(ngayXB) AS NamXB FROM dauap";
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
$sql_new = "SELECT a.TenAnPham, a.Giathue, a.tinhTrang, d.TenDauAnPham AS TenDauAp, d.Tacgia, d.NXB, d.hinhAnh, d.ngayXB, dm.TenDanhMuc
        FROM anpham a
        INNER JOIN dauap d ON a.madauAP = d.madauAP
        INNER JOIN danhmucap dm ON d.MaDanhMuc = dm.MaDanhMuc
        WHERE a.tinhTrang = 'Mới'";  // Điều kiện lọc sản phẩm có tinhTrang là "Mới"

$result_new = $conn->query($sql_new);

$products_new = []; // Mảng lưu dữ liệu sản phẩm
$product_names_new = []; // Mảng dùng để kiểm tra tên sản phẩm đã xuất hiện chưa

if ($result_new && $result_new->num_rows > 0) {
    while ($row = $result_new->fetch_assoc()) {
        // Kiểm tra nếu sản phẩm chưa được thêm vào mảng $product_names
        if (!in_array($row['TenAnPham'], $product_names_new)) {
            // Thêm tên sản phẩm vào mảng kiểm tra
            $product_names_new[] = $row['TenAnPham'];
            // Thêm sản phẩm vào mảng $products
            $products_new[] = $row;
        }
    }
} else {
    $products_new = []; // Không có dữ liệu
}

// Truy vấn để lấy những ấn phẩm có số lượng cho thuê lớn
$sql_high_rental_count = "SELECT a.soLuongChoThue, a.TenAnPham, a.Giathue, a.tinhTrang, d.TenDauAnPham AS TenDauAp, d.Tacgia, d.NXB, d.hinhAnh, d.ngayXB, dm.TenDanhMuc
        FROM anpham a
        INNER JOIN dauap d ON a.madauAP = d.madauAP
        INNER JOIN danhmucap dm ON d.MaDanhMuc = dm.MaDanhMuc 
        WHERE a.soLuongChoThue > 0 
        ORDER BY a.soLuongChoThue DESC";
$result_high_rental_count = $conn->query($sql_high_rental_count);


$products_high_rental_count = []; // Mảng lưu dữ liệu sản phẩm
$product_name_high_rental_count = []; // Mảng dùng để kiểm tra tên sản phẩm đã xuất hiện chưa

if ($result_high_rental_count && $result_high_rental_count->num_rows > 0) {
    while ($row = $result_high_rental_count->fetch_assoc()) {
        if (!in_array($row['TenAnPham'], $product_name_high_rental_count)) {
            $product_name_high_rental_count[] = $row['TenAnPham'];
            $products_high_rental_count[] = $row;
        }
    }
} else {
    $products_high_rental_count = []; // Không có dữ liệu
}

// Truy vấn lấy dữ liệu từ các bảng và thêm trường hinhAnh từ bảng dauap
$sql_popular = "SELECT a.TenAnPham, a.Giathue, a.maAnPham, a.tinhTrang, d.TenDauAnPham AS TenDauAp, d.Tacgia, d.NXB, d.hinhAnh, d.ngayXB, dm.TenDanhMuc, a.soLuongTonKho
        FROM anpham a
        INNER JOIN dauap d ON a.madauAP = d.madauAP
        INNER JOIN danhmucap dm ON d.MaDanhMuc = dm.MaDanhMuc
        WHERE a.soLuongTonKho >= 100";

$result_popular = $conn->query($sql_popular);

$product_popular = [];
$checkedProducts = [];

if ($result_popular && $result_popular->num_rows > 0) {
    while ($productData = $result_popular->fetch_assoc()) {
        // Kiểm tra nếu sản phẩm chưa được thêm vào mảng $checkedProducts
        if (!in_array($productData['TenAnPham'], $checkedProducts)) {
            // Thêm tên sản phẩm vào mảng kiểm tra
            $checkedProducts[] = $productData['TenAnPham'];
            // Thêm sản phẩm vào mảng $productList
            $product_popular[] = $productData;
        }
    }
} else {
    $product_popular = []; // Không có dữ liệu
}


