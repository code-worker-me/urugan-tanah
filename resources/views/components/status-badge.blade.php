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
    'green' => 'bg-emerald-100 text-emerald-800 border border-emerald-200',
    'red' => 'bg-red-100 text-red-800 border border-red-200',
    'gray', 'slate' => 'bg-slate-100 text-slate-700 border border-slate-200',
    'blue', 'indigo' => 'bg-blue-100 text-blue-800 border border-blue-200',
    default => 'bg-amber-100 text-amber-800 border border-amber-200'
}]) }}>

    <span class="rounded-full animate-pulse {{ $badgeSize }} {{ match($color) {
        'green' => 'bg-emerald-500',
        'red' => 'bg-red-500',
        'gray', 'slate' => 'bg-slate-400',
        'blue', 'indigo' => 'bg-blue-500',
        default => 'bg-amber-500'
    } }}"></span>

    {{ $slot }}
</span>
