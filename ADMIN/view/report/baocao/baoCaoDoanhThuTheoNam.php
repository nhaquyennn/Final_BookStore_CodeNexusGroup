<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Kiểm tra nếu session 'user' không tồn tại
if (!isset($_SESSION['user'])) {
  header("Location: ../../../user/login.php?error=Vui lòng đăng nhập.");
  exit();
}

// Gọi Controller để lấy dữ liệu
require_once "../../../controller/baoCaoController.php";
$controller = new BaoCaoController();
$data = $controller->baoCaoDoanhThuTheoNam(); // Gọi hàm từ Controller
$error = $controller->getError();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Thêm thư viện Chart.js -->
  <?php require_once "../../../layout/header.php"; ?>
  <!-- Import layout header -->
</head>

<body class="bg-theme bg-theme9">
  <!-- Start wrapper-->
  <div id="wrapper">

    <!--Start sidebar-wrapper-->
    <?php require_once "../../../layout/left_sidebar.php"; ?>
    <!-- Import sidebar -->
    <!--End sidebar-wrapper-->

    <!--Start topbar header-->
    <header class="topbar-nav">
      <?php require_once "../../../layout/topbar.php"; ?>
      <!-- Import topbar -->
    </header>
    <!--End topbar header-->

    <div class="clearfix"></div>

    <!--Start content-wrapper-->
    <div class="content-wrapper">

      <!--Start container-fluid-->
      <div class="container-fluid">

        <!--Start Dashboard Content-->
        <div class="card mt-3">
          <div class="card-body">
            <!-- Hiển thị lỗi nếu có -->
            <?php if (!empty($error)): ?>
              <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <!-- Form nhập liệu cho thống kê -->
            <form method="POST" action="">
              <div class="form-row">
                <!-- Năm bắt đầu -->
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

                <!-- Năm kết thúc -->
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
              <!-- Nút xem thống kê -->
              <button type="submit" class="btn btn-primary">Xem thống kê</button>
            </form>
          </div>
        </div>
        <!--End Dashboard Content-->

        <!--start overlay-->
        <div class="overlay toggle-menu"></div>
        <!--end overlay-->

        <!-- Hiển thị biểu đồ nếu có dữ liệu -->
        <?php if (isset($data) && count($data) > 0): ?>
          <div class="card mt-3">
            <div class="card-body">
              <!-- Canvas chứa biểu đồ -->
              <canvas id="thongKeChart" height="200"></canvas>
            </div>
          </div>
          <script>
            // Lấy dữ liệu từ PHP
            const labels = <?= json_encode(array_column($data, 'Nam')) ?>; // Lấy các năm từ dữ liệu
            const values = <?= json_encode(array_column($data, 'TongDoanhThu')) ?>; // Tổng doanh thu
            const bestProducts = <?= json_encode(array_column($data, 'SanPhamBanChay')) ?>; // Sản phẩm bán chạy
            const productRevenues =
              <?= json_encode(array_column($data, 'DoanhThuSanPhamBanChay')) ?>; // Doanh thu sản phẩm bán chạy

            // Khởi tạo biểu đồ
            const ctx = document.getElementById('thongKeChart');
            if (ctx) {
              const chartContext = ctx.getContext('2d');
              new Chart(chartContext, {
                type: 'bar',
                data: {
                  labels: labels.map((year) => `Năm ${year}`), // Hiển thị năm đầy đủ
                  datasets: [{
                    label: 'Tổng doanh thu (VND)',
                    data: values,
                    backgroundColor: 'rgba(255, 255, 255, 0.8)', // Màu nền cột trắng
                    borderColor: 'rgba(255, 255, 255, 1)', // Màu viền cột trắng
                    borderWidth: 1.5,
                    borderRadius: 5, // Bo góc cột
                  }, ],
                },
                options: {
                  responsive: true,
                  maintainAspectRatio: false, // Đảm bảo biểu đồ tự động co giãn
                  plugins: {
                    tooltip: {
                      callbacks: {
                        label: function(context) {
                          const index = context.dataIndex;
                          const productName = bestProducts[index] || 'Không có dữ liệu';
                          const productRevenue = productRevenues[index] ?
                            parseInt(productRevenues[index]).toLocaleString() :
                            '0';
                          return [
                            `Năm: ${labels[index]}`,
                            `Tổng doanh thu: ${parseInt(values[index]).toLocaleString()} VND`,
                            `Sản phẩm bán chạy: ${productName}`,
                            `Doanh thu sản phẩm bán chạy: ${productRevenue} VND`,
                          ];
                        },
                      },
                    },
                    legend: {
                      position: 'top', // Đưa legend lên trên
                      labels: {
                        color: '#FFFFFF', // Màu trắng sáng cho chữ trong legend
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
                        color: '#FFFFFF', // Màu sáng cho tiêu đề trục X
                        font: {
                          size: 16,
                          weight: 'bold',
                        },
                      },
                      ticks: {
                        color: '#FFFFFF', // Màu sáng cho nhãn trục X
                        font: {
                          size: 14,
                          weight: 'bold',
                        },
                      },
                    },
                    y: {
                      title: {
                        display: true,
                        text: 'Doanh thu (VND)',
                        color: '#FFFFFF', // Màu sáng cho tiêu đề trục Y
                        font: {
                          size: 16,
                          weight: 'bold',
                        },
                      },
                      ticks: {
                        color: '#FFFFFF', // Màu sáng cho nhãn trục Y
                        font: {
                          size: 14,
                          weight: 'bold',
                        },
                        beginAtZero: true,
                      },
                    },
                  },
                },
              });
            } else {
              console.error('Không tìm thấy phần tử canvas cho biểu đồ!');
            }
          </script>


        <?php else: ?>
          <!-- Hiển thị thông báo nếu không có dữ liệu -->
          <p class="text-white mt-3">Không có dữ liệu thống kê phù hợp.</p>
        <?php endif; ?>
      </div>
      <!--End Charts-->
    </div>
    <!-- End container-fluid-->

  </div>
  <!--End content-wrapper-->

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