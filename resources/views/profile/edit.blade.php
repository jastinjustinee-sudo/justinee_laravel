@extends('layouts.app')

@section('title', 'Profil Akun')

@section('content')
@php
    $hasProfilePhoto = $user->profile_photo
        && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->profile_photo);
@endphp
<div class="mx-auto max-w-2xl">
    <div class="mb-6 fade-up">
        <p class="text-sm font-semibold text-blue-600">PENGATURAN AKUN</p>
        <h1 class="mt-1 text-2xl font-bold text-ink">Profil saya</h1>
        <p class="mt-1 text-sm text-slate-500">Perbarui informasi akun, foto profil, dan keamanan akses Anda.</p>
    </div>

    <section class="fade-up overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-card">
        <div class="flex items-center gap-4 bg-gradient-to-r from-blue-600 to-cyan-500 p-6 text-white">
            <div class="relative">
                <img id="profilePreview" src="{{ $hasProfilePhoto ? \Illuminate\Support\Facades\Storage::url($user->profile_photo) : '' }}" alt="Foto profil" class="{{ $hasProfilePhoto ? '' : 'hidden' }} h-16 w-16 rounded-2xl object-cover ring-2 ring-white/30">
                <span id="profileInitial" class="{{ $hasProfilePhoto ? 'hidden' : '' }} grid h-16 w-16 place-items-center rounded-2xl bg-white/20 text-2xl font-bold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
            </div>
            <div>
                <h2 class="font-bold">{{ $user->name }}</h2>
                <p class="text-sm text-blue-100">{{ $user->role === 'admin' ? 'Administrator Sistem' : 'Operator Packing' }}</p>
            </div>
        </div>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5 p-5 sm:p-7">
            @csrf
            @method('PUT')

            <div>
                <label class="mb-1.5 block text-sm font-bold text-slate-700">Foto profil</label>
                <div class="flex flex-col gap-3 rounded-xl border border-dashed border-slate-300 bg-slate-50 p-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm font-semibold text-slate-600">Pilih foto untuk akun Anda</p>
                        <p class="mt-1 text-xs text-slate-400">JPG, PNG, atau WebP · Maksimal 2 MB</p>
                    </div>
                    <label for="profile_photo" class="cursor-pointer rounded-lg bg-white px-4 py-2.5 text-sm font-bold text-blue-600 shadow-sm ring-1 ring-slate-200 transition hover:bg-blue-50">Pilih foto</label>
                    <input id="profile_photo" type="file" name="profile_photo" accept="image/jpeg,image/png,image/webp" class="hidden">
                </div>
                @error('profile_photo')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-bold text-slate-700">Nama lengkap</label>
                <input name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" class="w-full rounded-lg border-slate-200 text-sm focus:border-blue-500 focus:ring-blue-500">
                @error('name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-bold text-slate-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email" class="w-full rounded-lg border-slate-200 text-sm focus:border-blue-500 focus:ring-blue-500">
                @error('email')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="flex justify-end border-t border-slate-100 pt-5">
                <button class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-blue-700">Simpan profil</button>
            </div>
        </form>

        <form action="{{ route('profile.password.update') }}" method="POST" class="space-y-5 border-t border-slate-100 p-5 sm:p-7">
            @csrf
            @method('PUT')

            <div>
                <h3 class="font-bold text-ink">Ganti password</h3>
                <p class="mt-1 text-xs text-slate-400">Isi kedua kolom di bawah hanya bila ingin mengganti password.</p>
                <div class="mt-4 grid gap-5 sm:grid-cols-2">
                    <div>
                        <label class="mb-1.5 block text-sm font-bold text-slate-700">Password baru</label>
                        <input type="password" name="password" autocomplete="new-password" class="w-full rounded-lg border-slate-200 text-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-bold text-slate-700">Konfirmasi password</label>
                        <input type="password" name="password_confirmation" autocomplete="new-password" class="w-full rounded-lg border-slate-200 text-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                </div>
                @error('password', 'passwordUpdate')<p class="mt-2 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="flex justify-end border-t border-slate-100 pt-5">
                <button class="rounded-lg bg-slate-700 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-slate-800">Simpan password</button>
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

    const preview = document.getElementById('profilePreview');
    const initial = document.getElementById('profileInitial');
    preview.src = URL.createObjectURL(file);
    preview.classList.remove('hidden');
    initial.classList.add('hidden');
});
</script>
@endpush
