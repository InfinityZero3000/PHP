# Luồng dữ liệu - Module Articles

Tài liệu này bổ sung phần vẽ luồng dữ liệu cho Lab 7. Vì bài hiện tại chỉ demo Routing, Controller, Blade và Form nên dữ liệu bài viết đang được mô phỏng bằng mảng trong `ArticleController`, chưa lưu database.

## 1. DFD mức ngữ cảnh

```mermaid
flowchart TD
    user["Người dùng"]
    browser["Trình duyệt"]
    app["Laravel App\nRoutes + Controller + Blade"]
    session["Session\nFlash message + validation errors"]
    mock["Mock Articles Data\nMảng dữ liệu demo"]

    user -->|"Nhập URL / bấm form"| browser
    browser -->|"HTTP GET/POST/PUT/DELETE"| app
    app -->|"HTML response"| browser
    browser -->|"Hiển thị giao diện"| user
    app <-->|"Đọc dữ liệu mẫu"| mock
    app <-->|"Ghi/đọc thông báo tạm"| session
```

## 2. Luồng xem danh sách bài viết

```mermaid
flowchart TD
    a["GET /articles"]
    b["Route::resource\narticles.index"]
    c["ArticleController@index"]
    d["Tạo mảng articles demo"]
    e["View articles.index"]
    f["Layout app + nav + footer + breadcrumb"]
    g["Response HTML"]

    a --> b --> c --> d --> e --> f --> g
```

## 3. Luồng tạo bài viết

```mermaid
flowchart TD
    a["GET /articles/create"]
    b["ArticleController@create"]
    c["View articles.create"]
    d["User nhập title, body"]
    e["POST /articles"]
    f["CSRF check"]
    g["Validate title/body"]
    h{"Dữ liệu hợp lệ?"}
    i["Redirect back\nkèm errors"]
    j["Redirect /articles\nkèm flash success"]

    a --> b --> c --> d --> e --> f --> g --> h
    h -->|"Không"| i
    h -->|"Có"| j
```

## 4. Luồng sửa bài viết

```mermaid
flowchart TD
    a["GET /articles/{id}/edit"]
    b["ArticleController@edit"]
    c["Tạo article mẫu theo id"]
    d["View articles.edit"]
    e["User sửa title, body"]
    f["PUT /articles/{id}\nqua @method('PUT')"]
    g["CSRF check"]
    h["Validate title/body"]
    i{"Dữ liệu hợp lệ?"}
    j["Redirect back\nkèm errors"]
    k["Redirect /articles\nkèm flash success"]

    a --> b --> c --> d --> e --> f --> g --> h --> i
    i -->|"Không"| j
    i -->|"Có"| k
```

## 5. Luồng xóa bài viết

```mermaid
flowchart TD
    a["User bấm Xóa"]
    b["confirm('Xoá?')"]
    c{"Xác nhận?"}
    d["Hủy thao tác"]
    e["DELETE /articles/{id}\nqua @method('DELETE')"]
    f["ArticleController@destroy"]
    g["Redirect /articles\nkèm flash success"]

    a --> b --> c
    c -->|"Không"| d
    c -->|"Có"| e --> f --> g
```

## 6. Ghi chú triển khai sau này

Khi học tới Migration và Eloquent, khối `Mock Articles Data` sẽ được thay bằng bảng `articles` trong database:

```mermaid
flowchart LR
    controller["ArticleController"]
    model["Article Model"]
    db[("articles table")]

    controller -->|"CRUD thật"| model
    model -->|"SELECT / INSERT / UPDATE / DELETE"| db
    db -->|"Article records"| model
    model -->|"Collection / Model"| controller
```