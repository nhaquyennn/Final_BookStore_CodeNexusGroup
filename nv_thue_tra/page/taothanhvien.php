<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body class="bg-theme bg-theme2">
    <div class="content-wrapper">
        <div class="container-fluid">
            <div id="wrapper">
                <div class="container mt-5">
                    <h3 class="text-center text-white">Tạo Thành Viên</h3>
                    <form>
                        <div class="form-group">
                            <label for="username" class="text-white">Email:</label>
                            <input type="email" class="form-control" placeholder="Nhập email của bạn" replaced>
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-white">Mật khẩu:</label>
                            <input type="password" class="form-control" placeholder="Nhập mật khẩu (ít nhất 8 ký tự)">
                        </div>
                        <div class="form-group">
                            <label for="customerId" class="text-white">Mã khách hàng:</label>
                            <input type="text" class="form-control" value="KH6321" readonly>
                        </div>
                        <div class="form-group">
                            <label for="customerName" class="text-white">Tên khách hàng:</label>
                            <input type="text" class="form-control" placeholder="Nhập tên khách hàng">
                        </div>
                        <div class="form-group">
                            <label for="customerName" class="text-white">Số điện thoại:</label>
                            <input type="tel" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="address" class="text-white">Địa chỉ:</label>
                            <input type="text" class="form-control" placeholder="Nhập địa chỉ khách hàng">
                        </div>
                        <button type="button" class="btn btn-success">Tạo</button>
                        <button type="button" class="btn btn-danger">Hủy</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>