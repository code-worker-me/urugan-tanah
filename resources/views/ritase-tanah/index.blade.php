<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div class="flex items-center gap-3">
                @can('view-dashboard')
                <a href="{{ route('urugan.view', $urugan) }}"
                   class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-white border border-gray-200 text-gray-500 hover:text-indigo-600 hover:border-indigo-200 hover:bg-indigo-50/50 transition duration-200 shadow-xs">
                    <x-ionicon-chevron-back-outline class="w-5 h-5" />
                </a>
                @endcan
                <div>
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-semibold uppercase tracking-wider text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-md border border-indigo-100">Ritase Tanah</span>
                        <span class="text-xs text-gray-400">&bull;</span>
                        <span class="text-xs text-gray-500 font-medium truncate max-w-[200px] sm:max-w-xs">{{ $urugan->nama_pt }}</span>
                    </div>
                    <h2 class="font-bold text-xl text-gray-900 leading-tight mt-0.5">
                        Pencatatan Ritase Kendaraan
                    </h2>
                </div>
            </div>
            @can('lapangan')
                @if($urugan->status === 'accepted')
                <a href="{{ route('ritase.create', $urugan) }}"
                   class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold text-sm shadow-md shadow-indigo-200/80 transition duration-150 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Ritase Baru
                </a>
                @endif
            @endcan
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Flash Alert --}}
            @if (session('success'))
                <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-2xl shadow-xs flex items-center justify-between gap-3 text-emerald-800 text-sm font-medium">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            {{-- Location Header Card --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-start gap-3.5">
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 border border-indigo-100 text-indigo-600 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-gray-900">{{ $urugan->nama_pt }}</h3>
                        <p class="text-xs text-gray-500 mt-0.5 flex items-center gap-1.5">
                            <span>Lokasi: {{ $urugan->lokasi }}</span>
                            <span>&bull;</span>
                            <span>Penanggung Jawab: {{ $urugan->nama_konstruktor }}</span>
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-2 self-start md:self-auto">
                    <span class="text-xs font-medium text-gray-500">Status Proyek:</span>
                    @if ($urugan->status === 'accepted')
                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-semibold">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Accepted
                        </span>
                    @elseif ($urugan->status === 'decline')
                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-rose-50 text-rose-700 border border-rose-200 text-xs font-semibold">
                            <span class="w-2 h-2 rounded-full bg-rose-500"></span> Decline
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-amber-50 text-amber-700 border border-amber-200 text-xs font-semibold">
                            <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span> Pending
                        </span>
                    @endif
                </div>
            </div>

            {{-- Summary Metric Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                {{-- Metric 1 --}}
                <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm hover:shadow-md transition duration-200 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Total Ritasi</p>
                        <h4 class="text-2xl font-extrabold text-gray-900 mt-1">{{ number_format($urugan->total_ritasi ?? 0, 0, ',', '.') }}</h4>
                        <p class="text-xs text-gray-500 mt-0.5">Jumlah rit armada truk</p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-indigo-50 border border-indigo-100 text-indigo-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </div>
                </div>

                {{-- Metric 2 --}}
                <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm hover:shadow-md transition duration-200 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Total Volume</p>
                        <h4 class="text-2xl font-extrabold text-indigo-600 mt-1">{{ number_format($urugan->total_volume ?? 0, 1, ',', '.') }} <span class="text-sm font-semibold text-indigo-400">m³</span></h4>
                        <p class="text-xs text-gray-500 mt-0.5">Akumulasi volume muatan</p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-purple-50 border border-purple-100 text-purple-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                </div>

                {{-- Metric 3 --}}
                <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm hover:shadow-md transition duration-200 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Luas Proyek</p>
                        <h4 class="text-2xl font-extrabold text-gray-900 mt-1">{{ number_format($urugan->luas_tanah ?? 0, 0, ',', '.') }} <span class="text-sm font-semibold text-gray-400">m²</span></h4>
                        <p class="text-xs text-gray-500 mt-0.5">Target area urugan</p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-100 text-emerald-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                        </svg>
                    </div>
                </div>

                {{-- Metric 4 --}}
                <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm hover:shadow-md transition duration-200 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Rata-rata / Rit</p>
                        <h4 class="text-2xl font-extrabold text-gray-900 mt-1">
                            {{ $urugan->total_ritasi > 0 ? number_format($urugan->total_volume / $urugan->total_ritasi, 1, ',', '.') : 0 }}
                            <span class="text-sm font-semibold text-gray-400">m³</span>
                        </h4>
                        <p class="text-xs text-gray-500 mt-0.5">Estimasi kapasitas per truk</p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-amber-50 border border-amber-100 text-amber-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Table Card --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-xl shadow-gray-100/80 overflow-hidden">
                <header class="px-6 py-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white">
                    <div>
                        <h3 class="text-base font-bold text-gray-900">Daftar Ritasi Kendaraan</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Riwayat ritasi pengiriman tanah ke lokasi proyek</p>
                    </div>
                    @can('lapangan')
                        @if($urugan->status === 'accepted')
                        <a href="{{ route('ritase.create', $urugan) }}"
                           class="inline-flex items-center justify-center gap-2 px-3.5 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs shadow-xs transition duration-150">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Kendaraan
                        </a>
                        @endif
                    @endcan
                </header>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100 text-sm">
                        <thead class="bg-gray-50/80 text-gray-500 font-semibold text-xs uppercase tracking-wider">
                            <tr>
                                <th scope="col" class="px-5 py-3.5 text-left">#</th>
                                <th scope="col" class="px-5 py-3.5 text-left">No. Plat Kendaraan</th>
                                <th scope="col" class="px-5 py-3.5 text-left">Tanggal & Waktu</th>
                                <th scope="col" class="px-5 py-3.5 text-center">Panjang (m)</th>
                                <th scope="col" class="px-5 py-3.5 text-center">Lebar (m)</th>
                                <th scope="col" class="px-5 py-3.5 text-center">Tinggi (m)</th>
                                <th scope="col" class="px-5 py-3.5 text-center">Volume (m³)</th>
                                <th scope="col" class="px-5 py-3.5 text-center">Foto Muatan</th>
                                @can('kantor')
                                <th scope="col" class="px-5 py-3.5 text-center">Aksi</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse ($ritase as $i => $ritasi)
                            <tr class="hover:bg-gray-50/60 transition duration-150">
                                <td class="px-5 py-4 text-xs text-gray-400 font-medium">{{ $ritase->firstItem() + $i }}</td>

                                <td class="px-5 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-3 py-1 rounded-lg bg-gray-100 border border-gray-200 text-gray-800 text-xs font-bold tracking-widest uppercase">
                                        {{ $ritasi->no_plat }}
                                    </span>
                                </td>

                                <td class="px-5 py-4 text-xs text-gray-600 whitespace-nowrap">
                                    <div class="font-semibold text-gray-800">{{ \Carbon\Carbon::parse($ritasi->tanggal)->translatedFormat('d M Y') }}</div>
                                    <div class="text-gray-400 text-[11px]">{{ \Carbon\Carbon::parse($ritasi->tanggal)->format('H:i') }} WIB</div>
                                </td>

                                <td class="px-5 py-4 text-center text-xs text-gray-700 font-medium">{{ number_format($ritasi->panjang, 2) }}</td>
                                <td class="px-5 py-4 text-center text-xs text-gray-700 font-medium">{{ number_format($ritasi->lebar, 2) }}</td>
                                <td class="px-5 py-4 text-center text-xs text-gray-700 font-medium">{{ number_format($ritasi->tinggi, 2) }}</td>

                                <td class="px-5 py-4 text-center whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-indigo-50 text-indigo-700 font-bold text-xs">
                                        {{ number_format($ritasi->volume, 1, ',', '.') }} m³
                                    </span>
                                </td>

                                {{-- Foto Muatan --}}
                                <td class="px-5 py-4 text-center whitespace-nowrap">
                                    @if ($ritasi->foto)
                                        <button type="button"
                                                onclick="openImageModal('{{ asset('storage/' . $ritasi->foto) }}', '{{ $ritasi->no_plat }}')"
                                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-gray-50 border border-gray-200 hover:border-indigo-300 hover:bg-indigo-50 text-gray-600 hover:text-indigo-600 text-xs font-medium transition group">
                                            <svg class="w-3.5 h-3.5 text-gray-400 group-hover:text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            Lihat Foto
                                        </button>
                                    @else
                                        <span class="text-xs text-gray-300 italic">Tidak ada</span>
                                    @endif
                                </td>

                                @can('kantor')
                                <td class="px-5 py-4 text-center whitespace-nowrap">
                                    <div class="inline-flex items-center gap-2">
                                        <a href="{{ route('ritase.edit', [$urugan->id, $ritasi->id]) }}"
                                           class="p-1.5 rounded-lg bg-indigo-50 hover:bg-indigo-100 text-indigo-600 transition"
                                           title="Edit Ritase">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        <form action="{{ route('ritase.delete', [$urugan->id, $ritasi->id]) }}"
                                              method="POST"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ritase ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="p-1.5 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 transition cursor-pointer"
                                                    title="Hapus Ritase">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                @endcan
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="px-6 py-12 text-center">
                                    <div class="max-w-xs mx-auto text-center space-y-3">
                                        <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-400 flex items-center justify-center mx-auto">
                                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                            </svg>
                                        </div>
                                        <p class="text-sm font-semibold text-gray-700">Belum ada data ritase</p>
                                        <p class="text-xs text-gray-400">Belum ada pencatatan ritasi kendaraan untuk proyek urugan ini.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>

                        @if ($ritase->count() > 0)
                        <tfoot class="bg-indigo-50/70 border-t-2 border-indigo-100">
                            <tr>
                                <td colspan="6" class="px-5 py-3.5 text-xs font-bold uppercase tracking-wider text-indigo-800 text-right">
                                    Total Volume Keseluruhan:
                                </td>
                                <td class="px-5 py-3.5 text-center font-extrabold text-indigo-700 text-sm">
                                    {{ number_format($urugan->total_volume ?? 0, 1, ',', '.') }} m³
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

    {{-- Modal Preview Foto --}}
    <div id="imageModal" class="fixed inset-0 z-50 hidden bg-black/70 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="relative bg-white rounded-2xl max-w-lg w-full overflow-hidden shadow-2xl">
            <div class="flex items-center justify-between p-4 border-b border-gray-100">
                <h4 id="modalPlatTitle" class="text-sm font-bold text-gray-800"></h4>
                <button type="button" onclick="closeImageModal()" class="text-gray-400 hover:text-gray-600 p-1 rounded-lg">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="p-4 bg-gray-900 flex justify-center">
                <img id="modalImage" src="" alt="Foto Muatan" class="max-h-96 object-contain rounded-lg">
            </div>
        </div>
    </div>

    <script>
        function openImageModal(url, plat) {
            document.getElementById('modalImage').src = url;
            document.getElementById('modalPlatTitle').textContent = 'Foto Muatan Kendaraan (' + plat + ')';
            document.getElementById('imageModal').classList.remove('hidden');
        }
        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
