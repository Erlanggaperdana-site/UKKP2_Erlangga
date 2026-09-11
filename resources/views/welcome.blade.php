<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RestoAduan — Sistem Pengaduan Pelanggan Restoran</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config={theme:{extend:{fontFamily:{sans:['Inter','sans-serif']}}}}</script>
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        @keyframes fadeInUp { from { opacity:0; transform: translateY(12px); } to { opacity:1; transform: translateY(0); } }
        @keyframes shimmer { 0% { transform: translateX(-100%); } 100% { transform: translateX(200%); } }
        .animate-hero { animation: fadeInUp 0.65s cubic-bezier(0.16,1,0.3,1) both; }
        .animate-cards { animation: fadeInUp 0.7s cubic-bezier(0.16,1,0.3,1) 0.12s both; }
        #page-loader { position: fixed; top:0; left:0; height:2px; width:0%; background:#0f172a; z-index:9999; pointer-events:none; transition: width 0.55s cubic-bezier(0.16,1,0.3,1), opacity 0.45s cubic-bezier(0.16,1,0.3,1); opacity:1; will-change: width, opacity; }
        #page-loader::after { content:''; position:absolute; inset:0; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.55), transparent); transform: translateX(-100%); animation: shimmer 1.25s ease-in-out infinite; }
        #page-loader.done { opacity:0; }
        #page-overlay { transition: opacity 0.5s cubic-bezier(0.16,1,0.3,1); will-change: opacity; }
        #page-overlay .overlay-card { transition: transform 0.5s cubic-bezier(0.16,1,0.3,1), opacity 0.5s cubic-bezier(0.16,1,0.3,1); will-change: transform, opacity; }
        #page-overlay-bar { animation: shimmer 1.4s ease-in-out infinite; }
        @media (prefers-reduced-motion: reduce) {
            .animate-hero, .animate-cards { animation: none !important; }
            #page-loader, #page-overlay, #page-overlay .overlay-card { transition: none !important; }
            #page-loader::after, #page-overlay-bar { animation: none !important; }
        }
    </style>
