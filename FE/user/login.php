<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Login</title>
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
          <div class="card-title text-uppercase text-center py-3">ĐĂNG NHẬP</div>

          <?php
          // Hiển thị lỗi nếu có
          if (isset($_GET['error'])) {
            echo "<p style='color: red;'>" . htmlspecialchars($_GET['error']) . "</p>";
          }
          ?>

          <form action="../controlUser/controlLogin.php" method="POST">
            <div class="form-group">
              <label for="exampleInputUsername" class="sr-only">Email</label>
              <div class="position-relative has-icon-right">
                <input type="email" id="email" name="email" class="form-control input-shadow" placeholder="Email"
                  required />
                <div class="form-control-position">
                  <i class="icon-user"></i>
                </div>
              </div>
            </div>
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
            <div class="text-right mt-3 mb-3">
              <a href="emailResetPassword.php" class="text-warning">Quên mật khẩu?</a>
            </div>
            <button type="submit" class="btn btn-light btn-block">Đăng nhập</button>
          </form>

        </div>
      </div>
      <div class="card-footer text-center py-3">
        <p class="text-warning mb-0">
          Không có tài khoản? <a href="signUp.php"> Đăng ký tại đây</a>
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
</body>

</html>