<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Desa</title>
    <style>
        body { 
            margin: 0; 
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; 
            color: #1e293b; 
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden; /* Mencegah scrollbar muncul akibat partikel */
            position: relative;
            background-color: #0f172a; /* Warna dasar gelap agar efek partikel menyala terang */
        }

        /* Canvas khusus untuk menggambar efek partikel kursor */
        #particleCanvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none; /* Agar klik mouse bisa menembus canvas ke form login */
            z-index: 1;
        }

        .page { 
            width: 100%;
            padding: 20px; 
            display: flex;
            justify-content: center;
            position: relative;
            z-index: 2; /* Menempatkan form di atas canvas partikel */
        }

        /* Desain Card Glassmorphism Premium */
        .card { 
            width: 100%; 
            max-width: 420px; 
            background: rgba(255, 255, 255, 0.1); /* Transparan */
            backdrop-filter: blur(20px); /* Efek blur kaca tebal */
            -webkit-backdrop-filter: blur(20px);
            border-radius: 24px; 
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); 
            border: 1px solid rgba(255, 255, 255, 0.15); /* Garis tepi kaca lembut */
            padding: 40px 30px; 
            box-sizing: border-box;
        }

        .brand { 
            text-align: center; 
            margin-bottom: 28px; 
        }
        
        .brand-logo { 
            width: 80px; 
            height: 80px; 
            object-fit: contain; 
            margin-bottom: 16px; 
            border-radius: 12px; 
            padding: 4px;
            background: rgba(255, 255, 255, 0.9); /* Menjaga logo desa tetap terlihat kontras */
        }

        .brand h2 { 
            margin: 0 0 8px 0; 
            font-size: 1.35rem; 
            font-weight: 700;
            color: #ffffff; /* Mengubah teks ke putih agar terbaca di tema gelap */
        }

        .brand p { 
            margin: 0; 
            color: #94a3b8; 
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .form-group { 
            margin-bottom: 18px; 
        }

        label { 
            display: block; 
            font-weight: 600; 
            font-size: 0.9rem;
            margin-bottom: 6px; 
            color: #cbd5e1;
        }

        input { 
            width: 100%; 
            padding: 11px 14px; 
            border: 1px solid rgba(255, 255, 255, 0.2); 
            border-radius: 10px; 
            box-sizing: border-box; 
            font-size: 0.95rem;
            background-color: rgba(255, 255, 255, 0.08); 
            color: #ffffff;
            transition: all 0.2s ease;
        }

        input:focus {
            outline: none;
            border-color: #38bdf8;
            background-color: rgba(255, 255, 255, 0.15);
            box-shadow: 0 0 0 4px rgba(56, 189, 248, 0.25);
        }

        /* Gaya placeholder untuk tema gelap */
        input::placeholder {
            color: #64748b;
        }

        .password-container {
            position: relative;
        }

        .toggle-password-btn {
            position: absolute; 
            right: 12px; 
            top: 50%; 
            transform: translateY(-50%); 
            border: none; 
            background: transparent; 
            cursor: pointer; 
            font-size: 16px; 
            color: #94a3b8; 
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        button[type="submit"] { 
            width: 100%; 
            padding: 12px; 
            border: none; 
            border-radius: 10px; 
            background: #0284c7; 
            color: white; 
            cursor: pointer; 
            font-weight: 600; 
            font-size: 1rem;
            margin-top: 8px; 
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.3);
        }

        button[type="submit"]:hover {
            background: #0369a1;
            box-shadow: 0 6px 16px rgba(2, 132, 199, 0.4);
            transform: translateY(-1px);
        }

        .alert { 
            padding: 10px 14px; 
            border-radius: 10px; 
            background: rgba(239, 68, 68, 0.2); 
            color: #fca5a5; 
            margin-bottom: 16px; 
            font-size: 0.85rem;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .hint { 
            margin-top: 16px; 
            color: #94a3b8; 
            font-size: 0.85rem; 
            text-align: center; 
            line-height: 1.5;
        }

        .hint a {
            color: #38bdf8;
            text-decoration: none;
            font-weight: 600;
        }

        .hint a:hover {
            text-decoration: underline;
        }

        .demo-box {
            margin-top: 16px;
            padding-top: 14px;
            border-top: 1px dashed rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body>

<canvas id="particleCanvas"></canvas>

<div class="page">
    <div class="card">
        <div class="brand">
            @php
                $settingDesa = \App\Models\DesaSetting::first();
            @endphp

            @if($settingDesa && $settingDesa->logo_path)
                <img src="{{ asset('storage/' . $settingDesa->logo_path) }}" alt="Logo Desa" class="brand-logo">
            @else
                <img src="https://via.placeholder.com/90?text=LOGO" alt="Logo Default" class="brand-logo">
            @endif
            <h2>Login Sistem Pelayanan Desa</h2>
            <p>Masuk untuk mengelola data penduduk, surat, dan laporan.</p>
        </div>
        
        @if($errors->any())
            <div class="alert">{{ $errors->first() }}</div>
        @endif
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <div class="password-container">
                    <input id="password" type="password" name="password" placeholder="Masukkan password" required style="padding-right: 40px;">
                    <button type="button" id="togglePassword" aria-label="Lihat password" class="toggle-password-btn">
                        👁️
                    </button>
                </div>
            </div>

            <button type="submit">Masuk</button>
        </form>

        <div class="hint">
            <a href="{{ route('password.request') }}">Lupa password?</a>
        </div>

        <div class="hint demo-box">
            Demo: <b>Email</b> / <b>password</b><br>
            Belum punya akun? <a href="{{ route('register') }}">Registrasi</a>
        </div>
    </div>
</div>

<script>
    // 1. LOGIKA INTERAKSI MOUSE TRAIL (PARTIKEL BERGERAK)
    const canvas = document.getElementById('particleCanvas');
    const ctx = canvas.getContext('2d');

    let particlesArray = [];
    const mouse = { x: null, y: null };

    // Atur ulang ukuran canvas agar pas dengan layar penuh
    function resizeCanvas() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }
    window.addEventListener('resize', resizeCanvas);
    resizeCanvas();

    // Tangkap pergerakan kursor mouse
    window.addEventListener('mousemove', (event) => {
        mouse.x = event.clientX;
        mouse.y = event.clientY;
        
        // Buat 2 partikel baru setiap kali mouse bergeser
        for (let i = 0; i < 2; i++) {
            particlesArray.push(new Particle());
        }
    });

    // Cetakan/Blueprint Partikel Objek
    class Particle {
        constructor() {
            this.x = mouse.x;
            this.y = mouse.y;
            // Ukuran partikel acak antara 1px hingga 5px
            this.size = Math.random() * 4 + 1;
            // Kecepatan gerak acak menyebar (X dan Y)
            this.speedX = Math.random() * 2 - 1;
            this.speedY = Math.random() * 2 - 1;
            // Warna acak berbasis gradasi biru-cyan elektrik
            this.color = `hsl(${Math.random() * 40 + 190}, 100%, 70%)`;
            // Umur partikel (perlahan memudar)
            this.alpha = 1;
            this.decay = Math.random() * 0.015 + 0.01;
        }

        update() {
            this.x += this.speedX;
            this.y += this.speedY;
            this.alpha -= this.decay;
        }

        draw() {
            ctx.save();
            ctx.globalAlpha = this.alpha;
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
            ctx.fillStyle = this.color;
            // Efek neon/glow tipis pada partikel
            ctx.shadowBlur = 8;
            ctx.shadowColor = this.color;
            ctx.fill();
            ctx.restore();
        }
    }

    // Fungsi loop animasi untuk merender partikel secara berulang
    function animateParticles() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        
        for (let i = 0; i < particlesArray.length; i++) {
            particlesArray[i].update();
            particlesArray[i].draw();
            
            // Hapus partikel jika sudah transparan mati (alpha <= 0)
            if (particlesArray[i].alpha <= 0) {
                particlesArray.splice(i, 1);
                i--;
            }
        }
        requestAnimationFrame(animateParticles);
    }
    animateParticles();


    // 2. LOGIKA TOGGLE PASSWORD (MATA/PEEPING)
    (function(){
        const input = document.getElementById('password');
        const btn = document.getElementById('togglePassword');
        if(!input || !btn) return;

        btn.addEventListener('click', () => {
            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';
            btn.textContent = isPassword ? '🙈' : '👁️';
        });
    })();
</script>
</body>
</html>