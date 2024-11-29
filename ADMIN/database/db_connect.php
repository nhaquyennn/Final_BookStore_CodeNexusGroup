<?php
function getDbConnection()
{
    $host = 'localhost';     // Tên host (hoặc IP)
    $username = 'root';      // Tên người dùng MySQL
    $password = 'root';      // Mật khẩu MySQL (trên MAMP mặc định là 'root')
    $dbname = 'nexus_store'; // Tên database của bạn

    // Tạo kết nối MySQLi
    $conn = mysqli_connect($host, $username, $password, $dbname);

    // Kiểm tra kết nối
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $conn;
}

function closeDbConnection($conn)
{
    mysqli_close($conn);
}
