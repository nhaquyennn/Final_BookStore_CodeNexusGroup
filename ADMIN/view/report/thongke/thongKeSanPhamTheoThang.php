<?php
session_start();
// Kiểm tra nếu session 'user' không tồn tại
if (!isset($_SESSION['user'])) {
    header("Location: ../../../user/login.php?error=Vui lòng đăng nhập.");
    exit();
}

// Khởi tạo biến cho lỗi và dữ liệu
$error = '';
$data = [];
$thangBatDau = $_POST['thangBatDau'] ?? '';
$thangKetThuc = $_POST['thangKetThuc'] ?? '';
$nam = $_POST['nam'] ?? '';

// Gọi Controller để lấy dữ liệu
require_once "../../../controller/thongKeController.php";
$controller = new ThongKeController();
$data = $controller->thongKeSanPhamTheoThang((int)$thangBatDau, (int)$thangKetThuc, (int)$nam);
$error = $controller->getError();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "../../../layout/header.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-theme bg-theme9">
    <div id="wrapper">
        <?php require_once "../../../layout/left_sidebar.php"; ?>
        <header class="topbar-nav">
            <?php require_once "../../../layout/topbar.php"; ?>
        </header>
        <div class="clearfix"></div>

        <div class="content-wrapper">
            <div class="container-fluid">

                <div class="card mt-3">
                    <div class="card-body">
                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                        <?php endif; ?>

                        <!-- Form chọn tháng -->
                        <form method="POST" action="">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="thangBatDau" class="text-white">Tháng bắt đầu:</label>
                                    <select name="thangBatDau" id="thangBatDau" class="form-control" required>
                                        <?php for ($i = 1; $i <= 12; $i++): ?>
                                            <option value="<?= $i ?>" <?= ($thangBatDau == $i) ? 'selected' : '' ?>><?= $i ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="thangKetThuc" class="text-white">Tháng kết thúc:</label>
                                    <select name="thangKetThuc" id="thangKetThuc" class="form-control" required>
                                        <?php for ($i = 1; $i <= 12; $i++): ?>
                                            <option value="<?= $i ?>" <?= ($thangKetThuc == $i) ? 'selected' : '' ?>><?= $i ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="nam" class="text-white">Năm:</label>
                                    <select name="nam" id="nam" class="form-control" required>
                                        <?php for ($i = 2021; $i <= 2024; $i++): ?>
                                            <option value="<?= $i ?>" <?= ($nam == $i) ? 'selected' : '' ?>><?= $i ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Xem thống kê</button>
                        </form>
                    </div>
                </div>

                <!-- Hiển thị biểu đồ -->
                <?php if (!empty($data)): ?>
                    <div class="card mt-3">
                        <div class="card-body">
                            <canvas id="chartThongKe" height="200"></canvas>
                        </div>
                    </div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            const labels = <?= json_encode(array_unique(array_column($data, 'Thang'))) ?>;
                            const values = <?= json_encode(array_column($data, 'TongSoLuong')) ?>;
                            const products = <?= json_encode(array_column($data, 'TenSanPhamBanChay')) ?>;

                            const ctx = document.getElementById('chartThongKe').getContext('2d');
                            new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: labels.map(month => `Tháng ${month}`),
                                    datasets: [{
                                        label: 'Tổng số lượng sản phẩm',
                                        data: values,
                                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                        borderColor: 'rgba(75, 192, 192, 1)',
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    plugins: {
                                        tooltip: {
                                            callbacks: {
                                                label: function(context) {
                                                    const index = context.dataIndex;
                                                    return `Tháng: ${labels[index]} - Sản phẩm bán chạy: ${products[index]} - Số lượng: ${values[index]}`;
                                                }
                                            }
                                        }
                                    },
                                    scales: {
                                        x: {
                                            title: {
                                                display: true,
                                                text: 'Tháng'
                                            }
                                        },
                                        y: {
                                            title: {
                                                display: true,
                                                text: 'Số lượng'
                                            }
                                        }
                                    }
                                }
                            });
                        });
                    </script>
                <?php else: ?>
                    <p class="text-white mt-3">Không có dữ liệu thống kê phù hợp.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php require_once "../../../layout/script.php"; ?>
</body>

</html>