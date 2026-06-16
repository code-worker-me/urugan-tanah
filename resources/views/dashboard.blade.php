<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Urugan Tanah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 w-full sm:p-8 bg-white shadow sm:rounded-lg">
                <section class="w-full">
                    {{-- Header + Tombol Tambah --}}
                    <header class="flex justify-between items-center mb-6">
                        <h2 class="text-lg font-medium text-gray-900">Daftar Proyek Urugan Tanah</h2>
                        @can('konstruktor')
                            <x-button-link href="{{ route('urugan.create') }}">Tambah Proyek</x-button-link>
                        @endcan
                    </header>

                    {{-- Table --}}
                    <table class="w-full border border-gray-200 divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <x-th-table>#</x-th-table>
                                <x-th-table>Nama Perusahaan</x-th-table>
                                <x-th-table>Alamat Perusahaan</x-th-table>
                                <x-th-table>Nama Konstruktor</x-th-table>
                                <x-th-table>Status</x-th-table>
                                <x-th-table>Tanggal Mulai</x-th-table>
                                @canany(['kantor', 'konstruktor'])
                                    <x-th-table text="center">Aksi</x-th-table>
                                @endcanany
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">

                            {{-- Loop data dari controller --}}
                            @forelse ($projects as $index => $project)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 text-gray-500">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3 font-medium text-gray-800 transition hover:text-blue-500"><a
                                            href="{{ route('urugan.view', $project) }}">{{ $project->nama_pt }}</a></td>
                                    <td class="px-4 py-3 text-gray-600 max-w-xs truncate" title="{{ $project->alamat_pt }}">
                                        {{ $project->alamat_pt }}</td>
                                    <td class="px-4 py-3 text-gray-700">{{ $project->nama_konstruktor }}</td>
                                    <td class="px-4 py-3">
                                        @if ($project->status === 'accepted')
                                            <x-status-badge color="green">Accepted</x-status-badge>
                                        @elseif ($project->status === 'decline')
                                            <x-status-badge size="small" padd="small" color="red">Decline</x-status-badge>
                                        @else
                                            <x-status-badge>Pending</x-status-badge>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-gray-600 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($project->tanggal_mulai)->format('d-m-Y') }}
                                    </td>
                                    @canany(['kantor', 'konstruktor'])
                                        <td class="px-4 py-3 text-center">
                                            <div class="inline-flex items-center gap-2">
                                                @if($project->status === 'decline')
                                                    <a href="{{ route('urugan.edit', $project) }}"
                                                        class="text-indigo-600 hover:text-indigo-800 font-medium transition">
                                                        Edit
                                                    </a>
                                                @endif
                                                <a href="{{ route('urugan.view', $project) }}"
                                                    class="text-gray-600 hover:text-gray-800 hover:underline font-medium transition">
                                                    View
                                                </a>
                                                @can('kantor')
                                                    <form action="{{ route('urugan.delete', $project) }}" method="POST"
                                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-red-500 hover:text-red-700 font-medium transition">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                @endcan
                                            </div>
                                            <!--<x-button-action editUrl="{{ route('urugan.edit', $project) }}" deleteUrl="{{ route('urugan.delete', $project) }}" />-->
                                        </td>
                                    @endcanany
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-8 text-center text-gray-400 italic">
                                        Belum ada data proyek urugan tanah.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>

                    {{-- Pagination --}}
                    @if ($projects->hasPages())
                        <div class="mt-4">
                            {{ $projects->links() }}
                        </div>
                    @endif
                </section>
            </div>
        </div>
    </div>
</x-app-layout>