<?php
// Kết nối cơ sở dữ liệu
$host = 'localhost';
$username = 'root';
$password = 'root';
$dbname = 'nexus_store';

$conn = mysqli_connect($host, $username, $password, $dbname);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}


// Thêm khuyến mãi
function themKhuyenMai($conn, $ten, $mota, $giamgia)
{
    $sql = "INSERT INTO khuyenmai (ten_khuyenmai, mota, giamgia) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $ten, $mota, $giamgia);
    $stmt->execute();
    echo "Thêm thành công!";
}

// Sửa khuyến mãi
function suaKhuyenMai($conn, $id, $ten, $mota, $giamgia)
{
    $sql = "UPDATE khuyenmai SET ten_khuyenmai = ?, mota = ?, giamgia = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $ten, $mota, $giamgia, $id);
    $stmt->execute();
    echo "Sửa thành công!";
}

// Xóa khuyến mãi
function xoaKhuyenMai($conn, $id)
{
    $sql = "DELETE FROM khuyenmai WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    echo "Xóa thành công!";
}

// Tìm kiếm khuyến mãi
function timKhuyenMai($conn, $keyword)
{
    $sql = "SELECT * FROM khuyenmai WHERE ten_khuyenmai LIKE ? OR mota LIKE ?";
    $stmt = $conn->prepare($sql);
    $search = "%" . $keyword . "%";
    $stmt->bind_param("ss", $search, $search);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row['id'] . " - Tên: " . $row['ten_khuyenmai'] . " - Mô tả: " . $row['mota'] . " - Giảm giá: " . $row['giamgia'] . "%<br>";
    }
}

// Ví dụ sử dụng
// Thêm khuyến mãi
// themKhuyenMai($conn, "Giảm giá mùa hè", "Giảm 20% cho mọi sản phẩm", 20);

// Sửa khuyến mãi
// suaKhuyenMai($conn, 1, "Giảm giá mùa đông", "Giảm 30% cho mọi sản phẩm", 30);

// Xóa khuyến mãi
// xoaKhuyenMai($conn, 1);

// Tìm kiếm khuyến mãi
// timKhuyenMai($conn, "mùa");

$conn->close();
