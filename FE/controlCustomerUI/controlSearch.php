<?php
session_start();
require_once __DIR__ . '/../database/db_connect.php'; // Kết nối cơ sở dữ liệu

// Khởi tạo biến
$products = [];

// Xử lý tìm kiếm khi form được gửi
if (isset($_GET['search']) && isset($_GET['query'])) {
    $searchQuery = $_GET['query'];
    $searchQuery = $conn->real_escape_string($searchQuery); // Tránh SQL Injection

    // Truy vấn tìm kiếm
    $sql_search = "SELECT a.TenAnPham, a.Giathue, a.tinhTrang, d.TenDauAnPham AS TenDauAp, d.Tacgia, d.NXB, d.hinhAnh, d.ngayXB, dm.TenDanhMuc
                   FROM anpham a
                   INNER JOIN dauap d ON a.madauAP = d.madauAP
                   INNER JOIN danhmucap dm ON d.MaDanhMuc = dm.MaDanhMuc
                   WHERE a.TenAnPham LIKE '%$searchQuery%' 
                      OR d.Tacgia LIKE '%$searchQuery%' 
                      OR dm.TenDanhMuc LIKE '%$searchQuery%'";

    $result_search = $conn->query($sql_search);

    if ($result_search && $result_search->num_rows > 0) {
        while ($row = $result_search->fetch_assoc()) {
            $products[] = $row;
        }
    }
    // Chuyển hướng lại shop-grid.php
    header("Location: ../shop-grid.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tìm kiếm</title>
    <link rel="stylesheet" href="../.css"> <!-- Link đến file CSS -->
</head>

<body>
    <!-- Form tìm kiếm -->
    <header>
        <form method="GET" style="margin: 20px; display: flex; align-items: center;">
            <input type="text" name="query" placeholder="Tìm kiếm sản phẩm..." required
                style="padding: 8px; border: 1px solid #ccc; border-radius: 4px; width: 200px;">
            <button type="submit" name="search"
                style="padding: 8px 12px; margin-left: 5px; border: none; background-color: #5cb85c; color: white; border-radius: 4px; cursor: pointer;">
                Tìm kiếm
            </button>
        </form>
    </header>

    <!-- Hiển thị kết quả tìm kiếm -->
    <div class="row">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic">
                            <img src="img/products/<?php echo htmlspecialchars($product['hinhAnh']); ?>"
                                alt="<?php echo htmlspecialchars($product['TenAnPham']); ?>">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h5><?php echo htmlspecialchars($product['TenAnPham']); ?></h5>
                            <h6 style="margin-top: 10px;">Giá:
                                <?php echo number_format($product['Giathue'], 0, ',', '.'); ?> VND
                            </h6>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Không có sản phẩm nào khớp với từ khóa tìm kiếm.</p>
        <?php endif; ?>
    </div>
</body>

</html>