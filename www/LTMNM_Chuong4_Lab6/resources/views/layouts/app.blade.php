<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Lab 01')</title>
</head>
<body>
    {{-- Bài 10: header được tách thành partial để tái sử dụng. --}}
    @include('partials.header')

    <main>
        @if(session('success'))
            <p role="status">{{ session('success') }}</p>
        @endif

        @yield('content')
    </main>

    <footer>
        <hr>
        <small>&copy; HUIT - Khoa Công nghệ Thông tin</small>
    </footer>
</body>
</html>
