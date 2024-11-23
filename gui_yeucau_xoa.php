<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gửi Yêu Cầu Xóa Danh Mục Sản Phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            width: 50%;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #198754;
            border: none;
        }
        .btn-primary:hover {
            background-color: #145c32;
        }
    </style>
</head>
<body>
    <div class="container">
        <h4 class="text-center mb-4">Phiếu Gửi Yêu Cầu Xóa Danh Mục Sản Phẩm</h4>
        <form action="submit_request.php" method="POST">
            <!-- Tên nhân viên -->
            <div class="mb-3">
                <label for="employeeName" class="form-label">Tên nhân viên</label>
                <input type="text" class="form-control" id="employeeName" name="employeeName" placeholder="Nhập tên của bạn" required>
            </div>

            <!-- Tên danh mục -->
            <div class="mb-3">
                <label for="categoryName" class="form-label">Tên danh mục cần xóa</label>
                <input type="text" class="form-control" id="categoryName" name="categoryName" placeholder="Nhập tên danh mục" required>
            </div>

            <!-- Lý do xóa -->
            <div class="mb-3">
                <label for="reason" class="form-label">Lý do xóa</label>
                <textarea class="form-control" id="reason" name="reason" rows="4" placeholder="Nhập lý do bạn muốn xóa danh mục này" required></textarea>
            </div>

            <!-- Mức độ ưu tiên -->
            <div class="mb-3">
                <label class="form-label">Mức độ ưu tiên</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="priorityLevel" id="priorityLow" value="Thấp" checked>
                        <label class="form-check-label" for="priorityLow">Thấp</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="priorityLevel" id="priorityMedium" value="Trung Bình">
                        <label class="form-check-label" for="priorityMedium">Trung Bình</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="priorityLevel" id="priorityHigh" value="Cao">
                        <label class="form-check-label" for="priorityHigh">Cao</label>
                    </div>
                </div>
            </div>

            <!-- File đính kèm -->
            <div class="mb-3">
                <label for="attachment" class="form-label">Tệp đính kèm (nếu có)</label>
                <input type="file" class="form-control" id="attachment" name="attachment">
            </div>

            <!-- Nút Gửi Yêu Cầu -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Gửi Yêu Cầu</button>
                <a href="index.php" class="btn btn-secondary">Quay Lại</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
