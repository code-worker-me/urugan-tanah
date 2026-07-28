<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div class="flex items-center gap-3">
                <a href="{{ route('ritase.index', $urugan) }}"
                   class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-white border border-gray-200 text-gray-500 hover:text-indigo-600 hover:border-indigo-200 hover:bg-indigo-50/50 transition duration-200 shadow-xs">
                    <x-ionicon-chevron-back-outline class="w-5 h-5" />
                </a>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-semibold uppercase tracking-wider text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-md border border-indigo-100">Ritase Tanah</span>
                        <span class="text-xs text-gray-400">&bull;</span>
                        <span class="text-xs text-gray-500 font-medium truncate max-w-[180px] sm:max-w-xs">{{ $urugan->nama_pt }}</span>
                    </div>
                    <h2 class="font-bold text-xl text-gray-900 leading-tight mt-0.5">
                        Edit Data Ritase Kendaraan
                    </h2>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Form Errors Banner --}}
            @if ($errors->any())
                <div class="p-4 bg-red-50/90 border border-red-200 rounded-2xl shadow-xs flex gap-3.5 items-start">
                    <div class="w-8 h-8 rounded-xl bg-red-100 text-red-600 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-red-800">Terdapat kesalahan input:</h4>
                        <ul class="mt-1 list-disc list-inside text-xs text-red-600 space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            {{-- Form Card --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-xl shadow-gray-100/80 overflow-hidden">
                <form action="{{ route('ritase.update', [$urugan->id, $ritase->id]) }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8 space-y-7">
                    @csrf
                    @method('PUT')

                    {{-- SECTION 1: IDENTITAS KENDARAAN --}}
                    <div class="space-y-4">
                        <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-lg bg-indigo-50 border border-indigo-100 text-indigo-600 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                    </svg>
                                </div>
                                <h3 class="text-base font-bold text-gray-900">Identitas Kendaraan</h3>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            {{-- No Plat --}}
                            <div class="space-y-1.5 sm:col-span-1">
                                <label for="no_plat" class="block text-sm font-semibold text-gray-700">
                                    No. Plat Kendaraan <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1e1 1 0 011 1h2a1 1 0 001-1v-5a1 1 0 00-.293-.707l-3-3A1 1 0 0014.586 7H13" />
                                        </svg>
                                    </div>
                                    <input type="text" id="no_plat" name="no_plat"
                                           value="{{ old('no_plat', $ritase->no_plat) }}"
                                           placeholder="Contoh: B 1234 XYZ"
                                           class="w-full rounded-xl border @error('no_plat') border-red-300 bg-red-50/30 text-red-900 focus:ring-red-500 focus:border-red-500 @else border-gray-200 text-gray-900 focus:ring-indigo-500 focus:border-indigo-500 @enderror pl-10 pr-4 py-3 text-sm uppercase tracking-widest font-semibold placeholder-gray-400 shadow-xs focus:ring-2 focus:ring-opacity-20 transition duration-150">
                                </div>
                                @error('no_plat')
                                    <p class="text-xs font-medium text-red-500 flex items-center gap-1 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Tanggal --}}
                            <div class="space-y-1.5 sm:col-span-1">
                                <label for="tanggal" class="block text-sm font-semibold text-gray-700">
                                    Tanggal Ritase <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <input type="date" id="tanggal" name="tanggal"
                                           value="{{ old('tanggal', \Carbon\Carbon::parse($ritase->tanggal)->format('Y-m-d')) }}"
                                           class="w-full rounded-xl border @error('tanggal') border-red-300 bg-red-50/30 text-red-900 focus:ring-red-500 focus:border-red-500 @else border-gray-200 text-gray-900 focus:ring-indigo-500 focus:border-indigo-500 @enderror pl-10 pr-4 py-3 text-sm shadow-xs focus:ring-2 focus:ring-opacity-20 transition duration-150">
                                </div>
                                @error('tanggal')
                                    <p class="text-xs font-medium text-red-500 flex items-center gap-1 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- SECTION 2: DIMENSI & KALKULASI VOLUME --}}
                    <div class="space-y-4 pt-2">
                        <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-lg bg-emerald-50 border border-emerald-100 text-emerald-600 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </div>
                                <h3 class="text-base font-bold text-gray-900">Dimensi Muatan (Meter)</h3>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            {{-- Panjang --}}
                            <div class="space-y-1.5">
                                <label for="panjang" class="block text-sm font-semibold text-gray-700">
                                    Panjang (P) <span class="text-red-500">*</span>
                                </label>
                                <div class="relative rounded-xl shadow-xs overflow-hidden flex items-center border @error('panjang') border-red-300 bg-red-50/30 @else border-gray-200 bg-white @enderror focus-within:ring-2 focus-within:ring-indigo-500/20 focus-within:border-indigo-500 transition duration-150">
                                    <input type="number" id="panjang" name="panjang"
                                           value="{{ old('panjang', $ritase->panjang) }}"
                                           placeholder="0.00" min="0.01" step="0.01"
                                           oninput="hitungVolume()"
                                           class="w-full border-0 focus:ring-0 text-sm font-semibold text-gray-900 placeholder-gray-400 py-3 pl-3.5 pr-2 bg-transparent">
                                    <span class="px-3 py-3 text-gray-400 text-xs font-bold bg-gray-50 border-l border-gray-100 select-none">m</span>
                                </div>
                                @error('panjang')
                                    <p class="text-xs font-medium text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Lebar --}}
                            <div class="space-y-1.5">
                                <label for="lebar" class="block text-sm font-semibold text-gray-700">
                                    Lebar (L) <span class="text-red-500">*</span>
                                </label>
                                <div class="relative rounded-xl shadow-xs overflow-hidden flex items-center border @error('lebar') border-red-300 bg-red-50/30 @else border-gray-200 bg-white @enderror focus-within:ring-2 focus-within:ring-indigo-500/20 focus-within:border-indigo-500 transition duration-150">
                                    <input type="number" id="lebar" name="lebar"
                                           value="{{ old('lebar', $ritase->lebar) }}"
                                           placeholder="0.00" min="0.01" step="0.01"
                                           oninput="hitungVolume()"
                                           class="w-full border-0 focus:ring-0 text-sm font-semibold text-gray-900 placeholder-gray-400 py-3 pl-3.5 pr-2 bg-transparent">
                                    <span class="px-3 py-3 text-gray-400 text-xs font-bold bg-gray-50 border-l border-gray-100 select-none">m</span>
                                </div>
                                @error('lebar')
                                    <p class="text-xs font-medium text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Tinggi --}}
                            <div class="space-y-1.5">
                                <label for="tinggi" class="block text-sm font-semibold text-gray-700">
                                    Tinggi (T) <span class="text-red-500">*</span>
                                </label>
                                <div class="relative rounded-xl shadow-xs overflow-hidden flex items-center border @error('tinggi') border-red-300 bg-red-50/30 @else border-gray-200 bg-white @enderror focus-within:ring-2 focus-within:ring-indigo-500/20 focus-within:border-indigo-500 transition duration-150">
                                    <input type="number" id="tinggi" name="tinggi"
                                           value="{{ old('tinggi', $ritase->tinggi) }}"
                                           placeholder="0.00" min="0.01" step="0.01"
                                           oninput="hitungVolume()"
                                           class="w-full border-0 focus:ring-0 text-sm font-semibold text-gray-900 placeholder-gray-400 py-3 pl-3.5 pr-2 bg-transparent">
                                    <span class="px-3 py-3 text-gray-400 text-xs font-bold bg-gray-50 border-l border-gray-100 select-none">m</span>
                                </div>
                                @error('tinggi')
                                    <p class="text-xs font-medium text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Volume Result Widget --}}
                        <div class="p-4 bg-gradient-to-r from-indigo-50/90 via-purple-50/60 to-indigo-50/90 border border-indigo-100 rounded-2xl flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-indigo-600 text-white flex items-center justify-center shadow-xs">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <span class="text-xs font-bold uppercase tracking-wider text-indigo-700">Kalkulasi Volume Muatan</span>
                                    <p class="text-xs text-indigo-400">Formula: Panjang × Lebar × Tinggi</p>
                                </div>
                            </div>
                            <div class="flex items-baseline gap-1 bg-white px-4 py-2 rounded-xl border border-indigo-100 shadow-xs">
                                <span id="volume-display" class="text-2xl font-extrabold text-indigo-700">0.0</span>
                                <span class="text-xs font-bold text-indigo-400">m³</span>
                            </div>
                        </div>
                    </div>

                    {{-- SECTION 3: UPLOAD FOTO --}}
                    <div class="space-y-4 pt-2">
                        <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-lg bg-purple-50 border border-purple-100 text-purple-600 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <h3 class="text-base font-bold text-gray-900">Foto Muatan Kendaraan</h3>
                            </div>
                            <span class="text-xs text-gray-400 font-medium">Opsional &bull; JPG, PNG, WEBP Maks 5MB</span>
                        </div>

                        <div id="foto-zone"
                             class="relative cursor-pointer border-2 border-dashed rounded-2xl p-6 transition duration-200 flex flex-col items-center justify-center text-center bg-gray-50/50 hover:bg-indigo-50/30 @error('foto') border-red-300 bg-red-50/20 @else border-gray-200 hover:border-indigo-400 @enderror group">

                            <input id="foto" name="foto" type="file" accept="image/jpg,image/jpeg,image/png,image/webp" class="hidden">

                            {{-- Default View --}}
                            <div id="foto-default" class="flex flex-col items-center gap-3 {{ $ritase->foto ? 'hidden' : '' }}">
                                <div class="w-12 h-12 rounded-2xl bg-purple-50 border border-purple-100 text-purple-600 flex items-center justify-center group-hover:scale-110 transition duration-200">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0118.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-800 group-hover:text-indigo-600 transition">
                                        Klik untuk mengganti foto muatan truk
                                    </p>
                                    <p class="text-xs text-gray-400 mt-1">Format JPG, PNG, WEBP (maks. 5MB)</p>
                                </div>
                            </div>

                            {{-- Preview Image View --}}
                            <div id="foto-preview-wrapper" class="{{ $ritase->foto ? 'flex' : 'hidden' }} flex-col items-center gap-2 relative">
                                <img id="foto-preview"
                                     src="{{ $ritase->foto ? asset('storage/' . $ritase->foto) : '#' }}"
                                     alt="Preview Foto"
                                     class="max-h-48 rounded-xl object-cover shadow-sm border border-gray-200">
                                <button type="button" id="btn-remove-foto" class="mt-2 px-3 py-1 bg-red-50 text-red-600 hover:bg-red-100 text-xs font-semibold rounded-lg transition inline-flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Ganti Foto
                                </button>
                            </div>
                        </div>
                        @error('foto')
                            <p class="text-xs font-medium text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ACTIONS FOOTER --}}
                    <div class="flex flex-col sm:flex-row items-center justify-end gap-3 pt-5 border-t border-gray-100">
                        <a href="{{ route('ritase.index', $urugan) }}"
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

    {{-- Script: Kalkulasi Live & Preview Foto --}}
    <script>
        function hitungVolume() {
            const p = parseFloat(document.getElementById('panjang').value) || 0;
            const l = parseFloat(document.getElementById('lebar').value)   || 0;
            const t = parseFloat(document.getElementById('tinggi').value)  || 0;
            document.getElementById('volume-display').textContent = (p * l * t).toFixed(1);
        }

        document.addEventListener('DOMContentLoaded', () => {
            hitungVolume();

            const fotoInput     = document.getElementById('foto');
            const fotoZone      = document.getElementById('foto-zone');
            const fotoDefault   = document.getElementById('foto-default');
            const previewWrap   = document.getElementById('foto-preview-wrapper');
            const previewImg    = document.getElementById('foto-preview');
            const removeBtn     = document.getElementById('btn-remove-foto');

            fotoZone.addEventListener('click', (e) => {
                if (e.target.closest('#btn-remove-foto')) return;
                fotoInput.click();
            });

            fotoInput.addEventListener('change', function () {
                const file = this.files[0];
                if (!file) return;
                const reader = new FileReader();
                reader.onload = e => {
                    fotoDefault.classList.add('hidden');
                    previewImg.src = e.target.result;
                    previewWrap.classList.remove('hidden');
                    previewWrap.classList.add('flex');
                };
                reader.readAsDataURL(file);
            });

            removeBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                fotoInput.click();
            });
        });
    </script>
</x-app-layout>
