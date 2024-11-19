<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập Nhật Thông Tin Sách</title>
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
        .form-control {
            margin-bottom: 15px;
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
                <a class="nav-link active" href="capnhatthongtinsach.php">CẬP NHẬT THÔNG TIN</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="phieunhapkho.php">PHIẾU NHẬP KHO</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="phieuxuatkho.php">PHIẾU XUẤT KHO</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="danhmuc_sanpham.php">DANH MỤC SẢN PHẨM</a>
            </li>
        </ul>

        <!-- Form Update Book Information -->
        <h4 class="mb-4">Cập Nhật Thông Tin Sách</h4>
        <form>
            <!-- Chọn Tên Sách -->
            <div>
                <label for="selectBook" class="form-label">Chọn Sách</label>
                <select id="selectBook" class="form-select">
                    <option value="1">Sách A</option>
                    <option value="2">Sách B</option>
                    <option value="3">Sách C</option>
                    <option value="4">Sách D</option>
                </select>
            </div>

            <!-- Số lượng -->
            <div>
                <label for="quantity" class="form-label">Số Lượng</label>
                <input type="number" class="form-control" id="quantity" placeholder="Nhập số lượng">
            </div>

            <!-- Mô tả -->
            <div>
                <label for="description" class="form-label">Mô Tả</label>
                <textarea class="form-control" id="description" rows="3" placeholder="Nhập mô tả sách"></textarea>
            </div>

            <!-- Giá bán -->
            <div>
                <label for="sellingPrice" class="form-label">Giá Bán</label>
                <input type="text" class="form-control" id="sellingPrice" placeholder="Nhập giá bán (VNĐ)">
            </div>

            <!-- Giá nhập -->
            <div>
                <label for="importPrice" class="form-label">Giá Nhập</label>
                <input type="text" class="form-control" id="importPrice" placeholder="Nhập giá nhập (VNĐ)">
            </div>

            <!-- Thương hiệu -->
            <div>
                <label for="brand" class="form-label">Thương Hiệu</label>
                <input type="text" class="form-control" id="brand" placeholder="Nhập thương hiệu">
            </div>

            <!-- Hình ảnh -->
            <div>
                <label for="image" class="form-label">Hình Ảnh</label>
                <input type="file" class="form-control" id="image">
            </div>

            <!-- HSD -->
            <div>
                <label for="expiryDate" class="form-label">HSD</label>
                <input type="date" class="form-control" id="expiryDate">
            </div>

            <!-- Loại sách -->
            <div>
                <label for="bookType" class="form-label">Loại Sách</label>
                <select id="bookType" class="form-select">
                    <option value="1">Văn Học</option>
                    <option value="2">Khoa Học</option>
                    <option value="3">Giáo Dục</option>
                    <option value="4">Kinh Doanh</option>
                </select>
            </div>

            <!-- Nhà cung cấp -->
            <div>
                <label for="supplier" class="form-label">Nhà Cung Cấp</label>
                <input type="text" class="form-control" id="supplier" placeholder="Nhập tên nhà cung cấp">
            </div>

            <!-- Nút Lưu Thông Tin -->
            <div class="text-center">
                <button type="submit" class="btn btn-success">Lưu Thông Tin</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
