<!DOCTYPE html>
<html lang="zxx">
<?php
include 'controlCustomerUI/controlCheckout.php';
$cartItems = getCartDetails($conn); // Lấy dữ liệu giỏ hàng từ controller
?>

<head>
    <?php require_once 'layout/header.php' ?>
</head>

<body>
    <!-- Checkout Section Begin -->
    <section class="checkout spad" style="padding-top: 10px">
        <div class="container">
            <div class="checkout__form">
                <h4>Thông tin giao hàng</h4>
                <form action="#">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Họ và tên<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Số điện thoại<span>*</span></p>
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
                        <div class="col-lg-8 col-md-6 AAA">
                            <div class="checkout__order">
                                <h4>Đơn hàng</h4>
                                <table class="checkout__table">
                                    <thead>
                                        <tr>
                                            <th>Ấn phẩm</th>
                                            <th>Số lượng</th>
                                            <th>Đơn giá</th>
                                            <th>Ngày mượn</th>
                                            <th>Ngày trả</th>
                                            <th>Phí thuê (5% giá trị ấn phẩm)</th>
                                            <th>Tổng cộng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Giả sử $cartItems là dữ liệu giỏ hàng từ hàm getCartDetails
                                        $totalAmount = 0; // Biến lưu tổng tiền của giỏ hàng
                                        
                                        // Duyệt qua giỏ hàng và hiển thị từng sản phẩm
                                        foreach ($cartItems as $item):
                                            $totalAmount += $item['Giathue'] * $item['SoLuong'] + $item['PhiThue']; // Cộng dồn tổng tiền
                                            ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($item['TenAnPham']); ?></td>
                                                <td><?php echo htmlspecialchars($item['SoLuong']); ?></td>
                                                <td><?php echo number_format($item['Giathue'], 0, '', '.'); ?></td>
                                                <td><?php echo date('d/m/Y', strtotime($item['NgayMuon'])); ?></td>
                                                <td><?php echo date('d/m/Y', strtotime($item['NgayTra'])); ?></td>
                                                <td><?php echo number_format($item['PhiThue'], 0, '', '.'); ?></td>
                                                <td><?php echo number_format($item['Giathue'] * $item['SoLuong'] + $item['PhiThue'], 0, '', '.') . ' VND'; ?>
                                                </td> <!-- Định dạng số -->
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <div class="checkout__order__total">Tạm tính
                                    <span
                                        id="totalPrice"><?php echo number_format($totalAmount, 0, '', '.') . ' VND'; ?></span>
                                </div>

                                <!-- Hàng phí giao hàng -->
                                <div class="checkout__order__total">Phí giao hàng
                                    <span id="shippingFee">
                                        <?php
                                        // Định nghĩa phí giao hàng mặc định
                                        $shippingFee = 20000;
                                        // Hiển thị phí giao hàng
                                        echo number_format($shippingFee, 0, '', '.') . ' VND';
                                        ?>
                                    </span>
                                </div>

                                <?php
                                // Tính tổng tiền giỏ hàng gốc (trước giảm giá)
                                $totalAmount = 0;
                                foreach ($cartItems as $item) {
                                    $totalAmount += $item['Giathue'] * $item['SoLuong'] + $item['PhiThue'];
                                }

                                // Lấy mã khuyến mãi hiện tại từ yêu cầu hoặc mặc định rỗng
                                $couponCode = isset($_POST['coupon_code']) ? $_POST['coupon_code'] : '';

                                // Tính giá trị sau khi áp dụng khuyến mãi
                                $discountedPrice = calculateDiscountedPrice($totalAmount, $couponCode, $conn);

                                // Tính số tiền giảm giá
                                $discountAmount = $totalAmount - $discountedPrice;

                                // Thêm phí giao hàng vào tổng cộng
                                $finalPrice = $discountedPrice + $shippingFee;
                                ?>

                                <!-- Hiển thị khuyến mãi -->
                                <div class="checkout__order__total">
                                    Khuyến mãi:
                                    <select name="coupon_code" id="coupon_code">
                                        <option value="">-- Chọn khuyến mãi --</option>
                                        <?php
                                        // Lấy danh sách khuyến mãi từ cơ sở dữ liệu
                                        $coupons = getCoupons($conn);

                                        // Kiểm tra xem có khuyến mãi nào không
                                        if (!empty($coupons)) {
                                            // Duyệt qua các khuyến mãi và tạo option cho mỗi khuyến mãi
                                            foreach ($coupons as $coupon) {
                                                echo '<option value="' . htmlspecialchars($coupon['MaKhuyenMai']) . '">' . htmlspecialchars($coupon['TenKhuyenMai']) . '</option>';
                                            }
                                        } else {
                                            echo '<option value="">Không có khuyến mãi</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <!-- Hiển thị số tiền giảm giá -->
                                <div class="checkout__order__total">
                                    Giảm giá:
                                    <span id="discountAmount">
                                        <?php
                                        // Hiển thị số tiền giảm (discountAmount)
                                        echo number_format($discountAmount, 0, '', '.') . ' VND';
                                        ?>
                                    </span>
                                </div>

                                <!-- Hiển thị tổng tiền -->
                                <div class="checkout__order__total">
                                    Tổng cộng:
                                    <span id="discountText">
                                        <?php
                                        // Hiển thị tổng tiền sau giảm giá và phí giao hàng
                                        echo number_format($finalPrice, 0, '', '.') . ' VND';
                                        ?>
                                    </span>
                                </div>

                                <div>
                                    <h5 class="checkout__payment__title">Phương thức thanh toán</h5>
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
                            </div>
                            <button type="submit" class="site-btn">THANH TOÁN</button>
                        </div>
                    </div>
            </div>
        </div>
        </form>
        </div>
        </div>
    </section>
    <!-- Checkout Section End -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#coupon_code').change(function () {
                var couponCode = $(this).val();

                $.ajax({
                    url: 'controlCustomerUI/controlUpdateCoupon.php',
                    type: 'POST',
                    data: { coupon_code: couponCode },
                    success: function (response) {
                        try {
                            var data = JSON.parse(response);

                            // Cập nhật thông tin giảm giá và tổng tiền
                            $('#discountAmount').text(data.discountText);
                            $('#discountText').text(data.totalPrice);
                        } catch (error) {
                            alert('Phản hồi không hợp lệ từ server.');
                            console.error(error);
                        }
                    },
                    error: function () {
                        alert('Có lỗi xảy ra, vui lòng thử lại!');
                    }
                });
            });
        });
    </script>
    <footer>
        <?php require_once 'layout/footer.php' ?>
    </footer>

</body>

</html>