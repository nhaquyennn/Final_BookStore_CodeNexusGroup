<?php
session_start();

// Check if the 'user' session exists
if (!isset($_SESSION['user'])) {
  header("Location: ../../../user/login.php?error=Vui lòng đăng nhập.");
  exit();
}

// Call the controller to get data
require_once "../../../controller/baoCaoController.php";
$controller = new BaoCaoController();
$data = $controller->baoCaoDoanhThuTheoNgay(); // Call the method from Controller
$error = $controller->getError();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once "../../../layout/header.php"; ?>
  <!-- Import layout header -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Ensure Chart.js library is loaded -->
</head>

<body class="bg-theme bg-theme9">
  <!-- Start wrapper-->
  <div id="wrapper">
    <div class="clearfix"></div>

    <!--Start content-wrapper-->
    <div class="content-wrapper">

      <!--Start container-fluid-->
      <div class="container-fluid">
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
        <!--Start Dashboard Content-->
        <div class="card mt-3">
          <div class="card-body">
            <!-- Display error if there is any -->
            <?php if (!empty($error)): ?>
              <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <!-- Form for inputting date range -->
            <form method="POST" action="">
              <div class="form-row">
                <!-- Start Date -->
                <div class="form-group col-md-4">
                  <label for="ngayBatDau" class="text-white">Ngày bắt đầu:</label>
                  <input type="date" name="ngayBatDau" id="ngayBatDau" class="form-control" required min="2021-01-01"
                    max="2024-12-31" value="<?= htmlspecialchars($_POST['ngayBatDau'] ?? '') ?>">
                </div>

                <!-- End Date -->
                <div class="form-group col-md-4">
                  <label for="ngayKetThuc" class="text-white">Ngày kết thúc:</label>
                  <input type="date" name="ngayKetThuc" id="ngayKetThuc" class="form-control" required min="2021-01-01"
                    max="2024-12-31" value="<?= htmlspecialchars($_POST['ngayKetThuc'] ?? '') ?>">
                </div>
              </div>
              <!-- Button to view stats -->
              <button type="submit" class="btn btn-primary">Xem thống kê</button>
            </form>
          </div>
        </div>
        <!--End Dashboard Content-->

        <!--start overlay-->
        <div class="overlay toggle-menu"></div>
        <!--end overlay-->

        <!-- Display chart if data is available -->
        <?php if (!empty($data)): ?>
          <div class="card mt-3">
            <div class="card-body">
              <!-- Canvas for the chart -->
              <canvas id="thongKeChart" height="200"></canvas>
            </div>
          </div>
          <script>
            // Get data from PHP
            const labels = <?= json_encode(array_column($data, 'Ngay')) ?>; // Lấy ngày từ dữ liệu
            const values = <?= json_encode(array_column($data, 'TongDoanhThu')) ?>; // Tổng doanh thu
            const products = <?= json_encode(array_column($data, 'SanPhamBanChay')) ?>; // Sản phẩm bán chạy
            const productRevenues =
              <?= json_encode(array_column($data, 'DoanhThuSanPhamBanChay')) ?>; // Doanh thu sản phẩm bán chạy

            // Initialize the Chart.js chart
            const ctx = document.getElementById('thongKeChart').getContext('2d');
            new Chart(ctx, {
              type: 'bar',
              data: {
                labels: labels.map((date) => `Ngày ${date}`), // Hiển thị ngày đầy đủ
                datasets: [{
                  label: 'Tổng doanh thu (VND)',
                  data: values,
                  backgroundColor: 'rgba(255, 255, 255, 0.8)', // Màu nền cột trắng
                  borderColor: 'rgba(255, 255, 255, 1)', // Màu viền cột trắng
                  borderWidth: 1.5,
                  borderRadius: 5, // Bo góc cột
                },],
              },
              options: {
                responsive: true,
                maintainAspectRatio: false, // Đảm bảo biểu đồ tự động co giãn
                plugins: {
                  tooltip: {
                    callbacks: {
                      label: function (context) {
                        const index = context.dataIndex;
                        const productRevenue = productRevenues[index] ?
                          parseInt(productRevenues[index]).toLocaleString() :
                          '0';
                        return [
                          `Ngày: ${labels[index]}`,
                          `Tổng doanh thu: ${parseInt(values[index]).toLocaleString()} VND`,
                          `Sản phẩm bán chạy: ${products[index]}`,
                          `Doanh thu sản phẩm: ${productRevenue} VND`,
                        ];
                      },
                    },
                  },
                  legend: {
                    position: 'top', // Đưa legend lên trên
                    labels: {
                      color: '#FFFFFF', // Màu trắng cho chữ trong legend
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
                      text: 'Ngày',
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
          </script>



        <?php else: ?>
          <!-- Display message if no data available -->
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