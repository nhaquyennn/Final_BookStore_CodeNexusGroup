<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "layout/header.php" ?>
    <title>Danh Sách Phiếu Nhập Sách</title>
</head>

<body class="bg-theme bg-theme2">
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Sidebar -->
            <?php require_once "layout/left_sidebar.php" ?>

            <!-- Topbar -->
            <header class="topbar-nav">
                <?php require_once "layout/topbar.php" ?>
            </header>

            <!-- Danh sách phiếu nhập -->
            <div class="row mt-5">
                <div class="col-12">
                    <h4 class="fw-bold">Danh sách Phiếu Nhập Ẩn Phẩm</h4>
                    <div class="d-flex justify-content-end mb-3">
                        <a href="phieuNhapAP.php" class="btn btn-success">Thêm Phiếu Nhập Ấn Phẩm</a>
                    </div>
                    <table class="table table-bordered">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>#</th>
                                <th>Mã Ấn Phẩm</th>
                                <th>Tên Ấn Phẩm</th>
                                <th>Số Lượng Nhập</th>
                                <th>Giá Nhập</th>
                                <th>Ngày Nhập</th>
                                <th>Kệ Chứa</th>
                                <th>Thể Loại</th>
                                <th>Tùy Chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td>SP001</td>
                                <td>Vở Học Sinh</td>
                                <td class="text-end">200</td>
                                <td class="text-end">1,000,000 VND</td>
                                <td class="text-center">2023-11-20</td>
                                <td class="text-center">Kệ số 1</td>
                                <td class="text-center">Sách Giáo dục</td>
                                <td class="text-center">
                                    <button class="btn btn-warning btn-sm mx-1">Sửa</button>
                                    <button class="btn btn-danger btn-sm mx-1">Xóa</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>SP002</td>
                                <td>Bút Bi Thiên Long</td>
                                <td class="text-end">150</td>
                                <td class="text-end">750,000 VND</td>
                                <td class="text-center">2023-11-18</td>
                                <td class="text-center">Kệ số 3</td>
                                <td class="text-center">Sách Giáo dục</td>
                                <td class="text-center">
                                    <button class="btn btn-warning btn-sm mx-1">Sửa</button>
                                    <button class="btn btn-danger btn-sm mx-1">Xóa</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php require_once "layout/script.php" ?>
</body>

</html>