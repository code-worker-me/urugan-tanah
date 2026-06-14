<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('urugan.view', $urugan) }}"
               class="text-gray-400 hover:text-gray-600 transition">
                   <x-ionicon-chevron-back-outline class="w-5 h-5" />
            </a>
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Admin Lapangan</h2>
                <p class="text-xs text-gray-400 mt-0.5">{{ $urugan->nama_pt }} &mdash; {{ $urugan->lokasi }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-xl border border-gray-100">
                <div class="p-6 md:p-8">
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                            <p class="text-sm font-semibold text-red-700 mb-1">Terdapat kesalahan:</p>
                            <ul class="list-disc list-inside text-sm text-red-600 space-y-0.5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <h3 class="text-xs font-bold uppercase tracking-widest text-indigo-500 mb-4 pb-2 border-b border-gray-100">
                        Identitas
                    </h3>
                    <form action="{{ route('lapangan.store', $urugan) }}"
                          method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div class="sm:col-span-1">
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                        Nama <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="name" name="name"
                                           value="{{ old('name') }}"
                                           placeholder="Bambang"
                                           class="w-full rounded-lg border @error('name') border-red-400 bg-red-50 @else border-gray-300 @enderror px-4 py-2.5 text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                                    @error('name')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                                        Email <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="email" name="email"
                                           value="{{ old('email') }}"
                                           placeholder="lap@mail.com"
                                           class="w-full rounded-lg border @error('email') border-red-400 bg-red-50 @else border-gray-300 @enderror px-4 py-2.5 text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                                    @error('email')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div class="sm:col-span-1">
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                                        Password <span class="text-red-500">*</span>
                                    </label>
                                    <input type="password" id="password" name="password"
                                           value="{{ old('password') }}"
                                           class="w-full rounded-lg border @error('password') border-red-400 bg-red-50 @else border-gray-300 @enderror px-4 py-2.5 text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                                    @error('password')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                                        Password Confirmation <span class="text-red-500">*</span>
                                    </label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                           value="{{ old('password_confirmation') }}"
                                           class="w-full rounded-lg border @error('password_confirmation') border-red-400 bg-red-50 @else border-gray-300 @enderror px-4 py-2.5 text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                                    @error('password_confirmation')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                            <x-button-link href="{{ route('urugan.view', $urugan) }}" color="red">
                                Batal
                            </x-button-link>
                            <x-primary-button>
                                Simpan
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
