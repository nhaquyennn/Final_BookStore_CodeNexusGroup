
<?php
if (!isset($_GET['page'])) {
  $page = 'themHDnhapkho';
} else {
  $page = $_GET['page'];
}
$conn = mysqli_connect(hostname: 'localhost', username: 'root', password: '', database: 'final_nexus');
?>
<!DOCTYPE html>
<html lang="en">

<body class="bg-theme bg-theme2">
  <div class="content-wrapper">
    <div class="container-fluid">

      <!-- Form thêm phiếu nhập -->
      <div class="row mt-5">
        <div class="col-12">
          <h4 class="fw-bold text-center">Hóa Đơn Nhập Ấn Phẩm</h4>

          <form class="form-createPM" action="#" method="POST" enctype="multipart/form-data">
            <!--Tên hóa đơn -->
            <div class="mb-3 mt-4">
              <label for="tenHD" class="form-label fw-bold">Tên Hóa Đơn:</label>
              <input type="text" class="form-control" id="tenHD" name="tenHD" required>
            </div>

            <!-- Ngày nhập kho -->
            <div class="mb-3 mt-4">
              <label for="ngayNhap" class="form-label fw-bold">Ngày Nhập Kho:</label>
              <input type="date" class="form-control" id="ngayNhap" name="ngayNhap" required>
            </div>
            <!-- Nhập thông tin nhân viên -->
            <div class="mb-3">
              <label for="tenNhanVien" class="form-label fw-bold">Mã nhân viên:</label>
              <input type="text" class="form-control" id="maNV" placeholder="Nhập mã nhân viên" name="maNV" required>
            </div>
            <!--Nội dung -->
            <div class="mb-3 mt-4">
              <label for="noiDung" class="form-label fw-bold">Nội dung:</label>
              <input type="text" class="form-control" id="noiDung" name="noiDung" required>
            </div>
            <!--Tổng số lượng -->
            <div class="mb-3 mt-4">
              <label for="tongSL" class="form-label fw-bold">Tổng số lượng:</label>
              <input type="number" class="form-control" id="tongSL" name="tongSL" required>
            </div>


            <hr>
            <!-- Chi tiết hóa đơn -->
            <div id="products">
              <div class="product-container">
                <div class="row g-4 product-row">
                  <div class="col-md-4">
                    <label for="idSanPham" class="form-label fw-bold">Mã Đầu Ấn Phẩm:</label>
                    <select id="book-category" name="idSanPham[]">
                      <?php
                      $sql = "SELECT madauAP, TenDauAnPham FROM dauap";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                          echo "<option value='" . $row['madauAP'] . "'>" . $row['madauAP'] . ' - ' . $row['TenDauAnPham'] . "</option>";
                        }
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label for="tenSanPham" class="form-label fw-bold">Tên Ấn Phẩm:</label>
                    <input type="text" class="form-control" name="tenSanPham[]" placeholder="Nhập tên sản phẩm"
                      required>
                  </div>

                  <div class="col-md-4">
                    <label for="NXB" class="form-label fw-bold">Nhà xuất bản:</label>
                    <input type="text" class="form-control" name="NXB[]" placeholder="Nhập nhà xuất bản" required>
                  </div>
                  <div class="col-md-4 mt-4">
                    <label for="danhmuc" class="form-label fw-bold">Danh mục</label>
                    <select id="book-category" name="danhmuc[]">
                      <?php
                      $sql = "SELECT MaDanhMuc, TenDanhMuc FROM danhmucap";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                          echo "<option value='" . $row['MaDanhMuc'] . "'>" . $row['TenDanhMuc'] . "</option>";
                        }
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-md-4 mt-4">
                    <label for="giaNhap" class="form-label fw-bold">Đơn giá:</label>
                    <input type="number" class="form-control" name="giaNhap[]" placeholder="Nhập đơn giá" required>
                  </div>
                  <div class="col-md-4 mt-4">
                    <label for="soLuong" class="form-label fw-bold">Số Lượng:</label>
                    <input type="number" class="form-control" name="soLuong[]" placeholder="Nhập số lượng" required>
                  </div>

                </div>

                <div class="mb-3 mt-4">
                  <label for="tong" class="form-label fw-bold">Tổng:</label>
                  <input type="number" class="form-control tong" readonly>
                </div>
                <hr>
              </div>

            </div>

            <!-- Thêm dòng -->
            <div class="mb-3 mt-4">
              <button type="button" class="btn btn-secondary" id="addProduct">Thêm dòng</button>
            </div>


            <!--Tổng tiền-->
            <div class="mb-3 mt-4">
              <label for="tongTien" class="form-label fw-bold">Tổng tiền:</label>
              <input type="text" class="form-control" id="tongTien" name="tongTien" readonly>
            </div>
            <!-- Nút Tạo Phiếu -->
            <div class="mt-4 ">
              <button type="submit" class="btn btn-primary" name="themHDnhap">Tạo</button>
              <a href="index.php?page=quanlyHDnhap" class="btn btn-secondary" name="huy">Hủy</a>
            </div>
          </form>
          <?php
          if (isset($_POST['themHDnhap'])) {
            // Nhận dữ liệu từ form
            $tenHD = $_POST['tenHD'];
            $ngayNhap = $_POST['ngayNhap'];
            $maNV = $_POST['maNV'];
            $noiDung = $_POST['noiDung'];
            $tongSL = $_POST['tongSL'];
            $tongTien = $_POST['tongTien'];
            // Insert vào bảng hóa đơn nhập
            $sql_insert_hoa_don = "INSERT INTO hoadonnhapap (TenHoaDon,maNhanVien,NgayTao,NoiDung, Tongsoluong, TongTien) VALUES ('$tenHD','$maNV','$ngayNhap', '$noiDung','$tongSL','$tongTien')";
            if (mysqli_query($conn, $sql_insert_hoa_don)) {
              $hoaDonID = mysqli_insert_id($conn); // Lấy ID của hóa đơn vừa tạo
          
              // Xử lý các sản phẩm nhập
              if (isset($_POST['idSanPham']) && !empty($_POST['idSanPham'])) {
                $idSanPham = $_POST['idSanPham'];
                $tenSanPham = $_POST['tenSanPham'];
                $NXB = $_POST['NXB'];
                $giaNhap = $_POST['giaNhap'];
                $soLuong = $_POST['soLuong'];
                $danhMuc = $_POST['danhmuc'];

                // Lặp qua tất cả các sản phẩm và chèn vào cơ sở dữ liệu
                for ($i = 0; $i < count($idSanPham); $i++) {
                  $idSP = mysqli_real_escape_string($conn, $idSanPham[$i]);
                  $tenSP = mysqli_real_escape_string($conn, $tenSanPham[$i]);
                  $nxb = mysqli_real_escape_string($conn, $NXB[$i]);
                  $gia = (float) $giaNhap[$i];
                  $soLuongNhap = (int) $soLuong[$i];
                  $danhMucSP = mysqli_real_escape_string($conn, $danhMuc[$i]);
                  $tongTienSP = $gia * $soLuongNhap;

                  // Insert vào bảng chi tiết hóa đơn nhập
                  $sql_ct_hoa_don = "INSERT INTO cthoadonnhap (maDauAP, TenAnPham, TenDanhMuc, NhaXB, DonGia, SoLuong, TongTien, MaHoaDon ) 
              VALUES ('$idSP', '$tenSP', '$danhMucSP','$nxb','$gia', '$soLuongNhap', '$tongTienSP','$hoaDonID')";
                  if (!mysqli_query($conn, $sql_ct_hoa_don)) {
                    echo "Error: " . $sql_ct_hoa_don . "<br>" . mysqli_error($conn);
                  }
                }
                echo "<script>alert('Phiếu nhập đã được tạo thành công!') ; window.location.href='index.php?page=QLHDnhap'</script>";
              }
            } else {
              echo "Error: " . $sql_insert_hoa_don . "<br>" . mysqli_error($conn);
            }
          }
          ?>
        </div>
      </div>
    </div>
  </div>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      // Hàm tính tổng cho một dòng sản phẩm
      function calculateRowTotal(row) {
        const giaNhap = parseFloat(row.querySelector('[name="giaNhap[]"]').value) || 0;
        const soLuong = parseInt(row.querySelector('[name="soLuong[]"]').value) || 0;
        const tongField = row.querySelector('.tong');

        // Tính tổng của dòng
        const total = Math.round(giaNhap * soLuong); // Loại bỏ phần thập phân
        tongField.value = total;
        return total;
      }

      // Hàm tính tổng tiền toàn bộ hóa đơn
      function calculateTotalInvoice() {
        const rows = document.querySelectorAll('.product-container');
        let totalInvoice = 0;

        rows.forEach(row => {
          totalInvoice += calculateRowTotal(row);
        });

        // Cập nhật tổng tiền hóa đơn
        document.getElementById('tongTien').value = Math.round(totalInvoice);
      }

      // Sự kiện thêm dòng sản phẩm
      document.getElementById('addProduct').addEventListener('click', function () {
        // Clone phần tử sản phẩm mẫu
        const newProductContainer = document.querySelector('.product-container').cloneNode(true);

        // Reset các giá trị của input trong dòng mới
        const inputs = newProductContainer.querySelectorAll('input');
        inputs.forEach(input => input.value = '');

        // Append dòng mới vào container
        document.getElementById('products').appendChild(newProductContainer);

        // Gắn sự kiện cho các trường trong dòng mới
        newProductContainer.querySelectorAll('[name="giaNhap[]"], [name="soLuong[]"]').forEach(input => {
          input.addEventListener('input', function () {
            calculateRowTotal(newProductContainer); // Tính tổng cho dòng mới
            calculateTotalInvoice(); // Tính tổng tiền hóa đơn
          });
        });
      });

      // Sự kiện thay đổi giá nhập hoặc số lượng trên các dòng sản phẩm hiện tại
      const productsContainer = document.getElementById("products");
      productsContainer.addEventListener("input", function (event) {
        const target = event.target;
        if (target.matches('[name="giaNhap[]"], [name="soLuong[]"]')) {
          const productRow = target.closest(".product-container");
          calculateRowTotal(productRow); // Cập nhật tổng dòng
          calculateTotalInvoice(); // Cập nhật tổng hóa đơn
        }
      });
    });
  </script>
</body>

</html>