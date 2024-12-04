<?php
session_start();
require_once "db_connect.php";

// Kiểm tra và lấy `maKH` từ URL
$maKH = isset($_GET['id']) ? $_GET['id'] : null;
if (!$maKH) {
    die("Lỗi: Không tìm thấy mã khách hàng.");
}

// Truy vấn tên khách hàng từ database
$query = "SELECT tenKH FROM khachhang WHERE maKH = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $maKH);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    $tenKH = $row['tenKH'];
} else {
    die("Lỗi: Không tìm thấy thông tin khách hàng.");
}

// Xử lý khi form được submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lyDo = isset($_POST['deleteReason']) ? trim($_POST['deleteReason']) : null;
    $maNhanVien = isset($_POST['maNhanVien']) ? trim($_POST['maNhanVien']) : null;

    // Kiểm tra dữ liệu nhập
    if (!$lyDo || !$maNhanVien) {
        die("Lỗi: Vui lòng nhập đầy đủ thông tin.");
    }

    // Thêm vào bảng `yeucau`
    $sql = "INSERT INTO yeucau (maLoaiYC, tenYC, noidung, maKH, maNhanVien, ngayYC, trangThai) 
        VALUES (1, 'Xóa khách hàng', ?, ?, ?, NOW(), 'Chờ duyệt')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $lyDo, $maKH, $maNhanVien);

    if ($stmt->execute()) {
        echo "<script>alert('Yêu cầu xóa khách hàng đã được gửi!');</script>";
        header("Location: quanlyKH.php"); // Chuyển hướng về trang quản lý khách hàng
        exit();
    } else {
        echo "Lỗi khi thêm yêu cầu: " . $conn->error;
    }
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
            <!-- Start wrapper-->
            <div id="wrapper">

                <!--Start sidebar-wrapper-->
                <?php require_once "layout/left_sidebar.php" ?>
                <!--End sidebar-wrapper-->

                <!--Start topbar header-->
                <header class="topbar-nav">
                    <?php require_once "layout/topbar.php" ?>
                </header>
                <!--End topbar header-->

                <!--Start main content-->

                <!-- CODE Ở ĐÂY -->
                <div class="container mt-3">
                    <h3 class="text-center text-white">YÊU CẦU XÓA KHÁCH HÀNG</h3>
                    <form action="" method="POST">
                        <!-- Mã khách hàng -->
                        <div class="mb-3">
                            <label for="customerId" class="text-white">Mã khách hàng</label>
                            <input type="text" class="form-control" id="customerId" name="customerId" value="<?php echo $maKH; ?>" readonly>
                        </div>
                        <!-- Tên khách hàng -->
                        <div class="mb-3">
                            <label for="customerName" class="text-white">Tên khách hàng</label>
                            <input type="text" class="form-control" id="customerName" value="<?php echo $tenKH; ?>" readonly>
                        </div>
                        <!-- Lý do xóa -->
                        <div class="mb-3">
                            <label for="deleteReason" class="text-white">Lý do xóa</label>
                            <textarea class="form-control" id="deleteReason" name="deleteReason" placeholder="Nhập lý do xóa khách hàng" required></textarea>
                        </div>
                        <!-- Mã nhân viên -->
                        <div class="mb-3">
                            <label for="maNhanVien" class="text-white">Mã nhân viên yêu cầu</label>
                            <input type="text" class="form-control" id="maNhanVien" name="maNhanVien" placeholder="Nhập mã nhân viên" required>
                        </div>
                        <!-- Nút hành động -->
                        <div>
                            <button type="submit" class="btn btn-primary">Gửi yêu cầu</button>
                            <a href="javascript:history.back()" class="btn btn-secondary">Quay lại</a>
                        </div>
                    </form>
                </div>
            </div>
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