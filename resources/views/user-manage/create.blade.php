<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('user-manage.index') }}" class="p-2 rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-blue-50 hover:text-blue-700 hover:border-blue-200 transition-all duration-200 shadow-2xs">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h2 class="font-extrabold text-2xl text-blue-950 tracking-tight flex items-center gap-2">
                    {{ __('Tambah Karyawan Baru') }}
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Registrasi akun baru dan tentukan hak akses peran karyawan dalam sistem.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
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
                                Form Input Karyawan
                            </div>
                            <h3 class="text-xl sm:text-2xl font-black tracking-tight">Lengkapi Detail Karyawan</h3>
                            <p class="text-xs text-blue-100/80">Pastikan informasi email dan peran akses sesuai dengan struktur kerja.</p>
                        </div>

                        <div class="w-12 h-12 rounded-2xl bg-white/10 border border-white/20 text-white flex items-center justify-center shrink-0 backdrop-blur-sm hidden sm:flex">
                            <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
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
                                Mohon periksa kembali input formulir:
                            </p>
                            <ul class="list-disc list-inside text-xs text-red-600 font-medium space-y-0.5 ps-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('user-manage.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="space-y-5">
                            {{-- Field 1: Nama Karyawan --}}
                            <div class="space-y-1.5">
                                <label for="name" class="block text-xs font-extrabold text-blue-950 uppercase tracking-wider">
                                    Nama Lengkap Karyawan <span class="text-red-600">*</span>
                                </label>
                                <div class="relative rounded-2xl shadow-2xs">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <input type="text" id="name" name="name"
                                           value="{{ old('name') }}"
                                           placeholder="Masukkan nama lengkap (contoh: Bambang Pamungkas)"
                                           class="w-full rounded-2xl border @error('name') border-red-400 bg-red-50/50 @else border-slate-200 @enderror pl-11 pr-4 py-3 text-sm text-slate-800 font-medium placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition duration-200">
                                </div>
                                @error('name')
                                    <p class="text-xs text-red-600 font-bold flex items-center gap-1 mt-1">
                                        <span>•</span> {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Field 2: Email Karyawan --}}
                            <div class="space-y-1.5">
                                <label for="email" class="block text-xs font-extrabold text-blue-950 uppercase tracking-wider">
                                    Alamat Email Resmi <span class="text-red-600">*</span>
                                </label>
                                <div class="relative rounded-2xl shadow-2xs">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <input type="email" id="email" name="email"
                                           value="{{ old('email') }}"
                                           placeholder="bambang.pamungkas@example.com"
                                           class="w-full rounded-2xl border @error('email') border-red-400 bg-red-50/50 @else border-slate-200 @enderror pl-11 pr-4 py-3 text-sm text-slate-800 font-medium placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition duration-200">
                                </div>
                                @error('email')
                                    <p class="text-xs text-red-600 font-bold flex items-center gap-1 mt-1">
                                        <span>•</span> {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Field 3: Role Karyawan --}}
                            @can('kantor')
                            <div class="space-y-1.5">
                                <label for="role" class="block text-xs font-extrabold text-blue-950 uppercase tracking-wider">
                                    Hak Akses Peran (Role) <span class="text-red-600">*</span>
                                </label>
                                <div class="relative rounded-2xl shadow-2xs">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                        </svg>
                                    </div>
                                    <select id="role" name="role"
                                            class="w-full rounded-2xl border @error('role') border-red-400 bg-red-50/50 @else border-slate-200 @enderror pl-11 pr-10 py-3 text-sm font-bold text-blue-950 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition duration-200 bg-white appearance-none cursor-pointer"
                                            style="background-image: url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%232563eb'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2.5' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E\"); background-repeat: no-repeat; background-position: right 1rem center; background-size: 1.1rem;">
                                        <option value="kantor" {{ old('role') === 'kantor' ? 'selected' : '' }}>
                                            👨‍⚖️ Karyawan Kantor (Kelola Proyek & Management Karyawan)
                                        </option>
                                        <option value="konstruktor" {{ old('role') === 'konstruktor' ? 'selected' : '' }}>
                                            🕒 Client Konstruktor (Ajukan Proyek Urugan Tanah)
                                        </option>
                                        <option value="lapangan" {{ old('role') === 'lapangan' ? 'selected' : '' }}>
                                            🏗 Karyawan Lapangan (Input Data Ritase & Truk)
                                        </option>
                                    </select>
                                </div>
                                @error('role')
                                    <p class="text-xs text-red-600 font-bold flex items-center gap-1 mt-1">
                                        <span>•</span> {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            @endcan

                            {{-- Field 4: Password Karyawan (Dengan Toggle View Password) --}}
                            <div class="space-y-1.5" x-data="{ showPassword: false }">
                                <label for="password" class="block text-xs font-extrabold text-blue-950 uppercase tracking-wider">
                                    Password Akun <span class="text-red-600">*</span>
                                </label>
                                <div class="relative rounded-2xl shadow-2xs">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                        </svg>
                                    </div>
                                    <input :type="showPassword ? 'text' : 'password'" id="password" name="password"
                                           placeholder="••••••••"
                                           class="w-full rounded-2xl border @error('password') border-red-400 bg-red-50/50 @else border-slate-200 @enderror pl-11 pr-12 py-3 text-sm text-slate-800 font-medium placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition duration-200">
                                    
                                    <!-- Toggle Button View/Hide Password -->
                                    <button type="button" 
                                            @click="showPassword = !showPassword" 
                                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-blue-700 focus:outline-none transition-colors"
                                            title="Tampilkan / Sembunyikan Password">
                                        <!-- Eye Open Icon (Ketika password tersembunyi) -->
                                        <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <!-- Eye Slash Icon (Ketika password terlihat) -->
                                        <svg x-show="showPassword" x-cloak class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a8.962 8.962 0 013.982-.937c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21f-3-3m-3.568-3.568L3 3"/>
                                        </svg>
                                    </button>
                                </div>
                                @error('password')
                                    <p class="text-xs text-red-600 font-bold flex items-center gap-1 mt-1">
                                        <span>•</span> {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                            <a href="{{ route('user-manage.index') }}" class="px-5 py-2.5 rounded-xl bg-red-50 text-red-600 hover:bg-red-600 hover:text-white font-bold text-sm transition-all duration-200 border border-red-200/60 active:scale-95">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex items-center gap-2 text-sm font-bold px-6 py-2.5 rounded-xl bg-gradient-to-r from-blue-700 via-blue-600 to-indigo-700 hover:from-blue-800 hover:to-indigo-800 text-white shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 transition-all duration-200 active:scale-95">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
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