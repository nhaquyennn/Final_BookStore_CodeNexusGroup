<?php
function getAllCategories($conn)
{
    $query = "SELECT DISTINCT TenDanhMuc FROM danhmucap";
    $result = mysqli_query($conn, $query);
    $categories = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row['TenDanhMuc'];
    }
    return $categories;
}

function getAllAuthors($conn)
{
    $query = "SELECT DISTINCT Tacgia FROM dauap";
    $result = mysqli_query($conn, $query);
    $authors = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $authors[] = $row['Tacgia'];
    }
    return $authors;
}

function getAllPublishers($conn)
{
    $query = "SELECT DISTINCT TRIM(REPLACE(NXB, 'NXB', '')) AS NXB FROM dauap";
    $result = mysqli_query($conn, $query);
    $publishers = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $publishers[] = $row['NXB'];
    }
    return $publishers;
}

function getAllPublishYears($conn)
{
    $query = "SELECT DISTINCT YEAR(ngayXB) AS NamXB FROM dauap";
    $result = mysqli_query($conn, $query);
    $years = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $years[] = $row['NamXB'];
    }
    return $years;
}

function getAllRentalPrices($conn)
{
    // Truy vấn lấy các giá trị giá thuê không trùng lặp
    $query = "SELECT Giathue FROM anpham";

    // Thực thi truy vấn
    $result = mysqli_query($conn, $query);

    // Mảng để lưu các giá thuê
    $rentalPrices = [];

    // Lặp qua kết quả truy vấn và thêm giá thuê vào mảng
    while ($row = mysqli_fetch_assoc($result)) {
        $rentalPrices[] = $row['Giathue'];
    }

    // Trả về mảng giá thuê
    return $rentalPrices;
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
?>