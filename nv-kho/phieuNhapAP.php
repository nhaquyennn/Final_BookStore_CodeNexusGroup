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
          <h4 class="fw-bold text-center">Phiếu Nhập Ấn Phẩm</h4>
          <form class="form-createPM">
            <!-- Nhập thông tin nhân viên -->
            <div class="mb-3">
              <label for="tenNhanVien" class="form-label fw-bold">Tên nhân viên:</label>
              <input type="text" class="form-control" id="tenNhanVien" placeholder="Nhập tên nhân viên">
            </div>

            <!-- Thông tin phiếu nhập -->
            <div class="row g-3">
              <div class="col-md-3">
                <label for="idSanPham" class="form-label fw-bold">Mã Ấn Phẩm:</label>
                <input type="text" class="form-control" id="idSanPham" placeholder="Nhập mã sản phẩm">
              </div>
              <div class="col-md-3">
                <label for="tenSanPham" class="form-label fw-bold">Tên Ấn Phẩm:</label>
                <input type="text" class="form-control" id="tenSanPham" placeholder="Nhập tên sản phẩm">
              </div>
              <div class="col-md-3">
                <label for="giaNhap" class="form-label fw-bold">Giá Nhập:</label>
                <input type="number" class="form-control" id="giaNhap" placeholder="Nhập giá nhập">
              </div>
              <div class="col-md-3">
                <label for="tongSoLuong" class="form-label fw-bold">Số Lượng Nhập:</label>
                <input type="number" class="form-control" id="tongSoLuong" placeholder="Nhập số lượng">
              </div>
            </div>

            <!-- Ngày nhập kho -->
            <div class="mb-3 mt-4">
              <label for="ngayNhap" class="form-label fw-bold">Ngày Nhập Kho:</label>
              <input type="date" class="form-control" id="ngayNhap">
            </div>

            <!-- Thể loại -->
            <div class="mb-3 mt-4">
              <label for="form-label fw-bold">Chọn danh mục sách</label>
              <select id="book-category">
                <option value="giao-duc">Giáo dục</option>
                <option value="tieu-thuyet">Tiểu thuyết</option>
                <option value="truyen-tranh">Truyện tranh</option>
                <option value="tap-chi">Tạp chí</option>
                <option value="tieng-anh">Sách Tiếng Anh</option>
              </select>
            </div>

            <!-- Kệ chứa -->
            <div class="mt-4">
              <label class="form-label fw-bold">Kệ Chứa:</label>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="ke1" name="ke[]" value="keSo1">
                <label class="form-check-label" for="ke1">Kệ số 1</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="ke2" name="ke[]" value="keSo2">
                <label class="form-check-label" for="ke2">Kệ số 2</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="ke3" name="ke[]" value="keSo3">
                <label class="form-check-label" for="ke3">Kệ số 3</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="ke4" name="ke[]" value="keSo4">
                <label class="form-check-label" for="ke4">Kệ số 4</label>
              </div>
            </div>


            <!-- Nút Tạo Phiếu -->
            <div class="mt-4">
              <button type="button" class="btn btn-primary">Tạo Phiếu Nhập</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <?php require_once "layout/script.php" ?>
</body>

</html>