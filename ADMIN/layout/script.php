<!-- Các thư viện JS -->
<script src="/bookstore/ADMIN/assets/js/jquery.min.js"></script>
<script src="/bookstore/ADMIN/assets/js/popper.min.js"></script>
<script src="/bookstore/ADMIN/assets/js/bootstrap.min.js"></script>

<!-- simplebar js -->
<script src="/bookstore/ADMIN/assets/plugins/simplebar/js/simplebar.js"></script>
<!-- sidebar-menu js -->
<script src="/bookstore/ADMIN/assets/js/sidebar-menu.js"></script>
<!-- loader scripts -->
<script src="/bookstore/ADMIN/assets/js/jquery.loading-indicator.js"></script>
<!-- Custom scripts -->
<script src="/bookstore/ADMIN/assets/js/app-script.js"></script>
<!-- Chart js -->
<script src="/bookstore/ADMIN/assets/plugins/Chart.js/Chart.min.js"></script>
<!-- Index js -->
<script src="/bookstore/ADMIN/assets/js/index.js"></script>

<script>
    // Biểu đồ sản phẩm thuê trong ngày
    var ctxRented = document.getElementById('rentedProductsChart').getContext('2d');
    var rentedProductsChart = new Chart(ctxRented, {
        type: 'bar',
        data: {
            labels: ['Sản phẩm A', 'Sản phẩm B', 'Sản phẩm C', 'Sản phẩm D', 'Sản phẩm E'], // Tên các sản phẩm
            datasets: [{
                label: 'Số lượng sản phẩm thuê', // Nhãn biểu đồ
                data: [12, 19, 3, 5, 2], // Số lượng sản phẩm thuê
                backgroundColor: 'rgba(54, 162, 235, 0.5)', // Màu nền
                borderColor: 'rgba(54, 162, 235, 1)', // Màu viền
                borderWidth: 1 // Độ dày viền
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true // Bắt đầu trục Y từ 0
                }
            }
        }
    });

    // Biểu đồ doanh thu 7 ngày gần đây
    var ctxRevenue = document.getElementById('revenueChart').getContext('2d');
    var revenueChart = new Chart(ctxRevenue, {
        type: 'line',
        data: {
            labels: ['Ngày 1', 'Ngày 2', 'Ngày 3', 'Ngày 4', 'Ngày 5', 'Ngày 6', 'Ngày 7'], // Các ngày
            datasets: [{
                label: 'Doanh thu', // Nhãn biểu đồ
                data: [3000000, 2000000, 5000000, 4000000, 6000000, 7000000, 8000000], // Doanh thu từng ngày
                backgroundColor: 'rgba(255, 99, 132, 0.2)', // Màu nền
                borderColor: 'rgba(255, 99, 132, 1)', // Màu đường
                borderWidth: 2, // Độ dày đường
                fill: true // Có tô màu hay không
            }]
        },
        options: {
            responsive: true, // Biểu đồ responsive
            scales: {
                y: {
                    beginAtZero: true // Bắt đầu trục Y từ 0
                }
            }
        }
    });
</script>