<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Daily Packing Report</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        (() => {
            try {
                const savedTheme = localStorage.getItem('theme');
                const isDark = savedTheme ? savedTheme === 'dark' : window.matchMedia('(prefers-color-scheme: dark)').matches;
                document.documentElement.classList.toggle('dark', isDark);
            } catch (error) {}
        })();
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background: #6475f4; overflow-x: hidden; font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif; }
        body::before { content: ''; position: fixed; inset: 0; z-index: -2; background: linear-gradient(118deg, #8130f3 0%, #6557ee 42%, #63a5ec 100%); }
        body::after { content: ''; position: fixed; inset: 0; z-index: -1; opacity: .36; background-image: url("data:image/svg+xml,%3Csvg width='1440' height='900' viewBox='0 0 1440 900' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 310C144 367 254 257 384 207C539 147 617 282 760 232C912 179 1017 320 1188 286C1301 264 1376 226 1440 240V900H0V310Z' fill='%23B1B6FF'/%3E%3Cpath d='M0 600C153 648 278 599 401 515C539 421 666 400 811 447C974 501 1085 415 1229 459C1325 489 1389 532 1440 548V900H0V600Z' fill='%233E50E5'/%3E%3Cpath d='M0 464C157 492 254 427 393 387C567 336 665 430 827 389C1007 344 1116 419 1277 392C1347 380 1403 352 1440 338V500C1316 469 1195 460 1077 491C929 530 846 467 721 479C573 493 466 541 319 521C180 503 88 550 0 544V464Z' fill='%2399A7FC'/%3E%3C/svg%3E"); background-position: center; background-size: cover; }
        .enter { animation: enter .6s ease-out; }
        @keyframes enter { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }
        html.dark { color-scheme: dark; }
        html.dark .enter { background-color: #1f2937; border-color: #475569; box-shadow: 0 12px 28px rgba(2, 6, 23, .25) !important; }
        html.dark .text-slate-800 { color: #f8fafc; }
        html.dark .text-slate-700 { color: #e2e8f0; }
        html.dark .text-slate-500, html.dark .text-slate-400 { color: #94a3b8; }
        html.dark input { background-color: #182233; border-color: #475569; color: #e2e8f0; }
        .theme-toggle { position: relative; display: inline-flex; box-sizing: border-box; align-items: center; height: 2.75rem; width: 5rem; flex: 0 0 auto; padding: .2rem; overflow: hidden; border: 1px solid rgb(255 255 255 / .42); border-radius: 999px; background: linear-gradient(135deg, #dbeafe, #bfdbfe); box-shadow: inset 0 1px 1px rgb(255 255 255 / .55), 0 8px 20px rgb(30 64 175 / .18); transition: background .55s cubic-bezier(.22, 1, .36, 1), border-color .55s ease, box-shadow .55s ease; }
        .theme-toggle::before { position: absolute; inset: 0; content: ''; background: radial-gradient(circle at 78% 28%, rgb(255 255 255 / .7), transparent 28%); opacity: 1; transition: opacity .45s ease; }
        .theme-toggle__thumb { position: relative; z-index: 1; display: grid; height: 2.2rem; width: 2.2rem; transform: translateX(2.35rem); place-items: center; border-radius: 999px; background: #fff; box-shadow: 0 3px 10px rgb(30 64 175 / .2), inset 0 1px 1px rgb(255 255 255 / .95); transition: transform .55s cubic-bezier(.22, 1, .36, 1), background .55s ease, box-shadow .55s ease; }
        .theme-toggle__icon { position: absolute; font-size: 1rem; line-height: 1; transition: opacity .28s ease, transform .5s cubic-bezier(.22, 1, .36, 1); }
        .theme-toggle__moon { opacity: 0; transform: scale(.45) rotate(-40deg); }
        .theme-toggle__light { opacity: 1; transform: scale(1) rotate(0); }
        .theme-toggle:hover { box-shadow: inset 0 1px 1px rgb(255 255 255 / .65), 0 11px 24px rgb(30 64 175 / .28); }
        .theme-toggle:active .theme-toggle__thumb { transform: translateX(2.35rem) scale(.92); }
        .theme-toggle:focus-visible { outline: 3px solid rgb(255 255 255 / .68); outline-offset: 3px; }
        html.dark .theme-toggle { border-color: rgb(148 163 184 / .34); background: linear-gradient(135deg, #111827, #334155); box-shadow: inset 0 1px 1px rgb(255 255 255 / .08), 0 8px 20px rgb(2 6 23 / .35); }
        html.dark .theme-toggle::before { opacity: .28; background: radial-gradient(circle at 20% 25%, rgb(191 219 254 / .6), transparent 24%); }
        html.dark .theme-toggle__thumb { transform: translateX(0); background: #f8fafc; box-shadow: 0 3px 12px rgb(2 6 23 / .4), inset 0 1px 1px #fff; }
        html.dark .theme-toggle__moon { opacity: 1; transform: scale(1) rotate(0); }
        html.dark .theme-toggle__light { opacity: 0; transform: scale(.45) rotate(40deg); }
        html.dark .theme-toggle:active .theme-toggle__thumb { transform: scale(.92); }
        @media (prefers-reduced-motion: reduce) { .theme-toggle, .theme-toggle::before, .theme-toggle__thumb, .theme-toggle__icon { transition-duration: .01ms; } }
    </style>
</head>
<body class="min-h-screen font-sans text-slate-700">
    <button id="themeToggle" type="button" class="theme-toggle fixed right-5 top-5 z-10" aria-label="Aktifkan mode gelap" aria-pressed="false">
        <span class="theme-toggle__thumb" aria-hidden="true"><span class="theme-toggle__icon theme-toggle__moon">🌙</span><span class="theme-toggle__icon theme-toggle__light">✨</span></span>
    </button>
    <div class="mx-auto grid min-h-screen max-w-6xl place-items-center px-5 py-10 lg:grid-cols-2 lg:gap-20">
        <section class="hidden text-white lg:block">
            <div class="grid h-14 w-14 place-items-center rounded-2xl bg-white/20 text-2xl font-black shadow-xl ring-1 ring-white/30">P</div>
            <p class="mt-8 text-sm font-bold tracking-[.2em] text-blue-100">PT ADI TEKHNIK MANDIRI</p>
            <h1 class="mt-3 max-w-md text-4xl font-bold leading-tight">Packing harian lebih rapi, cepat, dan terkendali.</h1>
            <p class="mt-5 max-w-md leading-relaxed text-blue-50">Satu tempat untuk mencatat hasil packing, memantau performa, dan menyusun laporan operasional Anda.</p>
            <div class="mt-10 flex gap-6 text-sm text-blue-50"><span><strong class="block text-2xl text-white">24/7</strong><small>Akses data</small></span><span><strong class="block text-2xl text-white">2</strong><small>Hak akses</small></span><span><strong class="block text-2xl text-white">1</strong><small>Sistem terpusat</small></span></div>
        </section>
        <section class="enter w-full max-w-md rounded-3xl border border-white/80 bg-white p-7 shadow-xl sm:p-9">
            <div class="mb-8"><div class="grid h-11 w-11 place-items-center rounded-xl bg-blue-600 text-lg font-black text-white lg:hidden">P</div><p class="mt-4 text-sm font-semibold text-blue-600">SELAMAT DATANG</p><h2 class="mt-1 text-2xl font-bold text-slate-800">Masuk ke akun Anda</h2><p class="mt-2 text-sm text-slate-500">Gunakan akun terdaftar untuk melanjutkan.</p></div>
            @if($errors->any())<div class="mb-5 rounded-xl border border-red-100 bg-red-50 px-4 py-3 text-sm text-red-600">{{ $errors->first() }}</div>@endif
            <form method="POST" action="{{ route('login') }}" class="space-y-5">@csrf
                <div><label class="mb-1.5 block text-sm font-bold text-slate-700">Alamat email</label><input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="nama@perusahaan.com" class="w-full rounded-xl border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500"></div>
                <div><label class="mb-1.5 block text-sm font-bold text-slate-700">Password</label><input type="password" name="password" required placeholder="Masukkan password" class="w-full rounded-xl border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500"></div>
                <button class="w-full rounded-xl bg-blue-600 py-3 text-sm font-bold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-blue-700">Masuk ke dashboard</button>
            </form>
            <p class="mt-7 text-center text-xs text-slate-400">Daily Packing Report - PT Adi Tekhnik Mandiri</p>
        </section>
    </div>
    <script>
        const themeToggle = document.getElementById('themeToggle');

        function updateThemeButton() {
            const isDark = document.documentElement.classList.contains('dark');
            themeToggle.setAttribute('aria-label', isDark ? 'Aktifkan mode terang' : 'Aktifkan mode gelap');
            themeToggle.setAttribute('aria-pressed', String(isDark));
        }

        themeToggle.addEventListener('click', () => {
            const isDark = !document.documentElement.classList.contains('dark');
            document.documentElement.classList.toggle('dark', isDark);
            try { localStorage.setItem('theme', isDark ? 'dark' : 'light'); } catch (error) {}
            updateThemeButton();
        });

        updateThemeButton();
    </script>
</body>
</html>
