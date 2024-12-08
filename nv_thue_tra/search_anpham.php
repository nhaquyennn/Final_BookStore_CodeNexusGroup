<?php
require_once "db_connect.php";

if (isset($_GET['query'])) {
    $query = $_GET['query'];
    $sql = "SELECT maAnPham, TenAnPham, giaThue, tinhTrang 
            FROM anpham 
            WHERE TenAnPham LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%" . $query . "%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
    $stmt->close();
}
$conn->close();
