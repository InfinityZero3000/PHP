<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Articles')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
            margin: 0;
            color: #111827;
            background: #f9fafb;
        }

        .container {
            max-width: 960px;
            margin: 24px auto;
            padding: 0 16px;
        }

        .flash {
            padding: 10px;
            margin-bottom: 12px;
            background: #ECFDF5;
            color: #065F46;
            border-radius: 8px;
        }

        .breadcrumb {
            margin-bottom: 16px;
            color: #6b7280;
            font-size: 14px;
        }

        .breadcrumb a {
            color: #2563eb;
            text-decoration: none;
        }

        nav a {
            margin-right: 8px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            background: #fff;
        }

        th,
        td {
            border: 1px solid #e5e7eb;
            padding: 8px;
            text-align: left;
        }

        th {
            background: #f3f4f6;
        }

        button,
        input,
        textarea {
            font: inherit;
        }
    </style>
    @stack('styles')
</head>
<body>
    @include('partials.nav')

    <div class="container">
        @include('partials.breadcrumb')

        @if (session('success'))
            <div class="flash">{{ session('success') }}</div>
        @endif

        @yield('content')
    </div>

    @include('partials.footer')

    @stack('scripts')
</body>
</html>
