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


// Lấy danh sách mã CTPM từ bảng khuyenmai
$ctpmList = $controller->getAllCTPMFromKhuyenMai();



// Xử lý khi người dùng submit form thêm mới
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = [
    'TenKhuyenMai' => $_POST['TenKhuyenMai'],
    'PhanTramGiamGia' => $_POST['PhanTramGiamGia'],
    'NgayBatDau' => $_POST['NgayBatDau'],
    'NgayKetThuc' => $_POST['NgayKetThuc'],
    'maCTPM' => $_POST['maCTPM']
  ];

  $result = $controller->add($data);

  if (isset($result['error'])) {
    $message = '<div class="alert alert-danger">Lỗi: ' . htmlspecialchars($result['error']) . '</div>';
  } else {
    $message = '<div class="alert alert-success">Thêm khuyến mãi thành công!</div>';
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once "../../../layout/header.php"; ?>
  <title>Thêm mới Khuyến mãi</title>
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
          <div class="card-body">
            <h3 class="text-center">Thêm mới Khuyến mãi</h3>
            <?= $message ?>

            <!-- Form thêm mới -->
            <form method="POST" action="">
              <div class="mb-3">
                <label for="TenKhuyenMai" class="form-label">Tên Khuyến mãi</label>
                <input type="text" class="form-control" id="TenKhuyenMai" name="TenKhuyenMai" required>
              </div>
              <div class="mb-3">
                <label for="PhanTramGiamGia" class="form-label">Phần trăm giảm giá (%)</label>
                <input type="number" class="form-control" id="PhanTramGiamGia" name="PhanTramGiamGia" required>
              </div>
              <div class="mb-3">
                <label for="NgayBatDau" class="form-label">Ngày bắt đầu</label>
                <input type="date" class="form-control" id="NgayBatDau" name="NgayBatDau" required>
              </div>
              <div class="mb-3">
                <label for="NgayKetThuc" class="form-label">Ngày kết thúc</label>
                <input type="date" class="form-control" id="NgayKetThuc" name="NgayKetThuc" required>
              </div>
              <div class="mb-3">
                <label for="maCTPM" class="form-label">Chọn Mã CTPM</label>
                <select class="form-control" id="maCTPM" name="maCTPM" required>
                  <option value="" selected disabled>-- Chọn mã CTPM --</option>
                  <?php foreach ($ctpmList as $ctpm): ?>
                    <option value="<?= $ctpm['maCTPM'] ?>"><?= $ctpm['maCTPM'] ?> </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <button type="submit" class="btn btn-success">Thêm mới</button>
              <a href="../index.php" class="btn btn-secondary">Quay lại</a>
            </form>
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