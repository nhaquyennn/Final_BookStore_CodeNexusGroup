<!-- FE/errorPage.php -->
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Lỗi Hệ Thống</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .error-container {
            margin-top: 100px;
        }
    </style>
</head>

<body>
    <div class="container error-container">
        <div class="alert alert-danger text-center" role="alert">
            <h4 class="alert-heading">Hệ thống hiện đang gặp lỗi về vấn đề kĩ thuật!</h4>
            <p>Vui lòng thử lại sau.</p>
        </div>
    </div>

    <!-- Bootstrap JS (Bundle includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>