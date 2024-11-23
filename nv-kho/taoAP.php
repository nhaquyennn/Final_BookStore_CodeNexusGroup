<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "layout/header.php" ?>

</head>

<body class="bg-theme bg-theme2">
    <div class="clearfix"></div>
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Start wrapper-->
            <div id="wrapper">

                <!--Start sidebar-wrapper-->
                <?php require_once "layout/left_sidebar.php" ?>
                <!--End sidebar-wrapper-->

                <!--Start topbar header-->
                <header class="topbar-nav">
                    <?php require_once "layout/topbar.php" ?>
                </header>
                <!--End topbar header-->

                <!--Start main content-->

                <!-- CODE Ở ĐÂY -->
                
                <div class="modal fade" id="modalThemSP" tabindex="-1" aria-labelledby="modalThemSPLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">THÔNG TIN SẢN PHẨM</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="#" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="">Tên sản phẩm</label>
                                    <input type="text" name="tenSP" id="tenSP" class="form-control" aria-describedby="tenSP-messs" onblur="test('#tenSP', kttenSP)">
                                    <small id="tenSP-mess"></small>
                                </div>

                                <div class="form-group">
                                    <label for="">Số lượng tồn</label>
                                    <input type="number" name="SLT" id="SLT" class="form-control" aria-describedby="SLT-messs" onblur="test('#SLT', ktEmail)">
                                    <small id="SLT-mess"></small>
                                </div>

                                <div class="form-group">
                                    <label for="">Mô tả</label>
                                    <input type="text" name="moTa" id="moTa" class="form-control" aria-describedby="moTa-messs" onblur="test('#moTa', ktSDT)">
                                    <small id="moTa-mess"></small>
                                </div>

                                <div class="form-group">
                                    <label for="">Giá bán</label>
                                    <input type="double" name="giaBan" id="giaBan" class="form-control" aria-describedby="giaBan-messs" onblur="test('#giaBan', ktQueQuan)">
                                    <small id="giaBan-mess"></small>
                                </div>

                                <div class="form-group">
                                    <label for="">Giá nhập</label>
                                    <input type="double" name="giaNhap" id="giaNhap" class="form-control" aria-describedby="giaNhap-messs" onblur="test('#giaNhap', ktQueQuan)">
                                    <small id="giaNhap-mess"></small>
                                </div>

                                <div class="form-group">
                                    <label for="">Thương hiệu</label>
                                    <input type="text" name="thuongHieu" id="thuongHieu" class="form-control" aria-describedby="thuongHieu-messs" onblur="test('#thuongHieu', ktSDT)">
                                    <small id="thuongHieu-mess"></small>
                                </div>

                                <div class="form-group">
                                    <label for="">Hình ảnh</label>
                                    <input type="file" name="fileAnh" class="form-control">
                                    <small id="hinhAnh-mess"></small>
                                </div>

                                <div class="form-group">
                                    <label for="">Hạn sử dụng</label>
                                    <input type="date" name="HSD" id="HSD" class="form-control" aria-describedby="HSD-messs" onblur="test('#HSD', ktSDT)">
                                    <small id="HSD-mess"></small>
                                </div>

                                <div class="form-group">
                                    <label for="">Loại sản phẩm</label>
                                    <!-- <select name="ChucVu" id="ChucVu" class="form-control">
                                                <option value="1">Nhân viên bán hàng</option>
                                                <option value="2">Nhân viên kho</option>
                                            </select>
                                            <small id="DiaChi-mess"></small> -->
                                    <?php
                                    include_once("Controller/cLoaiSP.php");
                                    $cloai = new CLoaiSP();
                                    $tbl = $cloai->getAllLoaiSP();

                                    if (mysqli_num_rows($tbl) > 0) {
                                        echo '<select name="LoaiSP" class="form-control">';
                                        while ($r = mysqli_fetch_assoc($tbl)) {
                                            echo '<option value="' . $r["MaLoai"] . '">' . $r["TenLoai"] . '</option>';
                                        }
                                        echo '</select>';
                                    }
                                    ?>
                                </div>

                                <div class="form-group">
                                    <label for="">Nhà cung cấp</label>
                                    <?php
                                    include_once("Controller/cNhaCC.php");
                                    $ce = new CNhaCC();
                                    $tbl = $ce->getAllNCC();

                                    if (mysqli_num_rows($tbl) > 0) {
                                        echo '<select name="nhaCC" class="form-control">';
                                        while ($r = mysqli_fetch_assoc($tbl)) {
                                            echo '<option value="' . $r["MaNhaCungCap"] . '">' . $r["TenNhaCungCap"] . '</option>';
                                        }
                                        echo '</select>';
                                    }
                                    ?>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                                <button type="submit" name="btnAddProd" class="btn btn-success">Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

                <div class="row">
                    <div class="col-9 col-lg-12">
                        <div class="taoPM">TẠO PHIẾU MƯỢN</div>
                        <form class="form-createPM col-12">
                            <table>
                                <tr>
                                    <td>Tên nhân viên:</td>
                                    <td><input type="text"></td>
                                </tr>
                                <tr>
                                    <td>Mã khách hàng:</td>
                                    <td><input type="text"></td>
                                    <td style="padding-left:12px">Tên khách hàng:</td>
                                    <td><input type="text"></td>
                                    <td style="padding-left:12px">Số điện thoại:</td>
                                    <td><input type="tel" id="phone" name="phone"></td>
                                </tr>
                                <tr>
                                    <td>Ngày mượn:</td>
                                    <td><input type="datetime-local" id="ngaymuon" name="ngaymuon"></td>
                                    <td style="padding-left:12px">Ngày trả:</td>
                                    <td><input type="datetime-local" id="ngaytra" name="ngaytra"></td>
                                </tr>
                                <table class="table align-items-center table-flush table-borderless">

                                    <div class="btn-add-AP col-12">
                                        <button type="button" class="btn btn-sm btn-success" style="font-size:15px;"
                                            data-toggle="modal" data-target="#myModal">Ấn phẩm</button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="myModal" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Modal Header</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Some text in the modal.</p>
                                                        àughgfuihafuye
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-detail">
                                        <table class="detail">
                                            <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Mã ấn phẩm</th>
                                                    <th>Tên ấn phẩm</th>
                                                    <th>Giá thuê</th>
                                                    <th>Cọc</th>
                                                    <th>Tình trạng</th>
                                                    <th>Ghi chú</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>AP367</td>
                                                    <td>Sách tiếng anh</td>
                                                    <td>20.000vnd</td>
                                                    <td>100.000vnd</td>
                                                    <td>..............</td>
                                                    <td>..............</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>AP456</td>
                                                    <td>Doraemon</td>
                                                    <td>20.000vnd</td>
                                                    <td>100.000vnd</td>
                                                    <td>..............</td>
                                                    <td>..............</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </table>
                                <div class="promotion">
                                    <input type="text" placeholder="Nhập mã khuyến mãi"
                                        style="background-color:grey; border-radius:5px; border:none; padding:7px">
                                    <button class="btn btn-sm btn-warning" style="font-size:12px;">Áp dụng</button>
                                </div>
                        </form>

                    </div>
                    <div class="btn-create" >
                        <a href="ctphieumuon.php"><button class="btn btn-sm btn-danger"
                                style="font-size:15px;">Tạo</button></a>

                    </div>
                </div>
            </div>
            <!--End main content-->

        </div>
        <!-- End wrapper-->

        <!--Start right sidebar-->
        <?php require_once "layout/right_sidebar.php" ?>
        <!--End right sidebar-->

        <!--Start footer-->
        <?php require_once "layout/script.php" ?>
        <!--End footer-->
    </div>
    </div>
</body>

</html>