<?php
require_once __DIR__ . '/../database/db_connect.php'; // Đường dẫn tuyệt đối từ thư mục hiện tại

class BaoCaoModel
{
  private $conn;

  public function __construct()
  {
    global $conn; // Sử dụng biến kết nối toàn cục
    $this->conn = $conn;
  }

  public function baoCaoDoanhThuTheoNgay($ngayBatDau, $ngayKetThuc)
  {
    $query = "
      SELECT 
    DATE(p.NgayTao) AS Ngay,
    SUM(ct.SoLuong * (ct.DonGia - IFNULL(ct.GiamGia, 0))) AS TongDoanhThu, 
    a.TenAnPham AS SanPhamBanChay,  -- Sản phẩm có doanh thu cao nhất trong ngày
    MAX(ct.SoLuong * (ct.DonGia - IFNULL(ct.GiamGia, 0))) AS DoanhThuSanPhamBanChay
FROM 
    phieumuon AS p
JOIN 
    chitietpm AS ct ON p.MaPhieuMuon = ct.MaPhieuMuon
JOIN 
    anpham AS a ON ct.MaAnPham = a.MaAnPham
WHERE 
    p.NgayTao BETWEEN ? AND ?  -- Lọc theo khoảng ngày
GROUP BY 
    DATE(p.NgayTao), a.TenAnPham
ORDER BY 
    Ngay ASC, TongDoanhThu DESC;  -- Sắp xếp theo ngày và tổng doanh thu


    ";

    $stmt = $this->conn->prepare($query);

    if (!$stmt) {
      throw new Exception("Lỗi chuẩn bị truy vấn: " . $this->conn->error);
    }

    $stmt->bind_param("ss", $ngayBatDau, $ngayKetThuc);
    $stmt->execute();

    $result = $stmt->get_result();

    if (!$result) {
      throw new Exception("Lỗi truy vấn SQL: " . $this->conn->error);
    }

    $data = [];
    while ($row = $result->fetch_assoc()) {
      $data[] = $row;
    }

    $stmt->close();

    return $data;
  }

  public function baoCaoDoanhThuTheoThang($thangBatDau, $thangKetThuc, $nam)
  {
    $query = "
    SELECT 
    MONTH(p.NgayTao) AS Thang,
    SUM(ct.SoLuong * (ct.DonGia - ct.GiamGia)) AS TongDoanhThu,
    MAX(a.TenAnPham) AS SanPhamBanChay, -- Sản phẩm bán chạy nhất trong tháng
    MAX(ct.SoLuong * (ct.DonGia - ct.GiamGia)) AS DoanhThuSanPham -- Doanh thu của sản phẩm bán chạy nhất
FROM 
    phieumuon AS p
JOIN 
    chitietpm AS ct ON p.MaPhieuMuon = ct.MaPhieuMuon
JOIN 
    anpham AS a ON ct.MaAnPham = a.MaAnPham
WHERE 
    YEAR(p.NgayTao) = ? -- Lọc theo năm
    AND MONTH(p.NgayTao) BETWEEN ? AND ? -- Lọc khoảng tháng
GROUP BY 
    Thang -- Nhóm theo tháng
ORDER BY 
    Thang ASC;

";




    // Thứ tự bind_param: Năm, Tháng bắt đầu, Tháng kết thúc
    $stmt = $this->conn->prepare($query);
    if (!$stmt) {
      throw new Exception("Prepare failed: " . $this->conn->error);
    }

    $stmt->bind_param("iii", $nam, $thangBatDau, $thangKetThuc);
    $stmt->execute();

    $result = $stmt->get_result();
    if (!$result) {
      throw new Exception("Query failed: " . $this->conn->error);
    }

    return $result->fetch_all(MYSQLI_ASSOC);
  }


  // Thống kê sản phẩm theo năm
  public function baoCaoDoanhThuTheoNam($namBatDau, $namKetThuc)
  {
    $query = "
   SELECT 
    YEAR(p.NgayTao) AS Nam,
    SUM(ct.SoLuong * (ct.DonGia - ct.GiamGia)) AS TongDoanhThu,
    MAX(a.TenAnPham) AS SanPhamBanChay,
    MAX(ct.SoLuong * (ct.DonGia - ct.GiamGia)) AS DoanhThuSanPhamBanChay
FROM 
    phieumuon AS p
JOIN 
    chitietpm AS ct ON p.MaPhieuMuon = ct.MaPhieuMuon
JOIN 
    anpham AS a ON ct.MaAnPham = a.MaAnPham
WHERE 
    YEAR(p.NgayTao) BETWEEN ? AND ?
GROUP BY 
    YEAR(p.NgayTao)
ORDER BY 
    Nam ASC;

";








    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ii", $namBatDau, $namKetThuc);
    $stmt->execute();

    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }
}
