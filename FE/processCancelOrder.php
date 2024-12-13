<?php
// FE/processCancelOrder.php

session_start();

include_once 'database/db_connect.php';



// Kiểm tra xem dữ liệu POST đã được gửi chưa
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: orderController.php');
    exit();
}

// Lấy và làm sạch dữ liệu từ POST
$maPhieuMuon = isset($_POST['MaPhieuMuon']) ? intval($_POST['MaPhieuMuon']) : 0;
$maKH = intval($_SESSION['maKH']);
$lyDoHuy = isset($_POST['lyDoHuy']) ? trim($_POST['lyDoHuy']) : '';
$soTaiKhoan = isset($_POST['soTaiKhoan']) ? trim($_POST['soTaiKhoan']) : '';

// Khởi tạo mảng lỗi
$errors = [];

// Kiểm tra tính hợp lệ của dữ liệu
if ($maPhieuMuon <= 0) {
    $errors[] = "Mã đơn hàng không hợp lệ.";
}

if (empty($lyDoHuy)) {
    $errors[] = "Vui lòng nhập lý do hủy đơn hàng.";
}

if (empty($soTaiKhoan)) {
    $errors[] = "Vui lòng nhập số tài khoản để hoàn tiền.";
} elseif (!preg_match('/^[0-9]{10,20}$/', $soTaiKhoan)) { // Giả sử số tài khoản là số từ 10 đến 20 chữ số
    $errors[] = "Số tài khoản không hợp lệ.";
}

if (empty($errors)) {
    // Kiểm tra xem đơn hàng có tồn tại, thuộc về khách hàng và đang ở trạng thái 'Đang xử lý' không
    $sql_check = "
        SELECT 
            MaPhieuMuon, tinhTrang
        FROM 
            phieumuon
        WHERE 
            MaPhieuMuon = ? AND maKH = ? AND tinhTrang = 'Đang xử lý'
    ";
    $stmt_check = $conn->prepare($sql_check);
    if (!$stmt_check) {
        die("Lỗi chuẩn bị câu truy vấn đơn hàng: " . htmlspecialchars($conn->error));
    }
    $stmt_check->bind_param("ii", $maPhieuMuon, $maKH);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows === 0) {
        $errors[] = "Không tìm thấy đơn hàng hoặc đơn hàng không thể hủy.";
    }

    $stmt_check->close();

    if (empty($errors)) {
        // Bắt đầu transaction để đảm bảo tính toàn vẹn dữ liệu
        $conn->begin_transaction();

        try {
            // Cập nhật trạng thái đơn hàng
            $sql_update = "
                UPDATE phieumuon
                SET tinhTrang = 'Đã hủy',
                    lyDoHuy = ?,
                    soTaiKhoan = ?
                WHERE MaPhieuMuon = ? AND maKH = ?
            ";
            $stmt_update = $conn->prepare($sql_update);
            if (!$stmt_update) {
                throw new Exception("Lỗi chuẩn bị câu truy vấn cập nhật đơn hàng: " . $conn->error);
            }
            $stmt_update->bind_param("ssii", $lyDoHuy, $soTaiKhoan, $maPhieuMuon, $maKH);
            $stmt_update->execute();

            if ($stmt_update->affected_rows === 0) {
                throw new Exception("Không thể cập nhật trạng thái đơn hàng.");
            }

            $stmt_update->close();

            // Commit transaction
            $conn->commit();

            // Chuyển hướng về danh sách đơn hàng với thông báo thành công
            header('Location: orderView.php?success=' . urlencode('Hủy đơn hàng thành công.'));
            exit();
        } catch (Exception $e) {
            // Rollback transaction
            $conn->rollback();

            $errors[] = "Lỗi khi hủy đơn hàng: " . $e->getMessage();
        }
    }
}

// Nếu có lỗi, chuyển hướng quay lại form với thông báo lỗi và dữ liệu cũ
$redirect_url = "cancelOrder.php?MaPhieuMuon=" . urlencode($maPhieuMuon);
if (!empty($lyDoHuy)) {
    $redirect_url .= "&lyDoHuy=" . urlencode($lyDoHuy);
}
if (!empty($soTaiKhoan)) {
    $redirect_url .= "&soTaiKhoan=" . urlencode($soTaiKhoan);
}
if (!empty($errors)) {
    $redirect_url .= "&error=" . urlencode(implode(", ", $errors));
}

header("Location: $redirect_url");
exit();
