#LƯU Ý ADMIN
1. Import database trong thư mục database.
2. Đổi tên database, username, password theo trên local trong file db_connect.php trong thư mục database.
3. Vào bảng tài khoản copy email, password là 123456 để đăng nhập với những tài khoản có vai trò là admin.

#LƯU Ý KHÁCH HÀNG
1. Import database trong thư mục database.
2. Đổi tên database, username, password theo trên local trong file db_connect.php trong thư mục database.
3. Vào bảng tài khoản copy email, password là 123456 để đăng nhập với những tài khoản có vai trò là khachhang.

#LƯU Ý GỬI MAIL RESET PASSWORD
1. Mặc định là mail sẽ được gửi từ địa chỉ: nhaquyenvo2003@gmail.com.
2. Trong database nên để mail người dùng là mail thật của cá nhân để nhận được mail, lưu ý nên tạo mới người dùng chứ đừng đổi email của những người dùng đã tồn tại trong database.
3. Khi tạo mới tài khoản trong database thì mật khẩu vào những trang web mã hóa md5 và mã hóa, sau đó copy mật khẩu đã mã hóa insert vào cột mật khẩu.
4. Hiện tại chưa hoàn thành chức năng đăng ký nên phiền mọi người thêm người dùng trực tiếp vào database.

#LƯU Ý ĐĂNG KÝ KHÁCH HÀNG
1. Hiện chưa thực hiện chức năng xác thực email nhưng có thể thực hiện đăng ký thông thường, nên dùng email thật của cá nhân để sau này có thể nhận được mail quên mật khẩu hoặc mail xác thực.
