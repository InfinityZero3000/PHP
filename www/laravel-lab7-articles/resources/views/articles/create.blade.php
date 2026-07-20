@extends('layouts.app')

@section('title', 'Tạo bài viết')

@push('styles')
    <style>
        .article-form {
            max-width: 720px;
            background: #fff;
            padding: 16px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
        }
    </style>
@endpush

@section('content')
    <h2>Tạo bài viết</h2>

    <x-alert type="warning" title="Lưu ý">
        Dữ liệu hiện chỉ mô phỏng (chưa lưu DB).
    </x-alert>

    <form action="{{ route('articles.store') }}" method="post" class="article-form">
        @csrf

        <x-input name="title" label="Tiêu đề" />

        <label style="display:block;margin:8px 0 4px">Nội dung</label>
        <textarea
            name="body"
            rows="6"
            style="width:100%;padding:8px;border:1px solid #e5e7eb;border-radius:6px"
        >{{ old('body') }}</textarea>
        @error('body')
            <div style="color:#991B1B;margin-top:4px">{{ $message }}</div>
        @enderror

        <x-button type="submit" variant="primary" style="margin-top:10px">
            Lưu
        </x-button>
    </form>
@endsection
