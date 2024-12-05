<?php
 if (!isset($_GET['page'])) {
    $page ='xoaDM' ;
} else {
    $page = $_GET['page'];
}
if(isset($_GET['maDM'])){
    $maDM = $_GET['maDM'];
}
$conn = mysqli_connect(hostname: 'localhost', username: 'root', password: '', database: 'final_nexus');
$sql = "select*from danhmucap where MaDanhMuc = $maDM";
$result = $conn -> query(query: $sql);
if($result->num_rows > 0){
    while ($row = mysqli_fetch_assoc(result: $result)){
        $tenDM = $row['TenDanhMuc'];
        $moTa = $row['MoTa'];
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
                    <h4 class="text-center mb-4">PHIẾU YÊU CẦU XÓA DANH MỤC</h4>
                    <form action="submit_request.php" method="POST">
                        <!-- Danh mục -->
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Danh mục</label>
                            <input type="text" class="form-control" id="DM" name="DM" value="<?php echo $tenDM?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="employeeName" class="form-label">Mô tả</label>
                            <input type="text" class="form-control" id="moTa" name="moTa" value="<?php echo $moTa?>" readonly>
                        </div>
                        <!-- Tên nhân viên -->
                        <div class="mb-3">
                            <label for="employeeName" class="form-label">Mã nhân viên</label>
                            <input type="text" class="form-control" id="employeeName" name="employeeName" placeholder="Nhập mã nhân viên" required>
                        </div>
                        <div class="mb-3">
                            <label for="employeeName" class="form-label">Tên nhân viên</label>
                            <input type="text" class="form-control" id="employeeName" name="employeeName" placeholder="Nhập tên nhân viên" required>
                        </div>

                        

                        <!-- Lý do xóa -->
                        <div class="mb-3">
                            <label for="reason" class="form-label">Lý do</label>
                            <textarea class="form-control" id="reason" name="reason" rows="4" placeholder="Nhập lý do xóa danh mục" required></textarea>
                        </div>

                        <!-- Nút Gửi Yêu Cầu -->
                        <div>
                            <a href="danhMucAP.php" class="btn btn-secondary">Quay lại</a>
                            <a href="danhMucAP.php"><button type="submit" class="btn btn-primary">Gửi </button></a>
                        </div>
                    </form>
                    <?php
                     ?>
                </div>
                <!--End main content-->

            </div>
        </div>
    </div>
</body>

</html>