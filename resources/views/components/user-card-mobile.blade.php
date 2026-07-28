@props(['users'])

<div class="grid grid-cols-1 gap-4 md:hidden">
    @forelse ($users as $index => $user)
        <div class="bg-white border-l-4 border-l-blue-600 hover:border-l-red-600 border-r border-t border-b border-blue-100 rounded-2xl p-5 shadow-sm hover:shadow-md transition-all duration-200 space-y-3 group">
            <div class="flex justify-between items-start gap-2">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-blue-700 to-blue-600 text-white font-bold flex items-center justify-center text-xs shadow-xs shrink-0">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <span class="text-[10px] font-extrabold text-blue-900 bg-blue-50 px-2 py-0.5 rounded">#{{ $index + 1 }}</span>
                        <h3 class="font-bold text-blue-950 group-hover:text-red-600 transition-colors">
                            {{ $user->name }}
                        </h3>
                    </div>
                </div>
                <div>
                    @if($user->role === 'kantor')
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-extrabold bg-blue-100 text-blue-800 border border-blue-200">
                            Kantor
                        </span>
                    @elseif($user->role === 'konstruktor')
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-extrabold bg-red-100 text-red-800 border border-red-200">
                            Konstruktor
                        </span>
                    @elseif($user->role === 'lapangan')
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-extrabold bg-emerald-100 text-emerald-800 border border-emerald-200">
                            Lapangan
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-extrabold bg-slate-100 text-slate-800 border border-slate-200">
                            {{ ucfirst($user->role) }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="text-sm text-slate-600 space-y-1 pt-1">
                <p class="flex items-center gap-1"><span class="font-semibold text-slate-400 w-16 shrink-0">Email:</span> <span class="text-slate-800 font-medium">{{ $user->email }}</span></p>
            </div>

            @can('kantor')
                <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-3 text-sm font-semibold">
                    <form action="{{ route('user-manage.delete', $user) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus karyawan {{ $user->name }}?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-1 rounded-xl bg-red-50 text-red-600 hover:bg-red-600 hover:text-white text-xs font-bold transition-all">
                            Hapus Karyawan
                        </button>
                    </form>
                </div>
            @endcan
        </div>
    @empty
        <div class="p-8 text-center text-slate-400 italic bg-white rounded-2xl border border-dashed border-blue-200 space-y-2">
            <svg class="w-10 h-10 mx-auto text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
            <p>Belum ada data karyawan. Silakan tambahkan karyawan terlebih dahulu.</p>
        </div>
    @endforelse
</div>
