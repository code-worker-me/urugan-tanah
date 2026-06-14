<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Jadwal Truk</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] min-h-screen p-6 lg:p-10">
        <div class="max-w-4xl mx-auto w-full">

            <div class="mb-6 flex items-start justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-semibold">Jadwal Truk</h1>
                    <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mt-1">
                        Daftar jadwal truk urugan, diurutkan dari yang terbaru.
                    </p>
                </div>

                @if (Route::has('login'))
                    @auth
                    <a
                        href="{{ route('dashboard') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                        Dashboard
                    </a>
                    @else
                    <a
                        href="{{ route('login') }}"
                        class="shrink-0 inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-[#19140035] dark:border-[#3E3E3A] hover:border-black dark:hover:border-white rounded-sm text-sm leading-normal whitespace-nowrap"
                    >
                        Masuk
                    </a>
                    @endauth
                @endif
            </div>

            <div class="border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg overflow-hidden bg-white dark:bg-[#161615] shadow-[0px_0px_1px_0px_rgba(0,0,0,0.03),0px_1px_2px_0px_rgba(0,0,0,0.06)]">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-[#e3e3e0] dark:border-[#3E3E3A] text-left text-[#706f6c] dark:text-[#A1A09A]">
                            <th class="px-5 py-3 font-medium">Waktu</th>
                            <th class="px-5 py-3 font-medium">Lokasi</th>
                            <th class="px-5 py-3 font-medium text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $jadwal)
                            <tr class="border-b border-[#e3e3e0] dark:border-[#3E3E3A] last:border-b-0 hover:bg-[#FDFDFC] dark:hover:bg-[#0a0a0a]">
                                <td class="px-5 py-3 whitespace-nowrap align-top">
                                    {{ \Carbon\Carbon::parse($jadwal->waktu)->format('d M Y, H:i') }}
                                </td>
                                <td class="px-5 py-3 align-top">
                                    {{ $jadwal->urugan->lokasi ?? '—' }}
                                </td>
                                <td class="px-5 py-3 text-right align-top">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium">
                                        {{ $jadwal->status ?? '-' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-5 py-10 text-center text-[#706f6c] dark:text-[#A1A09A]">
                                    Belum ada jadwal truk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($data->hasPages())
                <div class="mt-4">
                    {{ $data->links() }}
                </div>
            @endif

        </div>
    </body>
</html>
