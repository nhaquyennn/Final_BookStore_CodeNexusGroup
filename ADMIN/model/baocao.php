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
    SUM(ct.SoLuong * (ct.DonGia - ct.GiamGia)) AS TongDoanhThu, 
    MAX(a.TenAnPham) AS SanPhamBanChay,  -- Display the product name
    SUM(ct.SoLuong * (ct.DonGia - ct.GiamGia)) AS DoanhThuSanPham  -- Calculate total revenue for the best-selling product
FROM 
    phieumuon AS p
JOIN 
    chitietpm AS ct ON p.MaPhieuMuon = ct.MaPhieuMuon
JOIN 
    anpham AS a ON ct.MaAnPham = a.MaAnPham
WHERE 
    p.NgayTao BETWEEN ? AND ?  -- Filtering by date range
GROUP BY 
    DATE(p.NgayTao)
ORDER BY 
    TongDoanhThu DESC;  -- Order by total revenue


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
    $query = "SELECT MONTH(NgayTao) as Thang, SUM(soLuong) as TongSoLuong 
                FROM phieumuon 
                JOIN chitietphieumuon ON phieumuon.MaPhieuMuon = chitietphieumuon.maPhieuMuon
                WHERE MONTH(NgayTao) BETWEEN ? AND ? AND YEAR(NgayTao) = ?
                GROUP BY MONTH(NgayTao)";

    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("iii", $thangBatDau, $thangKetThuc, $nam);
    $stmt->execute();

    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  // Thống kê sản phẩm theo năm
  public function baoCaoDoanhThuTheoNam($namBatDau, $namKetThuc)
  {
    $query = "
        SELECT 
            YEAR(p.NgayTao) AS Nam,
            SUM(ct.soLuong * ct.giaMoiSanPham) AS TongDoanhThu,
            (
                SELECT a.TenAnPham 
                FROM chitietphieumuon AS ct2 
                JOIN anpham AS a ON ct2.maAnPham = a.maAnPham 
                WHERE ct2.maPhieuMuon = p.MaPhieuMuon 
                ORDER BY ct2.soLuong DESC, ct2.giaMoiSanPham DESC 
                LIMIT 1
            ) AS SanPhamBanChay,
            (
                SELECT SUM(ct2.soLuong * ct2.giaMoiSanPham) 
                FROM chitietphieumuon AS ct2 
                JOIN anpham AS a ON ct2.maAnPham = a.maAnPham 
                WHERE ct2.maPhieuMuon = p.MaPhieuMuon 
                ORDER BY ct2.soLuong DESC, ct2.giaMoiSanPham DESC 
                LIMIT 1
            ) AS DoanhThuSanPhamBanChay
        FROM 
            phieumuon AS p
        JOIN 
            chitietphieumuon AS ct ON p.MaPhieuMuon = ct.maPhieuMuon
        WHERE 
            YEAR(p.NgayTao) BETWEEN ? AND ?
        GROUP BY 
            YEAR(p.NgayTao)
        ORDER BY 
            YEAR(p.NgayTao);
    ";


    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ii", $namBatDau, $namKetThuc);
    $stmt->execute();

    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }
}
