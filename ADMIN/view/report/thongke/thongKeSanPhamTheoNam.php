<?php
session_start();
// Check if the 'user' session exists
if (!isset($_SESSION['user'])) {
    header("Location: ../../../user/login.php?error=Vui lòng đăng nhập.");
    exit();
}

// Include the controller
require_once "../../../controller/thongKeController.php";
$controller = new ThongKeController();
$data = $controller->thongKeSanPhamTheoNam();
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

                        <!-- Form for selecting years -->
                        <form method="POST" action="">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="namBatDau" class="text-white">Năm bắt đầu:</label>
                                    <select name="namBatDau" id="namBatDau" class="form-control" required>
                                        <?php for ($i = 2021; $i <= 2024; $i++): ?>
                                            <option value="<?= $i ?>" <?= isset($_POST['namBatDau']) && $_POST['namBatDau'] == $i ? 'selected' : '' ?>><?= $i ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="namKetThuc" class="text-white">Năm kết thúc:</label>
                                    <select name="namKetThuc" id="namKetThuc" class="form-control" required>
                                        <?php for ($i = 2021; $i <= 2024; $i++): ?>
                                            <option value="<?= $i ?>" <?= isset($_POST['namKetThuc']) && $_POST['namKetThuc'] == $i ? 'selected' : '' ?>><?= $i ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Xem thống kê</button>
                        </form>
                    </div>
                </div>

                <!-- Display the chart if data is available -->
                <?php if (!empty($data)): ?>
                    <div class="card mt-3">
                        <div class="card-body">
                            <canvas id="chartThongKe" height="200"></canvas>
                        </div>
                    </div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            const labels = <?= json_encode(array_column($data, 'Nam')) ?>;
                            const values = <?= json_encode(array_column($data, 'TongSoLuong')) ?>;
                            const products = <?= json_encode(array_column($data, 'TenSanPhamBanChay')) ?>;

                            const ctx = document.getElementById('chartThongKe').getContext('2d');
                            new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: labels,
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
                                                    return `Năm: ${labels[index]} - Sản phẩm bán chạy: ${products[index]} - Số lượng: ${values[index]}`;
                                                }
                                            }
                                        }
                                    },
                                    scales: {
                                        x: {
                                            title: {
                                                display: true,
                                                text: 'Năm'
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