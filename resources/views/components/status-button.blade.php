@props([
    'action',
    'value',
    'icon'
])

@php
    // Memetakan warna tombol berdasarkan value status
    $colorClasses = match($value) {
        'accepted' => 'bg-green-600 hover:bg-green-700 focus:ring-green-500',
        'decline'  => 'bg-red-600 hover:bg-red-700 focus:ring-red-500',
        default    => 'bg-gray-600 hover:bg-gray-700 focus:ring-gray-500'
    };

    // Format label teks agar huruf pertamanya kapital (misal: accepted -> Accept)
    $label = ucfirst($value);
@endphp

<form action="{{ $action }}" method="POST" class="inline-block">
    @csrf
    @method('PATCH')

    <input type="hidden" name="status" value="{{ $value }}">

    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin mengubah status menjadi {{ $value }}?')"
        {{ $attributes->merge(['class' => "inline-flex items-center gap-2 px-4 py-2 active:scale-95 text-white text-sm font-semibold rounded-lg shadow-sm transition focus:outline-none focus:ring-2 focus:ring-offset-2 " . $colorClasses]) }}>

        <x-dynamic-component :component="'ionicon-' . $icon . '-sharp'" class="w-4 h-4" />

        {{ $label }}
    </button>
</form>
