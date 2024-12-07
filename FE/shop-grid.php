<?php
include 'controlCustomerUI/controlShopGrid.php';
include 'controlCustomerUI/controlFilterProduct.php';
include 'controlCustomerUI/controlCategoryGrid.php';

// Lấy các danh mục và bộ lọc
$categories_name_only = getAllCategories($conn);
$authors = getAllAuthors($conn);
$publishers = getAllPublishers($conn);
$years = getAllPublishYears($conn);
$rentalPrices = getAllRentalPrices($conn);

// Xử lý bộ lọc từ request
$filter_params = [];
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $filter_params = [
        'category' => $_GET['category'] ?? '',
        'min_price' => $_GET['min_price'] ?? '',
        'max_price' => $_GET['max_price'] ?? '',
        'author' => $_GET['author'] ?? '',
        'publisher' => $_GET['publisher'] ?? '',
        'year' => $_GET['year'] ?? '',
        'sort' => $_GET['sort'] ?? ''
    ];

    // Lọc sản phẩm theo điều kiện
    $products = filterProducts($conn, $filter_params);
} else {
    // Nếu không có filter, lấy tất cả sản phẩm
    $products = filterProducts($conn, []);
}


// Tổng số lượng ấn phẩm
$totalQuantity_dauap = count($products);
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <?php require_once 'layout/header.php' ?>
</head>

<body>
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <form method="get" action="">
                            <!-- Danh mục -->
                            <div class="sidebar__item">
                                <h4>DANH MỤC</h4>
                                <ul>
                                    <li><input type="radio" name="category" value="" checked> Tất cả</li>
                                    <?php foreach ($categories_name_only as $category): ?>
                                        <li>
                                            <input type="radio" name="category"
                                                value="<?php echo htmlspecialchars($category); ?>">
                                            <?php echo htmlspecialchars($category); ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <!-- Khoảng giá -->
                            <div class="sidebar__item">
                                <h4>Giá</h4>
                                <div class="price-range">
                                    <input type="range" id="min_price" name="min_price" min="0" max="1000000"
                                        step="10000" value="0" oninput="updatePriceLabels()">
                                    <input type="range" id="max_price" name="max_price" min="0" max="1000000"
                                        step="10000" value="1000000" oninput="updatePriceLabels()">
                                    <div class="price-labels">
                                        <span id="min_price_label">0 VND</span> - <span id="max_price_label">1,000,000
                                            VND</span>
                                    </div>
                                </div>
                                <button type="submit" style="width: 221px; margin-top:60px ">Lọc</button>
                            </div>


                            <!-- Tác giả -->
                            <div class="sidebar__item">
                                <h4>Tác giả</h4>
                                <ul>
                                    <li><input type="radio" name="author" value="" checked> Tất cả</li>
                                    <?php foreach ($authors as $author): ?>
                                        <li>
                                            <input type="radio" name="author"
                                                value="<?php echo htmlspecialchars($author); ?>">
                                            <?php echo htmlspecialchars($author); ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <!-- Nhà xuất bản -->
                            <div class="sidebar__item">
                                <h4>Nhà xuất bản</h4>
                                <ul>
                                    <li><input type="radio" name="publisher" value="" checked> Tất cả</li>
                                    <?php foreach ($publishers as $publisher): ?>
                                        <li>
                                            <input type="radio" name="publisher"
                                                value="<?php echo htmlspecialchars($publisher); ?>">
                                            <?php echo htmlspecialchars($publisher); ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <!-- Năm xuất bản -->
                            <div class="sidebar__item">
                                <h4>Năm xuất bản</h4>
                                <ul>
                                    <li><input type="radio" name="year" value="" checked> Tất cả</li>
                                    <?php foreach ($years as $year): ?>
                                        <li>
                                            <input type="radio" name="year" value="<?php echo htmlspecialchars($year); ?>">
                                            <?php echo htmlspecialchars($year); ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <!-- Sắp xếp -->
                            <div class="sidebar__item">
                                <h4>Sắp xếp theo</h4>
                                <select name="sort">
                                    <option value="">Mặc định</option>
                                    <option value="low_to_high">Giá từ thấp đến cao</option>
                                    <option value="high_to_low">Giá từ cao đến thấp</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Áp dụng bộ lọc</button>
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
                        </form>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
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
                                                alt="<?php echo htmlspecialchars($product['TenDauAnPham']); ?>">
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__item__text">
                                            <h5><?php echo htmlspecialchars($product['TenAnPham']); ?></h5>
                                            <h6 style="margin-top: 10px;">Tình trạng:
                                                <?php echo htmlspecialchars($product['tinhTrang']); ?>
                                            </h6>
                                            <h6 style="margin-top: 10px;">Giá:
                                                <?php echo number_format($product['Giathue'], 0, ',', '.'); ?> VND
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Không có sản phẩm nào khớp với bộ lọc.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <?php require_once 'layout/footer.php' ?>
    </footer>
    <script>
        function updatePriceLabels() {
            const minPrice = document.getElementById('min_price').value;
            const maxPrice = document.getElementById('max_price').value;

            document.getElementById('min_price_label').textContent = parseInt(minPrice).toLocaleString() + ' VND';
            document.getElementById('max_price_label').textContent = parseInt(maxPrice).toLocaleString() + ' VND';
        }

    </script>
</body>

</html>