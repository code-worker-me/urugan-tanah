<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('dashboard') }}"
               class="text-gray-400 hover:text-gray-600 transition">
                   <x-ionicon-chevron-back-outline class="w-5 h-5" />
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Urugan Tanah {{ $urugan->nama_pt }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8">

                    {{-- Form Errors --}}
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                            <p class="text-sm font-semibold text-red-700 mb-1">Terdapat kesalahan input:</p>
                            <ul class="list-disc list-inside text-sm text-red-600 space-y-0.5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('urugan.update', $urugan) }}" method="POST"
                          enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        {{-- Section: Informasi Perusahaan --}}
                        <div>
                            <h3 class="text-sm font-semibold text-indigo-600 uppercase tracking-widest mb-4 pb-2 border-b border-gray-100">
                                Informasi Perusahaan
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                {{-- Nama PT --}}
                                <div class="md:col-span-2">
                                    <label for="nama_pt"
                                           class="block text-sm font-medium text-gray-700 mb-1">
                                        Nama Perusahaan
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="nama_pt" name="nama_pt"
                                           value="{{ $urugan->nama_pt }}"
                                           class="w-full rounded-lg border @error('nama_pt') border-red-400 bg-red-50 @else border-gray-300 @enderror px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                                    @error('nama_pt')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Alamat PT --}}
                                <div class="md:col-span-2">
                                    <label for="alamat_pt"
                                           class="block text-sm font-medium text-gray-700 mb-1">
                                        Alamat Perusahaan
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <textarea id="alamat_pt" name="alamat_pt" rows="3"
                                        placeholder="Contoh: Jl. Kemang No.1, Jakarta Selatan, Indonesia, 43882"
                                        class="w-full rounded-lg border @error('alamat_pt') border-red-400 bg-red-50 @else border-gray-300 @enderror px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition resize-none">{{ $urugan->alamat_pt }}</textarea>
                                    @error('alamat_pt')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Nama Konstruktor --}}
                                <div>
                                    <label for="nama_konstruktor"
                                           class="block text-sm font-medium text-gray-700 mb-1">
                                        Nama Konstruktor / Penanggung Jawab
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="nama_konstruktor" name="nama_konstruktor"
                                           value="{{ $urugan->nama_konstruktor }}"
                                           placeholder="Contoh: Pak Suardi Jannah"
                                           class="w-full rounded-lg border @error('nama_konstruktor') border-red-400 bg-red-50 @else border-gray-300 @enderror px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                                    @error('nama_konstruktor')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Tanggal Mulai --}}
                                <div>
                                    <label for="tanggal_mulai"
                                           class="block text-sm font-medium text-gray-700 mb-1">
                                        Tanggal Mulai Proyek
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" id="tanggal_mulai" name="tanggal_mulai"
                                           value="{{ $urugan->tanggal_mulai }}"
                                           class="w-full rounded-lg border @error('tanggal_mulai') border-red-400 bg-red-50 @else border-gray-300 @enderror px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                                    @error('tanggal_mulai')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        {{-- Section: Detail Proyek --}}
                        <div>
                            <h3 class="text-sm font-semibold text-indigo-600 uppercase tracking-widest mb-4 pb-2 border-b border-gray-100">
                                Detail Proyek
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                {{-- Luas Tanah --}}
                                <div>
                                    <label for="luas_tanah"
                                           class="block text-sm font-medium text-gray-700 mb-1">
                                        Luas Tanah
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="number" id="luas_tanah" name="luas_tanah"
                                               value="{{ $urugan->luas_tanah }}"
                                               placeholder="0"
                                               min="0" step="0.01"
                                               class="w-full rounded-lg border @error('luas_tanah') border-red-400 bg-red-50 @else border-gray-300 @enderror pl-4 pr-16 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                                        <span class="absolute right-0 top-0 bottom-0 flex items-center px-3 text-sm text-gray-500 bg-gray-100 rounded-r-lg border border-l-0 border-gray-300 pointer-events-none">
                                            m²
                                        </span>
                                    </div>
                                    @error('luas_tanah')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Status --}}
                                <div>
                                    <label for="status"
                                           class="block text-sm font-medium text-gray-700 mb-1">
                                        Status Pengajuan
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <select id="status" name="status"
                                            class="w-full rounded-lg border @error('status') border-red-400 bg-red-50 @else border-gray-300 @enderror px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition bg-white appearance-none cursor-pointer"
                                            style="background-image: url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E\"); background-repeat: no-repeat; background-position: right 0.75rem center; background-size: 1rem;">
                                        <option value="pending" {{ $urugan->status === 'pending' ? 'selected' : '' }}>
                                            ⏳ Pending
                                        </option>
                                        <option value="accepted" {{ $urugan->status === 'accepted' ? 'selected' : '' }}>
                                            ✅ Accepted
                                        </option>
                                        <option value="decline" {{ $urugan->status === 'decline' ? 'selected' : '' }}>
                                            ❌ Decline
                                        </option>
                                    </select>
                                    @error('status')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Lokasi Tanah --}}
                                <div class="md:col-span-2">
                                    <label for="lokasi"
                                           class="block text-sm font-medium text-gray-700 mb-1">
                                        Lokasi Tanah Urugan
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                        </span>
                                        <input type="text" id="lokasi" name="lokasi"
                                               value="{{ $urugan->lokasi }}"
                                               placeholder="Contoh: Jl. Industri Raya Blok C, Kawasan MM2100, Bekasi"
                                               class="w-full rounded-lg border @error('lokasi') border-red-400 bg-red-50 @else border-gray-300 @enderror pl-10 pr-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                                    </div>
                                    @error('lokasi')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        {{-- Section: Upload Dokumen --}}
                        <div>
                            <h3 class="text-sm font-semibold text-indigo-600 uppercase tracking-widest mb-4 pb-2 border-b border-gray-100">
                                Dokumen Pendukung
                            </h3>

                            <label for="dokumen" class="block text-sm font-medium text-gray-700 mb-2">
                                Upload Dokumen
                                <span class="text-red-500">*</span>
                                <span class="text-gray-400 font-normal ml-1">(Kontrak, SPK, atau dokumen lainnya — format PDF, maks. 10MB)</span>
                            </label>

                            {{-- Drop Zone --}}
                            <label for="dokumen"
                                   id="drop-zone"
                                   class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed @error('dokumen') border-red-400 bg-red-50 @else border-gray-300 bg-gray-50 @enderror rounded-xl cursor-pointer hover:bg-indigo-50 hover:border-indigo-400 transition group">
                                <div id="drop-default" class="flex flex-col items-center gap-2 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-300 group-hover:text-indigo-400 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                    <p class="text-sm text-gray-500 group-hover:text-indigo-600 transition">
                                        <span class="font-semibold">Klik untuk upload</span> atau drag & drop
                                    </p>
                                    <p class="text-xs text-gray-400">PDF hingga 10MB</p>
                                </div>
                                <div id="drop-preview" class="hidden flex-col items-center gap-2 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <p id="file-name" class="text-sm font-medium text-gray-700"></p>
                                    <p id="file-size" class="text-xs text-gray-400"></p>
                                </div>
                                <input id="dokumen" name="fileupload" type="file" accept=".pdf" class="hidden">
                            </label>

                            @error('dokumen')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Actions --}}
                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                            <a href="{{ route('dashboard') }}"
                               class="px-5 py-2.5 rounded-lg border border-gray-300 text-sm font-medium text-gray-600 hover:bg-gray-50 transition">
                                Batal
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center gap-2 px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg shadow-sm transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5 13l4 4L19 7"/>
                                </svg>
                                Simpan Pengajuan
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Script: File Upload Preview --}}
    <script>
        const input     = document.getElementById('dokumen');
        const dropZone  = document.getElementById('drop-zone');
        const defView   = document.getElementById('drop-default');
        const preView   = document.getElementById('drop-preview');
        const fileName  = document.getElementById('file-name');
        const fileSize  = document.getElementById('file-size');

        function showPreview(file) {
            if (!file) return;
            fileName.textContent = file.name;
            fileSize.textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
            defView.classList.add('hidden');
            preView.classList.remove('hidden');
            preView.classList.add('flex');
        }

        input.addEventListener('change', () => showPreview(input.files[0]));

        // Drag & drop
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('border-indigo-400', 'bg-indigo-50');
        });
        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('border-indigo-400', 'bg-indigo-50');
        });
        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('border-indigo-400', 'bg-indigo-50');
            const file = e.dataTransfer.files[0];
            if (file && file.type === 'application/pdf') {
                const dt = new DataTransfer();
                dt.items.add(file);
                input.files = dt.files;
                showPreview(file);
            }
        });
    </script>
</x-app-layout>
