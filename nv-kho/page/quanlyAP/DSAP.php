
<!DOCTYPE html>
<html lang="en">

<body class="bg-theme bg-theme2">
    <div class="clearfix"></div>
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Start wrapper-->
            <div id="wrapper">
                <!-- CODE Ở ĐÂY -->
                <div class="PM row">
                    <div class="btn-create-PM col-12">
                    <div STYLE="text-align:center"><h3>QUẢN LÝ ẤN PHẨM</h3></div>
                        <a href="index.php?page=themAP"><button class="btn btn-sm btn-success">Thêm ấn phẩm</button></a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-9 col-lg-12">
                    
                        <div class="card">
                            <div class="card-header">DANH SÁCH</div>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush table-borderless">
                                    <thead>
                                        <tr>
                                            <th style="font-size: 15px;">Mã ấn phẩm</th>
                                            <th style="font-size: 15px;">Hình ảnh</th>
                                            <th style="font-size: 15px;">Tên ấn phẩm</th>
                                            <th style="font-size: 15px;">Tác giả</th>
                                            <th style="font-size: 15px;">Giá thuê</th>
                                            <th style="font-size: 15px;">Tình trạng</th>
                                            <th style="font-size: 15px;">Mã đầu ấn phẩm</th>
                                            <th style="font-size: 15px;">Tùy chọn</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        if (!isset($_GET['page'])) {
                                            $page ='quanlyAP' ;
                                        } else {
                                            $page = $_GET['page'];
                                        }
                                        $conn = mysqli_connect(hostname: 'localhost', username: 'root', password: '', database: 'final_nexus');
                                        if($conn){
                                            $str = "select * from anpham as a LEFT JOIN dauap as d on a.madauAP = d.madauAP;";
                                            $result = $conn->query(query: $str);
                                            if ($result->num_rows > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo"<tr>";
                                                    echo "<td>" .$row['maAnPham']. "</td>";
                                                    echo "<td><img src='img/{$row['hinhAnh']}' style='width:100px'></td>";
                                                    echo "<td>".$row['TenAnPham']. "</td>";
                                                    echo "<td>".$row['Tacgia']. "</td>";
                                                    echo "<td>".$row['Giathue']. "</td>";
                                                    echo "<td>".$row['tinhTrang']. "</td>";
                                                    $maDAP = isset($row['madauAP']) ? $row['madauAP'] : '<i>(Chưa phân loại)</i>';
                                                    echo "<td>".$maDAP ."</td>";
                                                    
                                                    echo "<td>  <button class='btn btn-warning btn-sm'><a href='index.php?page=suaAP&maAP={$row["maAnPham"]}'><i class='fa fa-pencil ' aria-hidden='true'></i></a></button>
                                                                    <button class='btn btn-danger btn-sm'>
                                                                        <a href='index.php?page=xoaAP&maAP={$row["maAnPham"]}'><i class='fa fa-trash-o' aria-hidden='true'></i></a></button>
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
                <!--End main content-->

            </div>
            <!-- End wrapper-->

        </div>
    </div>
</body>

</html>