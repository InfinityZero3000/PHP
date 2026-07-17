@extends('layouts.app')

@section('title', 'Giới thiệu khóa học')

@section('content')
    <x-card title="Giới thiệu học phần Lập trình mã nguồn mở">
        {{-- Nội dung mục tiêu học phần của Bài 07. --}}
        <h3>Mục tiêu học phần</h3>
        <p>Học phần giúp sinh viên sử dụng công nghệ mã nguồn mở để xây dựng ứng dụng web có cấu trúc, an toàn và dễ bảo trì; đồng thời rèn luyện kỹ năng làm việc với PHP, MySQL, Git và Laravel.</p>

        {{-- Lịch bảy buổi được truyền từ PageController. --}}
        <h3>Lịch 7 buổi lab</h3>
        <ol>
            @foreach ($labs as $lab)
                <li style="margin-bottom:7px"><strong>Buổi {{ $loop->iteration }}:</strong> {{ $lab }}</li>
            @endforeach
        </ol>

        {{-- Chuẩn đầu ra mô tả năng lực sinh viên sau học phần. --}}
        <h3>Chuẩn đầu ra mong đợi</h3>
        <ul>
            <li>Giải thích được kiến trúc MVC và vai trò của các thành phần Laravel.</li>
            <li>Xây dựng được ứng dụng Laravel kết nối MySQL bằng Eloquent ORM.</li>
            <li>Thiết kế route, controller, Blade view, form và validation phù hợp.</li>
            <li>Sử dụng migration, factory, seeder và kiểm thử tự động trong dự án.</li>
            <li>Quản lý mã nguồn và phối hợp nhóm theo quy trình Git cơ bản.</li>
        </ul>
    </x-card>
@endsection
