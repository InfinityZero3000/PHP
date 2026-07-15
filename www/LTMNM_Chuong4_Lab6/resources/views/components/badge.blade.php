@props(['age'])

@php
    // Ép kiểu để component luôn so sánh tuổi bằng số nguyên.
    $isAdult = (int) ($age ?? 0) >= 18;
@endphp

<span>{{ $isAdult ? 'Adult (>= 18)' : 'Under 18' }}</span>
