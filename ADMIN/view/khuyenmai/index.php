<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user'])) {
  header("Location: ../../user/login.php?error=Vui lòng đăng nhập.");
  exit();
}

require_once '../../controller/KhuyenMaiController.php';
require_once '../../database/db_connect.php';

// Khởi tạo controller
$controller = new KhuyenMaiController($conn);

// Lấy danh sách khuyến mãi
$khuyenMaiList = $controller->index();

// Xử lý tìm kiếm
$searchResult = null;
if (isset($_GET['search'])) {
  $searchId = $_GET['search'];
  $searchResult = $controller->search($searchId);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once "../../layout/header.php"; ?>
  <title>Quản lý Khuyến mãi</title>
</head>

<body class="bg-theme bg-theme9">
  <div id="wrapper">
    <!-- Sidebar -->
    <?php require_once "../../layout/left_sidebar.php"; ?>

    <!-- Topbar -->
    <header class="topbar-nav">
      <?php require_once "../../layout/topbar.php"; ?>
    </header>

    <div class="clearfix"></div>
    <div class="content-wrapper">
      <div class="container-fluid">
        <div class="card mt-3">
          <div class="card-body">
            <h3 class="text-center">Danh sách Khuyến mãi</h3>

            <!-- Form tìm kiếm và nút thêm mới -->
            <div class="d-flex justify-content-between align-items-center mb-3">
              <form method="GET" action="" class="d-flex flex-grow-1 align-items-center">
                <input type="text" class="form-control me-2" name="search" placeholder="Nhập mã khuyến mãi" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                <button type="submit" class="btn btn-primary px-3">Tìm kiếm</button>
              </form>
              <a href="crud/add.php" class="btn btn-success px-4 ms-3 d-flex align-items-center">
                <span>+ Thêm</span>
              </a>
            </div>



            <!-- Bảng danh sách khuyến mãi -->
            <table class="table table-bordered table-hover">
              <thead class="thead-dark">
                <tr>
                  <th>ID</th>
                  <th>Tên Khuyến mãi</th>
                  <th>Giảm giá (%)</th>
                  <th>Ngày bắt đầu</th>
                  <th>Ngày kết thúc</th>
                  <th>Mã CTPM</th>
                  <th>Hành động</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($searchResult): ?>
                  <!-- Kết quả tìm kiếm -->
                  <tr>
                    <td><?= isset($searchResult['MaKhuyenMai']) ? $searchResult['MaKhuyenMai'] : 'N/A' ?></td>
                    <td><?= isset($searchResult['TenKhuyenMai']) ? $searchResult['TenKhuyenMai'] : 'N/A' ?></td>
                    <td><?= isset($searchResult['PhanTramGiamGia']) ? $searchResult['PhanTramGiamGia'] . '%' : 'N/A' ?></td>
                    <td><?= isset($searchResult['NgayBatDau']) ? $searchResult['NgayBatDau'] : 'N/A' ?></td>
                    <td><?= isset($searchResult['NgayKetThuc']) ? $searchResult['NgayKetThuc'] : 'N/A' ?></td>
                    <td><?= isset($searchResult['maCTPM']) ? $searchResult['maCTPM'] : 'N/A' ?></td>
                    <td>
                      <a href="crud/edit.php?id=<?= $searchResult['MaKhuyenMai'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                      <a href="crud/delete.php?id=<?= $searchResult['MaKhuyenMai'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa không?');">Xóa</a>
                    </td>
                  </tr>
                <?php elseif (!empty($khuyenMaiList)): ?>
                  <!-- Danh sách khuyến mãi -->
                  <?php foreach ($khuyenMaiList as $km): ?>
                    <tr>
                      <td><?= $km['MaKhuyenMai'] ?></td>
                      <td><?= $km['TenKhuyenMai'] ?></td>
                      <td><?= $km['PhanTramGiamGia'] ?>%</td>
                      <td><?= $km['NgayBatDau'] ?></td>
                      <td><?= $km['NgayKetThuc'] ?></td>
                      <td><?= $km['maCTPM'] ?></td>
                      <td>
                        <a href="crud/edit.php?id=<?= $km['MaKhuyenMai'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                        <a href="crud/delete.php?id=<?= $km['MaKhuyenMai'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa không?');">Xóa</a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="7" class="text-center">Không có khuyến mãi nào.</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Right Sidebar -->
    <?php require_once "../../layout/right_sidebar.php"; ?>
  </div>

  <!-- Footer Scripts -->
  <?php require_once "../../layout/script.php"; ?>
</body>

</html>