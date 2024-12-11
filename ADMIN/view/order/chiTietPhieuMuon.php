<?php
session_start();
// Kiểm tra nếu session 'user' không tồn tại (nghĩa là người dùng chưa đăng nhập)
if (!isset($_SESSION['user'])) {
  // Nếu chưa đăng nhập, chuyển hướng về trang login
  header("Location: ../../user/login.php?error=Vui lòng đăng nhập.");
  exit();
}

if (isset($_GET['data'])) {
  $phieuMuonDetails = json_decode($_GET['data'], true); // Giải mã JSON thành mảng PHP
} else {
  header("Location: formTimKiem.php?error=Không tìm thấy dữ liệu phiếu mượn.");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once "../../layout/header.php"; ?>
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
        <?php require_once "../../layout/left_sidebar.php"; ?>
        <!--End sidebar-wrapper-->

        <!--Start topbar header-->
        <header class="topbar-nav">
          <?php require_once "../../layout/topbar.php"; ?>
        </header>
        <!--End topbar header-->
        <!--Start Dashboard Content-->
        <div class="card">
          <div class="card-header bg-primary text-white text-center">
            <h4>Chi Tiết Phiếu Mượn</h4>
          </div>
          <div class="card-body">
            <?php if ($phieuMuonDetails): ?>
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <th>Mã phiếu mượn:</th>
                    <td><?php echo htmlspecialchars($phieuMuonDetails['MaPhieuMuon']); ?></td>
                  </tr>
                  <tr>
                    <th>Ngày tạo:</th>
                    <td><?php echo htmlspecialchars($phieuMuonDetails['NgayTao']); ?></td>
                  </tr>
                  <tr>
                    <th>Tổng tiền:</th>
                    <td><?php echo number_format($phieuMuonDetails['TongTien'], 0, ',', '.'); ?> VND</td>
                  </tr>
                  <tr>
                    <th>Giảm giá:</th>
                    <td><?php echo number_format($phieuMuonDetails['GiamGia'], 0, ',', '.'); ?> VND</td>
                  </tr>
                  <tr>
                    <th>Phương thức thanh toán:</th>
                    <td><?php echo htmlspecialchars($phieuMuonDetails['PhuongThucThanhToan']); ?></td>
                  </tr>
                  <tr>
                    <th>Tình trạng:</th>
                    <td>
                      <span
                        class="badge 
                                        <?php echo ($phieuMuonDetails['tinhTrang'] === 'Đã duyệt') ? 'bg-success' : 'bg-warning'; ?>">
                        <?php echo htmlspecialchars($phieuMuonDetails['tinhTrang']); ?>
                      </span>
                    </td>
                  </tr>
                </tbody>
              </table>
            <?php else: ?>
              <div class="alert alert-danger text-center">
                Không có chi tiết phiếu mượn để hiển thị.
              </div>
            <?php endif; ?>
            <div class="mt-4 text-center">
              <a href="formTimKiem.php" class="btn btn-secondary">Quay lại Tìm kiếm</a>
            </div>
          </div>
        </div>
        <!--End Dashboard Content-->

        <!--start overlay-->
        <div class="overlay toggle-menu"></div>
        <!--end overlay-->


      </div>
      <!-- End container-fluid-->

    </div>
    <!--End content-wrapper-->

    <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->

    <!--Start right sidebar-->
    <?php require_once "../../layout/right_sidebar.php"; ?>
    <!--End right sidebar-->

  </div>
  <!--End wrapper-->

  <!--Start footer-->
  <?php require_once "../../layout/script.php"; ?>
  <!--End footer-->

</body>

</html>