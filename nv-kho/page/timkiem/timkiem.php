<!DOCTYPE html>
<html lang="en">
<body class="bg-theme bg-theme2">
    <div class="clearfix"></div>
    <div class="content-wrapper">
        <div class="container-fluid">
            <div id="wrapper">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">DANH SÁCH</div>
                            <div class="table-responsive">
                                <?php
                                if (!isset($_GET['page'])) {
                                    $page = 'timkiem';
                                } else {
                                    $page = $_GET['page'];
                                }

                                $tim = $_SESSION['timkiem'] ?? '';
                                $loaiTimKiem = $_SESSION['loaiTimKiem'] ?? 'anpham';

                                $conn = mysqli_connect('localhost', 'root', '', 'final_nexus');

                                if ($conn) {
                                    if ($loaiTimKiem == 'anpham') {
                                        $sql = "SELECT * FROM anpham a LEFT JOIN dauap d ON a.madauAP = d.madauAP WHERE TenAnPham LIKE '%$tim%' OR TenDauAnPham LIKE '%$tim%'";
                                    } elseif ($loaiTimKiem == 'danhmuc') {
                                        $sql = "SELECT * FROM danhmucap WHERE TenDanhMuc LIKE '%$tim%'";
                                    } else if ($loaiTimKiem == 'dauap') {
                                        $sql = "SELECT * FROM dauap WHERE TenDauAnPham LIKE '%$tim%'";
                                    }

                                    $result = $conn->query($sql);

                                    if ($loaiTimKiem == 'anpham') {
                                        echo '<table class="table align-items-center table-flush table-borderless">';
                                        echo '<thead><tr>';
                                        echo '<th style="font-size: 15px;">Mã ấn phẩm</th>';
                                        echo '<th style="font-size: 15px;">Hình ảnh</th>';
                                        echo '<th style="font-size: 15px;">Tên ấn phẩm</th>';
                                        echo '<th style="font-size: 15px;">Tác giả</th>';
                                        echo '<th style="font-size: 15px;">Giá thuê</th>';
                                        echo '<th style="font-size: 15px;">Tình trạng</th>';
                                        echo '<th style="font-size: 15px;">Mã đầu ấn phẩm</th>';
                                        echo '<th style="font-size: 15px;">Tùy chọn</th>';
                                        echo '</tr></thead><tbody>';

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<tr>';
                                                echo "<td>{$row['maAnPham']}</td>";
                                                echo "<td><img src='img/{$row['hinhAnh']}' style='width:100px'></td>";
                                                echo "<td>{$row['TenAnPham']}</td>";
                                                echo "<td>{$row['Tacgia']}</td>";
                                                echo "<td>{$row['Giathue']}</td>";
                                                echo "<td>{$row['tinhTrang']}</td>";
                                                echo "<td>" . (isset($row['madauAP']) ? $row['madauAP'] : '<i>(Chưa phân loại)</i>') . "</td>";
                                                echo '<td>
                                                    <button class="btn btn-warning btn-sm"><a href="index.php?page=suaAP&maAP=' . $row['maAnPham'] . '"><i class="fa fa-pencil" aria-hidden="true"></i></a></button>
                                                    <button class="btn btn-danger btn-sm"><a href="index.php?page=xoaAP&maAP=' . $row['maAnPham'] . '"><i class="fa fa-trash-o" aria-hidden="true"></i></a></button>
                                                </td>';
                                                echo '</tr>';
                                            }
                                        } else {
                                            echo '<tr><td colspan="8">Không tìm thấy kết quả nào.</td></tr>';
                                        }

                                        echo '</tbody></table>';
                                    } else if ($loaiTimKiem == 'danhmuc') {
                                        echo '<table class="table align-items-center table-flush table-borderless">';
                                        echo '<thead><tr>';
                                        echo '<th style="font-size: 15px;">Mã danh mục</th>';
                                        echo '<th style="font-size: 15px;">Tên danh mục</th>';
                                        echo '<th style="font-size: 15px;">Mô tả</th>';
                                        echo '<th style="font-size: 15px;">Tùy chọn</th>';
                                        echo '</tr></thead><tbody>';

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<tr>';
                                                echo "<td>{$row['MaDanhMuc']}</td>";
                                                echo "<td>{$row['TenDanhMuc']}</td>";
                                                echo "<td>{$row['MoTa']}</td>";
                                                echo '<td>
                                                    <button class="btn btn-warning btn-sm"><a href="index.php?page=suaDM&maDM=' . $row['MaDanhMuc'] . '"><i class="fa fa-pencil" aria-hidden="true"></i></a></button>
                                                    <button class="btn btn-danger btn-sm"><a href="index.php?page=xoaDM&maDM=' . $row['MaDanhMuc'] . '"><i class="fa fa-trash-o" aria-hidden="true"></i></a></button>
                                                </td>';
                                                echo '</tr>';
                                            }
                                        } else {
                                            echo '<tr><td colspan="4">Không tìm thấy kết quả nào.</td></tr>';
                                        }

                                        echo '</tbody></table>';
                                    } else  if ($loaiTimKiem == 'dauap'){
                                        echo '<table class="table align-items-center table-flush table-borderless">';
                                        echo '<thead><tr>';
                                        echo '<th style="font-size: 15px;">Mã đầu ấn phẩm</th>';
                                        echo '<th style="font-size: 15px;">Hình ảnh</th>';
                                        echo '<th style="font-size: 15px;">Tên đầu ấn phẩm</th>';
                                        echo '<th style="font-size: 15px;">Tác giả</th>';
                                        echo '<th style="font-size: 15px;">Nhà xuất bản</th>';
                                        echo '<th style="font-size: 15px;">Số lượng</th>';
                                        echo '<th style="font-size: 15px;">Danh mục</th>';
                                        echo '<th style="font-size: 15px;">Tùy chọn</th>';
                                        echo '</tr></thead><tbody>';

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
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
                                        } else {
                                            echo '<tr><td colspan="3">Không tìm thấy kết quả nào.</td></tr>';
                                        }

                                        echo '</tbody></table>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
