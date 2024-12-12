
<?php
if (!isset($_GET['page'])) {
    $page = 'suaDAP';
} else {
    $page = $_GET['page'];
}
if (isset($_GET['maDAP'])) {
    $maDAP = $_GET['maDAP'];
}
$conn = mysqli_connect(hostname: 'localhost', username: 'root', password: '', database: 'final_nexus');
$sql = "select*from dauap where madauAP = $maDAP";
$result = $conn->query(query: $sql);
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc(result: $result)) {
        $tenDAP = $row['TenDauAnPham'];
        $tacGia = $row['Tacgia'];
        $nhaXB = $row['NXB'];
        $soLuong = $row['Tongsoluong'];
        $danhMuc = $row['MaDanhMuc'];
        $hinhAnh = $row['hinhAnh'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<body class="bg-theme bg-theme2">
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Sidebar -->


            <!-- Form thêm phiếu nhập -->
            <div class="row mt-5">
                <div class="col-12">
                    <h4 class="fw-bold text-center">SỬA ĐẦU ẤN PHẨM</h4>
                    <form class="form-createAP" action="#" method="POST" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label class="form-label fw-bold">Mã đầu ấn phẩm</label>
                            <input type="text" class="form-control" id="tenDanhMuc" value="<?php echo $maDAP ?>"
                                name="maDAP" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Tên đầu ấn phẩm</label>
                            <input type="text" class="form-control" id="tenDanhMuc" value="<?php echo $tenDAP ?>"
                                name="tendauAP" required>
                        </div>


                        <div class="mb-3">
                            <label class="form-label fw-bold">Tác giả</label>
                            <input type="text" class="form-control" id="moTa" value="<?php echo $tacGia ?>"
                                name="tacGia" required></input>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nhà xuất bản</label>
                            <input type="text" class="form-control" id="NXB" value="<?php echo $nhaXB ?>" name="nhaXB" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Số lượng</label>
                            <input type="number" class="form-control" id="soluong" value="<?php echo $soLuong ?>"
                                name="soLuong" required>
                        </div>
                        <div class="mb-3">
                            <label for="form-label fw-bold">Chọn danh mục sách</label>
                            <select id="book-category" name="DM" value="<?php echo $danhMuc ?>" >
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
                        <div class="mb-3">
                            <label for="attachment" class="form-label">Hình ảnh</label>
                            <div><img style="width:100px;" src="img/<?php echo $hinhAnh ?>"></img></div>
                            <input type="file" class="form-control" id="hinhAnh" value="<?php echo $hinhAnh ?>"
                                name="hinhAnh">
                        </div>
                </div>


                <div class="mt-4 ml-3">
                    <button type="submit" class="btn btn-primary" name="suaDAP">Lưu</button>
                    <a href="index.php?page=quanlydauAP" class="btn btn-secondary" name="huy">Hủy</a>
                </div>

                </form>
                <?php
                if (isset($_POST['suaDAP'])) {
                    $tenDAP = $_POST['tendauAP'];
                    $tacGia = $_POST['tacGia'];
                    $nhaXB = $_POST['nhaXB'];
                    $soluong = $_POST['soLuong'];
                    $maDM = $_POST['DM'];
                    $hinhAnh = $_FILES['hinhAnh'];
                    $file_hinh = $hinhAnh['name'] ?? '';
                    if ($conn) {
                        if ($file_hinh !== '') {
                            move_uploaded_file(from: $hinhAnh['tmp_name'], to: '../img/' . $file_hinh);
                            $str = "update dauap set TenDauAnPham = '$tenDAP', Tacgia = '$tacGia', NXB = '$nhaXB', 
                                Tongsoluong ='$soluong', MaDanhMuc = '$maDM', hinhAnh = '$file_hinh' where madauAP = $maDAP";
                        } else if ($file_hinh == '') {
                            $str = "update dauap set TenDauAnPham = '$tenDAP', Tacgia = '$tacGia', NXB = '$nhaXB', 
                            Tongsoluong ='$soluong', MaDanhMuc = '$maDM' where madauAP = $maDAP";
                        }
                        if ($conn->query(query: $str)) {
                            echo "<script>alert('Sửa thành công'); window.location.href='index.php?page=quanlydauAP'</script>";
                        } else {
                            echo "<script>alert('Sửa thất bại'); window.location.href='index.php?page=quanlydauAP'</script>";
                        }
                    } else {
                        echo "<script>alert('Kết nối thất bại')</script>";
                    }
                }
                ?>
            </div>
        </div>
    </div>


</body>

</html>