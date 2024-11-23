<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once "layout/header.php" ?>

</head>

<body class="bg-theme bg-theme2">
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
        <!-- Main Content -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header">DANH SÁCH ẤN PHẨM</div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush table-borderless">
                <thead>
                  <tr>
                    <th>Mã ấn phẩm</th>
                    <th>Tên ấn phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Hình ảnh</th>
                  </tr>
                </thead>
                <tbody id="product-list">
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
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