</head>
<body class="bg-white text-slate-900 font-sans antialiased min-h-screen flex flex-col selection:bg-orange-100 selection:text-orange-700">
    <div id="page-loader" aria-hidden="true"></div>
    <div id="page-overlay" class="fixed inset-0 z-[9998] bg-white/75 backdrop-blur-[3px] flex items-center justify-center opacity-100" aria-hidden="true">
        <div class="overlay-card bg-white rounded-2xl border border-slate-200 shadow-xl shadow-slate-900/[0.07] px-5 py-4 flex items-center gap-4 min-w-65 max-w-[90vw]">
            <div class="w-10 h-10 rounded-xl bg-slate-900 text-white grid place-items-center shrink-0 shadow-sm">
                <i data-feather="coffee" class="w-5 h-5 text-orange-400"></i>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-slate-900 leading-none">Memuat RestoAduan</p>
                <p class="text-xs text-slate-500 mt-1">Menyiapkan halaman…</p>
                <div class="mt-3 h-1.5 rounded-full bg-slate-100 overflow-hidden">
                    <div id="page-overlay-bar" class="h-full w-2/3 rounded-full bg-slate-900"></div>
                </div>
            </div>
        </div>
    </div>
    <header class="w-full max-w-6xl mx-auto px-6 py-5 flex items-center justify-between border-b border-slate-100">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-slate-900 text-white grid place-items-center font-bold shadow-sm">
                <i data-feather="coffee" class="w-5 h-5 text-orange-400"></i>
            </div>
            <div>
                <span class="text-base font-bold tracking-tight block leading-tight">RestoAduan</span>
                <span class="hidden sm:block text-xs text-slate-500">Layanan Pengaduan Pelanggan Restoran</span>
            </div>
        </div>
        @if (Route::has('login'))
        <nav class="flex items-center gap-2">
            @auth
                <a href="{{ url('/dashboard') }}" class="px-4 py-2 rounded-xl bg-slate-900 text-white text-sm font-medium hover:bg-slate-800 transition">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="px-4 py-2 rounded-xl text-sm font-medium text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition">Masuk</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="px-4 py-2 rounded-xl bg-slate-900 text-white text-sm font-medium hover:bg-slate-800 transition">Daftar</a>
                @endif
            @endauth
        </nav>
        @endif
    </header>

    <main class="flex-1 w-full max-w-6xl mx-auto px-6 pt-12 pb-16 flex flex-col items-center text-center">
        <div class="animate-hero flex flex-col items-center">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-orange-50 border border-orange-200/60 text-xs font-semibold text-orange-700 mb-6">
                <span class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></span>
                Sistem Pengaduan Pelanggan Restoran
            </div>

            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-[1.08] max-w-3xl text-slate-900">
                Layanan pengaduan & masukan <span class="text-slate-400">pelanggan restoran.</span>
            </h1>
            <p class="text-base sm:text-lg text-slate-500 max-w-2xl mt-4 leading-relaxed">
                Sampaikan keluhan pelayanan, kualitas makanan, atau saran antar sesama pelanggan dan pengelola restoran secara cepat, transparan, dan mudah.
            </p>

            <div class="flex flex-col sm:flex-row gap-3 mt-8 w-full sm:w-auto">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-6 py-3 rounded-xl bg-slate-900 text-white text-sm font-medium hover:bg-slate-800 transition text-center shadow-sm">Buka Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="px-6 py-3 rounded-xl bg-slate-900 text-white text-sm font-medium hover:bg-slate-800 transition text-center shadow-sm">Kirim Pengaduan Sekarang</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-6 py-3 rounded-xl bg-white border border-slate-200 text-sm font-medium text-slate-700 hover:bg-slate-50 transition text-center">Daftar Akun</a>
                    @endif
                @endauth
            </div>
        </div>

        <div class="animate-cards w-full grid grid-cols-1 sm:grid-cols-3 gap-5 mt-16 text-left max-w-4xl">
            <div class="rounded-2xl border border-slate-200 p-6 bg-slate-50/50 hover:bg-white hover:border-slate-300 transition shadow-sm">
                <div class="w-9 h-9 rounded-xl bg-slate-900 text-white grid place-items-center text-xs font-bold mb-4">1</div>
                <h3 class="text-base font-semibold text-slate-900">Tulis Keluhan Pelayanan</h3>
                <p class="text-sm text-slate-500 mt-1.5 leading-relaxed">Sampaikan keluhan atau masukan seputar pesanan, makanan, atau meja restoran.</p>
            </div>
            <div class="rounded-2xl border border-slate-200 p-6 bg-slate-50/50 hover:bg-white hover:border-slate-300 transition shadow-sm">
                <div class="w-9 h-9 rounded-xl bg-slate-900 text-white grid place-items-center text-xs font-bold mb-4">2</div>
                <h3 class="text-base font-semibold text-slate-900">Ditangani Petugas Resto</h3>
                <p class="text-sm text-slate-500 mt-1.5 leading-relaxed">Laporan akan diteruskan ke petugas restoran untuk segera ditindaklanjuti.</p>
            </div>
            <div class="rounded-2xl border border-slate-200 p-6 bg-slate-50/50 hover:bg-white hover:border-slate-300 transition shadow-sm">
                <div class="w-9 h-9 rounded-xl bg-slate-900 text-white grid place-items-center text-xs font-bold mb-4">3</div>
                <h3 class="text-base font-semibold text-slate-900">Pantau Status Pengaduan</h3>
                <p class="text-sm text-slate-500 mt-1.5 leading-relaxed">Lihat perkembangan status laporan Anda langsung dari dashboard pelanggan.</p>
            </div>
        </div>
    </main>

    <footer class="w-full max-w-6xl mx-auto px-6 py-6 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-slate-500">
        <span>© {{ date('Y') }} RestoAduan — Pengaduan Restoran</span>
        <span>Layanan komunikasi & pengaduan pelanggan restoran</span>
    </footer>

    <script>
        (function(){
            var EASE = 'cubic-bezier(0.16,1,0.3,1)';
            function getLoader(){ return document.getElementById('page-loader'); }
            function getOverlay(){ return document.getElementById('page-overlay'); }
            function getOverlayCard(){ var o=getOverlay(); return o ? o.querySelector('.overlay-card') : null; }
            function showNow(pct){
                var l = getLoader(); if(l){ l.classList.remove('done'); l.style.opacity='1'; l.style.transition='width 0.6s '+EASE+', opacity 0.5s '+EASE; void l.offsetWidth; l.style.width = pct + '%'; }
                var o = getOverlay(); var c = getOverlayCard();
                if(o){ o.style.display='flex'; if(c){ c.style.opacity='0'; c.style.transform='scale(0.97) translateY(4px)'; } void o.offsetWidth; o.style.opacity='1'; o.style.pointerEvents='auto'; if(c){ void c.offsetWidth; c.style.opacity='1'; c.style.transform='scale(1) translateY(0)'; } }
            }
            function hideOverlay(){
                var o = getOverlay(); var c = getOverlayCard(); if(!o) return;
                o.style.opacity = '0'; o.style.pointerEvents = 'none';
                if(c){ c.style.opacity='0'; c.style.transform='scale(0.98) translateY(4px)'; }
                setTimeout(function(){ if(o.style.opacity === '0') o.style.display = 'none'; }, 520);
            }
            document.addEventListener('DOMContentLoaded', function(){
                feather.replace();
                var l = getLoader();
                if(l){
                    l.style.transition='width 0.6s '+EASE+', opacity 0.5s '+EASE;
                    l.style.width = '70%';
                    setTimeout(function(){
                        l.style.width = '100%';
                        setTimeout(function(){ l.classList.add('done'); }, 350);
                    }, 200);
                }
                setTimeout(hideOverlay, 600);
            });
            document.addEventListener('click', function(e){
                var a = e.target.closest('a[href]'); if(!a) return;
                var href = a.getAttribute('href');
                if(!href || href.startsWith('#') || href.startsWith('javascript:') || href.startsWith('mailto:') || href.startsWith('tel:')) return;
                if(a.target === '_blank' || e.ctrlKey || e.metaKey || e.button === 1) return;
                try { var url = new URL(href, window.location.href); if(url.origin !== window.location.origin) return; } catch(err) { return; }
                showNow(45);
            }, true);
            document.addEventListener('submit', function(){ showNow(60); }, true);
            window.addEventListener('beforeunload', function(){ showNow(40); });
            window.addEventListener('pageshow', function(e){
                if(!e.persisted) return;
                var l=getLoader(); if(l){ l.classList.add('done'); l.style.width='0%'; }
                var o=getOverlay(); if(o){ o.style.display='none'; o.style.opacity='0'; o.style.pointerEvents='none'; }
                var c=getOverlayCard(); if(c){ c.style.opacity='0'; c.style.transform='scale(0.97) translateY(4px)'; }
            });
        })();
    </script>
</body>
</html>
