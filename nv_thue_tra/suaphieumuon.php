<?php
// Kết nối với cơ sở dữ liệu
require_once "db_connect.php";

// Kiểm tra xem có nhận được 'id' từ URL không
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $MaPhieuMuon = $_GET['id'];

    // Truy vấn thông tin phiếu mượn từ cơ sở dữ liệu
    $query = "SELECT 
                phieumuon.MaPhieuMuon, 
                khachhang.tenKH, 
                phieumuon.NgayTao, 
                phieumuon.TongTien, 
                phieumuon.tinhTrang 
              FROM phieumuon
              JOIN khachhang ON phieumuon.maKH = khachhang.maKH
              WHERE phieumuon.MaPhieuMuon = '$MaPhieuMuon'";

    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Phiếu mượn không tồn tại!";
        exit();
    }
} else {
    echo "Mã phiếu mượn không hợp lệ!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "layout/header.php"; ?>
</head>

<body class="bg-theme bg-theme2">
    <div class="clearfix"></div>
    <div class="content-wrapper">
        <div class="container-fluid">
            <div id="wrapper">

                <!-- Start sidebar-wrapper -->
                <?php require_once "layout/left_sidebar.php"; ?>
                <!-- End sidebar-wrapper -->

                <!-- Start topbar header -->
                <header class="topbar-nav">
                    <?php require_once "layout/topbar.php"; ?>
                </header>
                <!-- End topbar header -->

                <div class="container">
                    <h3 class="text-center mt-5">CẬP NHẬT THÔNG TIN PHIẾU MƯỢN</h3>
                    <form action="" method="POST">
                        <!-- Truyền giá trị mã phiếu mượn -->
                        <input type="hidden" name="MaPhieuMuon" value="<?php echo $row['MaPhieuMuon']; ?>">

                        <div class="mb-3">
                            <label for="customerName" class="text-white">Tên khách hàng</label>
                            <input type="text" class="form-control" id="customerName" name="customerName" value="<?php echo $row['tenKH']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="text-white">Ngày tạo</label>
                            <input type="datetime-local" class="form-control" id="date" name="date" value="<?php echo date('Y-m-d', strtotime($row['NgayTao'])); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="countMoney" class="form-label">Tổng tiền</label>
                            <input type="number" class="form-control" id="countMoney" name="countMoney" value="<?php echo $row['TongTien']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="tinhTrang" class="form-label">Tình trạng</label>
                            <select class="form-control" id="tinhTrang" name="tinhTrang" required>
                                <option value="">Chọn tình trạng</option>
                                <option value="Đang mượn" <?php echo ($row['tinhTrang'] == 'Đang mượn') ? 'selected' : ''; ?>>Đang mượn</option>
                                <option value="Đã trả" <?php echo ($row['tinhTrang'] == 'Đã trả') ? 'selected' : ''; ?>>Đã trả</option>
                                <option value="Trả muộn" <?php echo ($row['tinhTrang'] == 'Trả muộn') ? 'selected' : ''; ?>>Trả muộn</option>
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                            <a href="javascript:history.back()" class="btn btn-secondary">Quay lại</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
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