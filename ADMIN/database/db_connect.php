<?php
$host = 'localhost';
$username = 'root'; #đặt tên biến usename trùng với username tạo trong MAMP/XAMPP 
$password = 'root'; #đặt tên biến password trùng với username tạo trong MAMP/XAMPP 
$dbname = 'nexus_store';

// Kết nối MySQLi
$conn = mysqli_connect($host, $username, $password, $dbname);

// Kiểm tra kết nối
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connected successfully";
}
