
<?php
session_start();
// Kiểm tra nếu session 'user' không tồn tại 
if (!isset($_SESSION['user'])) {
  // Nếu chưa đăng nhập, chuyển hướng về trang login
header("Location: user/login.php?error=Vui lòng đăng nhập.");
exit();
}
?><!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once "layout/header.php";
    require_once "db_connect.php";
    ?>
</head>

<body class="bg-theme bg-theme2">
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Start wrapper-->
            <div id="wrapper">

                <!--Start sidebar-wrapper-->
                <?php require_once "layout/left_sidebar.php"; ?>
                <!--End sidebar-wrapper-->

                <!--Start topbar header-->
                <header class="topbar-nav">
                    <?php require_once "layout/topbar.php"; ?>
                </header>
                <!--End topbar header-->

                <!--Start main content-->
                <div class="PM row">
                    <div class="btn-create-PM col-12">
                        <h3 class="text-center text-white">CHI TIẾT PHIẾU MƯỢN</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-9 col-lg-12">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Mã CTPM</th>
                                            <th>Mã phiếu mượn</th>
                                            <th>Mã ấn phẩm</th>
                                            <th>Tên ấn phẩm</th>
                                            <th>Số lượng</th>
                                            <th>Đơn giá</th>
                                            <th>Giảm giá</th>
                                            <th>Phí thuê</th>
                                            <th>Mã khuyến mãi</th>
                                            <th>Tình trạng ấn phẩm</th>
                                            <th>Hình ảnh</th>
                                            <th>Ngày mượn</th>
                                            <th>Ngày trả</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        try {
                                            // Lấy MaPhieuMuon từ URL
                                            $MaPhieuMuon = isset($_GET['id']) ? $_GET['id'] : 0;

                                            // Truy vấn dữ liệu từ bảng chitietpm
                                            $query = "SELECT *
                                                        FROM chitietpm ctp
                                                        JOIN anpham ap ON ctp.maAnPham = ap.maAnPham
                                                        WHERE ctp.MaPhieuMuon = ?";
                                            $stmt = $conn->prepare($query);
                                            $stmt->bind_param("i", $MaPhieuMuon);
                                            $stmt->execute();
                                            $result = $stmt->get_result();

                                            if ($result && $result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>
                                                        <td>{$row['maCTPM']}</td>
                                                        <td>{$row['MaPhieuMuon']}</td>
                                                        <td>{$row['maAnPham']}</td>
                                                        <td>{$row['TenAnPham']}</td>
                                                        <td>{$row['SoLuong']}</td>
                                                        <td>" . number_format($row['DonGia'], 0, ',', '.') . " ₫</td>
                                                        <td>" . number_format($row['GiamGia'], 0, ',', '.') . " ₫</td>
                                                        <td>" . number_format($row['PhiThue'], 0, ',', '.') . " ₫</td>
                                                        <td>{$row['MaKhuyenMai']}</td>
                                                        <td>{$row['tinhTrangMuon']}</td>
                                                        <td><img src='img/products/{$row['hinhAnh']}' width='50' height=''></td>
                                                        <td>{$row['ngayMuon']}</td>
                                                        <td>{$row['ngayTra']}</td>
                                                    </tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='6'>Không có chi tiết phiếu mượn nào</td></tr>";
                                            }
                                        } catch (Exception $e) {
                                            echo "<tr><td colspan='6'>Lỗi: " . $e->getMessage() . "</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>