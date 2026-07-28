<x-guest-layout>
    <div class="max-w-4xl mx-auto overflow-hidden rounded-3xl bg-white shadow-2xl shadow-indigo-100/70 border border-slate-100 flex flex-col lg:flex-row">

        {{-- LEFT BRANDING PANEL --}}
        <div class="w-full lg:w-5/12 bg-gradient-to-br from-indigo-900 via-indigo-800 to-purple-900 p-8 lg:p-10 text-white flex flex-col justify-between relative overflow-hidden">
            {{-- Decorative Glow & Pattern --}}
            <div class="absolute -top-20 -right-20 w-64 h-64 bg-indigo-500/20 rounded-full blur-2xl pointer-events-none"></div>
            <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-purple-500/20 rounded-full blur-2xl pointer-events-none"></div>
            <div class="absolute inset-0 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:16px_16px] opacity-10 pointer-events-none"></div>

            <div class="relative z-10">
                {{-- Logo --}}
                <div class="mb-8">
                    <a href="/" class="inline-block p-2 bg-white/10 backdrop-blur-md rounded-2xl border border-white/15">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo Urugan Tanah" class="h-14 w-auto object-contain" />
                    </a>
                </div>

                {{-- Headline --}}
                <div class="space-y-3">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-indigo-500/30 border border-indigo-400/30 text-xs font-semibold tracking-wide text-indigo-200 uppercase">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        Sistem Informasi Urugan
                    </span>
                    <h2 class="text-2xl lg:text-3xl font-extrabold text-white tracking-tight leading-tight">
                        Kelola Ritase & Proyek Urugan Tanah
                    </h2>
                    <p class="text-xs lg:text-sm text-indigo-200/80 leading-relaxed">
                        Platform terintegrasi untuk pencatatan ritase tanah, pengajuan izin urugan, serta penjadwalan armada truk secara real-time.
                    </p>
                </div>
            </div>

            {{-- Feature Bullets --}}
            <div class="relative z-10 mt-8 pt-6 border-t border-white/10 space-y-3">
                <div class="flex items-center gap-3 text-xs text-indigo-100">
                    <div class="w-6 h-6 rounded-lg bg-emerald-500/20 border border-emerald-400/30 flex items-center justify-center text-emerald-400 flex-shrink-0">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span>Pencatatan Ritase & Volume Muatan</span>
                </div>
                <div class="flex items-center gap-3 text-xs text-indigo-100">
                    <div class="w-6 h-6 rounded-lg bg-emerald-500/20 border border-emerald-400/30 flex items-center justify-center text-emerald-400 flex-shrink-0">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span>Monitoring Jadwal Armada Truk</span>
                </div>
                <div class="flex items-center gap-3 text-xs text-indigo-100">
                    <div class="w-6 h-6 rounded-lg bg-emerald-500/20 border border-emerald-400/30 flex items-center justify-center text-emerald-400 flex-shrink-0">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span>Manajemen Izin & Dokumen SPK</span>
                </div>
            </div>
        </div>

        {{-- RIGHT FORM PANEL --}}
        <div class="w-full lg:w-7/12 p-8 lg:p-12 flex flex-col justify-center bg-white">

            {{-- Header Title --}}
            <div class="mb-8">
                <h3 class="text-2xl font-bold text-slate-900 tracking-tight">Selamat Datang Kembali 👋</h3>
                <p class="text-sm text-slate-500 mt-1">Masukkan email dan password Anda untuk masuk ke sistem.</p>
            </div>

            {{-- Session Status --}}
            @if (session('status'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-medium flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                {{-- Email Address --}}
                <div class="space-y-1.5">
                    <label for="email" class="block text-sm font-semibold text-slate-700">
                        Alamat Email
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input id="email"
                               type="email"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               autofocus
                               autocomplete="username"
                               placeholder="nama@email.com"
                               class="w-full rounded-xl border @error('email') border-red-300 bg-red-50/30 text-red-900 focus:ring-red-500 focus:border-red-500 @else border-slate-200 text-slate-900 focus:ring-indigo-500 focus:border-indigo-500 @enderror pl-11 pr-4 py-3 text-sm placeholder-slate-400 shadow-xs focus:ring-2 focus:ring-opacity-20 transition duration-150" />
                    </div>
                    @error('email')
                        <p class="text-xs font-medium text-red-500 flex items-center gap-1 mt-1">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="space-y-1.5">
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-semibold text-slate-700">
                            Password
                        </label>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input id="password"
                               type="password"
                               name="password"
                               required
                               autocomplete="current-password"
                               placeholder="••••••••"
                               class="w-full rounded-xl border @error('password') border-red-300 bg-red-50/30 text-red-900 focus:ring-red-500 focus:border-red-500 @else border-slate-200 text-slate-900 focus:ring-indigo-500 focus:border-indigo-500 @enderror pl-11 pr-11 py-3 text-sm placeholder-slate-400 shadow-xs focus:ring-2 focus:ring-opacity-20 transition duration-150" />
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 transition focus:outline-none">
                            <svg id="eyeIcon" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg id="eyeOffIcon" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.05 10.05 0 013.682-.782c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21M3 3l18 18" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-xs font-medium text-red-500 flex items-center gap-1 mt-1">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center justify-between pt-1">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                        <input id="remember_me"
                               type="checkbox"
                               name="remember"
                               class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 transition cursor-pointer">
                        <span class="ms-2.5 text-sm text-slate-600 group-hover:text-slate-900 transition">{{ __('Ingat saya') }}</span>
                    </label>
                </div>

                {{-- Submit Button --}}
                <div class="pt-2">
                    <button type="submit"
                            class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-indigo-600 via-indigo-700 to-purple-700 hover:from-indigo-700 hover:to-purple-800 text-white font-semibold text-sm transition duration-200 shadow-lg shadow-indigo-200/80 flex items-center justify-center gap-2 cursor-pointer focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        <span>{{ __('Masuk ke Akun') }}</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </div>
            </form>


        </div>
    </div>

    {{-- Script: Toggle Password Visibility --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const togglePasswordBtn = document.getElementById('togglePassword');
            const passwordInput     = document.getElementById('password');
            const eyeIcon           = document.getElementById('eyeIcon');
            const eyeOffIcon        = document.getElementById('eyeOffIcon');

            if (togglePasswordBtn && passwordInput) {
                togglePasswordBtn.addEventListener('click', () => {
                    const isPassword = passwordInput.type === 'password';
                    passwordInput.type = isPassword ? 'text' : 'password';
                    eyeIcon.classList.toggle('hidden', isPassword);
                    eyeOffIcon.classList.toggle('hidden', !isPassword);
                });
            }
        });
    </script>
</x-guest-layout>

