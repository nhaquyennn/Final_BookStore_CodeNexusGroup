<?php
 if (!isset($_GET['page'])) {
    $page ='suaDM' ;
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
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Sidebar -->
           

            <!-- Form thêm phiếu nhập -->
            <div class="row mt-5">
                <div class="col-12">
                    <h4 class="fw-bold text-center">SỬA DANH MỤC</h4>
                    <form class="form-createAP" action="#" method="POST" enctype="multipart/form-data">
                        

                        <div class="mb-3">
                            <label class="form-label fw-bold">Tên danh mục</label>
                            <input type="text" class="form-control" id="tenDanhMuc" value="<?php echo $tenDM ?>" name="tenDM">
                        </div>


                        <div class="mb-3">
                            <label class="form-label fw-bold">Mô tả</label>
                            <input type="text" class="form-control" id="moTa" value="<?php echo $moTa?>" name="moTa"></input>
                        </div>

                        <div class="mt-4">
                            <a href="index.php?page=quanlyDM"><button type="submit" class="btn btn-primary" name="suaDM">Lưu</button></a>
                            <a href="index.php?page=quanlyDM" class="btn btn-secondary" name="huy">Hủy</a>
                        </div>

                    </form>
                    <?php
                    if(isset($_POST['suaDM'])){
                        $tenDM = $_POST['tenDM'];
                        $moTa = $_POST['moTa'];
                        if($conn){
                            $str= "update danhmucap set TenDanhMuc = '$tenDM' , MoTa = '$moTa' where MaDanhMuc = '$maDM'";
                            if($conn->query($str)){
                                echo "<script>alert('Sửa thành công'); window.location.href='index.php?page=quanlyDM'</script>";
                            }else {
                                echo "<script>alert('Sửa thất bại'); window.location.href='index.php?page=quanlyDM'</script>";
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

    
</body>

</html>