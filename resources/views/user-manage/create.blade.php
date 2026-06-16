<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('user-manage.index') }}" class="text-gray-400 hover:text-gray-600 transition">
                <x-ionicon-chevron-back-outline class="w-5 h-5" />
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tambah Karyawan & Role') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl flex mx-auto sm:px-6 lg:px-8 items-center justify-center">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg max-w-xl">
                <div class="p-6 md:p-8">
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                            <p class="text-sm font-semibold text-red-700 mb-1">Terdapat kesalahan input:</p>
                            <ul class="list-disc list-inside text-sm text-red-600 space-y-0.5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('user-manage.store') }}" method="POST" >
                        @csrf

                        <section>
                            <h3
                                class="text-sm font-semibold text-indigo-600 uppercase tracking-widest mb-4 pb-2 border-b border-gray-100">
                                Informasi Karyawan
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                {{-- Nama Karyawan --}}
                                <div class="md:col-span-2">
                                    <label for="name"
                                           class="block text-sm font-medium text-gray-700 mb-1">
                                        Nama Karyawan
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="name" name="name"
                                           value="{{ old('name') }}"
                                           placeholder="Bambang Pamungkas"
                                           class="w-full rounded-lg border @error('name') border-red-400 bg-red-50 @else border-gray-300 @enderror px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                                    @error('name')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Email Karyawan --}}
                                <div class="md:col-span-2">
                                    <label for="email"
                                           class="block text-sm font-medium text-gray-700 mb-1">
                                        Email Karyawan
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="email" id="email" name="email"
                                           value="{{ old('email') }}"
                                           placeholder="bambang.pamungkas@example.com"
                                           class="w-full rounded-lg border @error('email') border-red-400 bg-red-50 @else border-gray-300 @enderror px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                                    @error('email')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Role Karyawan --}}
                                @can('kantor')
                                <div>
                                    <label for="role"
                                           class="block text-sm font-medium text-gray-700 mb-1">
                                        Role Karyawan
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <select id="role" name="role"
                                            class="w-full rounded-lg border @error('role') border-red-400 bg-red-50 @else border-gray-300 @enderror px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition bg-white appearance-none cursor-pointer"
                                            style="background-image: url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E\"); background-repeat: no-repeat; background-position: right 0.75rem center; background-size: 1rem;">
                                        <option value="kantor" {{ old('role') === 'kantor' ? 'selected' : '' }}>
                                            👨‍⚖️ Karyawan Kantor
                                        </option>
                                        <option value="konstruktor" {{ old('role') === 'konstruktor' ? 'selected' : '' }}>
                                            🕒 Client Konstruktor
                                        </option>
                                        <option value="lapangan" {{ old('role') === 'lapangan' ? 'selected' : '' }}>
                                            🏗 Karyawan Lapangan
                                        </option>
                                    </select>
                                    @error('role')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                @endcan

                                {{-- Password Karyawan --}}
                                <div class="md:col-span-2">
                                    <label for="password"
                                           class="block text-sm font-medium text-gray-700 mb-1">
                                        Password
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="password" id="password" name="password"
                                           class="w-full rounded-lg border @error('password') border-red-400 bg-red-50 @else border-gray-300 @enderror px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                                    @error('password')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </section>
                        {{-- Actions --}}
                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                            <x-button-link href="{{ route('user-manage.index') }}" color="red">
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