<?php
require_once __DIR__ . '/../model/khuyenmai.php'; // Gọi model khuyenmai

class KhuyenMaiController
{
  private $model;

  public function __construct($conn)
  {
    $this->model = new KhuyenMaiModel($conn); // Khởi tạo model với kết nối database
  }

  // Lấy tất cả khuyến mãi
  public function index()
  {
    try {
      return $this->model->getAllKhuyenMai();
    } catch (Exception $e) {
      return ['error' => $e->getMessage()];
    }
  }

  // Tìm khuyến mãi theo ID
  public function search($id)
  {
    if (!empty($id)) {
      try {
        return $this->model->searchKhuyenMaiById($id);
      } catch (Exception $e) {
        return ['error' => $e->getMessage()];
      }
    }
    return null; // Không có dữ liệu
  }

  // Thêm mới khuyến mãi
  public function add($data)
  {
    if (
      isset($data['TenKhuyenMai'], $data['PhanTramGiamGia'], $data['NgayBatDau'], $data['NgayKetThuc'], $data['maCTPM']) &&
      !empty($data['TenKhuyenMai'])
    ) {
      try {
        return $this->model->addKhuyenMai(
          $data['TenKhuyenMai'],
          $data['PhanTramGiamGia'],
          $data['NgayBatDau'],
          $data['NgayKetThuc'],
          $data['maCTPM']
        );
      } catch (Exception $e) {
        return ['error' => $e->getMessage()];
      }
    }
    return ['error' => 'Dữ liệu không hợp lệ']; // Dữ liệu không hợp lệ
  }

  // Cập nhật thông tin khuyến mãi
  public function update($data)
  {
    if (
      isset($data['MaKhuyenMai'], $data['TenKhuyenMai'], $data['PhanTramGiamGia'], $data['NgayBatDau'], $data['NgayKetThuc'], $data['maCTPM']) &&
      !empty($data['TenKhuyenMai'])
    ) {
      try {
        return $this->model->updateKhuyenMai(
          $data['MaKhuyenMai'],
          $data['TenKhuyenMai'],
          $data['PhanTramGiamGia'],
          $data['NgayBatDau'],
          $data['NgayKetThuc'],
          $data['maCTPM']
        );
      } catch (Exception $e) {
        return ['error' => $e->getMessage()];
      }
    }
    return ['error' => 'Dữ liệu không hợp lệ']; // Dữ liệu không hợp lệ
  }

  // Xóa khuyến mãi
  public function delete($id)
  {
    if (!empty($id)) {
      try {
        return $this->model->deleteKhuyenMai($id);
      } catch (Exception $e) {
        return ['error' => $e->getMessage()];
      }
    }
    return ['error' => 'ID không hợp lệ']; // ID không hợp lệ
  }
  public function getAllCTPMFromKhuyenMai()
  {
    try {
      return $this->model->getAllCTPMFromKhuyenMai();
    } catch (Exception $e) {
      return []; // Trả về mảng rỗng nếu có lỗi
    }
  }
}
