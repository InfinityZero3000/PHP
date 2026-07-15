@extends('layouts.app')

@section('title', 'Danh sách sinh viên - Mảng')

@section('content')
    <h2>Danh sách sinh viên - Nguồn: Mảng tĩnh</h2>
    <p>Số lượng bản ghi: {{ count($students) }}</p>

    <table border="1" cellpadding="6">
        <thead>
            <tr><th>STT</th><th>Họ tên</th><th>Tuổi</th><th>Giới tính</th><th>Email</th><th>Lớp</th></tr>
        </thead>
        <tbody>
            @forelse($students as $student)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student['name'] }}</td>
                    <td>{{ $student['age'] }}</td>
                    <td>{{ $student['gender'] }}</td>
                    <td>{{ $student['email'] }}</td>
                    <td>{{ $student['class_name'] }}</td>
                </tr>
            @empty
                <tr><td colspan="6">Chưa có sinh viên.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
