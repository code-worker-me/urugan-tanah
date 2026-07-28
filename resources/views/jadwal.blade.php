<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Jadwal Kerja Truk &mdash; Urugan Tanah</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-slate-50 text-slate-800 font-sans antialiased min-h-screen flex flex-col justify-between">

        <div>
            {{-- Top Navigation Bar --}}
            <nav class="bg-blue-950 border-b border-blue-900/80 sticky top-0 z-50 backdrop-blur-md bg-opacity-95">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-16">
                        <!-- Brand Logo -->
                        <a href="{{ route('jadwal.index') }}" class="flex items-center gap-3 group">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-700 to-red-600 flex items-center justify-center text-white shadow-lg shadow-blue-950/50 group-hover:scale-105 transition-transform duration-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <span class="font-extrabold text-lg text-white tracking-tight group-hover:text-red-400 transition-colors">Urugan Tanah</span>
                                <span class="block text-[10px] text-blue-200 font-semibold tracking-wider uppercase -mt-1">Operational Portal</span>
                            </div>
                        </a>

                        <!-- Navigation Right Actions -->
                        <div class="flex items-center gap-3">
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ route('dashboard') }}"
                                       class="px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs shadow-md shadow-blue-600/30 transition-all duration-200 flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                        </svg>
                                        <span>Dashboard</span>
                                    </a>
                                @else
                                    <a href="{{ route('login') }}"
                                       class="px-4 py-2 rounded-xl bg-white/10 hover:bg-white/25 border border-white/20 text-white font-bold text-xs backdrop-blur-sm transition-all duration-200 flex items-center gap-2">
                                        <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                                        </svg>
                                        <span>Login Portal</span>
                                    </a>
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>
            </nav>

            {{-- Main Body Container --}}
            <main class="py-8 sm:py-10">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

                    {{-- Hero Banner Section --}}
                    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-blue-950 via-blue-900 to-indigo-900 text-white p-6 sm:p-10 shadow-2xl border border-blue-800/60">
                        <!-- Background Decorative Elements -->
                        <div class="absolute -top-12 -right-12 w-64 h-64 bg-red-600/30 rounded-full blur-3xl pointer-events-none"></div>
                        <div class="absolute -bottom-16 -left-16 w-72 h-72 bg-blue-400/20 rounded-full blur-3xl pointer-events-none"></div>
                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:24px_24px] opacity-10 pointer-events-none"></div>

                        <div class="relative z-10 max-w-3xl space-y-3">
                            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-white/10 border border-white/20 text-xs font-semibold backdrop-blur-md text-blue-100">
                                <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                                Informasi Jadwal Operasional Public
                            </div>
                            <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight leading-tight">
                                Jadwal Kerja Operasional <span class="text-red-400">Armada Truk</span>
                            </h1>
                            <p class="text-sm sm:text-base text-blue-100/90 leading-relaxed font-medium">
                                Pantau jadwal kerja pengiriman tanah, lokasi proyek, dan status operasional armada truk secara terpusat dan transparan.
                            </p>
                        </div>
                    </div>

                    {{-- Metric Cards --}}
                    @php
                        $collection = $data->getCollection();
                        $totalItems = $data->total();
                        $kerjaCount = $collection->where('status', 'kerja')->count();
                        $liburCount = $collection->where('status', 'libur')->count();
                    @endphp

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                        <!-- Total Agenda -->
                        <div class="bg-white rounded-2xl p-5 border-t-4 border-t-blue-700 border-x border-b border-blue-100 shadow-sm hover:shadow-md transition-all duration-200 flex items-center justify-between group">
                            <div class="space-y-1">
                                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total Jadwal Halaman Ini</p>
                                <h3 class="text-3xl font-extrabold text-blue-950">{{ $totalItems }}</h3>
                                <p class="text-xs text-blue-600 font-medium">Agenda terdaftar</p>
                            </div>
                            <div class="w-12 h-12 rounded-2xl bg-blue-50 group-hover:bg-blue-600 text-blue-700 group-hover:text-white flex items-center justify-center transition-all duration-200 shadow-xs">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Status Kerja -->
                        <div class="bg-white rounded-2xl p-5 border-t-4 border-t-emerald-600 border-x border-b border-blue-100 shadow-sm hover:shadow-md transition-all duration-200 flex items-center justify-between group">
                            <div class="space-y-1">
                                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Status Beroperasi (Kerja)</p>
                                <h3 class="text-3xl font-extrabold text-blue-950">{{ $kerjaCount }}</h3>
                                <p class="text-xs text-emerald-600 font-medium">Truk aktif pengiriman</p>
                            </div>
                            <div class="w-12 h-12 rounded-2xl bg-emerald-50 group-hover:bg-emerald-600 text-emerald-600 group-hover:text-white flex items-center justify-center transition-all duration-200 shadow-xs">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Status Libur -->
                        <div class="bg-white rounded-2xl p-5 border-t-4 border-t-slate-400 border-x border-b border-blue-100 shadow-sm hover:shadow-md transition-all duration-200 flex items-center justify-between group">
                            <div class="space-y-1">
                                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Status Non-Aktif (Libur)</p>
                                <h3 class="text-3xl font-extrabold text-blue-950">{{ $liburCount }}</h3>
                                <p class="text-xs text-slate-500 font-medium">Armada tidak beroperasi</p>
                            </div>
                            <div class="w-12 h-12 rounded-2xl bg-slate-100 group-hover:bg-slate-700 text-slate-600 group-hover:text-white flex items-center justify-center transition-all duration-200 shadow-xs">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Main Content Section --}}
                    <div class="bg-white rounded-3xl shadow-xl shadow-blue-950/5 border border-blue-100/90 relative overflow-hidden">
                        <!-- Top Card Gradient Line (Blue-White-Red) -->
                        <div class="h-1.5 w-full bg-gradient-to-r from-blue-700 via-slate-200 to-red-600"></div>

                        <div class="p-6 sm:p-8">
                            <section class="w-full space-y-6">
                                <header class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-100">
                                    <div class="flex items-center gap-3">
                                        <div class="w-3 h-3 rounded-full bg-red-600 animate-pulse"></div>
                                        <h2 class="text-xl font-bold text-blue-950 tracking-tight">Daftar Jadwal Kerja Armada Truk</h2>
                                    </div>
                                </header>

                                {{-- Desktop Table Component --}}
                                <x-jadwal-table-desktop :jadwal="$data" />

                                {{-- Mobile Card Component --}}
                                <x-jadwal-card-mobile :jadwal="$data" />

                                {{-- Pagination Links --}}
                                @if ($data->hasPages())
                                    <div class="pt-4 border-t border-slate-100">
                                        {{ $data->links() }}
                                    </div>
                                @endif
                            </section>
                        </div>
                    </div>

                </div>
            </main>
        </div>

        {{-- Footer --}}
        <footer class="bg-blue-950 border-t border-blue-900/80 py-6 text-center text-xs text-blue-200/70 font-medium">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-3">
                <p>&copy; {{ date('Y') }} Sistem Informasi Urugan Tanah. Hak Cipta Dilindungi.</p>
                <div class="flex items-center gap-4">
                    <span class="inline-flex items-center gap-1.5 text-slate-300">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        Sistem Active
                    </span>
                </div>
            </div>
        </footer>

    </body>
</html>
