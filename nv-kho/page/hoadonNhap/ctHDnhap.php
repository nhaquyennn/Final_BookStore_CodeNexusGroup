
<!DOCTYPE html>
<html lang="en">

<body class="bg-theme bg-theme2">
    <div class="clearfix"></div>
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Start wrapper-->
            <div id="wrapper">

            <div style="text-align:center; margin-top: 30px">
                <h4>HÓA ĐƠN NHẬP</h4>
            </div>
                
            <div class="row mt-4">
                <div class="col-9 col-lg-12">

                    <table class="table table-responsive table-bordered">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>Tên ấn phẩm</th>
                                <th>Mã đầu ấn phẩm</th>
                                <th>Nhà xuất bản</th>
                                <th>Năm xuất bản</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Tổng tiền</th>
                                <th>Mã hóa đơn</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?PHP
                             if (!isset($_GET['page'])) {
                                $page = 'ctHDnhap';
                            } else {
                                $page = $_GET['page'];
                            }
                            $conn = mysqli_connect(hostname: 'localhost', username: 'root', password: '', database: 'final_nexus');
                            if($conn){
                                $str = "select*from cthoadonnhap c inner join dauap d on c.maDauAP = d.maDauAP";
                                $result = $conn->query(query: $str);
                                if ($result->num_rows > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo"<tr>";
                                        echo "<td>".$row['TenAnPham']."</td>";
                                        echo "<td>".$row['madauAP']."</td>";
                                        echo "<td>".$row['NhaXB']."</td>";
                                        echo "<td>".$row['NamXB']."</td>";
                                        echo "<td>".$row['SoLuong']."</td>";
                                        echo "<td>".number_format(num: $row['DonGia'], decimals: 0, decimal_separator: ',', thousands_separator: '.')."</td>";
                                        echo "<td>".number_format(num: $row['TongTien'], decimals: 0, decimal_separator: ',', thousands_separator: '.')."</td>";
                                        echo "<td>".$row['maHoaDon']."</td>";
                                        echo "<td> <button class='btn btn-sm btn-primary'><i class='fa fa-eye'></i></button>
                                                    <button class='btn btn-warning btn-sm'><i class='fa fa-pencil ' aria-hidden='true'></i></button>
                                                    <button class='btn btn-danger btn-sm'>
                                                        <a href='guiYeuCauXoaDanhMuc.php'><i class='fa fa-trash-o' aria-hidden='true'></i></a></button>
                                            </td>";
                                        echo "</tr>";
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            </div>
        </div>
    </div>
</body>

</html>