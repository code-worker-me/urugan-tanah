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
                        <span class="text-xs text-gray-500 font-medium">Edit Pengajuan</span>
                    </div>
                    <h2 class="font-bold text-xl text-gray-900 leading-tight mt-0.5">
                        Edit Urugan Tanah: {{ $urugan->nama_pt }}
                    </h2>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Form Errors Banner --}}
            @if ($errors->any())
                <div class="p-4 bg-red-50/90 border border-red-200 rounded-2xl shadow-xs flex gap-3.5 items-start">
                    <div class="w-8 h-8 rounded-xl bg-red-100 text-red-600 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-red-800">Terdapat kesalahan input data:</h4>
                        <ul class="mt-1 list-disc list-inside text-xs text-red-600 space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            {{-- Main Form Card --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-xl shadow-gray-100/80 overflow-hidden">
                <form action="{{ route('urugan.update', $urugan) }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8 space-y-8">
                    @csrf
                    @method('PUT')

                    {{-- SECTION 1: INFORMASI PERUSAHAAN --}}
                    <div class="space-y-4">
                        <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-lg bg-indigo-50 border border-indigo-100 text-indigo-600 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h4m-4 0V11m0 0h4m-4 0H9m4 0V5" />
                                    </svg>
                                </div>
                                <h3 class="text-base font-bold text-gray-900">Informasi Perusahaan Pemohon</h3>
                            </div>
                            <span class="text-xs font-semibold text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded-md">Langkah 1 dari 3</span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            {{-- Nama PT --}}
                            <div class="space-y-1.5 md:col-span-2">
                                <label for="nama_pt" class="block text-sm font-semibold text-gray-700">
                                    Nama Perusahaan (PT / CV / Perorangan) <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h4m-4 0V11m0 0h4m-4 0H9m4 0V5" />
                                        </svg>
                                    </div>
                                    <input type="text" id="nama_pt" name="nama_pt"
                                           value="{{ old('nama_pt', $urugan->nama_pt) }}"
                                           placeholder="Contoh: PT. Pembangunan Raya Propertindo"
                                           class="w-full rounded-xl border @error('nama_pt') border-red-300 bg-red-50/30 text-red-900 focus:ring-red-500 focus:border-red-500 @else border-gray-200 text-gray-900 focus:ring-indigo-500 focus:border-indigo-500 @enderror pl-10 pr-4 py-3 text-sm placeholder-gray-400 shadow-xs focus:ring-2 focus:ring-opacity-20 transition duration-150">
                                </div>
                                @error('nama_pt')
                                    <p class="text-xs font-medium text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Alamat PT --}}
                            <div class="space-y-1.5 md:col-span-2">
                                <label for="alamat_pt" class="block text-sm font-semibold text-gray-700">
                                    Alamat Perusahaan <span class="text-red-500">*</span>
                                </label>
                                <textarea id="alamat_pt" name="alamat_pt" rows="3"
                                          placeholder="Contoh: Jl. Industri Raya No.12, Kebayoran Baru, Jakarta Selatan, 12150"
                                          class="w-full rounded-xl border @error('alamat_pt') border-red-300 bg-red-50/30 text-red-900 focus:ring-red-500 focus:border-red-500 @else border-gray-200 text-gray-900 focus:ring-indigo-500 focus:border-indigo-500 @enderror p-3.5 text-sm placeholder-gray-400 shadow-xs focus:ring-2 focus:ring-opacity-20 transition duration-150 resize-none">{{ old('alamat_pt', $urugan->alamat_pt) }}</textarea>
                                @error('alamat_pt')
                                    <p class="text-xs font-medium text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Nama Konstruktor --}}
                            <div class="space-y-1.5 md:col-span-1">
                                <label for="nama_konstruktor" class="block text-sm font-semibold text-gray-700">
                                    Nama Konstruktor / Penanggung Jawab <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <input type="text" id="nama_konstruktor" name="nama_konstruktor"
                                           value="{{ old('nama_konstruktor', $urugan->nama_konstruktor) }}"
                                           placeholder="Contoh: Ir. Budi Santoso"
                                           class="w-full rounded-xl border @error('nama_konstruktor') border-red-300 bg-red-50/30 text-red-900 focus:ring-red-500 focus:border-red-500 @else border-gray-200 text-gray-900 focus:ring-indigo-500 focus:border-indigo-500 @enderror pl-10 pr-4 py-3 text-sm placeholder-gray-400 shadow-xs focus:ring-2 focus:ring-opacity-20 transition duration-150">
                                </div>
                                @error('nama_konstruktor')
                                    <p class="text-xs font-medium text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Tanggal Mulai --}}
                            <div class="space-y-1.5 md:col-span-1">
                                <label for="tanggal_mulai" class="block text-sm font-semibold text-gray-700">
                                    Tanggal Mulai Proyek <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <input type="date" id="tanggal_mulai" name="tanggal_mulai"
                                           value="{{ old('tanggal_mulai', \Carbon\Carbon::parse($urugan->tanggal_mulai)->format('Y-m-d')) }}"
                                           class="w-full rounded-xl border @error('tanggal_mulai') border-red-300 bg-red-50/30 text-red-900 focus:ring-red-500 focus:border-red-500 @else border-gray-200 text-gray-900 focus:ring-indigo-500 focus:border-indigo-500 @enderror pl-10 pr-4 py-3 text-sm shadow-xs focus:ring-2 focus:ring-opacity-20 transition duration-150">
                                </div>
                                @error('tanggal_mulai')
                                    <p class="text-xs font-medium text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- SECTION 2: DETAIL PROYEK & URUGAN --}}
                    <div class="space-y-4 pt-2">
                        <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-lg bg-emerald-50 border border-emerald-100 text-emerald-600 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l5.447 2.724A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                    </svg>
                                </div>
                                <h3 class="text-base font-bold text-gray-900">Detail Lahan & Lokasi Proyek</h3>
                            </div>
                            <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md">Langkah 2 dari 3</span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            {{-- Luas Tanah --}}
                            <div class="space-y-1.5 md:col-span-1">
                                <label for="luas_tanah" class="block text-sm font-semibold text-gray-700">
                                    Estimasi Luas Tanah Urugan <span class="text-red-500">*</span>
                                </label>
                                <div class="relative rounded-xl shadow-xs overflow-hidden flex items-center border @error('luas_tanah') border-red-300 bg-red-50/30 @else border-gray-200 bg-white @enderror focus-within:ring-2 focus-within:ring-indigo-500/20 focus-within:border-indigo-500 transition duration-150">
                                    <input type="number" id="luas_tanah" name="luas_tanah"
                                           value="{{ old('luas_tanah', $urugan->luas_tanah) }}"
                                           placeholder="1500" min="1" step="0.01"
                                           class="w-full border-0 focus:ring-0 text-sm font-semibold text-gray-900 placeholder-gray-400 py-3 pl-3.5 pr-2 bg-transparent">
                                    <span class="px-3 py-3 text-gray-400 text-xs font-bold bg-gray-50 border-l border-gray-100 select-none">m²</span>
                                </div>
                                @error('luas_tanah')
                                    <p class="text-xs font-medium text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Status Pengajuan (Role Kantor) --}}
                            @can('kantor')
                                <div class="space-y-1.5 md:col-span-1">
                                    <label for="status" class="block text-sm font-semibold text-gray-700">
                                        Status Pengajuan <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <select id="status" name="status"
                                                class="w-full rounded-xl border @error('status') border-red-300 bg-red-50/30 @else border-gray-200 bg-white @enderror pl-4 pr-10 py-3 text-sm font-semibold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition appearance-none cursor-pointer">
                                            <option value="pending" {{ old('status', $urugan->status) === 'pending' ? 'selected' : '' }}>⏳ Pending (Menunggu Peninjauan)</option>
                                            <option value="accepted" {{ old('status', $urugan->status) === 'accepted' ? 'selected' : '' }}>✅ Accepted (Disetujui)</option>
                                            <option value="decline" {{ old('status', $urugan->status) === 'decline' ? 'selected' : '' }}>❌ Decline (Ditolak)</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    @error('status')
                                        <p class="text-xs font-medium text-red-500 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            @endcan

                            {{-- Lokasi Tanah --}}
                            <div class="space-y-1.5 md:col-span-2">
                                <label for="lokasi" class="block text-sm font-semibold text-gray-700">
                                    Alamat / Lokasi Proyek Urugan Tanah <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                        <svg class="w-4 h-4 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <input type="text" id="lokasi" name="lokasi"
                                           value="{{ old('lokasi', $urugan->lokasi) }}"
                                           placeholder="Contoh: Jl. Industri Raya Blok C, Kawasan MM2100, Cikarang Barat"
                                           class="w-full rounded-xl border @error('lokasi') border-red-300 bg-red-50/30 text-red-900 focus:ring-red-500 focus:border-red-500 @else border-gray-200 text-gray-900 focus:ring-indigo-500 focus:border-indigo-500 @enderror pl-10 pr-4 py-3 text-sm placeholder-gray-400 shadow-xs focus:ring-2 focus:ring-opacity-20 transition duration-150">
                                </div>
                                @error('lokasi')
                                    <p class="text-xs font-medium text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- SECTION 3: DOKUMEN PENDUKUNG --}}
                    <div class="space-y-4 pt-2">
                        <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-lg bg-purple-50 border border-purple-100 text-purple-600 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <h3 class="text-base font-bold text-gray-900">Dokumen Pendukung (PDF)</h3>
                            </div>
                            <span class="text-xs font-semibold text-purple-600 bg-purple-50 px-2.5 py-1 rounded-md">Langkah 3 dari 3</span>
                        </div>

                        {{-- Current File Card (if exists) --}}
                        @if ($urugan->fileupload)
                            <div class="p-4 rounded-xl bg-gray-50 border border-gray-200 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-red-100 text-red-600 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block">Dokumen Tersimpan</span>
                                        <p class="text-xs font-bold text-gray-800 truncate max-w-xs">{{ basename($urugan->fileupload) }}</p>
                                    </div>
                                </div>
                                <a href="{{ asset('storage/' . $urugan->fileupload) }}" target="_blank"
                                   class="px-3 py-1.5 bg-white border border-gray-200 hover:bg-gray-100 rounded-lg text-xs font-semibold text-indigo-600 transition inline-flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Pratinjau PDF
                                </a>
                            </div>
                        @endif

                        {{-- Interactive File Dropzone --}}
                        <div id="drop-zone"
                             class="relative cursor-pointer border-2 border-dashed rounded-2xl p-6 transition duration-200 flex flex-col items-center justify-center text-center bg-gray-50/50 hover:bg-indigo-50/30 @error('fileupload') border-red-300 bg-red-50/20 @else border-gray-200 hover:border-indigo-400 @enderror group">
                            
                            <input id="dokumen" name="fileupload" type="file" accept=".pdf" class="hidden">

                            <div id="drop-default" class="flex flex-col items-center gap-3">
                                <div class="w-12 h-12 rounded-2xl bg-purple-50 border border-purple-100 text-purple-600 flex items-center justify-center group-hover:scale-110 transition duration-200">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-800 group-hover:text-indigo-600 transition">
                                        {{ $urugan->fileupload ? 'Klik untuk mengganti dokumen PDF baru' : 'Klik untuk memilih dokumen PDF baru' }}
                                    </p>
                                    <p class="text-xs text-gray-400 mt-1">Format PDF (SPK, Kontrak, atau Surat Perizinan) maks. 10MB</p>
                                </div>
                            </div>

                            <div id="drop-preview" class="hidden flex-col items-center gap-2">
                                <div class="w-12 h-12 rounded-2xl bg-red-50 border border-red-100 text-red-600 flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p id="file-name" class="text-sm font-bold text-gray-900"></p>
                                    <p id="file-size" class="text-xs text-gray-400 mt-0.5"></p>
                                </div>
                                <button type="button" id="btn-remove-file" class="mt-2 px-3 py-1 bg-red-50 text-red-600 hover:bg-red-100 text-xs font-semibold rounded-lg transition inline-flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Batal Ganti Document
                                </button>
                            </div>
                        </div>
                        @error('fileupload')
                            <p class="text-xs font-medium text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ACTIONS FOOTER --}}
                    <div class="flex flex-col sm:flex-row items-center justify-end gap-3 pt-5 border-t border-gray-100">
                        <a href="{{ route('dashboard') }}"
                           class="w-full sm:w-auto px-5 py-2.5 rounded-xl border border-gray-200 text-gray-700 bg-white hover:bg-gray-50 hover:border-gray-300 font-semibold text-sm transition duration-150 inline-flex items-center justify-center gap-2 shadow-xs">
                            <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Batal
                        </a>
                        <button type="submit"
                                class="w-full sm:w-auto px-6 py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold text-sm transition duration-150 shadow-md shadow-indigo-200 inline-flex items-center justify-center gap-2 cursor-pointer">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    {{-- Script: Interactive Dropzone --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const input       = document.getElementById('dokumen');
            const dropZone    = document.getElementById('drop-zone');
            const defView     = document.getElementById('drop-default');
            const preView     = document.getElementById('drop-preview');
            const fileName    = document.getElementById('file-name');
            const fileSize    = document.getElementById('file-size');
            const removeBtn   = document.getElementById('btn-remove-file');

            dropZone.addEventListener('click', (e) => {
                if (e.target.closest('#btn-remove-file')) return;
                input.click();
            });

            function showPreview(file) {
                if (!file) return;
                fileName.textContent = file.name;
                fileSize.textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
                defView.classList.add('hidden');
                preView.classList.remove('hidden');
                preView.classList.add('flex');
            }

            input.addEventListener('change', () => showPreview(input.files[0]));

            dropZone.addEventListener('dragover', (e) => {
                e.preventDefault();
                dropZone.classList.add('border-indigo-400', 'bg-indigo-50/40');
            });

            dropZone.addEventListener('dragleave', () => {
                dropZone.classList.remove('border-indigo-400', 'bg-indigo-50/40');
            });

            dropZone.addEventListener('drop', (e) => {
                e.preventDefault();
                dropZone.classList.remove('border-indigo-400', 'bg-indigo-50/40');
                const file = e.dataTransfer.files[0];
                if (file && file.type === 'application/pdf') {
                    const dt = new DataTransfer();
                    dt.items.add(file);
                    input.files = dt.files;
                    showPreview(file);
                }
            });

            removeBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                input.value = '';
                preView.classList.add('hidden');
                preView.classList.remove('flex');
                defView.classList.remove('hidden');
            });
        });
    </script>
</x-app-layout>

