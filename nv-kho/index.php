<?php
session_start();
// Kiểm tra nếu session 'user' không tồn tại 
if (!isset($_SESSION['user'])) {
  // Nếu chưa đăng nhập, chuyển hướng về trang login
  header("Location: user/login.php?error=Vui lòng đăng nhập.");
  exit();
}


//FE
include('layout/header.php');
include('layout/left_sidebar.php');
include('layout/right_sidebar.php');
include('layout/topbar.php');
include('layout/script.php');
//page
//Danhmuc
if (isset($_GET['page']) && $_GET['page'] == 'quanlyDM') {
    include('page/quanlyDM/danhMucAP.php');
}else if (isset($_GET['page']) && $_GET['page'] == 'themDM') {
    include('page/quanlyDM/themDM.php');
}else if (isset($_GET['page']) && $_GET['page'] == 'suaDM') {
    include('page/quanlyDM/suaDM.php');
}else if (isset($_GET['page']) && $_GET['page'] == 'xoaDM') {
    include('page/quanlyDM/xoaDM.php');
//DauAnPham
}else if (isset($_GET['page']) && $_GET['page'] == 'quanlydauAP') {
    include('page/quanlydauAP/danhSachDauAP.php');
}else if (isset($_GET['page']) && $_GET['page'] == 'themDAP') {
    include('page/quanlydauAP/themDAP.php');
}else if (isset($_GET['page']) && $_GET['page'] == 'suaDAP') {
    include('page/quanlydauAP/suaDAP.php');
}else if (isset($_GET['page']) && $_GET['page'] == 'xoaDAP') {
    include('page/quanlydauAP/xoaDAP.php');
//AnPham
} else if (isset($_GET['page']) && $_GET['page'] == 'quanlyAP') {
    include('page/quanlyAP/DSAP.php');
}else if (isset($_GET['page']) && $_GET['page'] == 'themAP') {
    include('page/quanlyAP/themAP.php');
}else if (isset($_GET['page']) && $_GET['page'] == 'suaAP') {
    include('page/quanlyAP/suaAP.php');
}else if (isset($_GET['page']) && $_GET['page'] == 'xoaAP') {
    include('page/quanlyAP/YeuCauXoaAP.php');
//HoaDonNhapKho
}else if (isset($_GET['page']) && $_GET['page'] == 'quanlyHDnhap') {
    include('page/hoadonNhap/QLHDnhap.php');
}else if (isset($_GET['page']) && $_GET['page'] == 'themHDnhapkho') {
    include('page/hoadonNhap/themHDnhap.php');
}else if (isset($_GET['page']) && $_GET['page'] == 'chitietHD') {
    include('page/hoadonNhap/ctHDnhap.php');
}

// include('page/hoadonNhap/ctHDnhap.php');
//footer
include('layout/footer.php');
?>