@extends('layouts.app')

@section('title', 'Pengguna')

@section('content')
<div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
    <div class="fade-up">
        <p class="text-sm font-semibold text-blue-600">ADMINISTRASI</p>
        <h1 class="mt-1 text-2xl font-bold text-ink">Kelola pengguna</h1>
        <p class="mt-1 text-sm text-slate-500">Atur akun administrator dan operator packing.</p>
    </div>
    <a href="{{ route('users.create') }}" class="fade-up inline-flex justify-center rounded-xl bg-blue-600 px-4 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-blue-700">+ Tambah pengguna</a>
</div>

<section class="fade-up overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-card">
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500">
                <tr>
                    <th class="px-5 py-3">Pengguna</th>
                    <th class="px-5 py-3">Email</th>
                    <th class="px-5 py-3">Hak akses</th>
                    <th class="px-5 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($users as $user)
                    <tr class="transition hover:bg-slate-50/70">
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                @if($user->profile_photo && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->profile_photo))
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($user->profile_photo) }}" alt="Foto profil {{ $user->name }}" class="h-9 w-9 rounded-full object-cover">
                                @else
                                    <span class="grid h-9 w-9 place-items-center rounded-full bg-blue-100 text-xs font-bold text-blue-700">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                @endif
                                <strong class="text-slate-700">{{ $user->name }}</strong>
                            </div>
                        </td>
                        <td class="px-5 py-4 text-slate-500">{{ $user->email }}</td>
                        <td class="px-5 py-4">
                            <span class="rounded-full px-2.5 py-1 text-[11px] font-bold uppercase tracking-wide {{ $user->role === 'admin' ? 'bg-violet-50 text-violet-700' : 'bg-blue-50 text-blue-700' }}">{{ $user->role === 'admin' ? 'Administrator' : 'Operator' }}</span>
                        </td>
                        <td class="whitespace-nowrap px-5 py-4 text-right">
                            <a href="{{ route('users.edit', $user) }}" class="mr-3 text-xs font-bold text-blue-600">Edit</a>
                            @if(auth()->id() !== $user->id)
                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Hapus akun {{ addslashes($user->name) }}?')" class="text-xs font-bold text-red-500">Hapus</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-5 py-14 text-center text-slate-400">Belum ada pengguna.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($users->hasPages())
        <div class="border-t border-slate-100 px-5 py-4">{{ $users->links() }}</div>
    @endif
</section>
@endsection
