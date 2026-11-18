@extends('layouts.app')

@section('title', 'Panduan Penggunaan')

@section('content')
<div class="mx-auto max-w-3xl">
    <div class="fade-up mb-7">
        <p class="text-xs font-extrabold uppercase tracking-[.16em] text-blue-600">Panduan penggunaan</p>
        <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-ink">Mulai menggunakan aplikasi</h1>
        <p class="mt-2 text-sm leading-6 text-slate-500">Ikuti langkah singkat berikut untuk mencatat dan meninjau hasil packing.</p>
    </div>

    <section class="fade-up overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-card">
        <ol class="divide-y divide-slate-100">
            <li class="flex gap-4 p-5 sm:p-6"><span class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-blue-50 text-sm font-extrabold text-blue-600">1</span><div><h2 class="font-extrabold text-ink">Masuk ke menu Laporan</h2><p class="mt-1.5 text-sm leading-6 text-slate-500">Pilih menu Laporan pada navigasi utama untuk melihat riwayat data packing.</p></div></li>
            <li class="flex gap-4 p-5 sm:p-6"><span class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-blue-50 text-sm font-extrabold text-blue-600">2</span><div><h2 class="font-extrabold text-ink">Input hasil packing</h2><p class="mt-1.5 text-sm leading-6 text-slate-500">Klik tombol Input packing, kemudian isi tanggal, produk, jumlah item, dan catatan bila diperlukan.</p></div></li>
            <li class="flex gap-4 p-5 sm:p-6"><span class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-blue-50 text-sm font-extrabold text-blue-600">3</span><div><h2 class="font-extrabold text-ink">Tinjau dan filter data</h2><p class="mt-1.5 text-sm leading-6 text-slate-500">Gunakan filter tanggal atau produk untuk menemukan data yang ingin ditinjau.</p></div></li>
            <li class="flex gap-4 p-5 sm:p-6"><span class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-blue-50 text-sm font-extrabold text-blue-600">4</span><div><h2 class="font-extrabold text-ink">Ekspor laporan</h2><p class="mt-1.5 text-sm leading-6 text-slate-500">Gunakan tombol Cetak / PDF atau Export Excel untuk menyiapkan laporan.</p></div></li>
        </ol>
        <div class="border-t border-slate-100 p-5 sm:p-6"><a href="{{ route('packing.create') }}" class="inline-flex rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-blue-700">Mulai input packing</a></div>
    </section>
</div>
@endsection
