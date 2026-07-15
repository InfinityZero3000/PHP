@extends('layouts.app')

@section('title', 'Giới thiệu khóa học')

@section('content')
    <x-card title="Mục tiêu học phần">
        <p>Trang bị kiến thức và kỹ năng xây dựng ứng dụng web bằng PHP, MySQL và Laravel theo kiến trúc MVC.</p>
    </x-card>

    <x-card title="Lịch 7 buổi lab">
        <ol>
            @foreach($labs as $lab)
                <li>{{ $lab }}</li>
            @endforeach
        </ol>
    </x-card>

    <x-card title="Chuẩn đầu ra mong đợi">
        <ul>
            <li>Vận dụng được PHP hướng đối tượng và MySQL trong ứng dụng web.</li>
            <li>Giải thích và áp dụng được mô hình MVC của Laravel.</li>
            <li>Xây dựng được route, controller, Blade view, model và migration.</li>
            <li>Thao tác dữ liệu an toàn bằng validation, CSRF và Eloquent ORM.</li>
        </ul>
    </x-card>
@endsection
