document
  .getElementById("statsLink")
  .addEventListener("click", function (event) {
    event.preventDefault();
    console.log("Đã nhấn vào Thống kê ấn phẩm"); // Kiểm tra

    const dateList = document.getElementById("dateList");
    if (dateList.style.display === "none" || dateList.style.display === "") {
      dateList.style.display = "block";
    } else {
      dateList.style.display = "none";
    }
  });
