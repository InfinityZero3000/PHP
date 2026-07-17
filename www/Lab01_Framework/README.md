# Lab01 Framework - Laravel 12

Bộ mã nguồn hoàn chỉnh cho Bài 6 trong tài liệu `LTMNM_Chuong4_Lab6.v1.0.pdf`, gồm Bài 01 đến Bài 11. Database được đặt đúng tên **`lab01framework`**.

## Yêu cầu môi trường

- PHP 8.2 trở lên và bật các extension thường dùng của Laravel (`pdo_mysql`, `mbstring`, `openssl`, `fileinfo`).
- Composer 2.
- MySQL 8/MariaDB hoặc Laragon.

## Cài đặt và kiểm tra kết nối database

```bash
cd Lab01_Framework
composer install
cp .env.example .env
php artisan key:generate
```

Tạo database trước khi migrate:

```sql
CREATE DATABASE lab01framework
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;
```

Kiểm tra `.env` có đúng thông tin MySQL trên máy. Cấu hình mặc định của project là:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lab01framework
DB_USERNAME=root
DB_PASSWORD=
```

Xóa cache cấu hình, kiểm tra kết nối, tạo bảng và seed 20 bản ghi:

```bash
php artisan config:clear
php artisan db:show
php artisan migrate:fresh --seed
php artisan serve
```

Mở [http://localhost:8000](http://localhost:8000). Nếu dùng Laragon, đặt project trong `C:\laragon\www` rồi mở `http://lab01_framework.test`.

## Các URL cần chụp kết quả

| Bài | URL |
|---|---|
| Route chào | `/hello` |
| Thời gian | `/time` |
| Tính tổng | `/sum/7/5` |
| Mảng tĩnh | `/students` |
| Eloquent + lọc + phân trang | `/students/db` |
| So sánh Array/DB | `/students/combined?source=array` và `?source=db` |
| Form thêm mới | `/students/create` |
| Giới thiệu học phần | `/about` |

## Chạy kiểm thử

```bash
php artisan test
```

Test dùng SQLite trong bộ nhớ, không xóa hay thay đổi dữ liệu MySQL `lab01framework`.

## Lỗi kết nối MySQL thường gặp

- `Unknown database 'lab01framework'`: chưa chạy câu lệnh `CREATE DATABASE` ở trên.
- `Access denied for user`: sửa `DB_USERNAME` và `DB_PASSWORD` trong `.env`.
- `Connection refused`: khởi động MySQL trong Laragon/XAMPP và kiểm tra `DB_PORT`.
- Đã sửa `.env` nhưng lỗi cũ còn tồn tại: chạy `php artisan config:clear`.
