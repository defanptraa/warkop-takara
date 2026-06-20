<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Warkop Takara</title>
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
            padding: 2.5rem 2.2rem 2rem;
            width: 100%;
            max-width: 460px;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .logo-wrap {
            width: 90px;
            height: 90px;
            margin: 0 auto 1.2rem;
            animation: pulseGlow 3s ease-in-out infinite;
        }
        @keyframes pulseGlow {
            0%, 100% { filter: drop-shadow(0 0 4px rgba(210,160,80,0.3)); }
            50%       { filter: drop-shadow(0 0 14px rgba(210,160,80,0.6)); }
        }
        .brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            font-weight: 900;
            color: #f5c842;
            letter-spacing: 2px;
            text-align: center;
            text-shadow: 0 0 20px rgba(245,200,66,0.3);
            margin-bottom: 2px;
        }
        .brand-sub {
            font-size: 11px;
            font-weight: 300;
            letter-spacing: 5px;
            color: rgba(245,200,100,0.7);
            text-transform: uppercase;
            text-align: center;
            margin-bottom: 1.2rem;
        }
        .divider { display: flex; align-items: center; gap: 10px; margin: 0 auto 1.4rem; max-width: 280px; }
        .divider-line { flex: 1; height: 0.5px; background: rgba(210,160,80,0.4); }
        .divider-dot  { width: 5px; height: 5px; border-radius: 50%; background: rgba(210,160,80,0.6); }
        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 19px;
            font-weight: 700;
            color: #fff8e1;
            text-align: center;
            margin-bottom: 4px;
        }
        .section-sub {
            font-size: 12px;
            color: rgba(255,240,200,0.5);
            text-align: center;
            font-weight: 300;
            letter-spacing: 0.4px;
            margin-bottom: 1.6rem;
        }
        .status-msg {
            font-size: 13px;
            color: #a8e6a3;
            text-align: center;
            margin-bottom: 1rem;
            padding: 8px 12px;
            border-radius: 8px;
            background: rgba(100,200,80,0.08);
            border: 0.5px solid rgba(100,200,80,0.2);
        }
        .field { margin-bottom: 1.1rem; }
        .field label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: rgba(245,200,100,0.8);
            margin-bottom: 6px;
        }
        .field input[type="email"],
        .field input[type="password"] {
            width: 100%;
            padding: 11px 14px;
            background: rgba(255,248,230,0.05);
            border: 0.5px solid rgba(210,160,80,0.35);
            border-radius: 10px;
            color: #fff8e1;
            font-family: 'Lato', sans-serif;
            font-size: 14px;
            font-weight: 300;
            outline: none;
            transition: border-color 0.2s, background 0.2s;
        }
        .field input:focus {
            border-color: rgba(245,200,66,0.7);
            background: rgba(255,248,230,0.09);
        }
        .field input::placeholder { color: rgba(255,240,200,0.25); }
        .field-error { font-size: 12px; color: #f4a3a3; margin-top: 5px; }
        .remember-row { display: flex; align-items: center; gap: 8px; margin-bottom: 1.6rem; }
        .remember-row input[type="checkbox"] { width: 15px; height: 15px; accent-color: #f5c842; cursor: pointer; }
        .remember-row label { font-size: 13px; color: rgba(255,240,200,0.55); cursor: pointer; font-weight: 300; }
        .btn-submit {
            display: block;
            width: 100%;
            padding: 13px;
            border-radius: 10px;
            font-family: 'Lato', sans-serif;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            cursor: pointer;
            border: none;
            background: linear-gradient(135deg, #d4931a, #f5c842);
            color: #1a0a00;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
            margin-bottom: 1rem;
        }
        .btn-submit:hover { box-shadow: 0 4px 20px rgba(245,200,66,0.4); transform: translateY(-1px); }
        .btn-submit:active { transform: scale(0.97); }
        .register-row { text-align: center; font-size: 13px; color: rgba(255,240,200,0.45); font-weight: 300; }
        .register-row a { color: #f5c842; font-weight: 700; text-decoration: none; }
        .register-row a:hover { text-decoration: underline; }
        .footer-txt { margin-top: 1.6rem; font-size: 11px; color: rgba(255,240,200,0.22); text-align: center; letter-spacing: 0.4px; }
    </style>
</head>
<body>

    <div class="stars-layer" id="stars"></div>
    <canvas id="steamCanvas"></canvas>

    <div class="card">

        {{-- Logo Kopi SVG --}}
        <div class="logo-wrap">
            <svg width="90" height="90" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <linearGradient id="cg2" x1="30" y1="45" x2="90" y2="100" gradientUnits="userSpaceOnUse">
                        <stop offset="0%" stop-color="#4a2000"/>
                        <stop offset="100%" stop-color="#2a0f00"/>
                    </linearGradient>
                    <linearGradient id="sg2" x1="20" y1="95" x2="100" y2="108" gradientUnits="userSpaceOnUse">
                        <stop offset="0%" stop-color="#5a2a08"/>
                        <stop offset="50%" stop-color="#8a4a18"/>
                        <stop offset="100%" stop-color="#5a2a08"/>
                    </linearGradient>
                    <clipPath id="cc2">
                        <path d="M36 50 L32 92 Q32 96 60 96 Q88 96 84 92 L80 50 Z"/>
                    </clipPath>
                </defs>
                <ellipse cx="60" cy="103" rx="38" ry="7" fill="url(#sg2)" stroke="#c8781a" stroke-width="0.8"/>
                <ellipse cx="60" cy="101" rx="28" ry="4" fill="#3d1800" stroke="#a06020" stroke-width="0.5" opacity="0.6"/>
                <path d="M36 50 L32 92 Q32 97 60 97 Q88 97 84 92 L80 50 Z" fill="url(#cg2)" stroke="#c8781a" stroke-width="1"/>
                <g clip-path="url(#cc2)">
                    <ellipse cx="60" cy="54" rx="22" ry="6" fill="#2a0f00"/>
                    <ellipse cx="60" cy="54" rx="20" ry="5.2" fill="none" stroke="#8a5020" stroke-width="1.5" opacity="0.5"/>
                    <path d="M60 58 C57 55 52 55 52 59 C52 62 56 65 60 68 C64 65 68 62 68 59 C68 55 63 55 60 58Z" fill="#c87830" opacity="0.7"/>
                    <circle cx="52" cy="52" r="2" fill="#d4921a" opacity="0.4"/>
                </g>
                <ellipse cx="60" cy="50" rx="22" ry="6" fill="none" stroke="#f5c842" stroke-width="2"/>
                <path d="M42 48 Q60 44 78 48" stroke="#f5c842" stroke-width="1" fill="none" opacity="0.5" stroke-linecap="round"/>
                <path d="M82 62 Q98 62 98 72 Q98 83 82 83" fill="none" stroke="#c8781a" stroke-width="4" stroke-linecap="round"/>
                <path d="M82 63 Q95 63 95 72 Q95 82 82 82" fill="none" stroke="#7a4010" stroke-width="2" stroke-linecap="round" opacity="0.5"/>
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
            </svg>
        </div>

        <div class="brand-name">WARKOP TAKARA</div>
        <div class="brand-sub">Kopi &amp; Cita Rasa</div>

        <div class="divider">
            <div class="divider-line"></div>
            <div class="divider-dot"></div>
            <div class="divider-line"></div>
        </div>

        <div class="section-title">Masuk Kasir</div>
        <div class="section-sub">Silakan masuk untuk melanjutkan ke sistem</div>

        {{-- Session status --}}
        @if (session('status'))
            <div class="status-msg">{{ session('status') }}</div>
        @endif

        {{-- Form --}}
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="field">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" required autofocus
                    placeholder="kamu@warkoptakara.id"
                    value="{{ old('email') }}">
                @error('email')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" required
                    placeholder="••••••••">
                @error('password')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="remember-row">
                <input id="remember_me" type="checkbox" name="remember">
                <label for="remember_me">Ingat saya</label>
            </div>

            <button type="submit" class="btn-submit">☕ Masuk</button>
        </form>

        <div class="register-row">
            Belum punya akun?
            <a href="{{ route('register') }}">Daftar sekarang</a>
        </div>

        <div class="footer-txt">
            &copy; {{ now()->year }} Warkop Takara. All rights reserved. Developed by Ruang Kode.
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