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

  public function thongKeSanPhamTheoNgay($ngayBatDau, $ngayKetThuc)
  {
    // Câu truy vấn SQL
    $query = "
            SELECT DATE(NgayTao) as Ngay, 
                   SUM(soLuong) as TongSoLuong, 
                   (SELECT TenAnPham 
                    FROM chitietphieumuon 
                    JOIN anpham ON chitietphieumuon.maAnPham = anpham.maAnPham 
                    WHERE chitietphieumuon.maPhieuMuon = phieumuon.MaPhieuMuon 
                    ORDER BY soLuong DESC 
                    LIMIT 1) as TenSanPhamBanChay
            FROM phieumuon 
            JOIN chitietphieumuon ON phieumuon.MaPhieuMuon = chitietphieumuon.maPhieuMuon
            WHERE NgayTao BETWEEN ? AND ?
            GROUP BY DATE(NgayTao)
        ";

    // Chuẩn bị câu truy vấn
    $stmt = $this->conn->prepare($query);

    // Gán giá trị cho các tham số
    $stmt->bind_param("ss", $ngayBatDau, $ngayKetThuc);

    // Thực thi truy vấn
    $stmt->execute();

    // Lấy kết quả
    $result = $stmt->get_result();

    // Chuyển kết quả thành mảng
    $data = [];
    while ($row = $result->fetch_assoc()) {
      $data[] = $row;
    }

    // Đóng statement
    $stmt->close();

    return $data; // Trả về mảng kết quả
  }

  public function thongKeSanPhamTheoThang($thangBatDau, $thangKetThuc, $nam)
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
  public function thongKeSanPhamTheoNam($namBatDau, $namKetThuc)
  {
    $query = "SELECT YEAR(NgayTao) as Nam, SUM(soLuong) as TongSoLuong
               FROM phieumuon
               JOIN chitietphieumuon ON phieumuon.MaPhieuMuon = chitietphieumuon.maPhieuMuon
               WHERE YEAR(NgayTao) BETWEEN ? AND ?
               GROUP BY YEAR(NgayTao)";

    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ii", $namBatDau, $namKetThuc);
    $stmt->execute();

    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }
}
