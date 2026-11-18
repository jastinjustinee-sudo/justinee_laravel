<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') · Daily Packing Report</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        (() => {
            try {
                const savedTheme = localStorage.getItem('theme');
                const isDark = savedTheme ? savedTheme === 'dark' : window.matchMedia('(prefers-color-scheme: dark)').matches;
                document.documentElement.classList.toggle('dark', isDark);
            } catch (error) {
                // Tetap gunakan tampilan terang bila penyimpanan browser tidak tersedia.
            }
        })();
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { darkMode: 'class', theme: { extend: { fontFamily: { sans: ['Plus Jakarta Sans', 'ui-sans-serif', 'system-ui', 'sans-serif'] }, colors: { ink: '#162033', brand: '#2563eb', mint: '#10b981' }, boxShadow: { card: '0 8px 24px rgba(15, 23, 42, .07)' } } } }
    </script>
    <style>
        html { color-scheme: light; }
        body.font-sans { min-height: 100vh; background: #f7f8fc; color: #475569; font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif; letter-spacing: -.01em; }
        .nav-link { transition: color .2s ease, background-color .2s ease; }
        .nav-link:hover, .nav-link.active { color: #1d4ed8; background: #eff6ff; }
        .fade-up { animation: fadeUp .5s ease-out both; }
        .fade-up:nth-child(2) { animation-delay: .07s } .fade-up:nth-child(3) { animation-delay: .14s } .fade-up:nth-child(4) { animation-delay: .21s }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(12px) } to { opacity: 1; transform: translateY(0) } }
        @media (prefers-reduced-motion: reduce) { *, *::before, *::after { animation-duration: .01ms !important; transition-duration: .01ms !important; } }

        html.dark { color-scheme: dark; }
        html.dark body { background: #111827; color: #cbd5e1; }
        html.dark .bg-white { background-color: #1f2937; }
        html.dark .bg-white\/95 { background-color: rgb(17 24 39 / .96); }
        html.dark .bg-slate-50, html.dark .bg-slate-50\/70 { background-color: #182233; }
        html.dark .bg-slate-100 { background-color: #263449; }
        html.dark .bg-blue-50 { background-color: #1d2b45; }
        html.dark .bg-blue-100 { background-color: #243a5e; }
        html.dark .bg-emerald-50 { background-color: #153c36; }
        html.dark .bg-emerald-100 { background-color: #1b4b43; }
        html.dark .bg-violet-50 { background-color: #31244a; }
        html.dark .bg-amber-50 { background-color: #47351c; }
        html.dark .text-ink { color: #f8fafc; }
        html.dark .text-slate-700 { color: #e2e8f0; }
        html.dark .text-slate-600 { color: #cbd5e1; }
        html.dark .text-slate-500, html.dark .text-slate-400 { color: #94a3b8; }
        html.dark .border-slate-100, html.dark .border-slate-200, html.dark .border-slate-300 { border-color: #374151; }
        html.dark .divide-slate-100 > :not([hidden]) ~ :not([hidden]) { border-color: #374151; }
        html.dark input, html.dark textarea, html.dark select { background-color: #182233; border-color: #475569; color: #e2e8f0; }
        html.dark select option { background-color: #182233; color: #e2e8f0; }
        html.dark .shadow-card, html.dark .shadow-lg, html.dark .shadow-xl, html.dark .shadow-2xl { box-shadow: 0 6px 18px rgba(0, 0, 0, .20) !important; }
        html.dark .shadow-blue-200, html.dark .shadow-indigo-900\/20 { --tw-shadow-color: rgb(2 6 23 / .35); }
        html.dark .nav-link:hover, html.dark .nav-link.active { color: #dbeafe; background: #263b5d; }

        .shadow-card { box-shadow: 0 8px 24px rgba(15, 23, 42, .06) !important; }
        input, textarea, select { min-height: 42px; border-color: #dbe2ea !important; transition: border-color .2s ease, box-shadow .2s ease, background-color .2s ease; }
        textarea { min-height: auto; }
        input:focus, textarea:focus, select:focus { border-color: #60a5fa !important; box-shadow: 0 0 0 3px rgb(59 130 246 / .10) !important; }
        button, a { -webkit-tap-highlight-color: transparent; }
        button:focus-visible, a:focus-visible { outline: 3px solid rgb(59 130 246 / .28); outline-offset: 2px; }
        .theme-toggle { position: relative; display: inline-flex; box-sizing: border-box; align-items: center; height: 2.5rem; width: 4.6rem; flex: 0 0 auto; padding: .2rem; overflow: hidden; border: 1px solid #cbd5e1; border-radius: 999px; background: linear-gradient(135deg, #dbeafe, #bfdbfe); box-shadow: inset 0 1px 1px rgb(255 255 255 / .8), 0 4px 12px rgb(37 99 235 / .12); transition: background .55s cubic-bezier(.22, 1, .36, 1), border-color .55s ease, box-shadow .55s ease; }
        .theme-toggle::before { position: absolute; inset: 0; content: ''; background: radial-gradient(circle at 78% 28%, rgb(255 255 255 / .78), transparent 29%); transition: opacity .45s ease; }
        .theme-toggle__thumb { position: relative; z-index: 1; display: grid; height: 2rem; width: 2rem; transform: translateX(2.2rem); place-items: center; border-radius: 999px; background: #fff; box-shadow: 0 2px 8px rgb(30 64 175 / .2), inset 0 1px 1px #fff; transition: transform .55s cubic-bezier(.22, 1, .36, 1), background .55s ease, box-shadow .55s ease; }
        .theme-toggle__icon { position: absolute; font-size: .9rem; line-height: 1; transition: opacity .28s ease, transform .5s cubic-bezier(.22, 1, .36, 1); }
        .theme-toggle__moon { opacity: 0; transform: scale(.45) rotate(-40deg); }
        .theme-toggle__light { opacity: 1; transform: scale(1) rotate(0); }
        .theme-toggle:hover { border-color: #93c5fd; box-shadow: inset 0 1px 1px rgb(255 255 255 / .9), 0 7px 16px rgb(37 99 235 / .2); }
        .theme-toggle:active .theme-toggle__thumb { transform: translateX(2.2rem) scale(.92); }
        .theme-toggle:focus-visible { outline: 3px solid rgb(59 130 246 / .32); outline-offset: 3px; }
        html.dark .theme-toggle { border-color: #475569; background: linear-gradient(135deg, #111827, #334155); box-shadow: inset 0 1px 1px rgb(255 255 255 / .08), 0 4px 14px rgb(2 6 23 / .3); }
        html.dark .theme-toggle::before { background: radial-gradient(circle at 20% 25%, rgb(191 219 254 / .55), transparent 25%); opacity: .3; }
        html.dark .theme-toggle__thumb { transform: translateX(0); background: #f8fafc; box-shadow: 0 2px 10px rgb(2 6 23 / .38), inset 0 1px 1px #fff; }
        html.dark .theme-toggle__moon { opacity: 1; transform: scale(1) rotate(0); }
        html.dark .theme-toggle__light { opacity: 0; transform: scale(.45) rotate(40deg); }
        html.dark .theme-toggle:active .theme-toggle__thumb { transform: scale(.92); }
    </style>
</head>
<body class="min-h-screen font-sans text-slate-700 antialiased">
    <nav class="sticky top-0 z-30 border-b border-slate-200 bg-white/95 backdrop-blur">
        <div class="mx-auto flex h-[72px] max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-2 lg:gap-7">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 text-ink">
                    <span class="grid h-10 w-10 place-items-center rounded-xl bg-gradient-to-br from-blue-600 to-cyan-500 text-lg font-black text-white shadow-sm">P</span>
                    <span class="hidden leading-tight sm:block"><strong class="block text-sm tracking-tight">DAILY PACKING</strong><small class="text-[10px] font-semibold tracking-[.16em] text-slate-400">ADI TEKHNIK MANDIRI</small></span>
                </a>
                <div class="hidden items-center gap-1 md:flex">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }} rounded-lg px-3 py-2 text-sm font-semibold">Dashboard</a>
                    <a href="{{ route('packing.index') }}" class="nav-link {{ request()->routeIs('packing.*') ? 'active' : '' }} rounded-lg px-3 py-2 text-sm font-semibold">Laporan</a>
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }} rounded-lg px-3 py-2 text-sm font-semibold">Produk</a>
                        <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }} rounded-lg px-3 py-2 text-sm font-semibold">Pengguna</a>
                    @endif
                </div>
            </div>
            <div class="flex items-center gap-2 sm:gap-4">
                <button id="themeToggle" type="button" class="theme-toggle" aria-label="Aktifkan mode gelap" aria-pressed="false">
                    <span class="theme-toggle__thumb" aria-hidden="true"><span class="theme-toggle__icon theme-toggle__moon">🌙</span><span class="theme-toggle__icon theme-toggle__light">✨</span></span>
                </button>
                @php
                    $currentUser = auth()->user();
                    $hasProfilePhoto = $currentUser->profile_photo
                        && \Illuminate\Support\Facades\Storage::disk('public')->exists($currentUser->profile_photo);
                @endphp
                <div class="group/profile relative hidden sm:block">
                    <button type="button" class="flex items-center gap-2 rounded-xl px-2 py-1.5 text-left transition hover:bg-slate-50 focus:bg-slate-50" aria-haspopup="true" aria-label="Buka menu profil">
                        @if($hasProfilePhoto)
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($currentUser->profile_photo) }}" alt="Foto profil {{ $currentUser->name }}" class="h-9 w-9 rounded-full object-cover ring-2 ring-blue-100">
                        @else
                            <span class="grid h-9 w-9 place-items-center rounded-full bg-blue-100 text-sm font-bold text-blue-700">{{ strtoupper(substr($currentUser->name, 0, 1)) }}</span>
                        @endif
                        <span class="text-left leading-tight"><strong class="block max-w-[120px] truncate text-xs text-slate-700">{{ auth()->user()->name }}</strong><small class="font-semibold uppercase tracking-wide text-blue-600">{{ auth()->user()->role }}</small></span>
                        <svg aria-hidden="true" class="h-4 w-4 text-slate-400 transition duration-200 group-hover/profile:rotate-180 group-focus-within/profile:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6"/></svg>
                    </button>

                    <div class="pointer-events-none invisible absolute right-0 top-full z-50 w-72 translate-y-2 pt-3 opacity-0 transition duration-200 ease-out group-hover/profile:pointer-events-auto group-hover/profile:visible group-hover/profile:translate-y-0 group-hover/profile:opacity-100 group-focus-within/profile:pointer-events-auto group-focus-within/profile:visible group-focus-within/profile:translate-y-0 group-focus-within/profile:opacity-100">
                        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white p-2 shadow-xl">
                            <p class="px-3 pb-2 pt-1 text-[11px] font-extrabold uppercase tracking-[.14em] text-slate-400">Menu akun</p>
                            <div class="grid gap-1">
                                <a href="{{ route('profile.edit') }}" class="group/item flex items-center gap-3 rounded-xl px-3 py-3 transition hover:bg-slate-50">
                                    <span class="grid h-9 w-9 place-items-center rounded-lg bg-blue-50 text-blue-600"><svg aria-hidden="true" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 21a8 8 0 00-16 0m12-11a4 4 0 11-8 0 4 4 0 018 0z"/></svg></span>
                                    <span class="min-w-0 flex-1"><strong class="block text-xs text-slate-700">Profil saya</strong><small class="mt-0.5 block text-xs text-slate-500">Kelola data akun dan password</small></span>
                                    <svg aria-hidden="true" class="h-4 w-4 text-slate-400 transition group-hover/item:translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 18l6-6-6-6"/></svg>
                                </a>
                                <a href="{{ route('about') }}" class="group/item flex items-center gap-3 rounded-xl px-3 py-3 transition hover:bg-slate-50">
                                    <span class="grid h-9 w-9 place-items-center rounded-lg bg-violet-50 text-violet-600"><svg aria-hidden="true" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 11v5m0-8h.01"/></svg></span>
                                    <span class="min-w-0 flex-1"><strong class="block text-xs text-slate-700">Tentang aplikasi</strong><small class="mt-0.5 block text-xs text-slate-500">Tujuan, manfaat, dan fitur utama</small></span>
                                    <svg aria-hidden="true" class="h-4 w-4 text-slate-400 transition group-hover/item:translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 18l6-6-6-6"/></svg>
                                </a>
                                <a href="{{ route('guide') }}" class="group/item flex items-center gap-3 rounded-xl px-3 py-3 transition hover:bg-slate-50">
                                    <span class="grid h-9 w-9 place-items-center rounded-lg bg-emerald-50 text-emerald-600"><svg aria-hidden="true" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9M12 4h9M3 4h.01M3 12h.01M3 20h.01M7 4h1m-1 8h1m-1 8h1"/></svg></span>
                                    <span class="min-w-0 flex-1"><strong class="block text-xs text-slate-700">Panduan penggunaan</strong><small class="mt-0.5 block text-xs text-slate-500">Cara menggunakan aplikasi</small></span>
                                    <svg aria-hidden="true" class="h-4 w-4 text-slate-400 transition group-hover/item:translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 18l6-6-6-6"/></svg>
                                </a>
                            </div>
                            <div class="mt-2 border-t border-slate-100 p-2 pt-3">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-left text-xs font-bold text-red-500 transition hover:bg-red-50 hover:text-red-600">
                                        <svg aria-hidden="true" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4m-5-4l5-5-5-5m5 5H3"/></svg>
                                        Keluar dari akun
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <button id="mobileMenuButton" class="rounded-lg p-2 text-slate-600 md:hidden" aria-label="Buka menu">☰</button>
            </div>
        </div>
        <div id="mobileMenu" class="hidden border-t border-slate-100 bg-white px-4 py-3 md:hidden">
            <div class="grid gap-1">
                <a href="{{ route('dashboard') }}" class="nav-link rounded-lg px-3 py-2 text-sm font-semibold">Dashboard</a>
                <a href="{{ route('packing.index') }}" class="nav-link rounded-lg px-3 py-2 text-sm font-semibold">Laporan Packing</a>
                @if(auth()->user()->role === 'admin')<a href="{{ route('products.index') }}" class="nav-link rounded-lg px-3 py-2 text-sm font-semibold">Kelola Produk</a><a href="{{ route('users.index') }}" class="nav-link rounded-lg px-3 py-2 text-sm font-semibold">Kelola Pengguna</a>@endif
                <a href="{{ route('profile.edit') }}" class="nav-link rounded-lg px-3 py-2 text-sm font-semibold">Profil Akun</a>
                <a href="{{ route('about') }}" class="nav-link rounded-lg px-3 py-2 text-sm font-semibold">Tentang aplikasi</a>
                <a href="{{ route('guide') }}" class="nav-link rounded-lg px-3 py-2 text-sm font-semibold">Panduan penggunaan</a>
                <form method="POST" action="{{ route('logout') }}" class="mt-2 border-t border-slate-100 pt-2">@csrf<button type="submit" class="w-full rounded-lg px-3 py-2 text-left text-sm font-bold text-red-500 transition hover:bg-red-50 hover:text-red-600">Keluar dari akun</button></form>
            </div>
        </div>
    </nav>
    <main class="mx-auto min-h-[calc(100vh-72px)] max-w-7xl px-4 py-7 sm:px-6 lg:px-8">
        @if(session('success'))<div class="fade-up mb-5 flex items-center gap-3 rounded-xl border border-emerald-100 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700"><span class="grid h-6 w-6 place-items-center rounded-full bg-emerald-500 text-xs text-white">✓</span>{{ session('success') }}</div>@endif
        @if(session('error'))<div class="fade-up mb-5 flex items-center gap-3 rounded-xl border border-red-100 bg-red-50 px-4 py-3 text-sm font-medium text-red-700"><span class="grid h-6 w-6 place-items-center rounded-full bg-red-500 text-xs text-white">!</span>{{ session('error') }}</div>@endif
        @yield('content')
    </main>
    <script>
        document.getElementById('mobileMenuButton')?.addEventListener('click', () => document.getElementById('mobileMenu').classList.toggle('hidden'));

        const themeToggle = document.getElementById('themeToggle');

        function updateThemeButton() {
            const isDark = document.documentElement.classList.contains('dark');
            themeToggle?.setAttribute('aria-label', isDark ? 'Aktifkan mode terang' : 'Aktifkan mode gelap');
            themeToggle?.setAttribute('aria-pressed', String(isDark));
        }

        themeToggle?.addEventListener('click', () => {
            const isDark = !document.documentElement.classList.contains('dark');
            document.documentElement.classList.toggle('dark', isDark);
            try { localStorage.setItem('theme', isDark ? 'dark' : 'light'); } catch (error) {}
            window.dispatchEvent(new CustomEvent('themechange', { detail: { isDark } }));
            updateThemeButton();
        });

        updateThemeButton();
    </script>
    @stack('scripts')
</body>
</html>
