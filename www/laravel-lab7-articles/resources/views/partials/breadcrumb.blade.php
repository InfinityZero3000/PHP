@php
    $items = [
        ['label' => 'Trang chủ', 'url' => route('home')],
    ];

    if (request()->routeIs('articles.*')) {
        $items[] = ['label' => 'Articles', 'url' => route('articles.index')];
    }

    if (request()->routeIs('articles.create')) {
        $items[] = ['label' => 'Tạo bài viết', 'url' => null];
    } elseif (request()->routeIs('articles.edit')) {
        $items[] = ['label' => 'Sửa bài viết', 'url' => null];
    } elseif (request()->routeIs('articles.binding.show')) {
        $items[] = ['label' => 'Route Model Binding', 'url' => null];
    }
@endphp

<div class="breadcrumb">
    @foreach ($items as $item)
        @if (!$loop->first)
            <span>/</span>
        @endif

        @if ($item['url'])
            <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
        @else
            <span>{{ $item['label'] }}</span>
        @endif
    @endforeach
</div>
