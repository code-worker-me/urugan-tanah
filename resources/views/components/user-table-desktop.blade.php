@props(['users'])

<div class="hidden md:block overflow-x-auto rounded-2xl border border-blue-100/80 shadow-sm">
    <table class="w-full text-left text-sm">
        <thead class="bg-gradient-to-r from-blue-950 via-blue-900 to-indigo-900 text-white">
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
        <tbody class="bg-white divide-y divide-slate-100">
            @forelse ($users as $index => $user)
                <tr class="hover:bg-blue-50/50 transition-colors duration-150 group">
                    <td class="px-4 py-3.5 text-xs font-bold text-slate-400">
                        <span class="w-6 h-6 rounded-lg bg-blue-50 text-blue-800 flex items-center justify-center font-bold">
                            {{ $index + 1 }}
                        </span>
                    </td>
                    <td class="px-4 py-3.5 font-bold text-blue-950 group-hover:text-red-600 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-blue-700 to-blue-600 text-white font-bold flex items-center justify-center text-xs shadow-xs shrink-0">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <span>{{ $user->name }}</span>
                        </div>
                    </td>
                    <td class="px-4 py-3.5 text-slate-600 font-medium">{{ $user->email }}</td>
                    <td class="px-4 py-3.5">
                        @if($user->role === 'kantor')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold bg-blue-100 text-blue-800 border border-blue-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span>
                                Kantor
                            </span>
                        @elseif($user->role === 'konstruktor')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold bg-red-100 text-red-800 border border-red-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-600"></span>
                                Konstruktor
                            </span>
                        @elseif($user->role === 'lapangan')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                                Lapangan
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold bg-slate-100 text-slate-800 border border-slate-200">
                                {{ ucfirst($user->role) }}
                            </span>
                        @endif
                    </td>
                    @can('kantor')
                        <td class="px-4 py-3.5 text-center">
                            <form action="{{ route('user-manage.delete', $user) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus karyawan {{ $user->name }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-3 py-1 rounded-xl bg-red-50 text-red-600 hover:bg-red-600 hover:text-white font-bold text-xs transition-all duration-150">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    @endcan
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-12 text-center text-slate-400 italic">
                        <div class="flex flex-col items-center gap-2">
                            <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            <span>Belum ada data karyawan. Silakan tambahkan karyawan terlebih dahulu.</span>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
