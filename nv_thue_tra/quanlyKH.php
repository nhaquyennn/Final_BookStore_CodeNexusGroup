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
                            <div class="card-header">DANH SÁCH KHÁCH HÀNG</div>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Mã khách hàng</th>
                                            <th>Tên khách hàng</th>
                                            <th>Địa chỉ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        try {
                                            $query = "SELECT maKH, tenKH, diaChi FROM khachhang";
                                            $result = $conn->query($query);

                                            if ($result && $result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>
                                                        <td>{$row['maKH']}</td>
                                                        <td>{$row['tenKH']}</td>
                                                        <td>{$row['diaChi']}</td>
                                                        <td> 
                                                            <a href='taoYCxoa.php?id={$row['maKH']}&name={$row['tenKH']}' class='btn btn-danger btn-sm text-white'><i class='fa fa-trash-o' aria-hidden='true'></i></a>
                                                        </td>
                                                    </tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='4'>Không có khách hàng nào</td></tr>";
                                            }
                                        } catch (Exception $e) {
                                            echo "<tr><td colspan='4'>Lỗi: " . $e->getMessage() . "</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End main content-->

            </div>
            <!-- End wrapper-->

            <!--Start right sidebar-->
            <!--End right sidebar-->

            <!--Start footer-->
            <!--End footer-->
        </div>
    </div>
</body>

</html>