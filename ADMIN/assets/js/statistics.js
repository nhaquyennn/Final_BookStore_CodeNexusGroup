document.addEventListener("DOMContentLoaded", function () {
  const statsLink = document.getElementById("statsLink");
  const dateList = document.getElementById("dateList");

  if (statsLink && dateList) {
    statsLink.addEventListener("click", function (event) {
      event.preventDefault(); // Ngăn chặn điều hướng mặc định
      // Hiển thị dateList khi nhấn vào "Thống kê ấn phẩm"
      dateList.style.display = "block";
    });
  } else {
    console.error("Không tìm thấy phần tử 'statsLink' hoặc 'dateList'");
  }
});
