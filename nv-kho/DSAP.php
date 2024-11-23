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

                <!-- CODE Ở ĐÂY -->
                <div class="PM row">
                    <div class="btn-create-PM col-12">
                        <a href="taoAP.php"><button class="btn btn-sm btn-success">Thêm ấn phẩm</button></a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-9 col-lg-12">
                        <div class="card">
                            <div class="card-header">DANH SÁCH ẤN PHẨM</div>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush table-borderless">
                                    <thead>
                                        <tr>
                                            <th style="font-size: 15px;">Mã sản phẩm</th>
                                            <th style="font-size: 15px;">Tên sản phẩm</th>
                                            <th style="font-size: 15px;">Số lượng</th>
                                            <th style="font-size: 15px;">Giá</th>
                                            <th style="font-size: 15px;">Mô tả</th>
                                            <th style="font-size: 15px;">Hình ảnh</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>hii</td>
                                            <td>hii</td>
                                            <td>hii</td>
                                            <td>hii</td>
                                            <td>hii</td>
                                            <td>hii</td>
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