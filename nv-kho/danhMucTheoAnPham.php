<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once "layout/header.php" ?>
  <title>Danh Sách Ấn Phẩm</title>
  <style>
    /* Bổ sung style cho bảng */
    .table th,
    .table td {
      text-align: center;
      vertical-align: middle;
    }

    .table img {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 8px;
    }

    .list-group-item:hover {
      background-color: #6c757d;
      color: white;
      cursor: pointer;
    }

    .list-group {
      margin-left: 20px;
    }
  </style>
</head>

<body class="bg-theme bg-theme2">
  <div class="clearfix"></div>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Start wrapper-->
      <div id="wrapper">

        <!--Start topbar header-->
        <header class="topbar-nav">
          <?php require_once "layout/topbar.php" ?>
        </header>
        <!--End topbar header-->

        <!--Start sidebar-->
        <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
          <div class="brand-logo">
            <a href="index.html">
              <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
              <h5 class="logo-text">Nhân viên kho</h5>
            </a>
          </div>
          <ul class="sidebar-menu do-nicescrol">
            <li><a href="index.html"><i class="zmdi zmdi-view-dashboard"></i><span>Dashboard</span></a></li>
            <li>
              <hr>
            </li>
            <li class="dropdown">
              <a href="requirements.php">
                <i class="zmdi"></i>
                <span class="dropdown-toggle" data-toggle="dropdown">Yêu cầu</span>
                <ul class="dropdown-menu">
                  <li><a href="#">Yêu cầu xóa ấn phẩm</a></li>
                </ul>
              </a>
            </li>
            <li><a href="product.php"><i class="zmdi"></i><span>Ấn phẩm</span></a></li>
            <!-- Danh mục Ấn Phẩm -->
            <li>
              <a href="javascript:void(0);" onclick="toggleSubcategories()">
                <i class="zmdi"></i>
                <span>Danh mục Ấn phẩm</span>
              </a>
              <ul class="list-group" id="subcategories" style="display: none;">
                <li class="list-group-item" onclick="showProducts('giaokhoa')">Sách Giáo Khoa</li>
                <li class="list-group-item" onclick="showProducts('thamkhao')">Sách Tham Khảo</li>
                <li class="list-group-item" onclick="showProducts('truyentranh')">Truyện Tranh</li>
              </ul>
            </li>
            <li>
              <hr>
            </li>
            <li><a href="profile.html"><i class="zmdi"></i><span>Thông tin cá nhân</span></a></li>
            <li><a href="login.html" target="_blank"><i class="zmdi"></i><span>Đăng xuất</span></a></li>
          </ul>
        </div>
        <!--End sidebar-->

        <!-- Main Content -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header">DANH SÁCH ẤN PHẨM</div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush table-borderless">
                <thead>
                  <tr>
                    <th>Hình ảnh</th>
                    <th>Mã ấn phẩm</th>
                    <th>Tên ấn phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                  </tr>
                </thead>
                <tbody id="product-list">
                  <tr>
                    <td colspan="5" class="text-muted">Vui lòng chọn danh mục để hiển thị sản phẩm...</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!--End main content-->
    </div>
    <!-- End wrapper-->

    <!--Start right sidebar-->
    <?php require_once "layout/right_sidebar.php" ?>
    <!--End right sidebar-->

    <!--Start footer-->
    <?php require_once "layout/script.php" ?>
    <!--End footer-->

    <!-- JavaScript -->
    <script>
      // Danh sách sản phẩm mẫu theo danh mục
      const products = {
        giaokhoa: [{
            id: "SP001",
            name: "Toán 12",
            price: "50,000 VND",
            quantity: 10,
            image: "https://via.placeholder.com/80"
          },
          {
            id: "SP002",
            name: "Lý 12",
            price: "60,000 VND",
            quantity: 15,
            image: "https://via.placeholder.com/80"
          }
        ],
        thamkhao: [{
            id: "SP003",
            name: "Hóa 12",
            price: "70,000 VND",
            quantity: 12,
            image: "https://via.placeholder.com/80"
          },
          {
            id: "SP004",
            name: "Sinh 12",
            price: "65,000 VND",
            quantity: 8,
            image: "https://via.placeholder.com/80"
          }
        ],
        truyentranh: [{
            id: "SP005",
            name: "Doraemon Tập 1",
            price: "25,000 VND",
            quantity: 20,
            image: "https://via.placeholder.com/80"
          },
          {
            id: "SP006",
            name: "Conan Tập 1",
            price: "30,000 VND",
            quantity: 18,
            image: "https://via.placeholder.com/80"
          }
        ]
      };

      // Hàm ẩn/hiện danh mục con
      function toggleSubcategories() {
        const subcategories = document.getElementById("subcategories");
        if (subcategories.style.display === "none" || subcategories.style.display === "") {
          subcategories.style.display = "block";
        } else {
          subcategories.style.display = "none";
        }
      }

      // Hiển thị sản phẩm theo danh mục
      function showProducts(category) {
        const productList = document.getElementById("product-list");

        // Xóa nội dung hiện tại
        productList.innerHTML = "";

        // Kiểm tra danh mục tồn tại
        if (!products[category] || products[category].length === 0) {
          productList.innerHTML = `<tr><td colspan="5" class="text-muted">Không có sản phẩm nào trong danh mục này.</td></tr>`;
          return;
        }

        // Thêm sản phẩm vào danh sách
        products[category].forEach((product) => {
          productList.innerHTML += `
            <tr>
              <td><img src="${product.image}" alt="${product.name}"></td>
              <td>${product.id}</td>
              <td>${product.name}</td>
              <td>${product.quantity}</td>
              <td>${product.price}</td>
            </tr>
          `;
        });
      }
    </script>
  </div>
  </div>
</body>

</html>