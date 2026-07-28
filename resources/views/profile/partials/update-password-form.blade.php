<section class="space-y-6">
    <header class="flex items-center gap-3 pb-4 border-b border-gray-100">
        <div class="w-9 h-9 rounded-xl bg-purple-50 border border-purple-100 text-purple-600 flex items-center justify-center flex-shrink-0">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
        </div>
        <div>
            <h3 class="text-base font-bold text-gray-900">
                {{ __('Perbarui Password / Kata Sandi') }}
            </h3>
            <p class="text-xs text-gray-500 mt-0.5">
                Pastikan akun Anda menggunakan kata sandi yang panjang dan acak untuk menjaga keamanan.
            </p>
        </div>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('put')

        {{-- Current Password --}}
        <div class="space-y-1.5">
            <label for="update_password_current_password" class="block text-sm font-semibold text-gray-700">
                Password Saat Ini <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <input id="update_password_current_password" name="current_password" type="password"
                       autocomplete="current-password" placeholder="••••••••"
                       class="w-full rounded-xl border @error('current_password', 'updatePassword') border-red-300 bg-red-50/30 text-red-900 focus:ring-red-500 focus:border-red-500 @else border-gray-200 text-gray-900 focus:ring-indigo-500 focus:border-indigo-500 @enderror pl-10 pr-4 py-3 text-sm placeholder-gray-400 shadow-xs focus:ring-2 focus:ring-opacity-20 transition duration-150">
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-1 text-xs" />
        </div>

        {{-- New Password --}}
        <div class="space-y-1.5">
            <label for="update_password_password" class="block text-sm font-semibold text-gray-700">
                Password Baru <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                </div>
                <input id="update_password_password" name="password" type="password"
                       autocomplete="new-password" placeholder="••••••••"
                       class="w-full rounded-xl border @error('password', 'updatePassword') border-red-300 bg-red-50/30 text-red-900 focus:ring-red-500 focus:border-red-500 @else border-gray-200 text-gray-900 focus:ring-indigo-500 focus:border-indigo-500 @enderror pl-10 pr-4 py-3 text-sm placeholder-gray-400 shadow-xs focus:ring-2 focus:ring-opacity-20 transition duration-150">
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-1 text-xs" />
        </div>

        {{-- Confirm Password --}}
        <div class="space-y-1.5">
            <label for="update_password_password_confirmation" class="block text-sm font-semibold text-gray-700">
                Konfirmasi Password Baru <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                       autocomplete="new-password" placeholder="••••••••"
                       class="w-full rounded-xl border @error('password_confirmation', 'updatePassword') border-red-300 bg-red-50/30 text-red-900 focus:ring-red-500 focus:border-red-500 @else border-gray-200 text-gray-900 focus:ring-indigo-500 focus:border-indigo-500 @enderror pl-10 pr-4 py-3 text-sm placeholder-gray-400 shadow-xs focus:ring-2 focus:ring-opacity-20 transition duration-150">
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-1 text-xs" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit"
                    class="px-6 py-2.5 rounded-xl bg-purple-600 hover:bg-purple-700 text-white font-semibold text-sm shadow-md shadow-purple-200 transition duration-150 inline-flex items-center gap-2 cursor-pointer">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Simpan Password Baru
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }"
                   x-show="show"
                   x-transition
                   x-init="setTimeout(() => show = false, 3000)"
                   class="text-xs font-semibold text-emerald-600 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Password berhasil diperbarui!
                </p>
            @endif
        </div>
    </form>
</section>

