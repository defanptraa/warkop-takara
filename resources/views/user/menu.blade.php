<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Warkop Takara</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous"/>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background: #1a0a00;
            min-height: 100vh;
            font-family: 'Lato', sans-serif;
            overflow-x: hidden;
        }

        /* ── Background canvas ── */
        #bgCanvas { position: fixed; inset: 0; pointer-events: none; z-index: 0; }

        /* ── Floating beans ── */
        .f-bean {
            position: fixed;
            pointer-events: none;
            z-index: 0;
            animation: riseBean linear infinite;
            opacity: 0;
            font-size: 18px;
        }
        @keyframes riseBean {
            0%   { transform: translateY(105vh) rotate(0deg) scale(0.8);  opacity: 0; }
            8%   { opacity: 0.18; }
            92%  { opacity: 0.10; }
            100% { transform: translateY(-10vh) rotate(400deg) scale(1.1); opacity: 0; }
        }

        /* ── Stars ── */
        .star {
            position: fixed;
            border-radius: 50%;
            background: #fff8e1;
            animation: twinkle linear infinite;
            opacity: 0;
            pointer-events: none;
            z-index: 0;
        }
        @keyframes twinkle {
            0%, 100% { opacity: 0; transform: scale(0.5); }
            50%       { opacity: 0.5; transform: scale(1); }
        }

        /* ── Layout wrapper ── */
        .page-wrap {
            position: relative;
            z-index: 1;
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem 1.5rem 6rem;
        }

        /* ── Header ── */
        .page-header {
            text-align: center;
            margin-bottom: 3rem;
            padding-top: 1rem;
        }
        .header-logo {
            width: 70px;
            height: 70px;
            margin: 0 auto 0.8rem;
            animation: pulseGlow 3s ease-in-out infinite;
        }
        @keyframes pulseGlow {
            0%, 100% { filter: drop-shadow(0 0 4px rgba(210,160,80,0.3)); }
            50%       { filter: drop-shadow(0 0 16px rgba(210,160,80,0.7)); }
        }
        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(26px, 4vw, 42px);
            font-weight: 900;
            color: #f5c842;
            letter-spacing: 3px;
            text-shadow: 0 0 30px rgba(245,200,66,0.35);
            margin-bottom: 4px;
        }
        .page-sub {
            font-size: 13px;
            font-weight: 300;
            letter-spacing: 5px;
            color: rgba(245,200,100,0.6);
            text-transform: uppercase;
        }
        .header-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            max-width: 320px;
            margin: 1rem auto 0;
        }
        .hdl { flex: 1; height: 0.5px; background: rgba(210,160,80,0.4); }
        .hdd { width: 6px; height: 6px; border-radius: 50%; background: rgba(210,160,80,0.7); }

        /* ── Grid ── */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-right: 340px;
        }
        @media (max-width: 900px) { .menu-grid { margin-right: 0; } }

        /* ── Menu card ── */
        .menu-card {
            background: rgba(255,248,230,0.06);
            border: 0.5px solid rgba(210,160,80,0.25);
            border-radius: 18px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
            cursor: pointer;
        }
        .menu-card:hover {
            transform: translateY(-6px) scale(1.02);
            box-shadow: 0 12px 40px rgba(200,120,26,0.25);
            border-color: rgba(245,200,66,0.5);
        }
        .menu-card.added {
            animation: cardPop 0.4s cubic-bezier(0.36, 0.07, 0.19, 0.97);
        }
        @keyframes cardPop {
            0%   { transform: scale(1); }
            30%  { transform: scale(1.06); box-shadow: 0 0 30px rgba(245,200,66,0.5); }
            60%  { transform: scale(0.97); }
            100% { transform: scale(1); }
        }

        .card-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            display: block;
        }
        .card-img-placeholder {
            width: 100%;
            height: 180px;
            background: rgba(60,20,0,0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 8px;
        }
        .card-img-placeholder svg { width: 48px; height: 48px; opacity: 0.4; }
        .card-img-placeholder span { font-size: 12px; color: rgba(245,200,100,0.4); letter-spacing: 1px; }

        .card-body {
            padding: 1rem 1.1rem 1.1rem;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 0.8rem;
        }
        .card-name {
            font-family: 'Playfair Display', serif;
            font-size: 16px;
            font-weight: 700;
            color: #fff8e1;
            line-height: 1.3;
        }
        .card-desc {
            font-size: 12px;
            color: rgba(245,200,100,0.5);
            font-weight: 300;
            font-style: italic;
        }
        .card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 4px;
        }
        .card-price {
            font-size: 15px;
            font-weight: 700;
            color: #f5c842;
        }

        /* ── Add to cart button ── */
        .btn-add {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            border-radius: 30px;
            font-family: 'Lato', sans-serif;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.8px;
            border: none;
            cursor: pointer;
            background: linear-gradient(135deg, #d4931a, #f5c842);
            color: #1a0a00;
            transition: transform 0.15s, box-shadow 0.15s;
            position: relative;
            overflow: hidden;
        }
        .btn-add:hover {
            transform: scale(1.06);
            box-shadow: 0 4px 16px rgba(245,200,66,0.4);
        }
        .btn-add:active { transform: scale(0.95); }
        .btn-add .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.4);
            transform: scale(0);
            animation: rippleAnim 0.5s linear;
            pointer-events: none;
        }
        @keyframes rippleAnim {
            to { transform: scale(4); opacity: 0; }
        }

        /* ── Floating +1 toast ── */
        .plus-toast {
            position: fixed;
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            font-weight: 900;
            color: #f5c842;
            text-shadow: 0 0 10px rgba(245,200,66,0.6);
            pointer-events: none;
            z-index: 9999;
            animation: floatUp 0.9s ease forwards;
        }
        @keyframes floatUp {
            0%   { opacity: 1; transform: translateY(0) scale(1); }
            100% { opacity: 0; transform: translateY(-60px) scale(1.3); }
        }

        /* ── Cart panel ── */
        .cart-panel {
            position: fixed;
            top: 1.5rem;
            right: 1.5rem;
            width: 310px;
            background: rgba(26,10,0,0.9);
            border: 0.5px solid rgba(210,160,80,0.35);
            border-radius: 20px;
            padding: 1.5rem;
            z-index: 100;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            box-shadow: 0 8px 40px rgba(0,0,0,0.5);
        }
        @media (max-width: 900px) {
            .cart-panel {
                position: fixed;
                bottom: 0; right: 0; left: 0; top: auto;
                width: 100%;
                border-radius: 20px 20px 0 0;
                max-height: 55vh;
                overflow-y: auto;
            }
        }

        .cart-title {
            font-family: 'Playfair Display', serif;
            font-size: 18px;
            font-weight: 700;
            color: #f5c842;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 1rem;
            padding-bottom: 0.8rem;
            border-bottom: 0.5px solid rgba(210,160,80,0.25);
        }
        .cart-badge {
            background: linear-gradient(135deg, #d4931a, #f5c842);
            color: #1a0a00;
            font-size: 11px;
            font-weight: 900;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: auto;
            animation: badgePop 0.3s ease;
        }
        @keyframes badgePop {
            0%   { transform: scale(0.5); }
            60%  { transform: scale(1.3); }
            100% { transform: scale(1); }
        }

        .cart-empty {
            text-align: center;
            padding: 1.5rem 0;
        }
        .cart-empty svg { width: 40px; height: 40px; opacity: 0.25; margin: 0 auto 8px; display: block; }
        .cart-empty p { font-size: 13px; color: rgba(245,200,100,0.4); font-style: italic; font-weight: 300; }

        .cart-items { max-height: 240px; overflow-y: auto; padding-right: 4px; }
        .cart-items::-webkit-scrollbar { width: 3px; }
        .cart-items::-webkit-scrollbar-track { background: transparent; }
        .cart-items::-webkit-scrollbar-thumb { background: rgba(210,160,80,0.3); border-radius: 3px; }

        .cart-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 0.5px solid rgba(210,160,80,0.12);
            animation: slideIn 0.25s ease;
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(10px); }
            to   { opacity: 1; transform: translateX(0); }
        }
        .cart-item-name { font-size: 13px; color: #fff8e1; font-weight: 400; line-height: 1.3; }
        .cart-item-sub  { font-size: 11px; color: rgba(245,200,100,0.55); margin-top: 2px; }
        .cart-item-qty  {
            font-size: 12px;
            font-weight: 700;
            color: #f5c842;
            background: rgba(245,200,66,0.12);
            border-radius: 20px;
            padding: 2px 8px;
            margin: 0 8px;
            min-width: 28px;
            text-align: center;
        }
        .btn-remove {
            background: rgba(255,80,80,0.1);
            border: 0.5px solid rgba(255,80,80,0.3);
            color: rgba(255,120,120,0.8);
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 10px;
            transition: background 0.15s, color 0.15s;
            flex-shrink: 0;
        }
        .btn-remove:hover { background: rgba(255,80,80,0.25); color: #ff8080; }

        .cart-total {
            margin-top: 1rem;
            padding-top: 0.8rem;
            border-top: 0.5px solid rgba(210,160,80,0.25);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .cart-total-label { font-size: 12px; color: rgba(245,200,100,0.6); text-transform: uppercase; letter-spacing: 1px; }
        .cart-total-value { font-family: 'Playfair Display', serif; font-size: 18px; font-weight: 700; color: #f5c842; }

        .btn-checkout {
            display: block;
            width: 100%;
            margin-top: 1rem;
            padding: 13px;
            border-radius: 12px;
            font-family: 'Lato', sans-serif;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            cursor: pointer;
            border: none;
            background: linear-gradient(135deg, #d4931a, #f5c842);
            color: #1a0a00;
            transition: transform 0.15s, box-shadow 0.15s;
        }
        .btn-checkout:hover {
            box-shadow: 0 4px 20px rgba(245,200,66,0.45);
            transform: translateY(-1px);
        }
        .btn-checkout:active { transform: scale(0.97); }
        .btn-checkout:disabled {
            opacity: 0.4;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
    </style>
</head>

<body>
    <canvas id="bgCanvas"></canvas>

    <div class="page-wrap" x-data="menuApp({{ $products->toJson() }})">

        {{-- Header --}}
        <div class="page-header">
            <div class="header-logo">
                <svg width="70" height="70" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <linearGradient id="hcg" x1="30" y1="45" x2="90" y2="100" gradientUnits="userSpaceOnUse">
                            <stop offset="0%" stop-color="#4a2000"/>
                            <stop offset="100%" stop-color="#2a0f00"/>
                        </linearGradient>
                        <linearGradient id="hsg" x1="20" y1="95" x2="100" y2="108" gradientUnits="userSpaceOnUse">
                            <stop offset="0%" stop-color="#5a2a08"/>
                            <stop offset="50%" stop-color="#8a4a18"/>
                            <stop offset="100%" stop-color="#5a2a08"/>
                        </linearGradient>
                        <clipPath id="hcc">
                            <path d="M36 50 L32 92 Q32 96 60 96 Q88 96 84 92 L80 50 Z"/>
                        </clipPath>
                    </defs>
                    <ellipse cx="60" cy="103" rx="38" ry="7" fill="url(#hsg)" stroke="#c8781a" stroke-width="0.8"/>
                    <ellipse cx="60" cy="101" rx="28" ry="4" fill="#3d1800" stroke="#a06020" stroke-width="0.5" opacity="0.6"/>
                    <path d="M36 50 L32 92 Q32 97 60 97 Q88 97 84 92 L80 50 Z" fill="url(#hcg)" stroke="#c8781a" stroke-width="1"/>
                    <g clip-path="url(#hcc)">
                        <ellipse cx="60" cy="54" rx="22" ry="6" fill="#2a0f00"/>
                        <ellipse cx="60" cy="54" rx="20" ry="5.2" fill="none" stroke="#8a5020" stroke-width="1.5" opacity="0.5"/>
                        <path d="M60 58 C57 55 52 55 52 59 C52 62 56 65 60 68 C64 65 68 62 68 59 C68 55 63 55 60 58Z" fill="#c87830" opacity="0.7"/>
                    </g>
                    <ellipse cx="60" cy="50" rx="22" ry="6" fill="none" stroke="#f5c842" stroke-width="2"/>
                    <path d="M82 62 Q98 62 98 72 Q98 83 82 83" fill="none" stroke="#c8781a" stroke-width="4" stroke-linecap="round"/>
                    <path d="M47 44 Q44 38 47 32 Q50 26 47 20" stroke="#f5c842" stroke-width="1.5" fill="none" stroke-linecap="round">
                        <animate attributeName="d" dur="2.5s" repeatCount="indefinite" values="M47 44 Q44 38 47 32 Q50 26 47 20;M47 44 Q50 38 47 32 Q44 26 47 20;M47 44 Q44 38 47 32 Q50 26 47 20"/>
                        <animate attributeName="opacity" dur="2.5s" repeatCount="indefinite" values="0.7;0.15;0.7"/>
                    </path>
                    <path d="M60 42 Q57 35 60 28 Q63 21 60 14" stroke="#f5c842" stroke-width="1.5" fill="none" stroke-linecap="round">
                        <animate attributeName="d" dur="3s" repeatCount="indefinite" values="M60 42 Q57 35 60 28 Q63 21 60 14;M60 42 Q63 35 60 28 Q57 21 60 14;M60 42 Q57 35 60 28 Q63 21 60 14"/>
                        <animate attributeName="opacity" dur="3s" repeatCount="indefinite" values="0.9;0.15;0.9"/>
                    </path>
                    <path d="M73 44 Q76 38 73 32 Q70 26 73 20" stroke="#f5c842" stroke-width="1.2" fill="none" stroke-linecap="round">
                        <animate attributeName="d" dur="2s" repeatCount="indefinite" values="M73 44 Q76 38 73 32 Q70 26 73 20;M73 44 Q70 38 73 32 Q76 26 73 20;M73 44 Q76 38 73 32 Q70 26 73 20"/>
                        <animate attributeName="opacity" dur="2s" repeatCount="indefinite" values="0.5;0.1;0.5"/>
                    </path>
                </svg>
            </div>
            <div class="page-title">WARKOP TAKARA</div>
            <div class="page-sub">Menu Pilihan Hari Ini</div>
            <div class="header-divider">
                <div class="hdl"></div>
                <div class="hdd"></div>
                <div class="hdl"></div>
            </div>
        </div>

        {{-- Menu Grid --}}
        <div class="menu-grid">
            <template x-for="item in products" :key="item.id">
                <div class="menu-card" :id="'card-'+item.id">

                    {{-- Gambar --}}
                    <template x-if="item.gambar">
                        <img :src="'/storage/products/' + item.gambar" :alt="item.nama" class="card-img">
                    </template>
                    <template x-if="!item.gambar">
                        <div class="card-img-placeholder">
                            <svg viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <defs>
                                    <linearGradient id="pcg" x1="15" y1="22" x2="55" y2="60" gradientUnits="userSpaceOnUse">
                                        <stop offset="0%" stop-color="#4a2000"/>
                                        <stop offset="100%" stop-color="#2a0f00"/>
                                    </linearGradient>
                                    <clipPath id="pcc">
                                        <path d="M20 28 L18 54 Q18 57 36 57 Q54 57 52 54 L50 28 Z"/>
                                    </clipPath>
                                </defs>
                                <ellipse cx="36" cy="61" rx="22" ry="4" fill="#5a2a08" stroke="#c8781a" stroke-width="0.6"/>
                                <path d="M20 28 L18 54 Q18 57 36 57 Q54 57 52 54 L50 28 Z" fill="url(#pcg)" stroke="#c8781a" stroke-width="0.8"/>
                                <g clip-path="url(#pcc)">
                                    <ellipse cx="36" cy="31" rx="14" ry="4" fill="#2a0f00"/>
                                    <path d="M36 34 C33 32 29 32 29 35 C29 37 32 39 36 41 C40 39 43 37 43 35 C43 32 39 32 36 34Z" fill="#c87830" opacity="0.7"/>
                                </g>
                                <ellipse cx="36" cy="28" rx="14" ry="4" fill="none" stroke="#f5c842" stroke-width="1.2"/>
                                <path d="M50 36 Q58 36 58 42 Q58 49 50 49" fill="none" stroke="#c8781a" stroke-width="2.5" stroke-linecap="round"/>
                            </svg>
                            <span>Tidak ada gambar</span>
                        </div>
                    </template>

                    <div class="card-body">
                        <div>
                            <div class="card-name" x-text="item.nama"></div>
                            <div class="card-desc">Spesial Warkop Takara</div>
                        </div>
                        <div class="card-footer">
                            <div class="card-price" x-text="'Rp ' + item.harga.toLocaleString('id-ID')"></div>
                            <button class="btn-add" @click="addToCartAnim($event, item)">
                                <i class="fa-solid fa-cart-plus"></i>
                                <span>Tambah</span>
                            </button>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        {{-- Cart Panel --}}
        <div class="cart-panel">
            <div class="cart-title">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#f5c842" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                </svg>
                Keranjang
                <div class="cart-badge" x-show="cart.length > 0" x-text="cart.reduce((s,i)=>s+i.qty,0)" :key="cart.length"></div>
            </div>

            {{-- Empty state --}}
            <template x-if="cart.length === 0">
                <div class="cart-empty">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#f5c842" stroke-width="1.5">
                        <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                    </svg>
                    <p>Keranjang masih kosong.<br>Yuk pilih menu favoritmu!</p>
                </div>
            </template>

            {{-- Cart items --}}
            <div class="cart-items">
                <template x-for="item in cart" :key="item.id">
                    <div class="cart-item">
                        <div style="flex:1;min-width:0">
                            <div class="cart-item-name" x-text="item.nama"></div>
                            <div class="cart-item-sub" x-text="'Rp ' + (item.harga * item.qty).toLocaleString('id-ID')"></div>
                        </div>
                        <div class="cart-item-qty" x-text="'x'+item.qty"></div>
                        <button class="btn-remove" @click="removeFromCart(item.id)" title="Hapus">
                            <i class="fa-solid fa-trash" style="font-size:9px"></i>
                        </button>
                    </div>
                </template>
            </div>

            {{-- Total --}}
            <template x-if="cart.length > 0">
                <div class="cart-total">
                    <div class="cart-total-label">Total</div>
                    <div class="cart-total-value" x-text="'Rp ' + total.toLocaleString('id-ID')"></div>
                </div>
            </template>

            {{-- Checkout form --}}
            <form method="POST" action="{{ route('user.order.store') }}" @submit.prevent="submitOrder" x-ref="orderForm">
                @csrf
                <template x-for="(item, index) in cart" :key="item.id">
                    <div>
                        <input type="hidden" :name="`cart[${index}][id]`" :value="item.id">
                        <input type="hidden" :name="`cart[${index}][qty]`" :value="item.qty">
                    </div>
                </template>
                <button type="submit" class="btn-checkout" :disabled="cart.length === 0">
                    <i class="fa-solid fa-cash-register" style="margin-right:6px"></i>
                    Proses Pembayaran
                </button>
            </form>
        </div>

    </div><!-- /page-wrap -->

    <script>
        /* ── Background: stars + ambient glow ── */
        (function() {
            const canvas = document.getElementById('bgCanvas');
            const ctx = canvas.getContext('2d');
            let W, H;
            function resize() { W = canvas.width = window.innerWidth; H = canvas.height = window.innerHeight; }
            resize(); window.addEventListener('resize', resize);

            /* Stars */
            const starsEl = document.createElement('div');
            starsEl.style.cssText = 'position:fixed;inset:0;pointer-events:none;z-index:0';
            for (let i = 0; i < 60; i++) {
                const s = document.createElement('div');
                s.className = 'star';
                const sz = Math.random() * 2 + 0.8;
                s.style.cssText = `width:${sz}px;height:${sz}px;left:${Math.random()*100}%;top:${Math.random()*100}%;animation-duration:${2+Math.random()*4}s;animation-delay:${Math.random()*4}s;`;
                starsEl.appendChild(s);
            }
            document.body.appendChild(starsEl);

            /* Floating bean icons */
            const beanSymbols = ['☕','🫘','✦','◦','·','❋'];
            for (let i = 0; i < 14; i++) {
                const b = document.createElement('div');
                b.className = 'f-bean';
                b.textContent = beanSymbols[Math.floor(Math.random()*beanSymbols.length)];
                b.style.cssText = `left:${Math.random()*100}%;font-size:${10+Math.random()*18}px;animation-duration:${10+Math.random()*14}s;animation-delay:${Math.random()*12}s;`;
                document.body.appendChild(b);
            }

            /* Ambient glow particles */
            const particles = Array.from({length:25}, () => ({
                x: Math.random()*(W||1200), y: Math.random()*(H||800),
                vx:(Math.random()-.5)*.35, vy:-(0.25+Math.random()*.45),
                r:25+Math.random()*45, a:.035+Math.random()*.035, life:Math.random()
            }));
            function drawBg() {
                ctx.clearRect(0,0,W,H);
                for (const p of particles) {
                    p.x+=p.vx; p.y+=p.vy; p.life-=.003;
                    if(p.life<=0){p.x=Math.random()*W;p.y=H+20;p.life=.3+Math.random()*.7;p.vx=(Math.random()-.5)*.35;}
                    const g=ctx.createRadialGradient(p.x,p.y,0,p.x,p.y,p.r);
                    g.addColorStop(0,`rgba(180,110,30,${p.a*p.life})`);
                    g.addColorStop(1,'rgba(180,110,30,0)');
                    ctx.fillStyle=g;
                    ctx.beginPath();ctx.arc(p.x,p.y,p.r,0,Math.PI*2);ctx.fill();
                }
                requestAnimationFrame(drawBg);
            }
            drawBg();
        })();

        /* ── Alpine app ── */
        function menuApp(data) {
            return {
                products: data,
                cart: [],
                get total() {
                    return this.cart.reduce((sum, item) => sum + (item.harga * item.qty), 0);
                },
                addToCartAnim(event, item) {
                    /* Ripple effect on button */
                    const btn = event.currentTarget;
                    const ripple = document.createElement('span');
                    ripple.className = 'ripple';
                    const rect = btn.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    ripple.style.cssText = `width:${size}px;height:${size}px;left:${event.clientX-rect.left-size/2}px;top:${event.clientY-rect.top-size/2}px;`;
                    btn.appendChild(ripple);
                    setTimeout(() => ripple.remove(), 600);

                    /* Card pop animation */
                    const card = document.getElementById('card-' + item.id);
                    if (card) {
                        card.classList.remove('added');
                        void card.offsetWidth;
                        card.classList.add('added');
                        setTimeout(() => card.classList.remove('added'), 450);
                    }

                    /* Floating +1 label */
                    const toast = document.createElement('div');
                    toast.className = 'plus-toast';
                    toast.textContent = '+1';
                    toast.style.cssText = `left:${event.clientX - 14}px;top:${event.clientY - 10}px;`;
                    document.body.appendChild(toast);
                    setTimeout(() => toast.remove(), 950);

                    /* Add to cart logic */
                    this.addToCart(item);
                },
                addToCart(item) {
                    const found = this.cart.find(i => i.id === item.id);
                    if (found) { found.qty += 1; }
                    else { this.cart.push({...item, qty: 1}); }
                },
                removeFromCart(id) {
                    this.cart = this.cart.filter(item => item.id !== id);
                },
                submitOrder() {
                    if (this.cart.length === 0) {
                        alert('Silakan tambahkan item ke keranjang terlebih dahulu.');
                        return;
                    }
                    fetch('{{ route("user.order.store") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ cart: this.cart })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            window.location.href = '{{ route("user.pembayaran") }}';
                        } else {
                            alert(data.message || 'Terjadi kesalahan saat menyimpan pesanan.');
                        }
                    })
                    .catch(() => alert('Gagal mengirim pesanan ke server.'));
                }
            }
        }
    </script>
</body>
</html>