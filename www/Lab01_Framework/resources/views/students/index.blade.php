@extends('layouts.app')

@section('title', 'Danh sách sinh viên - Mảng tĩnh')

@section('content')
    {{-- Card tái sử dụng được tạo ở Bài 10. --}}
    <x-card title="Danh sách sinh viên - Mảng tĩnh">
        {{-- Nhãn nêu rõ nguồn và tổng số bản ghi theo Bài 05. --}}
        <div class="source-label">Nguồn: PHP Array - {{ count($students) }} bản ghi</div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr><th>STT</th><th>Họ tên</th><th>Tuổi</th><th>Email</th></tr>
                </thead>
                <tbody>
                    {{-- Lặp qua từng phần tử của mảng sinh viên. --}}
                    @foreach ($students as $student)
                        <tr>
                            {{-- $loop->iteration bắt đầu từ 1 theo yêu cầu PDF. --}}
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $student['name'] }}</td>
                            {{-- @class thêm class adult khi sinh viên từ 18 tuổi. --}}
                            <td @class(['adult' => $student['age'] >= 18])>{{ $student['age'] }}</td>
                            <td>{{ $student['email'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-card>
@endsection
