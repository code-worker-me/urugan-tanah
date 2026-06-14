@props([
    'href' => '#',
    'color' => 'blue'
])

@php
    // Memetakan pilihan warna ke class Tailwind CSS
    $colorClasses = [
        'blue' => 'bg-blue-600 hover:bg-blue-700 text-white',
        'red'  => 'bg-red-600 hover:bg-red-700 text-white',
        'green'  => 'bg-green-600 hover:bg-green-700 text-white',
    ][$color] ?? 'bg-blue-600 hover:bg-blue-700 text-white'; // Fallback ke biru jika warna tidak terdaftar
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => "inline-flex items-center gap-2 text-sm font-medium px-4 py-2 rounded-lg transition " . $colorClasses]) }}>
    {{ $slot }}
</a>
