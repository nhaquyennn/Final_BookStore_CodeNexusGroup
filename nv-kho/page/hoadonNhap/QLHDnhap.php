
<!DOCTYPE html>
<html lang="en">

<body class="bg-theme bg-theme2">
    <div class="clearfix"></div>
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Start wrapper-->
            <div id="wrapper">

                <div class="PM row">
                
                    <div class="btn-create-PM col-12">
                    <div STYLE="text-align:center"><h3>QUẢN LÝ HÓA ĐƠN NHẬP KHO</h3></div>
                        <a href="index.php?page=themHDnhapkho"><button class="btn btn-sm btn-success">Tạo hóa đơn</button></a>
                    </div>
                </div>
                
                <div class="row">
                
                    <div class="col-9 col-lg-12">
                    
                        <div class="card">
                            
                            <div class="card-header">DANH SÁCH </div>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush table-borderless">
                                    <thead>
                                        <tr>
                                            <th style="font-size: 15px;">Mã hóa đơn</th>
                                            <th style="font-size: 15px;">Tên hóa đơn</th>
                                            <th style="font-size: 15px;">Mã nhân viên</th>
                                            <th style="font-size: 15px;">Ngày tạo</th>
                                            <th style="font-size: 15px;">Nội dung</th>
                                            <th style="font-size: 15px;">Tổng tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if (!isset($_GET['page'])) {
                                                $page = 'quanlyHDnhap';
                                            } else {
                                                $page = $_GET['page'];
                                            }
                                            $conn = mysqli_connect(hostname: 'localhost', username: 'root', password: '', database: 'final_nexus');
                                            if($conn){
                                                $str = "select*from hoadonnhapap h inner join nhanvien n on h.maNhanVien = n.maNhanVien";
                                                $result = $conn->query(query: $str);
                                                if ($result->num_rows > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo"<tr>";
                                                        echo "<td>".$row['MaHoaDon']."</td>";
                                                        echo "<td>".$row['TenHoaDon']."</td>";
                                                        echo "<td>".$row['maNhanVien']."</td>";
                                                        echo "<td>".$row['NgayTao']."</td>";
                                                        echo "<td>".$row['NoiDung']."</td>";
                                                        echo "<td>".number_format(num: $row['TongTien'], decimals: 0, decimal_separator: ',', thousands_separator: '.')."</td>";
                                                        echo "<td> <button class='btn btn-sm btn-primary'><a href='index.php?page=chitietHD&maHD={$row["MaHoaDon"]}'><i class='fa fa-eye'></i></a></button>
                                                                    
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
        </div>
    </div>
</body>

</html>