<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - Warkop Takara</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background: linear-gradient(160deg, #1a0a00 0%, #2a1200 55%, #1a0a00 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Lato', sans-serif;
            padding: 1rem;
        }

        .page-shell {
            width: 100%;
            max-width: 1100px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Simple static ambient glow — no JS particles, very light */
        body::before {
            content: '';
            position: fixed;
            top: -10%;
            left: 50%;
            width: 700px;
            height: 700px;
            transform: translateX(-50%);
            background: radial-gradient(circle, rgba(200,120,30,0.12) 0%, transparent 70%);
            pointer-events: none;
            z-index: 0;
        }

        .card {
            position: relative;
            z-index: 1;
            background: rgba(255,248,230,0.06);
            border: 0.5px solid rgba(210,160,80,0.3);
            border-radius: 22px;
            padding: clamp(1.5rem, 3vw, 2.2rem);
            width: 100%;
            max-width: 520px;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            box-shadow: 0 18px 50px rgba(0, 0, 0, 0.22);
        }

        .logo-mini { width: 56px; height: 56px; margin: 0 auto 0.8rem; display: block; }

        .title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.3rem, 2.8vw, 1.9rem);
            font-weight: 900;
            color: #f5c842;
            text-align: center;
            text-shadow: 0 0 20px rgba(245,200,66,0.3);
            margin-bottom: 4px;
            line-height: 1.3;
        }
        .subtitle {
            font-size: clamp(0.7rem, 1.6vw, 0.82rem);
            font-weight: 300;
            letter-spacing: 0.3em;
            color: rgba(245,200,100,0.55);
            text-transform: uppercase;
            text-align: center;
            margin-bottom: 1.6rem;
        }

        .divider { display:flex; align-items:center; gap:10px; margin:0 auto 1.6rem; max-width:240px; }
        .dl { flex:1; height:0.5px; background:rgba(210,160,80,0.35); }
        .dd { width:5px; height:5px; border-radius:50%; background:rgba(210,160,80,0.6); }

        /* ── Payment method buttons ── */
        .method-btn {
            display: flex;
            align-items: center;
            gap: 14px;
            width: 100%;
            padding: 1rem;
            border-radius: 14px;
            border: 0.5px solid rgba(210,160,80,0.3);
            background: rgba(255,248,230,0.04);
            cursor: pointer;
            margin-bottom: 12px;
            transition: transform 0.15s ease, border-color 0.2s ease, background 0.2s ease;
            text-align: left;
        }
        .method-btn:hover {
            transform: translateY(-2px);
            border-color: rgba(245,200,66,0.5);
            background: rgba(255,248,230,0.08);
        }
        .method-btn:active { transform: scale(0.98); }

        .method-icon {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }
        .icon-qris  { background: linear-gradient(135deg, #d4931a, #f5c842); color: #1a0a00; }
        .icon-debit { background: rgba(120,160,255,0.15); color: #9cb8ff; border: 0.5px solid rgba(120,160,255,0.4); }

        .method-text {
            flex: 1;
            min-width: 0;
        }
        .method-title {
            font-size: clamp(0.9rem, 2vw, 1rem);
            font-weight: 700;
            color: #fff8e1;
            margin-bottom: 2px;
        }
        .method-desc  {
            font-size: clamp(0.75rem, 1.8vw, 0.85rem);
            color: rgba(245,200,100,0.5);
            font-weight: 300;
            line-height: 1.4;
        }

        .method-arrow { color: rgba(245,200,100,0.4); font-size: 14px; }

        /* ── Modal ── */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(10,5,0,0.75);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 100;
            padding: 1rem;
        }
        .modal-box {
            position: relative;
            background: #1c0d02;
            border: 0.5px solid rgba(210,160,80,0.35);
            border-radius: 20px;
            padding: clamp(1.2rem, 3vw, 1.8rem);
            width: min(100%, 420px);
            text-align: center;
        }
        .modal-close {
            position: absolute;
            top: 12px; right: 14px;
            color: rgba(245,200,100,0.5);
            font-size: 22px;
            cursor: pointer;
            background: none;
            border: none;
            line-height: 1;
        }
        .modal-close:hover { color: #f5c842; }

        .modal-title {
            font-family: 'Playfair Display', serif;
            font-size: 18px;
            font-weight: 700;
            color: #f5c842;
            margin-bottom: 1rem;
        }
        .modal-img {
            width: min(100%, 240px);
            border-radius: 12px;
            margin: 0 auto 1rem;
            display: block;
            border: 4px solid #fff8e1;
        }
        .modal-note {
            font-size: 12.5px;
            color: rgba(245,200,100,0.55);
            font-weight: 300;
            line-height: 1.6;
        }

        .countdown-box {
            margin-top: 1rem;
            padding: 10px;
            border-radius: 10px;
            background: rgba(245,200,66,0.08);
            border: 0.5px solid rgba(245,200,66,0.25);
            font-size: 13px;
            color: #f5c842;
            font-weight: 700;
        }

        /* Debit modal */
        .debit-icon-big {
            width: 60px; height: 60px;
            border-radius: 50%;
            background: rgba(120,160,255,0.15);
            border: 0.5px solid rgba(120,160,255,0.4);
            display: flex; align-items: center; justify-content: center;
            font-size: 26px;
            margin: 0 auto 1rem;
            color: #9cb8ff;
        }

        .footer-txt {
            margin-top: 1.6rem;
            font-size: clamp(0.68rem, 1.7vw, 0.78rem);
            color: rgba(255,240,200,0.25);
            text-align: center;
            letter-spacing: 0.4px;
        }

        @media (min-width: 640px) {
            body {
                padding: 1.5rem;
            }

            .card {
                max-width: 620px;
            }

            .method-btn {
                padding: 1rem 1.1rem;
            }
        }

        @media (min-width: 992px) {
            body {
                padding: 2rem;
            }

            .page-shell {
                max-width: 1200px;
            }

            .card {
                max-width: 760px;
            }

            .modal-box {
                width: min(100%, 520px);
            }
        }
    </style>
</head>
<body>

    <main class="page-shell">
        <div class="card"
         x-data="{
            showQris: false,
            showDebit: false,
            countdown: 5,
            startQrisRedirect() {
                this.showQris = true;
                this.countdown = 5;
                const timer = setInterval(() => {
                    this.countdown--;
                    if (this.countdown <= 0) {
                        clearInterval(timer);
                        window.location.href = '{{ url('/') }}';
                    }
                }, 1000);
            }
         }">

        {{-- Mini logo --}}
        <svg class="logo-mini" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <linearGradient id="mcg" x1="30" y1="45" x2="90" y2="100" gradientUnits="userSpaceOnUse">
                    <stop offset="0%" stop-color="#4a2000"/><stop offset="100%" stop-color="#2a0f00"/>
                </linearGradient>
            </defs>
            <ellipse cx="60" cy="103" rx="38" ry="7" fill="#5a2a08" stroke="#c8781a" stroke-width="0.8"/>
            <path d="M36 50 L32 92 Q32 97 60 97 Q88 97 84 92 L80 50 Z" fill="url(#mcg)" stroke="#c8781a" stroke-width="1"/>
            <ellipse cx="60" cy="50" rx="22" ry="6" fill="none" stroke="#f5c842" stroke-width="2"/>
            <path d="M82 62 Q98 62 98 72 Q98 83 82 83" fill="none" stroke="#c8781a" stroke-width="4" stroke-linecap="round"/>
        </svg>

        <div class="title">Pilih Metode Pembayaran</div>
        <div class="subtitle">Warkop Takara</div>

        <div class="divider"><div class="dl"></div><div class="dd"></div><div class="dl"></div></div>

        {{-- QRIS --}}
        <button class="method-btn" @click="startQrisRedirect()" type="button">
            <div class="method-icon icon-qris">☕</div>
            <div class="method-text">
                <div class="method-title">Bayar via QRIS</div>
                <div class="method-desc">Scan kode QR untuk membayar instan</div>
            </div>
            <div class="method-arrow">›</div>
        </button>

        {{-- Debit --}}
        <button class="method-btn" @click="showDebit = true" type="button">
            <div class="method-icon icon-debit">💳</div>
            <div class="method-text">
                <div class="method-title">Bayar via Debit</div>
                <div class="method-desc">Pembayaran kartu langsung di kasir</div>
            </div>
            <div class="method-arrow">›</div>
        </button>

        <div class="footer-txt">
            &copy; {{ now()->year }} Warkop Takara. All rights reserved.
        </div>

        {{-- Modal QRIS --}}
        <div class="modal-overlay" x-show="showQris" x-transition style="display: none;">
            <div class="modal-box">
                <button class="modal-close" @click="showQris = false" type="button">&times;</button>
                <div class="modal-title">Scan QRIS untuk Membayar</div>
                <img src="{{ asset('assets/QRIS-Dummy.jpg') }}" alt="QRIS" class="modal-img">
                <div class="modal-note">Tunjukkan bukti pembayaran ke kasir setelah melakukan scan.</div>
                <div class="countdown-box">
                    Kembali ke halaman utama dalam <span x-text="countdown"></span> detik...
                </div>
            </div>
        </div>

        {{-- Modal Debit --}}
        <div class="modal-overlay" x-show="showDebit" x-transition style="display: none;">
            <div class="modal-box">
                <button class="modal-close" @click="showDebit = false" type="button">&times;</button>
                <div class="debit-icon-big">💳</div>
                <div class="modal-title">Pembayaran Debit</div>
                <div class="modal-note">
                    Silakan datang ke kasir untuk menyelesaikan pembayaran<br>menggunakan kartu debit Anda.
                </div>
            </div>
        </div>

        </div>
    </main>

</body>
</html>