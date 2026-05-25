<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('dashboard') }}"
               class="text-gray-400 hover:text-gray-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Urugan Tanah') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- ===== TOP CARD: Status + Action ===== --}}
            <div class="bg-white shadow-sm sm:rounded-xl border border-gray-100 p-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                    {{-- Status Badge --}}
                    <div class="flex items-center gap-3">
                        <span class="text-sm text-gray-500 font-medium">Status Pengajuan:</span>
                        @if ($urugan->status === 'accepted')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-700">
                                <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                                Accepted
                            </span>
                        @elseif ($urugan->status === 'decline')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-700">
                                <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                Decline
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-700">
                                <span class="w-2 h-2 rounded-full bg-yellow-400 animate-pulse"></span>
                                Pending
                            </span>
                        @endif
                    </div>

                    {{-- Action Buttons (Role: Kantor) --}}
                    @if ($urugan->status === 'pending')
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-gray-400 italic hidden sm:block">Tindakan Kantor:</span>

                        {{-- Accept --}}
                        <form action="{{ route('urugan.update-status', $urugan) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="accepted">
                            <button type="submit" onclick="confirmAction('accepted')"
                                class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 active:scale-95 text-white text-sm font-semibold rounded-lg shadow-sm transition">
                                <x-ionicon-checkmark-sharp class="w-4 h-4" />
                                Accept
                            </button>
                        </form>

                        {{-- Decline --}}
                        <form action="{{ route('urugan.update-status', $urugan) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="decline">
                            <button type="submit" onclick="confirmAction('decline')"
                                class="inline-flex items-center gap-2 px-4 py-2 bg-red-500 hover:bg-red-600 active:scale-95 text-white text-sm font-semibold rounded-lg shadow-sm transition">
                                <x-ionicon-close-sharp class="w-4 h-4" />
                                Decline
                            </button>
                        </form>
                    </div>
                    @else
                    <p class="text-xs text-gray-400 italic">Pengajuan telah diproses.</p>
                    @endif
                </div>
            </div>

            {{-- ===== MAIN CONTENT GRID ===== --}}
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

                {{-- LEFT: Detail Data (2/5) --}}
                <div class="lg:col-span-2 space-y-5">

                    {{-- Card: Informasi Perusahaan --}}
                    <div class="bg-white shadow-sm sm:rounded-xl border border-gray-100 overflow-hidden">
                        <div class="px-5 py-4 border-b border-gray-100 bg-gray-50">
                            <h3 class="text-xs font-bold uppercase tracking-widest text-indigo-500">
                                Informasi Perusahaan
                            </h3>
                        </div>
                        <div class="divide-y divide-gray-50">

                            <div class="px-5 py-4">
                                <p class="text-xs text-gray-400 mb-0.5">Nama Perusahaan</p>
                                <p class="text-sm font-semibold text-gray-800">{{ $urugan->nama_pt }}</p>
                            </div>

                            <div class="px-5 py-4">
                                <p class="text-xs text-gray-400 mb-0.5">Alamat Perusahaan</p>
                                <p class="text-sm text-gray-700 leading-relaxed">{{ $urugan->alamat_pt }}</p>
                            </div>

                            <div class="px-5 py-4">
                                <p class="text-xs text-gray-400 mb-0.5">Nama Konstruktor</p>
                                <div class="flex items-center gap-2 mt-1">
                                    <div class="w-7 h-7 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xs flex-shrink-0">
                                        {{ strtoupper(substr($urugan->nama_konstruktor, 0, 1)) }}
                                    </div>
                                    <p class="text-sm font-medium text-gray-800">{{ $urugan->nama_konstruktor }}</p>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- Card: Detail Proyek --}}
                    <div class="bg-white shadow-sm sm:rounded-xl border border-gray-100 overflow-hidden">
                        <div class="px-5 py-4 border-b border-gray-100 bg-gray-50">
                            <h3 class="text-xs font-bold uppercase tracking-widest text-indigo-500">
                                Detail Proyek
                            </h3>
                        </div>
                        <div class="divide-y divide-gray-50">

                            <div class="px-5 py-4">
                                <p class="text-xs text-gray-400 mb-0.5">Tanggal Mulai</p>
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-indigo-400 flex-shrink-0"
                                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="text-sm font-medium text-gray-800">
                                        {{ \Carbon\Carbon::parse($urugan->tanggal_mulai)->translatedFormat('d F Y') }}
                                    </p>
                                </div>
                            </div>

                            <div class="px-5 py-4">
                                <p class="text-xs text-gray-400 mb-0.5">Luas Tanah</p>
                                <div class="flex items-baseline gap-1">
                                    <span class="text-2xl font-bold text-gray-800">{{ number_format($urugan->luas_tanah, 0, ',', '.') }}</span>
                                    <span class="text-sm text-gray-400 font-medium">m²</span>
                                </div>
                            </div>

                            <div class="px-5 py-4">
                                <p class="text-xs text-gray-400 mb-0.5">Lokasi Tanah</p>
                                <div class="flex items-start gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-red-400 mt-0.5 flex-shrink-0"
                                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <p class="text-sm text-gray-700">{{ $urugan->lokasi }}</p>
                                </div>
                            </div>

                            <div class="px-5 py-4">
                                <p class="text-xs text-gray-400 mb-0.5">Dibuat pada</p>
                                <p class="text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($urugan->created_at)->translatedFormat('d F Y, H:i') }} WIB
                                </p>
                            </div>

                        </div>
                    </div>

                </div>

                {{-- RIGHT: PDF Viewer (3/5) --}}
                <div class="lg:col-span-3">
                    <div class="bg-white shadow-sm sm:rounded-xl border border-gray-100 overflow-hidden h-full flex flex-col">

                        <div class="px-5 py-4 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-red-500" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <h3 class="text-xs font-bold uppercase tracking-widest text-indigo-500">
                                    Dokumen Pendukung
                                </h3>
                            </div>

                            {{-- Download button --}}
                            @if ($urugan->fileupload)
                            <a href="{{ asset('storage/' . $urugan->fileupload) }}"
                               download
                               class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 rounded-lg border border-indigo-200 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                                Download PDF
                            </a>
                            @endif
                        </div>

                        {{-- PDF iframe --}}
                        <div class="flex-1 min-h-0 bg-gray-100">
                            @if ($urugan->fileupload)
                                <iframe
                                    src="{{ asset('storage/' . $urugan->fileupload) }}#toolbar=1&navpanes=0&scrollbar=1"
                                    class="w-full"
                                    style="height: 680px;"
                                    type="application/pdf"
                                    title="Dokumen Urugan Tanah - {{ $urugan->nama_pt }}">
                                    {{-- Fallback jika browser tidak support inline PDF --}}
                                    <div class="flex flex-col items-center justify-center h-full gap-3 p-6 text-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-300" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        <p class="text-sm text-gray-500">Browser Anda tidak mendukung tampilan PDF.</p>
                                        <a href="{{ asset('storage/' . $urugan->fileupload) }}"
                                           class="text-sm text-indigo-600 underline font-medium">
                                            Klik di sini untuk membuka dokumen
                                        </a>
                                    </div>
                                </iframe>
                            @else
                                <div class="flex flex-col items-center justify-center gap-3 p-10 text-center" style="height: 680px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-200" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <p class="text-sm font-medium text-gray-400">Tidak ada dokumen yang diunggah.</p>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>

            </div>{{-- end grid --}}

        </div>
    </div>

    {{-- ===== MODAL KONFIRMASI ===== --}}
    <div id="confirm-modal"
         class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm px-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm p-6 transform transition-all scale-95 opacity-0"
             id="modal-box">

            <div class="flex items-center gap-3 mb-4">
                <div id="modal-icon"
                     class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0">
                </div>
                <div>
                    <h4 id="modal-title" class="text-base font-bold text-gray-800"></h4>
                    <p id="modal-desc" class="text-sm text-gray-500 mt-0.5"></p>
                </div>
            </div>

            <div class="flex gap-3 justify-end mt-6">
                <button onclick="closeModal()"
                        class="px-4 py-2 rounded-lg border border-gray-200 text-sm font-medium text-gray-600 hover:bg-gray-50 transition">
                    Batal
                </button>
                <button id="modal-confirm-btn"
                        class="px-5 py-2 rounded-lg text-sm font-bold text-white transition active:scale-95">
                    Konfirmasi
                </button>
            </div>
        </div>
    </div>
</x-app-layout>
