<!DOCTYPE html>
<html lang="zxx">
<?php
include 'controlCustomerUI/controlCategoryIndex.php';
include 'controlCustomerUI/controlCategoryGrid.php';
include 'controlCustomerUI/controlFilterProduct.php';
// Lấy các danh mục và bộ lọc
$categories_name_only = getAllCategories($conn);
$authors = getAllAuthors($conn);
$publishers = getAllPublishers($conn);
$years = getAllPublishYears($conn);
$rentalPrices = getAllRentalPrices($conn);

// Lấy tất cả các sản phẩm khi không có bộ lọc
$filter_params = [
    'category' => $_GET['category'] ?? '',
    'min_price' => $_GET['min_price'] ?? 0,
    'max_price' => $_GET['max_price'] ?? 1000000,
    'author' => $_GET['author'] ?? '',
    'publisher' => $_GET['publisher'] ?? '',
    'year' => $_GET['year'] ?? '',
    'sort' => $_GET['sort'] ?? ''
];

// Lọc sản phẩm theo điều kiện
$products = filterProducts($conn, $filter_params); ?>


<head>
    <?php require_once 'layout/header.php' ?>
    <?php require_once 'layout/header_section.php' ?>
</head>

<body>
    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    <?php foreach ($categories_with_image as $category_with_image): ?>
                        <!-- Tạo mỗi item của danh mục với tên và hình ảnh từ cơ sở dữ liệu -->
                        <div class="col-lg-3">
                            <div class="categories__item">
                                <img src="img/products/<?php echo htmlspecialchars($category_with_image['image']); ?>"
                                    alt="<?php echo htmlspecialchars($category_with_image['TenDanhMuc']); ?>">
                                <h5><a
                                        href="shop-grid.php?category=<?php echo urlencode($category_with_image['TenDanhMuc']); ?>&min_price=0&max_price=1000000&author=&publisher=&year=&sort=">
                                        <?php echo htmlspecialchars($category_with_image['TenDanhMuc']); ?>
                                    </a></h5>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Sản phẩm được thuê nhiều -->
    <section class="featured spad" style="padding: 20px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title" style="margin-bottom: 0px;">
                        <h2>Sản phẩm nổi bật</h2>
                        <div class="row featured__filter">
                            <?php if (!empty($product_popular)): ?>
                                <?php foreach ($product_popular as $product): ?>
                                    <div class="col-lg-3 col-md-4 col-sm-6 mt-5">
                                        <div class="featured__item">
                                            <div class="featured__item__pic set-bg"
                                                data-setbg="img/products/<?php echo htmlspecialchars($product['hinhAnh']); ?>">
                                                <ul class="featured__item__pic__hover">
                                                    <li><a style="background-color: #E75480; border: none; color: white"
                                                            href="shop-details.php?id=<?php echo urlencode($product['maAnPham']); ?>"><i
                                                                class="fa fa-eye"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="featured__item__text">
                                                <h6><a href="#"><?php echo htmlspecialchars($product['TenAnPham']); ?></a></h6>
                                                <h5><?php echo number_format($product['Giathue'], 0, ',', '.'); ?> VND</h5>
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
    <!-- Sản phẩm được thuê nhiều End -->

    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Mới nhất</h4>
                        <div class="latest-product__slider owl-carousel">
                            <?php if (!empty($products_new)): ?>
                                <?php
                                $chunks = array_chunk($products_new, 3); // Chia sản phẩm thành các nhóm 3 sản phẩm
                                foreach ($chunks as $chunk): ?>
                                    <div class="latest-product__slider__item">
                                        <?php foreach ($chunk as $product): ?>
                                            <a href="shop-details.php?id=<?php echo urlencode($product['maAnPham']); ?>"
                                                class="latest-product__item">
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
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Mới nhất</h4>
                        <div class="latest-product__slider owl-carousel">
                            <?php if (!empty($products_new)): ?>
                                <?php
                                $chunks = array_chunk($products_new, 3); // Chia sản phẩm thành các nhóm 3 sản phẩm
                                foreach ($chunks as $chunk): ?>
                                    <div class="latest-product__slider__item">
                                        <?php foreach ($chunk as $product): ?>
                                            <a href="shop-details.php?id=<?php echo urlencode($product['maAnPham']); ?>"
                                                class="latest-product__item">
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
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Thuê nhiều nhất</h4>
                        <div class="latest-product__slider owl-carousel">
                            <?php if (!empty($products_high_rental_count)): ?>
                                <?php
                                $chunks = array_chunk($products_high_rental_count, 3); // Chia sản phẩm thành các nhóm 3 sản phẩm
                                foreach ($chunks as $chunk): ?>
                                    <div class="latest-product__slider__item">
                                        <?php foreach ($chunk as $product): ?>
                                            <a href="shop-details.php?id=<?php echo urlencode($product['maAnPham']); ?>"
                                                class="latest-product__item">
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
    </section>
    <!-- Latest Product Section End -->

    <!-- Footer -->
    <?php require_once 'layout/footer.php' ?>
</body>

</html>