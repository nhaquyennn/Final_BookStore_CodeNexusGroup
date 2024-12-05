<?php
// shop-grid.php

// Kích hoạt hiển thị lỗi PHP để dễ dàng debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Bao gồm các control files
include 'controlCustomerUI/controlCategory.php';
include 'controlCustomerUI/controlShopGrid.php';
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <?php require_once 'layout/header.php'; ?>
    <link rel="stylesheet" href="css/shop-grid.css">
    <!-- Thêm các stylesheet hoặc scripts bổ sung tại đây -->
</head>

<body>
    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <!-- Danh Mục -->
                        <div class="sidebar__item">
                            <h4>DANH MỤC</h4>
                            <ul>
                                <li class="<?php echo (!isset($_GET['category']) && !isset($_GET['author']) && !isset($_GET['publisher']) && !isset($_GET['year'])) ? 'active' : ''; ?>">
                                    <a href="shop-grid.php">Tất cả</a>
                                </li>
                                <?php foreach ($categories as $category): ?>
                                    <li class="<?php echo (isset($_GET['category']) && $_GET['category'] == $category) ? 'active' : ''; ?>">
                                        <a href="shop-grid.php?category=<?php echo urlencode($category); ?>"><?php echo htmlspecialchars($category); ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <!-- Price Range -->
                        <div class="sidebar__item">
                            <h4>Price</h4>
                            <form method="GET" action="shop-grid.php">
                                <div class="price-range-wrap">
                                    <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                        data-min="10" data-max="540">
                                        <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                        <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                        <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    </div>
                                    <div class="range-slider">
                                        <div class="price-input">
                                            <input type="text" id="minamount" name="min_price" readonly>
                                            <input type="text" id="maxamount" name="max_price" readonly>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="primary-btn">Áp dụng</button>
                            </form>
                        </div>
                        <!-- Tác giả -->
                        <div class="sidebar__item">
                            <h4>Tác giả</h4>
                            <ul>
                                <li class="<?php echo (!isset($_GET['author'])) ? 'active' : ''; ?>">
                                    <a href="shop-grid.php">Tất cả</a>
                                </li>
                                <?php foreach ($authors as $author): ?>
                                    <li class="<?php echo (isset($_GET['author']) && $_GET['author'] == $author) ? 'active' : ''; ?>">
                                        <a href="shop-grid.php?author=<?php echo urlencode($author); ?>"><?php echo htmlspecialchars($author); ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <!-- Nhà xuất bản -->
                        <div class="sidebar__item">
                            <h4>Nhà xuất bản</h4>
                            <ul>
                                <li class="<?php echo (!isset($_GET['publisher'])) ? 'active' : ''; ?>">
                                    <a href="shop-grid.php">Tất cả</a>
                                </li>
                                <?php foreach ($publishers as $publisher): ?>
                                    <li class="<?php echo (isset($_GET['publisher']) && $_GET['publisher'] == $publisher) ? 'active' : ''; ?>">
                                        <a href="shop-grid.php?publisher=<?php echo urlencode($publisher); ?>"><?php echo htmlspecialchars($publisher); ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <!-- Năm xuất bản -->
                        <div class="sidebar__item">
                            <h4>Năm xuất bản</h4>
                            <ul>
                                <li class="<?php echo (!isset($_GET['year'])) ? 'active' : ''; ?>">
                                    <a href="shop-grid.php">Tất cả</a>
                                </li>
                                <?php foreach ($years as $year): ?>
                                    <li class="<?php echo (isset($_GET['year']) && $_GET['year'] == $year) ? 'active' : ''; ?>">
                                        <a href="shop-grid.php?year=<?php echo urlencode($year); ?>"><?php echo htmlspecialchars($year); ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <!-- Sản phẩm mới -->
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Sản phẩm mới</h4>
                                <div class="latest-product__slider owl-carousel">
                                    <?php if (!empty($new_products)): ?>
                                        <?php
                                        $chunks = array_chunk($new_products, 3); // Chia sản phẩm thành các nhóm 3 sản phẩm
                                        foreach ($chunks as $chunk): ?>
                                            <div class="latest-product__slider__item">
                                                <?php foreach ($chunk as $product): ?>
                                                    <a href="shop-details.php?id=<?php echo urlencode($product['maAnPham']); ?>" class="latest-product__item">
                                                        <div class="latest-product__item__pic">
                                                            <img src="img/products/<?php echo htmlspecialchars($product['hinhAnh']); ?>"
                                                                alt="<?php echo htmlspecialchars($product['TenAnPham']); ?>">
                                                        </div>
                                                        <div class="latest-product__item__text">
                                                            <h6><?php echo htmlspecialchars($product['TenAnPham']); ?></h6>
                                                            <span><?php echo number_format($product['Giathue'], 0, ',', '.'); ?>
                                                                VNĐ</span>
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
                <!-- Main Content -->
                <div class="col-lg-9 col-md-7">
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sắp xếp theo</span>
                                    <form method="GET" action="shop-grid.php">
                                        <!-- Giữ lại các tham số hiện tại để không mất khi sắp xếp -->
                                        <?php
                                        foreach ($_GET as $key => $value) {
                                            if ($key != 'sort') {
                                                echo '<input type="hidden" name="' . htmlspecialchars($key) . '" value="' . htmlspecialchars($value) . '">';
                                            }
                                        }
                                        ?>
                                        <select name="sort" onchange="this.form.submit()">
                                            <option value="default" <?php echo (!isset($_GET['sort']) || $_GET['sort'] == 'default') ? 'selected' : ''; ?>>Mặc định</option>
                                            <option value="price_low_high" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'price_low_high') ? 'selected' : ''; ?>>Giá từ thấp đến cao</option>
                                            <option value="price_high_low" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'price_high_low') ? 'selected' : ''; ?>>Giá từ cao đến thấp</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h5><?php echo htmlspecialchars($totalQuantity_dauap); ?> ấn phẩm</h5>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                                <!-- Có thể thêm các nút hoặc chức năng khác nếu cần -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php if (!empty($all_products)): ?>
                            <?php foreach ($all_products as $product): ?>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <div class="product__item__pic">
                                            <img src="img/products/<?php echo htmlspecialchars($product['hinhAnh']); ?>" alt="<?php echo htmlspecialchars($product['TenAnPham']); ?>">
                                            <ul class="product__item__pic__hover">
                                                <li>
                                                    <a href="shop-details.php?id=<?php echo urlencode($product['maAnPham']); ?>"><i class="fa fa-eye"></i></a>
                                                </li>
                                                <li>
                                                    <form method="POST" action="add_to_cart.php">
                                                        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['maAnPham']); ?>">
                                                        <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['TenAnPham']); ?>">
                                                        <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($product['Giathue']); ?>">
                                                        <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($product['hinhAnh']); ?>">
                                                        <button type="submit" name="add_to_cart" class="btn btn-primary">
                                                            <i class="fa fa-shopping-cart"></i>
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="product__item__text">
                                            <h6><a href="shop-details.php?id=<?php echo urlencode($product['maAnPham']); ?>"><?php echo htmlspecialchars($product['TenAnPham']); ?></a></h6>
                                            <h5><?php echo number_format($product['Giathue'], 0, ',', '.'); ?> VNĐ</h5>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Không có sản phẩm để hiển thị.</p>
                        <?php endif; ?>
                    </div>
                    <!-- Có thể thêm phân trang ở đây nếu cần -->
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <footer>
        <?php require_once 'layout/footer.php'; ?>
    </footer>
</body>

</html>
<?php
// Đóng kết nối cơ sở dữ liệu nếu chưa đóng
if (isset($conn) && $conn) {
    mysqli_close($conn);
}
?>