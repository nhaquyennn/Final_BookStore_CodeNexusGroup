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
                    <h4 class="fw-bold text-center">TẠO DANH MỤC</h4>
                    <form class="form-createAP">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Mã danh mục</label>
                            <input type="text" class="form-control" id="idDanhMuc" placeholder="Nhập mã danh mục">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Tên danh mục</label>
                            <input type="text" class="form-control" id="tenDanhMuc" placeholder="Nhập tên danh mục">
                        </div>


                        <div class="mb-3">
                            <label class="form-label fw-bold">Mô tả</label>
                            <textarea type="text" class="form-control" id="tenAnPham" placeholder="Nhập mô tả"></textarea>
                        </div>

                        <div class="mt-4">
                            <a href="danhMucAP.php" class="btn btn-secondary">Quay lại</a>
                            <a href="danhMucAP.php"><button type="button" class="btn btn-primary">Tạo</button></a>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php require_once "layout/script.php" ?>
</body>

</html>