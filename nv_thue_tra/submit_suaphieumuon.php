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
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Lấy dữ liệu từ form
                    $maPhieuMuon = $_POST['MaPhieuMuon']; // Mã phiếu mượn
                    $customerName = $_POST['customerName']; // Tên khách hàng
                    $date = $_POST['date']; // Ngày tạo (định dạng datetime-local)
                    $countMoney = $_POST['countMoney']; // Tổng tiền
                    $tinhTrang = $_POST['tinhTrang']; // Tình trạng phiếu mượn

                    // Kiểm tra dữ liệu
                    if (empty($maPhieuMuon) || empty($customerName) || empty($date) || empty($countMoney) || empty($tinhTrang)) {
                        echo "Vui lòng điền đầy đủ thông tin!";
                        exit();
                    }

                    // Câu lệnh SQL để cập nhật phiếu mượn
                    $query = "UPDATE phieumuon 
                            SET NgayTao = ?, TongTien = ?, tinhTrang = ?
                            WHERE MaPhieuMuon = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("sdsi", $date, $countMoney, $tinhTrang, $maPhieuMuon);

                    // Thực thi câu lệnh SQL
                    if ($stmt->execute()) {
                        echo "<script>
                                alert('Cập nhật thành công!');
                                window.location.href = 'dsphieumuon.php';
                            </script>";
                    } else {
                        echo "Lỗi khi cập nhật: " . $stmt->error;
                    }

                    // Đóng kết nối
                    $stmt->close();
                    $conn->close();
                }
                ?>
                <!-- End wrapper-->

                <!--Start right sidebar-->
                <?php require_once "layout/right_sidebar.php" ?>
                <!--End right sidebar-->

                <!--Start footer-->
                <?php require_once "layout/script.php" ?>
                <!--End footer-->
            </div>
        </div>
</body>

</html>