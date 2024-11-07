<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "layout/header.php" ?>
    <?php require_once "layout/left_sidebar.php" ?>
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
                <div class="row">
                    <div class="col-9 col-lg-12">
                        <div class="card">
                            <div class="card-header">DANH SÁCH YÊU CẦU</div>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush table-borderless">
                                    <thead>
                                        <tr>
                                            <th style="font-size: 15px;">Mã</th>
                                            <th style="font-size: 15px;">Nội dung</th>
                                            <th style="font-size: 15px;">Ngày tạo</th>
                                            <th style="font-size: 15px;">Người tạo</th>
                                            <th style="font-size: 15px;">Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>YC1</td>
                                            <td>Xóa khách hàng A</td>
                                            <td>12/10/2024</td>
                                            <td>
                                                <strong>Mã nhân viên:</strong> 12345<br>
                                                <strong>Tên :</strong> Nguyễn Văn A<br>
                                                <strong>Bộ phận:</strong> Bán hàng<br>
                                            </td>
                                            <td>Chờ Duyệt</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary"><i
                                                        class="fa fa-eye"></i></button>
                                                <button class="btn btn-sm btn-warning">Duyệt</button>
                                                <button class="btn btn-sm btn-danger">Từ chối</button>
                                            </td>
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