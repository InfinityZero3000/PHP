@props(['title'])

{{-- Bài 10: component nhận tiêu đề qua thuộc tính và nội dung qua $slot. --}}
<section>
    <h2>{{ $title }}</h2>
    <div>{{ $slot }}</div>
</section>
