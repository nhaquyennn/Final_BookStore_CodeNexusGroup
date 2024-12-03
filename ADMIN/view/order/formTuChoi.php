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
    <div class="content-wrapper d-flex justify-content-center align-items-center vh-100">
      <!--Card Content-->
      <div class="custom-card text-center">
        <h4 class="mb-4">Bạn có chắc chắn muốn từ chối đơn hàng?</h4>
        <div class="d-flex justify-content-center">
          <a href="danhSachDonHang.php" class="btn btn-danger me-3 px-4">Từ chối</a>
          <button class="btn btn-secondary px-4">Hủy</button>
        </div>
      </div>
      <!--End Card Content-->
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