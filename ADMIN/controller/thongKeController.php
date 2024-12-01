<?php
require_once __DIR__ . '/../model/thongke.php'; // Import model với đường dẫn tuyệt đối

class ThongKeController
{
  private $model;
  private $error = null; // Biến lưu lỗi

  public function __construct()
  {
    $this->model = new ThongKeModel();
  }

  // Lấy lỗi hiện tại
  public function getError()
  {
    return $this->error;
  }

  public function thongKeSanPhamTheoNgay()
  {
    $data = []; // Biến lưu dữ liệu kết quả

    // Kiểm tra xem người dùng có submit form hay không
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Lấy dữ liệu từ request
      $ngayBatDau = isset($_POST['ngayBatDau']) ? $_POST['ngayBatDau'] : null;
      $ngayKetThuc = isset($_POST['ngayKetThuc']) ? $_POST['ngayKetThuc'] : null;

      // Kiểm tra dữ liệu nhập vào
      if (!$ngayBatDau || !$ngayKetThuc) {
        $this->error = "Vui lòng nhập đầy đủ thông tin ngày bắt đầu và ngày kết thúc.";
      } else {
        try {
          $startDate = new DateTime($ngayBatDau);
          $endDate = new DateTime($ngayKetThuc);

          if ($startDate > $endDate) {
            $this->error = "Ngày bắt đầu phải nhỏ hơn hoặc bằng ngày kết thúc.";
          } else {
            $interval = $startDate->diff($endDate);
            $monthsDifference = ($interval->y * 12) + $interval->m;

            if ($monthsDifference > 3) {
              $this->error = "Chỉ được chọn tối đa 4 tháng liên tiếp.";
            } else {
              // Lấy dữ liệu từ model
              $data = $this->model->thongKeSanPhamTheoNgay($ngayBatDau, $ngayKetThuc);
              if (empty($data)) {
                $this->error = "Không có dữ liệu thống kê cho khoảng thời gian này.";
              }
            }
          }
        } catch (Exception $e) {
          $this->error = "Định dạng ngày không hợp lệ.";
        }
      }
    }

    // Trả về dữ liệu
    return $data;
  }

  public function thongKeSanPhamTheoThang()
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
        $data = $this->model->thongKeSanPhamTheoThang($thangBatDau, $thangKetThuc, $nam);
        if (empty($data)) {
          $this->error = "Không có dữ liệu thống kê cho khoảng thời gian này.";
        }
      }
    }

    return $data;
  }

  // Thống kê sản phẩm theo năm
  public function thongKeSanPhamTheoNam()
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
        $data = $this->model->thongKeSanPhamTheoNam($namBatDau, $namKetThuc);
        if (empty($data)) {
          $this->error = "Không có dữ liệu thống kê cho khoảng thời gian này.";
        }
      }
    }

    return $data;
  }
}
