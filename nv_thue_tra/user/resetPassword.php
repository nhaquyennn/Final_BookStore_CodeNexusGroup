<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Reset Password</title>
    <!-- Bootstrap core CSS-->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- animate CSS-->
    <link href="../assets/css/animate.css" rel="stylesheet" type="text/css" />
    <!-- Icons CSS-->
    <link href="../assets/css/icons.css" rel="stylesheet" type="text/css" />
    <!-- Custom Style-->
    <link href="../assets/css/app-style.css" rel="stylesheet" />

</head>

<body class="bg-theme bg-theme9">

    <!-- Start wrapper-->
    <div id="wrapper">

        <div class="height-100v d-flex align-items-center justify-content-center">
            <div class="card card-authentication1 mb-0">
                <div class="card-body">
                    <div class="card-content p-2">
                        <div class="card-title text-uppercase pb-2">Đặt lại mật khẩu</div>
                        <?php
                        // Hiển thị lỗi nếu có
                        if (isset($_GET['error'])) {
                            echo "<p style='color: red;'>" . htmlspecialchars($_GET['error']) . "</p>";
                        }
                        ?>
                        <form action="../controlUser/controlResetPassword.php" method="post">
                            <div class="form-group">
                                <div class="position-relative has-icon-right">
                                    <input type="password" name="new_password" id="new_password"
                                        class="form-control input-shadow" placeholder="Nhập mật khẩu mới">
                                </div>
                                <div class="position-relative has-icon-right mt-3">
                                    <input type="password" name="confirm_password" id="confirm_password"
                                        class="form-control input-shadow" placeholder="Xác nhận mật khẩu mới">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-light btn-block mt-3">Lưu mật khẩu mới</button>
                        </form>
                        <?php if (!empty($error)) {
                            echo "<p style='color:red; padding-top: 25px;'>$error</p>";
                        } ?>
                    </div>
                </div>
                <div class="card-footer text-center py-3">
                    <p>Quay lại <a href="login.php" class="text-warning mb-0"> đăng nhập</a></p>
                </div>
            </div>
        </div>
    </div>
    <!--wrapper-->

    <!-- Bootstrap core JavaScript-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- sidebar-menu js -->
    <script src="assets/js/sidebar-menu.js"></script>

    <!-- Custom scripts -->
    <script src="assets/js/app-script.js"></script>


</body>

</html>