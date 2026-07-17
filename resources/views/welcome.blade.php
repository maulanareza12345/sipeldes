<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Sistem Pelayanan Desa Bojongloa') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <style>
            :root {
                --bg: #0b111e;
                --card: #131c2e;
                --line: #1f2d47;
                --text: #f8fafc;
                --text-muted: #94a3b8;
                --primary: #3b82f6;
                --accent: #f59e0b;
                --accent-rgb: 245, 158, 11;
                --radius-lg: 24px;
                --radius-md: 16px;
                --shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.5);
            }

            * { box-sizing: border-box; }
            html { scroll-behavior: smooth; }

            body {
                margin: 0;
                font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, Arial, sans-serif;
                background: var(--bg);
                color: var(--text);
                -webkit-font-smoothing: antialiased;
                line-height: 1.6;
            }

            a { color: inherit; text-decoration: none; transition: all 0.25s ease; }

            .wrap { max-width: 1200px; margin: 0 auto; padding: 40px 24px; }

            /* Navbar */
            .nav {
                position: sticky; top: 0; z-index: 100;
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                background: rgba(11, 17, 30, 0.8);
                border-bottom: 1px solid var(--line);
            }
            .nav-inner {
                max-width: 1200px; margin: 0 auto; padding: 18px 24px;
                display: flex; align-items: center; justify-content: space-between; gap: 20px;
            }
            .brand {
                font-weight: 800; font-size: 16px; letter-spacing: -0.03em;
                display: flex; align-items: center; gap: 12px;
            }
            .brand img { width: 36px; height: 36px; border-radius: 10px; object-fit: cover; }
            
            /* Diperbarui: Ditambahkan margin-left: auto agar menempel ke kanan mendekati Login */
            .menu { 
                display: flex; 
                align-items: center; 
                gap: 8px; 
                margin-left: auto; 
            }
            .menu a {
                font-weight: 600; font-size: 14px; color: var(--text-muted);
                padding: 8px 16px; border-radius: 12px;
            }
            .menu a:hover { color: var(--text); background: rgba(255,255,255,0.05); }

            .btn {
                display: inline-flex; align-items: center; justify-content: center;
                padding: 10px 22px; border-radius: 12px;
                font-weight: 700; font-size: 14px; border: 1px solid var(--line);
                background: rgba(255,255,255,0.03); color: var(--text);
                cursor: pointer; transition: all 0.2s ease;
            }
            .btn:hover { background: rgba(255,255,255,0.08); border-color: var(--text-muted); }
            .btn-primary { 
                background: linear-gradient(135deg, var(--accent) 0%, #d97706 100%); 
                border: none; color: #0f172a; 
                box-shadow: 0 4px 20px rgba(var(--accent-rgb), 0.3);
            }
            .btn-primary:hover { 
                transform: translateY(-1px); 
                box-shadow: 0 6px 24px rgba(var(--accent-rgb), 0.4);
                background: linear-gradient(135deg, #f59e0b 0%, #b45309 100%);
            }

            /* Hero Section */
            .hero {
                position: relative;
                background: linear-gradient(rgba(19, 28, 46, 0.8), rgba(19, 28, 46, 0.95)), 
                            url('https://images.unsplash.com/photo-1596436889106-be35e843f974?auto=format&fit=crop&w=1200&q=80') center/cover;
                border: 1px solid var(--line);
                border-radius: var(--radius-lg);
                padding: 60px;
                margin-top: 24px;
                display: grid;
                grid-template-columns: 1.2fr 0.8fr;
                gap: 48px;
                align-items: center;
                box-shadow: var(--shadow);
                overflow: hidden;
            }
            .hero h1 { margin: 0 0 16px; font-size: 42px; line-height: 1.2; letter-spacing: -0.04em; font-weight: 800; color: #fff; }
            .hero p { margin: 0; color: var(--text-muted); font-size: 16px; font-weight: 500; line-height: 1.7; }

            .hero-card { display: flex; flex-direction: column; gap: 14px; z-index: 2; }
            .hero-card .kpi {
                display: flex; align-items: center; justify-content: space-between;
                gap: 16px; border: 1px solid var(--line); border-radius: var(--radius-md);
                padding: 16px 20px; background: rgba(11, 17, 30, 0.7); backdrop-filter: blur(8px);
                transition: all 0.3s ease;
            }
            .hero-card .kpi:hover { transform: translateX(6px); border-color: var(--accent); }
            .hero-card .kpi .label { color: var(--text-muted); font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 2px; }
            .hero-card .kpi .value { font-size: 18px; font-weight: 800; color: #fff; }
            .kpi-icon { width: 42px; height: 42px; border-radius: 10px; background: rgba(var(--accent-rgb), 0.1); color: var(--accent); display: flex; align-items: center; justify-content: center; font-size: 18px; }

            /* Global Sections */
            .section { padding: 54px 0; }
            .section-header { display: flex; flex-direction: column; margin-bottom: 36px; }
            .section h2 { margin: 0 0 10px; font-size: 28px; font-weight: 800; letter-spacing: -0.03em; color: #fff; }
            .section h2 span { color: var(--accent); }
            .section .sub { margin: 0; color: var(--text-muted); font-size: 16px; font-weight: 500; max-width: 720px; }

            /* Grid Layout & Cards */
            .grid-2 { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 24px; }
            .grid-3 { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 24px; }
            
            .card {
                background: var(--card);
                border: 1px solid var(--line);
                border-radius: var(--radius-md);
                padding: 28px;
                box-shadow: var(--shadow);
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                position: relative;
                overflow: hidden;
            }
            .card::before {
                content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 3px;
                background: linear-gradient(90deg, transparent, var(--accent), transparent);
                opacity: 0; transition: opacity 0.3s ease;
            }
            .card:hover { transform: translateY(-6px); border-color: rgba(var(--accent-rgb), 0.3); }
            .card:hover::before { opacity: 1; }
            
            .card-icon {
                width: 46px; height: 46px; border-radius: 12px; background: rgba(255,255,255,0.03);
                color: var(--accent); display: flex; align-items: center; justify-content: center;
                margin-bottom: 20px; font-size: 20px; border: 1px solid var(--line);
            }
            .feature-title { font-weight: 800; font-size: 18px; margin: 0 0 10px; color: #fff; }
            .feature-desc { margin: 0; color: var(--text-muted); font-weight: 500; font-size: 14px; line-height: 1.6; }

            /* Profil khusus dengan gambar */
            .profile-showcase {
                display: grid; grid-template-columns: 1fr 1.4fr; gap: 32px;
                background: var(--card); border: 1px solid var(--line);
                border-radius: var(--radius-lg); overflow: hidden; margin-bottom: 32px;
                box-shadow: var(--shadow);
            }
            .profile-img {
                background: url('https://images.unsplash.com/photo-1605000797499-95a51c5269ae?auto=format&fit=crop&w=800&q=80') center/cover;
                min-height: 300px;
            }
            .profile-content { padding: 40px; display: flex; flex-direction: column; justify-content: center; gap: 16px; }

            /* Visi Misi Section Styles */
            .visi-box {
                background: linear-gradient(135deg, rgba(19, 28, 46, 0.9) 0%, rgba(15, 23, 42, 0.95) 100%);
                border: 1px solid rgba(var(--accent-rgb), 0.2);
                border-radius: var(--radius-lg);
                padding: 40px;
                text-align: center;
                margin-bottom: 24px;
                box-shadow: var(--shadow);
            }
            .visi-tagline {
                font-size: 22px; font-weight: 800; color: var(--accent);
                letter-spacing: 0.05em; margin: 10px 0 20px;
            }
            .visi-text {
                font-size: 18px; font-weight: 600; line-height: 1.8;
                color: #fff; max-width: 900px; margin: 0 auto;
            }

            /* Misi List Styles */
            .misi-list { margin: 0; padding: 0; list-style: none; display: flex; flex-direction: column; gap: 12px; }
            .misi-list li {
                padding: 14px 18px; background: rgba(11, 17, 30, 0.4); border-radius: 12px;
                font-weight: 600; font-size: 14px; color: #fff;
                display: flex; align-items: flex-start; justify-content: flex-start; gap: 12px; 
                line-height: 1.5; border: 1px solid var(--line);
            }
            .misi-list li::before {
                content: '•'; color: var(--accent); font-size: 18px; font-weight: 900; line-height: 1;
            }

            /* Kontak Section */
            .contact-grid { display: grid; grid-template-columns: 1fr 1.5fr; gap: 32px; }
            .contact-info-card { display: flex; flex-direction: column; gap: 16px; }
            .contact-item {
                display: flex; gap: 16px; background: var(--card); border: 1px solid var(--line);
                padding: 18px; border-radius: var(--radius-md); box-shadow: var(--shadow);
            }
            .contact-item-icon {
                font-size: 20px; color: var(--accent); min-width: 24px;
            }
            .contact-item-label { font-size: 12px; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 4px; }
            .contact-item-value { font-size: 14px; font-weight: 600; color: #fff; }

            /* Map Box */
            .map-embed-wrap {
                padding: 10px; border-radius: var(--radius-lg);
                border: 1px solid var(--line); background: var(--card); box-shadow: var(--shadow);
                overflow: hidden; height: 100%;
            }
            iframe { border: 0; width: 100%; height: 100%; min-height: 340px; border-radius: calc(var(--radius-lg) - 10px); display: block; filter: grayscale(0.9) invert(0.9) contrast(1.2); opacity: 0.85; }

            /* Footer */
            footer {
                margin-top: 80px; padding: 32px 0; border-top: 1px solid var(--line);
                color: var(--text-muted); font-weight: 600; font-size: 14px; text-align: center;
            }

            /* Responsive */
            @media (max-width: 960px) {
                .hero { grid-template-columns: 1fr; padding: 40px; gap: 32px; }
                .hero h1 { font-size: 32px; }
                .profile-showcase { grid-template-columns: 1fr; }
                .profile-img { height: 200px; min-height: 200px; }
                .grid-2, .grid-3, .contact-grid { grid-template-columns: 1fr; }
                .menu { display: none; }
            }
        </style>
    </head>
    <body>
        <header class="nav">
            <div class="nav-inner">
                <div class="brand">
                    <img src="{{ asset('images/Logo.jpg') }}" alt="Logo Desa Bojongloa">
                    <span>Desa Bojongloa</span>
                </div>

                <nav class="menu" aria-label="Menu Landing">
                    <a href="#profil">Profil</a>
                    <a href="#visimisi">Visi Misi</a>
                    <a href="#fitur">Fitur</a>
                    <a href="#lokasi">Kontak</a>
                </nav>

                <div class="nav-cta">
                    @auth
                        <a class="btn btn-primary" href="{{ url('/dashboard') }}">Dashboard</a>
                    @else
                        <a class="btn btn-primary" href="{{ route('login') }}">Log in</a>
                    @endauth
                </div>
            </div>
        </header>

        <main class="wrap">
            <!-- Hero Section -->
            <div class="hero">
                <div>
                    <h1>Pelayanan Administrasi Desa, Cepat & Terarah</h1>
                    <p>
                        Sistem Informasi Pelayanan Terpadu Desa Bojongloa memudahkan warga dalam pengajuan berkas administrasi mandiri secara efisien, transparan, dan terstruktur.
                    </p>
                </div>

                <div class="hero-card">
                    <div class="kpi">
                        <div>
                            <div class="label">Fokus Layanan</div>
                            <div class="value">Administrasi</div>
                        </div>
                        <div class="kpi-icon">📄</div>
                    </div>
                    <div class="kpi">
                        <div>
                            <div class="label">Akses Dokumen</div>
                            <div class="value">Publik & Terbuka</div>
                        </div>
                        <div class="kpi-icon">🔎</div>
                    </div>
                    <div class="kpi">
                        <div>
                            <div class="label">Wilayah Kantor</div>
                            <div class="value">Rancaekek</div>
                        </div>
                        <div class="kpi-icon">🗺️</div>
                    </div>
                </div>
            </div>

            <!-- 1) Profil Singkat Desa Showcase -->
            <section id="profil" class="section">
                <div class="section-header">
                    <h2>Profil Singkat <span>Desa</span></h2>
                    <p class="sub">Mengenal tata kelola digital wilayah Desa Bojongloa, Kecamatan Rancaekek.</p>
                </div>

                <div class="profile-showcase">
                    <div class="profile-img"></div>
                    <div class="profile-content">
                        <p class="feature-desc" style="font-size: 15px; color: var(--text); line-height: 1.7; margin: 0;">
                            Desa Bojongloa adalah desa yang terus berkembang di Kecamatan Rancaekek, Kabupaten Bandung. Dengan semangat gotong royong dan dukungan penuh dari berbagai lembaga desa seperti BPD, LPMD, PKK, dan Karang Taruna, pemerintah desa berkomitmen untuk selalu memberikan pelayanan administrasi yang terbaik, cepat, dan responsif bagi seluruh warga.
                        </p>
                        <p class="feature-desc" style="font-size: 15px; color: var(--text-muted); line-height: 1.7; margin: 0;">
                            Sebagai wujud nyata dari komitmen tersebut, kini Pemerintah Desa Bojongloa menghadirkan Sistem Pelayanan Administrasi Online. Melalui platform digital ini, warga dapat mengajukan dan mengurus berbagai kebutuhan surat-menyurat secara mandiri dengan lebih praktis, mudah, dan tanpa perlu mengantre lama.
                        </p>
                    </div>
                </div>

                <div class="grid-3">
                    <div class="card">
                        <div class="card-icon">🏛️</div>
                        <div class="feature-title">Identitas Desa</div>
                        <p class="feature-desc">Pelopor keterbukaan informasi pelayanan administrasi kependudukan di tingkat kelurahan.</p>
                    </div>
                    <div class="card">
                        <div class="card-icon">🎯</div>
                        <div class="feature-title">Tujuan Utama</div>
                        <p class="feature-desc">Memangkas birokrasi konvensional, mengurangi waktu antrean fisik di kantor desa.</p>
                    </div>
                    <div class="card">
                        <div class="card-icon">🔓</div>
                        <div class="feature-title">Ketersediaan Data</div>
                        <p class="feature-desc">Akses info publik dibuka secara umum demi transparansi alur pengajuan dokumen kependudukan.</p>
                    </div>
                </div>
            </section>

            <!-- 2) Visi & Misi Section -->
            <section id="visimisi" class="section">
                <div class="section-header">
                    <h2>Visi & <span>Misi</span></h2>
                    <p class="sub">Prinsip fundamental arah gerak kemajuan pembangunan Desa Bojongloa.</p>
                </div>

                <div class="visi-box">
                    <div class="card-icon" style="margin: 0 auto 12px;">🌟</div>
                    <div class="feature-title" style="font-size: 24px; margin-bottom: 0;">VISI</div>
                    <div class="visi-tagline">"BERSIH, RELIGIUS, SEJAHTERA, RAPI, DAN INDAH"</div>
                    <p class="visi-text">
                        "Terwujudnya masyarakat Desa Bojongloa yang Bersih, Religius, Sejahtera, Rapi dan Indah melalui Akselerasi Pembangunan yang berbasis Keagamaan, Budaya Hukum dan Berwawasan Lingkungan dengan berorientasi pada peningkatan Kinerja Aparatur dan Pemberdayaan Masyarakat"
                    </p>
                </div>

                <div class="grid-2">
                    <div class="card">
                        <div class="card-icon">📈</div>
                        <div class="feature-title">1. Pembangunan Jangka Panjang</div>
                        <ul class="misi-list">
                            <li>Melanjutkan pembangunan desa yang belum terlaksana.</li>
                            <li>Meningkatkan kerjasama antara pemerintah desa dengan lembaga desa yang ada.</li>
                            <li>Meningkatkan kesejahteraan masyarakat desa dengan meningkatkan sarana dan prasarana ekonomi warga.</li>
                        </ul>
                    </div>
                    <div class="card">
                        <div class="card-icon">⏳</div>
                        <div class="feature-title">2. Pembangunan Jangka Pendek</div>
                        <ul class="misi-list">
                            <li>Mengembangkan, menjaga, serta melestarikan adat istiadat desa terutama yang telah mengakar di Desa Bojongloa.</li>
                            <li>Meningkatkan pelayanan dalam bidang pemerintahan kepada warga masyarakat.</li>
                            <li>Meningkatkan sarana dan prasarana ekonomi warga desa dengan perbaikan prasarana dan sarana ekonomi.</li>
                            <li>Meningkatkan sarana dan prasarana pendidikan guna peningkatan sumber daya manusia Desa Bojongloa.</li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- 3) Fitur Layanan -->
            <section id="fitur" class="section">
                <div class="section-header">
                    <h2>Fitur Layanan <span>Aplikasi</span></h2>
                    <p class="sub">Ragam solusi digital yang dapat diakses guna mempermudah urusan surat-menyurat Anda.</p>
                </div>

                <div class="grid-3">
                    <div class="card">
                        <div class="card-icon">✉️</div>
                        <div class="feature-title">Pengajuan Surat</div>
                        <p class="feature-desc">Permohonan dokumen administrasi mandiri secara daring sesuai dengan kategori yang dibutuhkan warga.</p>
                    </div>
                    <div class="card">
                        <div class="card-icon">🔄</div>
                        <div class="feature-title">Verifikasi & Status</div>
                        <p class="feature-desc">Lacak kemajuan dokumen secara berkala lewat indikator status yang informatif (Pending/Disetujui/Ditolak).</p>
                    </div>
                    <div class="card">
                        <div class="card-icon">⬇️</div>
                        <div class="feature-title">Unduh File (PDF)</div>
                        <p class="feature-desc">Setelah berkas selesai diverifikasi oleh operator desa, dokumen resmi dapat langsung diunduh dalam bentuk berkas PDF.</p>
                    </div>
                </div>
            </section>

            <!-- 4) Lokasi & Kontak Section -->
            <section id="lokasi" class="section">
                <div class="section-header">
                    <h2>Hubungi <span>Kami</span> & Lokasi</h2>
                    <p class="sub">Hubungi kami melalui kontak resmi atau kunjungi kantor pelayanan Desa Bojongloa pada peta.</p>
                </div>

                <div class="contact-grid">
                    <div class="contact-info-card">
                        <div class="contact-item">
                            <div class="contact-item-icon">📍</div>
                            <div>
                                <div class="contact-item-label">Alamat Kantor</div>
                                <div class="contact-item-value">JL. Raya Bandung-Garut Km 20, RT 01 / RW 01, Desa Bojongloa, Kecamatan Rancaekek, Kabupaten Bandung</div>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-item-icon">📞</div>
                            <div>
                                <div class="contact-item-label">No. Telepon</div>
                                <div class="contact-item-value">022 7797922</div>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-item-icon">✉️</div>
                            <div>
                                <div class="contact-item-label">Surel / Email</div>
                                <div class="contact-item-value">bojongloajuara@gmail.com</div>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-item-icon">📮</div>
                            <div>
                                <div class="contact-item-label">Kode Pos</div>
                                <div class="contact-item-value">40394</div>
                            </div>
                        </div>
                    </div>

                    <div class="map-box">
                        <div class="map-embed-wrap">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.47313167661!2d107.76319247499676!3d-6.953381693046916!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68c482cdfdbd5f%3A0x707e5fdaf44a261a!2sKantor%20Desa%20Bojongloa%20-%20Rancaekek!5e0!3m2!1sid!2sid!4v1784190113810!5m2!1sid!2sid"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="strict-origin-when-cross-origin"
                            ></iframe>
                        </div>
                    </div>
                </div>
            </section>

            <footer>
                © {{ date('Y') }} Pemerintah Kelurahan Desa Bojongloa, Rancaekek. Hak Cipta Dilindungi.
            </footer>
        </main>
    </body>
</html>