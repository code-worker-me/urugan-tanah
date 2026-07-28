<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-white border border-gray-200 text-gray-500 hover:text-indigo-600 hover:border-indigo-200 hover:bg-indigo-50/50 transition duration-200 shadow-xs">
                    <x-ionicon-chevron-back-outline class="w-5 h-5" />
                </a>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-semibold uppercase tracking-wider text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-md border border-indigo-100">Urugan Tanah</span>
                        <span class="text-xs text-gray-400">&bull;</span>
                        <span class="text-xs text-gray-500 font-medium">Detail Pengajuan</span>
                    </div>
                    <h2 class="font-bold text-xl text-gray-900 leading-tight mt-0.5">
                        {{ $urugan->nama_pt }}
                    </h2>
                </div>
            </div>

            {{-- Status & Quick Action Buttons --}}
            <div class="flex flex-wrap items-center gap-2.5">
                @if ($urugan->status === 'accepted')
                    <a href="{{ route('ritase.index', $urugan) }}"
                       class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white font-semibold text-xs shadow-md shadow-indigo-200 transition duration-150">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                        Ritase Tanah
                    </a>
                    <a href="{{ route('jadwalUrugan.index', $urugan) }}"
                       class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-semibold text-xs shadow-md shadow-emerald-200 transition duration-150">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Jadwal Truk
                    </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- ===== TOP BAR CARD: STATUS & ACTIONS ===== --}}
            <div class="bg-white rounded-2xl border border-gray-100 p-5 md:p-6 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-50 border border-indigo-100 text-indigo-600 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block">Status Pengajuan Proyek</span>
                        <div class="flex items-center gap-2 mt-1">
                            @if ($urugan->status === 'accepted')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-bold">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Disetujui (Accepted)
                                </span>
                            @elseif ($urugan->status === 'decline')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-rose-50 text-rose-700 border border-rose-200 text-xs font-bold">
                                    <span class="w-2 h-2 rounded-full bg-rose-500"></span> Ditolak (Decline)
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 text-amber-700 border border-amber-200 text-xs font-bold">
                                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span> Menunggu Peninjauan (Pending)
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Action Buttons for Status Update (Role: Kantor) --}}
                @if ($urugan->status === 'pending')
                    @can('kantor')
                        <div class="flex items-center gap-2.5 pt-3 md:pt-0 border-t md:border-t-0 border-gray-100">
                            <span class="text-xs text-gray-400 font-medium hidden sm:block">Aksi Kantor:</span>
                            <form action="{{ route('urugan.update-status', $urugan) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="accepted">
                                <button type="submit"
                                        onclick="return confirm('Apakah Anda yakin ingin MENERIMA pengajuan ini?')"
                                        class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs shadow-sm transition">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Setujui Pengajuan
                                </button>
                            </form>

                            <form action="{{ route('urugan.update-status', $urugan) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="decline">
                                <button type="submit"
                                        onclick="return confirm('Apakah Anda yakin ingin MENOLAK pengajuan ini?')"
                                        class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 hover:bg-rose-100 font-semibold text-xs transition">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Tolak Pengajuan
                                </button>
                            </form>
                        </div>
                    @endcan
                    @can('konstruktor')
                        <p class="text-xs text-amber-600 bg-amber-50 px-3 py-1.5 rounded-lg border border-amber-200 font-medium italic">
                            Pengajuan urugan tanah ini sedang dalam proses peninjauan oleh tim kantor.
                        </p>
                    @endcan
                @endif
            </div>

            {{-- ===== MAIN CONTENT GRID ===== --}}
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

                {{-- LEFT COLUMN: Detail Data (2/5) --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- Card 1: Informasi Perusahaan --}}
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-xl shadow-gray-100/80 overflow-hidden">
                        <div class="px-5 py-4 border-b border-gray-100 bg-gray-50/80 flex items-center gap-2">
                            <div class="w-7 h-7 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h4m-4 0V11m0 0h4m-4 0H9m4 0V5" />
                                </svg>
                            </div>
                            <h3 class="text-xs font-bold uppercase tracking-wider text-gray-800">
                                Informasi Perusahaan
                            </h3>
                        </div>
                        <div class="divide-y divide-gray-50 text-sm">
                            <div class="p-4 space-y-1">
                                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Nama Perusahaan</p>
                                <p class="font-bold text-gray-900">{{ $urugan->nama_pt }}</p>
                            </div>

                            <div class="p-4 space-y-1">
                                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Alamat Perusahaan</p>
                                <p class="text-gray-700 leading-relaxed">{{ $urugan->alamat_pt }}</p>
                            </div>

                            <div class="p-4 space-y-1">
                                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Penanggung Jawab / Konstruktor</p>
                                <div class="flex items-center gap-2.5 mt-1">
                                    <div class="w-8 h-8 rounded-xl bg-indigo-100 text-indigo-700 font-bold text-xs flex items-center justify-center flex-shrink-0">
                                        {{ strtoupper(substr($urugan->nama_konstruktor, 0, 2)) }}
                                    </div>
                                    <p class="font-semibold text-gray-800">{{ $urugan->nama_konstruktor }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Card 2: Detail Lahan & Proyek --}}
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-xl shadow-gray-100/80 overflow-hidden">
                        <div class="px-5 py-4 border-b border-gray-100 bg-gray-50/80 flex items-center gap-2">
                            <div class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l5.447 2.724A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                </svg>
                            </div>
                            <h3 class="text-xs font-bold uppercase tracking-wider text-gray-800">
                                Detail Lahan Proyek
                            </h3>
                        </div>
                        <div class="divide-y divide-gray-50 text-sm">
                            <div class="p-4 space-y-1">
                                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Tanggal Mulai Proyek</p>
                                <div class="flex items-center gap-2 text-gray-800 font-semibold">
                                    <svg class="w-4 h-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>{{ \Carbon\Carbon::parse($urugan->tanggal_mulai)->translatedFormat('d F Y') }}</span>
                                </div>
                            </div>

                            <div class="p-4 space-y-1">
                                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Luas Tanah</p>
                                <div class="flex items-baseline gap-1">
                                    <span class="text-2xl font-extrabold text-gray-900">{{ number_format($urugan->luas_tanah, 0, ',', '.') }}</span>
                                    <span class="text-xs font-bold text-gray-400">m²</span>
                                </div>
                            </div>

                            <div class="p-4 space-y-1">
                                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Lokasi Proyek</p>
                                <div class="flex items-start gap-2 text-gray-700">
                                    <svg class="w-4 h-4 text-rose-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span>{{ $urugan->lokasi }}</span>
                                </div>
                            </div>

                            <div class="p-4 space-y-1">
                                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Dibuat Pada</p>
                                <p class="text-xs text-gray-500 font-medium">
                                    {{ \Carbon\Carbon::parse($urugan->created_at)->translatedFormat('d F Y, H:i') }} WIB
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Card 3: Admin Lapangan Assignment --}}
                    @if ($urugan->status === 'accepted')
                        <div class="bg-white rounded-2xl border border-gray-100 shadow-xl shadow-gray-100/80 overflow-hidden">
                            <div class="px-5 py-4 border-b border-gray-100 bg-gray-50/80 flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-xs font-bold uppercase tracking-wider text-gray-800">
                                        Petugas Admin Lapangan
                                    </h3>
                                </div>
                            </div>

                            <div class="p-5 space-y-4">
                                @if($urugan->adminLapangan)
                                    <div class="p-4 rounded-xl bg-indigo-50/50 border border-indigo-100 flex items-center gap-3.5">
                                        <div class="w-10 h-10 rounded-xl bg-indigo-600 text-white flex items-center justify-center font-bold text-xs uppercase shadow-xs flex-shrink-0">
                                            {{ substr($urugan->adminLapangan->name, 0, 2) }}
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <span class="text-[10px] font-bold uppercase tracking-wider text-indigo-600 block">Petugas Aktif</span>
                                            <h4 class="text-sm font-bold text-gray-900 truncate">
                                                {{ $urugan->adminLapangan->name }}
                                            </h4>
                                            <p class="text-xs text-gray-500 truncate">{{ $urugan->adminLapangan->email }}</p>
                                        </div>
                                    </div>
                                @else
                                    <div class="p-4 rounded-xl bg-amber-50 border border-amber-200 text-amber-800 flex items-start gap-3">
                                        <svg class="w-5 h-5 text-amber-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                        </svg>
                                        <p class="text-xs font-medium">Belum ada admin lapangan yang ditugaskan untuk mengawasi proyek ini.</p>
                                    </div>
                                @endif

                                @can('kantor')
                                    <form action="{{ route('lapangan.update', $urugan->id) }}" method="POST" class="space-y-3 pt-2">
                                        @csrf
                                        @method('PUT')

                                        <div class="space-y-1">
                                            <label class="block text-xs font-semibold text-gray-700">
                                                {{ $urugan->adminLapangan ? 'Ganti Penugasan Admin' : 'Pilih & Tugaskan Admin' }}
                                            </label>
                                            <div class="relative">
                                                <select name="admin_lapangan_id" required
                                                        class="w-full rounded-xl border @error('admin_lapangan_id') border-red-300 bg-red-50/30 @else border-gray-200 bg-white @enderror px-3.5 py-2.5 text-xs text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition appearance-none cursor-pointer">
                                                    <option value="" disabled {{ is_null($urugan->adminLapangan) ? 'selected' : '' }}>-- Pilih Personel Lapangan --</option>
                                                    @foreach ($usersLapangan as $user)
                                                        <option value="{{ $user->id }}" {{ optional($urugan->adminLapangan)->id == $user->id ? 'selected' : '' }}>
                                                            {{ $user->name }} ({{ $user->email }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            @error('admin_lapangan_id')
                                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <button type="submit"
                                                class="w-full inline-flex justify-center items-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-xl shadow-xs transition duration-150 cursor-pointer">
                                            Simpan Penugasan
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    @endif

                </div>

                {{-- RIGHT COLUMN: PDF Viewer (3/5) --}}
                <div class="lg:col-span-3">
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-xl shadow-gray-100/80 overflow-hidden h-full flex flex-col min-h-[600px]">

                        <div class="px-5 py-4 border-b border-gray-100 bg-gray-50/80 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-lg bg-red-50 text-red-600 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <h3 class="text-xs font-bold uppercase tracking-wider text-gray-800">
                                    Dokumen Pendukung (SPK / Kontrak)
                                </h3>
                            </div>

                            @if ($urugan->fileupload)
                                <a href="{{ asset('storage/' . $urugan->fileupload) }}" download
                                   class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 rounded-lg border border-indigo-200 transition">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    Unduh PDF
                                </a>
                            @endif
                        </div>

                        {{-- PDF iframe --}}
                        <div class="flex-1 min-h-0 bg-slate-900">
                            @if ($urugan->fileupload)
                                <iframe src="{{ asset('storage/' . $urugan->fileupload) }}#toolbar=1&navpanes=0&scrollbar=1"
                                        class="w-full h-full min-h-[620px] border-0"
                                        title="Dokumen Urugan Tanah - {{ $urugan->nama_pt }}">
                                    <div class="flex flex-col items-center justify-center h-full gap-3 p-6 text-center text-white">
                                        <p class="text-sm">Browser Anda tidak mendukung pratinjau PDF.</p>
                                        <a href="{{ asset('storage/' . $urugan->fileupload) }}"
                                           class="text-xs text-indigo-300 underline font-semibold">
                                            Klik di sini untuk membuka dokumen
                                        </a>
                                    </div>
                                </iframe>
                            @else
                                <div class="flex flex-col items-center justify-center gap-3 p-12 text-center h-full min-h-[600px] bg-gray-50">
                                    <div class="w-16 h-16 rounded-2xl bg-gray-100 text-gray-300 flex items-center justify-center">
                                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <p class="text-sm font-semibold text-gray-500">Tidak ada dokumen pendukung yang diunggah.</p>
                                    <p class="text-xs text-gray-400">Berkas PDF pengajuan tidak tersedia untuk proyek ini.</p>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>

            </div>{{-- end grid --}}

        </div>
    </div>
</x-app-layout>