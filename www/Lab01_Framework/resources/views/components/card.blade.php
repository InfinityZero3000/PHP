@props(['title'])

{{-- Component card nhận tiêu đề qua prop và nội dung qua slot theo Bài 10. --}}
<section {{ $attributes->class(['card']) }}>
    <h2 class="card-title">{{ $title }}</h2>
    <div>{{ $slot }}</div>
</section>
