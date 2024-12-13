<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Bắt đầu session
session_start();

// Kiểm tra nếu người dùng chưa đăng nhập
if (!isset($_SESSION['user'])) {
  header("Location: ../../user/login.php?error=Vui lòng đăng nhập.");
  exit();
}

// Gọi Controller
require_once "../../controller/phieuMuonController.php";

// Nhận mã phiếu mượn từ GET
$maPhieuMuon = $_GET['MaPhieuMuon'] ?? null;

if (!$maPhieuMuon) {
  $_SESSION['error'] = "Mã phiếu mượn không hợp lệ.";
  header("Location: danhSachDonHang.php");
  exit();
}

// Xử lý các hành động từ form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['action'] ?? null;

  if (!$action || !$maPhieuMuon) {
    $_SESSION['error'] = "Dữ liệu không hợp lệ.";
    header("Location: danhSachDonHang.php");
    exit();
  }

  $controller = new PhieuMuonController();

  switch ($action) {
    case 'xacNhanTuChoi':
      $controller->tuChoiDonHang($maPhieuMuon); // Gọi hàm xử lý từ chối
      break;

    default:
      $_SESSION['error'] = "Hành động không hợp lệ.";
      header("Location: danhSachDonHang.php");
      exit();
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once "../../layout/header.php"; ?>
</head>

<body class="bg-theme bg-theme9">
  <div id="wrapper">
    <div class="clearfix"></div>

    <!-- Nội dung chính -->
    <?php require_once "../../layout/left_sidebar.php"; ?>
    <header class="topbar-nav">
      <?php require_once "../../layout/topbar.php"; ?>
    </header>

    <div class="content-wrapper d-flex justify-content-center align-items-center vh-100">
      <div class="custom-card text-center">
        <h4 class="mb-4">Bạn có chắc chắn muốn từ chối đơn hàng với mã:
          <strong><?= htmlspecialchars($maPhieuMuon) ?></strong>?
        </h4>
        <form method="POST" action="">
          <input type="hidden" name="action" value="xacNhanTuChoi"> <!-- Gửi action 'xacNhanTuChoi' -->
          <input type="hidden" name="MaPhieuMuon" value="<?= htmlspecialchars($maPhieuMuon) ?>"> <!-- Mã phiếu mượn -->
          <div class="d-flex justify-content-center mt-4">
            <!-- Nút xác nhận từ chối -->
            <button type="submit" class="btn btn-danger me-3 px-4">Xác nhận từ chối</button>
            <!-- Nút hủy -->
            <a href="/Final_BookStore_CodeNexus/ADMIN/view/order/danhSachDonHang.php"
              class="btn btn-secondary px-4">Hủy</a>
          </div>
        </form>
      </div>
    </div>

    <!-- Nút quay lại đầu trang -->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i></a>
    <?php require_once "../../layout/right_sidebar.php"; ?>
  </div>

  <?php require_once "../../layout/script.php"; ?>
</body>

</html>