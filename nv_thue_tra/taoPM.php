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
                        <div class="taoPM">TẠO PHIẾU MƯỢN</div>
                        <form class="form-createPM col-12">
                            <table>
                                <tr>
                                    <td>Mã khách hàng</td>
                                    <td><input type="text"></td>
                                </tr>
                                <tr>
                                    <td>Tên khách hàng</td>
                                    <td><input type="text"></td>
                                    <td style="padding-left:12px">Số điện thoại</td>
                                    <td><input type="tel" id="phone" name="phone"></td>
                                </tr>
                                <tr>
                                    <td>Ngày mượn</td>
                                    <td><input type="datetime-local" id="ngaymuon" name="ngaymuon"></td>
                                    <td style="padding-left:12px">Ngày trả</td>
                                    <td><input type="datetime-local" id="ngaytra" name="ngaytra"></td>
                                </tr>
                                <table class="table align-items-center table-flush table-borderless">
                                    <div class="table-detail">
                                        <table class="detail">
                                            <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Mã ấn phẩm</th>
                                                    <th>Tên ấn phẩm</th>
                                                    <th>Giá thuê</th>
                                                    <th>Cọc</th>
                                                    <th>Tình trạng</th>
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
                                                    <td>..............</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>AP456</td>
                                                    <td>Doraemon</td>
                                                    <td>20.000vnd</td>
                                                    <td>100.000vnd</td>
                                                    <td>..............</td>
                                                    <td>..............</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </table>
                                <div class="promotion">
                                    <input type="text" placeholder="Nhập mã khuyến mãi"
                                        style="background-color:grey; border-radius:5px; border:none; padding:7px">
                                    <button class="btn btn-sm btn-warning" style="font-size:12px;">Áp dụng</button>
                                </div>
                        </form>

                    </div>
                    <div class="btn-create">
                        <a href="ctphieumuon.php"><button class="btn btn-sm btn-danger"
                                style="font-size:15px;">Tạo</button></a>

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