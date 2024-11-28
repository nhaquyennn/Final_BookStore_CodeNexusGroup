<?php
require_once __DIR__ . '/../database/db_connect.php';

class Product
{
  private $conn;

  public function __construct()
  {
    $this->conn = getDbConnection();
  }

  // Hàm lấy thống kê sản phẩm
  public function getStatistics($type, $value)
  {
    $data = [];
    if ($type === 'day') {
      $sql = "SELECT products.name, SUM(orders.quantity) AS total_quantity
                    FROM orders
                    JOIN products ON orders.product_id = products.id
                    WHERE DATE(order_date) = ?
                    GROUP BY products.name";
      $stmt = $this->conn->prepare($sql);
      $stmt->bind_param("s", $value);
    } elseif ($type === 'month') {
      $sql = "SELECT products.name, SUM(orders.quantity) AS total_quantity
                    FROM orders
                    JOIN products ON orders.product_id = products.id
                    WHERE YEAR(order_date) = ? AND MONTH(order_date) = ?
                    GROUP BY products.name";
      list($year, $month) = explode('-', $value);
      $stmt = $this->conn->prepare($sql);
      $stmt->bind_param("ii", $year, $month);
    } elseif ($type === 'year') {
      $sql = "SELECT products.name, SUM(orders.quantity) AS total_quantity
                    FROM orders
                    JOIN products ON orders.product_id = products.id
                    WHERE YEAR(order_date) = ?
                    GROUP BY products.name";
      $stmt = $this->conn->prepare($sql);
      $stmt->bind_param("i", $value);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
      $data[] = $row;
    }

    return $data;
  }
}
