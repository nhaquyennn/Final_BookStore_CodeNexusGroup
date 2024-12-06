<!DOCTYPE html>
<html lang="zxx">

<head>
    <?php require_once 'layout/header.php' ?>
    <style>
        .checkout__table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 14px;
            text-align: left;
        }

        .checkout__table th,
        .checkout__table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .checkout__table th {
            font-weight: bold;
            text-transform: uppercase;
        }

        .checkout__table td:last-child,
        .checkout__table th:last-child {
            text-align: right;
            /* Canh phải cho cột Total */
        }

        .checkout__order__subtotal,
        .checkout__order__total {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            font-weight: bold;
        }

        .checkout__payment__title {
            font-size: 21px;
            font-weight: bold;
            margin-bottom: 10px;
            color: black;
        }
    </style>
</head>

<body>
    <!-- Page Preloder -->
    <!-- <div id="preloder">
        <div class="loader"></div>
    </div> -->



    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                    </h6>
                </div>
            </div>
            <div class="checkout__form">
                <h4>Thông tin giao hàng</h4>
                <form action="#">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Họ và tên<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Số điện thoại<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Địa chỉ<span>*</span></p>
                                <input type="text" placeholder="" class="checkout__input__add">
                            </div>
                            <div class="checkout__input">
                                <p>Ghi chú<span></span></p>
                                <input type="text" placeholder="Để lại lời nhắn cho cửa hàng.">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="checkout__order">
                                <h4>Đơn hàng</h4>
                                <table class="checkout__table">
                                    <thead>
                                        <tr>
                                            <th>Products</th>
                                            <th>Ngày mượn</th>
                                            <th>Ngày trả</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Vegetable’s Package</td>
                                            <td>01/12/2024</td>
                                            <td>07/12/2024</td>
                                            <td>$75.99</td>
                                        </tr>
                                        <tr>
                                            <td>Fresh Vegetable</td>
                                            <td>01/12/2024</td>
                                            <td>07/12/2024</td>
                                            <td>$151.99</td>
                                        </tr>
                                        <tr>
                                            <td>Organic Bananas</td>
                                            <td>01/12/2024</td>
                                            <td>07/12/2024</td>
                                            <td>$53.99</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="checkout__order__total">Tạm tính <span>$750.99</span></div>
                                <div class="checkout__order__total">Khuyến mãi <span>$750.99</span></div>
                                <div class="checkout__order__total">Tổng cộng <span>$750.99</span></div>
                                <div>
                                    <h5 class="checkout__payment__title">Phương thức thanh toán</h5>
                                    <!-- Tiêu đề thêm vào -->
                                    <div class="checkout__input__checkbox">
                                        <label for="payment">
                                            MOMO
                                            <input type="checkbox" id="payment">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="checkout__input__checkbox">
                                        <label for="paypal">
                                            VNPAY
                                            <input type="checkbox" id="paypal">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>

                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

    <!-- Footer Section Begin -->

    <!-- Footer Section End -->

    <footer>
        <?php require_once 'layout/footer.php' ?>
    </footer>



</body>

</html>