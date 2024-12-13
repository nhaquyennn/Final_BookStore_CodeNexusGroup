<?php
// FE/rateProduct.php

// Bắt đầu phiên làm việc nếu chưa bắt đầu
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Bao gồm kết nối cơ sở dữ liệu và các hàm cần thiết
include_once 'database/db_connect.php';
include_once 'cart_functions.php';


// Kiểm tra xem id đã được truyền qua GET chưa
if (isset($_GET['id'])) {
    $maAnPham = intval($_GET['id']);

    // Truy vấn để lấy thông tin sản phẩm
    include 'controlCustomerUI/controlProductDetails.php';

    if (!$product) {
        $_SESSION['errors'][] = "Không tìm thấy ấn phẩm để đánh giá.";
        header('Location: rentedProducts.php');
        exit();
    }
} else {
    $_SESSION['errors'][] = "Không tìm thấy ấn phẩm để đánh giá.";
    header('Location: rentedProducts.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đánh Giá Sản Phẩm</title>
    <!-- Thêm Bootstrap CSS từ CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Thêm Font Awesome để sử dụng icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../FE/css/rateProduct.css">
    <!-- Thêm CSS tùy chỉnh -->
</head>

<body>
    <!-- Navbar (Nếu bạn có) -->
    <?php include 'layout/header.php'; ?>

    <div class="container my-5">
        <!-- Hiển thị thông báo lỗi nếu có -->
        <?php if (!empty($_SESSION['errors'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    <?php
                    foreach ($_SESSION['errors'] as $error) {
                        echo "<li>" . htmlspecialchars($error) . "</li>";
                    }
                    unset($_SESSION['errors']);
                    ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Hiển thị thông báo thành công nếu có -->
        <?php if (!empty($_SESSION['success_update'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php
                echo htmlspecialchars($_SESSION['success_update']);
                unset($_SESSION['success_update']);
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="rating-form">
                    <!-- Header với hình ảnh và tên sản phẩm -->
                    <div class="rating-header text-center mb-4">
                        <img src="img/products/<?php echo htmlspecialchars($product['hinhAnh_dauap'] ?? 'default.png'); ?>" alt="<?php echo htmlspecialchars($product['TenAnPham']); ?>" class="img-fluid mb-3" style="max-width: 200px;">
                        <h2>Đánh Giá Ấn Phẩm: <?php echo htmlspecialchars($product['TenAnPham']); ?></h2>
                    </div>

                    <!-- Thông báo lỗi về điểm số -->
                    <div id="ratingError" class="alert alert-danger d-none" role="alert">
                        Vui lòng chọn điểm số đánh giá trước khi gửi.
                    </div>

                    <!-- Thông báo lỗi về bình luận -->
                    <div id="commentError" class="alert alert-danger d-none" role="alert">
                        Vui lòng nhập bình luận trước khi gửi.
                    </div>

                    <!-- Form đánh giá -->
                    <form id="ratingForm" action="rateProductHandler.php?id=<?php echo urlencode($maAnPham); ?>" method="POST" enctype="multipart/form-data">
                        <div class="mb-4">
                            <label class="form-label">Điểm Số:</label>
                            <div class="star-rating">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="far fa-star" data-value="<?php echo $i; ?>"></i>
                                <?php endfor; ?>
                                <input type="hidden" name="diemSo" id="diemSo" value="">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="binhLuan" class="form-label">Bình Luận:</label>
                            <textarea name="binhLuan" id="binhLuan" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="hinhAnh" class="form-label">Hình Ảnh (tùy chọn):</label>
                            <input type="file" name="hinhAnh" id="hinhAnh" class="form-control" accept="image/*">
                        </div>
                        <div class="row">
                            <div class="col-6 mb-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-paper-plane"></i> Gửi Đánh Giá
                                </button>
                            </div>
                            <div class="col-6 mb-2">
                                <a href="rentedProducts.php" class="btn btn-secondary w-100">
                                    <i class="fas fa-times"></i> Hủy Đánh Giá
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'layout/footer.php'; ?>


    <!-- Thêm JavaScript tùy chỉnh để xử lý đánh giá sao và kiểm tra điểm số & bình luận -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.star-rating i');
            const ratingInput = document.getElementById('diemSo');
            const ratingForm = document.getElementById('ratingForm');
            const ratingError = document.getElementById('ratingError');
            const commentError = document.getElementById('commentError');
            const binhLuan = document.getElementById('binhLuan');

            // Biến lưu trữ timeout để ẩn thông báo lỗi sau 5 giây
            let ratingErrorTimeout;
            let commentErrorTimeout;

            stars.forEach(star => {
                // Xử lý sự kiện click
                star.addEventListener('click', function() {
                    const rating = this.getAttribute('data-value');
                    ratingInput.value = rating;
                    updateStars(rating);
                    hideError('rating');
                });

                // Xử lý sự kiện hover
                star.addEventListener('mouseover', function() {
                    const rating = this.getAttribute('data-value');
                    updateStars(rating);
                });

                // Xử lý sự kiện mouseout
                star.addEventListener('mouseout', function() {
                    const currentRating = ratingInput.value;
                    updateStars(currentRating);
                });
            });

            function updateStars(rating) {
                stars.forEach(star => {
                    if (star.getAttribute('data-value') <= rating) {
                        star.classList.remove('far');
                        star.classList.add('fas');
                    } else {
                        star.classList.remove('fas');
                        star.classList.add('far');
                    }
                });
            }

            function showError(type) {
                if (type === 'rating') {
                    ratingError.classList.remove('d-none');
                    // Xóa timeout trước đó nếu có
                    clearTimeout(ratingErrorTimeout);
                    // Thiết lập timeout mới để ẩn thông báo sau 5 giây
                    ratingErrorTimeout = setTimeout(() => {
                        ratingError.classList.add('d-none');
                    }, 5000);
                } else if (type === 'comment') {
                    commentError.classList.remove('d-none');
                    // Xóa timeout trước đó nếu có
                    clearTimeout(commentErrorTimeout);
                    // Thiết lập timeout mới để ẩn thông báo sau 5 giây
                    commentErrorTimeout = setTimeout(() => {
                        commentError.classList.add('d-none');
                    }, 5000);
                }
            }

            function hideError(type) {
                if (type === 'rating') {
                    ratingError.classList.add('d-none');
                    clearTimeout(ratingErrorTimeout);
                } else if (type === 'comment') {
                    commentError.classList.add('d-none');
                    clearTimeout(commentErrorTimeout);
                }
            }

            // Kiểm tra điểm số và bình luận trước khi gửi form
            ratingForm.addEventListener('submit', function(event) {
                let hasError = false;

                // Kiểm tra điểm số
                if (ratingInput.value === "") {
                    event.preventDefault(); // Ngăn chặn việc gửi form
                    showError('rating'); // Hiển thị thông báo lỗi và thiết lập timeout
                    hasError = true;
                } else {
                    hideError('rating'); // Ẩn thông báo lỗi nếu đã chọn điểm số
                }

                // Kiểm tra bình luận
                if (binhLuan.value.trim() === "") {
                    event.preventDefault(); // Ngăn chặn việc gửi form
                    showError('comment'); // Hiển thị thông báo lỗi và thiết lập timeout
                    hasError = true;
                } else {
                    hideError('comment'); // Ẩn thông báo lỗi nếu đã nhập bình luận
                }

                // Nếu có lỗi, dừng thực hiện tiếp
                if (hasError) {
                    return;
                }
            });

            // Ẩn thông báo lỗi khi người dùng bắt đầu nhập bình luận
            binhLuan.addEventListener('input', function() {
                if (binhLuan.value.trim() !== "") {
                    hideError('comment');
                }
            });
        });
    </script>
</body>

</html>