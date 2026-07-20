@extends('layouts.app')

@section('title', 'Route Model Binding')

@section('content')
    <h2>Route Model Binding</h2>

    <x-alert type="success" title="Article">
        Đã binding thành công Article #{{ $article->id }}.
    </x-alert>

    <table>
        <tr>
            <th>ID</th>
            <td>{{ $article->id }}</td>
        </tr>
        <tr>
            <th>Tiêu đề</th>
            <td>{{ $article->title }}</td>
        </tr>
        <tr>
            <th>Nội dung</th>
            <td>{{ $article->body }}</td>
        </tr>
    </table>
@endsection
