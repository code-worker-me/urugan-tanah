@props(['projects'])

<div class="hidden md:block overflow-x-auto rounded-2xl border border-blue-100/80 shadow-sm">
    <table class="w-full text-left text-sm">
        <thead class="bg-gradient-to-r from-blue-950 via-blue-900 to-indigo-900 text-white">
            <tr>
                <x-th-table>No</x-th-table>
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
        
        <tbody class="bg-white divide-y divide-slate-100">
            @forelse ($projects as $index => $project)
                <tr class="hover:bg-blue-50/50 transition-colors duration-150 group">
                    <td class="px-4 py-3.5 text-xs font-bold text-slate-400">
                        <span class="w-6 h-6 rounded-lg bg-blue-50 text-blue-800 flex items-center justify-center font-bold">
                            {{ $index + 1 }}
                        </span>
                    </td>
                    <td class="px-4 py-3.5 font-bold text-blue-900 group-hover:text-red-600 transition-colors">
                        <a href="{{ route('urugan.view', $project) }}" class="hover:underline">
                            {{ $project->nama_pt }}
                        </a>
                    </td>
                    <td class="px-4 py-3.5 text-slate-600 max-w-xs truncate" title="{{ $project->alamat_pt }}">
                        {{ $project->alamat_pt }}
                    </td>
                    <td class="px-4 py-3.5 text-slate-700 font-medium">{{ $project->nama_konstruktor }}</td>
                    <td class="px-4 py-3.5">
                        @if ($project->status === 'accepted')
                            <x-status-badge color="green">Accepted</x-status-badge>
                        @elseif ($project->status === 'decline')
                            <x-status-badge size="small" padd="small" color="red">Decline</x-status-badge>
                        @else
                            <x-status-badge>Pending</x-status-badge>
                        @endif
                    </td>
                    <td class="px-4 py-3.5 text-slate-600 whitespace-nowrap font-medium">
                        {{ \Carbon\Carbon::parse($project->tanggal_mulai)->format('d-m-Y') }}
                    </td>
                    @canany(['kantor', 'konstruktor'])
                        <td class="px-4 py-3.5 text-center">
                            <div class="inline-flex items-center justify-center gap-2">
                                @if($project->status === 'decline')
                                    <a href="{{ route('urugan.edit', $project) }}"
                                        class="px-3 py-1 rounded-xl bg-blue-50 text-blue-700 hover:bg-blue-600 hover:text-white font-bold text-xs transition-all duration-150">
                                        Edit
                                    </a>
                                @endif
                                <a href="{{ route('urugan.view', $project) }}"
                                    class="px-3 py-1 rounded-xl bg-slate-100 text-slate-700 hover:bg-slate-800 hover:text-white font-bold text-xs transition-all duration-150">
                                    Detail
                                </a>
                                @can('kantor')
                                    <form action="{{ route('urugan.delete', $project) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-3 py-1 rounded-xl bg-red-50 text-red-600 hover:bg-red-600 hover:text-white font-bold text-xs transition-all duration-150">
                                            Hapus
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    @endcanany
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-4 py-12 text-center text-slate-400 italic">
                        <div class="flex flex-col items-center gap-2">
                            <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                            <span>Belum ada data proyek urugan tanah.</span>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
