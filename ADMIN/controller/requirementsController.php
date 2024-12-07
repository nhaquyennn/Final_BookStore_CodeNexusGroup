<?php
// Kết nối cơ sở dữ liệu
$host = 'localhost';
$username = 'root';
$password = 'root';
$dbname = 'nexus_store';

$conn = mysqli_connect($host, $username, $password, $dbname);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Lấy danh sách yêu cầu chưa duyệt
function getPendingRequests($conn)
{
    $sql = "SELECT * FROM requests WHERE status = 'pending'";
    $result = $conn->query($sql);
    $requests = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $requests[] = $row;
        }
    }
    return $requests;
}

// Duyệt yêu cầu xóa
function approveRequest($conn, $requestId)
{
    // Lấy thông tin yêu cầu
    $sql = "SELECT * FROM requests WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $requestId);
    $stmt->execute();
    $request = $stmt->get_result()->fetch_assoc();

    if (!$request) {
        return "Yêu cầu không tồn tại.";
    }

    // Xử lý xóa theo loại yêu cầu
    if ($request['type'] == 'delete_customer') {
        $sqlDelete = "DELETE FROM customers WHERE id = ?";
    } elseif ($request['type'] == 'delete_publication') {
        $sqlDelete = "DELETE FROM publications WHERE id = ?";
    } else {
        return "Loại yêu cầu không hợp lệ.";
    }

    $stmtDelete = $conn->prepare($sqlDelete);
    $stmtDelete->bind_param("i", $request['object_id']);
    if ($stmtDelete->execute()) {
        // Cập nhật trạng thái yêu cầu
        $sqlUpdate = "UPDATE requests SET status = 'approved' WHERE id = ?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param("i", $requestId);
        $stmtUpdate->execute();

        return "Yêu cầu đã được duyệt và đối tượng đã bị xóa.";
    } else {
        return "Xóa không thành công.";
    }
}

// Từ chối yêu cầu
function rejectRequest($conn, $requestId)
{
    $sql = "UPDATE requests SET status = 'rejected' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $requestId);

    if ($stmt->execute()) {
        return "Yêu cầu đã bị từ chối.";
    } else {
        return "Không thể từ chối yêu cầu.";
    }
}

// API xử lý yêu cầu (ví dụ minh họa)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    $requestId = $_POST['request_id'];

    if ($action == 'approve') {
        echo approveRequest($conn, $requestId);
    } elseif ($action == 'reject') {
        echo rejectRequest($conn, $requestId);
    } else {
        echo "Hành động không hợp lệ.";
    }
} else {
    // Lấy danh sách yêu cầu để hiển thị
    $requests = getPendingRequests($conn);
    echo json_encode($requests);
}

// Đóng kết nối
$conn->close();