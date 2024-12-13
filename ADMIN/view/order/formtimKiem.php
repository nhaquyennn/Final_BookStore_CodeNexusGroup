<?php
session_start();

// Kiểm tra nếu session 'user' không tồn tại
if (!isset($_SESSION['user'])) {
  header("Location: ../../user/login.php?error=Vui lòng đăng nhập.");
  exit();
}

// Include file controller
require_once __DIR__ . '/../../controller/phieuMuonController.php';

// Khởi tạo Controller
$controller = new PhieuMuonController();
$searchResult = null;

// Xử lý dữ liệu từ form tìm kiếm
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idPM'])) {
  $searchID = $_POST['idPM'];
  $searchResult = $controller->search($searchID);
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
  <div id="wrapper">

    <div class="clearfix"></div>

    <!-- Start content -->
    <div class="content-wrapper">
      <div class="container-fluid">
        <!--Start sidebar-wrapper-->
        <?php require_once "../../layout/left_sidebar.php"; ?>
        <!--End sidebar-wrapper-->

        <!--Start topbar header-->
        <header class="topbar-nav">
          <?php require_once "../../layout/topbar.php"; ?>
        </header>
        <!--End topbar header-->
        <!-- Card Tìm Kiếm -->
        <div class="card mt-4 shadow border-0">
          <div class="card-header bg-dark text-white text-center">
            <h4 class="fw-semibold">Tìm kiếm Phiếu Mượn</h4>
          </div>
          <div class="card-body">
            <form action="./formtimKiem.php" method="POST">
              <div class="row justify-content-center">
                <div class="col-md-8">
                  <div class="input-group shadow-sm">
                    <input type="text" name="idPM" class="form-control form-control-lg" placeholder="Nhập mã phiếu mượn"
                      required>
                    <button class="btn btn-primary btn-lg px-4" type="submit">
                      <i class="fas fa-search me-2"></i>Tìm kiếm
                    </button>
                  </div>
                </div>
              </div>
            </form>

            <hr class="my-4">

            <!-- Kết quả tìm kiếm -->
            <?php if ($searchResult): ?>
              <h2 class="text-center">Kết quả tìm kiếm:</h2>
              <table class="table table-bordered mt-4">
                <thead>
                  <tr>
                    <th>Mã Phiếu Mượn</th>
                    <th>Ngày Tạo</th>
                    <th>Tổng Tiền</th>
                    <th>Giảm Giá</th>
                    <th>Tình Trạng</th>
                    <th>Khách Hàng</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?= $searchResult['MaPhieuMuon'] ?></td>
                    <td><?= $searchResult['NgayTao'] ?></td>
                    <td><?= number_format($searchResult['TongTien']) ?> VND</td>
                    <td><?= $searchResult['GiamGia'] ?>%</td>
                    <td><?= $searchResult['tinhTrang'] ?></td>
                    <td><?= $searchResult['tenKH'] ?></td>
                  </tr>
                </tbody>
              </table>
            <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
              <div class="alert alert-warning text-center">Không tìm thấy phiếu mượn với ID:
                <?= htmlspecialchars($searchID) ?>
              </div>
            <?php endif; ?>

            <!-- Thông báo lỗi -->
            <?php if (isset($_GET['error'])): ?>
              <div class="alert alert-danger mt-4 text-center">
                <?= htmlspecialchars($_GET['error']) ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    <!-- End content -->

    <!-- Footer -->
    <?php require_once "../../layout/script.php"; ?>
  </div>
</body>

</html>