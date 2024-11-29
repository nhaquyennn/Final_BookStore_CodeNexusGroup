<?php
require_once __DIR__ . '/../model/Product.php';

class ProductController
{
  private $productModel;

  public function __construct()
  {
    $this->productModel = new Product();
  }

  // Hàm lấy thống kê và hiển thị
  public function statistics()
  {
    // Lấy tham số từ URL
    $type = $_GET['type'] ?? 'day';
    $value = $_GET['value'] ?? date('Y-m-d');

    // Lấy dữ liệu thống kê
    $data = $this->productModel->getStatistics($type, $value);

    // Gửi dữ liệu đến View
    include __DIR__ . '/../layout/statistics_view.php';
  }
}

// Khởi tạo controller và gọi hàm thống kê
$controller = new ProductController();
$controller->statistics();
