@extends('layouts.app')

@section('title', 'Danh sách bài viết')

@section('content')
    <h2>Danh sách bài viết</h2>

    <p>
        <a href="{{ route('articles.create') }}">Tạo bài viết mới</a>
    </p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tiêu đề</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($articles as $a)
                <tr>
                    <td>{{ $a['id'] }}</td>
                    <td>{{ $a['title'] }}</td>
                    <td>
                        <a href="{{ route('articles.show', $a['id']) }}">Xem</a> |
                        <a href="{{ route('articles.edit', $a['id']) }}">Sửa</a> |
                        <a href="{{ route('articles.binding.show', $a['id']) }}">Binding</a> |
                        <form
                            action="{{ route('articles.destroy', $a['id']) }}"
                            method="post"
                            style="display:inline"
                        >
                            @csrf
                            @method('DELETE')
                            <x-button type="submit" variant="danger" onclick="return confirm('Xoá?')">
                                Xoá
                            </x-button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Chưa có bài viết.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @push('scripts')
        <script>
            console.log('Articles index loaded');
        </script>
    @endpush
@endsection
