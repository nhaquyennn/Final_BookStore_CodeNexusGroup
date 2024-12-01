<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "layout/header.php" ?>
</head>

<body class="bg-theme bg-theme2">
    <!-- <div class="clearfix"></div> -->
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
                        <h3 class="text-center text-white">QUẢN LÝ KHÁCH HÀNG</h3>
                        <a href="taothanhvien.php"><button class="btn btn-sm btn-success">Tạo thành viên</button></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-9 col-lg-12">
                        <div class="card">
                            <div class="card-header">DANH SÁCH KHÁCH HÀNG</div>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Tài khoản</th>
                                            <th>Mã khách hàng</th>
                                            <th>Tên khách hàng</th>
                                            <th>Địa chỉ</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>user1</td>
                                            <td>KH001</td>
                                            <td>Nguyễn Văn A</td>
                                            <td>123 Đường ABC, Quận 1</td>
                                            <td>
                                                <button class="btn btn-warning btn-sm"><i class='fa fa-pencil ' aria-hidden='true'></i></button>
                                                <button class="btn btn-danger btn-sm">
                                                    <a href="taoYCxoa.php"><i class='fa fa-trash-o' aria-hidden='true'></i></a>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>user2</td>
                                            <td>KH002</td>
                                            <td>Trần Thị B</td>
                                            <td>456 Đường XYZ, Quận 2</td>
                                            <td>
                                                <button class="btn btn-warning btn-sm"><i class='fa fa-pencil ' aria-hidden='true'></i></button>
                                                <button class="btn btn-danger btn-sm">
                                                    <a href="taoYCxoa.php"><i class='fa fa-trash-o' aria-hidden='true'></i></a>
                                                </button>
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

            <!--End right sidebar-->

            <!--Start footer-->

            <!--End footer-->
        </div>
    </div>
</body>

</html>