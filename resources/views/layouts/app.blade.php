<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Pelayanan Desa')</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg: #f8fafc; /* Lebih terang dan bersih */
            --card: #ffffff;
            --line: #f1f5f9; /* Border lebih tipis dan samar */
            --text: #0f172a;
            --muted: #64748b;
            --primary: #3b82f6; /* Biru modern yang lebih hidup */
            --primary-dark: #1d4ed8;
            --accent: #0ea5e9;
            --danger: #ef4444;
            --sidebar-bg: #0f172a; /* Slate dark premium, bukan hitam pekat */
            
            /* Shadow yang sangat halus dan mewah */
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 10px 15px -3px rgba(15, 23, 42, 0.05), 0 4px 6px -4px rgba(15, 23, 42, 0.05);
        }

        * { 
            box-sizing: border-box; 
            transition: background-color 0.2s ease, border-color 0.2s ease, color 0.2s ease, box-shadow 0.2s ease;
        }

        body { 
            margin: 0; 
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, Arial, sans-serif; 
            background: var(--bg); 
            color: var(--text);
            -webkit-font-smoothing: antialiased;
        }

        a { color: var(--primary); text-decoration: none; }

        .app-shell { display: flex; min-height: 100vh; }

        /* ==================== SIDEBAR ELEGAN ==================== */
        .sidebar { 
            width: 280px; 
            background: var(--sidebar-bg); 
            color: white; 
            padding: 24px 16px; 
            position: sticky; 
            top: 0; 
            height: 100vh; 
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            border-right: 1px solid rgba(255, 255, 255, 0.05);
        }

        .sidebar .brand { 
            font-size: 1.1rem; 
            font-weight: 700; 
            margin-bottom: 24px; 
            padding: 12px; 
            border-radius: 12px; 
            letter-spacing: -0.025em;
            background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.03));
            border: 1px solid rgba(255,255,255,0.08);
        }

        .sidebar .user { 
            display: flex; 
            gap: 12px; 
            align-items: center; 
            padding: 14px 12px; 
            border-radius: 12px; 
            margin-bottom: 24px; 
            background: rgba(255,255,255,0.03); 
            border: 1px solid rgba(255,255,255,0.05);
        }

        .sidebar .user .avatar { 
            width: 40px; 
            height: 40px; 
            border-radius: 10px; 
            background: var(--primary);
            color: white;
            display: grid;
            place-items: center;
            font-weight: 700;
        }

        .sidebar .user .meta { line-height: 1.4; }
        .sidebar .user .meta .name { font-weight: 600; font-size: 0.9rem; color: #f8fafc; }
        .sidebar .user .meta .role { color: #94a3b8; font-size: 0.75rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; }

        .sidebar .nav { width: 100%; flex: 1; }
        .sidebar .nav .links { display: flex; flex-direction: column; gap: 4px; }
        
        .sidebar .nav .links a { 
            color: #94a3b8; 
            padding: 12px 14px; 
            border-radius: 10px; 
            font-size: 0.9rem; 
            font-weight: 500;
            display: flex; 
            align-items: center; 
            gap: 12px;
            background: transparent;
            border: 1px solid transparent;
        }

        /* Hover biasa */
        .sidebar .nav .links a:hover { 
            color: #ffffff; 
            background: rgba(255, 255, 255, 0.05); 
        }

        /* MENU AKTIF (Active State saat halaman sedang diakses) */
        .sidebar .nav .links a.active {
            color: #ffffff;
            background: var(--primary);
            border-color: rgba(255, 255, 255, 0.1);
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.25); /* Glow biru soft */
        }

        .sidebar .logout { margin-top: auto; padding-top: 16px; }
        .sidebar .logout button { 
            width: 100%; 
            padding: 12px; 
            border-radius: 10px; 
            border: 1px solid rgba(255,255,255,0.1); 
            background: transparent; 
            color: #f1f5f9; 
            font-weight: 600; 
            font-size: 0.9rem;
            cursor: pointer; 
        }
        .sidebar .logout button:hover { 
            background: var(--danger); 
            border-color: var(--danger);
            color: white; 
        }

        /* ==================== MAIN CONTENT & TOPBAR ==================== */
        .main { flex: 1; display: flex; flex-direction: column; min-width: 0; }

        .topbar { 
            background: rgba(255, 254, 254, 0); /* Glassmorphism */
            color: var(--text); 
            padding: 16px 32px; 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            position: sticky; 
            top: 0; 
            z-index: 20; 
        }

        .hamburger { 
            display: none; 
            border: 1px solid var(--line); 
            background: var(--card); 
            color: var(--text); 
            border-radius: 8px; 
            padding: 8px 12px; 
            cursor: pointer; 
            font-size: 1.1rem;
        }

        .topbar .title { font-weight: 700; font-size: 1.1rem; letter-spacing: -0.02em; }

        /* ==================== CONTAINER & CARDS ==================== */
        .container { max-width: 1200px; width: 100%; margin: 0 auto; padding: 32px; }

        .hero { 
            background: linear-gradient(135deg, #ffffff 0%, #f1f5f9 100%); 
            border: 1px solid var(--line); 
            border-radius: 16px; 
            padding: 32px; 
            box-shadow: var(--shadow-sm); 
            margin-bottom: 32px; 
            display: flex; 
            justify-content: space-between; 
            gap: 24px; 
            align-items: center; 
        }
        .hero h1 { margin: 0 0 6px; font-size: 1.5rem; font-weight: 700; letter-spacing: -0.02em; }
        .hero p { margin: 0; color: var(--muted); font-size: 0.95rem; line-height: 1.5; }

        .card { 
            background: var(--card); 
            border: 1px solid var(--line); 
            border-radius: 16px; 
            padding: 24px; 
            box-shadow: var(--shadow-sm); 
        }
        .card:hover {
            box-shadow: var(--shadow-md);
        }

        .chip { 
            display: inline-block; 
            padding: 6px 12px; 
            background: #eff6ff; 
            color: var(--primary-dark); 
            border-radius: 999px; 
            font-size: 0.8rem; 
            font-weight: 600;
            margin-bottom: 12px; 
        }

        /* GRID & STATS */
        .grid { display: grid; gap: 24px; }
        .grid-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .grid-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        
        .stats { 
            display: grid; 
            gap: 20px; 
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); 
            margin-bottom: 32px; 
        }
        .stat { 
            background: var(--card); 
            border: 1px solid var(--line); 
            border-radius: 16px; 
            padding: 24px; 
            box-shadow: var(--shadow-sm); 
        }
        .stat .label { color: var(--muted); font-size: 0.85rem; font-weight: 500; }
        .stat .value { font-size: 1.75rem; font-weight: 700; margin-top: 8px; letter-spacing: -0.03em; color: var(--text); }

        /* TABLES */
        .table-wrap { overflow-x: auto; border: 1px solid var(--line); border-radius: 12px; background: white; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 14px 18px; border-bottom: 1px solid var(--line); font-size: 0.9rem; }
        th { color: var(--muted); font-weight: 600; background: #f8fafc; text-align: left; }
        tr:last-child td { border-bottom: none; }

        /* BUTTONS & FORMS */
        .btn { 
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 18px; 
            border-radius: 10px; 
            border: none; 
            cursor: pointer; 
            font-weight: 600; 
            font-size: 0.9rem;
            box-shadow: var(--shadow-sm);
        }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--primary-dark); }
        .btn-outline { border: 1px solid var(--line); color: var(--text); background: white; }
        .btn-outline:hover { background: #f8fafc; }
        
        .form-group { margin-bottom: 16px; }
        label { display: block; font-weight: 500; font-size: 0.85rem; margin-bottom: 6px; color: var(--text); }
        input, select, textarea { 
            width: 100%; 
            padding: 10px 14px; 
            border: 1px solid #cbd5e1; 
            border-radius: 10px; 
            background: #ffffff; 
            font-family: inherit;
            font-size: 0.9rem;
        }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }

        /* ALERTS */
        .alert { padding: 14px 18px; border-radius: 10px; margin-bottom: 20px; font-size: 0.9rem; font-weight: 500; }
        .alert-success { background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; }
        .alert-danger { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }

        .flex { display: flex; gap: 12px; flex-wrap: wrap; }
        .muted { color: var(--muted); }

        /* RESPONSIVE DESIGN */
        @media (max-width: 980px) { 
            .sidebar { display: none; } 
            .hamburger { display: inline-flex; } 
            .topbar { padding: 16px 20px; }
            .container { padding: 20px; } 
            .sidebar.mobile-open { display: flex; position: fixed; z-index: 50; left: 0; top: 0; }
        }
        @media (max-width: 640px) {
            .grid-2, .grid-3 { grid-template-columns: 1fr; }
            .hero { padding: 20px; flex-direction: column; align-items: flex-start; }
        }

        .overlay { display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.3); backdrop-filter: blur(4px); z-index: 40; }
        .overlay.show { display: block; }
    </style>
