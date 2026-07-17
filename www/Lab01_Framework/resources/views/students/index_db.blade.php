@extends('layouts.app')

@section('title', 'Danh sách sinh viên - CSDL')

@section('content')
    <x-card title="Danh sách sinh viên - CSDL (Eloquent)">
        {{-- Thanh công cụ gồm thống kê, bộ lọc và nút thêm mới. --}}
        <div class="toolbar">
            <div class="source-label">Nguồn: MySQL - {{ $students->total() }} bản ghi</div>
            <a class="button primary" href="{{ route('students.create') }}">+ Thêm sinh viên</a>
        </div>

        {{-- Form GET giúp URL bộ lọc có thể chia sẻ và tải lại. --}}
        <form method="get" action="{{ route('students.db') }}" style="max-width:280px;margin-bottom:16px">
            <label for="gender">Lọc giới tính:</label>
            {{-- onchange gửi form ngay sau khi người dùng chọn. --}}
            <select id="gender" name="gender" onchange="this.form.submit()">
                <option value="" @selected(empty($gender))>Tất cả</option>
                <option value="male" @selected($gender === 'male')>Nam</option>
                <option value="female" @selected($gender === 'female')>Nữ</option>
            </select>
        </form>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr><th>STT</th><th>Họ tên</th><th>Tuổi</th><th>Giới tính</th><th>Lớp</th><th>Email</th><th>Nhãn tuổi</th></tr>
                </thead>
                <tbody>
                    {{-- $forelse có nhánh xử lý khi bộ lọc không trả dữ liệu. --}}
                    @forelse ($students as $student)
                        <tr>
                            {{-- Tính STT liên tục qua các trang phân trang. --}}
                            <td>{{ $loop->iteration + ($students->currentPage() - 1) * $students->perPage() }}</td>
                            <td>{{ $student->name }}</td>
                            <td @class(['adult' => ($student->age ?? 0) >= 18])>{{ $student->age ?? 'Chưa có' }}</td>
                            <td>{{ $student->gender === 'male' ? 'Nam' : 'Nữ' }}</td>
                            <td>{{ $student->class_name ?? 'Chưa có' }}</td>
                            <td>{{ $student->email }}</td>
                            {{-- Anonymous component nhận tuổi bằng attribute binding. --}}
                            <td><x-badge :age="$student->age" /></td>
                        </tr>
                    @empty
                        <tr><td colspan="7">Không tìm thấy sinh viên phù hợp.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Laravel render liên kết phân trang, query filter đã được giữ bởi controller. --}}
        <div style="margin-top:16px">{{ $students->links() }}</div>
    </x-card>
@endsection
