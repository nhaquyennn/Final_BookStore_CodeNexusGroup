<?php
if (!isset($_GET['page'])) {
    $page = 'xoaDM';
} else {
    $page = $_GET['page'];
}
if (isset($_GET['maDM'])) {
    $maDM = $_GET['maDM'];
}
$conn = mysqli_connect(hostname: 'localhost', username: 'root', password: '', database: 'final_nexus');
$sql = "select*from danhmucap where MaDanhMuc = $maDM";
$result = $conn->query(query: $sql);
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc(result: $result)) {
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
                    <h4 class="text-center mb-4">XÓA DANH MỤC</h4>
                    <form method="POST" id="deleteForm">
                        <!-- Danh mục -->
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Danh mục</label>
                            <input type="text" class="form-control" id="DM" name="DM" value="<?php echo $tenDM ?>"
                                readonly>
                        </div>
                        <div class="mb-3">
                            <label for="employeeName" class="form-label">Mô tả</label>
                            <input type="text" class="form-control" id="moTa" name="moTa" value="<?php echo $moTa ?>"
                                readonly>
                        </div>

                        <!-- Nút Gửi Yêu Cầu -->
                        <div>
                            <a href="index.php?page=quanlyDM" class="btn btn-secondary">Hủy</a>
                            <button type="button" class="btn btn-danger" onclick="confirmDelete()">Xóa</button>
                        </div>
                    </form>
                    <script>
                        function confirmDelete() {
                            // Hiển thị hộp thoại xác nhận
                            var result = confirm("Bạn có chắc chắn muốn xóa danh mục này?");
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
                            $str = "DELETE FROM danhmucap WHERE MaDanhMuc = $maDM";
                            if ($conn->query($str)) {
                                echo "<script>alert('Xóa thành công'); window.location.href='index.php?page=quanlyDM'</script>";
                            } else {
                                echo "<script>alert('Xóa thất bại'); window.location.href='index.php?page=quanlyDM'</script>";
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