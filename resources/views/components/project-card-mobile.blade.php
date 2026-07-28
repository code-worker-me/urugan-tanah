@props(['projects'])

<div class="grid grid-cols-1 gap-4 md:hidden">
    @forelse ($projects as $index => $project)
        <div class="bg-white border-l-4 border-l-blue-600 hover:border-l-red-600 border-r border-t border-b border-blue-100 rounded-2xl p-5 shadow-sm hover:shadow-md transition-all duration-200 space-y-3 group">
            <div class="flex justify-between items-start gap-2">
                <div class="flex items-center gap-2">
                    <span class="text-xs font-extrabold text-blue-900 bg-blue-50 px-2.5 py-1 rounded-lg">#{{ $index + 1 }}</span>
                    <h3 class="font-bold text-blue-950 group-hover:text-red-600 transition-colors">
                        <a href="{{ route('urugan.view', $project) }}">{{ $project->nama_pt }}</a>
                    </h3>
                </div>
                <div>
                    @if ($project->status === 'accepted')
                        <x-status-badge color="green">Accepted</x-status-badge>
                    @elseif ($project->status === 'decline')
                        <x-status-badge size="small" padd="small" color="red">Decline</x-status-badge>
                    @else
                        <x-status-badge>Pending</x-status-badge>
                    @endif
                </div>
            </div>

            <div class="text-sm text-slate-600 space-y-1.5 pt-1">
                <p class="flex items-start gap-1"><span class="font-semibold text-slate-400 w-24 shrink-0">Alamat:</span> <span class="text-slate-800 font-medium">{{ $project->alamat_pt }}</span></p>
                <p class="flex items-center gap-1"><span class="font-semibold text-slate-400 w-24 shrink-0">Konstruktor:</span> <span class="text-slate-800 font-medium">{{ $project->nama_konstruktor }}</span></p>
                <p class="flex items-center gap-1"><span class="font-semibold text-slate-400 w-24 shrink-0">Tanggal Mulai:</span> <span class="text-slate-800 font-medium">{{ \Carbon\Carbon::parse($project->tanggal_mulai)->format('d-m-Y') }}</span></p>
            </div>

            @canany(['kantor', 'konstruktor'])
                <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2 text-sm font-semibold">
                    @if($project->status === 'decline')
                        <a href="{{ route('urugan.edit', $project) }}" class="px-3 py-1 rounded-xl bg-blue-50 text-blue-700 hover:bg-blue-600 hover:text-white text-xs font-bold transition-all">
                            Edit
                        </a>
                    @endif
                    <a href="{{ route('urugan.view', $project) }}" class="px-3 py-1 rounded-xl bg-slate-100 text-slate-700 hover:bg-slate-800 hover:text-white text-xs font-bold transition-all">
                        Detail
                    </a>
                    @can('kantor')
                        <form action="{{ route('urugan.delete', $project) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 rounded-xl bg-red-50 text-red-600 hover:bg-red-600 hover:text-white text-xs font-bold transition-all">
                                Hapus
                            </button>
                        </form>
                    @endcan
                </div>
            @endcanany
        </div>
    @empty
        <div class="p-8 text-center text-slate-400 italic bg-white rounded-2xl border border-dashed border-blue-200 space-y-2">
            <svg class="w-10 h-10 mx-auto text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
            </svg>
            <p>Belum ada data proyek urugan tanah.</p>
        </div>
    @endforelse
</div>
