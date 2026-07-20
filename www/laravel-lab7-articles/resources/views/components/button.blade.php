@props(['type' => 'button', 'variant' => 'primary'])

@php
    $styles = [
        'primary' => 'background:#2563eb;color:#fff;border:1px solid #2563eb',
        'danger' => 'background:#dc2626;color:#fff;border:1px solid #dc2626',
        'secondary' => 'background:#fff;color:#111827;border:1px solid #d1d5db',
    ];

    $baseStyle = 'padding:8px 12px;border-radius:6px;cursor:pointer;';
    $customStyle = $attributes->get('style', '');
@endphp

<button
    type="{{ $type }}"
    {{ $attributes->except('style')->merge([
        'style' => $baseStyle.($styles[$variant] ?? $styles['primary']).';'.$customStyle,
    ]) }}
>
    {{ $slot }}
</button>
