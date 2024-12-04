# Hướng dẫn thay đổi đường dẫn trong `left_sidebar.php`

## Mục tiêu

Đổi các đường dẫn cũ từ:

```
/bookstore/ADMIN/view/report/thongke/thongKeSanPhamTheoNgay.php
```

thành:

```
/Final_BookStore_CodeNexusGroup/ADMIN/view/report/thong/thongKeSanPhamTheoNgay.php
```

## Các bước thực hiện

1. **Mở file `left_sidebar.php`:**
   File này nằm trong thư mục `layout` hoặc theo đường dẫn:

   ```
   /layout/left_sidebar.php
   ```

2. **Tìm các đường dẫn cần sửa:**
   Trong file `left_sidebar.php`, tìm tất cả các dòng có chứa đoạn sau:

   ```
   /bookstore/ADMIN/view/report/thongke/
   ```

3. **Thay thế đường dẫn:**

   - Thay đổi đoạn đường dẫn:
     Từ:
     ```
     /bookstore/ADMIN/view/report/thongke/thongKeSanPhamTheoNgay.php
     ```
     Thành:
     ```
     /Final_BookStore_CodeNexusGroup/ADMIN/view/report/thong/thongKeSanPhamTheoNgay.php
     ```

4. **Danh sách các đường dẫn cần thay đổi:**
   Ví dụ, các đường dẫn trong `left_sidebar.php` sẽ được thay đổi như sau:

   - **Ngày:**
     Từ:

     ```
     /bookstore/ADMIN/view/report/thongke/thongKeSanPhamTheoNgay.php
     ```

     Thành:

     ```
     /Final_BookStore_CodeNexusGroup/ADMIN/view/report/thong/thongKeSanPhamTheoNgay.php
     ```

   - **Tháng:**
     Từ:

     ```
     /bookstore/ADMIN/view/report/thongke/thongKeSanPhamTheoThang.php
     ```

     Thành:

     ```
     /Final_BookStore_CodeNexusGroup/ADMIN/view/report/thong/thongKeSanPhamTheoThang.php
     ```

   - **Năm:**
     Từ:
     ```
     /bookstore/ADMIN/view/report/thongke/thongKeSanPhamTheoNam.php
     ```
     Thành:
     ```
     /Final_BookStore_CodeNexusGroup/ADMIN/view/report/thong/thongKeSanPhamTheoNam.php
     ```

5. **Lưu file:**
   - Sau khi thay thế, lưu lại file `left_sidebar.php`.

## Kiểm tra

- Mở trình duyệt và truy cập vào phần giao diện sử dụng sidebar để đảm bảo các đường dẫn đã hoạt động chính xác.

---

**Lưu ý:**
Nếu bạn cần thay đổi nhiều đường dẫn trong các file khác, hãy lặp lại quy trình trên cho từng file. Hãy sử dụng tính năng "Find and Replace" của IDE (như VSCode) để tăng tốc độ chỉnh sửa.

# Hướng dẫn thay đổi đường dẫn trong `script.php`

## Mục tiêu

Chuyển đổi các đường dẫn trong file `script.php`, cụ thể:

- Từ: `/bookstore/ADMIN/...`
- Thành: `/Final_BookStore_CodeNexusGroup/ADMIN/...`

## Các bước thực hiện

