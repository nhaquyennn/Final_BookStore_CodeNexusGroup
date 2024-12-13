<?php
session_start();

// Kiểm tra nếu session 'user' không tồn tại
if (!isset($_SESSION['user'])) {
  header("Location: ../../../user/login.php?error=Vui lòng đăng nhập.");
  exit();
}

// Gọi Controller để lấy dữ liệu
require_once "../../../controller/thongKeController.php";
$controller = new ThongKeController();
$data = [];
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $ngayBatDau = $_POST['ngayBatDau'] ?? '';
  $ngayKetThuc = $_POST['ngayKetThuc'] ?? '';

  if (!empty($ngayBatDau) && !empty($ngayKetThuc)) {
    $data = $controller->thongKeSanPhamTheoNgay($ngayBatDau, $ngayKetThuc);
    $error = $controller->getError();
  } else {
    $error = 'Vui lòng nhập đầy đủ ngày bắt đầu và ngày kết thúc.';
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Header file -->
  <?php require_once "../../../layout/header.php"; ?>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js CDN -->
</head>

<body class="bg-theme bg-theme9">
  <div id="wrapper">

    <div class="clearfix"></div>
    <div class="content-wrapper">
      <div class="container-fluid">
        <!-- Sidebar -->
        <?php require_once "../../../layout/left_sidebar.php"; ?>
        <header class="topbar-nav">
          <?php require_once "../../../layout/topbar.php"; ?>
        </header>
        <!-- Form nhập liệu -->
        <div class="card mt-3">
          <div class="card-body">
            <?php if (!empty($error)): ?>
              <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST" action="">
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="ngayBatDau" class="text-white">Ngày bắt đầu:</label>
                  <input type="date" name="ngayBatDau" id="ngayBatDau" class="form-control" required min="2021-01-01"
                    max="2024-12-31" value="<?= htmlspecialchars($_POST['ngayBatDau'] ?? '') ?>">
                </div>
                <div class="form-group col-md-4">
                  <label for="ngayKetThuc" class="text-white">Ngày kết thúc:</label>
                  <input type="date" name="ngayKetThuc" id="ngayKetThuc" class="form-control" required min="2021-01-01"
                    max="2024-12-31" value="<?= htmlspecialchars($_POST['ngayKetThuc'] ?? '') ?>">
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Xem thống kê</button>
            </form>
          </div>
        </div>

        <!-- Biểu đồ -->
        <?php if (!empty($data) && count($data) > 0): ?>
          <div class="card mt-3">
            <div class="card-body">
              <canvas id="thongKeChart" height="100"></canvas>
            </div>
          </div>

          <script>
            document.addEventListener("DOMContentLoaded", function () {
              const labels = <?= json_encode(array_column($data, 'Ngay')) ?>;
              const totalValues = <?= json_encode(array_column($data, 'TongSoLuong')) ?>;
              const products = <?= json_encode(array_column($data, 'TenSanPhamBanChay')) ?>;

              const ctx = document.getElementById('thongKeChart').getContext('2d');
              new Chart(ctx, {
                type: 'bar',
                data: {
                  labels: labels,
                  datasets: [{
                    label: 'Tổng số lượng sản phẩm',
                    data: totalValues,
                    backgroundColor: '#1E90FF',
                    borderColor: '#4682B4',
                    borderWidth: 1.5,
                  }],
                },
                options: {
                  responsive: true,
                  plugins: {
                    tooltip: {
                      callbacks: {
                        label: function (context) {
                          const index = context.dataIndex;
                          const product = products[index] || 'Không xác định';
                          return `Ngày: ${labels[index]} - Sản phẩm bán chạy: ${product}`;
                        },
                      },
                    },
                  },
                  scales: {
                    x: {
                      title: {
                        display: true,
                        text: 'Ngày',
                        font: {
                          size: 14,
                          weight: 'bold'
                        },
                        color: '#FFFFFF',
                      },
                      ticks: {
                        color: '#FFFFFF',
                      },
                    },
                    y: {
                      title: {
                        display: true,
                        text: 'Số lượng',
                        font: {
                          size: 14,
                          weight: 'bold'
                        },
                        color: '#FFFFFF',
                      },
                      ticks: {
                        beginAtZero: true,
                        color: '#FFFFFF',
                      },
                    },
                  },
                },
              });
            });
          </script>

        <?php else: ?>
          <p class="text-white mt-3">Không có dữ liệu thống kê phù hợp.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- Back To Top Button -->
  <a href="javascript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i></a>

  <!-- Right Sidebar -->
  <?php require_once "../../../layout/right_sidebar.php"; ?>

  <!-- Footer -->
  <?php require_once "../../../layout/script.php"; ?>

</body>

</html>