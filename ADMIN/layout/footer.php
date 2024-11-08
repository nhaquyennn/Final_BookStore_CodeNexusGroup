<?php
// Định nghĩa BASE_URL nếu cần thiết
define('BASE_URL', '/Final_BookStore_CodeNexusGroup/ADMIN/');

// Mảng chứa các đường dẫn tệp JavaScript
$scripts = [
    'assets/js/jquery.min.js',
    'assets/js/popper.min.js',
    'assets/js/bootstrap.min.js',
    'assets/plugins/simplebar/js/simplebar.js',
    'assets/js/sidebar-menu.js',
    'assets/js/jquery.loading-indicator.js',
    'assets/js/app-script.js',
    'assets/plugins/Chart.js/Chart.min.js',
    'assets/js/statistics.js',
    'assets/js/index.js'
];

// Vòng lặp foreach để thêm các tệp JavaScript vào footer
foreach ($scripts as $script) {
    echo '<script src="' . BASE_URL . $script . '"></script>' . PHP_EOL;
}
?>
