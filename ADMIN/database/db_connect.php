<?php
function getDbConnection()
{
    $host = 'localhost';
    $username = 'root';
    $password = 'root';
    $dbname = 'nexus_store';

    // Kết nối MySQLi
    $conn = mysqli_connect($host, $username, $password, $dbname);

    // Kiểm tra kết nối
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}
