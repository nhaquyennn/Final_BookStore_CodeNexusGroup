<?php

require_once __DIR__ . '/../database/db_connect.php'; // Kết nối database

class PhieuMuonModel
{
  private $conn;

  public function __construct()
  {
    global $conn; // Sử dụng kết nối từ db_connect.php
    $this->conn = $conn;
  }

  /**
   * Lấy danh sách phiếu mượn.
   * @return array
   */
  public function getDanhSachPhieuMuon()
  {
    try {
      $query = "
                SELECT pm.MaPhieuMuon, 
                       pm.NgayTao, 
                       pm.TongTien, 
                       pm.GiamGia, 
                       pm.tinhTrang, 
                       kh.tenKH, 
                       MIN(ctp.hinhAnh) AS hinhAnh 
                FROM phieumuon pm
                JOIN khachhang kh ON pm.maKH = kh.maKH
                JOIN chitietpm ctp ON pm.MaPhieuMuon = ctp.MaPhieuMuon
                GROUP BY pm.MaPhieuMuon, pm.NgayTao, pm.TongTien, pm.GiamGia, pm.tinhTrang, kh.tenKH
                ORDER BY pm.NgayTao DESC;
            ";

      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    } catch (Exception $e) {
      throw new Exception("Lỗi khi lấy danh sách phiếu mượn: " . $e->getMessage());
    }
  }

  /**
   * Cập nhật trạng thái phiếu mượn.
   * @param int $maPhieuMuon
   * @param string $trangThai
   * @return bool
   */
  public function updateTrangThai($maPhieuMuon, $trangThai)
  {
    try {
      // Kiểm tra kết nối
      if (!$this->conn) {
        throw new Exception("Kết nối database không hợp lệ.");
      }

      // Câu truy vấn
      $query = "UPDATE phieumuon SET tinhTrang = ? WHERE MaPhieuMuon = ?";
      $stmt = $this->conn->prepare($query);

      // Kiểm tra chuẩn bị truy vấn
      if (!$stmt) {
        throw new Exception("Lỗi chuẩn bị truy vấn: " . $this->conn->error);
      }

      // Gán tham số
      $stmt->bind_param("si", $trangThai, $maPhieuMuon);

      // Thực thi truy vấn
      if (!$stmt->execute()) {
        throw new Exception("Lỗi thực thi truy vấn: " . $stmt->error);
      }

      // Kiểm tra kết quả
      if ($stmt->affected_rows === 0) {
        throw new Exception("Không tìm thấy phiếu mượn nào để cập nhật.");
      }

      // Đóng statement
      $stmt->close();

      return true; // Thành công
    } catch (Exception $e) {
      throw new Exception("Lỗi khi cập nhật trạng thái: " . $e->getMessage());
    }
  }
}
