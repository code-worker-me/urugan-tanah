<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('dashboard') }}"
               class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-white border border-gray-200 text-gray-500 hover:text-indigo-600 hover:border-indigo-200 hover:bg-indigo-50/50 transition duration-200 shadow-xs">
                <x-ionicon-chevron-back-outline class="w-5 h-5" />
            </a>
            <div>
                <div class="flex items-center gap-2">
                    <span class="text-xs font-semibold uppercase tracking-wider text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-md border border-indigo-100">Pengaturan</span>
                    <span class="text-xs text-gray-400">&bull;</span>
                    <span class="text-xs text-gray-500 font-medium">Akun Saya</span>
                </div>
                <h2 class="font-bold text-xl text-gray-900 leading-tight mt-0.5">
                    {{ __('Profil Pengguna') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- User Avatar Header Banner Card --}}
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-indigo-900 via-indigo-800 to-purple-900 p-6 md:p-8 text-white shadow-xl shadow-indigo-100">
                <div class="absolute -right-6 -bottom-10 opacity-10 pointer-events-none">
                    <svg class="w-72 h-72 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                </div>

                <div class="relative z-10 flex flex-col sm:flex-row items-center sm:items-start gap-5">
                    {{-- Avatar Initial Badge --}}
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-indigo-400 to-purple-400 border-2 border-white/30 text-white font-extrabold text-2xl flex items-center justify-center shadow-lg uppercase flex-shrink-0">
                        {{ substr(auth()->user()->name, 0, 2) }}
                    </div>

                    <div class="text-center sm:text-left space-y-1.5 flex-1">
                        <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2">
                            <h3 class="text-xl md:text-2xl font-bold tracking-tight text-white">{{ auth()->user()->name }}</h3>
                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-semibold bg-white/20 backdrop-blur-md border border-white/25 text-white uppercase tracking-wider">
                                {{ auth()->user()->role ?? 'User' }}
                            </span>
                        </div>
                        <p class="text-sm text-indigo-200/90 flex items-center justify-center sm:justify-start gap-1.5">
                            <svg class="w-4 h-4 text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                            </svg>
                            {{ auth()->user()->email }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Update Profile Information --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-xl shadow-gray-100/80 p-6 md:p-8">
                @include('profile.partials.update-profile-information-form')
            </div>

            {{-- Update Password --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-xl shadow-gray-100/80 p-6 md:p-8">
                @include('profile.partials.update-password-form')
            </div>

            {{-- Delete Account (Danger Zone) --}}
            <div class="bg-white rounded-2xl border border-rose-100 shadow-xl shadow-rose-50/50 p-6 md:p-8">
                @include('profile.partials.delete-user-form')
            </div>

        </div>
    </div>
</x-app-layout>

