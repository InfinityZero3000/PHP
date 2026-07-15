@extends('layouts.app')

@section('title', 'So sánh nguồn dữ liệu')

@section('content')
    <h2>So sánh dữ liệu mảng tĩnh và CSDL</h2>
    <nav>
        <a href="{{ route('students.combined', ['source' => 'array']) }}">Tab: Tĩnh (Array)</a> |
        <a href="{{ route('students.combined', ['source' => 'db']) }}">Tab: CSDL (Eloquent)</a>
    </nav>

    @if($source === 'array')
        <h3>Nguồn: Mảng tĩnh</h3>
        <p>Số lượng bản ghi: {{ count($static) }}</p>
        <table border="1" cellpadding="6">
            <thead><tr><th>STT</th><th>Họ tên</th><th>Tuổi</th><th>Giới tính</th><th>Email</th><th>Lớp</th></tr></thead>
            <tbody>
                @foreach($static as $student)
                    <tr>
                        <td>{{ $loop->iteration }}</td><td>{{ $student['name'] }}</td>
                        <td>{{ $student['age'] }}</td><td>{{ $student['gender'] }}</td>
                        <td>{{ $student['email'] }}</td><td>{{ $student['class_name'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h3>Nguồn: CSDL (Eloquent) - có phân trang</h3>
        <p>Tổng số bản ghi: {{ $db->total() }}</p>
        <table border="1" cellpadding="6">
            <thead><tr><th>STT</th><th>Họ tên</th><th>Tuổi</th><th>Giới tính</th><th>Email</th><th>Lớp</th></tr></thead>
            <tbody>
                @forelse($db as $student)
                    <tr>
                        <td>{{ $loop->iteration + ($db->currentPage() - 1) * $db->perPage() }}</td>
                        <td>{{ $student->name }}</td><td>{{ $student->age }}</td><td>{{ $student->gender }}</td>
                        <td>{{ $student->email }}</td><td>{{ $student->class_name }}</td>
                    </tr>
                @empty
                    <tr><td colspan="6">CSDL chưa có dữ liệu.</td></tr>
                @endforelse
            </tbody>
        </table>
        {{ $db->links() }}
    @endif
@endsection
