@extends('layout.app')

@section('title', 'Program Magang LatihHobi')

@section('content')
<style>
    /* ====== HERO ====== */
    .magang-hero {
        position: relative;
        background: linear-gradient(135deg, #00a8e6 0%, #7bdff2 30%, #b2f7ef 55%, #ffa69e 78%, #ff6b35 100%);
        color: #fff;
        padding: 90px 5% 110px;
        overflow: hidden;
        border-radius: 0 0 28px 28px;
        margin-top: 70px;
        box-shadow: 0 12px 30px rgba(0,0,0,.12);
    }
    .magang-hero:before, .magang-hero:after {
        content: '';
        position: absolute;
        width: 520px; height: 520px;
        border-radius: 50%;
        filter: blur(60px);
        opacity: .28; z-index: 0;
    }
    .magang-hero:before { background: #ffffff; top: -130px; left: -150px; }
    .magang-hero:after  { background: #ffe1d8; bottom: -160px; right: -160px; }
    .magang-hero .inner { position: relative; z-index: 1; text-align: center; max-width: 1000px; margin: 0 auto; }
    .magang-hero h1 { font-size: 42px; font-weight: 900; letter-spacing: .4px; margin: 0 0 14px; text-shadow: 0 6px 24px rgba(0,0,0,.2); }
    .magang-hero p { font-size: 18px; opacity: .95; max-width: 820px; margin: 0 auto; }

    /* ====== WRAPPER ====== */
    .magang-wrapper { max-width: 1220px; margin: -70px auto 48px; position: relative; z-index: 2; padding: 0 5%; }

    /* ====== DESCRIPTION SECTION (Neutral) ====== */
    .magang-desc-grid { display: grid; grid-template-columns: 1.2fr .8fr; gap: 24px; }
    .card { background: #ffffff; border-radius: 12px; box-shadow: 0 10px 24px rgba(0,0,0,.06); padding: 22px; position: relative; }

    .desc-card h2 { font-size: 24px; color: #222; font-weight: 800; margin: 0 0 10px; }
    .desc-card .muted { color: #666; font-size: 15px; margin-bottom: 8px; }
    .desc-card p { color: #333; line-height: 1.7; margin: 10px 0; }

    .tags { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 12px; }
    .tag { font-size: 12px; font-weight: 700; letter-spacing: .3px; padding: 6px 10px; border-radius: 30px; color: #333; background: #f2f2f2; border: 1px solid #e0e0e0; }

    /* ====== HIGHLIGHT CARD ====== */
    .highlight-card h3 { font-size: 18px; color: #0f3d5c; font-weight: 900; margin: 0 0 10px; }
    .highlight-list { list-style: none; padding: 0; margin: 0; display: grid; gap: 10px; }
    .highlight-list li { display: flex; gap: 10px; align-items: flex-start; background: #f7fbff; border: 1px solid #e4f2fb; padding: 12px 12px; border-radius: 12px; color: #26384a; }
    .highlight-list i { color: #00a8e6; font-size: 18px; margin-top: 2px; }

    /* ====== ACCORDION ====== */
    .magang-accordion { margin-top: 24px; border-radius: 14px; overflow: hidden; border: 1px solid #e7edf4; background: #f7f9fb; }
    .magang-accordion-item { border-bottom: 1px solid #e7edf4; }
    .magang-accordion-item:last-child { border-bottom: none; }
    .magang-accordion-header { width: 100%; text-align: left; background: linear-gradient(90deg, #eaf6fb, #fff); padding: 14px 18px; border: none; outline: none; cursor: pointer; font-weight: 900; color: #0f3d5c; display: flex; align-items: center; gap: 10px; font-size: 16px; }
    .magang-accordion-header i { color: #ff6b35; }
    .magang-accordion-content { display: none; background: #fff; padding: 16px 22px; color: #2b3c4e; }
    .magang-accordion-item.active .magang-accordion-content { display: block; }

    /* ====== RESPONSIVE ====== */
    @media (max-width: 900px) {
        .magang-hero { padding: 70px 5% 90px; }
        .magang-hero h1 { font-size: 30px; }
        .magang-hero p { font-size: 15px; }
        .magang-desc-grid { grid-template-columns: 1fr; }
    }
</style>

<section class="magang-hero">
    <div class="inner">
        <h1>Program Magang Latih Hobi</h1>
        <p>Wujudkan karier dari passion Anda. Belajar langsung dari mentor, bangun portofolio, dan rasakan pengalaman dunia kerja yang sesungguhnya.</p>
    </div>
</section>

<div class="magang-wrapper">
    <div class="magang-desc-grid">
        <div class="card desc-card">
            <h2>Deskripsi Program</h2>
            <div class="muted">Tempat untuk deskripsi</div>
            <p>
                {{ $description ?? 'Program Magang (Internship) Latih Hobi dirancang untuk memberikan pengalaman kerja nyata melalui keterlibatan langsung pada proyek-proyek kreatif dan edukatif. Peserta akan mendapatkan bimbingan mentor, kesempatan kolaborasi lintas divisi, serta peningkatan keterampilan teknis dan soft-skill yang relevan dengan kebutuhan industri.' }}
            </p>
            <p>
                Durasi fleksibel mengikuti kebijakan kampus/sekolah. Mode kerja tersedia onsite dan hybrid sesuai kebutuhan divisi.
            </p>
            <div class="tags">
                <span class="tag">Durasi 1–6 bulan</span>
                <span class="tag">Hybrid/Onsite</span>
                <span class="tag">Sertifikat</span>
                <span class="tag">Mentoring</span>
            </div>
        </div>
        <div class="card highlight-card">
            <h3>Highlight Program</h3>
            <ul class="highlight-list">
                <li><i class="fas fa-check-circle"></i><span>Mentor berpengalaman di bidangnya</span></li>
                <li><i class="fas fa-check-circle"></i><span>Portofolio nyata dari proyek langsung</span></li>
                <li><i class="fas fa-check-circle"></i><span>Soft-skill: komunikasi, kolaborasi, manajemen waktu</span></li>
                <li><i class="fas fa-check-circle"></i><span>Jaringan komunitas dan peluang pasca-magang</span></li>
            </ul>
        </div>
    </div>

    <h2 style="font-size: 22px; font-weight: 900; color: #0f3d5c; margin: 28px 6px 14px;">Informasi Program</h2>
    <div class="magang-accordion">
        <div class="magang-accordion-item">
            <button class="magang-accordion-header">
                <i class="fas fa-user-check"></i>
                PERSYARATAN PESERTA MAGANG (INTERNSHIP)
            </button>
            <div class="magang-accordion-content">
                <ul>
                    <li>Mahasiswa/siswa aktif atau fresh graduate</li>
                    <li>Minat pada divisi yang relevan dan siap belajar</li>
                    <li>Mampu bekerja dalam tim serta berkomunikasi dengan baik</li>
                    <li>Memiliki laptop pribadi</li>
                </ul>
            </div>
        </div>
        <div class="magang-accordion-item">
            <button class="magang-accordion-header">
                <i class="fas fa-tasks"></i>
                KEWAJIBAN PESERTA MAGANG (INTERNSHIP)
            </button>
            <div class="magang-accordion-content">
                <ul>
                    <li>Mematuhi budaya kerja dan disiplin Latih Hobi</li>
                    <li>Menjalani kegiatan magang pada hari kerja (Senin–Jumat)</li>
                    <li>Bagi siswi/mahasiswi wajib berkerudung saat berada di area kantor</li>
                    <li>Berpakaian rapi dan mengenakan sepatu selama magang</li>
                </ul>
                <p style="margin-top:10px;">Mengisi logbook dan menyusun laporan magang setelah berdiskusi dengan pembimbing.</p>
            </div>
        </div>
        <div class="magang-accordion-item">
            <button class="magang-accordion-header">
                <i class="fas fa-award"></i>
                HAK PESERTA MAGANG (INTERNSHIP)
            </button>
            <div class="magang-accordion-content">
                <ul>
                    <li>Pengalaman kerja nyata pada proyek langsung</li>
                    <li>Sertifikat magang setelah program selesai</li>
                    <li>Pendampingan mentor selama program</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.magang-accordion-header').forEach(function(header) {
        header.addEventListener('click', function() {
            var item = header.parentElement;
            var allItems = document.querySelectorAll('.magang-accordion-item');
            allItems.forEach(function(i) { if (i !== item) i.classList.remove('active'); });
            item.classList.toggle('active');
        });
    });
</script>
@endsection
