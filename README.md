# PHP Dev Environment

Laragon chỉ chạy trên Windows. Trên máy này dùng Docker Compose cho gọn và dễ xóa.

## Chạy

```sh
docker compose up -d --build
```

- PHP app: http://localhost:8080
- phpMyAdmin: http://localhost:8081
- MySQL host ngoài máy: `127.0.0.1:33060`
- MySQL trong Docker: host `db`, user `app`, password `app`, database `app`

## Bố cục

- `www/`: code PHP
- `.data/`: toàn bộ database, Apache log, Composer cache
- `compose.yml`: cấu hình services
- `.env`: port và mật khẩu local

## Dọn

Giữ database:

```sh
docker compose down
```

Xóa sạch data local:

```sh
docker compose down
rm -rf .data
```
