// validatePhone.js
function validatePhone() {
    var phoneInput = document.getElementById('phone');
    var phoneError = document.getElementById('phoneError');
    var phonePattern = /^0\d{9}$/;

    if (phonePattern.test(phoneInput.value)) {
        phoneError.style.display = 'none'; // Ẩn thông báo lỗi nếu hợp lệ
        phoneInput.setCustomValidity(''); // Reset lỗi tuỳ chỉnh
    } else {
        phoneError.style.display = 'inline'; // Hiển thị thông báo lỗi nếu không hợp lệ
        phoneInput.setCustomValidity('Số điện thoại không hợp lệ');
    }
}
