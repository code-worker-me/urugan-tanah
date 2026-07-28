<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('jadwalUrugan.index', $urugan) }}"
               class="p-2 rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-blue-50 hover:text-blue-700 hover:border-blue-200 transition-all duration-200 shadow-2xs">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h2 class="font-extrabold text-2xl text-blue-950 tracking-tight flex items-center gap-2">
                    {{ __('Tambah Jadwal Truk') }}
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">{{ $urugan->nama_pt }} &mdash; {{ $urugan->lokasi }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-xl shadow-blue-950/10 border border-blue-100/90 overflow-hidden">
                
                {{-- Top Card Header Banner (Blue & Red Theme) --}}
                <div class="relative bg-gradient-to-r from-blue-950 via-blue-900 to-indigo-900 text-white p-6 sm:p-8 overflow-hidden">
                    <!-- Background Decorative Glows -->
                    <div class="absolute -top-10 -right-10 w-48 h-48 bg-red-600/30 rounded-full blur-3xl pointer-events-none"></div>
                    <div class="absolute -bottom-10 -left-10 w-48 h-48 bg-blue-400/20 rounded-full blur-3xl pointer-events-none"></div>

                    <div class="relative z-10 flex items-center justify-between gap-4">
                        <div class="space-y-1">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/20 text-xs font-semibold backdrop-blur-md text-blue-100">
                                <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                                Form Input Jadwal
                            </div>
                            <h3 class="text-xl sm:text-2xl font-black tracking-tight">Atur Jadwal Operasional</h3>
                            <p class="text-xs text-blue-100/80">Tentukan tanggal, jam operasional, dan status kerja armada truk.</p>
                        </div>

                        <div class="w-12 h-12 rounded-2xl bg-white/10 border border-white/20 text-white flex items-center justify-center shrink-0 backdrop-blur-sm hidden sm:flex">
                            <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Form Body --}}
                <div class="p-6 sm:p-8">
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border-l-4 border-l-red-600 border-r border-t border-b border-red-200 rounded-2xl space-y-1">
                            <p class="text-sm font-bold text-red-700 flex items-center gap-2">
                                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Periksa kembali input formulir:
                            </p>
                            <ul class="list-disc list-inside text-xs text-red-600 font-medium space-y-0.5 ps-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('jadwalUrugan.store', $urugan) }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="space-y-5">
                            <h4 class="text-xs font-bold uppercase tracking-widest text-blue-700 pb-2 border-b border-slate-100 flex items-center gap-2">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>Informasi Waktu & Status Kerja</span>
                            </h4>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                {{-- Tanggal & Jam --}}
                                <div class="space-y-1.5 sm:col-span-1">
                                    <label for="waktu" class="block text-xs font-extrabold text-blue-950 uppercase tracking-wider">
                                        Tanggal & Jam Operasional <span class="text-red-600">*</span>
                                    </label>
                                    <input type="datetime-local" id="waktu" name="waktu"
                                           value="{{ old('waktu') }}"
                                           class="w-full rounded-2xl border @error('waktu') border-red-400 bg-red-50/50 @else border-slate-200 @enderror px-4 py-3 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all duration-200 font-medium">
                                    @error('waktu')
                                        <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Status --}}
                                <div class="space-y-1.5 sm:col-span-1">
                                    <label for="status" class="block text-xs font-extrabold text-blue-950 uppercase tracking-wider">
                                        Status Operasional <span class="text-red-600">*</span>
                                    </label>
                                    <select id="status" name="status"
                                            class="w-full rounded-2xl border @error('status') border-red-400 bg-red-50/50 @else border-slate-200 @enderror px-4 py-3 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all duration-200 font-medium">
                                        <option value="kerja" {{ old('status', 'kerja') == 'kerja' ? 'selected' : '' }}>Kerja / Beroperasi</option>
                                        <option value="libur" {{ old('status') == 'libur' ? 'selected' : '' }}>Libur / Non-Aktif</option>
                                    </select>
                                    @error('status')
                                        <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                            <x-button-link href="{{ route('jadwalUrugan.index', $urugan) }}" color="red">
                                Batal
                            </x-button-link>
                            <x-primary-button>
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span>Simpan Jadwal</span>
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
