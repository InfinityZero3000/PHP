# LTMNM – Chương 1 – Lab 1

Project tổng hợp đầy đủ **20 bài tập PHP** trong đề cương Lab 1.

## Yêu cầu

- PHP 8.0 trở lên
- Extension `fileinfo` để kiểm tra MIME khi upload ảnh
- Extension `mbstring` được khuyến nghị để xử lý tiếng Việt ở Bài 17
- Laragon, XAMPP, MAMP hoặc PHP built-in server

## Cách chạy nhanh

Mở Terminal tại thư mục project và chạy:

```bash
php -S localhost:8000
```

Sau đó mở:

```text
http://localhost:8000
```

## Chạy với Laragon

1. Chép thư mục `LTMNM_Chuong1_Lab1_Project` vào `C:\laragon\www\`.
2. Khởi động Apache trong Laragon.
3. Truy cập `http://localhost/LTMNM_Chuong1_Lab1_Project/`.

## Tài khoản demo

Bài 13 và Bài 15:

- Username: `admin`
- Password: `123`

## Cấu trúc

- `index.php`: trang tổng hợp liên kết đến 20 bài.
- `assets/style.css`: giao diện dùng chung.
- `bai01_...` đến `bai20_...`: từng bài tập độc lập.
- Các bài upload/file đã có sẵn thư mục `uploads/`, `data/` và file dữ liệu rỗng.

## Lưu ý quyền ghi

Web server cần quyền ghi đối với:

- `bai11_upload_anh/uploads/`
- `bai12_ghi_file/data/`
- `bai15_mini_project/uploads/`
- `bai15_mini_project/data/`
- `bai19_ghi_chu/note.txt`
