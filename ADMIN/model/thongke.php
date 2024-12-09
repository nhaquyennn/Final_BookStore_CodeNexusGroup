<?php
require_once __DIR__ . '/../database/db_connect.php'; // Đường dẫn tuyệt đối từ thư mục hiện tại

class ThongKeModel
{
  private $conn;

  public function __construct()
  {
    global $conn; // Sử dụng biến kết nối toàn cục
    $this->conn = $conn;
  }

  // Hàm thống kê sản phẩm bán chạy theo ngày trong một khoảng thời gian
  public function thongKeSanPhamTheoNgay($ngayBatDau, $ngayKetThuc)
  {
    $query = "
    SELECT 
        DATE(pm.NgayTao) AS Ngay, -- Ngày tạo của phiếu mượn
        SUM(ctpm.SoLuong) AS TongSoLuong, -- Tổng số lượng sản phẩm trong ngày
        ap.TenAnPham AS TenSanPhamBanChay, -- Tên sản phẩm bán chạy nhất
        (SUM(ctpm.SoLuong) * ap.Gia) AS DoanhThuSanPhamBanChay -- Doanh thu của sản phẩm bán chạy nhất
    FROM 
        phieumuon pm
    JOIN 
        chitietpm ctpm ON pm.MaPhieuMuon = ctpm.MaPhieuMuon
    JOIN 
        anpham ap ON ctpm.maAnPham = ap.maAnPham
    WHERE 
        pm.NgayTao BETWEEN ? AND ? -- Lọc dữ liệu theo khoảng ngày
    GROUP BY 
        DATE(pm.NgayTao), ap.TenAnPham, ap.Gia -- Nhóm theo ngày, sản phẩm và giá
    ORDER BY 
        Ngay, TongSoLuong DESC;
";


    // Chuẩn bị câu lệnh SQL
    $stmt = $this->conn->prepare($query);

    // Gán giá trị cho các tham số
    $stmt->bind_param("ss", $ngayBatDau, $ngayKetThuc);

    // Thực thi câu lệnh
    $stmt->execute();

    // Lấy kết quả
    $result = $stmt->get_result();

    // Kiểm tra nếu có dữ liệu trả về
    if ($result->num_rows > 0) {
      // Lưu kết quả vào mảng
      $data = $result->fetch_all(MYSQLI_ASSOC);
    } else {
      // Nếu không có dữ liệu, trả về mảng rỗng
      $data = [];
    }

    // Đóng kết nối
    $stmt->close();

    // Trả về kết quả
    return $data;
  }

  public function thongKeSanPhamTheoThang($thangBatDau, $thangKetThuc, $nam)
  {
    // Câu truy vấn đã sửa
    $query = "
      SELECT 
          MONTH(pm.NgayTao) AS Thang,
          SUM(ctpm.SoLuong) AS TongSoLuong,
          ap.TenAnPham AS TenSanPhamBanChay
      FROM 
          phieumuon pm
      JOIN 
          chitietpm ctpm ON pm.MaPhieuMuon = ctpm.MaPhieuMuon
      JOIN 
          anpham ap ON ctpm.maAnPham = ap.maAnPham
      WHERE 
          YEAR(pm.NgayTao) = ? 
          AND MONTH(pm.NgayTao) BETWEEN ? AND ?
      GROUP BY 
          MONTH(pm.NgayTao), ap.TenAnPham
      ORDER BY 
          Thang, TongSoLuong DESC;
      ";

    // Chuẩn bị câu truy vấn
    $stmt = $this->conn->prepare($query);
    if (!$stmt) {
      error_log("Prepare failed: " . $this->conn->error);
      return [];
    }

    // Truyền tham số (năm, tháng bắt đầu, tháng kết thúc)
    $stmt->bind_param("iii", $nam, $thangBatDau, $thangKetThuc);
    if (!$stmt->execute()) {
      error_log("Execution failed: " . $stmt->error);
      return [];
    }

    // Lấy kết quả
    $result = $stmt->get_result();
    if (!$result) {
      error_log("Query failed: " . $this->conn->error);
      return [];
    }

    // Lấy dữ liệu từ kết quả
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $data;
  }

  // Thống kê sản phẩm theo năm
  public function thongKeSanPhamTheoNam($namBatDau, $namKetThuc)
  {
    $query = "
    SELECT 
        YEAR(pm.NgayTao) AS Nam,
        SUM(ctpm.SoLuong) AS TongSoLuong,
        MAX(ap.TenAnPham) AS TenSanPhamBanChay -- MAX hoặc GROUP_CONCAT sẽ chọn 1 giá trị cho tên sản phẩm
    FROM 
        phieumuon pm
    JOIN 
        chitietpm ctpm ON pm.MaPhieuMuon = ctpm.MaPhieuMuon
    JOIN 
        anpham ap ON ctpm.maAnPham = ap.maAnPham
    WHERE 
        YEAR(pm.NgayTao) BETWEEN ? AND ?
    GROUP BY 
        YEAR(pm.NgayTao)
    ORDER BY 
        TongSoLuong DESC;
";



    // Chuẩn bị câu truy vấn
    $stmt = $this->conn->prepare($query);
    if (!$stmt) {
      throw new Exception("Prepare failed: " . $this->conn->error);
    }

    $stmt->bind_param("ii", $namBatDau, $namKetThuc);
    $stmt->execute();

    $result = $stmt->get_result();
    if (!$result) {
      throw new Exception("Query failed: " . $this->conn->error);
    }

    return $result->fetch_all(MYSQLI_ASSOC);
  }
}