1. **Xác định các đường dẫn cần thay đổi**
   Trong mã nguồn hiện tại, các đường dẫn cần thay đổi bao gồm:

   | **Vị trí**      | **Đường dẫn cũ**                                            | **Đường dẫn mới**                                                                |
   | --------------- | ----------------------------------------------------------- | -------------------------------------------------------------------------------- |
   | Thư viện JS     | `/bookstore/ADMIN/assets/js/jquery.min.js`                  | `/Final_BookStore_CodeNexusGroup/ADMIN/assets/js/jquery.min.js`                  |
   | Popper JS       | `/bookstore/ADMIN/assets/js/popper.min.js`                  | `/Final_BookStore_CodeNexusGroup/ADMIN/assets/js/popper.min.js`                  |
   | Bootstrap JS    | `/bookstore/ADMIN/assets/js/bootstrap.min.js`               | `/Final_BookStore_CodeNexusGroup/ADMIN/assets/js/bootstrap.min.js`               |
   | Simplebar JS    | `/bookstore/ADMIN/assets/plugins/simplebar/js/simplebar.js` | `/Final_BookStore_CodeNexusGroup/ADMIN/assets/plugins/simplebar/js/simplebar.js` |
   | Sidebar-menu JS | `/bookstore/ADMIN/assets/js/sidebar-menu.js`                | `/Final_BookStore_CodeNexusGroup/ADMIN/assets/js/sidebar-menu.js`                |
   | Loader scripts  | `/bookstore/ADMIN/assets/js/jquery.loading-indicator.js`    | `/Final_BookStore_CodeNexusGroup/ADMIN/assets/js/jquery.loading-indicator.js`    |
   | Custom scripts  | `/bookstore/ADMIN/assets/js/app-script.js`                  | `/Final_BookStore_CodeNexusGroup/ADMIN/assets/js/app-script.js`                  |
   | Chart.js        | `/bookstore/ADMIN/assets/plugins/Chart.js/Chart.min.js`     | `/Final_BookStore_CodeNexusGroup/ADMIN/assets/plugins/Chart.js/Chart.min.js`     |
   | Index JS        | `/bookstore/ADMIN/assets/js/index.js`                       | `/Final_BookStore_CodeNexusGroup/ADMIN/assets/js/index.js`                       |

---

2. **Thay thế trong mã nguồn**

#### **Cũ:**

```html
<script src="/bookstore/ADMIN/assets/js/jquery.min.js"></script>
<script src="/bookstore/ADMIN/assets/js/popper.min.js"></script>
<script src="/bookstore/ADMIN/assets/js/bootstrap.min.js"></script>
<script src="/bookstore/ADMIN/assets/plugins/simplebar/js/simplebar.js"></script>
<script src="/bookstore/ADMIN/assets/js/sidebar-menu.js"></script>
<script src="/bookstore/ADMIN/assets/js/jquery.loading-indicator.js"></script>
<script src="/bookstore/ADMIN/assets/js/app-script.js"></script>
<script src="/bookstore/ADMIN/assets/plugins/Chart.js/Chart.min.js"></script>
<script src="/bookstore/ADMIN/assets/js/index.js"></script>
```

#### **Mới:**

```html
<script src="/Final_BookStore_CodeNexusGroup/ADMIN/assets/js/jquery.min.js"></script>
<script src="/Final_BookStore_CodeNexusGroup/ADMIN/assets/js/popper.min.js"></script>
<script src="/Final_BookStore_CodeNexusGroup/ADMIN/assets/js/bootstrap.min.js"></script>
<script src="/Final_BookStore_CodeNexusGroup/ADMIN/assets/plugins/simplebar/js/simplebar.js"></script>
<script src="/Final_BookStore_CodeNexusGroup/ADMIN/assets/js/sidebar-menu.js"></script>
<script src="/Final_BookStore_CodeNexusGroup/ADMIN/assets/js/jquery.loading-indicator.js"></script>
<script src="/Final_BookStore_CodeNexusGroup/ADMIN/assets/js/app-script.js"></script>
<script src="/Final_BookStore_CodeNexusGroup/ADMIN/assets/plugins/Chart.js/Chart.min.js"></script>
<script src="/Final_BookStore_CodeNexusGroup/ADMIN/assets/js/index.js"></script>
```

---

3. **Sử dụng công cụ Find and Replace**
   - Để thay đổi nhanh hơn:
     - Mở file `script.php` trong IDE (như Visual Studio Code).
     - Sử dụng tính năng "Find and Replace" (Ctrl + H hoặc Cmd + H trên Mac).
     - Tìm:
       ```
       /bookstore/ADMIN/
       ```
     - Thay thế bằng:
       ```
       /Final_BookStore_CodeNexusGroup/ADMIN/
       ```

---

4. **Kiểm tra**
   - Sau khi thay đổi, lưu file và mở lại trang web trên trình duyệt để đảm bảo tất cả các file JS đã được nạp chính xác với đường dẫn mới.

---

Nếu cần thêm chi tiết hoặc gặp vấn đề, bạn cứ hỏi nhé!
