document.addEventListener("DOMContentLoaded", function() {
    let customers = JSON.parse(localStorage.getItem('customers')) || [{
            username: "user1",
            password: "password123",
            role: "Khách hàng",
            id: "KH001",
            name: "Nguyễn Văn A",
            address: "123 Đường ABC, Quận 1",
        },
        {
            username: "user2",
            password: "password456",
            role: "Khách hàng",
            id: "KH002",
            name: "Trần Thị B",
            address: "456 Đường XYZ, Quận 2",
        },
    ];

    function saveCustomersToLocalStorage() {
        localStorage.setItem("customers", JSON.stringify(customers));
    }
    window.showCreateMemberForm = function() {
        const formHtml = `
            <div class="container mt-4">
                <h3 class="text-center text-white">Tạo Thành Viên</h3>
                <form id="createMemberForm">
                    <div class="form-group">
                        <label for="username" class="text-white">Tên tài khoản:</label>
                        <input type="text" id="username" class="form-control" placeholder="Nhập tên tài khoản" required>
                    </div>
                    <div class="form-group">
                        <label for="password" class="text-white">Mật khẩu:</label>
                        <input type="password" id="password" class="form-control" placeholder="Nhập mật khẩu (ít nhất 8 ký tự)" required>
                        <small id="passwordError" class="text-danger" style="display: none;">Mật khẩu phải có ít nhất 8 ký tự.</small>
                    </div>
                    <div class="form-group">
                        <label for="role" class="text-white">Vai trò:</label>
                        <input type="text" id="role" class="form-control" value="Khách hàng" readonly>
                    </div>
                    <div class="form-group">
                        <label for="customerId" class="text-white">Mã khách hàng:</label>
                        <input type="text" id="customerId" class="form-control" value="KH${Math.floor(1000 + Math.random() * 9000)}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="customerName" class="text-white">Tên khách hàng:</label>
                        <input type="text" id="customerName" class="form-control" placeholder="Nhập tên khách hàng" required oninput="validateCustomerName()">
                        <small id="nameError" class="text-danger" style="display: none;">Tên khách hàng phải viết hoa chữ cái đầu của mỗi từ.</small>
                    </div>
                    <div class="form-group">
                        <label for="address" class="text-white">Địa chỉ:</label>
                        <input type="text" id="address" class="form-control" placeholder="Nhập địa chỉ khách hàng" required>
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn btn-success" onclick="submitMemberForm()">Tạo</button>
                        <button type="button" class="btn btn-secondary" onclick="closeForm()">Hủy</button>
                    </div>
                </form>
            </div>
        `;

        document.getElementById("content-wrapper").innerHTML = formHtml;

        document.getElementById("password").addEventListener("input", function() {
            const passwordError = document.getElementById("passwordError");
            if (this.value.length < 8) {
                passwordError.style.display = "block";
            } else {
                passwordError.style.display = "none";
            }
        });
    };
    window.validateCustomerName = function() {
        const customerName = document.getElementById("customerName").value.trim();
        const nameError = document.getElementById("nameError");
        const namePattern = /^[A-Z][a-z]*(\s[A-Z][a-z]*)*$/;

        if (!namePattern.test(customerName)) {
            nameError.style.display = "block";
        } else {
            nameError.style.display = "none";
        }
    };
    window.submitMemberForm = function() {
        const username = document.getElementById("username").value.trim();
        const password = document.getElementById("password").value.trim();
        const role = document.getElementById("role").value.trim();
        const customerId = document.getElementById("customerId").value.trim();
        const customerName = document.getElementById("customerName").value.trim();
        const address = document.getElementById("address").value.trim();

        // Kiểm tra xem các trường có được nhập đầy đủ không
        if (!username || !password || !customerName || !address) {
            alert("Vui lòng nhập đầy đủ tất cả các thông tin!");
            return;
        }

        // Kiểm tra độ dài mật khẩu
        if (password.length < 8) {
            alert("Mật khẩu phải có ít nhất 8 ký tự!");
            return;
        }

        // Kiểm tra định dạng tên khách hàng (chữ cái đầu viết hoa)
        const namePattern = /^[A-Z][a-z]*(\s[A-Z][a-z]*)*$/;
        if (!namePattern.test(customerName)) {
            alert("Tên khách hàng không hợp lệ. Chữ cái đầu phải viết hoa!");
            return;
        }

        // Thêm thành viên mới vào danh sách
        customers.push({
            username,
            password,
            role,
            id: customerId,
            name: customerName,
            address,
        });

        // Lưu danh sách khách hàng vào LocalStorage
        saveCustomersToLocalStorage();

        alert(`Thành viên đã được tạo thành công!\nMã khách hàng: ${customerId}`);
        showCustomerManagement();
    };

    window.showCustomerManagement = function() {
        const searchBarContainer = document.getElementById("search-bar-container");
        const contentWrapper = document.getElementById("content-wrapper");

        if (!contentWrapper) {
            alert("Không tìm thấy phần tử để hiển thị nội dung.");
            return;
        }

        if (searchBarContainer) {
            searchBarContainer.style.display = "block";
        }

        let customerRows = customers
            .map(
                (customer) => `
                <tr>
                    <td>${customer.username}</td>
                    <td>${customer.password}</td>
                    <td>${customer.role}</td>
                    <td>${customer.id}</td>
                    <td>${customer.name}</td>
                    <td>${customer.address}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="showDeleteRequestForm('${customer.id}')">Tạo yêu cầu xóa</button>
                    </td>
                </tr>
            `
            )
            .join("");

        contentWrapper.innerHTML = `
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-white">Quản lí khách hàng</h3>
                    <button class="btn btn-success" onclick="showCreateMemberForm()">Tạo thành viên</button>
                </div>
                <div class="form-inline mb-3">
                    <input id="search-bar" type="text" class="form-control mr-2" placeholder="Nhập tiêu chí tìm kiếm (Tên tài khoản, Mật khẩu, Vai trò, Mã KH, Tên, Địa chỉ...)" />
                    <button class="btn btn-primary" onclick="searchCustomerByCriteria()">Tìm kiếm</button>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Danh sách khách hàng</h5>
                                <table class="table table-striped table-dark">
                                    <thead>
                                        <tr>
                                            <th>Tên tài khoản</th>
                                            <th>Mật khẩu</th>
                                            <th>Vai trò</th>
                                            <th>Mã khách hàng</th>
                                            <th>Tên khách hàng</th>
                                            <th>Địa chỉ</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody id="customer-table-body">
                                        ${customerRows}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    };

    window.showDeleteRequestForm = function(customerId) {
        const customer = customers.find((c) => c.id === customerId);
        if (!customer) {
            alert("Không tìm thấy khách hàng.");
            return;
        }

        const formHtml = `
            <div class="container mt-4">
                <h3 class="text-center text-white">Tạo Yêu Cầu Xóa Khách Hàng</h3>
                <form id="deleteRequestForm">
                    <div class="form-group">
                        <label for="customerId" class="text-white">Mã khách hàng:</label>
                        <input type="text" id="customerId" class="form-control" value="${customer.id}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="customerName" class="text-white">Tên khách hàng:</label>
                        <input type="text" id="customerName" class="form-control" value="${customer.name}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="deleteReason" class="text-white">Lý do xóa:</label>
                        <textarea id="deleteReason" class="form-control" placeholder="Nhập lý do xóa khách hàng" required></textarea>
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn btn-danger" onclick="submitDeleteRequest('${customer.id}')">Gửi</button>
                        <button type="button" class="btn btn-secondary" onclick="closeForm()">Hủy</button>
                    </div>
                </form>
            </div>
        `;

        document.getElementById("content-wrapper").innerHTML = formHtml;
    };

    window.submitDeleteRequest = function(customerId) {
        const deleteReason = document.getElementById("deleteReason").value.trim();

        if (!deleteReason) {
            alert("Vui lòng nhập lý do trước khi gửi yêu cầu.");
            return;
        }

        const deleteRequests = JSON.parse(localStorage.getItem("deleteRequests")) || [];
        deleteRequests.push({
            customerId,
            reason: deleteReason,
            date: new Date().toISOString(),
        });
        localStorage.setItem("deleteRequests", JSON.stringify(deleteRequests));

        alert("Tạo yêu cầu thành công và đã gửi đến quản lý.");
        showCustomerManagement();
    };

    window.closeForm = function() {
        showCustomerManagement();
    };

    window.searchCustomerByCriteria = function() {
        const query = document.getElementById("search-bar").value.trim().toLowerCase();

        if (!query) {
            alert("Vui lòng nhập ít nhất một tiêu chí tìm kiếm!");
            return;
        }

        const filteredCustomers = customers.filter(
            (customer) =>
            customer.username.toLowerCase().includes(query) ||
            customer.password.toLowerCase().includes(query) ||
            customer.role.toLowerCase().includes(query) ||
            customer.id.toLowerCase().includes(query) ||
            customer.name.toLowerCase().includes(query) ||
            customer.address.toLowerCase().includes(query)
        );

        if (filteredCustomers.length === 0) {
            alert("Không tìm thấy khách hàng nào phù hợp với tiêu chí tìm kiếm!");
        }

        let customerRows = filteredCustomers
            .map(
                (customer) => `
                <tr>
                    <td>${customer.username}</td>
                    <td>${customer.password}</td>
                    <td>${customer.role}</td>
                    <td>${customer.id}</td>
                    <td>${customer.name}</td>
                    <td>${customer.address}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="showDeleteRequestForm('${customer.id}')">Tạo yêu cầu xóa</button>
                    </td>
                </tr>
            `
            )
            .join("");

        document.getElementById("customer-table-body").innerHTML = customerRows;
    };
});