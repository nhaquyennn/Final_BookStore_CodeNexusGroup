<!DOCTYPE html>
<html lang="zxx">


<head>
    <?php require_once 'layout/header.php' ?>
</head>



<body>
    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng tiền</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img style='width:140px;float: left;' src="img/product/book-5.jpg" alt="">
                                        <div class="sp">
                                            <h5><b>Doraemon - Nobita và lâu đài dưới biển</b></h5>
                                            <p>Thể loại: Truyện tranh</p>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__price">
                                        $55.00
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="1">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        $55.00
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <span class="icon_close"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img style='width:140px;float: left;' src="img/product/book-3.jpg" alt="">
                                        <div class="sp">
                                            <h5><b>Ánh đèn giữa hai đại dương</b></h5>
                                            <p>Thể loại: Truyện tranh</p>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__price">
                                        $39.00
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="1">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        $39.00
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <span class="icon_close"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img style='width:140px;float: left' src="img/product/book-9.jpg" alt="">
                                        <div class="sp">
                                            <h5><b>Ánh đèn giữa hai đại dương</b></h5>
                                            <p>Thể loại: Tiểu thuyết</p>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__price">
                                        $69.00
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="1">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        $69.00
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <span class="icon_close"></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="./shop-grid.php" class="primary-btn cart-btn">Tiếp tục chọn sách</a>
                        <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Upadate Cart</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>KHUYẾN MÃI</h5>
                            <form action="#">
                                <input type="text" placeholder="Nhập mã khuyến mãi">
                                <button type="submit" class="site-btn">GỬI</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Tổng giỏ hàng</h5>
                        <ul>
                            <li>Tạm tính <span>$454.00</span></li>
                            <li>Phí vận chuyển <span>$5</span></li>
                            <li>Tổng cộng <span>$459.00</span></li>
                        </ul>
                        <a href="./checkout.php" class="checkout-btn"> Thanh toán</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->

    <footer>
        <?php require_once 'layout/footer.php' ?>
    </footer>

</body>

</html>