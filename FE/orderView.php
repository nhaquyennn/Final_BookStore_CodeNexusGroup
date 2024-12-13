<?php
// FE/orderView.php

// Bao gồm Header
include_once 'layout/header.php';
include_once 'controlCustomerUI/orderController.php'; // Đảm bảo đã thêm dấu chấm phẩy ở cuối dòng

?>

<div class="container mt-5">
    <h2 class="text-center">Danh Sách Đơn Hàng Của Bạn</h2>

    <?php if (!empty($orders)): ?>
        <table class="table table-bordered mt-4">
            <thead class="thead-light">
                <tr>
                    <th>Mã Phiếu Mượn</th>
                    <th>Tên Khách Hàng</th>
                    <th>Số Điện Thoại</th>
                    <th>Email</th>
                    <th>Địa Chỉ</th>
                    <th>Ghi Chú</th>
                    <th>Tổng tiền</th>
                    <th>Trạng Thái</th>
                    <th>Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['MaPhieuMuon']); ?></td>
                        <td><?php echo htmlspecialchars($order['TenKH']); ?></td>
                        <td><?php echo htmlspecialchars($order['SoDienThoai']); ?></td>
                        <td><?php echo htmlspecialchars($order['Email']); ?></td>
                        <td><?php echo htmlspecialchars($order['DiaChi']); ?></td>
                        <td><?php echo htmlspecialchars($order['GhiChu']); ?></td>
                        <td><?php echo number_format($order['GiaTienDaThanhToan'], 0, ',', '.') . ' VND'; ?></td>
                        <td>
                            <?php
                            // Hiển thị trạng thái với màu sắc khác nhau dựa trên trạng thái
                            $status = htmlspecialchars($order['tinhTrang']);
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
                        </td>
                        <td>
                            <a href="orderDetailsView.php?MaPhieuMuon=<?php echo urlencode($order['MaPhieuMuon']); ?>" class="btn btn-primary btn-sm">Xem Chi Tiết</a>
                            <?php if ($order['tinhTrang'] === 'Đang xử lý'): ?>
                                <a href="cancelOrder.php?MaPhieuMuon=<?php echo urlencode($order['MaPhieuMuon']); ?>" class="btn btn-danger btn-sm">Hủy Đơn Hàng</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center">Bạn chưa có đơn hàng nào.</p>
    <?php endif; ?>
</div>

<?php
// Bao gồm Footer
include_once 'layout/footer.php';
?>