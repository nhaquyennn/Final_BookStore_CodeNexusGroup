<?php
// cart_functions.php

// Bao gồm kết nối cơ sở dữ liệu
include_once 'database/db_connect.php';

// Bắt đầu phiên làm việc nếu chưa bắt đầu
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/**
 * Hàm lấy giỏ hàng từ session
 *
 * @return array Giỏ hàng
 */
function get_cart()
{
    if (isset($_SESSION['shopping_cart']) && is_array($_SESSION['shopping_cart'])) {
        return $_SESSION['shopping_cart'];
    } else {
        return [];
    }
}

/**
 * Hàm lưu giỏ hàng vào session
 *
 * @param array $cart Giỏ hàng
 * @return void
 */
function save_cart($cart)
{
    $_SESSION['shopping_cart'] = $cart;
}

/**
 * Hàm lấy thông tin sản phẩm từ cơ sở dữ liệu
 *
 * @param int $product_id ID sản phẩm
 * @return array|null Thông tin sản phẩm hoặc null nếu không tìm thấy
 */
function get_product_info($product_id)
{
    global $conn;
    $sql = "SELECT 
                a.maAnPham,
                a.TenAnPham,
                a.Giathue,
                a.soLuongTonKho,
                d.moTa AS moTa_dauap,
                d.hinhAnh AS hinhAnh_dauap
            FROM anpham a
            JOIN dauap d ON a.madauAP = d.madauAP
            WHERE a.maAnPham = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $product = $result->fetch_assoc();
            $stmt->close();
            return $product;
        } else {
            $stmt->close();
            return null;
        }
    } else {
        // Nếu câu truy vấn bị lỗi
        error_log("Lỗi truy vấn get_product_info: " . $conn->error);
        return null;
    }
}

/**
 * Hàm tính tổng tiền giỏ hàng
 *
 * @param array $cart Giỏ hàng
 * @return float Tổng tiền
 */
function calculate_total($cart)
{
    $total = 0;
    foreach ($cart as $item) {
        // Kiểm tra xem khóa 'price' và 'quantity' có tồn tại không
        if (isset($item['price']) && isset($item['quantity'])) {
            $total += $item['price'] * $item['quantity'];
        } else {
            // Nếu không, ghi log hoặc xử lý lỗi
            error_log("Giỏ hàng thiếu khóa 'price' hoặc 'quantity' cho sản phẩm ID: " . htmlspecialchars($item['id']));
        }
    }
    return $total;
}

/**
 * Hàm lấy giỏ hàng từ DB
 *
 * @param int $user_id ID người dùng
 * @return array Giỏ hàng
 */

function get_cart_from_db($user_id)
{
    global $conn;

    // Thêm kiểm tra kết nối
    if (!$conn->ping()) {
        error_log("Kết nối đã bị đóng trước khi thực hiện get_cart_from_db.");
        return [];
    }

    // Thêm kiểm tra kiểu dữ liệu của $user_id
    if (!is_int($user_id) && !ctype_digit($user_id)) {
        error_log("Lỗi: get_cart_from_db được gọi với user_id không hợp lệ: " . var_export($user_id, true));
        return [];
    }

    $sql = "SELECT g.maAnPham, a.TenAnPham, a.Giathue, a.soLuongTonKho, d.hinhAnh AS hinhAnh_dauap, g.soLuong, g.ngayTra
              FROM giohang g
              JOIN anpham a ON g.maAnPham = a.maAnPham
              JOIN dauap d ON a.madauAP = d.madauAP
              WHERE g.maNguoiDung = ?";
    $cart = [];
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($item = $result->fetch_assoc()) {
            $cart[$item['maAnPham']] = [
                'id' => $item['maAnPham'],
                'name' => $item['TenAnPham'],
                'price' => $item['Giathue'],
                'image' => $item['hinhAnh_dauap'] ?? 'default.png',
                'quantity' => $item['soLuong'],
                'soLuongTonKho' => $item['soLuongTonKho'],
                'return_date' => $item['ngayTra']
            ];
        }
        $stmt->close();
    } else {
        error_log("Lỗi chuẩn bị câu truy vấn GET_CART: " . $conn->error);
    }
    return $cart;
}


