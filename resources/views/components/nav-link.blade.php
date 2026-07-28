@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-3 py-1.5 border-b-2 border-red-600 text-sm font-extrabold leading-5 text-blue-900 bg-blue-50/80 rounded-t-xl transition duration-150 ease-in-out'
            : 'inline-flex items-center px-3 py-1.5 border-b-2 border-transparent text-sm font-semibold leading-5 text-slate-600 hover:text-blue-800 hover:bg-slate-100/70 rounded-t-xl transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
