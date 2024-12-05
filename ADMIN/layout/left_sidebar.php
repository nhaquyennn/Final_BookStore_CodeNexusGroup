<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
    <div class="brand-logo">
        <a href="index.html">
            <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
            <h5 class="logo-text">Admin</h5>
        </a>
    </div>
    <ul class="sidebar-menu do-nicescrol">
        <li><a href="index.php" class="sidebar-link"><span>Dashboard</span></a></li>
        <li>
            <hr>
        </li>

        <!-- Yêu cầu -->
        <li class="dropdown">
            <a href="#" class="sidebar-link dropdown-toggle">
                <span>Yêu cầu</span>
                <span class="arrow"></span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="#">Yêu cầu xóa khách hàng</a></li>
                <li><a href="#">Yêu cầu xóa ấn phẩm</a></li>
            </ul>
        </li>

        <li><a href="promotion.html" class="sidebar-link"><span>Khuyến mãi</span></a></li>
        <li><a href="product.php" class="sidebar-link"><span>Ấn phẩm</span></a></li>

        <!-- Đơn hàng -->
        <li class="dropdown">
            <a href="#" class="sidebar-link dropdown-toggle">
                <span>Đơn hàng</span>
                <span class="arrow"></span>
            </a>
            <ul class="dropdown-menu">
                <li class="list-group-item"><a href="view/order/formTimKiem.php">Tìm kiếm đơn hàng</a></li>
                <li class="list-group-item"><a href="view/order/donHangChoDuyet.php">Duyệt đơn hàng</a></li>
            </ul>
        </li>

        <li><a href="category.html" class="sidebar-link"><span>Danh mục</span></a></li>

        <!-- Thống kê ấn phẩm -->
        <li class="dropdown">
            <a href="#" class="sidebar-link dropdown-toggle">
                <span>Thống kê sản phẩm</span>
                <span class="arrow"></span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="view/report/thongke/thongKeSanPhamTheoNgay.php">Ngày</a></li>
                <li><a href="view/report/thongke/thongKeSanPhamTheoThang.php">Tháng</a></li>
                <li><a href="view/report/thongke/thongKeSanPhamTheoNam.php">Năm</a></li>
            </ul>
        </li>
        <!-- Thống kê doanh thu -->
        <li class="dropdown">
            <a href="#" class="sidebar-link dropdown-toggle">
                <span>Báo cáo doanh thu</span>
                <span class="arrow"></span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="view/report/baocao/baoCaoDoanhThuTheoNgay.php">Ngày</a></li>
                <li><a href="view/report/baocao/baoCaoDoanhThuTheoThang.php">Tháng</a></li>
                <li><a href="view/report/baocao/baoCaoDoanhThuTheoNam.php">Năm</a></li>
            </ul>
        </li>
        <li><a href="bill.html" class="sidebar-link"><span>Hóa đơn</span></a></li>
        <li><a href="employees.php" class="sidebar-link"><span>Nhân viên</span></a></li>
        <li><a href="customers.php" class="sidebar-link"><span>Khách hàng</span></a></li>
        <li>
            <hr>
        </li>
        <li><a href="profile.php" class="sidebar-link"><span>Thông tin cá nhân</span></a></li>
        <li><a href="user/logout.php" class="sidebar-link"><span>Đăng xuất</span></a></li>
    </ul>
</div>

<script>
    // Lấy tất cả các mục có lớp 'sidebar-link'
    const navLinks = document.querySelectorAll('.sidebar-link');

    // Lấy URL hiện tại
    const currentUrl = window.location.href;

    // Duyệt qua từng mục và kiểm tra nếu URL khớp
    navLinks.forEach(link => {
        if (link.href === currentUrl) {
            link.classList.add('active');
        }
    });

    document.addEventListener("DOMContentLoaded", () => {
        const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

        dropdownToggles.forEach((toggle) => {
            toggle.addEventListener('click', (e) => {
                e.preventDefault(); // Ngăn chặn chuyển hướng khi nhấn vào link

                // Tìm dropdown tương ứng
                const dropdown = toggle.parentElement;
                const dropdownMenu = dropdown.querySelector('.dropdown-menu');

                // Đóng các dropdown khác (nếu muốn)
                document.querySelectorAll('.dropdown.open').forEach((openDropdown) => {
                    if (openDropdown !== dropdown) {
                        openDropdown.classList.remove('open');
                        openDropdown.querySelector('.dropdown-menu').style.display = 'none';
                    }
                });

                // Mở/đóng dropdown hiện tại
                dropdown.classList.toggle('open');
                dropdownMenu.style.display = dropdown.classList.contains('open') ? 'block' : 'none';
            });
        });
    });

</script>