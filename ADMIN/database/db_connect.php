<?php
$host = 'localhost';
$username = 'vminhthinh03@gmail.com';
$password = 'thinh497';
$dbname = 'nexus_store';

// Kết nối MySQLi
$conn = mysqli_connect($host, $username, $password, $dbname);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}