</head>
<body>
<div class="app-shell">
    @auth
    <aside class="sidebar" id="sidebar">
        <div class="brand">Sistem Desa Bojongloa</div>

        <div class="user">
            <div class="avatar">{{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}</div>
            <div class="meta">
                <div class="name">{{ Auth::user()->name }}</div>
                <div class="role">{{ Auth::user()->role ?? 'admin' }}</div>
            </div>
        </div>
        
        <nav class="nav">
            <div class="links">
                <a href="{{ route('dashboard.index') }}" class="{{ Route::is('dashboard.*') ? 'active' : '' }}">
                    <span aria-hidden>🏠</span> Dashboard
                </a>
                <a href="{{ route('penduduk.index') }}" class="{{ Route::is('penduduk.*') ? 'active' : '' }}">
                    <span aria-hidden>👥</span> Penduduk
                </a>
                <a href="{{ route('pengajuan-surat.index') }}" class="{{ Route::is('pengajuan-surat.*') ? 'active' : '' }}">
                    <span aria-hidden>📄</span> Pengajuan Surat
                </a>
                <a href="{{ route('laporan.index') }}" class="{{ Route::is('laporan.*') ? 'active' : '' }}">
                    <span aria-hidden>🧾</span> Laporan
                </a>

            </div>
        </nav>

        <div class="logout">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </aside>

    <div class="main">
        <header class="topbar">
            <button class="hamburger" id="hamburger" type="button">☰</button>
            <div class="links" style="display:none;"></div>
        </header>

        <div class="overlay" id="overlay"></div>
        <div class="container">
            @yield('content')
        </div>
    </div>
    @else
        <div class="container">
            @yield('content')
        </div>
    @endauth
</div>

<script>
    (function(){
        const hamburger = document.getElementById('hamburger');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        if(!hamburger || !sidebar || !overlay) return;

        const setHamburgerState = (isOpen) => {
            hamburger.textContent = isOpen ? '✕' : '☰';
        };

        const open = () => {
            sidebar.classList.add('mobile-open');
            overlay.classList.add('show');
            setHamburgerState(true);
        };
        const close = () => {
            sidebar.classList.remove('mobile-open');
            overlay.classList.remove('show');
            setHamburgerState(false);
        };

        hamburger.addEventListener('click', () => {
            const isOpen = sidebar.classList.contains('mobile-open');
            if (isOpen) close();
            else open();
        });

        overlay.addEventListener('click', close);
        window.addEventListener('resize', () => {
            if(window.innerWidth > 980) close();
        });
    })();
</script>
</body>
</html>