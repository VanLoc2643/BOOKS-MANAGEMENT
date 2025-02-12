# 📚 Web Quản Lý Bán Sách

## 🌟 Giới thiệu

Dự án này là một hệ thống quản lý bán sách trực tuyến. Hệ thống cho phép quản lý sách, danh mục sách, tài khoản người dùng, đơn hàng và nhiều chức năng khác.

## 🚀 Các chức năng chính

- **📖 Quản lý sách**: Thêm, sửa, xóa và xem thông tin sách.
- **📚 Quản lý danh mục sách**: Thêm, sửa, xóa và xem thông tin danh mục sách.
- **👤 Quản lý tài khoản người dùng**: Đăng ký, đăng nhập, sửa thông tin tài khoản.
- **🛒 Quản lý đơn hàng**: Xem chi tiết đơn hàng, cập nhật trạng thái đơn hàng.

## 🛠️ Cài đặt

1. Clone repository về máy của bạn:

```sh
git clone <repository-url>
```

2. Cài đặt XAMPP và khởi động Apache và MySQL.

3. Tạo cơ sở dữ liệu và import file SQL vào MySQL.

4. Cấu hình kết nối cơ sở dữ liệu trong file `connect.php`:

```php
$connect = new mysqli("localhost", "username", "password", "database_name");
```

5. Mở trình duyệt và truy cập vào địa chỉ:

```
http://localhost/webquanly
```

## 💻 Sử dụng

- **🔑 Đăng nhập**: Truy cập vào trang `login.php` để đăng nhập vào hệ thống.
- **📖 Quản lý sách**: Truy cập vào trang `QuanLyBook.php` để quản lý sách.
- **📚 Quản lý danh mục sách**: Truy cập vào trang `Quanlydanhmuc.php` để quản lý danh mục sách.
- **👤 Quản lý tài khoản người dùng**: Truy cập vào trang `QLtaikhoannguoidung.php` để quản lý tài khoản người dùng.
- **🛒 Quản lý đơn hàng**: Truy cập vào trang `quanlyDonHang.php` để quản lý đơn hàng.

## 🛠️ Công nghệ sử dụng

- **Front-end**: HTML, CSS, JavaScript, Bootstrap
- **Back-end**: PHP, MySQL
- **Thư viện và Framework**: jQuery, Font Awesome, Chart.js, DataTables

## 📞 Liên hệ

- **Email**: vanlocdev@gmail.com
