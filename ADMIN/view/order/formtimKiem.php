<?php
session_start();

// Kiểm tra nếu session 'user' không tồn tại
if (!isset($_SESSION['user'])) {
  header("Location: ../../user/login.php?error=Vui lòng đăng nhập.");
  exit();
}

require_once "../../controller/OrderController.php";
require_once "../../database/db_connect.php";

// Xử lý yêu cầu POST từ form
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['idPM'])) {
  $controller = new OrderController($GLOBALS['conn']);
  $controller->searchDH($_POST['idPM']);
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

        <!-- Form nhập liệu -->
        <div class="card mt-3">
          <div class="card-body">
            <h4 class="text-white">Tìm kiếm phiếu mượn</h4>
            <!-- Form tìm kiếm -->
            <form method="POST" action="">
              <div class="form-group">
                <label for="idPM" class="text-white">Nhập mã phiếu mượn:</label>
                <input type="text" id="idPM" name="idPM" class="form-control"
                  placeholder="Nhập mã phiếu mượn..." required>
              </div>
              <button type="submit" class="btn btn-primary mt-3">Tìm Kiếm</button>
            </form>
          </div>
        </div>
        <!--End Form kiểm tra cú pháp-->

        <!--Start Kết quả kiểm tra-->
        <?php if (!empty($result)): ?>
          <div class="card mt-3">
            <div class="card-body">
              <h4 class="text-white">Kết quả kiểm tra cú pháp</h4>
              <p class="text-success"><?= htmlspecialchars($result) ?></p>
            </div>
          </div>
        <?php endif; ?>
        <!--End Kết quả kiểm tra-->

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