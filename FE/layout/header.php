<?php session_start(); ?>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ogani | Template</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/mainStyle.css" type="text/css">
</head>
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> codenexus@gmail.com</li>
                            <li>Giảm giá 10% phí thuê ấn phẩm khi đăng ký thẻ thành viên</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="header__top__right">
                        <?php if (isset($_SESSION['tenKH'])): ?>
                            <div class="header__top__right__social">
                                <p>Xin chào, <?php echo htmlspecialchars($_SESSION['tenKH']); ?></p>
                            </div>
                            <div class="header__top__right__auth">
                                <a href="user/logout.php"><i class="fa fa-sign-out"></i> Đăng xuất</a>
                            </div>
                        <?php else: ?>
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-user"></i> Đăng ký</a>
                            </div>
                            <div class="header__top__right__auth">
                                <a href="user/login.php"><i class="fa fa-user"></i> Đăng nhập</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>