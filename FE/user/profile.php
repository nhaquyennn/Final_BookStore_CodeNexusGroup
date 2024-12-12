<?php
require_once '../controlUser/controlProfile.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once "../layout/header_profile.php"; ?>
  <style>
    /* Đảm bảo chiều cao của body chiếm toàn màn hình */
    html,
    body {
      height: 100%;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .main-content {
      width: 100%;
      max-width: 1200px;
      background-color: #f8f9fa;
      padding: 20px;
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .back-to-home-btn {
      display: inline-block;
      padding: 10px 20px;
      background-color: white;
      color: black;
      text-decoration: none;
      border-radius: 5px;
      font-size: 16px;
      font-weight: bold;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .back-to-home-btn:hover {
      background-color: #14ABEF;
      transform: scale(1.05);
    }
  </style>
</head>

<body class="bg-theme bg-theme9">
  <div class="clearfix"></div>
  <div>
    <div class="container-fluid">
      <div id="wrapper">
        <!-- Main Content -->
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div style="text-align: center; margin-top: 20px;">
                <a href="../index.php" class="back-to-home-btn">Quay trở lại trang chủ</a>
              </div>
              <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
                  <li class="nav-item">
                    <a href="#profile" data-toggle="tab"
                      class="nav-link <?php echo (!isset($error)) ? 'active' : ''; ?>">
                      <i class="icon-user"></i> <span class="hidden-xs">Thông tin</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#edit" data-toggle="tab" class="nav-link">
                      <i class="icon-note"></i> <span class="hidden-xs">Sửa thông tin</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#pw_change" data-toggle="tab"
                      class="nav-link <?php echo isset($error) ? 'active' : ''; ?>">
                      <i class="icon-lock"></i> <span class="hidden-xs">Đổi mật khẩu</span>
                    </a>
                  </li>
                </ul>

                <div class="tab-content p-3">
                  <!-- Thông tin cá nhân -->
                  <div class="tab-pane <?php echo (!isset($error) && !isset($error_edit)) ? 'active' : ''; ?>"
                    id="profile">
                    <div class="row">
                      <div class="col-md-12">
                        <h4 class="text-center mt-2 mb-3">THÔNG TIN CÁ NHÂN</h4>
                        <div class="table-responsive">
                          <table class="table table-hover table-striped">
                            <tbody>
                              <tr>
                                <th>Mã khách hàng:</th>
                                <td><?php echo htmlspecialchars($user['maKH']); ?></td>
                              </tr>
                              <tr>
                                <th>Họ và tên:</th>
                                <td><?php echo htmlspecialchars($user['tenKH']); ?></td>
                              </tr>
                              <tr>
                                <th>Email:</th>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                              </tr>
                              <tr>
                                <th>Địa chỉ:</th>
                                <td><?php echo htmlspecialchars($user['diaChi']); ?></td>
                              </tr>
                              <tr>
                                <th>Giới tính:</th>
                                <td><?php echo htmlspecialchars($user['gioiTinh']); ?></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Sửa thông tin -->
                  <div class="tab-pane <?php echo isset($error_edit) ? 'active' : ''; ?>" id="edit">
                    <form method="POST" action="">
                      <?php if (!empty($error_edit)): ?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($error_edit); ?></div>
                      <?php endif; ?>
                      <input type="hidden" name="update_profile" value="1">
                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Tên khách hàng</label>
                        <div class="col-lg-9">
                          <input class="form-control" type="text" name="tenNguoiDung"
                            value="<?php echo htmlspecialchars($user['tenKH']); ?>" required>
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
                  <div class="tab-pane <?php echo isset($error) ? 'active' : ''; ?>" id="pw_change">
                    <form method="POST" action="">
                      <?php if (!empty($error)): ?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                      <?php endif; ?>
                      <input type="hidden" name="change_password" value="1">
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
                        <label class="col-lg-3 col-form-label form-control-label">Xác nhận mật khẩu</label>
                        <div class="col-lg-9">
                          <input class="form-control" type="password" name="confirm_password" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-9 offset-lg-3">
                          <input type="reset" class="btn btn-secondary" value="Hủy">
                          <input type="submit" class="btn btn-primary" value="Đổi mật khẩu">
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

      </div>
    </div>
  </div>

  <?php require_once "../layout/script_profile.php"; ?>

</body>

</html>