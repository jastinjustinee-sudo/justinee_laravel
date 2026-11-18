@extends('layouts.app')

@section('title', 'Tambah Pengguna')

@section('content')
<div class="mx-auto max-w-2xl">
    <div class="mb-7 fade-up">
        <a href="{{ route('users.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-blue-600 transition hover:text-blue-800">← Kembali ke pengguna</a>
        <p class="mt-5 text-xs font-extrabold uppercase tracking-[.16em] text-blue-600">Administrasi</p>
        <h1 class="mt-2 text-2xl font-extrabold tracking-tight text-ink sm:text-3xl">Tambah pengguna baru</h1>
        <p class="mt-2 text-sm leading-6 text-slate-500">Buat akun operator atau administrator untuk mengakses aplikasi.</p>
    </div>

    <section class="fade-up rounded-2xl border border-slate-100 bg-white p-5 shadow-card sm:p-7">
        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label for="profile_photo" class="mb-1.5 block text-sm font-bold text-slate-700">Foto profil</label>
                <div class="flex items-center gap-4 rounded-xl border border-dashed border-slate-300 bg-slate-50 p-4">
                    <img id="profilePreview" src="" alt="Preview foto profil" class="hidden h-16 w-16 rounded-full object-cover">
                    <span id="profileInitial" class="grid h-16 w-16 place-items-center rounded-full bg-blue-100 text-xl font-bold text-blue-700">{{ strtoupper(substr(old('name', 'U'), 0, 1)) }}</span>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-semibold text-slate-600">JPG, PNG, atau WebP, maksimal 2 MB</p>
                        <label for="profile_photo" class="mt-2 inline-flex cursor-pointer rounded-lg bg-white px-3 py-2 text-sm font-bold text-blue-600 shadow-sm ring-1 ring-slate-200 hover:bg-blue-50">Pilih foto</label>
                        <input id="profile_photo" type="file" name="profile_photo" accept="image/jpeg,image/png,image/webp" class="sr-only">
                    </div>
                </div>
                @error('profile_photo')<p class="mt-1.5 text-xs font-medium text-red-500">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="name" class="mb-1.5 block text-sm font-bold text-slate-700">Nama lengkap</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Budi Santoso" required autocomplete="name" class="w-full rounded-xl px-3.5 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500">
                @error('name')<p class="mt-1.5 text-xs font-medium text-red-500">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="email" class="mb-1.5 block text-sm font-bold text-slate-700">Alamat email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="nama@perusahaan.com" required autocomplete="email" class="w-full rounded-xl px-3.5 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500">
                @error('email')<p class="mt-1.5 text-xs font-medium text-red-500">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="role" class="mb-1.5 block text-sm font-bold text-slate-700">Hak akses</label>
                <select id="role" name="role" required class="w-full rounded-xl px-3.5 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Pilih hak akses</option>
                    <option value="user" @selected(old('role') === 'user')>Operator packing</option>
                    <option value="admin" @selected(old('role') === 'admin')>Administrator</option>
                </select>
                <p class="mt-1.5 text-xs text-slate-400">Administrator dapat mengelola pengguna dan produk.</p>
                @error('role')<p class="mt-1.5 text-xs font-medium text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="grid gap-5 border-t border-slate-100 pt-5 sm:grid-cols-2">
                <div>
                    <label for="password" class="mb-1.5 block text-sm font-bold text-slate-700">Password</label>
                    <input id="password" type="password" name="password" placeholder="Minimal 8 karakter" required autocomplete="new-password" class="w-full rounded-xl px-3.5 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('password')<p class="mt-1.5 text-xs font-medium text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="password_confirmation" class="mb-1.5 block text-sm font-bold text-slate-700">Konfirmasi password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Ulangi password" required autocomplete="new-password" class="w-full rounded-xl px-3.5 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
            </div>

            <div class="flex flex-col-reverse justify-end gap-3 border-t border-slate-100 pt-5 sm:flex-row">
                <a href="{{ route('users.index') }}" class="rounded-xl px-4 py-2.5 text-center text-sm font-bold text-slate-500 transition hover:bg-slate-100">Batal</a>
                <button type="submit" class="rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-blue-700">Simpan pengguna</button>
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
