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
                                            <option value="<?= $i ?>"
                                                <?= isset($_POST['namBatDau']) && $_POST['namBatDau'] == $i ? 'selected' : '' ?>><?= $i ?>
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="namKetThuc" class="text-white">Năm kết thúc:</label>
                                    <select name="namKetThuc" id="namKetThuc" class="form-control" required>
                                        <?php for ($i = 2021; $i <= 2024; $i++): ?>
                                            <option value="<?= $i ?>"
                                                <?= isset($_POST['namKetThuc']) && $_POST['namKetThuc'] == $i ? 'selected' : '' ?>><?= $i ?>
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Xem thống kê</button>
                        </form>
                    </div>
                </div>


                <!--start overlay-->
                <div class="overlay toggle-menu"></div>
                <!--end overlay-->



                <!-- Display the chart if data is available -->
                <?php if (!empty($data)): ?>
                    <div class="card mt-3">
                        <div class="card-body">
                            <canvas id="chartThongKe" height="300"></canvas>
                        </div>
                    </div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            // Lấy dữ liệu từ PHP
                            const labels = <?= json_encode(array_column($data, 'Nam')) ?>; // Lấy các năm từ dữ liệu
                            const values = <?= json_encode(array_column($data, 'TongSoLuong')) ?>; // Tổng số lượng sản phẩm
                            const products = <?= json_encode(array_column($data, 'TenSanPhamBanChay')) ?>; // Sản phẩm bán chạy nhất

                            // Chỉ giữ lại những năm duy nhất cho nhãn
                            const uniqueLabels = [...new Set(labels)];

                            // Tạo biểu đồ
                            const ctx = document.getElementById('chartThongKe')?.getContext('2d');
                            if (ctx) {
                                new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: uniqueLabels.map((year) => `Năm ${year}`), // Hiển thị nhãn trục X với "Năm"
                                        datasets: [{
                                            label: 'Tổng số lượng sản phẩm',
                                            data: values,
                                            backgroundColor: 'rgba(45, 62, 80, 0.8)', // Màu nền cột tối hơn
                                            borderColor: 'rgba(45, 62, 80, 1)', // Màu viền cột
                                            borderWidth: 1.5, // Độ dày viền
                                            borderRadius: 5, // Bo góc cột
                                        }, ],
                                    },
                                    options: {
                                        responsive: true,
                                        maintainAspectRatio: false, // Cho phép biểu đồ tự động co giãn
                                        plugins: {
                                            tooltip: {
                                                callbacks: {
                                                    label: function(context) {
                                                        const index = context.dataIndex;
                                                        return `Sản phẩm bán chạy: ${products[index]} - Số lượng: ${values[index]}`;
                                                    },
                                                },
                                            },
                                            legend: {
                                                position: 'top', // Đưa legend lên trên
                                                labels: {
                                                    color: '#FFFFFF', // Màu sáng cho chữ trong legend
                                                    font: {
                                                        size: 14,
                                                        weight: 'bold',
                                                    },
                                                },
                                            },
                                        },
                                        layout: {
                                            padding: {
                                                top: 20,
                                                bottom: 20,
                                            },
                                        },
                                        scales: {
                                            x: {
                                                title: {
                                                    display: true,
                                                    text: 'Năm',
                                                    color: '#FFFFFF', // Màu chữ sáng cho trục X
                                                    font: {
                                                        size: 16,
                                                        weight: 'bold',
                                                    },
                                                },
                                                ticks: {
                                                    color: '#FFFFFF', // Màu nhãn sáng cho trục X
                                                    font: {
                                                        size: 14,
                                                        weight: 'bold',
                                                    },
                                                },
                                            },
                                            y: {
                                                title: {
                                                    display: true,
                                                    text: 'Số lượng',
                                                    color: '#FFFFFF', // Màu chữ sáng cho trục Y
                                                    font: {
                                                        size: 16,
                                                        weight: 'bold',
                                                    },
                                                },
                                                ticks: {
                                                    color: '#FFFFFF', // Màu nhãn sáng cho trục Y
                                                    font: {
                                                        size: 14,
                                                        weight: 'bold',
                                                    },
                                                    beginAtZero: true, // Đảm bảo trục Y bắt đầu từ 0
                                                },
                                            },
                                        },
                                    },
                                });
                            }
                        });
                    </script>



                <?php else: ?>
                    <p class="text-white mt-3">Không có dữ liệu thống kê phù hợp.</p>
                <?php endif; ?>
            </div>
        </div>

        <!--Start Back To Top Button-->
        <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
        <!--End Back To Top Button-->
        <!--Start right sidebar-->
        <?php require_once "../../../layout/right_sidebar.php"; ?>
        <!-- Import right sidebar -->
        <!--End right sidebar-->
    </div>


    <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->

    <!--Start right sidebar-->
    <?php require_once "../../../layout/right_sidebar.php"; ?>
    <!-- Import right sidebar -->
    <!--End right sidebar-->

    </div>
    <!--End wrapper-->

    <!--Start footer-->
    <?php require_once "../../../layout/script.php"; ?>
    <!-- Import footer scripts -->
    <!--End footer-->

</body>

</html>