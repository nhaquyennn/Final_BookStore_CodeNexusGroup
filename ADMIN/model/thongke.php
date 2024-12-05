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

  public function thongKeSanPhamTheoNgay($ngayBatDau, $ngayKetThuc)
  {
    $query = "
    SELECT 
        DATE(NgayTao) AS Ngay,
        SUM(soLuong) AS TongSoLuong,
        (SELECT TenAnPham 
         FROM chitietphieumuon 
         JOIN anpham ON chitietphieumuon.maAnPham = anpham.maAnPham 
         WHERE chitietphieumuon.maPhieuMuon IN (
             SELECT MaPhieuMuon
             FROM phieumuon 
             WHERE DATE(NgayTao) = DATE(phieumuon.NgayTao)
         )
         ORDER BY soLuong DESC
         LIMIT 1
        ) AS TenSanPhamBanChay
    FROM phieumuon 
    JOIN chitietphieumuon ON phieumuon.MaPhieuMuon = chitietphieumuon.maPhieuMuon
    WHERE NgayTao BETWEEN ? AND ?
    GROUP BY DATE(NgayTao);
";



    $stmt = $this->conn->prepare($query);
    if (!$stmt) {
      error_log("Prepare failed: " . $this->conn->error);
      return [];
    }

    $stmt->bind_param("ss", $ngayBatDau, $ngayKetThuc);
    $stmt->execute();

    $result = $stmt->get_result();
    if (!$result) {
      error_log("Query failed: " . $this->conn->error);
      return [];
    }

    $data = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    // Ghi log dữ liệu nếu cần, nhưng vẫn trả về kết quả
    error_log("Query data: " . print_r($data, true));
    return $data;
  }

  public function thongKeSanPhamTheoThang($thangBatDau, $thangKetThuc, $nam)
  {
    $query = "
          SELECT 
    MONTH(phieumuon.NgayTao) AS Thang, 
    SUM(chitietphieumuon.soLuong) AS TongSoLuong, 
    anpham.TenAnPham AS TenSanPhamBanChay
FROM 
    phieumuon
JOIN 
    chitietphieumuon ON phieumuon.MaPhieuMuon = chitietphieumuon.maPhieuMuon
JOIN 
    anpham ON chitietphieumuon.maAnPham = anpham.maAnPham
WHERE 
    MONTH(phieumuon.NgayTao) BETWEEN ? AND ? 
    AND YEAR(phieumuon.NgayTao) = ?
GROUP BY 
    MONTH(phieumuon.NgayTao), anpham.TenAnPham
ORDER BY 
    TongSoLuong DESC
;
      ";

    $stmt = $this->conn->prepare($query);
    if (!$stmt) {
      error_log("Prepare failed: " . $this->conn->error);
      return [];
    }

    $stmt->bind_param("iii", $thangBatDau, $thangKetThuc, $nam);
    if (!$stmt->execute()) {
      error_log("Execution failed: " . $stmt->error);
      return [];
    }

    $result = $stmt->get_result();
    if (!$result) {
      error_log("Query failed: " . $this->conn->error);
      return [];
    }

    $data = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $data;
  }




  // Thống kê sản phẩm theo năm
  public function thongKeSanPhamTheoNam($namBatDau, $namKetThuc)
  {
    $query = "SELECT YEAR(NgayTao) as Nam, 
                     SUM(chitietphieumuon.soLuong) as TongSoLuong,
                     MAX(anpham.TenAnPham) as TenSanPhamBanChay
              FROM phieumuon
              JOIN chitietphieumuon ON phieumuon.MaPhieuMuon = chitietphieumuon.maPhieuMuon
              JOIN anpham ON chitietphieumuon.maAnPham = anpham.maAnPham
              WHERE YEAR(NgayTao) BETWEEN ? AND ?
              GROUP BY YEAR(NgayTao)";

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
