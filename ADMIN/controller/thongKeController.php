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

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Lấy dữ liệu từ form
      $ngayBatDau = $_POST['ngayBatDau'] ?? null;
      $ngayKetThuc = $_POST['ngayKetThuc'] ?? null;

      // Kiểm tra dữ liệu nhập vào
      if (!$ngayBatDau || !$ngayKetThuc) {
        $this->error = "Vui lòng nhập đầy đủ ngày bắt đầu và ngày kết thúc.";
      } else {
        try {
          // Chuyển định dạng ngày nếu cần
          $startDate = DateTime::createFromFormat('Y-m-d', $ngayBatDau);
          $endDate = DateTime::createFromFormat('Y-m-d', $ngayKetThuc);

          if (!$startDate || !$endDate) {
            $this->error = "Định dạng ngày không hợp lệ.";
          } elseif ($startDate > $endDate) {
            $this->error = "Ngày bắt đầu phải nhỏ hơn hoặc bằng ngày kết thúc.";
          } else {
            $interval = $startDate->diff($endDate);
            $monthsDifference = ($interval->y * 12) + $interval->m;

            if ($monthsDifference > 3) {
              $this->error = "Chỉ được chọn tối đa 4 tháng liên tiếp.";
            } else {
              // Gọi model để lấy dữ liệu
              $data = $this->model->thongKeSanPhamTheoNgay($startDate->format('Y-m-d'), $endDate->format('Y-m-d'));

              // Nếu dữ liệu rỗng, gán lỗi
              if (!is_array($data) || empty($data)) {
                $this->error = "Không có dữ liệu thống kê cho khoảng thời gian này.";
              }
            }
          }
        } catch (Exception $e) {
          $this->error = "Đã xảy ra lỗi: " . htmlspecialchars($e->getMessage());
        }
      }
    }

    // Trả về dữ liệu hoặc mảng trống để tránh lỗi
    return is_array($data) ? $data : [];
  }


  public function thongKeSanPhamTheoThang($thangBatDau, $thangKetThuc, $nam)
  {
    $data = []; // Biến lưu kết quả thống kê

    // Kiểm tra nếu tháng bắt đầu và tháng kết thúc hợp lệ
    if (empty($thangBatDau) || empty($thangKetThuc) || empty($nam)) {
      $this->error = "Vui lòng nhập đầy đủ tháng bắt đầu, tháng kết thúc và năm.";
    } elseif ($thangBatDau > $thangKetThuc) {
      $this->error = "Tháng bắt đầu phải nhỏ hơn hoặc bằng tháng kết thúc.";
    } else {
      try {
        // Gọi model để lấy dữ liệu thống kê sản phẩm theo tháng
        $data = $this->model->thongKeSanPhamTheoThang((int)$thangBatDau, (int)$thangKetThuc, (int)$nam);

        // Kiểm tra nếu không có dữ liệu
        if (empty($data)) {
          $this->error = "Không có dữ liệu thống kê cho khoảng thời gian này.";
        }
      } catch (Exception $e) {
        // Xử lý lỗi trong trường hợp xảy ra lỗi khi truy vấn
        $this->error = "Đã xảy ra lỗi khi truy vấn dữ liệu: " . htmlspecialchars($e->getMessage());
        // Log chi tiết lỗi để phục vụ gỡ lỗi
        error_log("Lỗi truy vấn: " . $e->getMessage());
      }
    }

    // Trả về dữ liệu hoặc lỗi
    return is_array($data) ? $data : [];
  }

  public function thongKeSanPhamTheoNam()
  {
    $data = [];
    $this->error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $namBatDau = $_POST['namBatDau'] ?? null;
      $namKetThuc = $_POST['namKetThuc'] ?? null;

      if (!$namBatDau || !$namKetThuc) {
        $this->error = "Vui lòng nhập đầy đủ năm bắt đầu và năm kết thúc.";
      } elseif ($namBatDau > $namKetThuc) {
        $this->error = "Năm bắt đầu phải nhỏ hơn hoặc bằng năm kết thúc.";
      } else {
        try {
          $data = $this->model->thongKeSanPhamTheoNam((int)$namBatDau, (int)$namKetThuc);

          if (empty($data)) {
            $this->error = "Không có dữ liệu thống kê cho khoảng thời gian này.";
          }
        } catch (Exception $e) {
          $this->error = "Đã xảy ra lỗi: " . htmlspecialchars($e->getMessage());
        }
      }
    }

    return $data;
  }
}
