<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-blue-950 tracking-tight flex items-center gap-2">
                    <span class="p-2 rounded-xl bg-blue-100 text-blue-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </span>
                    {{ __('Dashboard Utama') }}
                </h2>
                <p class="text-xs text-slate-500 mt-1">Pemantauan & Pengelolaan Proyek Urugan Tanah</p>
            </div>
            @can('konstruktor')
                <x-button-link href="{{ route('urugan.create') }}" color="blue">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Tambah Proyek</span>
                </x-button-link>
            @endcan
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Hero Welcome Banner (White, Blue, Red Pattern) --}}
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-blue-950 via-blue-900 to-indigo-900 text-white p-6 sm:p-8 shadow-2xl border border-blue-800/60">
                <!-- Background Decorative Glows -->
                <div class="absolute -top-12 -right-12 w-64 h-64 bg-red-600/30 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-16 -left-16 w-72 h-72 bg-blue-500/20 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:24px_24px] opacity-10 pointer-events-none"></div>

                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="max-w-2xl space-y-3">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/20 text-xs font-semibold backdrop-blur-md text-blue-100">
                            <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                            Sistem Manajemen Urugan Tanah
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                            Selamat Datang kembali, <span class="text-red-400">{{ Auth::user()->name }}</span>! 👋
                        </h1>
                        <p class="text-sm text-blue-100/90 leading-relaxed">
                            Pantau status proyek, data ritase tanah, dan informasi truk secara real-time dalam satu platform terpadu.
                        </p>
                    </div>

                    <div class="flex items-center gap-3 shrink-0">
                        @can('konstruktor')
                            <a href="{{ route('urugan.create') }}" class="px-4 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white text-sm font-semibold shadow-lg shadow-red-600/40 hover:shadow-red-600/60 transition-all duration-200 flex items-center gap-2 active:scale-95">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Proyek Baru
                            </a>
                        @endcan
                        <a href="{{ route('jadwal.index') }}" class="px-4 py-2.5 rounded-xl bg-white/15 hover:bg-white/25 border border-white/30 text-white text-sm font-semibold backdrop-blur-sm transition-all duration-200 flex items-center gap-2 active:scale-95">
                            <svg class="w-4 h-4 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Jadwal Truk
                        </a>
                    </div>
                </div>
            </div>

            {{-- Summary Metric Cards (White cards with Blue & Red Highlights) --}}
            @php
                $collection = $projects->getCollection();
                $totalCount = $projects->total();
                $acceptedCount = $collection->where('status', 'accepted')->count();
                $pendingCount = $collection->where('status', 'pending')->count();
                $declineCount = $collection->where('status', 'decline')->count();
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <!-- Card 1: Total Proyek -->
                <div class="bg-white rounded-2xl p-5 border-t-4 border-t-blue-700 border-x border-b border-blue-100 shadow-sm hover:shadow-md transition-all duration-200 flex items-center justify-between group">
                    <div class="space-y-1">
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total Proyek</p>
                        <h3 class="text-3xl font-extrabold text-blue-950">{{ $totalCount }}</h3>
                        <p class="text-xs text-blue-600 font-medium">Terdaftar di sistem</p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 group-hover:bg-blue-600 text-blue-700 group-hover:text-white flex items-center justify-center transition-all duration-200 shadow-xs">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h4m-4 0V11m0 0h4m-4 0H9"/>
                        </svg>
                    </div>
                </div>

                <!-- Card 2: Disetujui (Accepted) -->
                <div class="bg-white rounded-2xl p-5 border-t-4 border-t-emerald-600 border-x border-b border-blue-100 shadow-sm hover:shadow-md transition-all duration-200 flex items-center justify-between group">
                    <div class="space-y-1">
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Disetujui</p>
                        <h3 class="text-3xl font-extrabold text-blue-950">{{ $acceptedCount }}</h3>
                        <p class="text-xs text-emerald-600 font-medium">Status Accepted</p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 group-hover:bg-emerald-600 text-emerald-600 group-hover:text-white flex items-center justify-center transition-all duration-200 shadow-xs">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>

                <!-- Card 3: Menunggu (Pending) -->
                <div class="bg-white rounded-2xl p-5 border-t-4 border-t-amber-500 border-x border-b border-blue-100 shadow-sm hover:shadow-md transition-all duration-200 flex items-center justify-between group">
                    <div class="space-y-1">
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Menunggu</p>
                        <h3 class="text-3xl font-extrabold text-blue-950">{{ $pendingCount }}</h3>
                        <p class="text-xs text-amber-600 font-medium">Perlu Review</p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-amber-50 group-hover:bg-amber-500 text-amber-600 group-hover:text-white flex items-center justify-center transition-all duration-200 shadow-xs">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>

                <!-- Card 4: Ditolak (Decline) -->
                <div class="bg-white rounded-2xl p-5 border-t-4 border-t-red-600 border-x border-b border-blue-100 shadow-sm hover:shadow-md transition-all duration-200 flex items-center justify-between group">
                    <div class="space-y-1">
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Ditolak</p>
                        <h3 class="text-3xl font-extrabold text-blue-950">{{ $declineCount }}</h3>
                        <p class="text-xs text-red-600 font-medium">Perlu Revisi</p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-red-50 group-hover:bg-red-600 text-red-600 group-hover:text-white flex items-center justify-center transition-all duration-200 shadow-xs">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Main Content Section (Projects Table & Cards) --}}
            <div class="bg-white rounded-3xl shadow-xl shadow-blue-950/5 border border-blue-100/90 relative overflow-hidden">
                <!-- Top Card Gradient Line (Blue-White-Red) -->
                <div class="h-1.5 w-full bg-gradient-to-r from-blue-700 via-slate-200 to-red-600"></div>

                <div class="p-6 sm:p-8">
                    <section class="w-full space-y-6">
                        {{-- Header + Tombol Tambah --}}
                        <header class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-100">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 rounded-full bg-red-600 animate-pulse"></div>
                                <h2 class="text-xl font-bold text-blue-950 tracking-tight">Daftar Proyek Urugan Tanah</h2>
                            </div>

                            @can('konstruktor')
                                <x-button-link href="{{ route('urugan.create') }}" color="blue">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    <span>Tambah Proyek</span>
                                </x-button-link>
                            @endcan
                        </header>

                        {{-- Desktop Table View --}}
                        <x-project-table-desktop :projects="$projects" />

                        {{-- Mobile Card View --}}
                        <x-project-card-mobile :projects="$projects" />

                        {{-- Pagination --}}
                        @if ($projects->hasPages())
                            <div class="pt-4 border-t border-slate-100">
                                {{ $projects->links() }}
                            </div>
                        @endif
                    </section>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>