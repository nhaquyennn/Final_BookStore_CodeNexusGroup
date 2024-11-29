<?php
require_once 'controlUser/controlProfile.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once "layout/header.php"; ?>
</head>

<body class="bg-theme bg-theme9">
  <div class="clearfix"></div>
  <div class="content-wrapper">
    <div class="container-fluid">
      <div id="wrapper">

        <!-- Sidebar -->
        <?php require_once "layout/left_sidebar.php"; ?>
        <!-- End Sidebar -->

        <!-- Topbar -->
        <header class="topbar-nav">
          <?php require_once "layout/topbar.php"; ?>
        </header>
        <!-- End Topbar -->

        <!-- Main Content -->
        <div class="row mt-3">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">

                <ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
                  <li class="nav-item">
                    <a href="#profile" data-toggle="tab" class="nav-link active">
                      <i class="icon-user"></i> <span class="hidden-xs">Thông tin</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#edit" data-toggle="tab" class="nav-link">
                      <i class="icon-note"></i> <span class="hidden-xs">Sửa thông tin</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#pw_change" data-toggle="tab" class="nav-link">
                      <i class="icon-lock"></i> <span class="hidden-xs">Đổi mật khẩu</span>
                    </a>
                  </li>
                </ul>

                <div class="tab-content p-3">
                  <!-- Thông tin cá nhân -->
                  <div class="tab-pane active" id="profile">
                    <div class="row">
                      <div class="col-md-12">
                        <h4 class="text-center mt-2 mb-3">THÔNG TIN CÁ NHÂN</h4>
                        <div class="table-responsive">
                          <table class="table table-hover table-striped">
                            <tbody>
                              <tr>
                                <th>Họ và tên:</th>
                                <td><?php echo htmlspecialchars($user['tenNguoiDung']); ?></td>
                              </tr>
                              <tr>
                                <th>Email:</th>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                              </tr>
                              <tr>
                                <th>Chức vụ:</th>
                                <td><?php echo htmlspecialchars($user['chucVu']); ?></td>
                              </tr>
                              <tr>
                                <th>Mã nhân viên:</th>
                                <td><?php echo htmlspecialchars($user['maNhanVien']); ?></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Sửa thông tin -->
                  <?php if (!empty($error)): ?>
                    <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
                  <?php endif; ?>
                  <div class="tab-pane" id="edit">
                    <form method="POST" action="controlUser/controlProfile.php">
                      <input type="hidden" name="maNguoiDung"
                        value="<?php echo htmlspecialchars($user['maNhanVien']); ?>">

                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Tên nhân viên</label>
                        <div class="col-lg-9">
                          <input class="form-control" type="text" name="tenNguoiDung"
                            value="<?php echo htmlspecialchars($user['tenNguoiDung']); ?>" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Email</label>
                        <div class="col-lg-9">
                          <input class="form-control" type="email" name="email"
                            value="<?php echo htmlspecialchars($user['email']); ?>" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-lg-9 offset-lg-3">
                          <input type="reset" class="btn btn-secondary" value="Hủy">
                          <input type="submit" class="btn btn-primary" value="Lưu thay đổi">
                        </div>
                      </div>
                    </form>
                  </div>

                  <!-- Đổi mật khẩu -->
                  <div class="tab-pane" id="pw_change">
                    <form method="POST" action="controlChangePassword.php">
                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Mật khẩu cũ</label>
                        <div class="col-lg-9">
                          <input class="form-control" type="password" name="old_password" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Mật khẩu mới</label>
                        <div class="col-lg-9">
                          <input class="form-control" type="password" name="new_password" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Xác nhận mật khẩu mới</label>
                        <div class="col-lg-9">
                          <input class="form-control" type="password" name="confirm_password" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-9 offset-lg-3">
                          <input type="reset" class="btn btn-secondary" value="Hủy">
                          <input type="submit" class="btn btn-primary" value="Lưu thay đổi">
                        </div>
                      </div>
                    </form>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
        <!-- End Main Content -->

        <!-- Right Sidebar -->
        <?php require_once "layout/right_sidebar.php"; ?>
        <!-- End Right Sidebar -->

        <!-- Footer -->
        <?php require_once "layout/script.php"; ?>
        <!-- End Footer -->

      </div>
    </div>
  </div>
</body>

</html>