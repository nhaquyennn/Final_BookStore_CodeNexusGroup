<?php
include 'controlCustomerUI/controlCategory.php';
include 'controlCustomerUI/controlShopGrid.php';

// Lấy dữ liệu từ session
$products_search = isset($_SESSION['products_search']) ? $_SESSION['products_search'] : [];
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <?php require_once 'layout/header.php' ?>
</head>

<body>
    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>DANH MỤC</h4>
                            <ul>
                                <li class="active" data-filter="*">Tất cả</li>
                                <?php foreach ($categories_name_only as $category): ?>
                                    <li><a href="#"><?php echo htmlspecialchars($category); ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="sidebar__item">
                            <h4>Price</h4>
                            <div class="price-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="10" data-max="540">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input type="text" id="minamount">
                                        <input type="text" id="maxamount">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <h4>Tác giả</h4>
                            <ul>
                                <li class="active" data-filter="*">Tất cả</li>
                                <?php foreach ($authors as $author): ?>
                                    <li><a href="#"><?php echo htmlspecialchars($author); ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="sidebar__item">
                            <h4>Nhà xuất bản</h4>
                            <ul>
                                <li class="active" data-filter="*">Tất cả</li>
                                <?php foreach ($publishers as $publisher): ?>
                                    <li><a href="#"><?php echo htmlspecialchars($publisher); ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="sidebar__item">
                            <h4>Năm xuất bản</h4>
                            <ul>
                                <li class="active" data-filter="*">Tất cả</li>
                                <?php foreach ($years as $year): ?>
                                    <li><a href="#"><?php echo htmlspecialchars($year); ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Sản phẩm mới</h4>
                                <div class="latest-product__slider owl-carousel">
                                    <?php if (!empty($products_new)): ?>
                                        <?php
                                        $chunks = array_chunk($products_new, 3); // Chia sản phẩm thành các nhóm 3 sản phẩm
                                        foreach ($chunks as $chunk): ?>
                                            <div class="latest-product__slider__item">
                                                <?php foreach ($chunk as $product): ?>
                                                    <a href="#" class="latest-product__item">
                                                        <div class="latest-product__item__pic">
                                                            <img src="img/products/<?php echo htmlspecialchars($product['hinhAnh']); ?>"
                                                                alt="<?php echo htmlspecialchars($product['TenAnPham']); ?>">
                                                        </div>
                                                        <div class="latest-product__item__text">
                                                            <h6><?php echo htmlspecialchars($product['TenAnPham']); ?></h6>
                                                            <span><?php echo number_format($product['Giathue'], 0, ',', '.'); ?>
                                                                VND</span>
                                                        </div>
                                                    </a>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p>Không có sản phẩm mới để hiển thị.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sắp xếp theo</span>
                                    <select>
                                        <option value="0">Mặc định</option>
                                        <option value="0">Giá từ thấp đến cao</option>
                                        <option value="0">Giá từ cao đến thấp</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                                <h5 style="text-align: right">
                                    <span><?php echo htmlspecialchars($totalQuantity_dauap); ?></span> ấn phẩm
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php if (!empty($products)): ?>
                            <?php foreach ($products as $product): ?>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <div class="product__item__pic">
                                            <img src="img/products/<?php echo htmlspecialchars($product['hinhAnh']); ?>"
                                                alt="<?php echo htmlspecialchars($product['TenAnPham']); ?>">
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__item__text">
                                            <h5><?php echo htmlspecialchars($product['TenAnPham']); ?></h5>
                                            <h6 style="margin-top: 10px;">Giá:
                                                <?php echo number_format($product['Giathue'], 0, ',', '.'); ?> VND
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Không có sản phẩm nào khớp với từ khóa tìm kiếm hoặc để hiển thị.</p>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- Product Section End -->

    <footer>
        <?php require_once 'layout/footer.php' ?>
    </footer>
</body>

</html>