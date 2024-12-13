<?php
// FE/rateProductHandler.php

// Bật hiển thị lỗi (chỉ trong môi trường phát triển)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Bắt đầu phiên làm việc nếu chưa bắt đầu
session_start();

// Bao gồm kết nối cơ sở dữ liệu và các hàm cần thiết
include_once 'database/db_connect.php';
include_once 'cart_functions.php';

// Kiểm tra người dùng đã đăng nhập chưa
if (!isset($_SESSION['maNguoiDung'])) {
    $_SESSION['errors'][] = "Vui lòng đăng nhập để đánh giá ấn phẩm.";
    header('Location: ../user/login.php');
    exit();
}

$maNguoiDung = intval($_SESSION['maNguoiDung']); // Lấy mã người dùng từ session
error_log("maNguoiDung từ session: " . $maNguoiDung); // Debug

// Kiểm tra xem 'id' có được truyền qua GET không
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['errors'][] = "Không tìm thấy ấn phẩm để đánh giá.";
    header('Location: rentedProducts.php');
    exit();
}

$maAnPham = intval($_GET['id']);
error_log("maAnPham: " . $maAnPham); // Debug

// Kiểm tra xem người dùng đã thuê ấn phẩm này và đơn hàng đã hoàn tất chưa
$sql_check_rental = "
    SELECT 
        ct.maAnPham
    FROM 
        chitietpm ct
    INNER JOIN 
        phieumuon pm ON ct.MaPhieuMuon = pm.MaPhieuMuon
    INNER JOIN
        khachhang kh ON pm.maKH = kh.maKH
    WHERE 
        kh.maNguoiDung = ? AND ct.maAnPham = ? AND pm.tinhTrang = 'Đã hoàn tất'
    LIMIT 1
";

$hasRented = false;

if ($stmt_check_rental = $conn->prepare($sql_check_rental)) {
    $stmt_check_rental->bind_param("ii", $maNguoiDung, $maAnPham);
    $stmt_check_rental->execute();
    $result_check_rental = $stmt_check_rental->get_result();
    if ($result_check_rental->num_rows > 0) {
        $hasRented = true;
    }
    $stmt_check_rental->close();
    error_log("Đã kiểm tra thuê sách: " . ($hasRented ? "Đúng" : "Sai"));
} else {
    $_SESSION['errors'][] = "Lỗi chuẩn bị câu truy vấn: " . $conn->error;
    error_log("Lỗi chuẩn bị câu truy vấn: " . $conn->error); // Debug
    header('Location: rentedProducts.php');
    exit();
}

if (!$hasRented) {
    $_SESSION['errors'][] = "Bạn chưa thuê ấn phẩm này hoặc đơn hàng chưa hoàn tất.";
    header('Location: rentedProducts.php');
    exit();
}

// Kiểm tra xem người dùng đã từng đánh giá ấn phẩm này chưa
$sql_check_rating = "
    SELECT 
        id 
    FROM 
        danhgia 
    WHERE 
        maNguoiDung = ? AND maAnPham = ? 
    LIMIT 1
";

$hasRated = false;

if ($stmt_check_rating = $conn->prepare($sql_check_rating)) {
    $stmt_check_rating->bind_param("ii", $maNguoiDung, $maAnPham);
    $stmt_check_rating->execute();
    $result_check_rating = $stmt_check_rating->get_result();
    if ($result_check_rating->num_rows > 0) {
        $hasRated = true;
    }
    $stmt_check_rating->close();
    error_log("Đã kiểm tra đánh giá: " . ($hasRated ? "Đã đánh giá" : "Chưa đánh giá"));
} else {
    $_SESSION['errors'][] = "Lỗi chuẩn bị câu truy vấn kiểm tra đánh giá: " . $conn->error;
    error_log("Lỗi chuẩn bị câu truy vấn kiểm tra đánh giá: " . $conn->error); // Debug
    header('Location: rentedProducts.php');
    exit();
}

if ($hasRated) {
    $_SESSION['errors'][] = "Bạn đã đánh giá ấn phẩm này trước đó và không thể đánh giá lại.";
    header('Location: shop-details.php?id=' . $maAnPham);
    exit();
}

