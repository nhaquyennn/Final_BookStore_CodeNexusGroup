<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once "layout/header.php" ?>
</head>

<body class="bg-theme bg-theme2">
  <!-- Start wrapper-->
  <div id="wrapper">
    <div class="clearfix"></div>
    <div class="content-wrapper">
      <div class="container-fluid">

        <!--Start sidebar-wrapper-->
        <?php require_once "layout/left_sidebar.php" ?>
        <!--End sidebar-wrapper-->

        <!--Start topbar header-->
        <header class="topbar-nav">
          <nav class="navbar navbar-expand fixed-top">
            <ul class="navbar-nav mr-auto align-items-center">
              <li class="nav-item"><a class="nav-link toggle-menu" href="javascript:void();"><i
                    class="icon-menu menu-icon"></i></a></li>
              <li class="nav-item">
                <form class="search-bar">
                  <input type="text" id="search-input" class="form-control" placeholder="Nhập từ khóa tìm kiếm">
                  <a href="javascript:void(0);"><i id="search-btn" class="fa fa-search"
                      style="cursor: pointer;"></i></a>
                </form>
              </li>
            </ul>
          </nav>
        </header>
        <!--End topbar header-->

        <div class="row">
          <div class="col-9 col-lg-12">
            <div class="card">
              <div class="card-header">DANH SÁCH ĐƠN HÀNG</div>
              <div class="table-responsive">
                <table class="table align-items-center table-flush table-borderless">
                  <thead>
                    <tr>
                      <th style="font-size: 15px;">Mã phiếu mượn</th>
                      <th style="font-size: 15px;">Thông tin</th>
                      <th style="font-size: 15px;">Chi tiết</th>
                      <th style="font-size: 15px;">Tổng tiền</th>
                      <th style="font-size: 15px;">Ngày đặt</th>
                      <th style="font-size: 15px;">Trạng thái</th>
                      <th style="font-size: 15px;">Hành động</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>132</td>
                      <td>
                          <strong>Họ tên:</strong> ABC<br>
                          <strong>Số điện thoại:</strong> Bookcase 2<br>
                          <strong>Email:</strong>ACC<br>
                          <strong>Địa chỉ:</strong>ACC<br>
                      </td>
                      <td>
                          <strong>Harry Potter</strong> x1 = 100.000<br>
                          <strong>Attack on Titan</strong> x2 = 200.000<br>
                      </td>
                      <td>300.000</td>
                      <td>
                        <button class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></button>
                        <button class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>


        <!--Start right sidebar-->
        <?php require_once "layout/right_sidebar.php" ?>
        <!--End right sidebar-->
      </div>
    </div>
  </div>
  <!-- End wrapper-->

  <!--Start footer-->
  <?php require_once "layout/script.php" ?>
  <!--End footer-->
</body>

</html>