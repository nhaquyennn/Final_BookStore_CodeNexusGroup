<?php
session_start();

// Kiểm tra nếu session 'user' không tồn tại
if (!isset($_SESSION['user'])) {
  header("Location: ../../user/login.php?error=Vui lòng đăng nhập.");
  exit();
}

// include file controller
require_once __DIR__ . '/../../controller/phieuMuonController.php';


// Khởi tạo Controller và xử lý yêu cầu
$controller = new PhieuMuonController($conn);
if (isset($_GET['action']) && $_GET['action'] === 'searchPM') {
  $controller->searchPM();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tìm kiếm Phiếu Mượn</title>
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
      <div class="container-fluid">
        <!-- Card Tìm Kiếm -->
        <div class="card mt-4 shadow border-0">
          <div class="card-header bg-light text-dark text-center">
            <h4 class="fw-semibold">Tìm kiếm Phiếu Mượn</h4>
          </div>
          <div class="card-body">
            <form action="../../controller/phieuMuonController.php?action=searchPM" method="POST">
              <div class="row justify-content-center">
                <div class="col-md-8">
                  <div class="input-group">
                    <input type="text" name="idPM" class="form-control form-control-lg shadow-sm"
                      placeholder="Nhập mã phiếu mượn" required>
                    <button class="btn btn-primary btn-lg px-4 shadow-sm" type="submit">
                      <i class="fas fa-magnifying-glass me-2"></i>Tìm kiếm
                    </button>
                  </div>
                </div>
              </div>
            </form>

            <!-- Hiển thị thông báo lỗi -->
            <?php if (isset($_GET['error'])): ?>
              <div class="alert alert-danger mt-4 text-center shadow-sm">
                <?php echo htmlspecialchars($_GET['error']); ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>


    <!--End content-wrapper-->

    <!--Start Back To Top Button-->
    <a href="javascript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i></a>
    <!--End Back To Top Button-->

    <!--Start footer-->
    <?php require_once "../../layout/script.php"; ?>
    <!--End footer-->

  </div>
  <!--End wrapper-->
</body>

</html>