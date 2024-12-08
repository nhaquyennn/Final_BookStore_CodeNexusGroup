<?php
 if (!isset($_GET['page'])) {
    $page ='xoaAP' ;
} else {
    $page = $_GET['page'];
}
if(isset($_GET['maAP'])){
    $maAP = $_GET['maAP'];
}
$conn = mysqli_connect(hostname: 'localhost', username: 'root', password: '', database: 'final_nexus');
$sql = "select*from anpham where maAnPham = $maAP";
$result = $conn -> query(query: $sql);
if($result->num_rows > 0){
    while ($row = mysqli_fetch_assoc(result: $result)){
        $maAP = $row['maAnPham'];
        $tenAP = $row['TenAnPham'];
        $giaThue = $row['Giathue'];
        $tinhTrang = $row['tinhTrang'];
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
                <div class="container">
                    <h4 class="text-center mb-4" >YÊU CẦU XÓA ẤN PHẨM</h4>
                    
                    <form action="#" method="POST" enctype="multipart/form-data">
                        <!-- Danh mục -->
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Mã ấn phẩm</label>
                            <input type="text" class="form-control"  name="maAP" value="<?php echo $maAP?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="employeeName" class="form-label">Tên ấn phẩm</label>
                            <input type="text" class="form-control"  name="tenAP" value="<?php echo $tenAP?>" readonly>
                        </div>
                       
                        <div class="mb-3">
                            <label for="employeeName" class="form-label">Giá thuê</label>
                            <input type="text" class="form-control"  name="giaThue" value="<?php echo $giaThue?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="employeeName" class="form-label">Tình trạng</label>
                            <input type="text" class="form-control"  name="tinhTrang" value="<?php echo $tinhTrang ?>"  readonly>
                        </div>

                        <div class="mb-3">
                            <label for="employeeName" class="form-label">Mã nhân viên</label>
                            <input type="text" class="form-control" id="maNV" name="maNV" placeholder="Nhập mã nhân viên" required>
                        </div>
                        <div class="mb-3">
                            <label for="employeeName" class="form-label">Ngày</label>
                            <input type="date" class="form-control" id="ngayTao" name="ngayTao" required>
                        </div>
                        <!-- Lý do xóa -->
                        <div class="mb-3">
                            <label for="reason" class="form-label">Lý do</label>
                            <textarea class="form-control" id="lyDo" name="lyDo" rows="4" placeholder="Nhập lý do xóa danh mục" required></textarea>
                        </div>

                        <!-- Nút Gửi Yêu Cầu -->
                        <div>
                            <a href="index.php?page=quanlyAP" class="btn btn-secondary">Hủy</a>
                            <input type="submit" class="btn btn-primary" name="GuiYCX" value="Gửi"> </input>
                        </div>
                    </form>
                    <?php
                    if(isset($_POST['GuiYCX'])){
                        $tenYCX= "Yêu cầu xóa ấn phẩm";
                        $maloaiYC = "2";
                        $maAP= $_POST['maAP'];
                        $tenAP= $_POST['tenAP'];
                        $tinhTrang= $_POST['tinhTrang'];
                        $lyDo = $_POST['lyDo'];
                        $ngayTao = date(format: "Y-m-d", timestamp: strtotime(datetime: $_POST['ngayTao']));
                        $maNV = $_POST['maNV'];
                        $noiDung = "Mã ấn phẩm: $maAP \nTên ấn phẩm: $tenAP \nTình trạng: $tinhTrang \nLý do: $lyDo";
                        $trangThai = "Chờ duyệt";
                        
                        if($conn){
                            $str= "insert into yeucau ( tenYC, noiDung, ngayYC, maNhanVien,maloaiYC, trangThai) 
                            values ('$tenYCX','$noiDung','$ngayTao','$maNV','$maloaiYC' ,'$trangThai')";
                            if($conn->query($str)){
                                echo "<script>alert('Gửi yêu cầu thành công'); window.location.href='index.php?page=quanlyAP'</script>";
                            }else {
                                echo "<script>alert('Gửi yêu cầu thất bại'); window.location.href='index.php?page=quanlyAP'</script>";
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