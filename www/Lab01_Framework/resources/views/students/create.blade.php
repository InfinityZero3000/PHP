@extends('layouts.app')

@section('title', 'Thêm sinh viên')

@section('content')
    <x-card title="Thêm sinh viên mới" style="max-width:700px;margin:auto">
        {{-- Form gửi POST tới controller store. --}}
        <form method="post" action="{{ route('students.store') }}" novalidate>
            {{-- Token CSRF bảo vệ form khỏi yêu cầu giả mạo. --}}
            @csrf

            <div class="field">
                <label for="name">Họ tên <span aria-hidden="true">*</span></label>
                <input id="name" name="name" type="text" maxlength="255" value="{{ old('name') }}" required>
                @error('name')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label for="email">Email <span aria-hidden="true">*</span></label>
                <input id="email" name="email" type="email" maxlength="255" value="{{ old('email') }}" required>
                @error('email')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label for="age">Tuổi</label>
                <input id="age" name="age" type="number" min="16" value="{{ old('age') }}">
                @error('age')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label for="gender">Giới tính <span aria-hidden="true">*</span></label>
                <select id="gender" name="gender" required>
                    <option value="">-- Chọn giới tính --</option>
                    <option value="male" @selected(old('gender') === 'male')>Nam</option>
                    <option value="female" @selected(old('gender') === 'female')>Nữ</option>
                </select>
                @error('gender')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label for="class_name">Tên lớp <span aria-hidden="true">*</span></label>
                <input id="class_name" name="class_name" type="text" maxlength="255" value="{{ old('class_name') }}" placeholder="Ví dụ: 13DHTH01" required>
                @error('class_name')<div class="error">{{ $message }}</div>@enderror
            </div>

            {{-- Nút submit và liên kết hủy thao tác. --}}
            <button class="button primary" type="submit">Lưu sinh viên</button>
            <a class="button" href="{{ route('students.db') }}">Hủy</a>
        </form>
    </x-card>
@endsection
