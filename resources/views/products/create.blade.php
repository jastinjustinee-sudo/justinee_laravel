@extends('layouts.app')
@section('title', 'Tambah Produk')
@section('content')
<div class="mx-auto max-w-2xl"><div class="mb-6 fade-up"><a href="{{ route('products.index') }}" class="text-sm font-semibold text-blue-600">← Kembali ke produk</a><h1 class="mt-3 text-2xl font-bold text-ink">Tambah produk baru</h1><p class="mt-1 text-sm text-slate-500">Simpan produk agar dapat digunakan pada pencatatan packing.</p></div><section class="fade-up rounded-2xl border border-slate-100 bg-white p-5 shadow-card sm:p-7"><form action="{{ route('products.store') }}" method="POST" class="space-y-5">@csrf @include('products.form', ['button' => 'Simpan produk'])</form></section></div>
@endsection
