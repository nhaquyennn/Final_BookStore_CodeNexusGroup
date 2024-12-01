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
                            <label for="username" class="form-label">Email</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Nhập email của bạn" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="text" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu (ít nhất 8 ký tự)" required>
                        </div>
                        <div class="mb-3">
                            <label for="customerId" class="text-white">Mã khách hàng</label>
                            <input type="text" class="form-control" value="KH6321" required>
                        </div>
                        <div class="mb-3">
                            <label for="customerName" class="text-white">Tên khách hàng</label>
                            <input type="text" class="form-control" placeholder="Nhập tên khách hàng" required>
                        </div>
                        <div class="mb-3">
                            <label for="customerPhone" class="text-white">Số điện thoại</label>
                            <input type="text" class="form-control" id="customerPhone" name="customerPhone" placeholder="Nhập số điện thoại">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="text-white">Địa chỉ</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ khách hàng" required>
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
<!-- <script>
    document.querySelector('form').addEventListener('submit', function(event) {
        const password = document.getElementById('password').value;
        const phone = document.getElementById('customerPhone').value;

        if (password.length < 8) {
            alert('Mật khẩu phải có ít nhất 8 ký tự.');
            event.preventDefault();
        }

        if (!/^\d{10,11}$/.test(phone)) { // Kiểm tra số điện thoại chỉ chứa 10-11 chữ số
            alert('Số điện thoại không hợp lệ.');
            event.preventDefault();
        }
    });
</script> -->

</html>