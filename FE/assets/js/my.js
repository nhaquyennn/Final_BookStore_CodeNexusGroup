// Lấy tất cả các mục có lớp 'nav-link'
const navLinks = document.querySelectorAll('.sidebar-link');

// Duyệt qua từng mục và thêm sự kiện 'click'
navLinks.forEach(link => {
    link.addEventListener('click', function() {
        // Xóa lớp 'active' khỏi tất cả các mục
        navLinks.forEach(link => link.classList.remove('active'));

        // Thêm lớp 'active' vào mục được click
        this.classList.add('active');
    });
});
