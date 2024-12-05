<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Sign Up</title>
    <!--favicon-->
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon" />
    <!-- Bootstrap core CSS-->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- animate CSS-->
    <link href="../assets/css/animate.css" rel="stylesheet" type="text/css" />
    <!-- Icons CSS-->
    <link href="../assets/css/icons.css" rel="stylesheet" type="text/css" />
    <!-- Custom Style-->
    <link href="../assets/css/app-style.css" rel="stylesheet" />
</head>

<body class="bg-theme bg-theme9 d-flex justify-content-center align-items-center vh-100">
    <!-- Start wrapper-->
    <div id="wrapper">
        <div class="card card-authentication1 mx-auto my-5">
            <div class="card-body">
                <div class="card-content p-2">
                    <div class="card-title text-uppercase text-center py-3">ĐĂNG KÝ TÀI KHOẢN</div>

                    <?php
                    // Hiển thị lỗi nếu có
                    if (isset($_GET['error'])) {
                        echo "<p style='color: red;'>" . htmlspecialchars($_GET['error']) . "</p>";
                    }
                    ?>

                    <form action="../controlUser/controlSignUp.php" method="POST" id="signUpForm">
                        <!-- Họ và Tên -->
                        <div class="form-group">
                            <label for="exampleInputFullName" class="sr-only">Họ và Tên</label>
                            <div class="position-relative has-icon-right">
                                <input type="text" id="fullName" name="fullName" class="form-control input-shadow"
                                    placeholder="Họ và Tên" required />
                                <div class="form-control-position">
                                    <i class="icon-user"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label for="exampleInputEmail" class="sr-only">Email</label>
                            <div class="position-relative has-icon-right">
                                <input type="email" id="email" name="email" class="form-control input-shadow"
                                    placeholder="Email" required />
                                <div class="form-control-position">
                                    <i class="icon-user"></i>
                                </div>
                                <div id="email-error" style="color: red; margin-top: 15px"></div>
                            </div>
                        </div>

                        <!-- Mật khẩu -->
                        <div class="form-group">
                            <label for="exampleInputPassword" class="sr-only">Mật khẩu</label>
                            <div class="position-relative has-icon-right">
                                <input type="password" id="password" name="password" class="form-control input-shadow"
                                    placeholder="Mật khẩu" required />
                                <div class="form-control-position">
                                    <i class="icon-lock"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Xác nhận mật khẩu -->
                        <div class="form-group">
                            <label for="exampleInputConfirmPassword" class="sr-only">Xác nhận mật khẩu</label>
                            <div class="position-relative has-icon-right">
                                <input type="password" id="confirmPassword" name="confirmPassword"
                                    class="form-control input-shadow" placeholder="Xác nhận mật khẩu" required />
                                <div class="form-control-position">
                                    <i class="icon-lock"></i>
                                </div>
                                <div id="confirm-password-error" style="color: red; margin-top: 15px"></div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-light btn-block">Đăng ký</button>
                    </form>
                </div>
            </div>
            <div class="card-footer text-center py-3">
                <p class="text-warning mb-0">
                    Bạn đã có tài khoản? <a href="login.php"> Đăng nhập tại đây</a>
                </p>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Kiểm tra email khi mất focus
            $('#email').on('blur', function () {
                var email = $(this).val();
                if (email !== '') {
                    $.ajax({
                        url: '../controlUser/controlSignUp.php',  // Gửi yêu cầu đến chính file này
                        method: 'POST',
                        data: { check_email: true, email: email },
                        success: function (response) {
                            $('#email-error').text(response);
                        }
                    });
                }
            });

            // Kiểm tra mật khẩu xác nhận khi người dùng nhập
            $('#confirmPassword').on('keyup', function () {
                var password = $('#password').val();
                var confirmPassword = $(this).val();

                if (password !== confirmPassword) {
                    $('#confirm-password-error').text("Mật khẩu xác nhận không khớp.");
                } else {
                    $('#confirm-password-error').text("Mật khẩu xác nhận hợp lệ.");
                }
            });

            // Kiểm tra form khi submit
            $('#signUpForm').on('submit', function (e) {
                var emailError = $('#email-error').text();
                var confirmPasswordError = $('#confirm-password-error').text();

                // Nếu email hoặc mật khẩu xác nhận không hợp lệ thì không gửi form
                if (emailError !== "Email có thể sử dụng." || confirmPasswordError !== "Mật khẩu xác nhận hợp lệ.") {
                    e.preventDefault();
                    alert("Vui lòng kiểm tra các trường nhập vào.");
                }
            });
        });
    </script>
</body>

</html>