@extends('layouts.app')

@section('title', 'So sánh nguồn dữ liệu')

@section('content')
    <x-card title="So sánh dữ liệu: Mảng tĩnh và Eloquent">
        {{-- Hai tab hoạt động bằng query parameter source. --}}
        <nav class="tabs" aria-label="Chọn nguồn dữ liệu">
            <a @class(['active' => $source === 'array']) href="{{ route('students.combined', ['source' => 'array']) }}">Tĩnh (Array)</a>
            <a @class(['active' => $source === 'db']) href="{{ route('students.combined', ['source' => 'db']) }}">CSDL (Eloquent)</a>
        </nav>

        {{-- Tab Array đọc dữ liệu mảng bằng cú pháp key. --}}
        @if ($source === 'array')
            <div class="source-label">Nguồn: PHP Array - {{ count($static) }} bản ghi</div>
            <div class="table-wrap"><table>
                <thead><tr><th>STT</th><th>Họ tên</th><th>Tuổi</th><th>Giới tính</th><th>Email</th></tr></thead>
                <tbody>
                    @foreach ($static as $student)
                        <tr><td>{{ $loop->iteration }}</td><td>{{ $student['name'] }}</td><td>{{ $student['age'] }}</td><td>{{ $student['gender'] === 'male' ? 'Nam' : 'Nữ' }}</td><td>{{ $student['email'] }}</td></tr>
                    @endforeach
                </tbody>
            </table></div>
        @else
            {{-- Tab DB đọc thuộc tính model Eloquent và hỗ trợ phân trang. --}}
            <div class="source-label">Nguồn: MySQL/Eloquent - {{ $db->total() }} bản ghi</div>
            <div class="table-wrap"><table>
                <thead><tr><th>STT</th><th>Họ tên</th><th>Tuổi</th><th>Giới tính</th><th>Lớp</th><th>Email</th></tr></thead>
                <tbody>
                    @forelse ($db as $student)
                        <tr><td>{{ $loop->iteration + ($db->currentPage() - 1) * $db->perPage() }}</td><td>{{ $student->name }}</td><td>{{ $student->age }}</td><td>{{ $student->gender === 'male' ? 'Nam' : 'Nữ' }}</td><td>{{ $student->class_name ?? 'Chưa có' }}</td><td>{{ $student->email }}</td></tr>
                    @empty
                        <tr><td colspan="6">Cơ sở dữ liệu chưa có sinh viên.</td></tr>
                    @endforelse
                </tbody>
            </table></div>
            {{-- source=db được giữ khi người dùng chuyển trang. --}}
            <div style="margin-top:16px">{{ $db->appends(['source' => 'db'])->links() }}</div>
        @endif
    </x-card>
@endsection
