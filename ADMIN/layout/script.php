<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<!-- simplebar js -->
<script src="assets/plugins/simplebar/js/simplebar.js"></script>
<!-- sidebar-menu js -->
<script src="assets/js/sidebar-menu.js"></script>
<!-- loader scripts -->
<script src="assets/js/jquery.loading-indicator.js"></script>
<!-- Custom scripts -->
<script src="assets/js/app-script.js"></script>
<!-- Chart js -->

<script src="assets/plugins/Chart.js/Chart.min.js"></script>

<!-- Index js -->
<script src="assets/js/index.js"></script>

<script>
    // Biểu đồ sản phẩm thuê trong ngày
    var ctxRented = document.getElementById('rentedProductsChart').getContext('2d');
    var rentedProductsChart = new Chart(ctxRented, {
        type: 'bar',
        data: {
            labels: ['Sản phẩm A', 'Sản phẩm B', 'Sản phẩm C', 'Sản phẩm D', 'Sản phẩm E'],
            datasets: [{
                label: 'Số lượng sản phẩm thuê',
                data: [12, 19, 3, 5, 2],
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Biểu đồ doanh thu 7 ngày gần đây
    var ctxRevenue = document.getElementById('revenueChart').getContext('2d');
    var revenueChart = new Chart(ctxRevenue, {
        type: 'line',
        data: {
            labels: ['Ngày 1', 'Ngày 2', 'Ngày 3', 'Ngày 4', 'Ngày 5', 'Ngày 6', 'Ngày 7'],
            datasets: [{
                label: 'Doanh thu',
                data: [3000000, 2000000, 5000000, 4000000, 6000000, 7000000, 8000000],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2,
                fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>