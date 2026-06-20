<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WARKOP TAKARA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            background: #1a0a00;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Lato', sans-serif;
            overflow: hidden;
            padding: 2rem 1rem;
        }
        .stars-layer { position: fixed; inset: 0; pointer-events: none; z-index: 0; }
        .star {
            position: absolute;
            border-radius: 50%;
            background: #fff8e1;
            animation: twinkle linear infinite;
            opacity: 0;
        }
        @keyframes twinkle {
            0%, 100% { opacity: 0; transform: scale(0.5); }
            50%       { opacity: 0.6; transform: scale(1); }
        }
        .floating-bean {
            position: fixed;
            opacity: 0.12;
            animation: floatBean linear infinite;
            pointer-events: none;
            z-index: 0;
        }
        @keyframes floatBean {
            0%   { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10%  { opacity: 0.12; }
            90%  { opacity: 0.08; }
            100% { transform: translateY(-20vh) rotate(360deg); opacity: 0; }
        }
        #steamCanvas { position: fixed; inset: 0; pointer-events: none; z-index: 0; }
        .card {
            position: relative;
            z-index: 1;
            background: rgba(255, 248, 230, 0.06);
            border: 0.5px solid rgba(210, 160, 80, 0.3);
            border-radius: 20px;
            padding: 2.5rem 2rem 2rem;
            width: 100%;
            max-width: 440px;
            text-align: center;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .logo-wrap {
            width: 130px;
            height: 130px;
            margin: 0 auto 1.2rem;
            animation: pulseGlow 3s ease-in-out infinite;
        }
        @keyframes pulseGlow {
            0%, 100% { filter: drop-shadow(0 0 4px rgba(210,160,80,0.3)); }
            50%       { filter: drop-shadow(0 0 16px rgba(210,160,80,0.65)); }
        }
        .brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 900;
            color: #f5c842;
            letter-spacing: 2px;
            line-height: 1.1;
            margin-bottom: 2px;
            text-shadow: 0 0 20px rgba(245,200,66,0.3);
        }
        .brand-sub {
            font-size: 12px;
            font-weight: 300;
            letter-spacing: 5px;
            color: rgba(245,200,100,0.7);
            text-transform: uppercase;
            margin-bottom: 1.4rem;
        }
        .divider { display: flex; align-items: center; gap: 10px; margin: 0 auto 1.4rem; max-width: 260px; }
        .divider-line { flex: 1; height: 0.5px; background: rgba(210,160,80,0.4); }
        .divider-dot  { width: 5px; height: 5px; border-radius: 50%; background: rgba(210,160,80,0.6); }
        .welcome-text {
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            font-weight: 700;
            color: #fff8e1;
            margin-bottom: 6px;
        }
        .welcome-sub {
            font-size: 13px;
            color: rgba(255,240,200,0.55);
            margin-bottom: 1.8rem;
            font-weight: 300;
            letter-spacing: 0.5px;
        }
        .btn-group { display: flex; flex-direction: column; gap: 12px; margin-bottom: 1.6rem; }
        .btn {
            display: block;
            padding: 13px 24px;
            border-radius: 10px;
            font-family: 'Lato', sans-serif;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            cursor: pointer;
            border: none;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
            text-decoration: none;
        }
        .btn:active { transform: scale(0.97); }
        .btn-kasir { background: linear-gradient(135deg, #d4931a, #f5c842); color: #1a0a00; }
        .btn-kasir:hover { box-shadow: 0 4px 20px rgba(245,200,66,0.4); transform: translateY(-1px); }
        .btn-pembeli { background: transparent; color: #f5c842; border: 1px solid rgba(245,200,66,0.5); }
        .btn-pembeli:hover { background: rgba(245,200,66,0.08); transform: translateY(-1px); }
        .footer-txt { font-size: 11px; color: rgba(255,240,200,0.28); letter-spacing: 0.5px; }
    </style>
</head>
<body>

    <div class="stars-layer" id="stars"></div>
    <canvas id="steamCanvas"></canvas>

    <div class="card">

        {{-- Logo Kopi SVG --}}
        <div class="logo-wrap">
            <svg width="130" height="130" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <linearGradient id="cg" x1="30" y1="45" x2="90" y2="100" gradientUnits="userSpaceOnUse">
                        <stop offset="0%" stop-color="#4a2000"/>
                        <stop offset="100%" stop-color="#2a0f00"/>
                    </linearGradient>
                    <linearGradient id="sg" x1="20" y1="95" x2="100" y2="108" gradientUnits="userSpaceOnUse">
                        <stop offset="0%" stop-color="#5a2a08"/>
                        <stop offset="50%" stop-color="#8a4a18"/>
                        <stop offset="100%" stop-color="#5a2a08"/>
                    </linearGradient>
                    <clipPath id="cc">
                        <path d="M36 50 L32 92 Q32 96 60 96 Q88 96 84 92 L80 50 Z"/>
                    </clipPath>
                </defs>
                <ellipse cx="60" cy="103" rx="38" ry="7" fill="url(#sg)" stroke="#c8781a" stroke-width="0.8"/>
                <ellipse cx="60" cy="101" rx="28" ry="4" fill="#3d1800" stroke="#a06020" stroke-width="0.5" opacity="0.6"/>
                <path d="M36 50 L32 92 Q32 97 60 97 Q88 97 84 92 L80 50 Z" fill="url(#cg)" stroke="#c8781a" stroke-width="1"/>
                <g clip-path="url(#cc)">
                    <ellipse cx="60" cy="54" rx="22" ry="6" fill="#2a0f00"/>
                    <ellipse cx="60" cy="54" rx="20" ry="5.2" fill="none" stroke="#8a5020" stroke-width="1.5" opacity="0.5"/>
                    <path d="M60 58 C57 55 52 55 52 59 C52 62 56 65 60 68 C64 65 68 62 68 59 C68 55 63 55 60 58Z" fill="#c87830" opacity="0.7"/>
                    <circle cx="52" cy="52" r="2" fill="#d4921a" opacity="0.4"/>
                    <circle cx="68" cy="53" r="1.5" fill="#d4921a" opacity="0.3"/>
                </g>
                <ellipse cx="60" cy="50" rx="22" ry="6" fill="none" stroke="#f5c842" stroke-width="2"/>
                <path d="M42 48 Q60 44 78 48" stroke="#f5c842" stroke-width="1" fill="none" opacity="0.5" stroke-linecap="round"/>
                <path d="M82 62 Q98 62 98 72 Q98 83 82 83" fill="none" stroke="#c8781a" stroke-width="4" stroke-linecap="round"/>
                <path d="M82 63 Q95 63 95 72 Q95 82 82 82" fill="none" stroke="#7a4010" stroke-width="2" stroke-linecap="round" opacity="0.5"/>
                <path d="M83 65 Q93 65 93 72 Q93 79 83 80" fill="none" stroke="#e8a030" stroke-width="0.8" stroke-linecap="round" opacity="0.4"/>
                <path d="M47 44 Q44 38 47 32 Q50 26 47 20" stroke="#f5c842" stroke-width="1.5" fill="none" stroke-linecap="round">
                    <animate attributeName="d" dur="2.5s" repeatCount="indefinite" values="M47 44 Q44 38 47 32 Q50 26 47 20;M47 44 Q50 38 47 32 Q44 26 47 20;M47 44 Q44 38 47 32 Q50 26 47 20"/>
                    <animate attributeName="opacity" dur="2.5s" repeatCount="indefinite" values="0.6;0.15;0.6"/>
                </path>
                <path d="M60 42 Q57 35 60 28 Q63 21 60 14" stroke="#f5c842" stroke-width="1.5" fill="none" stroke-linecap="round">
                    <animate attributeName="d" dur="3s" repeatCount="indefinite" values="M60 42 Q57 35 60 28 Q63 21 60 14;M60 42 Q63 35 60 28 Q57 21 60 14;M60 42 Q57 35 60 28 Q63 21 60 14"/>
                    <animate attributeName="opacity" dur="3s" repeatCount="indefinite" values="0.8;0.15;0.8"/>
                </path>
                <path d="M73 44 Q76 38 73 32 Q70 26 73 20" stroke="#f5c842" stroke-width="1.2" fill="none" stroke-linecap="round">
                    <animate attributeName="d" dur="2s" repeatCount="indefinite" values="M73 44 Q76 38 73 32 Q70 26 73 20;M73 44 Q70 38 73 32 Q76 26 73 20;M73 44 Q76 38 73 32 Q70 26 73 20"/>
                    <animate attributeName="opacity" dur="2s" repeatCount="indefinite" values="0.5;0.1;0.5"/>
                </path>
                <circle cx="60" cy="65" r="54" fill="none" stroke="#c8781a" stroke-width="0.8" opacity="0.35"/>
                <circle cx="60" cy="65" r="57" fill="none" stroke="#f5c842" stroke-width="0.4" opacity="0.15"/>
            </svg>
        </div>

        <div class="brand-name">WARKOP TAKARA</div>
        <div class="brand-sub">Kopi &amp; Cita Rasa</div>

        <div class="divider">
            <div class="divider-line"></div>
            <div class="divider-dot"></div>
            <div class="divider-line"></div>
        </div>

        <div class="welcome-text">Selamat Datang</div>
        <div class="welcome-sub">Silakan pilih peran Anda untuk masuk ke sistem</div>

        <div class="btn-group">
            <a href="{{ route('login') }}" class="btn btn-kasir">☕ Masuk sebagai Kasir</a>
            <a href="{{ route('menu') }}" class="btn btn-pembeli">🛒 Masuk sebagai Pembeli</a>
        </div>

        <div class="footer-txt">
            &copy; {{ now()->year }} Warkop Takara. All rights reserved.
        </div>
    </div>

    <script>
        const starsEl = document.getElementById('stars');
        for (let i = 0; i < 55; i++) {
            const s = document.createElement('div');
            s.className = 'star';
            const size = Math.random() * 2.5 + 1;
            s.style.cssText = `width:${size}px;height:${size}px;left:${Math.random()*100}%;top:${Math.random()*100}%;animation-duration:${2+Math.random()*4}s;animation-delay:${Math.random()*4}s;`;
            starsEl.appendChild(s);
        }
        const symbols = ['☕','🫘','✦','·','◦'];
        for (let i = 0; i < 12; i++) {
            const b = document.createElement('div');
            b.className = 'floating-bean';
            b.textContent = symbols[Math.floor(Math.random()*symbols.length)];
            b.style.cssText = `left:${Math.random()*100}%;font-size:${12+Math.random()*16}px;animation-duration:${8+Math.random()*12}s;animation-delay:${Math.random()*10}s;`;
            document.body.appendChild(b);
        }
        const canvas = document.getElementById('steamCanvas');
        const ctx = canvas.getContext('2d');
        let W, H;
        function resize() { W = canvas.width = window.innerWidth; H = canvas.height = window.innerHeight; }
        resize();
        window.addEventListener('resize', resize);
        const particles = Array.from({ length: 22 }, () => ({
            x: Math.random()*(W||800), y: Math.random()*(H||600),
            vx: (Math.random()-0.5)*0.4, vy: -(0.3+Math.random()*0.5),
            r: 20+Math.random()*40, a: 0.04+Math.random()*0.04, life: Math.random()
        }));
        function draw() {
            ctx.clearRect(0,0,W,H);
            for (const p of particles) {
                p.x += p.vx; p.y += p.vy; p.life -= 0.004;
                if (p.life <= 0) { p.x=Math.random()*W; p.y=H+20; p.life=0.3+Math.random()*0.7; p.vx=(Math.random()-0.5)*0.4; }
                const g = ctx.createRadialGradient(p.x,p.y,0,p.x,p.y,p.r);
                g.addColorStop(0,`rgba(180,120,40,${p.a*p.life})`);
                g.addColorStop(1,'rgba(180,120,40,0)');
                ctx.fillStyle = g;
                ctx.beginPath(); ctx.arc(p.x,p.y,p.r,0,Math.PI*2); ctx.fill();
            }
            requestAnimationFrame(draw);
        }
        draw();
    </script>
</body>
</html>