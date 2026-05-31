<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('ritase.index', $urugan) }}"
               class="text-gray-400 hover:text-gray-600 transition">
                   <x-ionicon-chevron-back-outline class="w-5 h-5" />
            </a>
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Ritasi Tanah</h2>
                <p class="text-xs text-gray-400 mt-0.5">{{ $urugan->nama_pt }} &mdash; {{ $urugan->lokasi }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-xl border border-gray-100">
                <div class="p-6 md:p-8">

                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                            <p class="text-sm font-semibold text-red-700 mb-1">Terdapat kesalahan:</p>
                            <ul class="list-disc list-inside text-sm text-red-600 space-y-0.5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('ritase.update', [$urugan->id, $ritase->id]) }}"
                          method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        {{-- Identitas Truk --}}
                        <div>
                            <h3 class="text-xs font-bold uppercase tracking-widest text-indigo-500 mb-4 pb-2 border-b border-gray-100">
                                Identitas Kendaraan
                            </h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                                <div class="sm:col-span-1">
                                    <label for="no_plat" class="block text-sm font-medium text-gray-700 mb-1">
                                        No. Plat Kendaraan <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="no_plat" name="no_plat"
                                           value="{{ old('no_plat', $ritase->no_plat) }}"
                                           placeholder="Contoh: B 1234 XYZ"
                                           class="w-full rounded-lg border @error('no_plat') border-red-400 bg-red-50 @else border-gray-300 @enderror px-4 py-2.5 text-sm uppercase tracking-widest placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                                    @error('no_plat')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="sm:col-span-1">
                                    <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">
                                        Tanggal <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" id="tanggal" name="tanggal"
                                           value="{{ old('tanggal', $ritase->tanggal) }}"
                                           class="w-full rounded-lg border @error('tanggal') border-red-40 bg-red-50 @else border-gray-300 @enderror px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                                    @error('tanggal')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        {{-- Dimensi & Kalkulasi Volume --}}
                        <div>
                            <h3 class="text-xs font-bold uppercase tracking-widest text-indigo-500 mb-4 pb-2 border-b border-gray-100">
                                Dimensi Muatan (meter)
                            </h3>

                            <div class="grid grid-cols-3 gap-4 mb-4">

                                <div>
                                    <label for="panjang" class="block text-sm font-medium text-gray-700 mb-1">
                                        Panjang <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="number" id="panjang" name="panjang"
                                               value="{{ old('panjang', $ritase->panjang) }}"
                                               placeholder="0.00" min="0.01" step="0.01"
                                               oninput="hitungVolume()"
                                               class="w-full rounded-lg border @error('panjang') border-red-400 bg-red-50 @else border-gray-300 @enderror pl-4 pr-8 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-400">m</span>
                                    </div>
                                    @error('panjang')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="lebar" class="block text-sm font-medium text-gray-700 mb-1">
                                        Lebar <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="number" id="lebar" name="lebar"
                                               value="{{ old('lebar', $ritase->lebar) }}"
                                               placeholder="0.00" min="0.01" step="0.01"
                                               oninput="hitungVolume()"
                                               class="w-full rounded-lg border @error('lebar') border-red-400 bg-red-50 @else border-gray-300 @enderror pl-4 pr-8 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-400">m</span>
                                    </div>
                                    @error('lebar')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="tinggi" class="block text-sm font-medium text-gray-700 mb-1">
                                        Tinggi <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="number" id="tinggi" name="tinggi"
                                               value="{{ old('tinggi', $ritase->tinggi) }}"
                                               placeholder="0.00" min="0.01" step="0.01"
                                               oninput="hitungVolume()"
                                               class="w-full rounded-lg border @error('tinggi') border-red-400 bg-red-50 @else border-gray-300 @enderror pl-4 pr-8 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-400">m</span>
                                    </div>
                                    @error('tinggi')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>

                            {{-- Volume Result --}}
                            <div class="flex items-center justify-between bg-indigo-50 border border-indigo-200 rounded-xl px-5 py-4">
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-400" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                    <span class="text-sm font-semibold text-indigo-700">Volume Tanah</span>
                                    <span class="text-xs text-indigo-400">(P × L × T)</span>
                                </div>
                                <div class="flex items-baseline gap-1">
                                    <span id="volume-display" class="text-2xl font-bold text-indigo-700">0.0</span>
                                    <span class="text-sm text-indigo-400 font-medium">m³</span>
                                </div>
                            </div>
                        </div>

                        {{-- Upload Foto --}}
                        <div>
                            <h3 class="text-xs font-bold uppercase tracking-widest text-indigo-500 mb-4 pb-2 border-b border-gray-100">
                                Foto Muatan
                            </h3>

                            <label for="foto"
                                id="foto-zone"
                                class="flex flex-col items-center justify-center w-full h-36 border-2 border-dashed border-gray-300 bg-gray-50 rounded-xl cursor-pointer hover:bg-indigo-50 hover:border-indigo-400 transition group">

                                {{-- Jika ada foto lama dari DB, sembunyikan text default-nya --}}
                                <div id="foto-default" class="flex flex-col items-center gap-2 pointer-events-none {{ $ritase->foto ? 'hidden' : '' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-9 h-9 text-gray-300 group-hover:text-indigo-400 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                                          d="M3 9a2 2 0 012-2h.93a2 2 0 011.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0118.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <p class="text-sm text-gray-500 group-hover:text-indigo-600 transition">
                                                                    <span class="font-semibold">Klik untuk mengganti foto</span>
                                    </p>
                                    <p class="text-xs text-gray-400">JPG, PNG, WEBP — maks. 5MB</p>
                                </div>

                                {{-- Jika ada foto lama dari DB, langsung tampilkan gambarnya --}}
                                <img id="foto-preview"
                                        src="{{ $ritase->foto ? asset('storage/' . $ritase->foto) : '#' }}"
                                        alt="Preview"
                                        class="{{ $ritase->foto ? '' : 'hidden' }} max-h-28 rounded-lg object-cover pointer-events-none shadow">

                                <input id="foto" name="foto" type="file"
                                        accept="image/jpg,image/jpeg,image/png,image/webp" class="hidden">
                            </label>
                            @error('foto')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Actions --}}
                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                            <x-button-link href="{{ route('ritase.index', $urugan) }}" color="red">
                                Batal
                            </x-button-link>
                            <x-primary-button>
                                Simpan Ritase
                            </x-primary-button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Kalkulasi volume live
        function hitungVolume() {
            const p = parseFloat(document.getElementById('panjang').value) || 0;
            const l = parseFloat(document.getElementById('lebar').value)   || 0;
            const t = parseFloat(document.getElementById('tinggi').value)  || 0;
            document.getElementById('volume-display').textContent = (p * l * t).toFixed(1);
        }

        document.addEventListener("DOMContentLoaded", function() {
                    hitungVolume();
                });

        // Preview foto
        document.getElementById('foto').addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('foto-default').classList.add('hidden');
                const img = document.getElementById('foto-preview');
                img.src = e.target.result;
                img.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        });
    </script>
</x-app-layout>
