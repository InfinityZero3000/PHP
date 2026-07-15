@extends('layouts.app')

@section('title', 'Danh sách sinh viên - CSDL')

@section('content')
    <h2>Danh sách sinh viên - Nguồn: CSDL (Eloquent)</h2>
    <p>Tổng số bản ghi: {{ $students->total() }}</p>

    <form method="get" action="{{ route('students.db') }}">
        <label for="gender">Lọc giới tính:</label>
        <select id="gender" name="gender">
            <option value="" @selected(empty($gender))>Tất cả</option>
            <option value="male" @selected($gender === 'male')>Nam</option>
            <option value="female" @selected($gender === 'female')>Nữ</option>
        </select>
        <button type="submit">Lọc</button>
    </form>

    <table border="1" cellpadding="6">
        <thead>
            <tr><th>STT</th><th>Họ tên</th><th>Tuổi</th><th>Giới tính</th><th>Email</th><th>Lớp</th><th>Nhãn tuổi</th></tr>
        </thead>
        <tbody>
            @forelse($students as $student)
                <tr>
                    <td>{{ $loop->iteration + ($students->currentPage() - 1) * $students->perPage() }}</td>
                    <td>{{ $student->name }}</td>
                    {{-- @class thêm class adult khi sinh viên đủ 18 tuổi. --}}
                    <td @class(['adult' => ($student->age ?? 0) >= 18])>{{ $student->age ?? 'Chưa cập nhật' }}</td>
                    <td>{{ $student->gender === 'male' ? 'Nam' : 'Nữ' }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->class_name }}</td>
                    <td><x-badge :age="$student->age" /></td>
                </tr>
            @empty
                <tr><td colspan="7">Không có dữ liệu phù hợp.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $students->links() }}
@endsection
