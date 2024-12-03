<?php
session_start();
// Kiểm tra nếu session 'user' không tồn tại (nghĩa là người dùng chưa đăng nhập)
if (!isset($_SESSION['user'])) {
  // Nếu chưa đăng nhập, chuyển hướng về trang login
  header("Location: ../../user/login.php?error=Vui lòng đăng nhập.");
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

    <!--Start sidebar-wrapper-->
    <?php require_once "../../layout/left_sidebar.php"; ?>
    <!--End sidebar-wrapper-->

    <!--Start topbar header-->
    <header class="topbar-nav">
      <?php require_once "../../layout/topbar.php"; ?>
    </header>
    <!--End topbar header-->

    <div class="clearfix"></div>

    <!--Start content-wrapper-->
    <div class="content-wrapper">

      <!--Start container-fluid-->
      <div class="container-fluid">

        <!--Start Dashboard Content-->
        <div class="container mt-4">
          <h2>Danh sách đơn hàng</h2>

          <!-- Bảng danh sách đơn hàng -->
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Mã đơn hàng</th>
                <th>Khách hàng</th>
                <th>Ngày đặt hàng</th>
                <th>Trạng thái</th>
                <th>Tổng giá trị</th>
                <th>Hành động</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>DH001</td>
                <td>Nguyễn Văn A</td>
                <td>01/12/2024</td>
                <td><span class="badge bg-warning">Chưa duyệt</span></td>
                <td>1,500,000 VND</td>
                <td>
                  <button class="btn btn-success btn-sm">Duyệt</button>
                  <a href="formTuChoi.php" class="btn btn-danger btn-sm">Từ chối</a>
                </td>
              </tr>
              <tr>
                <td>DH002</td>
                <td>Trần Thị B</td>
                <td>01/12/2024</td>
                <td><span class="badge bg-success">Đã duyệt</span></td>
                <td>3,200,000 VND</td>
                <td>
                  <button class="btn btn-secondary btn-sm" disabled>Duyệt</button>
                  <button class="btn btn-secondary btn-sm" disabled>Từ chối</button>
                </td>
              </tr>
            </tbody>
          </table>
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