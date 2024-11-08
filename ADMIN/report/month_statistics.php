<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "layout/header.php"; ?>
</head>

<body class="bg-theme bg-theme2">
    <div class="clearfix"></div>
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Start wrapper-->
            <div id="wrapper">

                <!--Start sidebar-wrapper-->
                <?php require_once "layout/left_sidebar.php"; ?>
                <!--End sidebar-wrapper-->

                <!--Start topbar header-->
                <header class="topbar-nav">
                    <?php require_once "layout/topbar.php"; ?>
                </header>
                <!--End topbar header-->

                <!--Start main content-->
                <div class="card mt-3">
                    <div class="card-content">
                        <div class="row row-group m-0">
                            <div class="col-12 col-lg-6 col-xl-4 border-light">
                                <div class="card-body">
                                    <h5 class="text-white mb-0">22 <span class="float-right"><i class="fa fa-shopping-cart"></i></span></h5>
                                    <div class="progress my-3" style="height:3px;">
                                        <div class="progress-bar" style="width:55%"></div>
                                    </div>
                                    <p class="mb-0 text-white small-font">Tổng đơn hàng hôm nay</p>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-xl-4 border-light">
                                <div class="card-body">
                                    <h5 class="text-white mb-0">100.000.000 <span class="float-right"><i class="fa fa-usd"></i></span></h5>
                                    <div class="progress my-3" style="height:3px;">
                                        <div class="progress-bar" style="width:55%"></div>
                                    </div>
                                    <p class="mb-0 text-white small-font">Tổng doanh thu hôm nay</p>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-xl-4 border-light">
                                <div class="card-body">
                                    <h5 class="text-white mb-0">3 <span class="float-right"><i class="zmdi zmdi-assignment"></i></span></h5>
                                    <div class="progress my-3" style="height:3px;">
                                        <div class="progress-bar" style="width:55%"></div>
                                    </div>
                                    <p class="mb-0 text-white small-font">Yêu cầu</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End main content-->

            </div>
            <!-- End wrapper-->

            <!--Start right sidebar-->
            <?php require_once "layout/right_sidebar.php"; ?>
            <!--End right sidebar-->

            <!--Start footer-->
            <?php require_once "layout/script.php"; ?>
            <!--End footer-->
        </div>
    </div>
</body>

</html>
