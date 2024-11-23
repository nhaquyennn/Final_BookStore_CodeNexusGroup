<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once "layout/header.php" ?>
</head>

<body class="bg-theme bg-theme9">
  <div class="clearfix"></div>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Start wrapper-->
      <div id="wrapper">

        <!--Start sidebar-wrapper-->
        <?php require_once "layout/left_sidebar.php" ?>
        <!--End sidebar-wrapper-->

        <!--Start topbar header-->
        <header class="topbar-nav">
          <?php require_once "layout/topbar.php" ?>
        </header>
        <!--End topbar header-->

        <!--Start main content-->
        <div class="row mt-3">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">

                <ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
                  <li class="nav-item">
                    <a href="javascript:void();" data-target="#profile" data-toggle="pill" class="nav-link active"><i
                        class="icon-user"></i> <span class="hidden-xs">Thông tin</span></a>
                  </li>
                  <li class="nav-item">
                    <a href="javascript:void();" data-target="#edit" data-toggle="pill" class="nav-link"><i
                        class="icon-note"></i> <span class="hidden-xs">Sửa thông tin</span></a>
                  </li>
                  <li class="nav-item">
                    <a href="javascript:void();" data-target="#pw_change" data-toggle="pill" class="nav-link"><i
                        class="icon-note"></i> <span class="hidden-xs">Đổi mật khẩu</span></a>
                  </li>
                </ul>

                <div class="tab-content p-3">
                  <div class="tab-pane active" id="profile">
                    <div class="row">
                      <div class="col-md-12">
                        <h4 class="mt-2 mb-3" style="text-align: center;">THÔNG TIN CÁ NHÂN </h4>
                        <div class="table-responsive">
                          <table class="table table-hover table-striped">
                            <tbody>
                              <tr>
                                <th>Họ và tên:</th>
                                <td>Nguyễn Văn A</td>
                              </tr>
                              <tr>
                                <th>Email:</th>
                                <td>nguyenvana@example.com</td>
                              </tr>
                              <tr>
                                <th>Chức vụ:</th>
                                <td>Quản lý</td>
                              </tr>
                              <tr>
                                <th>Mã nhân viên:</th>
                                <td>NV12345</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane" id="edit">
                    <form>
                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Họ và tên</label>
                        <div class="col-lg-9">
                          <input class="form-control" type="text" value="Nguyễn Văn A">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Email</label>
                        <div class="col-lg-9">
                          <input class="form-control" type="email" value="nguyenvana@example.com">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label"></label>
                        <div class="col-lg-9">
                          <input type="reset" class="btn btn-secondary" value="Hủy">
                          <input type="button" class="btn btn-primary" value="Lưu thay đổi">
                        </div>
                      </div>
                    </form>
                  </div>

                  <div class="tab-pane" id="pw_change">
                    <form>
                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Mật khẩu cũ</label>
                        <div class="col-lg-9">
                          <input class="form-control" type="password" value="11111122333">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Mật khẩu mới</label>
                        <div class="col-lg-9">
                          <input class="form-control" type="password" value="11111122333">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Xác nhận mật khẩu mới</label>
                        <div class="col-lg-9">
                          <input class="form-control" type="password" value="11111122333">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label"></label>
                        <div class="col-lg-9">
                          <input type="reset" class="btn btn-secondary" value="Hủy">
                          <input type="button" class="btn btn-primary" value="Lưu thay đổi">
                        </div>
                      </div>
                    </form>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
        <!--End main content-->

      </div>
      <!-- End wrapper-->

      <!--Start right sidebar-->
      <?php require_once "layout/right_sidebar.php" ?>
      <!--End right sidebar-->

      <!--Start footer-->
      <?php require_once "layout/script.php" ?>
      <!--End footer-->
    </div>
  </div>
</body>

</html>