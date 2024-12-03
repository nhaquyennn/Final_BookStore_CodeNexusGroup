<?php
session_start();

// Kiểm tra nếu session 'user' không tồn tại
if (!isset($_SESSION['user'])) {
  header("Location: ../../user/login.php?error=Vui lòng đăng nhập.");
  exit();
}

// Lấy dữ liệu từ GET (nếu có)
$data = isset($_GET['data']) ? json_decode(urldecode($_GET['data']), true) : [];
$error = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once "../../layout/header.php"; ?>
</head>

<body class="bg-theme bg-theme9">
  <!-- Start wrapper -->
  <div id="wrapper">

    <!-- Start sidebar-wrapper -->
    <?php require_once "../../layout/left_sidebar.php"; ?>
    <!-- End sidebar-wrapper -->

    <!-- Start topbar header -->
    <header class="topbar-nav">
      <?php require_once "../../layout/topbar.php"; ?>
    </header>
    <!-- End topbar header -->

    <div class="clearfix"></div>

    <!-- Start content-wrapper -->
    <div class="content-wrapper">

      <!-- Start container-fluid -->
      <div class="container-fluid">

        <!-- Start Dashboard Content -->
        <div class="card mt-3">
          <div class="card-body">
            <h4 class="text-white">Quản lý phiếu mượn</h4>

            <!-- Hiển thị lỗi nếu có -->
            <?php if ($error): ?>
              <div class="alert alert-danger"><?= $error ?></div>
            <?php elseif (!empty($data)): ?>
              <!-- Hiển thị bảng thông tin phiếu mượn -->
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Mã Phiếu Mượn</th>
                    <th>Ngày Tạo</th>
                    <th>Tổng Tiền</th>
                    <th>Giảm Giá</th>
                    <th>Phương Thức Thanh Toán</th>
                    <th>Số Điện Thoại</th>
                    <th>Tình Trạng</th>
                    <th>Mã Khách Hàng</th>
                    <th>Mã Khuyến Mãi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($data as $row): ?>
                    <tr>
                      <td><?= htmlspecialchars($row['MaPhieuMuon']) ?></td>
                      <td><?= htmlspecialchars($row['NgayTao']) ?></td>
                      <td><?= htmlspecialchars($row['TongTien']) ?></td>
                      <td><?= htmlspecialchars($row['GiamGia']) ?></td>
                      <td><?= htmlspecialchars($row['PhuongThucThanhToan']) ?></td>
                      <td><?= htmlspecialchars($row['SoDienThoai']) ?></td>
                      <td><?= htmlspecialchars($row['tinhTrang']) ?></td>
                      <td><?= htmlspecialchars($row['maKH']) ?></td>
                      <td><?= htmlspecialchars($row['MaKhuyenMai']) ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            <?php else: ?>
              <!-- Thông báo nếu không có dữ liệu -->
              <div class="alert alert-info">Không có dữ liệu để hiển thị.</div>
            <?php endif; ?>
          </div>
        </div>
        <!-- End Dashboard Content -->

        <!-- Start overlay -->
        <div class="overlay toggle-menu"></div>
        <!-- End overlay -->

      </div>
      <!-- End container-fluid -->

    </div>
    <!-- End content-wrapper -->

    <!-- Start Back To Top Button -->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!-- End Back To Top Button -->

    <!-- Start right sidebar -->
    <?php require_once "../../layout/right_sidebar.php"; ?>
    <!-- End right sidebar -->

  </div>
  <!-- End wrapper -->

  <!-- Start footer -->
  <?php require_once "../../layout/script.php"; ?>
  <!-- End footer -->

</body>

</html>