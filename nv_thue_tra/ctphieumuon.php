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
                <div class="row">
                    <div class="col-9 col-lg-12">
                        <div class="card">
                            <div class="rental-voucher" >PHIẾU MƯỢN</div>
                            <div class="table-voucher">
                                <table class="table align-items-center table-flush table-borderless">
                                    <thead>
                                        <tr>
                                            <th> Mã phiếu : PM1<br>  
                                             Mã nhân viên : NV1 <br>
                                             
                                            </th>
                                            <th style="text-align:right">Ngày mượn : ..........................
                                                <br> Ngày trả: ..........................
                                            </th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Tên khách hàng: <br>
                                            Số điện thoại: <br>
                                            Địa chỉ: 
                                            </th>
                                        </tr>
                                        <div class="table-detail">
                                            <table class="detail">
                                                <thead>
                                                    <tr>
                                                        <th>STT</th>
                                                        <th>Mã ấn phẩm</th>
                                                        <th>Tên ấn phẩm</th>
                                                        <th>Giá thuê</th>
                                                        <th>Cọc</th>
                                                        <th>Ghi chú</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>AP367</td>
                                                        <td>Sách tiếng anh</td>
                                                        <td>20.000vnd</td>
                                                        <td>100.000vnd</td>
                                                        <td>..............</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>AP456</td>
                                                        <td>Doraemon</td>
                                                        <td>20.000vnd</td>
                                                        <td>100.000vnd</td>
                                                        <td>..............</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                        
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