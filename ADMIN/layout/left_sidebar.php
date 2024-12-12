<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
  <div class="brand-logo">
    <a href="index.html">
      <img src="/Final_BookStore_CodeNexus/ADMIN/assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
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
    <li class="list-group-item">
      <a href="#" class="sidebar-link" id="request"><span>Yêu cầu</span></a>
      <!-- Danh sách ngày tháng năm -->
      <ul id="requestForm" class="list-group" style="display: none; padding-left: 20px; font-size: 14px;">
        <li class="list-group-item"><a href="#">Yêu cầu xoá khách hàng</a></li>
        <li class="list-group-item"><a href="#">Yêu cầu xoá án phẩm</a></li>
      </ul>
    </li>

    <!-- Khuyến mãi -->
    <li><a href="promotion.html" class="sidebar-link"><span>Khuyến mãi</span></a></li>

    <!-- Ấn phẩm -->
    <li><a href="product.php" class="sidebar-link"><span>Ấn phẩm</span></a></li>

    <!-- Đơn hàng -->
    <li class="list-group-item">
      <a href="#" class="sidebar-link" id="order">
        <span>Đơn hàng</span>
        <span class="arrow">&#9654;</span></a>

      <!-- Danh sách ngày tháng năm -->
      <ul id="orderForm" class="list-group" style="display: none; padding-left: 20px; font-size: 14px;">
        <li class="list-group-item"><a href="/Final_BookStore_CodeNexus/ADMIN/view/order/formTimKiem.php">Tìm kiếm
            Đơn Hàng</a></li>
        <li class="list-group-item"><a href="/Final_BookStore_CodeNexus/ADMIN/view/order/danhSachDonHang.php">Duyệt
            đơn hàng</a></li>
      </ul>
    </li>

    <!-- Danh mục -->
    <li><a href="category.html" class="sidebar-link"><span>Danh mục</span></a></li>

    <!-- Thống kê ấn phẩm -->
    <li class="list-group-item">
      <a href="#" class="sidebar-link" id="statsLinkPublications">
        <span>Thống kê ấn phẩm</span>
        <span class="arrow">&#9654;</span>
      </a>
      <!-- Danh sách ngày tháng năm -->
      <ul id="dateListPublications" class="list-group" style="display: none; padding-left: 20px; font-size: 14px;">
        <li class="list-group-item"><a
            href="/Final_BookStore_CodeNexus/ADMIN/view/report/thongke/thongKeSanPhamTheoNgay.php">Ngày</a></li>
        <li class="list-group-item"><a
            href="/Final_BookStore_CodeNexus/ADMIN/view/report/thongke/thongKeSanPhamTheoThang.php">Tháng</a></li>
        <li class="list-group-item"><a
            href="/Final_BookStore_CodeNexus/ADMIN/view/report/thongke/thongKeSanPhamTheoNam.php">Năm</a></li>
      </ul>
    </li>

    <!-- Thống kê doanh thu -->
    <li class="list-group-item">
      <a href="#" class="sidebar-link" id="statsLinkRevenue">
        <span>Báo cáo doanh thu</span>
        <span class="arrow">&#9654;</span>
      </a>
      <!-- Danh sách ngày tháng năm -->
      <ul id="dateListRevenue" class="list-group" style="display: none; padding-left: 20px; font-size: 14px;">
        <li class="list-group-item"><a
            href="/Final_BookStore_CodeNexus/ADMIN/view/report/baocao/baoCaoDoanhThuTheoNgay.php">Ngày</a></li>
        <li class="list-group-item"><a
            href="/Final_BookStore_CodeNexus/ADMIN/view/report/baocao/baoCaoDoanhThuTheoThang.php">Tháng</a></li>
        <li class="list-group-item"><a
            href="/Final_BookStore_CodeNexus/ADMIN/view/report/baocao/baoCaoDoanhThuTheoNam.php">Năm</a></li>
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



    // Lấy ID của danh sách cần hiển thị
    let targetId = null;
    let arrow = link.querySelector('.arrow');

    switch (link.getAttribute('id')) {
      case 'statsLinkPublications':
        targetId = 'dateListPublications';
        break;
      case 'statsLinkRevenue':
        targetId = 'dateListRevenue';
        break;
      case 'order':
        targetId = 'orderForm';
        break;
      case 'request':
        targetId = 'requestForm';
        break;
      default:
        targetId = null; // Nếu không khớp với bất kỳ trường hợp nào
        break;
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


    // Đặt mũi tên cho danh sách hiện tại
    document.querySelectorAll('.arrow').forEach(arw => {
      if (arw !== arrow) {
        arw.innerHTML = '&#9654;'; // Mũi tên phải
      }
    });

    // Chuyển đổi hiển thị danh sách hiện tại
    // Toggle danh sách con hiện tại và đổi mũi tên
    if (targetList.style.display === 'none' || targetList.style.display === '') {
      targetList.style.display = 'block';
      arrow.innerHTML = '&#9660;'; // Mũi tên xuống
    } else {
      targetList.style.display = 'none';
      arrow.innerHTML = '&#9654;'; // Mũi tên phải
    }
  });
});
</script>