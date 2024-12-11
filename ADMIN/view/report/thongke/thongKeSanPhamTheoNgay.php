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
              const labels = <?= json_encode(array_column($data, 'Ngay')) ?>; // Trục X: Ngày
              const totalValues = <?= json_encode(array_column($data, 'TongSoLuong')) ?>; // Tổng số lượng sản phẩm
              const products = <?= json_encode(array_column($data, 'TenSanPhamBanChay')) ?>; // Sản phẩm bán chạy nhất

              // Kiểm tra nếu phần tử canvas tồn tại
              const ctx = document.getElementById('thongKeChart')?.getContext('2d');
              if (ctx) {
                new Chart(ctx, {
                  type: 'bar',
                  data: {
                    labels: labels, // Nhãn trục X là các ngày
                    datasets: [{
                      label: 'Tổng số lượng sản phẩm',
                      data: totalValues, // Dữ liệu trục Y
                      backgroundColor: '#FFFFFF', // Màu cột tối hơn
                      borderColor: '#FFFFFF', // Viền cột
                      borderWidth: 1.5, // Độ dày viền
                      borderRadius: 5, // Bo góc cột
                    }, ],
                  },
                  options: {
                    responsive: true,
                    maintainAspectRatio: false, // Đảm bảo co giãn tốt
                    plugins: {
                      tooltip: {
                        callbacks: {
                          label: function(context) {
                            const index = context.dataIndex;
                            const product = products[index] || 'Không xác định';
                            // Hiển thị tooltip
                            return `Ngày: ${labels[index]} - Sản phẩm bán chạy: ${product} `;
                          },
                        },
                      },
                    },
                    layout: {
                      padding: {
                        top: 20,
                        left: 15,
                        right: 15,
                        bottom: 15,
                      },
                    },
                    scales: {
                      x: {
                        title: {
                          display: true,
                          text: 'Ngày',
                          font: {
                            size: 16,
                            weight: 'bold',
                          },
                          color: '#FFFFFF', // Màu chữ sáng cho trục X
                        },
                        ticks: {
                          color: '#FFFFFF', // Màu nhãn sáng
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
                          font: {
                            size: 16,
                            weight: 'bold',
                          },
                          color: '#FFFFFF', // Màu chữ sáng cho trục Y
                        },
                        ticks: {
                          beginAtZero: true,
                          color: '#FFFFFF', // Màu nhãn sáng
                          font: {
                            size: 14,
                            weight: 'bold',
                          },
                        },
                      },
                    },
                  },
                });
              } else {
                console.error("Không tìm thấy phần tử canvas với id 'thongKeChart'.");
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