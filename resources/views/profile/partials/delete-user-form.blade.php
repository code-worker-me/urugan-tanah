<section class="space-y-6">
    <header class="flex items-center gap-3 pb-4 border-b border-rose-100">
        <div class="w-9 h-9 rounded-xl bg-rose-50 border border-rose-100 text-rose-600 flex items-center justify-center flex-shrink-0">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
        </div>
        <div>
            <h3 class="text-base font-bold text-rose-900">
                {{ __('Zona Bahaya: Hapus Akun') }}
            </h3>
            <p class="text-xs text-rose-600/80 mt-0.5">
                Tindakan ini bersifat permanen. Seluruh data dan informasi akun Anda akan dihapus selamanya.
            </p>
        </div>
    </header>

    <div class="p-4 rounded-xl bg-rose-50/70 border border-rose-200/80 text-xs text-rose-800 space-y-1.5">
        <p class="font-bold flex items-center gap-1.5 text-rose-900">
            <svg class="w-4 h-4 text-rose-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            Peringatan Penting!
        </p>
        <p>
            Setelah akun Anda dihapus, semua sumber daya dan data terkait akan dihapus secara permanen dari server. Pastikan Anda mengunduh data penting sebelum melanjutkan.
        </p>
    </div>

    <div>
        <button type="button"
                x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                class="px-5 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-semibold text-sm shadow-md shadow-rose-200 transition duration-150 inline-flex items-center gap-2 cursor-pointer">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
            Hapus Akun Saya
        </button>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 md:p-8 space-y-5">
            @csrf
            @method('delete')

            <div class="flex items-center gap-3 text-rose-600">
                <div class="w-10 h-10 rounded-2xl bg-rose-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-bold text-gray-900">
                        {{ __('Konfirmasi Penghapusan Akun') }}
                    </h3>
                    <p class="text-xs text-gray-500">Tindakan ini tidak dapat dibatalkan.</p>
                </div>
            </div>

            <p class="text-xs text-gray-600 leading-relaxed">
                Silakan masukkan password Anda untuk mengonfirmasi bahwa Anda benar-benar ingin menghapus akun secara permanen.
            </p>

            <div class="space-y-1.5">
                <label for="password" class="block text-xs font-semibold text-gray-700">Password Konfirmasi</label>
                <input id="password"
                       name="password"
                       type="password"
                       placeholder="••••••••"
                       class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition">
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-1 text-xs text-red-500" />
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                <button type="button"
                        x-on:click="$dispatch('close')"
                        class="px-4 py-2 rounded-xl border border-gray-200 text-gray-700 hover:bg-gray-50 text-xs font-semibold transition">
                    Batal
                </button>
                <button type="submit"
                        class="px-5 py-2 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-xs font-semibold shadow-xs transition">
                    Ya, Hapus Permanen
                </button>
            </div>
        </form>
    </x-modal>
</section>