/**
 * Hàm thêm vào giỏ hàng trong DB với return_date
 *
 * @param int $user_id ID người dùng
 * @param int $product_id ID sản phẩm
 * @param int $quantity Số lượng
 * @param string $return_date Ngày trả sách
 * @return void
 */
function add_to_cart_db($user_id, $product_id, $quantity, $return_date)
{
    global $conn;
    $sql = "INSERT INTO giohang (maNguoiDung, maAnPham, soLuong, ngayTra) VALUES (?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE soLuong = soLuong + VALUES(soLuong), ngayTra = VALUES(ngayTra)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("iiis", $user_id, $product_id, $quantity, $return_date);
        if (!$stmt->execute()) {
            error_log("Lỗi thực thi add_to_cart_db: " . $stmt->error);
        }
        $stmt->close();
    } else {
        error_log("Lỗi chuẩn bị câu truy vấn add_to_cart_db: " . $conn->error);
    }
}

/**
 * Hàm cập nhật giỏ hàng trong DB với return_date (nếu có)
 *
 * @param int $user_id ID người dùng
 * @param int $product_id ID sản phẩm
 * @param int $quantity Số lượng
 * @param string|null $return_date Ngày trả sách (nếu có)
 * @return void
 */
function update_cart_db($user_id, $product_id, $quantity, $return_date = null)
{
    global $conn;
    if ($quantity > 0) {
        if ($return_date) {
            $sql = "UPDATE giohang SET soLuong = ?, ngayTra = ? WHERE maNguoiDung = ? AND maAnPham = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("isii", $quantity, $return_date, $user_id, $product_id);
            }
        } else {
            $sql = "UPDATE giohang SET soLuong = ? WHERE maNguoiDung = ? AND maAnPham = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("iii", $quantity, $user_id, $product_id);
            }
        }
        if ($stmt) {
            if (!$stmt->execute()) {
                error_log("Lỗi thực thi update_cart_db: " . $stmt->error);
            }
            $stmt->close();
        }
    } else {
        // Nếu số lượng <= 0, xóa sản phẩm khỏi giỏ hàng
        remove_from_cart_db($user_id, $product_id);
    }
}

/**
 * Hàm xóa sản phẩm khỏi giỏ hàng trong DB
 *
 * @param int $user_id ID người dùng
 * @param int $product_id ID sản phẩm
 * @return bool Trả về true nếu thành công, ngược lại false
 * @throws Exception Nếu gặp lỗi kỹ thuật
 */
function remove_from_cart_db($user_id, $product_id)
{
    global $conn;

    if (!$conn) {
        throw new Exception("Lỗi kết nối cơ sở dữ liệu.");
    }

    $sql = "DELETE FROM giohang WHERE maNguoiDung = ? AND maAnPham = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('ii', $user_id, $product_id);
        if (!$stmt->execute()) {
            // Nếu execute thất bại, ném ngoại lệ
            $stmt->close();
            throw new Exception("Không thể xóa sản phẩm khỏi giỏ hàng.");
        }
        $affected_rows = $stmt->affected_rows;
        $stmt->close();
        return $affected_rows > 0;
    }
    // Nếu prepare thất bại, ném ngoại lệ
    throw new Exception("Lỗi kỹ thuật. Vui lòng thử lại sau.");
}

/**
 * Hàm xóa sản phẩm khỏi giỏ hàng trong session
 *
 * @param int $product_id ID sản phẩm
 * @return bool Trả về true nếu sản phẩm đã được xóa, ngược lại false
 */
function remove_from_cart_session($product_id)
{
    if (isset($_SESSION['shopping_cart'][$product_id])) {
        unset($_SESSION['shopping_cart'][$product_id]);
        $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
        return true;
    }
    return false;
}

/**
 * Hàm lấy thông báo và lỗi từ session
 *
 * @return array Thông báo và lỗi
 */
