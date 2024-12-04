<?php
 if (!isset($_GET['page'])) {
    $page ='xoaDM' ;
} else {
    $page = $_GET['page'];
}
$conn = mysqli_connect(hostname: 'localhost', username: 'root', password: '', database: 'final_nexus');
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
                        <!-- Tên nhân viên -->
                        <div class="mb-3">
                            <label for="employeeName" class="form-label">Mã nhân viên</label>
                            <input type="text" class="form-control" id="employeeName" name="employeeName" placeholder="Nhập mã nhân viên" required>
                        </div>
                        <div class="mb-3">
                            <label for="employeeName" class="form-label">Tên nhân viên</label>
                            <input type="text" class="form-control" id="employeeName" name="employeeName" placeholder="Nhập tên nhân viên" required>
                        </div>

                        <!-- Danh mục -->
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Danh mục</label>
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
                        <div class="mb-3">
                            <label for="employeeName" class="form-label">Mô tả</label>
                            <input type="text" class="form-control" id="employeeName" name="employeeName" required>
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
                </div>
                <!--End main content-->

            </div>
        </div>
    </div>
</body>

</html>