<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Urugan Tanah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Header + Tombol Tambah --}}
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-700">Daftar Proyek Urugan Tanah</h3>
                        <a href="{{ route('urugan.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                            Tambah Proyek
                        </a>
                    </div>

                    {{-- Table --}}
                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">#</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Nama Perusahaan</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Alamat Perusahaan</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Nama Konstruktor</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Status</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Tanggal Mulai</th>
                                    <th class="px-4 py-3 text-center font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">

                                {{-- Loop data dari controller --}}
                                @forelse ($projects as $index => $project)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 text-gray-500">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3 font-medium text-gray-800 transition hover:text-blue-500"><a href="{{ route('urugan.view', $project) }}">{{ $project->nama_pt }}</a></td>
                                    <td class="px-4 py-3 text-gray-600 max-w-xs truncate" title="{{ $project->alamat_pt }}">{{ $project->alamat_pt }}</td>
                                    <td class="px-4 py-3 text-gray-700">{{ $project->nama_konstruktor }}</td>
                                    <td class="px-4 py-3">
                                        @if ($project->status === 'accepted')
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                                Accepted
                                            </span>
                                        @elseif ($project->status === 'decline')
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                                Decline
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">
                                                <span class="w-1.5 h-1.5 rounded-full bg-yellow-400"></span>
                                                Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-gray-600 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($project->tanggal_mulai)->format('d-m-Y') }}
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="inline-flex items-center gap-2">
                                            <a href="{{ route('urugan.edit', $project) }}" class="text-indigo-600 hover:text-indigo-800 font-medium transition">Edit</a>
                                            <span class="text-gray-300">|</span>
                                            <form action="{{ route('urugan.delete', $project) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 font-medium transition">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
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
                    </div>

                    {{-- Pagination --}}
                    @if ($projects->hasPages())
                    <div class="mt-4">
                        {{ $projects->links() }}
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
