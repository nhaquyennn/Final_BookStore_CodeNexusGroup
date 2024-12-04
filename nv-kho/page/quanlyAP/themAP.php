<?php
 if (!isset($_GET['page'])) {
    $page ='themAP' ;
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
                    <h4 class="fw-bold text-center">TẠO ẤN PHẨM</h4>
                    <form class="form-createAP" action="#" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Mã ấn phẩm</label>
                            <input type="text" class="form-control" id="maAP" placeholder="Nhập tên ấn phẩm" name="maAP">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tên ấn phẩm</label>
                            <input type="text" class="form-control" id="tenAnPham" placeholder="Nhập tên ấn phẩm" name="tenAP">
                        </div>
                        <div class="mb-3">
                                <label for="form-label fw-bold">Chọn đầu ấn phẩm</label>
                                <select id="book-category" name="dauAP">
                                <?php
                                $sql = "SELECT madauAP, TenDauAnPham FROM dauap";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['madauAP'] . "'>" . $row['TenDauAnPham'] . "</option>";
                                    }
                                }
                                ?>
                                </select>
                            </div>
                        <div class="row g-3">
                        
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Giá thuê</label>
                                <input type="number" class="form-control" id="giaThue" name="giaThue">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Ngày xuất bản</label>
                                <input type="date" class="form-control" id="ngayXB" placeholder="Ngày xuất bản" name="ngayXB">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Tình trạng</label>
                                <input type="text" class="form-control" id="tinhTrang" placeholder="Tình trạng" name="tinhTrang">
                            </div>
                            
                        </div>

                        <!-- <div class="mb-3 mt-4">
                            <label for="attachment" class="form-label">Hình ảnh</label>
                            <input type="file" class="form-control" id="hinhAnh"  name="hinhAnh">
                        </div> -->

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary" name="themAP">Tạo</button>
                            <button type="submit" class="btn btn-secondary" name="huy">Quay lại</button>
                            
                        </div>

                    </form>
                    <?php
                    if(isset($_POST['themAP'])){
                        $maAP = $_POST['maAP'];
                        $tenAP = $_POST['tenAP'];
                        $giaThue = $_POST['giaThue'];
                        $ngayXB = date("Y-m-d", strtotime($_POST['ngayXB']));
                        $tinhTrang = $_POST['tinhTrang'];
                        $dauAP = $_POST['dauAP'];
                        if($conn){
                            
                            $str= "insert into anpham (maAnPham, TenAnPham,Giathue, ngayXB, tinhTrang, madauAP)
                                    values ('$maAP','$tenAP', '$giaThue','$ngayXB', '$tinhTrang','$dauAP')";
                            if($conn->query( $str)){
                                echo "<script>alert('Them thanh cong'); window.location.href='index.php?page=quanlyAP'</script>";
                            }else {
                                echo "<script>alert('Them that bai'); window.location.href='index.php?page=quanlyAP'</script>";
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

</body>

</html>