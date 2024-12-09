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
</head>

<body class="bg-theme bg-theme9">
  <div id="wrapper">
    <!-- Sidebar -->
    <?php require_once "../../../layout/left_sidebar.php"; ?>
    <header class="topbar-nav">
      <?php require_once "../../../layout/topbar.php"; ?>
    </header>

    <div class="clearfix"></div>
    <div class="content-wrapper">
      <div class="container-fluid">

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
              <canvas id="thongKeChart" height="300"></canvas>
            </div>
          </div>

          <script>
            document.addEventListener("DOMContentLoaded", function() {
              // Lấy dữ liệu từ PHP
              const labels = <?= json_encode(array_column($data, 'Ngay')) ?>;
              const values = <?= json_encode(array_column($data, 'TongSoLuong')) ?>;
              const products = <?= json_encode(array_column($data, 'TenSanPhamBanChay')) ?>;
              const revenues = <?= json_encode(array_column($data, 'DoanhThuSanPhamBanChay')) ?>;

              // Tạo biểu đồ
              const ctx = document.getElementById('thongKeChart')?.getContext('2d');
              if (ctx) {
                new Chart(ctx, {
                  type: 'bar',
                  data: {
                    labels: labels,
                    datasets: [{
                      label: 'Tổng số lượng sản phẩm',
                      data: values,
                      backgroundColor: 'rgba(75, 192, 192, 0.2)',
                      borderColor: 'rgba(54, 162, 235, 1)',
                      borderWidth: 1,
                    }]
                  },
                  options: {
                    responsive: true,
                    plugins: {
                      tooltip: {
                        callbacks: {
                          label: function(context) {
                            const index = context.dataIndex;

                            // Kiểm tra dữ liệu
                            if (index >= labels.length || index >= products.length || index >= revenues.length) {
                              return ['Dữ liệu không khả dụng.'];
                            }

                            const date = labels[index];
                            const product = products[index] || 'Không xác định';
                            const revenue = revenues[index] || 0;
                            const totalQuantity = values[index] || 0;

                            // Hiển thị mỗi thông tin trên một dòng
                            return [
                              `Ngày: ${date}`,
                              `Sản phẩm bán chạy: ${product}`,
                              `Doanh thu sản phẩm: ${new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(revenue)}`,
                              `Tổng số lượng: ${totalQuantity}`
                            ];
                          }
                        }
                      },
                      legend: {
                        display: true,
                        labels: {
                          color: '#FFFFFF',
                          font: {
                            size: 14
                          }
                        }
                      }
                    },
                    scales: {
                      x: {
                        title: {
                          display: true,
                          text: 'Ngày',
                          color: '#FFFFFF',
                          font: {
                            size: 16,
                            weight: 'bold' // Làm chữ đậm trên trục Ox
                          }
                        },
                        ticks: {
                          color: '#FFFFFF',
                          font: {
                            weight: 'bold' // Làm chữ đậm cho nhãn trên trục Ox
                          }
                        }
                      },
                      y: {
                        title: {
                          display: true,
                          text: 'Số lượng',
                          color: '#FFFFFF',
                          font: {
                            size: 16,
                            weight: 'bold' // Làm chữ đậm trên trục Oy
                          }
                        },
                        ticks: {
                          beginAtZero: true,
                          color: '#FFFFFF',
                          font: {
                            weight: 'bold' // Làm chữ đậm cho nhãn trên trục Oy
                          }
                        }
                      }
                    }
                  }
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

  <!--Start right sidebar-->
  <?php require_once "../../../layout/right_sidebar.php"; ?>
  <!--End right sidebar-->

  </div>
  <!--End wrapper-->

  <!--Start footer-->
  <?php require_once "../../../layout/script.php"; ?>
  <!--End footer-->

</body>

</html>