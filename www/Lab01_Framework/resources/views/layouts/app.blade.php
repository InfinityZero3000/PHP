<!DOCTYPE html>
<html lang="vi">
<head>
    {{-- Khai báo UTF-8 để tiếng Việt hiển thị đúng. --}}
    <meta charset="UTF-8">
    {{-- Tiêu đề con có thể thay đổi ở từng view. --}}
    <title>@yield('title', 'Lab 01 Framework')</title>
    {{-- Thiết lập giao diện responsive trên điện thoại. --}}
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- CSS nội bộ giúp bài lab chạy ngay mà không cần npm. --}}
    <style>
        :root { color-scheme: light; font-family: Arial, sans-serif; color: #172033; background: #f5f7fb; }
        * { box-sizing: border-box; }
        body { margin: 0; }
        .container { width: min(1100px, calc(100% - 32px)); margin: 0 auto; }
        .site-header { background: #173b75; color: white; padding: 18px 0; box-shadow: 0 2px 8px #0002; }
        .header-row { display: flex; align-items: center; justify-content: space-between; gap: 20px; flex-wrap: wrap; }
        .brand { margin: 0; font-size: 23px; }
        .nav { display: flex; flex-wrap: wrap; gap: 8px; }
        .nav a { color: white; text-decoration: none; padding: 8px 10px; border-radius: 6px; }
        .nav a:hover, .nav a.active { background: #ffffff26; }
        main { padding: 30px 0; min-height: calc(100vh - 155px); }
        .card { background: white; border: 1px solid #dbe2ef; border-radius: 12px; padding: 22px; box-shadow: 0 5px 20px #1d35570d; }
        .card-title { margin: 0 0 18px; }
        table { border-collapse: collapse; width: 100%; background: white; }
        th, td { border: 1px solid #d9e0eb; padding: 10px; text-align: left; }
        th { background: #eef3fa; }
        .adult { color: #166534; font-weight: 700; }
        .toolbar { display: flex; justify-content: space-between; align-items: end; gap: 12px; margin-bottom: 16px; flex-wrap: wrap; }
        .tabs { display: flex; gap: 8px; margin-bottom: 16px; }
        .tabs a, .button { display: inline-block; padding: 9px 14px; border-radius: 7px; text-decoration: none; border: 1px solid #2459a9; color: #2459a9; background: white; cursor: pointer; }
        .tabs a.active, .button.primary { color: white; background: #2459a9; }
        label { display: block; font-weight: 600; margin-bottom: 6px; }
        input, select { width: 100%; padding: 10px; border: 1px solid #b8c3d5; border-radius: 7px; background: white; }
        .field { margin-bottom: 15px; }
        .error { color: #b91c1c; font-size: 14px; margin-top: 5px; }
        .alert { padding: 12px 15px; border-radius: 7px; margin-bottom: 16px; }
        .alert-success { background: #dcfce7; color: #166534; }
        .source-label { display: inline-block; padding: 5px 10px; background: #e0e7ff; color: #3730a3; border-radius: 999px; margin-bottom: 14px; }
        .pagination svg { width: 18px; }
        footer { background: #e9eef6; padding: 18px 0; text-align: center; color: #506078; }
        @media (max-width: 700px) { .table-wrap { overflow-x: auto; } }
    </style>
</head>
<body>
    {{-- Header được partial hóa theo Bài 10. --}}
    @include('partials.header')

    {{-- Khu vực nội dung thay đổi giữa các trang. --}}
    <main class="container">
        {{-- Hiển thị thông báo sau khi thêm sinh viên thành công. --}}
        @if (session('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif

        {{-- Mỗi view con điền nội dung vào section content. --}}
        @yield('content')
    </main>

    {{-- Footer dùng chung cho toàn bộ ứng dụng. --}}
    <footer><div class="container">&copy; {{ date('Y') }} HUIT - Khoa Công nghệ Thông tin</div></footer>
</body>
</html>
