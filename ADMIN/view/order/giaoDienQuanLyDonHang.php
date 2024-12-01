<?php
session_start();

// Kiểm tra nếu session 'user' không tồn tại
if (!isset($_SESSION['user'])) {
  header("Location: ../../user/login.php?error=Vui lòng đăng nhập.");
  exit();
}

// Lấy dữ liệu từ GET (nếu có)
$data = isset($_GET['data']) ? json_decode(urldecode($_GET['data']), true) : null;
$error = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : null;
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

        <!--Start Dashboard Content-->
        <div class="card mt-3">
          <div class="card-body">
            <h4 class="text-white">Quản lý đơn hàng</h4>

            <!-- Hiển thị lỗi nếu có -->
            <?php if ($error): ?>
              <div class="alert alert-danger"><?= $error ?></div>
            <?php elseif ($data): ?>
              <!-- Hiển thị bảng thông tin đơn hàng -->
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Mã Phiếu Mượn</th>
                    <th>Tên Người Mượn</th>
                    <th>Số Lượng</th>
                    <th>Ngày Mượn</th>
                    <th>Trạng Thái</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($data as $row): ?>
                    <tr>
                      <td><?= htmlspecialchars($row['maPhieuMuon']) ?></td>
                      <td><?= htmlspecialchars($row['tenNguoiMuon']) ?></td>
                      <td><?= htmlspecialchars($row['soLuong']) ?></td>
                      <td><?= htmlspecialchars($row['ngayMuon']) ?></td>
                      <td><?= htmlspecialchars($row['trangThai']) ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            <?php else: ?>
              <!-- Thông báo nếu không có dữ liệu -->
              <div class="alert alert-info">Không có dữ liệu để hiển thị.</div>
            <?php endif; ?>
          </div>
        </div>
        <!--End Dashboard Content-->

        <!--start overlay-->
        <div class="overlay toggle-menu"></div>
        <!--end overlay-->


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