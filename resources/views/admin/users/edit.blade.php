@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')
@php
    $hasProfilePhoto = $user->profile_photo
        && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->profile_photo);
@endphp
<div class="mx-auto max-w-2xl">
    <div class="mb-6 fade-up">
        <a href="{{ route('users.index') }}" class="text-sm font-semibold text-blue-600">← Kembali ke pengguna</a>
        <h1 class="mt-3 text-2xl font-bold text-ink">Edit pengguna</h1>
        <p class="mt-1 text-sm text-slate-500">Kelola identitas, peran, foto profil, dan kata sandi pengguna.</p>
    </div>

    <section class="fade-up rounded-2xl border border-slate-100 bg-white p-5 shadow-card sm:p-7">
        <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="profile_photo" class="mb-1.5 block text-sm font-bold text-slate-700">Foto profil</label>
                <div class="flex items-center gap-4 rounded-xl border border-dashed border-slate-300 bg-slate-50 p-4">
                    <img id="profilePreview" src="{{ $hasProfilePhoto ? \Illuminate\Support\Facades\Storage::url($user->profile_photo) : '' }}" alt="Preview foto profil" class="{{ $hasProfilePhoto ? '' : 'hidden' }} h-16 w-16 rounded-full object-cover">
                    <span id="profileInitial" class="{{ $hasProfilePhoto ? 'hidden' : '' }} grid h-16 w-16 place-items-center rounded-full bg-blue-100 text-xl font-bold text-blue-700">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-semibold text-slate-600">JPG, PNG, atau WebP, maksimal 2 MB</p>
                        <label for="profile_photo" class="mt-2 inline-flex cursor-pointer rounded-lg bg-white px-3 py-2 text-sm font-bold text-blue-600 shadow-sm ring-1 ring-slate-200 hover:bg-blue-50">Ganti foto</label>
                        <input id="profile_photo" type="file" name="profile_photo" accept="image/jpeg,image/png,image/webp" class="sr-only">
                    </div>
                </div>
                @error('profile_photo')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="name" class="mb-1.5 block text-sm font-bold text-slate-700">Nama lengkap</label>
                <input id="name" name="name" value="{{ old('name', $user->name) }}" required class="w-full rounded-lg border-slate-200 text-sm focus:border-blue-500 focus:ring-blue-500">
                @error('name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="email" class="mb-1.5 block text-sm font-bold text-slate-700">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full rounded-lg border-slate-200 text-sm focus:border-blue-500 focus:ring-blue-500">
                @error('email')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="role" class="mb-1.5 block text-sm font-bold text-slate-700">Hak akses</label>
                <select id="role" name="role" required class="w-full rounded-lg border-slate-200 text-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="user" @selected(old('role', $user->role) === 'user')>User / Operator</option>
                    <option value="admin" @selected(old('role', $user->role) === 'admin')>Administrator</option>
                </select>
                @error('role')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="border-t border-slate-100 pt-5">
                <label for="password" class="mb-1.5 block text-sm font-bold text-slate-700">Password baru <span class="font-normal text-slate-400">(opsional)</span></label>
                <input id="password" type="password" name="password" placeholder="Biarkan kosong jika tidak diubah" class="w-full rounded-lg border-slate-200 text-sm focus:border-blue-500 focus:ring-blue-500">
                <p class="mt-1.5 text-xs text-slate-400">Minimal 8 karakter. Konfirmasi password tidak diperlukan saat perubahan oleh admin.</p>
                @error('password')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="flex justify-end gap-3 border-t border-slate-100 pt-5">
                <a href="{{ route('users.index') }}" class="rounded-lg px-4 py-2.5 text-sm font-bold text-slate-500 hover:bg-slate-100">Batal</a>
                <button type="submit" class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-blue-700">Simpan perubahan</button>
            </div>
        </form>
    </section>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('profile_photo')?.addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;

    document.getElementById('profilePreview').src = URL.createObjectURL(file);
    document.getElementById('profilePreview').classList.remove('hidden');
    document.getElementById('profileInitial').classList.add('hidden');
});
</script>
@endpush
