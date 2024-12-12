<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'phuc';

// Kết nối MySQLi
$conn = mysqli_connect($host, $username, $password, $dbname);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}
?>