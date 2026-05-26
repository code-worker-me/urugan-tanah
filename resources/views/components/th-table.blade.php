@props([
    'text' => 'left',
])

@php
    // Memetakan pilihan warna ke class Tailwind CSS
    $textAlign = [
        'center' => 'text-center',
    ][$text] ?? 'text-left'; // Fallback ke biru jika warna tidak terdaftar
@endphp

<th {{ $attributes->merge(['class' => "px-4 py-3 font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap " . $textAlign]) }}>
    {{ $slot }}
</th>
