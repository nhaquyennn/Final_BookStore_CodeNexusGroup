<?php
//FE
include('layout/header.php');
include('layout/left_sidebar.php');
include('layout/right_sidebar.php');
include('layout/topbar.php');
include('layout/script.php');
//page
if (isset($_GET['page']) && $_GET['page'] == 'quanlyDM') {
    include('page/quanlyDM/danhMucAP.php');
}else if (isset($_GET['page']) && $_GET['page'] == 'themDM') {
    include('page/quanlyDM/themDM.php');
}else if (isset($_GET['page']) && $_GET['page'] == 'suaDM') {
    include('page/quanlyDM/suaDM.php');
}else if (isset($_GET['page']) && $_GET['page'] == 'xoaDM') {
    include('page/quanlyDM/YeuCauXoaDM.php');
}else if (isset($_GET['page']) && $_GET['page'] == 'quanlydauAP') {
    include('page/quanlydauAP/danhSachDauAP.php');
}else if (isset($_GET['page']) && $_GET['page'] == 'themDAP') {
    include('page/quanlydauAP/themDAP.php');
}else if (isset($_GET['page']) && $_GET['page'] == 'suaDAP') {
    include('page/quanlydauAP/suaDAP.php');
} else if (isset($_GET['page']) && $_GET['page'] == 'quanlyAP') {
    include('page/quanlyAP/DSAP.php');
}else if (isset($_GET['page']) && $_GET['page'] == 'themAP') {
    include('page/quanlyAP/themAP.php');
}else if (isset($_GET['page']) && $_GET['page'] == 'suaAP') {
    include('page/quanlyAP/suaAP.php');
}else if (isset($_GET['page']) && $_GET['page'] == 'quanlyHDnhap') {
    include('page/hoadonNhap/QLHDnhap.php');
}else if (isset($_GET['page']) && $_GET['page'] == 'themHDnhapkho') {
    include('page/hoadonNhap/themHDnhap.php');
}

// include('page/hoadonNhap/ctHDnhap.php');
//footer
include('layout/footer.php');
?>