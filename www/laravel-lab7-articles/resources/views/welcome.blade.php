@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')
    <h2>Laravel Framework - Lab 7</h2>

    <x-alert type="success" title="Hoàn thành">
        Project đã cài đặt Routing nâng cao, RESTful Controller, Blade nâng cao và Form cơ bản.
    </x-alert>

    <p>Demo gọi named route trong view:</p>

    <ul>
        <li>
            <a href="{{ route('articles.page', ['page' => 2]) }}">
                {{ route('articles.page', ['page' => 2]) }}
            </a>
        </li>
        <li>
            <a href="{{ route('articles.slug', ['slug' => 'laravel-12-routing']) }}">
                {{ route('articles.slug', ['slug' => 'laravel-12-routing']) }}
            </a>
        </li>
        <li>
            <a href="{{ route('admin.articles.index') }}">
                {{ route('admin.articles.index') }}
            </a>
        </li>
    </ul>
@endsection
