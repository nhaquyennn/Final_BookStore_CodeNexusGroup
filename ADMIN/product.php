<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "layout/header.php"?>
</head>
<body class="bg-theme bg-theme2">
    <!-- Start wrapper-->
    <div id="wrapper">
        <div class="clearfix"></div>
        <div class="content-wrapper">
            <div class="container-fluid">

                <!--Start sidebar-wrapper-->
                <?php require_once "layout/left_sidebar.php"?>
                <!--End sidebar-wrapper-->

                <!--Start topbar header-->
                <header class="topbar-nav">
                    <nav class="navbar navbar-expand fixed-top">
                        <ul class="navbar-nav mr-auto align-items-center">
                            <li class="nav-item"><a class="nav-link toggle-menu" href="javascript:void();"><i class="icon-menu menu-icon"></i></a></li>
                            <li class="nav-item">
                                <form class="search-bar">
                                    <input type="text" id="search-input" class="form-control" placeholder="Nhập từ khóa tìm kiếm">
                                    <a href="javascript:void(0);"><i id="search-btn" class="fa fa-search" style="cursor: pointer;"></i></a>
                                </form>
                            </li>
                        </ul>          
                    </nav>
                </header>
                <!--End topbar header-->

                <div class="row">
                    <div class="col-9 col-lg-12">
                        <div class="card">
                            <div class="card-header">DANH SÁCH ẤN PHẨM</div>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush table-borderless">
                                    <thead>
                                        <tr>
                                            <th style="font-size: 15px;">Tên</th>
                                            <th style="font-size: 15px;">Hình ảnh</th>
                                            <th style="font-size: 15px;">Mã ấn phẩm</th>
                                            <th style="font-size: 15px;">Chi tiết</th>
                                            <th style="font-size: 15px;">Tồn kho</th>
                                            <th style="font-size: 15px;">Giá thuê</th>
                                            <th style="font-size: 15px;">Trạng thái</th>
                                            <th style="font-size: 15px;">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Harry Potter</td>
                                            <td><img src="img/cat-4.jpg" class="product-img" alt="product img"></td>
                                            <td>#9405840</td>
                                            <td>
                                                <strong>Thể loại:</strong> Mathematics<br>
                                                <strong>Tác giả:</strong> Bookcase 2<br>
                                                <strong>Nhà xuất bản:</strong> ACC<br>
                                            </td>
                                            <td>10</td>
                                            <td>50.000</td>
                                            <td>ABC</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></button>
                                                <button class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></button>
                                                <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                
                                        <tr>
                                            <td>Hand Watch</td>
                                            <td><img src="img/cat-5.jpg" class="product-img" alt="product img"></td>
                                            <td>#9405840</td>
                                            <td>
                                                <strong>Thể loại:</strong> Science<br>
                                                <strong>Tác giả:</strong> Bookcase 1<br>
                                                <strong>Nhà xuất bản:</strong> ACC<br>
                                            </td>
                                            <td>10</td>
                                            <td>50.000</td>
                                            <td>ABC</td>
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
                
                
                <!--start right sidebar-->
                <?php require_once "layout/right_sidebar.php"?>
                <!--end right sidebar-->
            </div>
        </div>
    </div>
    <!-- End wrapper-->

    <!-- Bootstrap core JavaScript-->
    <script src="assets/js/my.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- simplebar js -->
    <script src="assets/plugins/simplebar/js/simplebar.js"></script>
    <!-- sidebar-menu js -->
    <script src="assets/js/sidebar-menu.js"></script>
    <!-- loader scripts -->
    <script src="assets/js/jquery.loading-indicator.js"></script>
    <!-- Custom scripts -->
    <script src="assets/js/app-script.js"></script>
    <!-- Chart js -->
    <script src="assets/plugins/Chart.js/Chart.min.js"></script>
    <!-- Index js -->
    <script src="assets/js/index.js"></script>
</body>
</html>