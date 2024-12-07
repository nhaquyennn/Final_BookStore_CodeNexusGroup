<section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all" style="background-color: #E75480;">
                        <i class="fa fa-bars"></i>
                        <span>DANH MỤC</span>
                    </div>
                    <div class="active">
                        <form method="get" action="shop-grid.php">
                            <ul>
                                <?php foreach ($categories_name_only as $category): ?>
                                    <li><a
                                            href="shop-grid.php?category=<?php echo urlencode($category); ?>&min_price=<?php echo htmlspecialchars($filter_params['min_price']); ?>&max_price=<?php echo htmlspecialchars($filter_params['max_price']); ?>&author=<?php echo htmlspecialchars($filter_params['author']); ?>&publisher=<?php echo htmlspecialchars($filter_params['publisher']); ?>&year=<?php echo htmlspecialchars($filter_params['year']); ?>&sort=<?php echo htmlspecialchars($filter_params['sort']); ?>"><?php echo htmlspecialchars($category); ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">

                <div class="hero__item" style="background-image: url('img/hero/banner.png');">
                    <div class="hero__text" style="margin-left: 200px; text-align: center;">
                        <h3
                            style="color: white; background-color: rgba(56, 49, 56, 0.156); width: 200px; margin-left: 50px; font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">
                            NEXUS</h3>
                        <h2>Thuê là có <br />Không đắn đo</h2>
                        <a href="shop-grid.php" class="site-btn" style="margin-top: 15px;">SHOP NOW</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->