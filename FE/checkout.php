<!DOCTYPE html>
<html lang="zxx">
<?php
include 'controlCustomerUI/controlCheckout.php';
$cartItems = getCartDetails($conn); // Lấy dữ liệu giỏ hàng từ controller
$coupons = getCoupons($conn);
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
                <form action="controlCustomerUI/controlPayment.php" method="POST">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Họ và tên<span>*</span></p>
                                        <input name="hoTen" type="text" required placeholder="Nhập họ và tên">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Số điện thoại<span>*</span></p>
                                        <input id="phone" type="text" required oninput="validatePhone()"
                                            placeholder="Nhập số điện thoại" name="soDienThoai">
                                        <span id="phoneError" style="color: red; display: none; font-size: 15px">Số điện
                                            thoại phải bắt
                                            đầu bằng số 0 và có 10 chữ số.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Địa chỉ<span>*</span></p>
                                <input name="diaChi" type="text" placeholder="Nhập địa chỉ" class="checkout__input__add"
                                    required>
                            </div>
                            <div class="checkout__input">
                                <p>Ghi chú<span></span></p>
                                <input name="ghiChu" type="text" placeholder="Để lại lời nhắn cho cửa hàng.">
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
                                            <th style="color: red">Phí thuê (5% giá trị ấn phẩm * số lượng * số ngày mượn)</th> <!-- Added new column for Rental Fee -->
                                            <th>Tổng cộng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $totalAmount = 0;
                                        $totalRentalFee = 0; // Initialize total rental fee
                                        
                                        foreach ($cartItems as $item):
                                            // Calculate rental fee: PhiThue * 0.05 * (NgayMuon - NgayTra)
                                            $rentalFee = $item['PhiThue'] * $item['SoLuong'] * 0.05 * (strtotime($item['NgayTra']) - strtotime($item['NgayMuon'])) / (60 * 60 * 24); // Convert days to seconds
                                            $totalRentalFee += $rentalFee;

                                            // Add to total amount
                                            $totalAmount += ($item['Giathue'] * $item['SoLuong']) + $rentalFee;
                                            ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($item['TenAnPham']); ?></td>
                                                <td><?php echo htmlspecialchars($item['SoLuong']); ?></td>
                                                <td><?php echo number_format($item['Giathue'], 0, '', '.')  . ' VND'; ?></td>
                                                <td><?php echo date('d/m/Y', strtotime($item['NgayMuon'])); ?></td>
                                                <td><?php echo date('d/m/Y', strtotime($item['NgayTra'])); ?></td>
                                                <td><?php echo number_format($rentalFee, 0, '', '.') . ' VND'; ?></td>
                                                <!-- Display rental fee -->
                                                <td><?php echo number_format(($item['Giathue'] * $item['SoLuong']) + $rentalFee, 0, '', '.') . ' VND'; ?>
                                                </td> <!-- Display total with rental fee -->
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                                <div class="checkout__order__total">Tạm tính
                                    <span
                                        id="totalPrice"><?php echo number_format($totalAmount, 0, '', '.') . ' VND'; ?></span>
                                </div>

                                <?php
                                // Tính tổng tiền giỏ hàng gốc (trước giảm giá)
                                $totalAmount = 0;
                                foreach ($cartItems as $item) {
                                    $rentalFee = $item['PhiThue'] * 0.05 * (strtotime($item['NgayTra']) - strtotime($item['NgayMuon'])) / (60 * 60 * 24); // Recalculate for the total amount
                                    $totalAmount += ($item['Giathue'] * $item['SoLuong']) + $rentalFee;
                                }

                                // Lấy mã khuyến mãi hiện tại từ yêu cầu hoặc mặc định rỗng
                                $couponCode = isset($_POST['coupon_code']) ? $_POST['coupon_code'] : '';

                                // Tính giá trị sau khi áp dụng khuyến mãi
                                $discountedPrice = calculateDiscountedPrice($totalAmount, $couponCode, $conn);

                                // Tính số tiền giảm giá
                                $discountAmount = $totalAmount - $discountedPrice;

                                // Thêm phí giao hàng vào tổng cộng
                                $shippingFee = 20000;
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

                                        // Kiểm tra số lượng sách khách hàng đã thuê trong tháng
                                        $customerId = getCustomerIdFromPhieuMuon($conn); // Lấy id của khách hàng từ session hoặc cơ sở dữ liệu
                                        $month = date('m'); // Tháng hiện tại
                                        $year = date('Y'); // Năm hiện tại
                                        $query = "
                                                    SELECT SUM(ct.SoLuong) AS totalBooks
                                                    FROM chitietpm ct
                                                    JOIN phieumuon pm ON ct.MaPhieuMuon = pm.MaPhieuMuon
                                                    WHERE MONTH(pm.NgayTao) = '$month' 
                                                    AND YEAR(pm.NgayTao) = '$year' 
                                                    AND pm.maKH = '$customerId'
                                                ";

                                        $result = mysqli_query($conn, $query);
                                        $row = mysqli_fetch_assoc($result);
                                        $totalBooks = $row['totalBooks'];

                                        // Kiểm tra nếu khách hàng đã thuê >= 10 cuốn sách trong tháng
                                        $showCoupon4 = ($totalBooks >= 10); // Biến kiểm tra xem có đủ điều kiện để hiển thị mã 4
                                        
                                        // Duyệt qua các khuyến mãi và tạo option cho mỗi khuyến mãi
                                        foreach ($coupons as $coupon) {
                                            // Nếu khách hàng không đủ điều kiện và mã khuyến mãi là 4, thì ẩn đi
                                            if ($coupon['MaKhuyenMai'] == 4 && !$showCoupon4) {
                                                continue;
                                            }
                                            echo '<option value="' . htmlspecialchars($coupon['MaKhuyenMai']) . '">' . htmlspecialchars($coupon['TenKhuyenMai']) . '</option>';
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

                                <!-- Hàng phí giao hàng -->
                                <div class="checkout__order__total">Phí giao hàng
                                    <span id="shippingFee">
                                        <?php
                                        // Hiển thị phí giao hàng
                                        echo number_format($shippingFee, 0, '', '.') . ' VND';
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
                                            <input type="checkbox" id="payment" name="phuongThucThanhToan">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="checkout__input__checkbox">
                                        <label for="paypal">
                                            VNPAY
                                            <input type="checkbox" id="paypal" name="phuongThucThanhToan">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="site-btn">THANH TOÁN</button>
                        </div>

                        <input type="hidden" name="tongTien" value="<?php echo $finalPrice; ?>">
                        <input type="hidden" name="giamGia" value="<?php echo $discountAmount; ?>">
                        <input type="hidden" name="maKH" value="<?php echo $customerId; ?>">
                        <input type="hidden" name="cartItems" value='<?php echo json_encode($cartItems); ?>'>
                    </div>
            </div>
        </div>
        </form>
        </div>
        </div>
    </section>
    <!-- Checkout Section End -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js_checkout/check.js"></script>
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

                            // Hiển thị số lượng sách đã thuê
                            console.log("Số lượng sách đã thuê trong tháng: " + data.totalBooks);
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