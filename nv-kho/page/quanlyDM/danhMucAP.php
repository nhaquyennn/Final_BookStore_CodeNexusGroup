
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
                    <div STYLE="text-align:center"><h3>QUẢN LÝ DANH MỤC</h3></div>
                    <a href="index.php?page=themDM"><button class="btn btn-sm btn-success">Thêm danh mục</button></a>
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
                                            <th style="font-size: 15px;">Mã danh mục</th>
                                            <th style="font-size: 15px;">Tên danh mục</th>
                                            <th style="font-size: 15px;">Mô tả</th>
                                            <th style="font-size: 15px;">Tùy chọn</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                           if (!isset($_GET['page'])) {
                                            $page ='quanlyDM' ;
                                        } else {
                                            $page = $_GET['page'];
                                        }
                                            $conn = mysqli_connect(hostname: 'localhost', username: 'root', password: '', database: 'final_nexus');
                                            if($conn){
                                                $str = "select*from danhmucap";
                                                $result = $conn->query(query: $str);
                                                if ($result->num_rows > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo"<tr>";
                                                        echo "<td>" .$row['MaDanhMuc']. "</td>";
                                                        echo "<td>".$row['TenDanhMuc']. "</td>";
                                                        echo "<td>".$row['MoTa']. "</td>";
                                                        echo "<td> 
                                                                    <button class='btn btn-warning btn-sm'><a href='index.php?page=suaDM&maDM={$row["MaDanhMuc"]}'><i class='fa fa-pencil ' aria-hidden='true'></i></a></button>
                                                                    <button class='btn btn-danger btn-sm'>
                                                                        <a href='index.php?page=xoaDM&maDM={$row["MaDanhMuc"]}'><i class='fa fa-trash-o' aria-hidden='true'></i></a></button>
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