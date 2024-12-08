<?php
require_once __DIR__ . '/../database/db_connect.php';
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
function calculateDiscountedPrice($totalAmount, $couponCode, $conn) {
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
    // Truy vấn kết hợp bảng giỏ hàng và bảng anpham qua khóa maAnPham
    $query = "  SELECT giohang.*, anpham.TenAnPham, anpham.Giathue, dauap.hinhAnh, anpham.PhiThue,
                    NOW() AS NgayMuon
            FROM giohang
            INNER JOIN anpham ON giohang.maAnPham = anpham.maAnPham
            INNER JOIN dauap ON anpham.maDauAp = dauap.maDauAp";


    $result = mysqli_query($conn, $query);

    // Kiểm tra nếu có kết quả
    if ($result) {
        $cartItems = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $cartItems[] = $row;  // Thêm từng sản phẩm vào mảng $cartItems
        }
        return $cartItems;
    } else {
        return [];  // Trả về mảng rỗng nếu không có dữ liệu hoặc có lỗi
    }
}
/**
 * Tính phí thuê từng ấn phẩm
 * 
 * @param float $giaGoc Giá trị gốc của ấn phẩm
 * @param string $ngayMuon Ngày mượn (định dạng YYYY-MM-DD)
 * @param string $ngayTra Ngày trả (định dạng YYYY-MM-DD)
 * @return float Phí thuê
 */
function tinhPhiThue($Giathue, $ngayMuon, $ngayTra) {
    // Chuyển đổi ngày mượn và ngày trả thành đối tượng DateTime
    $dateMuon = new DateTime($ngayMuon);
    $dateTra = new DateTime($ngayTra);

    // Tính số ngày mượn (ngày trả - ngày mượn)
    $interval = $dateTra->diff($dateMuon);
    $soNgay = $interval->days; // Số ngày mượn

    // Tính phí thuê: mỗi ngày 5% giá trị gốc
    $phiThue = $Giathue * 0.05 * $soNgay;

    return $phiThue;
}
?>