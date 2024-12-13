<?php
function filterProducts($conn, $params)
{
    // Chỉ định cột cần lấy, bao gồm TenDauAnPham và Giathue
    $query = "  SELECT anpham.maAnPham, anpham.TenAnPham, anpham.tinhTrang, anpham.Giathue, danhmucap.TenDanhMuc, dauap.hinhAnh
            FROM dauap 
            JOIN danhmucap ON dauap.MaDanhMuc = danhmucap.MaDanhMuc 
            JOIN anpham ON dauap.madauAP = anpham.madauAP 
            WHERE 1=1";

    $conditions = [];

    // Lọc theo danh mục
    if (!empty($params['category'])) {
        $conditions[] = "danhmucap.TenDanhMuc = '" . mysqli_real_escape_string($conn, $params['category']) . "'";
    }

    // Lọc theo khoảng giá
    if (isset($params['min_price']) && isset($params['max_price'])) {
        $minPrice = floatval($params['min_price']);
        $maxPrice = floatval($params['max_price']);

        if ($minPrice <= $maxPrice) {
            $conditions[] = "anpham.Giathue BETWEEN $minPrice AND $maxPrice";
        }
    }


    // Lọc theo tác giả
    if (!empty($params['author'])) {
        $conditions[] = "dauap.Tacgia = '" . mysqli_real_escape_string($conn, $params['author']) . "'";
    }

    // Lọc theo nhà xuất bản
    if (!empty($params['publisher'])) {
        $publisher = mysqli_real_escape_string($conn, $params['publisher']);
        $conditions[] = "TRIM(REPLACE(dauap.NXB, 'NXB', '')) = '" . $publisher . "'";
    }

    // Lọc theo năm xuất bản
    if (!empty($params['year'])) {
        $conditions[] = "YEAR(anpham.ngayXB) = " . intval($params['year']);
    }

    // Thêm điều kiện vào query
    if (!empty($conditions)) {
        $query .= " AND " . implode(" AND ", $conditions);
    }

    // Sắp xếp
    if (!empty($params['sort'])) {
        switch ($params['sort']) {
            case 'low_to_high':
                $query .= " ORDER BY anpham.Giathue ASC";
                break;
            case 'high_to_low':
                $query .= " ORDER BY anpham.Giathue DESC";
                break;
        }
    }

    $result = mysqli_query($conn, $query);
    $products = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }

    return $products;
}
?>