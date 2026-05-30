@props(['title'])

<div class="bg-white rounded-xl border border-gray-100 shadow-sm px-5 py-4">
    <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">{{ $title }}</p>
    {{ $slot }}
</div>
