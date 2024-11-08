<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
    <div class="brand-logo">
        <a href="index.html">
            <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
            <h5 class="logo-text">Admin</h5>
        </a>
    </div>
    <ul class="sidebar-menu do-nicescrol list-group">
        <li class="list-group-item"><a href="index.php" class="sidebar-link"><span>Dashboard</span></a></li>
        <li><hr></li>
        <li class="list-group-item"><a href="requirements.php" class="sidebar-link"><span>Yêu cầu</span></a></li>
        <li class="list-group-item"><a href="promotion.html" class="sidebar-link"><span>Khuyến mãi</span></a></li>
        <li class="list-group-item"><a href="product.php" class="sidebar-link"><span>Ấn phẩm</span></a></li>
        <li class="list-group-item"><a href="cart.php" class="sidebar-link"><span>Đơn hàng</span></a></li>
        <li class="list-group-item"><a href="category.html" class="sidebar-link"><span>Danh mục</span></a></li>
        <li class="list-group-item">
            <a href="#" class="sidebar-link" id="statsLink"><span>Thống kê ấn phẩm</span></a>
            <!-- Danh sách ngày tháng năm, ẩn ban đầu -->
            <ul id="dateList" class="list-group" style="display: none; padding-left: 20px; font-size: 14px;">
                <li class="list-group-item"><a href="report/day_statistics.php">Ngày</a></li>
                <li class="list-group-item"><a href="report/month_statistics.php">Tháng</a></li>
                <li class="list-group-item"><a href="report/year_statistics.php">Năm</a></li>
            </ul>
        </li>
        <li class="list-group-item"><a href="bill.html" class="sidebar-link"><span>Hóa đơn</span></a></li>
        <li class="list-group-item"><a href="employees.php" class="sidebar-link"><span>Nhân viên</span></a></li>
        <li class="list-group-item"><a href="customers.php" class="sidebar-link"><span>Khách hàng</span></a></li>
        <li><hr></li>
        <li class="list-group-item"><a href="profile.php" class="sidebar-link"><span>Thông tin cá nhân</span></a></li>
        <li class="list-group-item"><a href="login.html" class="sidebar-link"><span>Đăng xuất</span></a></li>
    </ul>
</div>

<script>
    // Lấy tất cả các mục có lớp 'sidebar-link'
    const navLinks = document.querySelectorAll('.sidebar-link');

    // Lấy URL hiện tại
    const currentUrl = window.location.href;

    // Duyệt qua từng mục và kiểm tra nếu URL khớp
    // navLinks.forEach(link => {
    //     if (link.href === currentUrl) {
    //         link.classList.add('active');
    //     }
    // });
</script>