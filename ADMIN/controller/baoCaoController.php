<?php
require_once __DIR__ . '/../model/baocao.php'; // Import model với đường dẫn tuyệt đối

class BaoCaoController
{
  #chưa sửa database
  private $model;
  private $error = null; // Biến lưu lỗi

  public function __construct()
  {
    $this->model = new BaoCaoModel();
  }

  // Lấy lỗi hiện tại
  public function getError()
  {
    return $this->error;
  }

  public function baoCaoDoanhThuTheoNgay()
  {
    $data = []; // Biến lưu dữ liệu kết quả

    // Kiểm tra nếu người dùng gửi form
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Lấy dữ liệu từ request
      $ngayBatDau = $_POST['ngayBatDau'] ?? null;
      $ngayKetThuc = $_POST['ngayKetThuc'] ?? null;

      // Kiểm tra input
      if (!$ngayBatDau || !$ngayKetThuc) {
        $this->error = "Vui lòng nhập đầy đủ ngày bắt đầu và ngày kết thúc.";
      } else {
        try {
          // Đảm bảo định dạng ngày hợp lệ
          $startDate = new DateTime($ngayBatDau);
          $endDate = new DateTime($ngayKetThuc);

          if ($startDate > $endDate) {
            $this->error = "Ngày bắt đầu phải nhỏ hơn hoặc bằng ngày kết thúc.";
          } else {
            // Lấy dữ liệu từ Model
            $data = $this->model->baoCaoDoanhThuTheoNgay($ngayBatDau, $ngayKetThuc);

            if (empty($data)) {
              $this->error = "Không có dữ liệu doanh thu trong khoảng thời gian này.";
            }
          }
        } catch (Exception $e) {
          $this->error = "Định dạng ngày không hợp lệ: " . $e->getMessage();
        }
      }
    }

    return is_array($data) ? $data : [];
  }


  public function baoCaoDoanhThuTheoThang()
  {
    $data = []; // Biến lưu dữ liệu kết quả

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Lấy dữ liệu từ request
      $thangBatDau = isset($_POST['thangBatDau']) ? (int)$_POST['thangBatDau'] : null;
      $thangKetThuc = isset($_POST['thangKetThuc']) ? (int)$_POST['thangKetThuc'] : null;
      $nam = isset($_POST['nam']) ? (int)$_POST['nam'] : null;

      if (!$thangBatDau || !$thangKetThuc || !$nam) {
        $this->error = "Vui lòng nhập đầy đủ thông tin tháng bắt đầu, tháng kết thúc và năm.";
      } elseif ($thangBatDau > $thangKetThuc) {
        $this->error = "Tháng bắt đầu phải nhỏ hơn hoặc bằng tháng kết thúc.";
      } else {
        // Lấy dữ liệu từ model
        $data = $this->model->baoCaoDoanhThuTheoThang($thangBatDau, $thangKetThuc, $nam);
        if (empty($data)) {
          $this->error = "Không có dữ liệu thống kê cho khoảng thời gian này.";
        }
      }
    }

    return is_array($data) ? $data : [];
  }

  // Thống kê sản phẩm theo năm
  public function baoCaoDoanhThuTheoNam()
  {
    $data = []; // Biến lưu dữ liệu kết quả

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Lấy dữ liệu từ request
      $namBatDau = isset($_POST['namBatDau']) ? (int)$_POST['namBatDau'] : null;
      $namKetThuc = isset($_POST['namKetThuc']) ? (int)$_POST['namKetThuc'] : null;

      if (!$namBatDau || !$namKetThuc) {
        $this->error = "Vui lòng nhập đầy đủ thông tin năm bắt đầu và năm kết thúc.";
      } elseif ($namBatDau > $namKetThuc) {
        $this->error = "Năm bắt đầu phải nhỏ hơn hoặc bằng năm kết thúc.";
      } else {
        // Lấy dữ liệu từ model
        $data = $this->model->baoCaoDoanhThuTheoNam($namBatDau, $namKetThuc);
        if (empty($data)) {
          $this->error = "Không có dữ liệu thống kê cho khoảng thời gian này.";
        }
      }
    }

    return $data;
  }
}