function get_messages()
{
    $messages = [];

    if (isset($_SESSION['errors'])) {
        $messages['errors'] = $_SESSION['errors'];
    }

    if (isset($_SESSION['success_update'])) {
        $messages['success_update'] = $_SESSION['success_update'];
    }

    if (isset($_SESSION['success_remove'])) {
        $messages['success_remove'] = $_SESSION['success_remove'];
    }

    return $messages;
}

/**
 * Hàm xóa thông báo sau khi đã lấy
 *
 * @return void
 */
function clear_messages()
{
    unset($_SESSION['errors']);
    unset($_SESSION['success_update']);
    unset($_SESSION['success_remove']);
}

/**
 * Hàm lấy sản phẩm trong giỏ hàng theo ID
 *
 * @param array $cart Giỏ hàng
 * @param int $product_id ID sản phẩm
 * @return array|null Sản phẩm hoặc null nếu không tìm thấy
 */
function get_product_by_id($cart, $product_id)
{
    foreach ($cart as $item) {
        if ($item['id'] == $product_id) {
            return $item;
        }
    }
    return null;
}

// Lấy giỏ hàng hiện tại
$maNguoiDung = $_SESSION['maNguoiDung'] ?? null;
if ($maNguoiDung) {
    $cart = get_cart_from_db($maNguoiDung);
} else {
    $cart = get_cart();
}

// Tính tổng tiền giỏ hàng
$total_price = calculate_total($cart);

/**
 * Hàm xử lý xóa sản phẩm khỏi giỏ hàng
 *
 * @param int $delete_id ID sản phẩm cần xóa
 * @return void
 */
function process_delete_product($delete_id)
{
    $cart = get_cart();
    $product_to_delete = get_product_by_id($cart, $delete_id);
    if (!$product_to_delete) {
        // Nếu sản phẩm không tồn tại trong giỏ hàng
        $_SESSION['errors'][] = "Sản phẩm không tồn tại trong giỏ hàng.";
        header("Location: shopping-cart.php");
        exit();
    }

    try {
        // Thực hiện xóa sản phẩm từ giỏ hàng
        if (isset($_SESSION['maNguoiDung'])) {
            // Người dùng đã đăng nhập, xóa từ DB
            if (remove_from_cart_db($_SESSION['maNguoiDung'], $delete_id)) {
                $_SESSION['shopping_cart'] = get_cart_from_db($_SESSION['maNguoiDung']);
                $_SESSION['success_remove'] = "Sản phẩm đã được xóa khỏi giỏ hàng.";
            } else {
                $_SESSION['errors'][] = "Không thể xóa sản phẩm khỏi giỏ hàng.";
            }
        } else {
            // Người dùng chưa đăng nhập, xóa từ session
            if (remove_from_cart_session($delete_id)) {
                $_SESSION['success_remove'] = "Sản phẩm đã được xóa khỏi giỏ hàng.";
            } else {
                $_SESSION['errors'][] = "Sản phẩm không tồn tại trong giỏ hàng.";
            }
        }
    } catch (Exception $e) {
        // Nếu gặp lỗi kỹ thuật, thiết lập thông báo lỗi
        $_SESSION['errors'][] = "Lỗi. Vui lòng thử lại sau.";
    }

    header("Location: shopping-cart.php");
    exit();
}

/**
 * Hàm xử lý cập nhật giỏ hàng
 *
 * @return void
 */
