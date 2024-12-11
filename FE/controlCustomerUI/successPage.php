<?php
// Kiểm tra nếu có tham số 'status' trong URL
$status = isset($_GET['status']) ? $_GET['status'] : '';

// Hiển thị thông báo và ghi chú nếu giao dịch thành công
if ($status == 'success') {
    echo "<div class='message-container success'>";
    echo "<h2>Giao dịch thành công!</h2>";
    echo "<p>Mời bạn đến trực tiếp cửa hàng để trả sách và hoàn cọc khi đọc xong nhé !</p>";
    
    // Các nút điều hướng
    echo "<a href='../index.php' class='button home-btn'>Trở về trang chủ</a>";
    echo "<a href='orderDetails.php' class='button order-btn'>Xem đơn hàng</a>";
    echo "</div>";
} else {
    echo "<div class='message-container error'>";
    echo "<h2>Có lỗi xảy ra trong quá trình thanh toán. Vui lòng thử lại!</h2>";
    echo "<a href='../index.php' class='button home-btn'>Trở về trang chủ</a>";
    echo "</div>";
}
?>

<!-- Thêm phần CSS trực tiếp vào file PHP -->
<style>
    /* Căn giữa trang */
    body {
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background-color: #f4f4f4;
    }

    /* Container chính cho thông báo */
    .message-container {
        background-color: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
        max-width: 500px;
        width: 100%;
    }

    /* Thông báo thành công */
    .message-container.success {
        border: 2px solid #4CAF50;
        color: #4CAF50;
    }

    .message-container.success h2 {
        color: #4CAF50;
    }

    /* Thông báo lỗi */
    .message-container.error {
        border: 2px solid #f44336;
        color: #f44336;
    }

    .message-container.error h2 {
        color: #f44336;
    }

    /* Style cho các nút */
    .button {
        display: inline-block;
        margin: 10px;
        padding: 10px 20px;
        font-size: 16px;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    /* Nút trang chủ */
    .home-btn {
        background-color: #4CAF50;
        color: white;
    }

    .home-btn:hover {
        background-color: #45a049;
    }

    /* Nút xem đơn hàng */
    .order-btn {
        background-color: #2196F3;
        color: white;
    }

    .order-btn:hover {
        background-color: #1e88e5;
    }
</style>
