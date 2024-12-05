<?php
require_once __DIR__ . '/../database/db_connect.php'; // Require file kết nối database

class PhieuMuonModel
{
  private $conn;

  // Constructor để khởi tạo kết nối
  public function __construct()
  {
    global $conn;
    $this->conn = $conn;
  }

  // Hàm lấy thông tin phiếu mượn theo mã phiếu mượn
  public function getPM($idPM)
  {
    $query = "SELECT * FROM phieumuon WHERE MaPhieuMuon = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("s", $idPM);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      return $result->fetch_assoc();
    } else {
      return null;
    }
  }
}
