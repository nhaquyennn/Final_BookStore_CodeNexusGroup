<?php
require_once __DIR__ . '/../database/db_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Hàm lấy mã người dùng từ session
function getCustomerId()
{
    // Kiểm tra xem người dùng đã đăng nhập hay chưa
    if (isset($_SESSION['maNguoiDung']) && !empty($_SESSION['maNguoiDung'])) {
        return intval($_SESSION['maNguoiDung']);
    }
    return null;  // Trả về null nếu không có mã người dùng
}
function getCustomerIdFromPhieuMuon($conn)
{
    // Kiểm tra xem người dùng đã đăng nhập hay chưa
    if (isset($_SESSION['maNguoiDung']) && !empty($_SESSION['maNguoiDung'])) {
        $maNguoiDung = $_SESSION['maNguoiDung'];  // Lấy maNguoiDung từ session

        // Làm sạch biến maNguoiDung để tránh SQL injection
        $maNguoiDung = mysqli_real_escape_string($conn, $maNguoiDung);

        // Truy vấn để lấy maKH từ bảng phiếu mượn qua bảng khách hàng và người dùng
        $query = "
        SELECT kh.maKH
        FROM phieumuon pm
        JOIN khachhang kh ON pm.maKH = kh.maKH
        JOIN nguoidung nd ON kh.maNguoiDung = nd.maNguoiDung
        WHERE nd.maNguoiDung = '$maNguoiDung'
        LIMIT 1";  // Giới hạn kết quả lấy 1 bản ghi

        // Thực thi truy vấn
        $result = mysqli_query($conn, $query);

        // Kiểm tra nếu có kết quả trả về
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row['maKH'];  // Trả về maKH từ bảng khách hàng
        } else {
            // Nếu không tìm thấy kết quả
            return null;
        }
    }
    return null;  // Trả về null nếu không có maNguoiDung trong session
}

function getCoupons($conn)
{
    // Truy vấn dữ liệu từ bảng khuyenmai
    $sql = "SELECT MaKhuyenMai, TenKhuyenMai, PhanTramGiamGia, NgayKetThuc, NgayBatDau, maCTPM
            FROM khuyenmai";

    // Thực thi truy vấn
    $result = mysqli_query($conn, $sql);

    // Khởi tạo mảng chứa dữ liệu khuyến mãi
    $coupons = [];

    // Kiểm tra nếu có dữ liệu
    if ($result && mysqli_num_rows($result) > 0) {
        // Lấy dữ liệu từ kết quả truy vấn và thêm vào mảng $coupons
        while ($row = mysqli_fetch_assoc($result)) {
            $coupons[] = $row;
        }
    }

    // Trả về mảng dữ liệu khuyến mãi
    return $coupons;
}
// Tính giá sau khi giảm giá
function calculateDiscountedPrice($totalAmount, $couponCode, $conn)
{
    // Mặc định không có giảm giá
    $discountPercent = 0;

    // Lấy thông tin mã giảm giá từ database
    if (!empty($couponCode)) {
        $stmt = $conn->prepare("SELECT PhanTramGiamGia FROM khuyenmai WHERE MaKhuyenMai = ?");
        $stmt->bind_param("s", $couponCode);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $discountPercent = $row['PhanTramGiamGia'];
        }
        $stmt->close();
    }

    // Tính toán giá sau giảm giá
    $discountedPrice = $totalAmount - ($totalAmount * $discountPercent / 100);
    return max($discountedPrice, 0); // Đảm bảo giá trị không âm
}

function getCartDetails($conn)
{
    $userId = getCustomerId(); // Lấy maNguoiDung từ session (hoặc phương thức khác)

    // Kiểm tra nếu maNguoiDung có giá trị hợp lệ
    if ($userId) {
        error_log("User ID: " . $userId);  // In ra log để kiểm tra giá trị của userId

        // Truy vấn kết hợp bảng giỏ hàng và bảng anpham qua khóa maAnPham, lọc theo maNguoiDung
        $query = "SELECT giohang.*, anpham.TenAnPham, anpham.Giathue, anpham.PhiThue, dauap.hinhAnh,
                         NOW() AS NgayMuon
                  FROM giohang
                  INNER JOIN anpham ON giohang.maAnPham = anpham.maAnPham
                  INNER JOIN dauap ON anpham.maDauAp = dauap.maDauAp
                  WHERE giohang.maNguoiDung = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $userId); // Liên kết với maNguoiDung trong câu truy vấn
        $stmt->execute();
        $result = $stmt->get_result();

        // Kiểm tra nếu có kết quả
        if ($result && $result->num_rows > 0) {
            $cartItems = [];
            while ($row = $result->fetch_assoc()) {
                $cartItems[] = $row;  // Thêm từng sản phẩm vào mảng $cartItems
            }
            $stmt->close();
            return $cartItems;
        } else {
            error_log("No items found for User ID: " . $userId);  // Nếu không có sản phẩm, log thông báo
            $stmt->close();
            return [];  // Trả về mảng rỗng nếu không có dữ liệu
        }
    } else {
        error_log("No valid user ID found in session");  // Nếu không có maNguoiDung trong session
        return [];
    }
}


?>