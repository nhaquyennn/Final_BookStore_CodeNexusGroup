<?php
require_once __DIR__ . '/../database/db_connect.php'; // Require file kết nối database

class PhieuMuonModel
{
  private $conn;

  public function __construct($db)
  {
    $this->conn = $db; // Gán kết nối database cho thuộc tính $conn
  }

  // Hàm lấy thông tin phiếu mượn theo mã phiếu mượn
  public function getPM($idPM)
  {
    $sql = "SELECT * FROM phieumuon WHERE MaPhieuMuon = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("s", $idPM); // Bind tham số mã phiếu mượn
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    if ($result->num_rows > 0) {
      $data = $result->fetch_all(MYSQLI_ASSOC); // Lấy tất cả dữ liệu
    }
    $stmt->close();
    return $data; // Trả về mảng dữ liệu
  }
}
