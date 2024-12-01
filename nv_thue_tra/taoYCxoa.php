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
                <div class="container mt-5">
                    <h3 class="text-center text-white">YÊU CẦU XÓA KHÁCH HÀNG</h3>
                    <form>
                        <div class="mb-3">
                            <label for="customerId" class="text-white">Mã khách hàng</label>
                            <input type="text" class="form-control" value="" required>
                        </div>
                        <div class="mb-3">
                            <label for="customerName" class="text-white">Tên khách hàng</label>
                            <input type="text" class="form-control" value="" required>
                        </div>
                        <div class="mb-3">
                            <label for="deleteReason" class="text-white">Lý do xóa</label>
                            <textarea class="form-control" placeholder="Nhập lý do xóa khách hàng" required></textarea>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Tạo</button>
                            <a href="javascript:history.back()" class="btn btn-secondary">Quay lại</a>
                        </div>
                    </form>
                </div>
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