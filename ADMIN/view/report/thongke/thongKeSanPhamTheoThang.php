<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

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

// Kiểm tra nếu không có dữ liệu
if (empty($data)) {
  $error = "Không có dữ liệu thống kê cho khoảng thời gian này.";
}
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
              <canvas id="chartThongKe" height="300"></canvas>
            </div>
          </div>
          <script>
            document.addEventListener("DOMContentLoaded", function() {
              // Lấy dữ liệu từ PHP
              const labels = [...new Set(<?= json_encode(array_column($data, 'Thang')) ?>)]; // Loại bỏ trùng lặp
              const values = <?= json_encode(array_column($data, 'TongSoLuong')) ?>;
              const products = <?= json_encode(array_column($data, 'TenSanPhamBanChay')) ?>;

              // Kiểm tra nếu phần tử canvas tồn tại
              const ctx = document.getElementById('chartThongKe')?.getContext('2d');
              if (ctx) {
                new Chart(ctx, {
                  type: 'bar',
                  data: {
                    labels: labels.map((month) => `Tháng ${month}`), // Hiển thị tháng đầy đủ
                    datasets: [{
                      label: 'Tổng số lượng sản phẩm',
                      data: values,
                      backgroundColor: '#FFFFFF',
                      borderColor: '#FFFFFF)',
                      borderWidth: 1,
                    }, ],
                  },
                  options: {
                    responsive: true,
                    maintainAspectRatio: false, // Cho phép điều chỉnh kích thước biểu đồ
                    plugins: {
                      tooltip: {
                        callbacks: {
                          label: function(context) {
                            const index = context.dataIndex;
                            return `Tháng: ${labels[index]} - Sản phẩm bán chạy: ${products[index]} `;
                          },
                        },
                      },
                    },
                    layout: {
                      padding: {
                        top: 20,
                        bottom: 30,
                      },
                    },
                    scales: {
                      x: {
                        title: {
                          display: true,
                          text: 'Tháng',
                          font: {
                            size: 16,
                            weight: 'bold',
                          },
                          color: '#FFFFFF', // Màu trắng sáng cho trục X
                        },
                        ticks: {
                          color: '#FFFFFF', // Màu nhãn sáng cho trục X
                          font: {
                            size: 14,
                            weight: 'bold',
                          },
                          maxRotation: 45, // Xoay nhãn trục X
                          minRotation: 0, // Đặt mức xoay tối thiểu
                        },
                      },
                      y: {
                        title: {
                          display: true,
                          text: 'Số lượng',
                          font: {
                            size: 16,
                            weight: 'bold',
                          },
                          color: '#FFFFFF', // Màu trắng sáng cho trục Y
                        },
                        ticks: {
                          callback: function(value) {
                            return `${value}`; // Hiển thị 'Số' trước giá trị trục Y
                          },
                          color: '#FFFFFF', // Màu nhãn sáng cho trục Y
                          font: {
                            size: 14,
                            weight: 'bold',
                          },
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