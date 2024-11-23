const products = {
  giaokhoa: [
    {
      id: "SP001",
      name: "Toán 12",
      price: "50,000 VND",
      image: "https://via.placeholder.com/80",
    },
    {
      id: "SP002",
      name: "Lý 12",
      price: "60,000 VND",
      image: "https://via.placeholder.com/80",
    },
  ],
  thamkhao: [
    {
      id: "SP003",
      name: "Hóa 12",
      price: "70,000 VND",
      image: "https://via.placeholder.com/80",
    },
    {
      id: "SP004",
      name: "Sinh 12",
      price: "65,000 VND",
      image: "https://via.placeholder.com/80",
    },
  ],
};

function showProducts(category) {
  const container = document.getElementById("products-container");
  container.innerHTML = ""; // Xóa nội dung cũ

  if (!products[category] || products[category].length === 0) {
    container.innerHTML =
      "<p class='text-muted'>Không có sản phẩm nào trong danh mục này.</p>";
    return;
  }

  let tableHTML = `
    <table class="table table-custom">
      <thead>
        <tr>
          <th>Hình ảnh</th>
          <th>Tên Sản Phẩm</th>
          <th>Mã</th>
          <th>Giá</th>
        </tr>
      </thead>
      <tbody>
  `;

  products[category].forEach((product) => {
    tableHTML += `
      <tr>
        <td><img src="${product.image}" alt="${product.name}" class="rounded"></td>
        <td>${product.name}</td>
        <td>${product.id}</td>
        <td>${product.price}</td>
      </tr>
    `;
  });

  tableHTML += `
      </tbody>
    </table>
  `;

  container.innerHTML = tableHTML;
}
