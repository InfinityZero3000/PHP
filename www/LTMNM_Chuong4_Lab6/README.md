# Lab01_Framework - Laravel 12 (Lab 6)

Dự án hoàn thành bài 1 đến bài 11 trong tài liệu Lab 6. Giao diện dùng HTML/Blade thuần, không có CSS, thẻ `<style>` hoặc thuộc tính `style`.

## Cài đặt và chạy

Yêu cầu: PHP 8.2 trở lên, Composer và extension SQLite (hoặc cấu hình MySQL trong `.env`).

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
php artisan serve
```

Mở `http://localhost:8000`. Để chạy bài kiểm thử 11:

```bash
php artisan test
```

## URL kiểm tra

- `/hello`: chuỗi chào Laravel 12.
- `/time`: giờ hệ thống.
- `/sum/7/5`: tổng hai số nguyên.
- `/students`: dữ liệu mảng tĩnh.
- `/students/db`: dữ liệu Eloquent, lọc giới tính và phân trang.
- `/students/combined?source=array`: tab mảng tĩnh.
- `/students/combined?source=db`: tab CSDL.
- `/students/create`: form tạo sinh viên.
- `/about`: giới thiệu khóa học.

## Giải thích cấu trúc chính

- `routes/web.php`: ánh xạ URL tới closure hoặc controller.
- `app/Http/Controllers`: nhận request, xử lý dữ liệu và chọn view.
- `app/Models/Student.php`: model Eloquent đại diện bảng `students`.
- `database/migrations`: tạo bảng và bổ sung cột `class_name` theo từng phiên bản.
- `database/factories` và `database/seeders`: sinh 20 bản ghi mẫu.
- `resources/views`: layout, partial, component và các trang Blade.
- `tests/Feature`: kiểm tra tự động route `/hello`.

Các đoạn mã quan trọng đều có chú thích trực tiếp để giải thích mục đích xử lý.
