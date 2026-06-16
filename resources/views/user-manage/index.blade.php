<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Karyawan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 w-full sm:p-8 bg-white shadow sm:rounded-lg">
                <section class="w-full">
                    {{-- Header + Tombol Tambah --}}
                    <header class="flex justify-between items-center mb-6">
                        <h2 class="text-lg font-medium text-gray-900">Daftar Karyawan beserta rolenya.</h2>
                        @can('kantor')
                            <x-button-link href="{{ route('user-manage.create') }}">Tambah Karyawan</x-button-link>
                        @endcan
                    </header>

                    <table class="w-full border border-gray-200 divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <x-th-table>#</x-th-table>
                                <x-th-table>Nama Karyawan</x-th-table>
                                <x-th-table>Email Karyawan</x-th-table>
                                <x-th-table>Role Karyawan</x-th-table>
                                @can('kantor')
                                    <x-th-table text="center">Aksi</x-th-table>
                                @endcan
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse ($users as $index => $user)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 text-gray-500">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3 font-medium text-gray-800 transition hover:text-blue-500">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-600">{{ $user->email }}</td>
                                    <td class="px-4 py-3">
                                        <x-status-badge color="green">{{ $user->role }}</x-status-badge>
                                    </td>
                                    @can('kantor')
                                        <td class="px-4 py-3 text-center">
                                            <form action="{{ route('user-manage.delete', $user) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-500 hover:text-red-700 font-medium transition">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    @endcan
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-8 text-center text-gray-400 italic">
                                        Belum ada data karyawan. Silakan tambahkan karyawan terlebih dahulu.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    @if ($users->hasPages())
                        <div class="mt-4">
                            {{ $users->links() }}
                        </div>
                    @endif
                </section>
            </div>
        </div>
    </div>
</x-app-layout>