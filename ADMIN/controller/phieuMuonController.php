<?php

require_once __DIR__ . '/../model/phieumuon.php'; // Import Model

class PhieuMuonController
{
  private $model;
  private $error;

  public function __construct()
  {
    $this->model = new PhieuMuonModel(); // Khởi tạo model
    $this->error = null;
  }

  /**
   * Lấy danh sách phiếu mượn từ Model.
   * @return array
   */
  public function getDanhSachPhieuMuon()
  {
    try {
      return $this->model->getDanhSachPhieuMuon(); // Gọi model để lấy danh sách
    } catch (Exception $e) {
      $this->error = "Lỗi khi lấy danh sách phiếu mượn: " . $e->getMessage();
      return [];
    }
  }

  /**
   * Cập nhật trạng thái phiếu mượn.
   * @param int $maPhieuMuon
   * @param string $trangThai
   * @return bool
   */
  public function capNhatTrangThai($maPhieuMuon, $trangThai)
  {
    try {
      if (empty($maPhieuMuon) || empty($trangThai)) {
        throw new Exception("Dữ liệu không hợp lệ.");
      }

      $result = $this->model->updateTrangThai($maPhieuMuon, $trangThai);

      if (!$result) {
        throw new Exception("Không thể cập nhật trạng thái đơn hàng mã: $maPhieuMuon.");
      }

      return true;
    } catch (Exception $e) {
      $this->error = $e->getMessage();
      return false;
    }
  }

  /**
   * Xử lý duyệt phiếu mượn.
   * @param int $maPhieuMuon
   */
  public function duyetDonHang($maPhieuMuon)
  {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }

    if (empty($maPhieuMuon)) {
      $_SESSION['error'] = "Mã phiếu mượn không hợp lệ.";
      header("Location: /Final_BookStore_CodeNexusGroup/ADMIN/view/order/danhSachDonHang.php");
      exit();
    }

    if ($this->capNhatTrangThai($maPhieuMuon, 'Duyệt')) {
      $_SESSION['success'] = "Chuyển thành công!";
    } else {
      $_SESSION['error'] = "Thất bại! " . $this->getError();
    }

    header("Location: /Final_BookStore_CodeNexusGroup/ADMIN/view/order/danhSachDonHang.php");
    exit();
  }

  /**
   * Xử lý từ chối phiếu mượn.
   * @param int $maPhieuMuon
   */
  public function tuChoiDonHang($maPhieuMuon)
  {
    if (empty($maPhieuMuon)) {
      $_SESSION['error'] = "Mã phiếu mượn không hợp lệ.";
      header("Location: /Final_BookStore_CodeNexusGroup/ADMIN/view/order/danhSachDonHang.php");
      exit();
    }

    if ($this->capNhatTrangThai($maPhieuMuon, 'Từ chối')) {
      $_SESSION['success'] = "Đơn hàng đã bị từ chối!";
    } else {
      $_SESSION['error'] = "Thất bại! " . $this->getError();
    }

    header("Location: /Final_BookStore_CodeNexusGroup/ADMIN/view/order/danhSachDonHang.php");
    exit();
  }


  public function search($id)
  {
    try {
      $data = $this->model->searchByID($id);
      if ($data) {
        return $data;
      } else {
        return null; // Không tìm thấy
      }
    } catch (Exception $e) {
      // Trả về null nếu có lỗi xảy ra
      return null;
    }
  }



  /**
   * Lấy lỗi hiện tại.
   * @return string|null
   */
  public function getError()
  {
    return $this->error;
  }
}
