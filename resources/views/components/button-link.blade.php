@props([
    'href' => '#',
    'color' => 'blue'
])

@php
    $colorClasses = [
        'blue' => 'bg-gradient-to-r from-blue-700 to-blue-600 hover:from-blue-800 hover:to-blue-700 text-white shadow-md shadow-blue-600/20 hover:shadow-lg hover:shadow-blue-600/30',
        'red'  => 'bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white shadow-md shadow-red-600/20 hover:shadow-lg hover:shadow-red-600/30',
        'green'  => 'bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white shadow-md shadow-emerald-600/20 hover:shadow-lg hover:shadow-emerald-600/30',
    ][$color] ?? 'bg-gradient-to-r from-blue-700 to-blue-600 hover:from-blue-800 hover:to-blue-700 text-white shadow-md shadow-blue-600/20 hover:shadow-lg hover:shadow-blue-600/30';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => "inline-flex items-center gap-2 text-sm font-semibold px-4 py-2.5 rounded-xl transition-all duration-200 active:scale-95 " . $colorClasses]) }}>
    {{ $slot }}
</a>

