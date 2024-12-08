
<!DOCTYPE html>
<html lang="en">

<head>

</head>

<body class="bg-theme bg-theme2">
    <div class="clearfix"></div>
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Start wrapper-->
            <div id="wrapper">
                <!-- CODE Ở ĐÂY -->
                <div class="PM row">
                    <div class="btn-create-PM col-12">
                    <div STYLE="text-align:center"><h3>QUẢN LÝ ĐẦU ẤN PHẨM</h3></div>
                        <a href="index.php?page=themDAP"><button class="btn btn-sm btn-success">Thêm đầu ấn phẩm</button></a>
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
                                            <th style="font-size: 15px;">Mã đầu ấn phẩm</th>
                                            <th style="font-size: 15px;">Hình ảnh</th>
                                            <th style="font-size: 15px;">Tên đầu ấn phẩm</th>
                                            <th style="font-size: 15px;">Tác giả</th>
                                            <th style="font-size: 15px;">Nhà xuất bản</th>
                                            <th style="font-size: 15px;">Số lượng</th>
                                            <th style="font-size: 15px;">Danh mục</th>
                                            <th style="font-size: 15px;">Tùy chọn</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        if (!isset($_GET['page'])) {
                                            $page ='quanlydauAP' ;
                                        }else {
                                            $page = $_GET['page'];
                                        }
                                        $conn = mysqli_connect(hostname: 'localhost', username: 'root', password: '', database: 'final_nexus');
                                        if($conn){
                                            $str = "select * from dauap as a LEFT JOIN danhmucap as m on a.MaDanhMuc = m.MaDanhMuc;";
                                            $result = $conn->query(query: $str);
                                            if ($result->num_rows > 0) {
                                                while ($row = mysqli_fetch_assoc(result: $result)) {
                                                    echo"<tr>";
                                                    echo "<td>" .$row['madauAP']. "</td>";
                                                    echo "<td><img src='img/{$row['hinhAnh']}' style='width:100px'></td>";
                                                    echo "<td>".$row['TenDauAnPham']. "</td>";
                                                    echo "<td>".$row['Tacgia']. "</td>";
                                                    echo "<td>".$row['NXB']. "</td>";
                                                    echo "<td>".$row['Tongsoluong']. "</td>";
                                                    $tenDanhMuc = isset($row['TenDanhMuc']) ? $row['TenDanhMuc'] : '<i>(Chưa phân loại)</i>';
                                                    echo "<td>".$tenDanhMuc. "</td>";
                                                    echo "<td> 
                                                                <button class='btn btn-warning btn-sm'><a href='index.php?page=suaDAP&maDAP={$row["madauAP"]}'><i class='fa fa-pencil ' aria-hidden='true'></i></a></button>
                                                                    <button class='btn btn-danger btn-sm'>
                                                                        <a href='index.php?page=xoaDAP&maDAP={$row["madauAP"]}'><i class='fa fa-trash-o' aria-hidden='true'></i></a></button>
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