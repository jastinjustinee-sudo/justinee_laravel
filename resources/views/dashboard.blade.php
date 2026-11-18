@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<section class="mb-8 flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
    <div class="fade-up">
        <p class="text-xs font-extrabold uppercase tracking-[.16em] text-blue-600">{{ now()->translatedFormat('l, d F Y') }}</p>
        <h1 class="mt-2 text-2xl font-extrabold tracking-tight text-ink sm:text-3xl">Selamat datang, {{ explode(' ', auth()->user()->name)[0] }}.</h1>
        <p class="mt-2 text-sm leading-6 text-slate-500">Ringkasan aktivitas packing untuk membantu operasional tetap terkendali.</p>
    </div>
    <a href="{{ route('packing.create') }}" class="fade-up inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-blue-700">
        <span class="text-lg leading-none">+</span> Input packing baru
    </a>
</section>

<section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
    <article class="fade-up rounded-2xl border border-slate-100 bg-white p-5 shadow-card">
        <div class="flex items-start justify-between gap-4">
            <div><p class="text-xs font-bold uppercase tracking-wider text-slate-400">Packing hari ini</p><strong class="mt-3 block text-3xl font-extrabold tracking-tight text-ink">{{ number_format($todayPacking) }}</strong><p class="mt-1.5 text-xs text-slate-500">item tercatat hari ini</p></div>
            <span class="grid h-10 w-10 place-items-center rounded-xl bg-blue-50 text-blue-600"><svg aria-hidden="true" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8 4-8-4m16 0l-8-4-8 4m16 0v10l-8 4-8-4V7"/></svg></span>
        </div>
    </article>
    <article class="fade-up rounded-2xl border border-slate-100 bg-white p-5 shadow-card">
        <div class="flex items-start justify-between gap-4">
            <div><p class="text-xs font-bold uppercase tracking-wider text-slate-400">Total packing</p><strong class="mt-3 block text-3xl font-extrabold tracking-tight text-ink">{{ number_format($totalPacking) }}</strong><p class="mt-1.5 text-xs text-emerald-600">akumulasi seluruh data</p></div>
            <span class="grid h-10 w-10 place-items-center rounded-xl bg-emerald-50 text-emerald-600"><svg aria-hidden="true" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l5-5 4 4 7-8"/><path stroke-linecap="round" stroke-linejoin="round" d="M14 7h6v6"/></svg></span>
        </div>
    </article>
    <article class="fade-up rounded-2xl border border-slate-100 bg-white p-5 shadow-card">
        <div class="flex items-start justify-between gap-4">
            <div><p class="text-xs font-bold uppercase tracking-wider text-slate-400">Bulan ini</p><strong class="mt-3 block text-3xl font-extrabold tracking-tight text-ink">{{ number_format($monthPacking) }}</strong><p class="mt-1.5 text-xs text-slate-500">hasil bulan berjalan</p></div>
            <span class="grid h-10 w-10 place-items-center rounded-xl bg-violet-50 text-violet-600"><svg aria-hidden="true" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3v18h18"/><path stroke-linecap="round" stroke-linejoin="round" d="M7 16V9m5 7V5m5 11v-4"/></svg></span>
        </div>
    </article>
    <article class="fade-up rounded-2xl border border-slate-100 bg-white p-5 shadow-card">
        <div class="flex items-start justify-between gap-4">
            <div><p class="text-xs font-bold uppercase tracking-wider text-slate-400">{{ auth()->user()->role === 'admin' ? 'Operator aktif' : 'Total laporan' }}</p><strong class="mt-3 block text-3xl font-extrabold tracking-tight text-ink">{{ number_format(auth()->user()->role === 'admin' ? $totalUsers : $totalReports) }}</strong><p class="mt-1.5 text-xs text-slate-500">{{ auth()->user()->role === 'admin' ? number_format($totalProducts) . ' jenis produk tersedia' : 'riwayat Anda' }}</p></div>
            <span class="grid h-10 w-10 place-items-center rounded-xl bg-amber-50 text-amber-600"><svg aria-hidden="true" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m18 0v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75M12 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg></span>
        </div>
    </article>
</section>

<section class="fade-up mt-6 rounded-2xl border border-slate-100 bg-white p-5 shadow-card sm:p-6">
    <div class="mb-6 flex items-start justify-between gap-4">
        <div><h2 class="text-base font-extrabold text-ink">Tren hasil packing</h2><p class="mt-1.5 text-sm leading-6 text-slate-500">Jumlah item yang tercatat dalam 7 hari terakhir.</p></div>
        <span class="shrink-0 rounded-lg bg-blue-50 px-3 py-1.5 text-xs font-extrabold tracking-wide text-blue-600">7 HARI</span>
    </div>
    <div class="h-72"><canvas id="packingChart"></canvas></div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const chartData = @json($chartData);
    const chartColors = () => document.documentElement.classList.contains('dark')
        ? { grid: '#374151', text: '#94a3b8', point: '#1f2937', tooltip: '#0f172a' }
        : { grid: '#eef2f7', text: '#94a3b8', point: '#ffffff', tooltip: '#162033' };
    const chartTheme = chartColors();
    const packingChart = new Chart(document.getElementById('packingChart'), {
        type: 'line',
        data: {
            labels: chartData.map(item => new Date(item.date + 'T00:00:00').toLocaleDateString('id-ID', { day: 'numeric', month: 'short' })),
            datasets: [{ label: 'Item dipacking', data: chartData.map(item => item.total), borderColor: '#2563eb', backgroundColor: 'rgba(37, 99, 235, .10)', fill: true, tension: .42, pointBackgroundColor: chartTheme.point, pointBorderColor: '#2563eb', pointBorderWidth: 3, pointRadius: 4 }]
        },
        options: { maintainAspectRatio: false, plugins: { legend: { display: false }, tooltip: { backgroundColor: chartTheme.tooltip, padding: 12, displayColors: false } }, scales: { x: { grid: { display: false }, ticks: { color: chartTheme.text, font: { size: 11 } } }, y: { beginAtZero: true, border: { display: false }, grid: { color: chartTheme.grid }, ticks: { color: chartTheme.text, precision: 0 } } } }
    });

    window.addEventListener('themechange', event => {
        const colors = event.detail.isDark ? { grid: '#374151', text: '#94a3b8', point: '#1f2937', tooltip: '#0f172a' } : { grid: '#eef2f7', text: '#94a3b8', point: '#ffffff', tooltip: '#162033' };
        packingChart.data.datasets[0].pointBackgroundColor = colors.point;
        packingChart.options.plugins.tooltip.backgroundColor = colors.tooltip;
        packingChart.options.scales.x.ticks.color = colors.text;
        packingChart.options.scales.y.ticks.color = colors.text;
        packingChart.options.scales.y.grid.color = colors.grid;
        packingChart.update();
    });
</script>
@endpush
