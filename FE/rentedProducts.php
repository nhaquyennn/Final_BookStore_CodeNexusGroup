<?php
// FE/rentedProducts.php

// Bật hiển thị lỗi (chỉ trong môi trường phát triển)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Bao gồm kết nối cơ sở dữ liệu và các hàm cần thiết
include_once 'database/db_connect.php';
include_once 'cart_functions.php';
include_once 'processRentedProducts.php';
var_dump($products);
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Ấn Phẩm Đã Thuê</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../FE/css/rentedProducts.css">
</head>

<body>
    <?php require_once 'layout/header.php'; ?>

    <div class="container my-5 custom-container">
        <!-- Tiêu đề trang -->
        <h2 class="text-center mb-4 custom-title"><i class="fas fa-box-open"></i> Danh Sách Ấn Phẩm Đã Thuê</h2>

        <!-- Thông báo -->
        <?php if (!empty($_SESSION['success_update'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($_SESSION['success_update']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['success_update']); ?>
        <?php endif; ?>

        <?php if (!empty($_SESSION['errors']) && is_array($_SESSION['errors'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    <?php foreach ($_SESSION['errors'] as $error): ?>
                        <li><i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['errors']); ?>
        <?php endif; ?>

        <!-- Danh Sách Ấn Phẩm -->
        <div class="card shadow-sm">
            <div class="card-header bg-secondary text-white">
                <i class="fas fa-list"></i> Danh Sách Ấn Phẩm Đã Thuê
            </div>
            <div class="card-body">
                <?php if (!empty($products)): ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-fixed align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th style="width: 150px;" class="text-center">Hình Ảnh</th>
                                    <th style="width: 200px;" class="text-center">Tên Ấn Phẩm</th>
                                    <th style="width: 100px;" class="text-center">Số Lượng</th>
                                    <th style="width: 150px;" class="text-center">Ngày Trả</th>
                                    <th style="width: 150px;" class="text-center">Đánh Giá</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $product): ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <img src="img/products/<?php echo htmlspecialchars($product['hinhAnh_dauap']); ?>"
                                                alt="<?php echo htmlspecialchars($product['TenAnPham']); ?>"
                                                class="img-thumbnail product-image">
                                        </td>
                                        <td class="text-center align-middle">
                                            <?php echo htmlspecialchars($product['TenAnPham']); ?></td>
                                        <td class="text-center align-middle">
                                            <?php echo htmlspecialchars($product['soLuong']); ?></td>
                                        <td class="text-center align-middle">
                                            <?php echo date('d-m-Y', strtotime($product['ngayTra'])); ?></td>
                                        <td class="text-center align-middle">
                                            <a href="rateProduct.php?id=<?php echo urlencode($product['maAnPham']); ?>"
                                                class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-star"></i> Đánh Giá
                                            </a>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p>Không có ấn phẩm nào đã thuê! Vui lòng quay lại sau.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Nút Quay Lại -->
        <div class="text-center mt-4">
            <a href="shop-grid.php" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Quay Lại Cửa
                Hàng</a>
        </div>
    </div>

    <?php require_once 'layout/footer.php'; ?>


    <!-- Optional: Font Awesome JS for additional icons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>


    <!-- Thêm JavaScript -->
    <script src="../FE/js/main1.js"></script>

</body>

</html>