@props([
    'text' => 'left',
])

@php
    $textAlign = [
        'center' => 'text-center',
        'right'  => 'text-right',
    ][$text] ?? 'text-left';
@endphp

<th {{ $attributes->merge(['class' => "px-4 py-3.5 text-xs font-bold text-white uppercase tracking-wider whitespace-nowrap " . $textAlign]) }}>
    {{ $slot }}
</th>

