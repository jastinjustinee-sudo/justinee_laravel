@extends('layouts.app')

@section('title', 'Tentang Aplikasi')

@section('content')
<div class="mx-auto max-w-4xl">
    <section class="fade-up rounded-2xl border border-slate-100 bg-white p-6 shadow-card sm:p-9">
        <p class="text-xs font-extrabold uppercase tracking-[.16em] text-blue-600">Tentang aplikasi</p>
        <h1 class="mt-3 max-w-2xl text-3xl font-extrabold tracking-tight text-ink sm:text-4xl">Daily Packing Report</h1>
        <p class="mt-4 max-w-2xl text-sm leading-7 text-slate-500">Sistem pencatatan hasil packing harian untuk PT Adi Tekhnik Mandiri. Aplikasi ini membantu tim operasional menyimpan data secara rapi, mudah ditinjau, dan siap digunakan untuk pelaporan.</p>
    </section>

    <section class="mt-5 grid gap-4 md:grid-cols-3">
        <article class="fade-up rounded-2xl border border-slate-100 bg-white p-5 shadow-card"><span class="grid h-10 w-10 place-items-center rounded-xl bg-blue-50 text-blue-600"><svg aria-hidden="true" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg></span><h2 class="mt-4 font-extrabold text-ink">Catat lebih cepat</h2><p class="mt-2 text-sm leading-6 text-slate-500">Input hasil packing secara langsung tanpa pencatatan manual berulang.</p></article>
        <article class="fade-up rounded-2xl border border-slate-100 bg-white p-5 shadow-card"><span class="grid h-10 w-10 place-items-center rounded-xl bg-emerald-50 text-emerald-600"><svg aria-hidden="true" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></span><h2 class="mt-4 font-extrabold text-ink">Data lebih rapi</h2><p class="mt-2 text-sm leading-6 text-slate-500">Data produk, operator, dan riwayat packing tersimpan dalam satu sistem.</p></article>
        <article class="fade-up rounded-2xl border border-slate-100 bg-white p-5 shadow-card"><span class="grid h-10 w-10 place-items-center rounded-xl bg-violet-50 text-violet-600"><svg aria-hidden="true" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3v18h18M7 15l4-4 3 3 5-6"/></svg></span><h2 class="mt-4 font-extrabold text-ink">Laporan siap pakai</h2><p class="mt-2 text-sm leading-6 text-slate-500">Tinjau tren dan ekspor laporan Excel atau PDF saat dibutuhkan.</p></article>
    </section>

    <section class="fade-up mt-5 rounded-2xl border border-slate-100 bg-white p-6 shadow-card sm:p-7">
        <h2 class="text-lg font-extrabold text-ink">Fitur utama</h2>
        <div class="mt-5 grid gap-3 sm:grid-cols-2">
            <div class="rounded-xl bg-slate-50 p-4"><strong class="text-sm text-slate-700">Laporan packing harian</strong><p class="mt-1 text-xs leading-5 text-slate-500">Pencatatan tanggal, produk, jumlah, dan catatan operasional.</p></div>
            <div class="rounded-xl bg-slate-50 p-4"><strong class="text-sm text-slate-700">Manajemen produk</strong><p class="mt-1 text-xs leading-5 text-slate-500">Master produk yang dapat dipakai kembali dalam proses input.</p></div>
            <div class="rounded-xl bg-slate-50 p-4"><strong class="text-sm text-slate-700">Hak akses pengguna</strong><p class="mt-1 text-xs leading-5 text-slate-500">Akses operator dan administrator disesuaikan dengan kebutuhan.</p></div>
            <div class="rounded-xl bg-slate-50 p-4"><strong class="text-sm text-slate-700">Ekspor data</strong><p class="mt-1 text-xs leading-5 text-slate-500">Data dapat diunduh untuk pelaporan dan tindak lanjut.</p></div>
        </div>
    </section>
</div>
@endsection
