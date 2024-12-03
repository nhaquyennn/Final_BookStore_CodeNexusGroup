<?php
// Truy vấn lấy dữ liệu từ các bảng và thêm trường hinhAnh từ bảng dauap
$sql = "SELECT a.TenAnPham, a.Giathue, a.tinhTrang, d.TenDauAnPham AS TenDauAp, d.Tacgia, d.NXB, d.hinhAnh, d.ngayXB, dm.TenDanhMuc
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
?>