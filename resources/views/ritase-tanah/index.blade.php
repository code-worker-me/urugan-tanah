{{-- resources/views/ritasi-tanah/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            @can('view-dashboard')
            <a href="{{ route('urugan.view', $urugan) }}"
               class="text-gray-400 hover:text-gray-600 transition">
                   <x-ionicon-chevron-back-outline class="w-5 h-5" />
            </a>
            @endcan
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Ritasi Tanah</h2>
                <p class="text-xs text-gray-400 mt-0.5">{{ $urugan->nama_pt }} &mdash; {{ $urugan->lokasi }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-5">

            @if (session('success'))
                <div class="flex items-center gap-3 px-4 py-3 bg-green-50 border border-green-200 rounded-lg text-sm text-green-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Summary Cards --}}
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <x-sum-card title="Total Ritasi">
                    <p class="text-2xl font-bold text-gray-800">{{ $urugan->total_ritasi }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">jumlah truk</p>
                </x-sum-card>
                <x-sum-card title="Total Volume">
                    <p class="text-2xl font-bold text-indigo-600">{{ number_format($urugan->total_volume, 1, ',', '.') }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">m³</p>
                </x-sum-card>
                <x-sum-card title="Luas Proyek">
                    <p class="text-2xl font-bold text-gray-800">{{ number_format($urugan->luas_tanah, 0, ',', '.') }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">m²</p>
                </x-sum-card>
                <x-sum-card title="Status Proyek">
                    @if ($urugan->status === 'accepted')
                    <x-status-badge size="big" padd="big" color="green">Accepted</x-status-badge>
                    @elseif ($urugan->status === 'decline')
                    <x-status-badge size="big" padd="big" color="red">Decline</x-status-badge>
                    @else
                    <x-status-badge size="big" padd="big" color="yellow">Pending</x-status-badge>
                    @endif
                </x-sum-card>
            </div>

            {{-- Table Card --}}
            <div class="bg-white shadow-sm sm:rounded-xl border border-gray-100">
                <header class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-900">Daftar Ritasi Kendaraan</h3>
                    @can('lapangan')
                        @if($urugan->status === 'accepted')
                        <x-button-link href="{{ route('ritase.create', $urugan) }}">Tambah Kendaraan</x-button-link>
                        @endif
                    @endcan
                </header>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <x-th-table>#</x-th-table>
                                <x-th-table>No. Plat</x-th-table>
                                <x-th-table>Tanggal</x-th-table>
                                <x-th-table>P (m)</x-th-table>
                                <x-th-table>L (m)</x-th-table>
                                <x-th-table>T (m)</x-th-table>
                                <x-th-table>Volume (m³)</x-th-table>
                                @can('kantor')
                                    <x-th-table text="center">Aksi</x-th-table>
                                @endcan
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 bg-white">

                            @forelse ($ritase as $i => $ritasi)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-gray-400">{{ $ritase->firstItem() + $i }}</td>

                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-gray-100 text-gray-700 text-xs font-bold tracking-widest uppercase">
                                        {{ $ritasi->no_plat }}
                                    </span>
                                </td>

                                <td class="px-4 py-3 text-gray-600 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($ritasi->tanggal)->translatedFormat('d M Y, H:i') }}
                                </td>

                                <td class="px-4 py-3 text-center text-gray-600">{{ number_format($ritasi->panjang, 2) }}</td>
                                <td class="px-4 py-3 text-center text-gray-600">{{ number_format($ritasi->lebar, 2) }}</td>
                                <td class="px-4 py-3 text-center text-gray-600">{{ number_format($ritasi->tinggi, 2) }}</td>

                                <td class="px-4 py-3 text-center">
                                    <span class="font-semibold text-indigo-600">
                                        {{ number_format($ritasi->volume, 1, ',', '.') }} m³
                                    </span>
                                </td>

                                @canany('kantor')
                                <td class="px-4 py-3 text-center">
                                    <!--<x-button-action editUrl="{{ route('ritase.edit', [$urugan->id, $ritasi->id]) }}" deleteUrl="{{ route('ritase.delete', [$urugan->id, $ritasi->id]) }}" />-->
                                    <div class="inline-flex items-center gap-2">

                                        <a href="{{ route('ritase.edit', [$urugan->id, $ritasi->id]) }}" class="text-indigo-600 hover:text-indigo-800 font-medium transition">
                                            Edit
                                        </a>


                                        <span class="text-gray-300">|</span>
                                        <form action="{{ route('ritase.delete', [$urugan->id, $ritasi->id]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 font-medium transition">
                                                Hapus
                                            </button>
                                        </form>

                                    </div>
                                </td>
                                @endcan
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="px-4 py-12 text-center text-gray-400 italic">
                                    Belum ada data ritasi. Klik "Tambah Ritasi" untuk memulai.
                                </td>
                            </tr>
                            @endforelse

                        </tbody>

                        @if ($ritase->count() > 0)
                        <tfoot class="bg-indigo-50 border-t-2 border-indigo-100">
                            <tr>
                                <td colspan="6" class="px-4 py-3 text-sm font-bold text-indigo-700 text-right">
                                    Total Volume Keseluruhan:
                                </td>
                                <td class="px-4 py-3 text-center font-bold text-indigo-700">
                                    {{ number_format($urugan->total_volume, 1, ',', '.') }} m³
                                </td>
                                <td colspan="2"></td>
                            </tr>
                        </tfoot>
                        @endif

                    </table>
                </div>

                @if ($ritase->hasPages())
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $ritase->links() }}
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