function process_update_cart()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_cart'])) {
        foreach ($_POST['quantities'] as $product_id => $quantity) {
            $quantity = intval($quantity);
            if ($quantity < 1) {
                // Nếu số lượng nhỏ hơn 1, xóa sản phẩm khỏi giỏ hàng
                if (isset($_SESSION['maNguoiDung'])) {
                    if (remove_from_cart_db($_SESSION['maNguoiDung'], $product_id)) {
                        $_SESSION['shopping_cart'] = get_cart_from_db($_SESSION['maNguoiDung']);
                        $_SESSION['success_remove'] = "Một số sản phẩm đã được xóa khỏi giỏ hàng.";
                    } else {
                        $_SESSION['errors'][] = "Không thể xóa sản phẩm với ID: " . htmlspecialchars($product_id);
                    }
                } else {
                    if (remove_from_cart_session($product_id)) {
                        $_SESSION['success_remove'] = "Một số sản phẩm đã được xóa khỏi giỏ hàng.";
                    } else {
                        $_SESSION['errors'][] = "Sản phẩm không tồn tại trong giỏ hàng.";
                    }
                }
            } else {
                // Cập nhật số lượng sản phẩm
                if (isset($_SESSION['maNguoiDung'])) {
                    // Người dùng đã đăng nhập, cập nhật trong DB
                    update_cart_db($_SESSION['maNguoiDung'], $product_id, $quantity);
                    $_SESSION['success_update'] = "Giỏ hàng đã được cập nhật.";
                } else {
                    // Người dùng chưa đăng nhập, cập nhật trong session
                    update_cart_session($product_id, $quantity);
                    $_SESSION['success_update'] = "Giỏ hàng đã được cập nhật.";
                }
            }
        }
        header("Location: shopping-cart.php");
        exit();
    }
}

/**
 * Hàm xử lý toàn bộ logic giỏ hàng
 *
 * @return void
 */
function handle_cart_logic()
{
    // Lấy giỏ hàng từ session
    $cart = get_cart();

    // Tính tổng tiền
    $total_price = calculate_total($cart);

    // Lấy thông báo và lỗi từ session
    $messages = get_messages();

    // Xóa thông báo sau khi đã lấy
    clear_messages();

    // Kiểm tra xem có yêu cầu xóa sản phẩm không
    if (isset($_GET['delete_id'])) {
        $delete_id = intval($_GET['delete_id']);
        if ($delete_id > 0) {
            process_delete_product($delete_id);
        }
    }

    // Xử lý cập nhật giỏ hàng
    process_update_cart();
}

/**
 * Hàm thêm vào giỏ hàng trong session với return_date
 *
 * @param int $product_id ID sản phẩm
 * @param int $quantity Số lượng
 * @param string $return_date Ngày trả sách
 * @return void
 */
function add_to_cart_session($product_id, $quantity, $return_date)
{
    // Lấy thông tin sản phẩm từ DB
    $product_info = get_product_info($product_id);
    if ($product_info) {
        // Tạo hoặc cập nhật giỏ hàng trong session
        if (isset($_SESSION['shopping_cart'][$product_id])) {
            $_SESSION['shopping_cart'][$product_id]['quantity'] += $quantity;
            $_SESSION['shopping_cart'][$product_id]['return_date'] = $return_date; // Cập nhật ngày trả
        } else {
            $_SESSION['shopping_cart'][$product_id] = [
                'id' => $product_id,
                'name' => $product_info['TenAnPham'],
                'price' => $product_info['Giathue'],
                'image' => $product_info['hinhAnh_dauap'] ?? 'default.png',
                'quantity' => $quantity,
                'soLuongTonKho' => $product_info['soLuongTonKho'],
                'return_date' => $return_date
            ];
        }
    } else {
        $_SESSION['errors'][] = "Sản phẩm không tồn tại.";
    }
}

/**
 * Hàm cập nhật giỏ hàng trong session với return_date (nếu có)
 *
 * @param int $product_id ID sản phẩm
 * @param int $quantity Số lượng
 * @param string|null $return_date Ngày trả sách (nếu có)
 * @return void
 */
function update_cart_session($product_id, $quantity, $return_date = null)
{
    if (isset($_SESSION['shopping_cart'][$product_id])) {
        if ($quantity > 0) {
            $_SESSION['shopping_cart'][$product_id]['quantity'] = $quantity;
            if ($return_date) {
                $_SESSION['shopping_cart'][$product_id]['return_date'] = $return_date;
            }
        } else {
            // Xóa sản phẩm nếu số lượng <= 0
            unset($_SESSION['shopping_cart'][$product_id]);
            $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
        }
    } else {
        $_SESSION['errors'][] = "Sản phẩm không tồn tại trong giỏ hàng.";
    }
}
