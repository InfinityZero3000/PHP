{{-- Partial header dùng lại trên mọi trang theo Bài 10. --}}
<header class="site-header">
    <div class="container header-row">
        {{-- Tên bài thực hành. --}}
        <h1 class="brand">Laravel 12 - Lab 01</h1>
        {{-- Menu dùng route name để không viết cứng URL. --}}
        <nav class="nav" aria-label="Điều hướng chính">
            <a href="{{ route('hello') }}">Hello</a>
            <a href="{{ route('time') }}">Time</a>
            <a href="{{ route('students.array') }}">Mảng tĩnh</a>
            <a href="{{ route('students.db') }}">CSDL</a>
            <a href="{{ route('students.combined') }}">So sánh</a>
            <a href="{{ route('students.create') }}">Thêm mới</a>
            <a href="{{ route('about') }}">Giới thiệu</a>
        </nav>
    </div>
</header>
