<section class="space-y-6">
    <header class="flex items-center gap-3 pb-4 border-b border-gray-100">
        <div class="w-9 h-9 rounded-xl bg-indigo-50 border border-indigo-100 text-indigo-600 flex items-center justify-center flex-shrink-0">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
        </div>
        <div>
            <h3 class="text-base font-bold text-gray-900">
                {{ __('Informasi Akun & Pengguna') }}
            </h3>
            <p class="text-xs text-gray-500 mt-0.5">
                Perbarui nama profil, alamat email, dan lihat wewenang/role akun Anda.
            </p>
        </div>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('patch')

        {{-- Name --}}
        <div class="space-y-1.5">
            <label for="name" class="block text-sm font-semibold text-gray-700">
                Nama Lengkap <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <input id="name" name="name" type="text"
                       value="{{ old('name', $user->name) }}"
                       required autofocus autocomplete="name"
                       class="w-full rounded-xl border @error('name') border-red-300 bg-red-50/30 text-red-900 focus:ring-red-500 focus:border-red-500 @else border-gray-200 text-gray-900 focus:ring-indigo-500 focus:border-indigo-500 @enderror pl-10 pr-4 py-3 text-sm placeholder-gray-400 shadow-xs focus:ring-2 focus:ring-opacity-20 transition duration-150">
            </div>
            <x-input-error class="mt-1 text-xs" :messages="$errors->get('name')" />
        </div>

        {{-- Email --}}
        <div class="space-y-1.5">
            <label for="email" class="block text-sm font-semibold text-gray-700">
                Alamat Email <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                    </svg>
                </div>
                <input id="email" name="email" type="email"
                       value="{{ old('email', $user->email) }}"
                       required autocomplete="username"
                       class="w-full rounded-xl border @error('email') border-red-300 bg-red-50/30 text-red-900 focus:ring-red-500 focus:border-red-500 @else border-gray-200 text-gray-900 focus:ring-indigo-500 focus:border-indigo-500 @enderror pl-10 pr-4 py-3 text-sm placeholder-gray-400 shadow-xs focus:ring-2 focus:ring-opacity-20 transition duration-150">
            </div>
            <x-input-error class="mt-1 text-xs" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div class="p-3 bg-amber-50 rounded-xl border border-amber-200 text-xs text-amber-800 space-y-1 mt-2">
                    <p class="font-medium flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        Alamat email Anda belum diverifikasi.
                    </p>
                    <button form="send-verification" class="text-indigo-600 hover:text-indigo-800 font-semibold underline">
                        Klik di sini untuk mengirim ulang email verifikasi.
                    </button>
                    @if (session('status') === 'verification-link-sent')
                        <p class="font-bold text-emerald-600">Link verifikasi baru telah dikirim ke email Anda.</p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Role --}}
        <div class="space-y-1.5">
            <label for="role" class="block text-sm font-semibold text-gray-700">
                Wewenang / Hak Akses (Role)
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <input id="role" name="role" type="text"
                       value="{{ ucfirst(old('role', $user->role)) }}"
                       disabled
                       class="w-full rounded-xl border border-gray-200 bg-gray-50 text-gray-500 font-bold uppercase tracking-wider pl-10 pr-4 py-3 text-sm cursor-not-allowed">
            </div>
            <p class="text-[11px] text-gray-400">Hak akses ditentukan oleh Administrator Sistem.</p>
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit"
                    class="px-6 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm shadow-md shadow-indigo-200 transition duration-150 inline-flex items-center gap-2 cursor-pointer">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Simpan Perubahan Profil
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                   class="text-xs font-semibold text-emerald-600 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Perubahan berhasil disimpan!
                </p>
            @endif
        </div>
    </form>
</section>