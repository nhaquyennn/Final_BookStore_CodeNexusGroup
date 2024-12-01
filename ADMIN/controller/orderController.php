<?php
require_once __DIR__ . '/../model/order.php'; // Require file Model

class OrderController
{
  private $model;

  public function __construct($db)
  {
    $this->model = new PhieuMuonModel($db); // Khởi tạo Model với kết nối database
  }

  // Hàm xử lý tìm kiếm đơn hàng
  public function searchDH($idPM)
  {
    $result = $this->model->getPM($idPM); // Gọi Model để lấy dữ liệu phiếu mượn

    if (!empty($result)) {
      // Nếu có dữ liệu, chuyển hướng đến giao diện quản lý cửa hàng
      header("Location: ../view/order/giaoDienQuanLyCuaHang.php?data=" . urlencode(json_encode($result)));
    } else {
      // Không có dữ liệu, chuyển hướng với thông báo lỗi
      header("Location: ../view/order/giaoDienQuanLyCuaHang.php?error=" . urlencode("Không tìm thấy mã phiếu mượn nào phù hợp."));
    }
    exit();
  }
}
