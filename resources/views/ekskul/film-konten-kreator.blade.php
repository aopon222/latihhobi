@extends('layout.app')

@section('title', 'Ekskul Film & Konten Kreator - LatihHobi')

@section('content')
    <style>
        /* Hero Section */
        .film-hero {
            position: relative;
            width: 100%;
            min-height: 400px;
            margin-top: 70px;
            background: linear-gradient(135deg, #1e3a5f 0%, #2c5282 100%);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 5%;
            overflow: hidden;
        }

        .film-hero-content {
            flex: 1;
            color: white;
            z-index: 2;
        }

        .film-hero h1 {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1rem;
        }

        .film-hero-image {
            flex: 1;
            max-width: 500px;
            z-index: 2;
        }

        .film-hero-image img {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 10px;
        }

        /* Info Section */
        .info-section {
            background: white;
            padding: 0;
            margin-top: 0;
        }

        .info-table {
            max-width: 100%;
            margin: 0 auto;
            border-collapse: collapse;
        }

        .info-row {
            display: grid;
            grid-template-columns: 200px 1fr;
            border-bottom: 1px solid #ddd;
        }

        .info-row:first-child {
            border-top: 1px solid #ddd;
        }

        .info-label {
            background: #e5e5e5;
            padding: 1.5rem 2rem;
            font-weight: 700;
            color: #1e3a5f;
            font-size: 1rem;
            display: flex;
            align-items: center;
            border-right: 1px solid #ddd;
        }

        .info-value {
            background: white;
            padding: 1.5rem 2rem;
            color: #333;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .info-value ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .info-value li {
            padding: 0.3rem 0;
            color: #333;
            line-height: 1.6;
        }

        .info-value li::before {
            content: "• ";
            color: #1e3a5f;
            font-weight: bold;
            margin-right: 0.5rem;
        }

        /* Gallery Section */
        .gallery-section {
            background: #1e3a5f;
            padding: 60px 5%;
            text-align: center;
        }

        .gallery-section h2 {
            color: white;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 2rem;
        }

        .gallery-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }

        .gallery-item {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
        }

        .gallery-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        /* Tujuan Section */
        .tujuan-section {
            background: #00a8e6;
            padding: 60px 5%;
            text-align: center;
        }

        .tujuan-section h2 {
            color: white;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 3rem;
        }

        .tujuan-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
        }

        .tujuan-card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .tujuan-card h3 {
            font-size: 1rem;
            color: #1e3a5f;
            font-weight: 600;
            line-height: 1.6;
        }

        /* Apa Itu Section */
        .apaitu-section {
            padding: 60px 5%;
            background: white;
        }

        .apaitu-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 3rem;
            align-items: center;
        }

        .apaitu-image img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .apaitu-content h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #1e3a5f;
            margin-bottom: 1.5rem;
        }

        .apaitu-content p {
            color: #555;
            line-height: 1.8;
            font-size: 1rem;
        }

        /* Manfaat Section */
        .manfaat-section {
            padding: 60px 5%;
            background: #f5f5f5;
            text-align: center;
        }

        .manfaat-section h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #1e3a5f;
            margin-bottom: 2rem;
        }

        .manfaat-list {
            max-width: 800px;
            margin: 0 auto;
            text-align: left;
        }

        .manfaat-list ul {
            list-style: none;
            padding: 0;
        }

        .manfaat-list li {
            padding: 0.8rem 0;
            color: #555;
            font-size: 1rem;
            line-height: 1.6;
        }

        .manfaat-list li::before {
            content: "• ";
            color: #000000;
            font-weight: bold;
            margin-right: 0.5rem;
        }

        /* Fasilitas Section */
        .fasilitas-section {
            background: #1e3a5f;
            padding: 60px 5%;
            text-align: center;
        }

        .fasilitas-section h2 {
            color: white;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 3rem;
        }

        .fasilitas-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            justify-content: center;
        }

        .fasilitas-card {
            flex: 0 1 calc(33.333% - 1.5rem);
            max-width: calc(33.333% - 1.5rem);
        }

        .fasilitas-card:nth-child(4),
        .fasilitas-card:nth-child(5) {
            flex: 0 1 calc(33.333% - 1.5rem);
            max-width: calc(33.333% - 1.5rem);
        }

        .fasilitas-card {
            background: white;
            padding: 2rem 1.5rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .fasilitas-icon {
            width: 60px;
            height: 60px;
            background: #1e3a5f;
            border-radius: 50%;
            margin: 0 auto 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .fasilitas-card h3 {
            font-size: 1rem;
            color: #1e3a5f;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .fasilitas-card p {
            font-size: 0.9rem;
            color: #666;
        }

        /* Tutor Section */
        .tutor-section {
            background: #00a8e6;
            padding: 60px 5%;
            text-align: center;
        }

        .tutor-section h2 {
            color: #fbbf24;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .tutor-subtitle {
            color: white;
            font-size: 1rem;
            margin-bottom: 3rem;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .tutor-grid {
            max-width: 1000px;
            margin: 0 auto 2rem;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }

        .tutor-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .tutor-image {
            width: 100%;
            height: 250px;
            background: #5b7ba8;
            overflow: hidden;
        }

        .tutor-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .tutor-info {
            padding: 1.5rem 1rem;
        }

        .tutor-info h3 {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1e3a5f;
            margin: 0 0 0.3rem 0;
        }

        .tutor-info p {
            font-size: 0.95rem;
            font-weight: 400;
            color: #666;
            margin: 0;
            font-style: italic;
        }

        .tutor-pagination {
            display: flex;
            justify-content: center;
            gap: 0.8rem;
            margin-top: 2rem;
        }

        .tutor-pagination .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .tutor-pagination .dot.active {
            background: #ff6b6b;
            width: 14px;
            height: 14px;
        }

        .tutor-pagination .dot:hover {
            background: rgba(255, 255, 255, 0.7);
        }

        /* Siswa Section */
        .siswa-section {
            padding: 60px 5%;
            background: white;
            text-align: center;
        }

        .siswa-section h2 {
            font-size: 3rem;
            font-weight: 700;
            color: #00a8e6;
            margin-bottom: 1rem;
        }

        /* Testimoni Section */
        .testimoni-section {
            background: #1e3a5f;
            padding: 60px 5%;
            text-align: center;
        }

        .testimoni-section h2 {
            color: white;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .testimoni-subtitle {
            color: #fbbf24;
            font-size: 1rem;
            margin-bottom: 3rem;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .testimoni-grid {
            max-width: 800px;
            margin: 0 auto 3rem;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
        }

        .testimoni-card {
            background: transparent;
            padding: 0;
            border-radius: 0;
            box-shadow: none;
        }

        .testimoni-card img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 1rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .testimoni-name-blue {
            font-weight: 700;
            color: #00a8e6;
            margin: 0.5rem 0 0.3rem;
            font-size: 1.1rem;
        }

        .testimoni-school {
            color: #fbbf24;
            margin: 0;
            font-size: 0.95rem;
            font-weight: 500;
        }

        .testimoni-quote {
            max-width: 900px;
            margin: 3rem auto 0;
            padding-top: 2rem;
        }

        .testimoni-quote p:first-child {
            color: white;
            font-style: italic;
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .testimoni-author {
            color: #00a8e6;
            font-weight: 700;
            margin: 0.3rem 0;
            font-size: 1rem;
        }

        .testimoni-author-school {
            color: #fbbf24;
            font-weight: 500;
            margin: 0.3rem 0;
            font-size: 0.95rem;
        }

        .testimoni-footer {
            color: white;
            margin-top: 2rem;
            font-style: italic;
            font-size: 0.95rem;
        }

        /* CTA Section */
        .cta-section {
            padding: 60px 5%;
            background: white;
            text-align: center;
        }

        .cta-section h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #1e3a5f;
            margin-bottom: 1.5rem;
        }

        .cta-section p {
            color: #555;
            font-size: 1rem;
            margin-bottom: 2rem;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-daftar {
            background: #00a8e6;
            color: white;
            padding: 1rem 3rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.1rem;
            display: inline-block;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 168, 230, 0.3);
        }

        .btn-daftar:hover {
            background: #0088b8;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 168, 230, 0.4);
        }

        /* Footer Info */
        .footer-info {
            background: #1e3a5f;
            padding: 20px 5%;
            text-align: center;
            color: white;
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .film-hero {
                flex-direction: column;
                padding: 2rem 5%;
                text-align: center;
            }

            .film-hero h1 {
                font-size: 2rem;
            }

            .film-hero-image {
                max-width: 100%;
                margin-top: 2rem;
            }

            .info-row {
                grid-template-columns: 1fr;
            }

            .info-label {
                border-right: none;
                border-bottom: 1px solid #ddd;
            }

            .info-label,
            .info-value {
                padding: 1rem 1.5rem;
            }

            .tujuan-grid,
            .tutor-grid,
            .testimoni-grid {
                grid-template-columns: 1fr;
            }

            .fasilitas-card {
                flex: 0 1 100%;
                max-width: 100%;
            }

            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }

            .apaitu-container {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .siswa-section h2 {
                font-size: 2rem;
            }
        }
    </style>

    <!-- Hero Section -->
    <section class="film-hero">
        <div class="film-hero-content">
            <h1>Ekskul Film & Konten Kreator</h1>
        </div>
        <div class="film-hero-image">
            <img src="{{ asset('images/HeroFKK.png') }}" alt="Ekskul Film & Konten Kreator">
        </div>
    </section>

    <!-- Info Section -->
    <section class="info-section">
        <div class="info-table">
            <div class="info-row">
                <div class="info-label">Lembaga</div>
                <div class="info-value">Latih Hobi</div>
            </div>
            <div class="info-row">
                <div class="info-label">Program</div>
                <div class="info-value">Ekstrakurikuler Film dan Konten Kreator</div>
            </div>
            <div class="info-row">
                <div class="info-label">Biaya</div>
                <div class="info-value">Rp 150.000 per bulan (Biaya sudah termasuk akses pelatihan, peminjaman kamera
                    digital, dan sertifikat project per level)</div>
            </div>
            <div class="info-row">
                <div class="info-label">Jumlah Pertemuan</div>
                <div class="info-value">60 Menit/Pertemuan</div>
            </div>
            <div class="info-row">
                <div class="info-label">Durasi</div>
                <div class="info-value">
                    <ul>
                        <li>12 x pertemuan</li>
                        <li>16 x pertemuan</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="gallery-section">
        <h2>Galeri Ekstrakurikuler</h2>
        <div class="gallery-grid">
            <div class="gallery-item">
                <img src="{{ asset('images/GaleriFKK1.png') }}" alt="Gallery 1">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('images/GaleriFKK2.png') }}" alt="Gallery 2">
            </div>
            <div class="gallery-item">
                <img src="{{ asset('images/GaleriFKK3.png') }}" alt="Gallery 3">
            </div>
        </div>
    </section>

    <!-- Tujuan Section -->
    <section class="tujuan-section">
        <h2>Tujuan Pembelajaran</h2>
        <div class="tujuan-grid">
            <div class="tujuan-card">
                <h3>Menumbuhkan kreativitas dan imajinasi dalam merancang ide cerita serta mengeksekusinya menjadi karya
                    visual</h3>
            </div>
            <div class="tujuan-card">
                <h3>Mengenal dan menerapkan teknik dasar pengambilan gambar, pencahayaan, audio, dan editing secara bertahap
                </h3>
            </div>
            <div class="tujuan-card">
                <h3>Membentuk karakter disiplin, kerja sama tim, dan tanggung jawab dalam proses produksi karya</h3>
            </div>
            <div class="tujuan-card">
                <h3>Meningkatkan kepercayaan diri dan kemampuan berbicara melalui latihan public speaking dan pembuatan
                    konten</h3>
            </div>
        </div>
    </section>

    <!-- Apa Itu Section -->
    <section class="apaitu-section">
        <div class="apaitu-container">
            <div class="apaitu-image">
                <img src="{{ asset('images/HeroFKK.png') }}" alt="Apa Itu Ekskul Film">
            </div>
            <div class="apaitu-content">
                <h2>Apa itu Ekskul Film dan Konten Kreator?</h2>
                <p>Ekskul Film & Konten Kreator (FKK) adalah wadah kreatif bagi siswa untuk belajar fotografi, videografi,
                    dan produksi film pendek secara bertahap dan menyenangkan. Melalui pendekatan project-based learning,
                    siswa diajak merancang, memproduksi, dan menyunting karya visual yang original—mulai dari memotret
                    mainan, membuat vlog, menjadi aktor, hingga menyutradarai film pendek.</p>
            </div>
        </div>
    </section>

    <!-- Manfaat Section -->
    <section class="manfaat-section">
        <h2>Manfaat Utama Ekskul Film & Konten Kreator</h2>
        <div class="manfaat-list">
            <ul>
                <li>Membangun kepercayaan diri dan keberanian berekspresi di depan kamera dan publik</li>
                <li>Melatih keterampilan teknis seperti pengambilan gambar, perekaman suara, dan editing</li>
                <li>Mengembangkan imajinasi & storytelling lewat karya visual yang komunikatif</li>
                <li>Belajar kolaborasi dan manajemen produksi dalam tim (sutradara, aktor, penulis, dll)</li>
                <li>Mengenal dunia industri kreatif digital sejak dini sebagai peluang karier masa depan</li>
            </ul>
        </div>
    </section>

    <!-- Fasilitas Section -->
    <section class="fasilitas-section">
        <h2>Fasilitas apa saja yang didapatkan?!</h2>
        <div class="fasilitas-grid">
            <div class="fasilitas-card">
                <div class="fasilitas-icon">⭐</div>
                <h3>Rapot</h3>
            </div>
            <div class="fasilitas-card">
                <div class="fasilitas-icon">📋</div>
                <h3>Modul Pembelajaran</h3>
            </div>
            <div class="fasilitas-card">
                <div class="fasilitas-icon">⭐</div>
                <h3>Sertifikat</h3>
            </div>
            <div class="fasilitas-card">
                <div class="fasilitas-icon">⭐</div>
                <h3>Alat & Fasilitas Produksi</h3>
                <p>Kamera DSLR/Mirrorless, tripod, audio recorder, lampu tambahan, serta dukungan penggunaan smartphone.</p>
            </div>
            <div class="fasilitas-card">
                <div class="fasilitas-icon">🏆</div>
                <h3>Fasilitas Karya dan Pameran</h3>
            </div>
        </div>
    </section>

    <!-- Tutor Section -->
    <section class="tutor-section">
        <h2>Jajaran Tutor FKK Terbaik di Latih Hobi</h2>
        <p class="tutor-subtitle">Latih Hobi memiliki tutor FKK berpengalaman yang siap memberikan layanan mengajar.</p>
        <div class="tutor-grid">
            <div class="tutor-card">
                <div class="tutor-image">
                    <img src="{{ asset('images/TutorFKK1.png') }}" alt="Kak Wahyu">
                </div>
                <div class="tutor-info">
                    <h3>Kak Wahyu</h3>
                    <p>Tutor FKK</p>
                </div>
            </div>
            <div class="tutor-card">
                <div class="tutor-image">
                    <img src="{{ asset('images/TutorFKK2.png') }}" alt="Kak Wiedy">
                </div>
                <div class="tutor-info">
                    <h3>Kak Wiedy</h3>
                    <p>Tutor FKK</p>
                </div>
            </div>
            <div class="tutor-card">
                <div class="tutor-image">
                    <img src="{{ asset('images/TutorFKK3.png') }}" alt="Kak Tegar">
                </div>
                <div class="tutor-info">
                    <h3>Kak Tegar</h3>
                    <p>Tutor FKK</p>
                </div>
            </div>
        </div>
        <div class="tutor-pagination">
            <span class="dot active"></span>
            <span class="dot"></span>
        </div>
    </section>

    <!-- Siswa Section -->
    <section class="siswa-section">
        <h2>5000+ Siswa</h2>
        <p class="testimoni-subtitle">Sudah mengikuti ekstrakulikuler Film dan Konten Kreator. Saatnya kamu untuk bergabung
            sekarang!</p>
    </section>

    <!-- Testimoni Section -->
    <section class="testimoni-section">
        <h2>Testimoni</h2>
        <p class="testimoni-subtitle">cerita dan pengalaman pribadi peserta dan wali peserta Latih Hobi selama belajar
            bersama Tutor</p>
        <div class="testimoni-grid">
            <div class="testimoni-card">
                <img src="{{ asset('images/Testi1.png') }}" alt="Testimoni Bunda Calysta">
                <p class="testimoni-name-blue">Bunda Calysta</p>
                <p class="testimoni-school">SD Tridaya</p>
            </div>
            <div class="testimoni-card">
                <img src="{{ asset('images/Testi2.png') }}" alt="Testimoni Mommy Lola">
                <p class="testimoni-name-blue">Mommy Lola</p>
                <p class="testimoni-school">SD Islam Al-Azhar 36</p>
            </div>
        </div>
        <div class="testimoni-quote">
            <p>"Aku senang ikut robotik, soalnya bisa bikin robot jalan sendiri. Seru banget kaya mainan tapi kita yang
                buat!"</p>
            <p class="testimoni-author">Reina Hardesty, 11 Tahun</p>
            <p class="testimoni-author-school">SDP Al-Ghifari</p>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <h2>Mahir Film dan Konten Bersama Latih Hobi!</h2>
        <p>Temukan imajinasi, dan kreativitasmu melalui karya visual. Dari Kamera hingga ke Layar Pameran.</p>
        <a href="#" class="btn-daftar">Daftar Sekarang</a>
    </section>
@endsection
