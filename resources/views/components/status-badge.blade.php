@props([
    'size' => 'small',
    'padd' => 'small',
    'color' => 'yellow'
])

@php
    // Menentukan ukuran dot indikator
    $badgeSize = [
        'big' => 'w-2 h-2',
        'small' => 'w-1.5 h-1.5',
    ][$size] ?? 'w-1.5 h-1.5';

    // Menentukan ukuran padding badge
    $paddSize = [
        'big' => 'px-3 py-1 text-sm',
        'small' => 'px-2.5 py-0.5 text-xs',
    ][$padd] ?? 'px-2.5 py-0.5';
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center gap-1.5 rounded-full font-semibold " . $paddSize . " " . match($color) {
    'green' => 'bg-green-100 text-green-700',
    'red' => 'bg-red-100 text-red-700',
    default => 'bg-yellow-100 text-yellow-700'
}]) }}>

    <span class="rounded-full animate-pulse {{ $badgeSize }} {{ match($color) {
        'green' => 'bg-green-500',
        'red' => 'bg-red-500',
        default => 'bg-yellow-500'
    } }}"></span>

    {{ $slot }}
</span>