// Xử lý form đánh giá khi người dùng submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $diemSo = isset($_POST['diemSo']) ? intval($_POST['diemSo']) : 0;
    $binhLuan = isset($_POST['binhLuan']) ? trim($_POST['binhLuan']) : '';
    $hinhAnh = '';

    error_log("Điểm số: " . $diemSo); // Debug
    error_log("Bình luận: " . $binhLuan); // Debug

    // Xử lý file upload (nếu có)
    if (isset($_FILES['hinhAnh']) && $_FILES['hinhAnh']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['hinhAnh']['tmp_name'];
        $fileName = $_FILES['hinhAnh']['name'];
        $fileSize = $_FILES['hinhAnh']['size'];
        $fileType = $_FILES['hinhAnh']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Định dạng file hợp lệ
        $allowedfileExtensions = array('jpg', 'jpeg', 'png', 'gif');

        if (in_array($fileExtension, $allowedfileExtensions)) {
            // Tạo tên file mới để tránh trùng lặp
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

            // Đường dẫn tới thư mục lưu hình ảnh
            $uploadFileDir = 'uploads/ratings/';
            if (!is_dir($uploadFileDir)) {
                mkdir($uploadFileDir, 0755, true);
            }
            $dest_path = $uploadFileDir . $newFileName;

            // Di chuyển file từ thư mục tạm tới thư mục lưu trữ
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $hinhAnh = 'ratings/' . $newFileName;
                error_log("Hình ảnh đã được tải lên: " . $hinhAnh); // Debug
            } else {
                $_SESSION['errors'][] = "Không thể tải hình ảnh lên. Vui lòng thử lại.";
                error_log("Không thể di chuyển file từ $fileTmpPath tới $dest_path"); // Debug
                header('Location: rateProduct.php?id=' . $maAnPham);
                exit();
            }
        } else {
            $_SESSION['errors'][] = "Chỉ cho phép tải lên các định dạng JPG, JPEG, PNG và GIF.";
            error_log("Định dạng file không hợp lệ: " . $fileExtension); // Debug
            header('Location: rateProduct.php?id=' . $maAnPham);
            exit();
        }
    }

    // Kiểm tra điểm số
    if ($diemSo < 1 || $diemSo > 5) {
        $_SESSION['errors'][] = "Vui lòng chọn điểm số từ 1 đến 5.";
        error_log("Điểm số không hợp lệ: " . $diemSo); // Debug
        header('Location: rateProduct.php?id=' . $maAnPham);
        exit();
    }

    // Lưu đánh giá vào cơ sở dữ liệu
    $sql_insert = "
        INSERT INTO danhgia (maNguoiDung, maAnPham, diemSo, binhLuan, hinhAnh)
        VALUES (?, ?, ?, ?, ?)
    ";

    if ($stmt_insert = $conn->prepare($sql_insert)) {
        $stmt_insert->bind_param("iiiss", $maNguoiDung, $maAnPham, $diemSo, $binhLuan, $hinhAnh);
        if ($stmt_insert->execute()) {
            error_log("Đánh giá đã được lưu thành công cho maAnPham: " . $maAnPham . ", maNguoiDung: " . $maNguoiDung);
            $_SESSION['success_update'] = "Đánh giá của bạn đã được lưu thành công.";
            header('Location: shop-details.php?id=' . $maAnPham); // Chuyển hướng về trang chi tiết sản phẩm
            exit();
        } else {
            // Kiểm tra lỗi do ràng buộc UNIQUE
            if ($conn->errno === 1062) { // 1062: Duplicate entry
                $_SESSION['errors'][] = "Bạn đã đánh giá ấn phẩm này trước đó và không thể đánh giá lại.";
            } else {
                $_SESSION['errors'][] = "Lỗi khi lưu đánh giá: " . $stmt_insert->error;
            }
            error_log("Lỗi khi lưu đánh giá: " . $stmt_insert->error);
            header('Location: rateProduct.php?id=' . $maAnPham);
            exit();
        }
        $stmt_insert->close();
    } else {
        $_SESSION['errors'][] = "Lỗi chuẩn bị câu truy vấn: " . $conn->error;
        error_log("Lỗi chuẩn bị câu truy vấn: " . $conn->error); // Debug
        header('Location: rateProduct.php?id=' . $maAnPham);
        exit();
    }
} else {
    // Nếu không phải là POST request, chuyển hướng về form đánh giá
    header('Location: rateProduct.php?id=' . $maAnPham);
    exit();
}
