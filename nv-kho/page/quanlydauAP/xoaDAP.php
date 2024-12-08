<?php
if (!isset($_GET['page'])) {
    $page = 'xoaDAP';
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
    <div class="clearfix"></div>
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Start wrapper-->
            <div id="wrapper">


                <!-- CODE Ở ĐÂY -->
                <div class="row mt-5">
                <div class="col-12">
                    <h4 class="fw-bold text-center">XÓA ĐẦU ẤN PHẨM</h4>
                    <form class="form-createAP" method="POST" enctype="multipart/form-data" id="deleteForm">
                        
                    <div class="mb-3">
                            <label class="form-label fw-bold">Mã đầu ấn phẩm</label>
                            <input type="text" class="form-control" id="maDAP" value="<?php echo $maDAP?>" name="maDAP" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tên đầu ấn phẩm</label>
                            <input type="text" class="form-control" id="tenDanhMuc" value="<?php echo $tenDAP?>" name="tendauAP" readonly>
                        </div>


                        <div class="mb-3">
                            <label class="form-label fw-bold">Tác giả</label>
                            <input type="text" class="form-control" id="moTa" value="<?php echo $tacGia ?>" name="tacGia" readonly></input>
                        </div>
                        <div class="mb-3">
                                <label class="form-label fw-bold">Nhà xuất bản</label>
                                <input type="text" class="form-control" id="NXB" value="<?php echo $nhaXB ?>" name="nhaXB" readonly>
                        </div>
                        <div class="mb-3">
                                <label class="form-label fw-bold">Số lượng</label>
                                <input type="number" class="form-control" id="soluong" value="<?php echo $soLuong ?>" name="soLuong" readonly>
                        </div>
                        <div class="mb-3">
                                <label for="form-label fw-bold">Danh mục</label>
                                <input type="number" class="form-control" id="danhMuc" value="<?php echo $danhMuc ?>" name="DM" readonly>
                        </div>
                                
                        <div class="mb-3">
                            <label for="attachment" class="form-label">Hình ảnh</label>
                            <div><img style="width:100px;" src="img/<?php echo $hinhAnh?>" readonly></img></div>
                            
                        </div>
                    </div>

                       
                        <div class="mt-4 ml-3">
                        <button type="button" class="btn btn-danger" onclick="confirmDelete()">Xóa</button>
                            <a href="index.php?page=quanlydauAP" class="btn btn-secondary" name="huy">Hủy</a>
                        </div>

                    </form>
                    <script>
                        function confirmDelete() {
                            // Hiển thị hộp thoại xác nhận
                            var result = confirm("Bạn có chắc chắn muốn xóa đầu ấn phẩm này?");
                            if (result) {
                                // Nếu người dùng chọn OK, gửi form
                                document.getElementById('deleteForm').submit();
                            }
                        }
                    </script>
                    <?php
                    // if(isset($_POST['GuiYCX'])){
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if ($conn) {
                            $str = "DELETE FROM dauap WHERE madauAP = $maDAP";
                            if ($conn->query($str)) {
                                echo "<script>alert('Xóa thành công'); window.location.href='index.php?page=quanlydauAP'</script>";
                            } else {
                                echo "<script>alert('Xóa thất bại'); window.location.href='index.php?page=quanlydauAP'</script>";
                            }
                        }
                    }
                    ?>
                </div>
                <!--End main content-->

            </div>
        </div>
    </div>
</body>

</html>