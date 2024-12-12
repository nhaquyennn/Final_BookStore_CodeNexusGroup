<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user'])) {
  header("Location: ../../../user/login.php?error=Vui lòng đăng nhập.");
  exit();
}

require_once '../../../controller/KhuyenMaiController.php';
require_once '../../../database/db_connect.php';

// Khởi tạo controller
$controller = new KhuyenMaiController($conn);

// Lấy ID từ URL
$id = $_GET['id'] ?? null;
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['confirm']) && $_POST['confirm'] === 'yes') {
    // Xóa khuyến mãi
    $result = $controller->delete($id);
    if ($result) {
      header("Location: ../index.php?success=Xóa khuyến mãi thành công.");
      exit();
    } else {
      $message = '<div class="alert alert-danger">Xóa khuyến mãi thất bại. Vui lòng thử lại.</div>';
    }
  } elseif (isset($_POST['confirm']) && $_POST['confirm'] === 'no') {
    // Quay lại trang index
    header("Location: ../index.php");
    exit();
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once "../../../layout/header.php"; ?>
  <title>Xóa Khuyến mãi</title>
</head>

<body class="bg-theme bg-theme9">
  <div id="wrapper">
    <!-- Sidebar -->
    <?php require_once "../../../layout/left_sidebar.php"; ?>

    <!-- Topbar -->
    <header class="topbar-nav">
      <?php require_once "../../../layout/topbar.php"; ?>
    </header>

    <div class="clearfix"></div>
    <div class="content-wrapper">
      <div class="container-fluid">
        <div class="card mt-3">
          <div class="card-body text-center">
            <h3 class="text-danger">Bạn có chắc muốn xóa khuyến mãi này không?</h3>
            <form method="POST" action="">
              <button type="submit" name="confirm" value="yes" class="btn btn-danger">Xác nhận</button>
              <button type="submit" name="confirm" value="no" class="btn btn-secondary">Hủy</button>
            </form>
            <?= $message ?>
          </div>
        </div>
      </div>
    </div>

    <!-- Right Sidebar -->
    <?php require_once "../../../layout/right_sidebar.php"; ?>
  </div>

  <!-- Footer Scripts -->
  <?php require_once "../../../layout/script.php"; ?>
</body>

</html>