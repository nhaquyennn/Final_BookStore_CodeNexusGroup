<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Danh Mục Ấn Phẩm</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    #sidebar-wrapper {
      width: 250px;
      background-color: #343a40;
      color: white;
      height: 100vh;
      padding: 20px;
      box-sizing: border-box;
      position: fixed;
    }

    #sidebar-wrapper h5 {
      color: white;
      text-align: center;
      margin-bottom: 15px;
      font-size: 18px;
    }

    .list-group {
      list-style: none;
      padding: 0;
    }

    .list-group-item {
      padding: 10px;
      background-color: #495057;
      margin-bottom: 5px;
      cursor: pointer;
      border-radius: 4px;
      color: white;
      text-align: center;
      transition: background-color 0.3s;
    }

    .list-group-item:hover {
      background-color: #6c757d;
    }

    #main-content {
      margin-left: 270px;
      padding: 20px;
    }

    .product-table {
      margin-top: 20px;
      width: 100%;
      border-collapse: collapse;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .product-table th,
    .product-table td {
      padding: 10px;
      text-align: center;
      border: 1px solid #ddd;
    }

    .product-table th {
      background-color: #343a40;
      color: white;
    }

    .product-table img {
      width: 50px;
      height: 50px;
      object-fit: cover;
    }
  </style>
</head>

<body>
  <!-- Sidebar -->
  <div id="sidebar-wrapper">
    <h5>Danh mục</h5>
    <ul class="list-group">
      <li class="list-group-item" onclick="showProducts('giaokhoa')">Sách Giáo Khoa</li>
      <li class="list-group-item" onclick="showProducts('thamkhao')">Sách Tham Khảo</li>
      <li class="list-group-item" onclick="showProducts('truyentranh')">Truyện Tranh</li>
    </ul>
  </div>

  <!-- Main Content -->
  <div id="main-content">
    <h5 class="fw-bold">Danh Sách Ấn Phẩm</h5>
    <div id="products-container">
      <p class="text-muted">Vui lòng chọn danh mục để hiển thị danh sách ấn phẩm...</p>
    </div>
  </div>


</body>

</html>