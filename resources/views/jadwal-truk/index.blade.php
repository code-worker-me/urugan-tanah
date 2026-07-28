<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-3">
                <a href="{{ route('urugan.view', $urugan) }}"
                   class="p-2 rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-blue-50 hover:text-blue-700 hover:border-blue-200 transition-all duration-200 shadow-2xs">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <div>
                    <h2 class="font-bold text-2xl text-blue-950 tracking-tight flex items-center gap-2">
                        <span class="p-2 rounded-xl bg-blue-100 text-blue-700">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </span>
                        {{ __('Jadwal Operasional Truk') }}
                    </h2>
                    <p class="text-xs text-slate-500 mt-1 flex items-center gap-1.5 font-medium">
                        <span class="text-blue-900 font-bold bg-blue-50 px-2 py-0.5 rounded-md border border-blue-100">{{ $urugan->nama_pt }}</span>
                        <span>&bull;</span>
                        <span>{{ $urugan->lokasi }}</span>
                    </p>
                </div>
            </div>
            @can('kantor')
                <x-button-link href="{{ route('jadwalUrugan.create', $urugan) }}" color="blue">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Tambah Jadwal</span>
                </x-button-link>
            @endcan
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Flash Alert Success --}}
            @if (session('success'))
                <div class="flex items-center gap-3 px-5 py-4 bg-emerald-50 border-l-4 border-l-emerald-600 border-r border-t border-b border-emerald-200 rounded-2xl text-sm text-emerald-800 font-semibold shadow-xs">
                    <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- Summary Metric Cards --}}
            @php
                $totalCount = $urugan->jadwal()->count();
                $kerjaCount = $urugan->jadwal()->countKerja();
                $liburCount = $urugan->jadwal()->countLibur();
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <!-- Total Jadwal Card -->
                <div class="bg-white rounded-2xl p-5 border-t-4 border-t-blue-700 border-x border-b border-blue-100 shadow-sm hover:shadow-md transition-all duration-200 flex items-center justify-between group">
                    <div class="space-y-1">
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total Jadwal</p>
                        <h3 class="text-3xl font-extrabold text-blue-950">{{ $totalCount }}</h3>
                        <p class="text-xs text-blue-600 font-medium">Keseluruhan agenda</p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 group-hover:bg-blue-600 text-blue-700 group-hover:text-white flex items-center justify-center transition-all duration-200 shadow-xs">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>

                <!-- Kerja / Operasional Card -->
                <div class="bg-white rounded-2xl p-5 border-t-4 border-t-emerald-600 border-x border-b border-blue-100 shadow-sm hover:shadow-md transition-all duration-200 flex items-center justify-between group">
                    <div class="space-y-1">
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Kerja / Operasional</p>
                        <h3 class="text-3xl font-extrabold text-blue-950">{{ $kerjaCount }}</h3>
                        <p class="text-xs text-emerald-600 font-medium">Truk beroperasi</p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 group-hover:bg-emerald-600 text-emerald-600 group-hover:text-white flex items-center justify-center transition-all duration-200 shadow-xs">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                </div>

                <!-- Libur Card -->
                <div class="bg-white rounded-2xl p-5 border-t-4 border-t-slate-400 border-x border-b border-blue-100 shadow-sm hover:shadow-md transition-all duration-200 flex items-center justify-between group">
                    <div class="space-y-1">
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Jadwal Libur</p>
                        <h3 class="text-3xl font-extrabold text-blue-950">{{ $liburCount }}</h3>
                        <p class="text-xs text-slate-500 font-medium">Non-operasional</p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-slate-100 group-hover:bg-slate-700 text-slate-600 group-hover:text-white flex items-center justify-center transition-all duration-200 shadow-xs">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Main Content Container --}}
            <div class="bg-white rounded-3xl shadow-xl shadow-blue-950/5 border border-blue-100/90 relative overflow-hidden">
                <!-- Top Card Gradient Line (Blue-White-Red) -->
                <div class="h-1.5 w-full bg-gradient-to-r from-blue-700 via-slate-200 to-red-600"></div>

                <div class="p-6 sm:p-8">
                    <section class="w-full space-y-6">
                        {{-- Header Section --}}
                        <header class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-100">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 rounded-full bg-red-600 animate-pulse"></div>
                                <h3 class="text-xl font-bold text-blue-950 tracking-tight">
                                    Jadwal Truk <span class="text-blue-700">{{ $urugan->nama_pt }}</span>
                                </h3>
                            </div>
                        </header>

                        {{-- Table Desktop --}}
                        <x-jadwal-table-desktop :jadwal="$jadwal" :urugan="$urugan" />

                        {{-- Card Mobile --}}
                        <x-jadwal-card-mobile :jadwal="$jadwal" :urugan="$urugan" />

                        {{-- Pagination --}}
                        @if ($jadwal->hasPages())
                            <div class="pt-4 border-t border-slate-100">
                                {{ $jadwal->links() }}
                            </div>
                        @endif
                    </section>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
