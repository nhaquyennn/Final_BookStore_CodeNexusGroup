<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "layout/header.php" ?>
    <title>Thêm Phiếu Nhập Sách</title>
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

            <!-- Form thêm phiếu nhập -->
            <div class="row mt-5">
                <div class="col-12">
                    <h4 class="fw-bold text-center">TẠO ẤN PHẨM</h4>
                    <form class="form-createAP">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tên ấn phẩm</label>
                            <input type="text" class="form-control" id="tenAnPham" placeholder="Nhập tên ấn phẩm">
                        </div>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Số lượng</label>
                                <input type="number" class="form-control" id="" placeholder="Nhập số lượng">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Giá</label>
                                <input type="text" class="form-control" id="" placeholder="Nhập giá">
                            </div>
                            <div class="col-md-3">
                                <label for="form-label fw-bold">Chọn thể loại sách</label>
                                <select id="book-category">
                                    <option value="giao-duc">Giáo dục</option>
                                    <option value="tieu-thuyet">Tiểu thuyết</option>
                                    <option value="truyen-tranh">Truyện tranh</option>
                                    <option value="tap-chi">Tạp chí</option>
                                    <option value="tieng-anh">Sách Tiếng Anh</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Mô tả</label>
                            <textarea type="text" class="form-control" id="tenAnPham" placeholder="Nhập mô tả"></textarea>
                        </div>

                        <div class="mb-3 mt-4">
                            <label for="attachment" class="form-label">Hình ảnh</label>
                            <input type="file" class="form-control" id="attachment" name="attachment">
                        </div>

                        <div class="mt-4">
                            <a href="DSAP.php"><button type="button" class="btn btn-primary">Tạo</button></a>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php require_once "layout/script.php" ?>
</body>

</html>