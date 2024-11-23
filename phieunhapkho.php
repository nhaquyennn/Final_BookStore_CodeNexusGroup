<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phiếu Nhập Kho</title>
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
            background-color: #28a745;
        }
        .btn-success:hover {
            background-color: #218838;
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
                <a class="nav-link" href="capnhatthongtin.php">CẬP NHẬT THÔNG TIN</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="phieunhapkho.php">PHIẾU NHẬP KHO</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="phieuxuatkho.php">PHIẾU XUẤT KHO</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="danhmuc_sanpham.php">DANH MỤC SẢN PHẨM</a>
            </li>
        </ul>

        <!-- Table Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>PHIẾU NHẬP KHO</h4>
            <button class="btn btn-success" onclick="document.getElementById('addForm').style.display='block'">Thêm Phiếu Nhập</button>
        </div>

        <!-- Table -->
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Mã Phiếu</th>
                    <th>Ngày Nhập</th>
                    <th>Nhân Viên</th>
                    <th>Danh Mục Sách</th>
                    <th>Tổng Số Lượng</th>
                    <th>Ghi Chú</th>
                    <th>Tính năng</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>PN001</td>
                    <td>01/11/2024</td>
                    <td>Nguyễn Văn A</td>
                    <td>Sách A</td>
                    <td>150</td>
                    <td>Nhập hàng đợt đầu tháng</td>
                    <td>
                        <button class="btn btn-warning btn-sm">Sửa</button>
                        <button class="btn btn-danger btn-sm">Xóa</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Form Add Entry -->
        <div id="addForm" style="display: none;">
            <h4 class="mt-4">Thêm Phiếu Nhập</h4>
            <form>
                <div class="mb-3">
                    <label for="importDate" class="form-label">Ngày Nhập</label>
                    <input type="date" class="form-control" id="importDate">
                </div>
                <div class="mb-3">
                    <label for="employee" class="form-label">Nhân Viên</label>
                    <input type="text" class="form-control" id="employee" placeholder="Tên nhân viên">
                </div>
                <div class="mb-3">
                    <label for="bookCategory" class="form-label">Danh Mục Sách</label>
                    <select id="bookCategory" class="form-select">
                        <option value="1">Sách A</option>
                        <option value="2">Sách B</option>
                        <option value="3">Sách C</option>
                        <option value="4">Sách D</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Tổng Số Lượng</label>
                    <input type="number" class="form-control" id="quantity" placeholder="Nhập tổng số lượng">
                </div>
                <div class="mb-3">
                    <label for="notes" class="form-label">Ghi Chú</label>
                    <textarea class="form-control" id="notes" rows="3" placeholder="Nhập ghi chú"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Thêm</button>
                <button type="button" class="btn btn-secondary" onclick="document.getElementById('addForm').style.display='none'">Hủy</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
