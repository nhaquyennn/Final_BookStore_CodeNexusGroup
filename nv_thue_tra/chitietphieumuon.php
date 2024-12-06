<!DOCTYPE html>
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
                                            <th>Mã ấn phẩm</th>
                                            <th>Tên ấn phẩm</th>
                                            <th>Số lượng</th>
                                            <th>Đơn giá</th>
                                            <th>Hình ảnh</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        try {
                                            // Lấy MaPhieuMuon từ URL
                                            $MaPhieuMuon = isset($_GET['id']) ? $_GET['id'] : 0;

                                            // Truy vấn dữ liệu từ bảng chitietpm
                                            $query = "SELECT ctp.maCTPM, ctp.maAnPham, ap.TenAnPham, ctp.SoLuong, ctp.DonGia, ctp.hinhAnh
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
                                                        <td>{$row['maAnPham']}</td>
                                                        <td>{$row['TenAnPham']}</td>
                                                        <td>{$row['SoLuong']}</td>
                                                        <td>" . number_format($row['DonGia'], 0, ',', '.') . " đ</td>
                                                        <td><img src='{$row['hinhAnh']}' alt='Hình ảnh' style='width: 100px; height: auto;'></td>
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
                <!--End main content-->

            </div>
            <!-- End wrapper-->

            <!--Start right sidebar-->
            <?php require_once "layout/right_sidebar.php"; ?>
            <!--End right sidebar-->

            <!--Start footer-->
            <?php require_once "layout/script.php"; ?>
            <!--End footer-->
        </div>
    </div>
</body>

</html>