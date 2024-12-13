<?php
// FE/orderDetailsView.php

// Bật hiển thị lỗi (chỉ nên trong môi trường phát triển)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Bao gồm controlOrderDetails.php để lấy dữ liệu đơn hàng và sản phẩm
include_once 'controlCustomerUI/controlOrderDetails.php';
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Chi Tiết Đơn Hàng</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../FE/css/orderDetailsView.css"> <!-- Đường dẫn tới file CSS của bạn -->

    <style>
        /* Bạn có thể điều chỉnh thêm ở file CSS riêng, đây chỉ là ví dụ nhỏ */
        .card-header {
            font-weight: bold;
            font-size: 1.1rem;
        }

        .table thead th {
            vertical-align: middle;
            text-align: center;
        }

        .table tbody td {
            vertical-align: middle;
        }

        .badge {
            font-size: 0.9rem;
        }

        .custom-title {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-weight: 600;
            color: #333;
        }

        .custom-container {
            max-width: 1200px;
        }
    </style>
</head>

<body>
    <?php include_once 'layout/header.php'; ?>

    <div class="container my-5 custom-container">
        <!-- Tiêu đề trang -->
        <h2 class="text-center mb-4 custom-title"><i class="fas fa-file-invoice"></i> Chi Tiết Đơn Hàng #<?php echo htmlspecialchars($orderDetails['MaPhieuMuon']); ?></h2>

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

        <!-- Thông Tin Đơn Hàng -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                <i class="fas fa-info-circle"></i> Thông Tin Đơn Hàng
            </div>
            <div class="card-body">
                <p><strong>Mã Đơn Hàng:</strong> <?php echo htmlspecialchars($orderDetails['MaPhieuMuon']); ?></p>
                <p><strong>Trạng Thái:</strong>
                    <?php
                    $status = htmlspecialchars($orderDetails['tinhTrang']);
                    switch ($status) {
                        case 'Đang xử lý':
                            echo '<span class="badge bg-warning text-dark">' . $status . '</span>';
                            break;
                        case 'Đã xác nhận':
                            echo '<span class="badge bg-info text-white">' . $status . '</span>';
                            break;
                        case 'Đang giao hàng':
                            echo '<span class="badge bg-primary text-white">' . $status . '</span>';
                            break;
                        case 'Đã hoàn tất':
                            echo '<span class="badge bg-success">' . $status . '</span>';
                            break;
                        case 'Đã hủy':
                            echo '<span class="badge bg-danger">' . $status . '</span>';
                            break;
                        default:
                            echo '<span class="badge bg-secondary">' . $status . '</span>';
                            break;
                    }
                    ?>
                </p>
            </div>
        </div>

        <!-- Thông Tin Giao Hàng -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-info text-white">
                <i class="fas fa-truck"></i> Thông Tin Giao Hàng
            </div>
            <div class="card-body">
                <p><strong>Tên Khách Hàng:</strong> <?php echo htmlspecialchars($orderDetails['TenKH']); ?></p>
                <p><strong>Số Điện Thoại:</strong> <?php echo htmlspecialchars($orderDetails['SoDienThoai']); ?></p>
                <p><strong>Địa Chỉ:</strong> <?php echo htmlspecialchars($orderDetails['DiaChi']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($orderDetails['Email']); ?></p>
                <p><strong>Ghi Chú:</strong> <?php echo htmlspecialchars($orderDetails['GhiChu']); ?></p>
            </div>
        </div>

        <!-- Thông Tin Thanh Toán -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-success text-white">
                <i class="fas fa-credit-card"></i> Thông Tin Thanh Toán
            </div>
            <div class="card-body">
                <p><strong>Phương Thức Thanh Toán:</strong> <?php echo htmlspecialchars($orderDetails['PhuongThucThanhToan']); ?></p>
                <p><strong>Phí thuê:</strong> <?php echo number_format($orderDetails['TotalPhiThue'], 0, ',', '.') . ' VND'; ?></p>
                <p><strong>Tạm Tính:</strong> <?php echo number_format($orderDetails['TongTien'], 0, ',', '.') . ' VND'; ?></p>
                <p><strong>Khuyến Mãi:</strong> <?php echo htmlspecialchars($orderDetails['PhanTramGiamgia']); ?>%</p>
                <p><strong>Tổng Tiền:</strong> <?php echo number_format($orderDetails['GiaTienDaThanhToan'], 0, ',', '.') . ' VND'; ?></p>
                <p><strong>Ngày Giao Dịch:</strong> <?php echo htmlspecialchars($orderDetails['NgayTao']); ?></p>
            </div>

        </div>

        <!-- Danh Sách Sản Phẩm Trong Đơn Hàng -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-secondary text-white">
                <i class="fas fa-book"></i> Danh Sách Sản Phẩm
            </div>
            <div class="card-body">
                <?php if (!empty($products)): ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th style="width: 150px;">Hình Ảnh</th>
                                    <th style="width: 200px;">Tên Sách</th>
                                    <th style="width: 100px;">Số Lượng</th>
                                    <th style="width: 150px;">Đơn Giá</th>
                                    <th style="width: 100px;">Ngày Mượn</th>
                                    <th style="width: 100px;">Ngày Trả</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $product): ?>
                                    <tr>
                                        <td class="text-center">
                                            <img src="img/products/<?php echo htmlspecialchars($product['hinhAnh_dauap']); ?>" class="img-thumbnail product-image">
                                        </td>
                                        <td class="text-center"><?php echo htmlspecialchars($product['TenAnPham']); ?></td>
                                        <td class="text-center"><?php echo htmlspecialchars($product['SoLuong']); ?></td>
                                        <td class="text-center"><?php echo number_format($product['DonGia'], 0, ',', '.') . ' VND'; ?></td>

                                        <!-- Hiển thị ngày mượn từ bảng phieumuon -->
                                        <td class="text-center"><?php echo htmlspecialchars($orderDetails['NgayTao']); ?></td>

                                        <!-- Hiển thị ngày trả từ bảng chitietpm, nếu không có ngày trả (NULL) thì hiển thị 'Chưa trả' -->
                                        <td class="text-center">
                                            <?php echo !empty($product['ngayTra']) ? date('Y-m-d', strtotime($product['ngayTra'])) : 'Chưa trả'; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>


                            </tbody>

                        </table>
                    </div>
                <?php else: ?>
                    <p>Không có sản phẩm nào trong đơn hàng này.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Thông Tin Hủy Đơn Hàng Khi Đơn Hàng Đã Hủy -->
        <?php if ($orderDetails['tinhTrang'] === 'Đã hủy'): ?>
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-danger text-white">
                    <i class="fas fa-ban"></i> Thông Tin Hủy Đơn Hàng
                </div>
                <div class="card-body">
                    <p><strong>Lý Do Hủy:</strong> <?php echo htmlspecialchars($orderDetails['lyDoHuy']); ?></p>
                    <p><strong>Số Tài Khoản Hoàn Tiền:</strong> <?php echo htmlspecialchars($orderDetails['soTaiKhoan']); ?></p>
                </div>
            </div>
        <?php endif; ?>

        <!-- Nút Quay Lại -->
        <div class="text-center mt-4">
            <a href="orderView.php" class="btn btn-outline-primary"><i class="fas fa-arrow-left"></i> Quay Lại Danh Sách Đơn Hàng</a>
        </div>
    </div>

    <?php include_once 'layout/footer.php'; ?>

    <!-- Bootstrap JS (Bundle includes Popper) -->
    <!-- Optional: Font Awesome JS for additional icons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

    <!-- Thêm JavaScript để tự động ẩn thông báo -->
    <script>
        // Tự động ẩn thông báo sau 5 giây
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
</body>

</html>