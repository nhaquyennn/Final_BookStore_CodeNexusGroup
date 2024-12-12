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
    $sql = "SELECT MaKhuyenMai, TenKhuyenMai, PhanTramGiamGia, NgayBatDau, NgayKetThuc, maCTPM FROM khuyenmai";
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
    $sql = "SELECT MaKhuyenMai, TenKhuyenMai, PhanTramGiamGia, NgayBatDau, NgayKetThuc, maCTPM FROM khuyenmai WHERE MaKhuyenMai = ?";
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
  public function addKhuyenMai($ten, $giamgia, $batdau, $ketthuc, $mactpm)
  {
    $sql = "INSERT INTO khuyenmai (TenKhuyenMai, PhanTramGiamGia, NgayBatDau, NgayKetThuc, maCTPM) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("sisss", $ten, $giamgia, $batdau, $ketthuc, $mactpm);
    $success = $stmt->execute(); // Thực thi câu lệnh
    $stmt->close();
    return $success; // Trả về true nếu thành công, false nếu thất bại
  }

  // Hàm cập nhật khuyến mãi
  public function updateKhuyenMai($id, $ten, $giamgia, $batdau, $ketthuc, $mactpm)
  {
    $sql = "UPDATE khuyenmai 
            SET TenKhuyenMai = ?, PhanTramGiamGia = ?, NgayBatDau = ?, NgayKetThuc = ?, maCTPM = ?
            WHERE MaKhuyenMai = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("sisssi", $ten, $giamgia, $batdau, $ketthuc, $mactpm, $id);
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

  public function getAllCTPMFromKhuyenMai()
  {
    $sql = "SELECT DISTINCT maCTPM FROM khuyenmai"; // Lấy các giá trị maCTPM duy nhất
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
}
