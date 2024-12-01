<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
    <div class="brand-logo">
        <a href="index.html">
            <img src="/bookstore/ADMIN/assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
            <h5 class="logo-text">Admin</h5>
        </a>
    </div>

    <ul class="sidebar-menu do-nicescrol">
        <!-- Dashboard -->
        <li><a href="index.php" class="sidebar-link"><span>Dashboard</span></a></li>
        <li>
            <hr>
        </li>

        <!-- Yêu cầu -->
        <li class="dropdown">
            <a href="requirements.php">
                <i class="zmdi"></i>
                <span class="dropdown-toggle" data-toggle="dropdown">Yêu cầu</span>

                <ul class="dropdown-menu">
                    <li><a href="#">Yêu cầu xóa khách hàng</a></li>
                    <li><a href="#">Yêu cầu xóa ấn phẩm</a></li>
                </ul>
            </a>
        </li>

        <!-- Khuyến mãi -->
        <li><a href="promotion.html" class="sidebar-link"><span>Khuyến mãi</span></a></li>

        <!-- Ấn phẩm -->
        <li><a href="product.php" class="sidebar-link"><span>Ấn phẩm</span></a></li>

        <!-- Đơn hàng -->
        <li><a href="cart.php" class="sidebar-link"><span>Đơn hàng</span></a></li>

        <!-- Danh mục -->
        <li><a href="category.html" class="sidebar-link"><span>Danh mục</span></a></li>

        <!-- Thống kê ấn phẩm -->
        <li class="list-group-item">
            <a href="#" class="sidebar-link" id="statsLinkPublications"><span>Thống kê ấn phẩm</span></a>
            <!-- Danh sách ngày tháng năm -->
            <ul id="dateListPublications" class="list-group" style="display: none; padding-left: 20px; font-size: 14px;">
                <li class="list-group-item"><a href="/bookstore/ADMIN/view/report/thongke/thongKeSanPhamTheoNgay.php">Ngày</a></li>
                <li class="list-group-item"><a href="/bookstore/ADMIN/view/report/thongke/thongKeSanPhamTheoThang.php">Tháng</a></li>
                <li class="list-group-item"><a href="/bookstore/ADMIN/view/report/thongke/thongKeSanPhamTheoNam.php">Năm</a></li>
            </ul>
        </li>

        <!-- Thống kê doanh thu -->
        <li class="list-group-item">
            <a href="#" class="sidebar-link" id="statsLinkRevenue"><span>Báo cáo doanh thu</span></a>
            <!-- Danh sách ngày tháng năm -->
            <ul id="dateListRevenue" class="list-group" style="display: none; padding-left: 20px; font-size: 14px;">
                <li class="list-group-item"><a href="/bookstore/ADMIN/view/report/baocao/baoCaoDoanhThuTheoNgay.php">Ngày</a></li>
                <li class="list-group-item"><a href="/bookstore/ADMIN/view/report/baocao/baoCaoDoanhThuTheoThang.php">Tháng</a></li>
                <li class="list-group-item"><a href="/bookstore/ADMIN/view/report/baocao/baoCaoDoanhThuTheoNam.php">Năm</a></li>
            </ul>
        </li>

        <!-- Hóa đơn -->
        <li><a href="bill.html" class="sidebar-link"><span>Hóa đơn</span></a></li>

        <!-- Nhân viên -->
        <li><a href="employees.php" class="sidebar-link"><span>Nhân viên</span></a></li>

        <!-- Khách hàng -->
        <li><a href="customers.php" class="sidebar-link"><span>Khách hàng</span></a></li>
        <li>
            <hr>
        </li>

        <!-- Thông tin cá nhân -->
        <li><a href="profile.php" class="sidebar-link"><span>Thông tin cá nhân</span></a></li>

        <!-- Đăng xuất -->
        <li><a href="user/logout.php" class="sidebar-link"><span>Đăng xuất</span></a></li>
    </ul>
</div>

<script>
    // Gán sự kiện click cho các liên kết trong sidebar
    document.querySelectorAll('.sidebar-link').forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault(); // Ngăn chặn hành động mặc định

            // Lấy ID của danh sách cần hiển thị
            let targetId = null;
            if (link.getAttribute('id') === 'statsLinkPublications') {
                targetId = 'dateListPublications';
            } else if (link.getAttribute('id') === 'statsLinkRevenue') {
                targetId = 'dateListRevenue';
            }

            // Nếu không có danh sách con liên quan, bỏ qua
            if (!targetId) return;

            // Lấy danh sách cần hiển thị
            const targetList = document.getElementById(targetId);

            // Đóng tất cả các danh sách con khác
            document.querySelectorAll('.list-group').forEach(list => {
                if (list !== targetList) {
                    list.style.display = 'none'; // Ẩn các danh sách không liên quan
                }
            });

            // Chuyển đổi hiển thị danh sách hiện tại
            if (targetList) {
                targetList.style.display = targetList.style.display === 'block' ? 'none' : 'block';
            }
        });
    });
</script>