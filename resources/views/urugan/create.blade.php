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
                        <span class="text-xs text-gray-500 font-medium">Tambah Baru</span>
                    </div>
                    <h2 class="font-bold text-xl text-gray-900 leading-tight mt-0.5">
                        {{ __('Pengajuan Urugan Tanah Baru') }}
                    </h2>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Header Banner Card --}}
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-indigo-700 via-indigo-600 to-purple-700 p-6 md:p-8 text-white shadow-xl shadow-indigo-100">
                <div class="absolute -right-6 -bottom-10 opacity-10 pointer-events-none">
                    <svg class="w-72 h-72 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zM7 10h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
                    </svg>
                </div>
                <div class="relative z-10 max-w-xl">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-xs font-medium mb-3">
                        <svg class="w-3.5 h-3.5 text-indigo-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Formulir Pengajuan Proyek
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold tracking-tight">Isi Data Pengajuan Urugan Tanah</h3>
                    <p class="mt-1.5 text-sm text-indigo-100/90 leading-relaxed">
                        Lengkapi rincian informasi perusahaan, detail lokasi proyek, serta lampirkan dokumen pendukung untuk memproses izin pengajuan urugan.
                    </p>
                </div>
            </div>

            {{-- Form Errors Banner --}}
            @if ($errors->any())
                <div class="p-4 md:p-5 bg-red-50/90 backdrop-blur-sm border border-red-200 rounded-2xl shadow-sm flex gap-4 items-start">
                    <div class="w-9 h-9 rounded-xl bg-red-100 border border-red-200 text-red-600 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-sm font-bold text-red-800">Terdapat kesalahan input:</h4>
                        <ul class="mt-1.5 list-disc list-inside text-sm text-red-600 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            {{-- Main Form Card --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-xl shadow-gray-100/80 overflow-hidden">
                <form action="{{ route('urugan.store') }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8 space-y-8">
                    @csrf

                    {{-- SECTION 1: INFORMASI PERUSAHAAN --}}
                    <div class="space-y-5">
                        <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-lg bg-indigo-50 border border-indigo-100 text-indigo-600 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h4m-4 0V11m0 0h4m-4 0H9m4 0V5" />
                                    </svg>
                                </div>
                                <h3 class="text-base font-bold text-gray-900">
                                    Informasi Perusahaan & Penanggung Jawab
                                </h3>
                            </div>
                            <span class="text-xs font-semibold text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded-full">Langkah 1 dari 3</span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            {{-- Nama PT --}}
                            <div class="md:col-span-2 space-y-1.5">
                                <label for="nama_pt" class="block text-sm font-semibold text-gray-700">
                                    Nama Perusahaan <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                        </svg>
                                    </div>
                                    <input type="text" id="nama_pt" name="nama_pt"
                                           value="{{ old('nama_pt') }}"
                                           placeholder="Masukkan nama PT atau CV perusahaan (Contoh: PT Mayora Tbk.)"
                                           class="w-full rounded-xl border @error('nama_pt') border-red-300 bg-red-50/30 text-red-900 focus:ring-red-500 focus:border-red-500 @else border-gray-200 text-gray-900 focus:ring-indigo-500 focus:border-indigo-500 @enderror pl-10 pr-4 py-3 text-sm placeholder-gray-400 shadow-xs focus:ring-2 focus:ring-opacity-20 transition duration-150">
                                </div>
                                @error('nama_pt')
                                    <p class="text-xs font-medium text-red-500 flex items-center gap-1 mt-1">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Alamat PT --}}
                            <div class="md:col-span-2 space-y-1.5">
                                <label for="alamat_pt" class="block text-sm font-semibold text-gray-700">
                                    Alamat Perusahaan <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute top-3 left-3.5 text-gray-400 pointer-events-none">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                    <textarea id="alamat_pt" name="alamat_pt" rows="3"
                                              placeholder="Tuliskan alamat lengkap kantor perusahaan..."
                                              class="w-full rounded-xl border @error('alamat_pt') border-red-300 bg-red-50/30 text-red-900 focus:ring-red-500 focus:border-red-500 @else border-gray-200 text-gray-900 focus:ring-indigo-500 focus:border-indigo-500 @enderror pl-10 pr-4 py-2.5 text-sm placeholder-gray-400 shadow-xs focus:ring-2 focus:ring-opacity-20 transition duration-150 resize-none">{{ old('alamat_pt') }}</textarea>
                                </div>
                                @error('alamat_pt')
                                    <p class="text-xs font-medium text-red-500 flex items-center gap-1 mt-1">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Nama Konstruktor --}}
                            <div class="space-y-1.5">
                                <label for="nama_konstruktor" class="block text-sm font-semibold text-gray-700">
                                    Penanggung Jawab / Konstruktor <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <input type="text" id="nama_konstruktor" name="nama_konstruktor"
                                           value="{{ old('nama_konstruktor') }}"
                                           placeholder="Nama lengkap penanggung jawab"
                                           class="w-full rounded-xl border @error('nama_konstruktor') border-red-300 bg-red-50/30 text-red-900 focus:ring-red-500 focus:border-red-500 @else border-gray-200 text-gray-900 focus:ring-indigo-500 focus:border-indigo-500 @enderror pl-10 pr-4 py-3 text-sm placeholder-gray-400 shadow-xs focus:ring-2 focus:ring-opacity-20 transition duration-150">
                                </div>
                                @error('nama_konstruktor')
                                    <p class="text-xs font-medium text-red-500 flex items-center gap-1 mt-1">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Tanggal Mulai --}}
                            <div class="space-y-1.5">
                                <label for="tanggal_mulai" class="block text-sm font-semibold text-gray-700">
                                    Tanggal Mulai Proyek <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <input type="date" id="tanggal_mulai" name="tanggal_mulai"
                                           value="{{ old('tanggal_mulai') }}"
                                           min="{{ date('Y-m-d') }}"
                                           class="w-full rounded-xl border @error('tanggal_mulai') border-red-300 bg-red-50/30 text-red-900 focus:ring-red-500 focus:border-red-500 @else border-gray-200 text-gray-900 focus:ring-indigo-500 focus:border-indigo-500 @enderror pl-10 pr-4 py-3 text-sm shadow-xs focus:ring-2 focus:ring-opacity-20 transition duration-150">
                                </div>
                                @error('tanggal_mulai')
                                    <p class="text-xs font-medium text-red-500 flex items-center gap-1 mt-1">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- SECTION 2: DETAIL PROYEK --}}
                    <div class="space-y-5 pt-4">
                        <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-lg bg-emerald-50 border border-emerald-100 text-emerald-600 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l5.447 2.724A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                    </svg>
                                </div>
                                <h3 class="text-base font-bold text-gray-900">
                                    Detail Lahan & Lokasi Proyek
                                </h3>
                            </div>
                            <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full">Langkah 2 dari 3</span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            {{-- Luas Tanah --}}
                            <div class="space-y-1.5">
                                <label for="luas_tanah" class="block text-sm font-semibold text-gray-700">
                                    Estimasi Luas Lahan <span class="text-red-500">*</span>
                                </label>
                                <div class="relative rounded-xl shadow-xs overflow-hidden flex items-center border @error('luas_tanah') border-red-300 bg-red-50/30 @else border-gray-200 bg-white @enderror focus-within:ring-2 focus-within:ring-indigo-500/20 focus-within:border-indigo-500 transition duration-150">
                                    <div class="pl-3.5 text-gray-400 pointer-events-none">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                                        </svg>
                                    </div>
                                    <input type="number" id="luas_tanah" name="luas_tanah"
                                           value="{{ old('luas_tanah') }}"
                                           placeholder="Contoh: 1500"
                                           min="0" step="0.01"
                                           class="w-full border-0 focus:ring-0 text-sm text-gray-900 placeholder-gray-400 py-3 pl-3 pr-2 bg-transparent">
                                    <span class="px-4 py-3 bg-gray-50 text-gray-500 text-xs font-bold border-l border-gray-100 flex items-center justify-center select-none">
                                        m²
                                    </span>
                                </div>
                                @error('luas_tanah')
                                    <p class="text-xs font-medium text-red-500 flex items-center gap-1 mt-1">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Lokasi Tanah --}}
                            <div class="space-y-1.5">
                                <label for="lokasi" class="block text-sm font-semibold text-gray-700">
                                    Lokasi Proyek Urugan <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                    <input type="text" id="lokasi" name="lokasi"
                                           value="{{ old('lokasi') }}"
                                           placeholder="Contoh: Jl. Industri Raya Blok C, Kawasan MM2100, Bekasi"
                                           class="w-full rounded-xl border @error('lokasi') border-red-300 bg-red-50/30 text-red-900 focus:ring-red-500 focus:border-red-500 @else border-gray-200 text-gray-900 focus:ring-indigo-500 focus:border-indigo-500 @enderror pl-10 pr-4 py-3 text-sm placeholder-gray-400 shadow-xs focus:ring-2 focus:ring-opacity-20 transition duration-150">
                                </div>
                                @error('lokasi')
                                    <p class="text-xs font-medium text-red-500 flex items-center gap-1 mt-1">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- SECTION 3: DOKUMEN PENDUKUNG --}}
                    <div class="space-y-5 pt-4">
                        <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-lg bg-amber-50 border border-amber-100 text-amber-600 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-base font-bold text-gray-900">
                                        Dokumen Pendukung
                                    </h3>
                                </div>
                            </div>
                            <span class="text-xs font-semibold text-amber-600 bg-amber-50 px-2.5 py-1 rounded-full">Langkah 3 dari 3</span>
                        </div>

                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <label for="dokumen" class="block text-sm font-semibold text-gray-700">
                                    Lampiran Berkas (SPK / Kontrak / Dokumen Izin)
                                </label>
                                <span class="text-xs text-gray-400 font-medium">Opsional / PDF, JPG, PNG &bull; Maks 5MB</span>
                            </div>

                            {{-- Dropzone Area --}}
                            <div id="drop-zone"
                                 class="relative group cursor-pointer border-2 border-dashed rounded-2xl p-6 transition duration-200 flex flex-col items-center justify-center text-center bg-gray-50/50 hover:bg-indigo-50/30 @error('fileupload') border-red-300 bg-red-50/20 @else border-gray-200 hover:border-indigo-400 @enderror">

                                <input id="dokumen" name="fileupload" type="file" accept=".pdf,.jpg,.jpeg,.png" class="hidden">

                                {{-- Default View --}}
                                <div id="drop-default" class="flex flex-col items-center gap-3">
                                    <div class="w-14 h-14 rounded-2xl bg-indigo-50 border border-indigo-100 text-indigo-600 flex items-center justify-center group-hover:scale-110 transition duration-200 shadow-xs">
                                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-800 group-hover:text-indigo-600 transition">
                                            Tarik & lepas file di sini, atau <span class="text-indigo-600 underline">pilih berkas</span>
                                        </p>
                                        <p class="text-xs text-gray-400 mt-1">Mendukung format PDF, PNG, JPG hingga 5MB</p>
                                    </div>
                                </div>

                                {{-- Preview File View --}}
                                <div id="drop-preview" class="hidden flex-col items-center gap-3 w-full max-w-md">
                                    <div class="flex items-center gap-3 p-3.5 bg-white rounded-xl border border-gray-200 shadow-sm w-full">
                                        <div id="file-icon-wrapper" class="w-10 h-10 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0 text-left">
                                            <p id="file-name" class="text-sm font-bold text-gray-800 truncate"></p>
                                            <p id="file-size" class="text-xs text-gray-400"></p>
                                        </div>
                                        <button type="button" id="btn-remove-file" class="w-8 h-8 rounded-lg hover:bg-red-50 text-gray-400 hover:text-red-600 flex items-center justify-center transition" title="Hapus Berkas">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                            </div>
                            @error('fileupload')
                                <p class="text-xs font-medium text-red-500 flex items-center gap-1 mt-1">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    {{-- ACTIONS FOOTER --}}
                    <div class="flex flex-col sm:flex-row items-center justify-end gap-3 pt-6 border-t border-gray-100">
                        <a href="{{ route('dashboard') }}"
                           class="w-full sm:w-auto px-5 py-2.5 rounded-xl border border-gray-200 text-gray-700 bg-white hover:bg-gray-50 hover:border-gray-300 font-semibold text-sm transition duration-150 inline-flex items-center justify-center gap-2 shadow-xs">
                            <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Batal
                        </a>
                        <button type="submit"
                                class="w-full sm:w-auto px-6 py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white font-semibold text-sm transition duration-150 shadow-md shadow-indigo-200 inline-flex items-center justify-center gap-2 cursor-pointer focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Simpan Pengajuan Urugan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    {{-- Script: File Upload Preview & Drag-and-drop --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const input         = document.getElementById('dokumen');
            const dropZone      = document.getElementById('drop-zone');
            const defView       = document.getElementById('drop-default');
            const preView       = document.getElementById('drop-preview');
            const fileName      = document.getElementById('file-name');
            const fileSize      = document.getElementById('file-size');
            const removeBtn     = document.getElementById('btn-remove-file');
            const iconWrapper   = document.getElementById('file-icon-wrapper');

            dropZone.addEventListener('click', (e) => {
                if (e.target.closest('#btn-remove-file')) return;
                input.click();
            });

            function updatePreview(file) {
                if (!file) {
                    defView.classList.remove('hidden');
                    defView.classList.add('flex');
                    preView.classList.add('hidden');
                    preView.classList.remove('flex');
                    return;
                }

                fileName.textContent = file.name;
                fileSize.textContent = (file.size / (1024 * 1024)).toFixed(2) + ' MB';

                // Change icon according to extension
                const ext = file.name.split('.').pop().toLowerCase();
                if (ext === 'pdf') {
                    iconWrapper.className = 'w-10 h-10 rounded-lg bg-red-50 text-red-600 flex items-center justify-center flex-shrink-0';
                } else if (['jpg', 'jpeg', 'png', 'webp'].includes(ext)) {
                    iconWrapper.className = 'w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0';
                } else {
                    iconWrapper.className = 'w-10 h-10 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center flex-shrink-0';
                }

                defView.classList.add('hidden');
                defView.classList.remove('flex');
                preView.classList.remove('hidden');
                preView.classList.add('flex');
            }

            input.addEventListener('change', () => {
                if (input.files.length > 0) {
                    updatePreview(input.files[0]);
                }
            });

            removeBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                input.value = '';
                updatePreview(null);
            });

            // Drag & drop handlers
            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    dropZone.classList.add('border-indigo-500', 'bg-indigo-50/60');
                }, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    dropZone.classList.remove('border-indigo-500', 'bg-indigo-50/60');
                }, false);
            });

            dropZone.addEventListener('drop', (e) => {
                const dt = e.dataTransfer;
                const files = dt.files;
                if (files.length > 0) {
                    input.files = files;
                    updatePreview(files[0]);
                }
            });
        });
    </script>
</x-app-layout>
