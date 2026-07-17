<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Sistem Desa</title>
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
            background-color: #0f172a; /* Warna dasar gelap yang sama dengan Login & Registrasi */
        }

        /* Canvas khusus untuk menggambar efek partikel kursor */
        #particleCanvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none; 
            z-index: 1;
        }

        .page { 
            width: 100%;
            padding: 20px; 
            display: flex;
            justify-content: center;
            position: relative;
            z-index: 2; 
        }

        /* Desain Card Glassmorphism Premium */
        .card { 
            width: 100%; 
            max-width: 440px; 
            background: rgba(255, 255, 255, 0.1); 
            backdrop-filter: blur(20px); 
            -webkit-backdrop-filter: blur(20px);
            border-radius: 24px; 
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); 
            border: 1px solid rgba(255, 255, 255, 0.15); 
            padding: 40px 30px; 
            box-sizing: border-box;
        }

        .brand { 
            text-align: center; 
            margin-bottom: 24px; 
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
            color: #ffffff; 
        }

        .brand p { 
            margin: 0; 
            color: #94a3b8; 
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .form-group { 
            margin-bottom: 20px; 
        }

        label { 
            display: block; 
            font-weight: 600; 
            font-size: 0.9rem;
            margin-bottom: 8px; 
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

        input::placeholder {
            color: #64748b;
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
            margin-top: 6px; 
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.3);
        }

        button[type="submit"]:hover {
            background: #0369a1;
            box-shadow: 0 6px 16px rgba(2, 132, 199, 0.4);
            transform: translateY(-1px);
        }

        /* Notifikasi Alert Sukses / Bahaya */
        .alert { 
            padding: 11px 14px; 
            border-radius: 10px; 
            margin-bottom: 18px; 
            font-size: 0.85rem;
        }
        
        .alert-success { 
            background: rgba(16, 185, 129, 0.2); 
            color: #a7f3d0; 
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .alert-danger { 
            background: rgba(239, 68, 68, 0.2); 
            color: #fca5a5; 
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .hint { 
            margin-top: 24px; 
            color: #94a3b8; 
            font-size: 0.85rem; 
            text-align: center; 
            line-height: 1.5;
            padding-top: 14px;
            border-top: 1px dashed rgba(255, 255, 255, 0.1);
        }

        .hint a {
            color: #38bdf8;
            text-decoration: none;
            font-weight: 600;
        }

        .hint a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<canvas id="particleCanvas"></canvas>

<div class="page">
    <div class="card">
        <div class="brand">
            @php $settingDesa = \App\Models\DesaSetting::first(); @endphp
            @if($settingDesa && $settingDesa->logo_path)
                <img src="{{ asset('storage/' . $settingDesa->logo_path) }}" alt="Logo Desa" class="brand-logo">
            @else
                <img src="https://via.placeholder.com/90?text=LOGO" alt="Logo Default" class="brand-logo">
            @endif
            <h2>Lupa Password</h2>
            <p>Masukkan email admin</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required>
            </div>
            <button type="submit">Reset Password</button>
        </form>

        <div class="hint">
            Kembali ke <a href="{{ route('login') }}">Login</a>
        </div>
    </div>
</div>

<script>
    // LOGIKA INTERAKSI MOUSE TRAIL (KONSISTEN DENGAN LOGIN & REGISTRASI)
    const canvas = document.getElementById('particleCanvas');
    const ctx = canvas.getContext('2d');

    let particlesArray = [];
    const mouse = { x: null, y: null };

    function resizeCanvas() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }
    window.addEventListener('resize', resizeCanvas);
    resizeCanvas();

    window.addEventListener('mousemove', (event) => {
        mouse.x = event.clientX;
        mouse.y = event.clientY;
        
        for (let i = 0; i < 2; i++) {
            particlesArray.push(new Particle());
        }
    });

    class Particle {
        constructor() {
            this.x = mouse.x;
            this.y = mouse.y;
            this.size = Math.random() * 4 + 1;
            this.speedX = Math.random() * 2 - 1;
            this.speedY = Math.random() * 2 - 1;
            this.color = `hsl(${Math.random() * 40 + 190}, 100%, 70%)`; // Gradasi biru-cyan elektrik
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
            ctx.shadowBlur = 8;
            ctx.shadowColor = this.color;
            ctx.fill();
            ctx.restore();
        }
    }

    function animateParticles() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        
        for (let i = 0; i < particlesArray.length; i++) {
            particlesArray[i].update();
            particlesArray[i].draw();
            
            if (particlesArray[i].alpha <= 0) {
                particlesArray.splice(i, 1);
                i--;
            }
        }
        requestAnimationFrame(animateParticles);
    }
    animateParticles();
</script>
</body>
</html>