
<?php
session_start();
// Kiểm tra nếu session 'user' không tồn tại 
if (!isset($_SESSION['user'])) {
  // Nếu chưa đăng nhập, chuyển hướng về trang login
  header("Location: user/login.php?error=Vui lòng đăng nhập.");
  exit();
}
?>
<?php
 if (!isset($_GET['page'])) {
    $page ='suaAP' ;
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
        $tenAP = $row['TenAnPham'];
        $giaThue = $row['Giathue'];
        $tinhTrang = $row['tinhTrang'];
        $maDAP = $row['madauAP'];
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
                    <h4 class="fw-bold text-center">SỬA ẤN PHẨM</h4>
                    <form class="form-createAP" action="#" method="POST" enctype="multipart/form-data">
                        

                        <div class="mb-3">
                            <label class="form-label fw-bold">Tên ấn phẩm</label>
                            <input type="text" class="form-control" id="tenDanhMuc" value="<?php echo $tenAP?>" name="tenAP" required>
                        </div>


                        <div class="mb-3">
                            <label class="form-label fw-bold">Giá thuê</label>
                            <input type="number" class="form-control" id="moTa" value="<?php echo $giaThue ?>" name="giaThue" required>
                        </div>
                        <div class="mb-3">
                                <label class="form-label fw-bold">Tình trạng</label>
                                <input type="text" class="form-control" id="NXB" value="<?php echo $tinhTrang ?>" name="tinhTrang" required>
                        </div>
                        <div class="mb-3">
                                <label class="form-label fw-bold">Đầu ấn phẩm</label>
                                <select id="book-category" name="dauAP">
                                <?php
                                $sql = "SELECT madauAP, TenDauAnPham FROM dauap";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['madauAP'] . "'>" . $row['madauAP'] . " - " . $row['TenDauAnPham'] ."</option>";
                                    }
                                }
                                ?>
                                </select>
                        </div>
                    </div>

                       
                        <div class="mt-4 ml-3">
                            <input type="submit" class="btn btn-primary" name="suaAP" value="Lưu"></input>
                            <a href="index.php?page=quanlyAP" class="btn btn-secondary" name="huy">Hủy</a>
                        </div>

                    </form>
                    <?php
                    if(isset($_POST['suaAP'])){
                        $tenAP = $_POST['tenAP'];
                        $giaThue = $_POST['giaThue'];
                        $tinhTrang= $_POST['tinhTrang'];
                        $DAP = $_POST['dauAP'];
                            if($conn){
                                $str= "update anpham set TenAnPham = '$tenAP' , Giathue = '$giaThue', tinhTrang = '$tinhTrang', madauAP = '$DAP' where maAnPham = '$maAP'";
                                if($conn->query($str)){
                                    echo "<script>alert('Sửa thành công'); window.location.href='index.php?page=quanlyAP'</script>";
                                }else {
                                    echo "<script>alert('Sửa thất bại'); window.location.href='index.php?page=quanlyAP'</script>";
                                }
                            }
                    }
                    ?>
                </div>
            </div>
        </div>

    
</body>

</html>