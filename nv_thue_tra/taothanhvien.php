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
                <div class="container">
                    <h3 class="text-center mt-5">MẪU TẠO THÀNH VIÊN</h3>
                    <form action="submit_request.php" method="POST">
                        <div class="mb-3">
                            <label for="customerName" class="text-white">Tên khách hàng</label>
                            <input type="text" class="form-control" id="customerName" name="customerName" placeholder="Nhập tên khách hàng" required>
                        </div>
                        <div class="mb-3">
                            <label for="customerPhone" class="text-white">Số điện thoại</label>
                            <input type="text" class="form-control" id="customerPhone" name="customerPhone" placeholder="Nhập số điện thoại" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email khách hàng" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ khách hàng" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu (ít nhất 8 ký tự)" required>
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