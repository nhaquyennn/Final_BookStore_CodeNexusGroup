
<?php
session_start();
// Kiểm tra nếu session 'user' không tồn tại 
if (!isset($_SESSION['user'])) {
  // Nếu chưa đăng nhập, chuyển hướng về trang login
header("Location: user/login.php?error=Vui lòng đăng nhập.");
exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once "layout/header.php";
    require_once "db_connect.php";
    ?>
</head>

<body class="bg-theme bg-theme2">
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Start wrapper-->
            <div id="wrapper">

                <!--Start sidebar-wrapper-->
                <?php require_once "layout/left_sidebar.php"; ?>
                <!--End sidebar-wrapper-->

                <!--Start topbar header-->
                <header class="topbar-nav">
                    <?php require_once "layout/topbar.php"; ?>
                </header>
                <!--End topbar header-->

                <!--Start main content-->
                <div class="PM row">
                    <div class="btn-create-PM col-12">
                        <h3 class="text-center text-white">QUẢN LÝ KHÁCH HÀNG</h3>
                        <a href="taothanhvien.php"><button class="btn btn-sm btn-success">Tạo thành viên</button></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-9 col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">DANH SÁCH KHÁCH HÀNG</h5>
                                <!-- Form tìm kiếm -->
                                <form method="GET" action="" style="display: flex; gap: 5px;">
                                    <input type="text" id="search" name="search" class="btn btn-sm"
                                        style="background-color: white; color: black;">
                                    <button type="submit" class="btn btn-sm btn-warning">Tìm</button>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Mã khách hàng</th>
                                            <th>Tên khách hàng</th>
                                            <th>Số điện thoại</th>
                                            <th>Địa chỉ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        try {
                                            // Lấy giá trị tìm kiếm từ input
                                            $search = isset($_GET['search']) ? $_GET['search'] : '';

                                            // Truy vấn SQL
                                            $query = "  SELECT khachhang.maKH, khachhang.tenKH, nguoidung.SDT, khachhang.diaChi
                                                        FROM khachhang
                                                        JOIN nguoidung ON khachhang.maNguoiDung = nguoidung.maNguoiDung
                                                        WHERE khachhang.tenKH LIKE ? OR nguoidung.SDT LIKE ?";

                                            $stmt = $conn->prepare($query);
                                            $searchTerm = "%" . $search . "%";
                                            $stmt->bind_param("ss", $searchTerm, $searchTerm);
                                            $stmt->execute();
                                            $result = $stmt->get_result();

                                            // Hiển thị dữ liệu
                                            if ($result && $result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>
                                                        <td>{$row['maKH']}</td>
                                                        <td>{$row['tenKH']}</td>
                                                        <td>{$row['SDT']}</td>
                                                        <td>{$row['diaChi']}</td>
                                                        <td> 
                                                            <a href='taoYCxoa.php?id={$row['maKH']}&name={$row['tenKH']}' class='btn btn-danger btn-sm text-white'>
                                                                <i class='fa fa-trash-o' aria-hidden='true'></i>
                                                            </a>
                                                        </td>
                                                    </tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='5'>Không tìm thấy khách hàng</td></tr>";
                                            }
                                        } catch (Exception $e) {
                                            echo "<tr><td colspan='5'>Lỗi: " . $e->getMessage() . "</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>