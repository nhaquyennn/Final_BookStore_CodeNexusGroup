<?php
 if (!isset($_GET['page'])) {
    $page ='themDM' ;
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
            <!-- Sidebar -->
           

            <!-- Form thêm phiếu nhập -->
            <div class="row mt-5">
                <div class="col-12">
                    <h4 class="fw-bold text-center">TẠO DANH MỤC</h4>
                    <form class="form-createAP" action="#" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Mã danh mục</label>
                            <input type="text" class="form-control" id="idDanhMuc" placeholder="Nhập mã danh mục" name="maDM">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Tên danh mục</label>
                            <input type="text" class="form-control" id="tenDanhMuc" placeholder="Nhập tên danh mục" name="tenDM">
                        </div>


                        <div class="mb-3">
                            <label class="form-label fw-bold">Mô tả</label>
                            <textarea type="text" class="form-control" id="tenAnPham" placeholder="Nhập mô tả" name="moTa"></textarea>
                        </div>

                        <div class="mt-4">
                            <a href="index.php?page=quanlyDM"><button type="submit" class="btn btn-primary" name="themDM">Tạo</button></a>
                            <a href="index.php?page=quanlyDM" class="btn btn-secondary" name="huy">Hủy</a>
                        </div>

                    </form>
                    <?php
                    if(isset($_POST['themDM'])){
                        $maDM = $_POST['maDM'];
                        $tenDM = $_POST['tenDM'];
                        $moTa = $_POST['moTa'];
                        if($conn){
                            $str= "insert into danhmucap (MaDanhMuc, TenDanhMuc, MoTa)
                                    values ('$maDM','$tenDM', '$moTa')";
                            if($conn->query($str)){
                                echo "<script>alert('Them thanh cong'); window.location.href='index.php?page=quanlyDM'</script>";
                            }else {
                                echo "<script>alert('Them that bai'); window.location.href='index.php?page=quanlyDM'</script>";
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

    
</body>

</html>