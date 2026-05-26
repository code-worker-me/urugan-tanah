@props([
    'editUrl',
    'deleteUrl'
])

<div {{ $attributes->merge(['class' => 'inline-flex items-center gap-2']) }}>
    <a href="{{ $editUrl }}" class="text-indigo-600 hover:text-indigo-800 font-medium transition">
        Edit
    </a>

    <span class="text-gray-300">|</span>

    <form action="{{ $deleteUrl }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-red-500 hover:text-red-700 font-medium transition">
            Hapus
        </button>
    </form>
</div>
