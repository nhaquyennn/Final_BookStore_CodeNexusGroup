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
$data = $controller->baoCaoDoanhThuTheoThang(); // Gọi hàm từ Controller
$error = $controller->getError();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once "../../../layout/header.php"; ?>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Thêm thư viện Chart.js -->
</head>

<body class="bg-theme bg-theme9">
  <!-- Start wrapper-->
  <div id="wrapper">

    <!--Start sidebar-wrapper-->
    <?php require_once "../../../layout/left_sidebar.php"; ?>
    <!--End sidebar-wrapper-->

    <!--Start topbar header-->
    <header class="topbar-nav">
      <?php require_once "../../../layout/topbar.php"; ?>
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
              <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <!-- Form nhập liệu cho thống kê -->
            <form method="POST" action="">
              <div class="form-row">
                <!-- Tháng bắt đầu -->
                <div class="form-group col-md-3">
                  <label for="thangBatDau" class="text-white">Tháng bắt đầu:</label>
                  <select name="thangBatDau" id="thangBatDau" class="form-control" required>
                    <?php for ($i = 1; $i <= 12; $i++): ?>
                      <option value="<?= $i ?>"
                        <?= (isset($_POST['thangBatDau']) && $_POST['thangBatDau'] == $i) ? 'selected' : '' ?>><?= $i ?>
                      </option>
                    <?php endfor; ?>
                  </select>
                </div>

                <!-- Tháng kết thúc -->
                <div class="form-group col-md-3">
                  <label for="thangKetThuc" class="text-white">Tháng kết thúc:</label>
                  <select name="thangKetThuc" id="thangKetThuc" class="form-control" required>
                    <?php for ($i = 1; $i <= 12; $i++): ?>
                      <option value="<?= $i ?>"
                        <?= (isset($_POST['thangKetThuc']) && $_POST['thangKetThuc'] == $i) ? 'selected' : '' ?>><?= $i ?>
                      </option>
                    <?php endfor; ?>
                  </select>
                </div>

                <!-- Năm -->
                <div class="form-group col-md-3">
                  <label for="nam" class="text-white">Năm:</label>
                  <select name="nam" id="nam" class="form-control" required>
                    <?php for ($i = 2021; $i <= 2024; $i++): ?>
                      <option value="<?= $i ?>" <?= (isset($_POST['nam']) && $_POST['nam'] == $i) ? 'selected' : '' ?>>
                        <?= $i ?></option>
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
        <?php if (!empty($data)): ?>
          <div class="card mt-3">
            <div class="card-body">
              <!-- Canvas chứa biểu đồ -->
              <canvas id="thongKeChart" height="200"></canvas>
            </div>
          </div>
          <script>
            // Lấy dữ liệu từ PHP
            const labels = <?= json_encode(array_column($data, 'Thang')) ?>;
            const values = <?= json_encode(array_column($data, 'TongDoanhThu')) ?>;
            const products = <?= json_encode(array_column($data, 'SanPhamBanChay')) ?>;
            const productRevenues = <?= json_encode(array_column($data, 'DoanhThuSanPham')) ?>;

            // Khởi tạo biểu đồ với Chart.js
            const ctx = document.getElementById('thongKeChart').getContext('2d');
            new Chart(ctx, {
              type: 'bar',
              data: {
                labels: labels,
                datasets: [{
                  label: 'Tổng doanh thu',
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
                        return `
                                Tháng: ${labels[index]}\n
                                Sản phẩm bán chạy: ${products[index]}\n
                                Doanh thu sản phẩm: ${parseInt(productRevenues[index]).toLocaleString()} VND\n
                                Tổng doanh thu: ${parseInt(values[index]).toLocaleString()} VND
                            `;
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
                      text: 'Doanh thu (VND)'
                    },
                    beginAtZero: true
                  }
                }
              }
            });
          </script>

        <?php else: ?>
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
  <!--End right sidebar-->

  </div>
  <!--End wrapper-->

  <!--Start footer-->
  <?php require_once "../../../layout/script.php"; ?>
  <!--End footer-->

</body>

</html>