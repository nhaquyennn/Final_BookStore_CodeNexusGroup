<?php
session_start();
// Kiểm tra nếu session 'user' không tồn tại 
if (!isset($_SESSION['user'])) {
  // Nếu chưa đăng nhập, chuyển hướng về trang login
  header("Location: user/login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once "layout/header.php" ?>
</head>

<body class="bg-theme bg-theme9">
  <!-- Start wrapper-->
  <div id="wrapper">
    <div class="clearfix"></div>
    <div class="content-wrapper">
      <div class="container-fluid">

        <!--Start sidebar-wrapper-->
        <?php require_once "layout/left_sidebar.php" ?>
        <!--End sidebar-wrapper-->

        <!--Start topbar header-->
        <header class="topbar-nav">
          <?php require_once "layout/topbar.php" ?>
        </header>
        <!--End topbar header-->

        <!--Start Dashboard Content-->

        <!--End Dashboard Content-->

        <!--start overlay-->
        <div class="overlay toggle-menu"></div>
        <!--end overlay-->

        <!--Start Charts-->

        <!--End Charts-->
      </div>
      <!-- End container-fluid-->

    </div>
    <!--End content-wrapper-->

    <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->

    <!--Start right sidebar-->
    <?php require_once "layout/right_sidebar.php" ?>
    <!--End right sidebar-->

  </div>
  <!--End wrapper-->

  <!--Start footer-->
  <?php require_once "layout/script.php" ?>
  <!--End footer-->

</body>

</html>