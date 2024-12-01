<?php
// verify_otp.php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enteredOtp = $_POST['otp'] ?? '';
    $error = '';

    // Kiểm tra nếu OTP đúng
    if (empty($enteredOtp)) {
        $error = "Vui lòng nhập mã OTP.";
    } elseif ($enteredOtp == $_SESSION['otp']) {
        // OTP chính xác, cho phép thay đổi mật khẩu
        header("Location: resetPassword.php");
        exit();
    } else {
        $error = "Mã OTP không đúng.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Verify OTP</title>
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
                        <div class="card-title text-uppercase pb-2">Xác thực OTP</div>
                        <p class="text-warning mb-3">Chúng tôi vừa gửi mã OTP qua email của bạn.</p>
                        <form method="post">
                            <div class="form-group">
                                <div class="position-relative has-icon-right">
                                    <input type="text" name="otp" id="otp" class="form-control input-shadow"
                                        placeholder="Nhập mã OTP">
                                    <div class="form-control-position">
                                        <i class="icon-envelope-open"></i>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-light btn-block mt-3">Xác thực</button>
                        </form>
                        <?php if (!empty($error)) { echo "<p style='color:red; padding-top: 25px;'>$error</p>"; } ?>
                    </div>
                </div>
                <div class="card-footer text-center py-3">
                    <p>Quay lại <a href="login.html" class="text-warning mb-0"> đăng nhập</a></p>
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