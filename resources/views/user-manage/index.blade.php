<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-blue-950 tracking-tight flex items-center gap-2">
                    <span class="p-2 rounded-xl bg-blue-100 text-blue-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </span>
                    {{ __('User Management & Data Karyawan') }}
                </h2>
                <p class="text-xs text-slate-500 mt-1">Kelola data seluruh akun karyawan dan hak akses role dalam sistem.</p>
            </div>
            @can('kantor')
                <x-button-link href="{{ route('user-manage.create') }}" color="blue">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                    <span>Tambah Karyawan</span>
                </x-button-link>
            @endcan
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Summary Metric Cards for Users (White, Blue, Red pattern) --}}
            @php
                $collection = $users->getCollection();
                $totalUsers = $users->total();
                $kantorCount = $collection->where('role', 'kantor')->count();
                $konstruktorCount = $collection->where('role', 'konstruktor')->count();
                $lapanganCount = $collection->where('role', 'lapangan')->count();
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <!-- Total Users -->
                <div class="bg-white rounded-2xl p-5 border-t-4 border-t-blue-700 border-x border-b border-blue-100 shadow-sm hover:shadow-md transition-all duration-200 flex items-center justify-between group">
                    <div class="space-y-1">
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total Karyawan</p>
                        <h3 class="text-3xl font-extrabold text-blue-950">{{ $totalUsers }}</h3>
                        <p class="text-xs text-blue-600 font-medium">Akun terdaftar</p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 group-hover:bg-blue-600 text-blue-700 group-hover:text-white flex items-center justify-center transition-all duration-200 shadow-xs">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                </div>

                <!-- Admin / Kantor -->
                <div class="bg-white rounded-2xl p-5 border-t-4 border-t-blue-500 border-x border-b border-blue-100 shadow-sm hover:shadow-md transition-all duration-200 flex items-center justify-between group">
                    <div class="space-y-1">
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Karyawan Kantor</p>
                        <h3 class="text-3xl font-extrabold text-blue-950">{{ $kantorCount }}</h3>
                        <p class="text-xs text-blue-600 font-medium">Role Kantor</p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 group-hover:bg-blue-600 text-blue-600 group-hover:text-white flex items-center justify-center transition-all duration-200 shadow-xs">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h4m-4 0V11m0 0h4m-4 0H9"/>
                        </svg>
                    </div>
                </div>

                <!-- Client Konstruktor -->
                <div class="bg-white rounded-2xl p-5 border-t-4 border-t-red-600 border-x border-b border-blue-100 shadow-sm hover:shadow-md transition-all duration-200 flex items-center justify-between group">
                    <div class="space-y-1">
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Client Konstruktor</p>
                        <h3 class="text-3xl font-extrabold text-blue-950">{{ $konstruktorCount }}</h3>
                        <p class="text-xs text-red-600 font-medium">Role Konstruktor</p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-red-50 group-hover:bg-red-600 text-red-600 group-hover:text-white flex items-center justify-center transition-all duration-200 shadow-xs">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>

                <!-- Lapangan -->
                <div class="bg-white rounded-2xl p-5 border-t-4 border-t-emerald-600 border-x border-b border-blue-100 shadow-sm hover:shadow-md transition-all duration-200 flex items-center justify-between group">
                    <div class="space-y-1">
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Karyawan Lapangan</p>
                        <h3 class="text-3xl font-extrabold text-blue-950">{{ $lapanganCount }}</h3>
                        <p class="text-xs text-emerald-600 font-medium">Role Lapangan</p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 group-hover:bg-emerald-600 text-emerald-600 group-hover:text-white flex items-center justify-center transition-all duration-200 shadow-xs">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Main Content Container (User Table & Cards) --}}
            <div class="bg-white rounded-3xl shadow-xl shadow-blue-950/5 border border-blue-100/90 relative overflow-hidden">
                <!-- Top Card Gradient Line (Blue-White-Red) -->
                <div class="h-1.5 w-full bg-gradient-to-r from-blue-700 via-slate-200 to-red-600"></div>

                <div class="p-6 sm:p-8">
                    <section class="w-full space-y-6">
                        {{-- Header + Tombol Tambah --}}
                        <header class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-100">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 rounded-full bg-red-600 animate-pulse"></div>
                                <h2 class="text-xl font-bold text-blue-950 tracking-tight">Daftar Karyawan & Hak Akses</h2>
                            </div>
                        </header>

                        {{-- Table Desktop --}}
                        <x-user-table-desktop :users="$users" />

                        {{-- Card Mobile --}}
                        <x-user-card-mobile :users="$users" />

                        {{-- Pagination --}}
                        @if ($users->hasPages())
                            <div class="pt-4 border-t border-slate-100">
                                {{ $users->links() }}
                            </div>
                        @endif
                    </section>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>