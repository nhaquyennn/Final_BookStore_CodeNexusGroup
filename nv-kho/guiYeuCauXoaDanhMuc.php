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
                    <h4 class="text-center mb-4">PHIẾU GỬI YÊU CẦU XÓA DANH MỤC</h4>
                    <form action="submit_request.php" method="POST">
                        <!-- Tên nhân viên -->
                        <div class="mb-3">
                            <label for="employeeName" class="form-label">Tên nhân viên</label>
                            <input type="text" class="form-control" id="employeeName" name="employeeName" placeholder="Lấy tên nhân viên hiển thị lên" required>
                        </div>

                        <!-- Tên ấn phẩm -->
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Tên danh mục cần xóa</label>
                            <input type="text" class="form-control" id="categoryName" name="categoryName" placeholder="Lấy tên danh mục hiển thị lên" required>
                        </div>

                        <!-- Lý do xóa -->
                        <div class="mb-3">
                            <label for="reason" class="form-label">Lý do xóa</label>
                            <textarea class="form-control" id="reason" name="reason" rows="4" placeholder="Nhập lý do bạn muốn xóa ấn phẩm này" required></textarea>
                        </div>


                        <!-- File đính kèm -->
                        <div class="mb-3">
                            <label for="attachment" class="form-label">Tệp đính kèm (nếu có)</label>
                            <input type="file" class="form-control" id="attachment" name="attachment">
                        </div>

                        <!-- Nút Gửi Yêu Cầu -->
                        <div>
                            <a href="danhMucAP.php" class="btn btn-secondary">Quay lại</a>
                            <a href="danhMucAP.php"><button type="submit" class="btn btn-primary">Gửi yêu cầu</button></a>
                        </div>
                    </form>
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