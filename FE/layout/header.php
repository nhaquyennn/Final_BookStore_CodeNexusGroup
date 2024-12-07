<?php 
error_reporting(E_ALL & ~E_NOTICE);
session_start(); 
?>
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
    <link rel="stylesheet" href="assets/css/filter.css" type="text/css">
    <link rel="stylesheet" href="assets/css/checkout.css" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</head>
<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i>codenexus@gmail.com</li>
                            <li>Giảm giá 10% phí thuê ấn phẩm khi đăng ký thẻ thành viên</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="header__top__right">
                        <?php if (isset($_SESSION['tenKH'])): ?>
                            <div>
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle"
                                        style="background-color: #E75480; color: white; font-size: 15px;" type="button"
                                        id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-user"></i> <?php echo htmlspecialchars($_SESSION['tenKH']); ?>
                                    </button>
                                    <ul class="dropdown-menu" style="font-size: 15px;">
                                        <li><a class="dropdown-item" href="user/profile.php">Quản lý thông tin cá nhân</a>
                                        </li>
                                        <li><a class="dropdown-item" href="user/logout.php"><i class="fa fa-sign-out"></i>
                                                Đăng xuất</a></li>
                                    </ul>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="header__top__right__social">
                                <a href="user/signup.php"><i class="fa fa-user"></i> Đăng ký</a>
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
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="./index.php"><img src="img/nexus.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-7">
                <nav class="header__menu">
                    <ul>
                        <li><a href="./index.php">Trang chủ</a></li>
                        <li><a href="./shop-grid.php">Sản phẩm</a></li>
                        <li><a href="#">Giỏ hàng</a>
                            <ul class="header__menu__dropdown">
                                <li><a href="./shopping_cart.php">Shoping Cart</a></li>
                                <li><a href="./checkout.php">Check Out</a></li>
                            </ul>
                        </li>
                        <li><a href="./contact.php">Liên hệ</a></li>
                        <li><a href="./policy.php">Chính sách</a></li>
                    </ul>
                </nav>
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="controlCustomerUI/controlSearch.php" method="GET">
                            <input type="text" name="query" placeholder="Tìm kiếm sản phẩm..." required>
                            <button type="submit" name="search" class="site-btn">Tìm kiếm</button>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-lg-2">
                <div class="header__cart">
                    <div class="header__cart__price">Giỏ hàng: <span>$10.00</span></div>
                </div>
                <div class="hero__search__phone">
                    <div class="hero__search__phone__text">
                        <h5>+84 000.000.0</h5>
                        <span>Hỗ trợ 24/7</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>

<!-- Header Section End -->