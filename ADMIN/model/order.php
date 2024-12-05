<?php
require_once __DIR__ . '/../database/db_connect.php'; // Require file kết nối database

class OrderModel
{
  private $conn;

  public function __construct($db)
  {
    $this->conn = $db; // Gán kết nối database cho thuộc tính $conn
  }

  // Hàm tìm kiếm phiếu mượn theo mã chi tiết phiếu mượn
  public function selectTheoMaChiTietPhieuMuon($idCTPM)
  {
    $sql = "SELECT * FROM chitietphieumuon WHERE maPhieuMuon LIKE ?";
    $stmt = $this->conn->prepare($sql);
    $searchTerm = "%$idCTPM%";
    $stmt->bind_param("s", $searchTerm);
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
