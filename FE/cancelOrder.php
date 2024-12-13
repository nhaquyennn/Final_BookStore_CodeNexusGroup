<?php
// FE/cancelOrder.php

session_start();

include_once 'database/db_connect.php'; // Bao gồm kết nối trước

// Kiểm tra xem khách hàng đã đăng nhập chưa
if (!isset($_SESSION['maKH'])) {
    header('Location: ../user/login.php?error=Vui lòng đăng nhập để hủy đơn hàng.');
    exit();
}

// Kiểm tra xem tham số MaPhieuMuon có tồn tại trong URL không
if (!isset($_GET['MaPhieuMuon'])) {
    echo "<div class='container mt-5'><div class='alert alert-danger'>Thiếu mã đơn hàng.</div></div>";
    exit();
}

$maPhieuMuon = intval($_GET['MaPhieuMuon']);
$maKH = intval($_SESSION['maKH']);

// Kiểm tra xem đơn hàng có tồn tại và thuộc về khách hàng không
$sql_check = "
    SELECT 
        MaPhieuMuon, tinhTrang
    FROM 
        phieumuon
    WHERE 
        MaPhieuMuon = ? AND maKH = ?
";
$stmt_check = $conn->prepare($sql_check);
if (!$stmt_check) {
    die("<div class='container mt-5'><div class='alert alert-danger'>Lỗi chuẩn bị câu truy vấn đơn hàng: " . htmlspecialchars($conn->error) . "</div></div>");
}
$stmt_check->bind_param("ii", $maPhieuMuon, $maKH);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows === 0) {
    echo "<div class='container mt-5'><div class='alert alert-danger'>Không tìm thấy đơn hàng hoặc đơn hàng không thuộc về bạn.</div></div>";
    exit();
}

$order = $result_check->fetch_assoc();

if ($order['tinhTrang'] !== 'Đang xử lý') {
    echo "<div class='container mt-5'><div class='alert alert-warning'>Chỉ có thể hủy đơn hàng đang ở trạng thái 'Đang xử lý'.</div></div>";
    exit();
}

$stmt_check->close();
// Đừng đóng kết nối ở đây
// $conn->close(); // Loại bỏ hoặc di chuyển dòng này đến cuối tệp sau khi đã hoàn thành các thao tác cần thiết

// Lấy dữ liệu đã nhập trước đó nếu có
$lyDoHuy = isset($_GET['lyDoHuy']) ? htmlspecialchars($_GET['lyDoHuy']) : '';
$soTaiKhoan = isset($_GET['soTaiKhoan']) ? htmlspecialchars($_GET['soTaiKhoan']) : '';
?>
<?php
// Bao gồm Header
include_once 'layout/header.php';
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="cancel-order-form p-4">
                <h2 class="text-center mb-4">Hủy Đơn Hàng #<?php echo htmlspecialchars($maPhieuMuon); ?></h2>

                <?php
                // Hiển thị thông báo lỗi nếu có
                if (isset($_GET['error'])) {
                    echo '<div class="alert alert-danger">' . htmlspecialchars($_GET['error']) . '</div>';
                }
                ?>

                <form action="processCancelOrder.php" method="POST">
                    <input type="hidden" name="MaPhieuMuon" value="<?php echo htmlspecialchars($maPhieuMuon); ?>">

                    <div class="mb-3">
                        <label for="lyDoHuy" class="form-label">Lý Do Hủy Đơn Hàng</label>
                        <textarea class="form-control" id="lyDoHuy" name="lyDoHuy" rows="4" required
                            oninvalid="this.setCustomValidity('Vui lòng nhập lý do hủy đơn hàng.')"
                            oninput="this.setCustomValidity('')"><?php echo $lyDoHuy; ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="soTaiKhoan" class="form-label">Số Tài Khoản Để Hoàn Tiền</label>
                        <input type="text" class="form-control" id="soTaiKhoan" name="soTaiKhoan" value="<?php echo $soTaiKhoan; ?>" required
                            pattern="\d{10,20}"
                            oninvalid="this.setCustomValidity('Số tài khoản không đúng định dạng. Vui lòng nhập lại')"
                            oninput="this.setCustomValidity('')">
                        <div class="form-text">Vui lòng nhập số tài khoản đúng định dạng (10-20 chữ số).</div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-danger">Hủy Đơn Hàng</button>
                        <a href="orderView.php" class="btn btn-secondary">Quay Lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
// Bao gồm Footer
include_once 'layout/footer.php';
?>