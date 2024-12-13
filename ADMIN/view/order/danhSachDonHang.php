<?php

// Hiển thị lỗi để hỗ trợ debug
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

// Gọi Controller để lấy dữ liệu
require_once "../../controller/phieuMuonController.php";

// Xử lý các hành động từ form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['action'] ?? null;
  $maPhieuMuon = $_POST['MaPhieuMuon'] ?? null;

  if (!$action || !$maPhieuMuon) {
    $_SESSION['error'] = "Dữ liệu không hợp lệ.";
    header("Location: danhSachDonHang.php");
    exit();
  }

  $controller = new PhieuMuonController();

  switch ($action) {
    case 'duyet':
      $controller->duyetDonHang($maPhieuMuon);
      break;

    case 'tuChoi':
      header("Location: formTuChoi.php?MaPhieuMuon=$maPhieuMuon");
      exit();

    default:
      $_SESSION['error'] = "Hành động không hợp lệ.";
      header("Location: danhSachDonHang.php");
      exit();
  }
}

// Lấy danh sách phiếu mượn và thông báo
try {
  $controller = new PhieuMuonController();
  $data = $controller->getDanhSachPhieuMuon();
  $error = $controller->getError();
} catch (Exception $e) {
  $error = "Đã xảy ra lỗi khi tải dữ liệu: " . $e->getMessage();
  $data = [];
}

$success = $_SESSION['success'] ?? '';
$error = $_SESSION['error'] ?? $error;
unset($_SESSION['success'], $_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once "../../layout/header.php"; ?>
</head>

<body class="bg-theme bg-theme9">
  <div id="wrapper">


    <div class="clearfix"></div>

    <div class="content-wrapper">
      <div class="container-fluid">
        <?php require_once "../../layout/left_sidebar.php"; ?>
        <header class="topbar-nav">
          <?php require_once "../../layout/topbar.php"; ?>
        </header>
        <div class="container mt-4">
          <h2>Danh sách đơn hàng</h2>

          <!-- Hiển thị thông báo thành công -->
          <?php if (!empty($success)): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
          <?php endif; ?>

          <!-- Hiển thị lỗi nếu có -->
          <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
          <?php endif; ?>

          <!-- Bảng danh sách đơn hàng -->
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Mã đơn hàng</th>
                <th>Khách hàng</th>
                <th>Ngày đặt hàng</th>
                <th>Trạng thái</th>
                <th>Tổng giá trị</th>
                <th>Hành động</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($data)): ?>
                <?php foreach ($data as $row): ?>
                  <tr>
                    <td><?= htmlspecialchars($row['MaPhieuMuon']) ?></td>
                    <td><?= htmlspecialchars($row['tenKH']) ?></td>
                    <td><?= htmlspecialchars($row['NgayTao']) ?></td>
                    <td>
                      <?php if ($row['tinhTrang'] === 'Đang xử lý'): ?>
                        <span class="badge bg-warning"><?= htmlspecialchars($row['tinhTrang']) ?></span>
                      <?php elseif ($row['tinhTrang'] === 'Đã xác nhận'): ?>
                        <span class="badge bg-info"><?= htmlspecialchars($row['tinhTrang']) ?></span>
                      <?php elseif ($row['tinhTrang'] === 'Đã hủy'): ?>
                        <span class="badge bg-dark"><?= htmlspecialchars($row['tinhTrang']) ?></span>
                      <?php elseif ($row['tinhTrang'] === 'Đang giao hàng'): ?>
                        <span class="badge bg-primary"><?= htmlspecialchars($row['tinhTrang']) ?></span>
                      <?php elseif ($row['tinhTrang'] === 'Đã hoàn tất'): ?>
                        <span class="badge bg-success"><?= htmlspecialchars($row['tinhTrang']) ?></span>
                      <?php endif; ?>

                    </td>
                    <td><?= htmlspecialchars(number_format($row['TongTien'] - $row['GiamGia'], 0)) ?> VND</td>
                    <td>
                      <!-- Form Duyệt -->
                      <form method="POST" action="danhSachDonHang.php" style="display:inline;">
                        <input type="hidden" name="MaPhieuMuon" value="<?= htmlspecialchars($row['MaPhieuMuon']) ?>">
                        <button type="submit" name="action" value="duyet" class="btn btn-success btn-sm"
                          <?= in_array($row['tinhTrang'], ['Đã xác nhận', 'Đang giao hàng', 'Đã hoàn tất']) ? 'disabled' : '' ?>>
                          Xác nhận
                        </button>
                      </form>

                      <!-- Nút Từ chối -->
                      <form method="GET" action="formTuChoi.php" style="display:inline;">
                        <input type="hidden" name="MaPhieuMuon" value="<?= htmlspecialchars($row['MaPhieuMuon']) ?>">
                        <button type="submit" class="btn btn-danger btn-sm" <?= in_array($row['tinhTrang'], ['Đã hủy', 'Đã hoàn tất']) ? 'disabled' : '' ?>>
                          Từ chối
                        </button>
                      </form>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="7" class="text-center">Không có dữ liệu.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i></a>
    <?php require_once "../../layout/right_sidebar.php"; ?>
  </div>
  <?php require_once "../../layout/script.php"; ?>
</body>

</html>