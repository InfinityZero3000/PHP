@props(['age' => null])

@php
    // Ép tuổi về số nguyên trước khi so sánh.
    $normalizedAge = (int) ($age ?? 0);
    // Người đủ 18 tuổi được xem là người trưởng thành.
    $isAdult = $normalizedAge >= 18;
@endphp

{{-- Badge đổi màu và nội dung tùy theo độ tuổi. --}}
<span style="display:inline-block;padding:3px 9px;border-radius:999px;font-size:12px;background:{{ $isAdult ? '#dcfce7' : '#fee2e2' }};color:{{ $isAdult ? '#166534' : '#7f1d1d' }};">
    {{ $isAdult ? 'Adult (≥18)' : 'Under 18' }}
</span>
