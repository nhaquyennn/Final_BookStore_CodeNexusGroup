<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "layout/header.php"; ?>
    <?php require_once "db_connect.php"; ?>
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
                        <h3 class="text-center text-white">QUẢN LÝ PHIẾU MƯỢN</h3>
                        <a href="taoPM.php"><button class="btn btn-sm btn-success">Tạo phiếu mượn</button></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-9 col-lg-12">
                        <div class="card">
                            <div class="card-header">DANH SÁCH PHIẾU MƯỢN</div>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush table-borderless">
                                    <thead>
                                        <tr>
                                            <th style="font-size: 15px;">Mã Phiếu</th>
                                            <th style="font-size: 15px;">Tên Khách Hàng</th>
                                            <th style="font-size: 15px;">Ngày Tạo</th>
                                            <th style="font-size: 15px;">Tổng Tiền</th>
                                            <th style="font-size: 15px;">Trạng Thái</th>
                                            <th style="font-size: 15px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Truy vấn lấy danh sách phiếu mượn
                                        $query = "SELECT 
                                                      phieumuon.MaPhieuMuon, 
                                                      khachhang.tenKH, 
                                                      phieumuon.NgayTao, 
                                                      phieumuon.TongTien, 
                                                      phieumuon.tinhTrang 
                                                  FROM phieumuon
                                                  JOIN khachhang ON phieumuon.maKH = khachhang.maKH";
                                        $result = $conn->query($query);

                                        // Kiểm tra và hiển thị dữ liệu
                                        if ($result && $result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>
                                                    <td>{$row['MaPhieuMuon']}</td>
                                                    <td>{$row['tenKH']}</td>
                                                    <td>{$row['NgayTao']}</td>
                                                    <td>" . number_format($row['TongTien'], 0, ',', '.') . " ₫</td>
                                                    <td>{$row['tinhTrang']}</td>
                                                    <td>                                                    
                                                        <a href='chitietphieumuon.php?id={$row['MaPhieuMuon']} class='btn btn-sm text-white'><i class='fa fa-eye-slash' aria-hidden='true'></i></a>
                                                        <a href='suaphieumuon.php?id={$row['MaPhieuMuon']}' class='btn btn-link btn-sm text-white'><i class='fa fa-pencil' aria-hidden='true'></i></a>
                                                    </td>
                                                </tr>";
                                            }
                                        } else {
                                            echo "<tr>
                                                <td colspan='6' class='text-center'>Không có dữ liệu</td>
                                            </tr>";
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