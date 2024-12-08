<?php
 if (!isset($_GET['page'])) {
    $page ='themDAP' ;
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
                    <h4 class="fw-bold text-center">TẠO ĐẦU ẤN PHẨM</h4>
                    <form class="form-createAP" action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Mã đầu ấn phẩm</label>
                            <input type="text" class="form-control" id="madauAP" placeholder="Nhập tên ấn phẩm" name="madauAP" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tên đầu ấn phẩm</label>
                            <input type="text" class="form-control" id="tenAnPham" placeholder="Nhập tên ấn phẩm" name="tendauAP" required>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Tác giả</label>
                                <input type="text" class="form-control" id="tacGia" placeholder="Tác giả" name="tacGia" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Nhà xuất bản</label>
                                <input type="text" class="form-control" id="NXB" placeholder="Nhà xuất bản" name="nhaXB" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Số lượng</label>
                                <input type="number" class="form-control" id="soluong" placeholder="Số lượng" name="soLuong" required>
                            </div>
                            <div class="col-md-3">
                                <label for="form-label fw-bold">Chọn danh mục sách</label>
                                <select id="book-category" name="DM">
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
                        </div>

                        <div class="mb-3 mt-4">
                            <label for="attachment" class="form-label">Hình ảnh</label>
                            <input type="file" class="form-control" id="hinhAnh"  name="hinhAnh" required>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary" name="themDAP">Tạo</button>
                            <a href="index.php?page=quanlydauAP" class="btn btn-secondary" name="huy">Hủy</a>
                            
                        </div>

                    </form>
                    <?php
                    if(isset($_POST['themDAP'])){
                        $maDAP = $_POST['madauAP'];
                        $tenDAP = $_POST['tendauAP'];
                        $tacGia = $_POST['tacGia'];
                        $nhaXB = $_POST['nhaXB'];
                        $soluong = $_POST['soLuong'];
                        $maDM = $_POST['DM'];
                        $hinhAnh = $_FILES['hinhAnh'];
                        $file_hinh= $hinhAnh['name']??'';
                        if($conn){
                            move_uploaded_file(from: $hinhAnh['tmp_name'], to: '../img/' . $file_hinh);
                            $str= "insert into dauap (madauAP, TenDauAnPham, Tacgia, NXB, Tongsoluong, MaDanhMuc, hinhAnh)
                                    values ('$maDAP','$tenDAP', '$tacGia','$nhaXB', '$soluong','$maDM', '$file_hinh')";
                            if($conn->query( $str)){
                                echo "<script>alert('Thêm thành công'); window.location.href='index.php?page=quanlydauAP'</script>";
                            }else {
                                echo "<script>alert('Thêm thất bại'); window.location.href='index.php?page=quanlydauAP'</script>";
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

</body>

</html>