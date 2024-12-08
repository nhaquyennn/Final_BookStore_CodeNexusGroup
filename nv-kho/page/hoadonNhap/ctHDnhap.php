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
                <hr>
                <div class="row mt-4">
                    <div class="col-9 col-lg-12">
                        <?php
                        if (isset($_GET['maHD'])) {
                            $maHD = $_GET['maHD'];  // Lấy mã hóa đơn từ URL
                        
                            // Kết nối cơ sở dữ liệu
                            $conn = mysqli_connect('localhost', 'root', '', 'final_nexus');

                            if ($conn) {
                                $str_name = "SELECT * FROM hoadonnhapap h inner join nhanvien n ON h.maNhanVien = n.maNhanVien WHERE maHoaDon = '$maHD'";
                                $result_name = $conn->query($str_name);

                                if ($result_name->num_rows > 0) {
                                    $row_name = mysqli_fetch_assoc($result_name);
                                    echo "<h5 > Tên hóa đơn: " . $row_name['TenHoaDon'] . "</h5> ";
                                    echo "<h5> Tên nhân viên: " . $row_name['tenNhanVien'] . "</h5>";
                                    echo "<h5> Ngày: " . $row_name['NgayTao'] . "</h5>";

                                    echo "<hr>";
                                }
                                // Truy vấn để lấy chi tiết hóa đơn theo mã hóa đơn
                                $str = "SELECT * FROM cthoadonnhap c 
                                            INNER JOIN hoadonnhapap h ON c.maHoaDon = h.maHoaDon
                                            WHERE c.maHoaDon = '$maHD'";  // Lọc theo mã hóa đơn
                                $result = $conn->query($str);

                                // Kiểm tra và hiển thị chi tiết hóa đơn
                                if ($result->num_rows > 0) {
                                    echo "<table class='table-HD table table-responsive '>
                                                <thead class='table-dark text-center'>
                                                    <tr>
                                                        <th>Tên đầu ấn phẩm</th>
                                                        <th>Tên danh mục</th>
                                                        <th>Nhà xuất bản</th>
                                                        <th>Số lượng</th>
                                                        <th>Đơn giá</th>
                                                        <th>Tổng </th>
                                                    </tr>
                                                </thead>
                                                <tbody>";

                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['TenAnPham'] . "</td>";
                                        echo "<td>" . $row['madauAP'] . "</td>";
                                        echo "<td>" . $row['NhaXB'] . "</td>";
                                        echo "<td>" . $row['SoLuong'] . "</td>";
                                        echo "<td>" . number_format($row['DonGia'], 0, ',', '.') . "</td>";
                                        echo "<td >" . number_format($row['tongTien'], 0, ',', '.') . "</td>";
                                        echo "</tr>";
                                    }

                                    echo "</tbody></table> <hr>";
                                    echo "<h5> Tổng cộng: " . number_format($row_name['TongTien'], 0, ',', '.') . "</h5>";
                                } else {
                                    echo "Không có chi tiết hóa đơn cho mã hóa đơn này.";
                                }
                            }
                        }

                        ?>
                        <a href="index.php?page=quanlyHDnhap" class="btn btn-secondary" name="quaylai">Quay lại</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>