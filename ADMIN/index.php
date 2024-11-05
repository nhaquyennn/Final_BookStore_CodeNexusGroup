<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once "layout/header.php" ?>
</head>

<body class="bg-theme bg-theme2">
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

    <div class="clearfix"></div>

    <!--Start content-wrapper-->
    <div class="content-wrapper">

      <!--Start container-fluid-->
      <div class="container-fluid">

        <!--Start Dashboard Content-->
        <div class="card mt-3">
          <div class="card-content">
            <div class="row row-group m-0">
              <div class="col-12 col-lg-6 col-xl-4 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0">22 <span class="float-right"><i class="fa fa-shopping-cart"></i></span>
                  </h5>
                  <div class="progress my-3" style="height:3px;">
                    <div class="progress-bar" style="width:55%"></div>
                  </div>
                  <p class="mb-0 text-white small-font">Tổng đơn hàng hôm nay</p>
                </div>
              </div>
              <div class="col-12 col-lg-6 col-xl-4 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0">100.000.000 <span class="float-right"><i class="fa fa-usd"></i></span>
                  </h5>
                  <div class="progress my-3" style="height:3px;">
                    <div class="progress-bar" style="width:55%"></div>
                  </div>
                  <p class="mb-0 text-white small-font">Tổng doanh thu hôm nay</p>
                </div>
              </div>
              <div class="col-12 col-lg-6 col-xl-4 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0">3 <span class="float-right"><i class="zmdi zmdi-assignment"></i></span>
                  </h5>
                  <div class="progress my-3" style="height:3px;">
                    <div class="progress-bar" style="width:55%"></div>
                  </div>
                  <p class="mb-0 text-white small-font">Yêu cầu</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--End Dashboard Content-->

        <!--start overlay-->
        <div class="overlay toggle-menu"></div>
        <!--end overlay-->

        <!--Start Charts-->
        <div class="row">
          <div class="col-md-6">
            <div class="card mt-5">
              <div class="card-body">
                <h5 class="text-white font-weight-bold">Biểu đồ sản phẩm thuê trong ngày</h5>
                <canvas id="rentedProductsChart" height="200"></canvas>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card mt-5">
              <div class="card-body">
                <h5 class="text-white font-weight-bold">Biểu đồ doanh thu 7 ngày gần đây</h5>
                <canvas id="revenueChart" height="200"></canvas>
              </div>
            </div>
          </div>
        </div>
        <!--End Charts-->
      </div>
      <!-- End container-fluid-->

    </div>
    <!--End content-wrapper-->

    <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->

    <!--Start right sidebar-->
    <?php require_once "layout/right_sidebar.php" ?>
    <!--End right sidebar-->

  </div>
  <!--End wrapper-->
  
  <!--Start footer-->
  <?php require_once "layout/script.php" ?>
  <!--End footer-->

</body>

</html>