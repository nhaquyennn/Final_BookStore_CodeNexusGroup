<?php
$host = 'localhost';
$username = 'hungnguyen2u@gmail.com';
$password = '123456';
$dbname = 'nexus_store';

// Kết nối MySQLi
$conn = mysqli_connect($host, $username, $password, $dbname);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}
