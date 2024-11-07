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

                <div class="row">
                    <div class="col-9 col-lg-12">
                        <div class="card">
                            <div class="card-header">Danh sách nhân viên</div>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush table-borderless">
                                    <thead>
                                        <tr>
                                            <th style="font-size: 15px;">Tên</th>
                                            <th style="font-size: 15px;">Mã nhân viên</th>
                                            <th style="font-size: 15px;">Chức vụ</th>
                                            <th style="font-size: 15px;">Email</th>
                                            <th style="font-size: 15px;">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Harry Potter</td>
                                            <td>#9405840</td>
                                            <td>Nhân viên</td>
                                            <td>nvb@gmail.com</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary"><i
                                                        class="fa fa-eye"></i></button>
                                                <button class="btn btn-sm btn-warning"><i
                                                        class="fa fa-edit"></i></button>
                                                <button class="btn btn-sm btn-danger"><i
                                                        class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Harry Potter</td>
                                            <td>#9405840</td>
                                            <td>Nhân viên</td>
                                            <td>nvb@gmail.com</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary"><i
                                                        class="fa fa-eye"></i></button>
                                                <button class="btn btn-sm btn-warning"><i
                                                        class="fa fa-edit"></i></button>
                                                <button class="btn btn-sm btn-danger"><i
                                                        class="fa fa-trash"></i></button>
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