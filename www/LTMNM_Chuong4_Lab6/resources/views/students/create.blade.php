@extends('layouts.app')

@section('title', 'Thêm sinh viên')

@section('content')
    <h2>Thêm sinh viên mới</h2>

    <form method="post" action="{{ route('students.store') }}">
        {{-- @csrf tạo token chống giả mạo request. --}}
        @csrf

        <p>
            <label for="name">Họ tên:</label><br>
            <input id="name" name="name" type="text" value="{{ old('name') }}" required maxlength="255">
            @error('name')<br><span role="alert">{{ $message }}</span>@enderror
        </p>
        <p>
            <label for="email">Email:</label><br>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required maxlength="255">
            @error('email')<br><span role="alert">{{ $message }}</span>@enderror
        </p>
        <p>
            <label for="age">Tuổi:</label><br>
            <input id="age" name="age" type="number" value="{{ old('age') }}" min="16">
            @error('age')<br><span role="alert">{{ $message }}</span>@enderror
        </p>
        <p>
            <label for="gender">Giới tính:</label><br>
            <select id="gender" name="gender" required>
                <option value="">-- Chọn giới tính --</option>
                <option value="male" @selected(old('gender') === 'male')>Nam</option>
                <option value="female" @selected(old('gender') === 'female')>Nữ</option>
            </select>
            @error('gender')<br><span role="alert">{{ $message }}</span>@enderror
        </p>
        <p>
            <label for="class_name">Lớp:</label><br>
            <input id="class_name" name="class_name" type="text" value="{{ old('class_name') }}" required maxlength="255">
            @error('class_name')<br><span role="alert">{{ $message }}</span>@enderror
        </p>
        <button type="submit">Lưu sinh viên</button>
    </form>
@endsection
