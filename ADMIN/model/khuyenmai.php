<?php
require_once __DIR__ . '/../database/db_connect.php'; // Require file kết nối database

class KhuyenMaiModel
{
  private $conn;

  public function __construct($db)
  {
    $this->conn = $db; // Gán kết nối database cho thuộc tính $conn
  }

  // Hàm lấy tất cả khuyến mãi
  public function getAllKhuyenMai()
  {
    $sql = "SELECT MaKhuyenMai, TenKhuyenMai, PhanTramGiamGia, NgayBatDau, NgayKetThuc FROM khuyenmai";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    if ($result->num_rows > 0) {
      $data = $result->fetch_all(MYSQLI_ASSOC);
    }
    $stmt->close();
    return $data;
  }


  // Hàm tìm kiếm khuyến mãi theo ID
  public function searchKhuyenMaiById($id)
  {
    $sql = "SELECT MaKhuyenMai, TenKhuyenMai, PhanTramGiamGia, NgayBatDau, NgayKetThuc FROM khuyenmai WHERE MaKhuyenMai = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = null;
    if ($result->num_rows > 0) {
      $data = $result->fetch_assoc(); // Lấy dữ liệu của một bản ghi
    }
    $stmt->close();
    return $data;
  }


  // Hàm thêm khuyến mãi
  public function addKhuyenMai($ten, $giamgia, $batdau, $ketthuc)
  {
    $sql = "INSERT INTO khuyenmai (TenKhuyenMai, PhanTramGiamGia, NgayBatDau, NgayKetThuc) 
            VALUES (?, ?, ?, ?)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("sisss", $ten, $giamgia, $batdau, $ketthuc);
    $success = $stmt->execute(); // Thực thi câu lệnh
    $stmt->close();
    return $success; // Trả về true nếu thành công, false nếu thất bại
  }

  // Hàm cập nhật khuyến mãi
  public function updateKhuyenMai($id, $ten, $giamgia, $batdau, $ketthuc)
  {
    $sql = "UPDATE khuyenmai 
            SET TenKhuyenMai = ?, PhanTramGiamGia = ?, NgayBatDau = ?, NgayKetThuc = ?
            WHERE MaKhuyenMai = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("sissi", $ten, $giamgia, $batdau, $ketthuc, $id);
    $success = $stmt->execute(); // Thực thi câu lệnh
    $stmt->close();
    return $success; // Trả về true nếu thành công, false nếu thất bại
  }

  // Hàm xóa khuyến mãi
  public function deleteKhuyenMai($id)
  {
    $sql = "DELETE FROM khuyenmai WHERE MaKhuyenMai = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $success = $stmt->execute(); // Thực thi câu lệnh
    $stmt->close();
    return $success; // Trả về true nếu thành công, false nếu thất bại
  }
}
