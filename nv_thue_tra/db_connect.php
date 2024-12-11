<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'final_nexus';

// Kết nối MySQLi
$conn = mysqli_connect($host, $username, $password, $dbname);
// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}
try {
    // Khởi tạo kết nối PDO
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Bật chế độ thông báo lỗi
} catch (PDOException $e) {
    die("Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage());
}
