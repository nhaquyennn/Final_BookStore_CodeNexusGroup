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

// Lấy thông tin khuyến mãi cần sửa
$id = $_GET['id'] ?? null;
$khuyenMai = null;
$message = '';

if ($id) {
  $khuyenMai = $controller->search($id);

  if (!$khuyenMai) {
    $message = '<div class="alert alert-danger">Không tìm thấy khuyến mãi.</div>';
  }
}

// Xử lý khi người dùng submit form sửa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = [
    'MaKhuyenMai' => $_POST['MaKhuyenMai'],
    'TenKhuyenMai' => $_POST['TenKhuyenMai'],
    'PhanTramGiamGia' => $_POST['PhanTramGiamGia'],
    'NgayBatDau' => $_POST['NgayBatDau'],
    'NgayKetThuc' => $_POST['NgayKetThuc'],
  ];

  $result = $controller->update($data);

  if (isset($result['error'])) {
    $message = '<div class="alert alert-danger">Lỗi: ' . htmlspecialchars($result['error']) . '</div>';
  } else {
    $message = '<div class="alert alert-success">Cập nhật khuyến mãi thành công!</div>';
    $khuyenMai = $controller->search($id); // Lấy lại dữ liệu mới
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once "../../../layout/header.php"; ?>
  <title>Sửa Khuyến mãi</title>
</head>

<body class="bg-theme bg-theme9">
  <div id="wrapper">

    <div class="clearfix"></div>
    <div class="content-wrapper">
      <div class="container-fluid">
        <!-- Sidebar -->
        <?php require_once "../../../layout/left_sidebar.php"; ?>

        <!-- Topbar -->
        <header class="topbar-nav">
          <?php require_once "../../../layout/topbar.php"; ?>
        </header>
        <div class="card mt-3">
          <div class="card-body">
            <h3 class="text-center">Sửa Khuyến mãi</h3>
            <?= $message ?>

            <?php if ($khuyenMai): ?>
              <!-- Form sửa -->
              <form method="POST" action="">
                <input type="hidden" name="MaKhuyenMai" value="<?= $khuyenMai['MaKhuyenMai'] ?>">
                <div class="mb-3">
                  <label for="TenKhuyenMai" class="form-label">Tên Khuyến mãi</label>
                  <input type="text" class="form-control" id="TenKhuyenMai" name="TenKhuyenMai"
                    value="<?= $khuyenMai['TenKhuyenMai'] ?>" required>
                </div>
                <div class="mb-3">
                  <label for="PhanTramGiamGia" class="form-label">Phần trăm giảm giá (%)</label>
                  <input type="number" class="form-control" id="PhanTramGiamGia" name="PhanTramGiamGia"
                    value="<?= $khuyenMai['PhanTramGiamGia'] ?>" required>
                </div>
                <div class="mb-3">
                  <label for="NgayBatDau" class="form-label">Ngày bắt đầu</label>
                  <input type="date" class="form-control" id="NgayBatDau" name="NgayBatDau"
                    value="<?= $khuyenMai['NgayBatDau'] ?>" required>
                </div>
                <div class="mb-3">
                  <label for="NgayKetThuc" class="form-label">Ngày kết thúc</label>
                  <input type="date" class="form-control" id="NgayKetThuc" name="NgayKetThuc"
                    value="<?= $khuyenMai['NgayKetThuc'] ?>" required>
                </div>
                <button type="submit" class="btn btn-success">Cập nhật</button>
                <a href="../index.php" class="btn btn-secondary">Quay lại</a>
              </form>
            <?php else: ?>
              <div class="alert alert-danger text-center">Không có dữ liệu để hiển thị.</div>
            <?php endif; ?>
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