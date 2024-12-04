<!DOCTYPE html>
<html lang="en">


                <!-- CODE Ở ĐÂY -->
                <div class="container">
                    <h4 class="text-center mb-4">PHIẾU GỬI YÊU CẦU XÓA ẤN PHẨM</h4>
                    <form action="submit_request.php" method="POST">
                        <!-- Tên nhân viên -->
                        <div class="mb-3">
                            <label for="employeeName" class="form-label">Tên nhân viên</label>
                            <input type="text" class="form-control" id="employeeName" name="employeeName" placeholder="Lấy tên nhân viên hiển thị lên" required>
                        </div>

                        <!-- Tên ấn phẩm -->
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Tên ấn phẩm cần xóa</label>
                            <input type="text" class="form-control" id="categoryName" name="categoryName" placeholder="Lấy tên ấn phẩm hiển thị lên" required>
                        </div>

                        <!-- Lý do xóa -->
                        <div class="mb-3">
                            <label for="reason" class="form-label">Lý do xóa</label>
                            <textarea class="form-control" id="reason" name="reason" rows="4" placeholder="Nhập lý do bạn muốn xóa ấn phẩm này" required></textarea>
                        </div>


                        <!-- File đính kèm -->
                        <div class="mb-3">
                            <label for="attachment" class="form-label">Tệp đính kèm (nếu có)</label>
                            <input type="file" class="form-control" id="attachment" name="attachment">
                        </div>

                        <!-- Nút Gửi Yêu Cầu -->
                        <div>
                            <a href="danhSachAP.php" class="btn btn-secondary">Quay lại</a>
                            <a href="danhSachAP.php"><button type="submit" class="btn btn-primary">Gửi yêu cầu</button></a>
                        </div>
                    </form>
                </div>
                <!--End main content-->

            </div>
            
        </div>
    </div>
</body>

</html>