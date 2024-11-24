<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Danh Mục Sản Phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        }
        .nav-tabs .nav-link.active {
            background-color: #198754;
            color: white;
        }
        .btn-success {
            background-color: #198754;
        }
        table img {
            max-width: 40px;
        }
        .btn-sm {
            padding: 2px 10px;
            font-size: 12px;
        }
        .btn-danger a {
            color: white;
            text-decoration: none;
        }
        .btn-danger a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5>NHÂN VIÊN QUẢN LÝ KHO</h5>
            <div>
                <button class="btn btn-secondary btn-sm">Nhân viên kho A</button>
                <button class="btn btn-outline-secondary btn-sm">Đăng xuất</button>
            </div>
        </div>

        <!-- Tabs -->
        <ul class="nav nav-tabs mb-3">
            <li class="nav-item">
                <a class="nav-link" href="index.php">KIỂM KÊ KHO</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="capnhapthongtin.php">CẬP NHẬT THÔNG TIN</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="phieunhapkho.php">PHIẾU NHẬP KHO</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="phieuxuatkho.php">PHIẾU XUẤT KHO</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="danhmuc_sanpham.php">DANH MỤC SẢN PHẨM</a>
            </li>
        </ul>

        <!-- Table Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>QUẢN LÝ DANH MỤC SẢN PHẨM</h4>
            <div class="d-flex">
                <input type="text" class="form-control me-2" placeholder="Search">
                <button class="btn btn-success">Search</button>
            </div>
        </div>

        <!-- Table -->
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Mã danh mục</th>
                    <th>Tên danh mục</th>
                    <th>Số lượng sản phẩm</th>
                    <th>Mô tả</th>
                    <th>Tính năng</th>
                </tr>
            </thead>
            <tbody>
                <!-- Category 1 -->
                <tr>
                    <td>1</td>
                    <td>Điện Thoại</td>
                    <td>120</td>
                    <td>Danh mục chứa các loại điện thoại di động</td>
                    <td>
                        <button class="btn btn-warning btn-sm">Sửa</button>
                        <button class="btn btn-danger btn-sm">
                            <a href="gui_yeucau_xoa.php">Xóa</a>
                        </button>
                    </td>
                </tr>
                <!-- Category 2 -->
                <tr>
                    <td>2</td>
                    <td>Máy Tính</td>
                    <td>80</td>
                    <td>Danh mục chứa các loại máy tính và laptop</td>
                    <td>
                        <button class="btn btn-warning btn-sm">Sửa</button>
                        <button class="btn btn-danger btn-sm">
                            <a href="gui_yeucau_xoa.php">Xóa</a>
                        </button>
                    </td>
                </tr>
                <!-- Add more categories if needed -->
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
