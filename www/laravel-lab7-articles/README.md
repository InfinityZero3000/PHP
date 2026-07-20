# Laravel Framework - Lab 7: Routing, Controller RESTful, Blade, Form

Project này cài đặt đầy đủ các yêu cầu trong `LTMNM_Chuong4_Lab7.v1.0.pdf`.

## Nội dung đã làm

- Bài 01: Routing nâng cao cho Articles.
- Bài 02: `ArticleController` RESTful và `Route::resource`.
- Bài 03: Blade layout, partials và stacks.
- Bài 04: Blade components `<x-alert>` và `<x-input>`.
- Bài 05: Form tạo/sửa bài viết, CSRF, method spoofing, validation inline.
- Bài 06: Demo implicit Route Model Binding với `Article`.
- Bài 07: Form xóa an toàn bằng `confirm()` và `@method('DELETE')`.
- Bài 08: Component `<x-button>` và CSS riêng bằng `@push('styles')`.
- Bài 09: Named routes và breadcrumb bằng Blade include.

## Cách dùng

Nếu bạn đã có project Laravel 12:

1. Copy các thư mục `app`, `routes`, `resources` trong folder này vào project Laravel.
2. Chạy server:

```bash
php artisan serve
```

Nếu bạn muốn chạy như một project mới:

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan serve
```

## URL kiểm tra

| URL | Kết quả mong đợi |
| --- | --- |
| `/` | Trang chủ + demo named route |
| `/articles/page/3` | Trang bài viết số: 3 |
| `/articles/slug/laravel-12-routing` | Slug: laravel-12-routing |
| `/admin/articles` | Quản trị bài viết |
| `/articles` | Danh sách bài viết |
| `/articles/create` | Form tạo bài viết |
| `/articles/1/edit` | Form sửa bài viết |
| `/articles/show/1` | Demo Route Model Binding |

## Ghi chú

Dữ liệu bài viết đang dùng mảng mô phỏng theo đúng PDF, chưa kết nối database. Phần database sẽ gắn với Model Eloquent và Migration ở các buổi sau.
