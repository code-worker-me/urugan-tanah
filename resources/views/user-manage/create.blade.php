<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('user-manage.index') }}" class="p-2 rounded-xl bg-slate-100 text-slate-600 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h2 class="font-bold text-2xl text-blue-950 tracking-tight flex items-center gap-2">
                    {{ __('Tambah Karyawan Baru') }}
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Buat akun baru dan tentukan hak akses peran karyawan dalam sistem.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-xl shadow-blue-950/5 border border-blue-100/90 overflow-hidden relative">
                <!-- Top Card Gradient Line (Blue-White-Red) -->
                <div class="h-1.5 w-full bg-gradient-to-r from-blue-700 via-slate-200 to-red-600"></div>

                <div class="p-6 md:p-8">
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-2xl">
                            <p class="text-sm font-bold text-red-700 mb-1 flex items-center gap-2">
                                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Terdapat kesalahan input:
                            </p>
                            <ul class="list-disc list-inside text-xs text-red-600 space-y-0.5 font-medium">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('user-manage.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <section class="space-y-5">
                            <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
                                <span class="w-2.5 h-2.5 rounded-full bg-blue-600"></span>
                                <h3 class="text-xs font-extrabold text-blue-900 uppercase tracking-wider">
                                    Informasi Akun & Akses
                                </h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                {{-- Nama Karyawan --}}
                                <div class="md:col-span-2 space-y-1.5">
                                    <label for="name" class="block text-xs font-bold text-blue-950">
                                        Nama Karyawan <span class="text-red-600">*</span>
                                    </label>
                                    <input type="text" id="name" name="name"
                                           value="{{ old('name') }}"
                                           placeholder="Contoh: Bambang Pamungkas"
                                           class="w-full rounded-xl border @error('name') border-red-400 bg-red-50/50 @else border-slate-200 @enderror px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition shadow-2xs">
                                    @error('name')
                                        <p class="text-xs text-red-600 font-semibold">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Email Karyawan --}}
                                <div class="md:col-span-2 space-y-1.5">
                                    <label for="email" class="block text-xs font-bold text-blue-950">
                                        Email Karyawan <span class="text-red-600">*</span>
                                    </label>
                                    <input type="email" id="email" name="email"
                                           value="{{ old('email') }}"
                                           placeholder="bambang.pamungkas@example.com"
                                           class="w-full rounded-xl border @error('email') border-red-400 bg-red-50/50 @else border-slate-200 @enderror px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition shadow-2xs">
                                    @error('email')
                                        <p class="text-xs text-red-600 font-semibold">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Role Karyawan --}}
                                @can('kantor')
                                <div class="md:col-span-2 space-y-1.5">
                                    <label for="role" class="block text-xs font-bold text-blue-950">
                                        Role & Hak Akses Karyawan <span class="text-red-600">*</span>
                                    </label>
                                    <select id="role" name="role"
                                            class="w-full rounded-xl border @error('role') border-red-400 bg-red-50/50 @else border-slate-200 @enderror px-4 py-2.5 text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition bg-white appearance-none cursor-pointer shadow-2xs"
                                            style="background-image: url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%232563eb'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E\"); background-repeat: no-repeat; background-position: right 0.75rem center; background-size: 1rem;">
                                        <option value="kantor" {{ old('role') === 'kantor' ? 'selected' : '' }}>
                                            👨‍⚖️ Karyawan Kantor (Kelola Semua Proyek & User)
                                        </option>
                                        <option value="konstruktor" {{ old('role') === 'konstruktor' ? 'selected' : '' }}>
                                            🕒 Client Konstruktor (Ajukan Proyek Urugan)
                                        </option>
                                        <option value="lapangan" {{ old('role') === 'lapangan' ? 'selected' : '' }}>
                                            🏗 Karyawan Lapangan (Input Ritase & Surat Jalan)
                                        </option>
                                    </select>
                                    @error('role')
                                        <p class="text-xs text-red-600 font-semibold">{{ $message }}</p>
                                    @enderror
                                </div>
                                @endcan

                                {{-- Password Karyawan --}}
                                <div class="md:col-span-2 space-y-1.5">
                                    <label for="password" class="block text-xs font-bold text-blue-950">
                                        Password Akun <span class="text-red-600">*</span>
                                    </label>
                                    <input type="password" id="password" name="password"
                                           placeholder="••••••••"
                                           class="w-full rounded-xl border @error('password') border-red-400 bg-red-50/50 @else border-slate-200 @enderror px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition shadow-2xs">
                                    @error('password')
                                        <p class="text-xs text-red-600 font-semibold">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </section>

                        {{-- Actions --}}
                        <div class="flex items-center justify-end gap-3 pt-5 border-t border-slate-100">
                            <x-button-link href="{{ route('user-manage.index') }}" color="red">
                                Batal
                            </x-button-link>
                            <button type="submit" class="inline-flex items-center gap-2 text-sm font-semibold px-5 py-2.5 rounded-xl bg-gradient-to-r from-blue-700 to-blue-600 hover:from-blue-800 hover:to-blue-700 text-white shadow-md shadow-blue-600/20 hover:shadow-lg hover:shadow-blue-600/30 transition-all duration-200 active:scale-95">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span>Simpan Karyawan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>