@extends('layout.app')
@section('title', 'Program Magang (Internship)')
@section('content')
    <section class="hero" style="background: linear-gradient(135deg, #00a8e6 0%, #ff6b35 100%); color: white; padding: 4rem 5% 3rem; text-align: center; border-radius: 15px; margin-top: 70px; position: relative; overflow: hidden;">
        <div class="hero-content" style="position: relative; z-index: 2;">
            <h1 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 1rem; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">Program Magang (Internship)</h1>
            <p style="font-size: 1.1rem; max-width: 750px; margin: 0 auto 1.5rem; opacity: 0.95;">
                Wujudkan karier dari passion Anda. Bangun portofolio, belajar dari mentor, dan rasakan pengalaman kerja nyata di Latih Hobi.
            </p>
        </div>
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=2071&q=80') no-repeat center center; background-size: cover; opacity: 0.1; z-index: 1;"></div>
    </section>

    <section style="padding: 3rem 5%; max-width: 1100px; margin: 2rem auto;">
        <h2 style="text-align: center; font-size: 2rem; color: #00a8e6; font-weight: 700; margin-bottom: 1.2rem;">Deskripsi Program</h2>
        <div style="background: #fff; color: #333; padding: 1.5rem 1.25rem; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.08);">
            <p style="line-height: 1.8; margin: 0 0 0.75rem 0;">
                {{ $description ?? 'Program Magang (Internship) Latih Hobi dirancang untuk memberikan pengalaman kerja nyata melalui keterlibatan langsung pada proyek-proyek kreatif dan edukatif. Peserta akan mendapatkan bimbingan mentor, kesempatan kolaborasi lintas divisi, serta peningkatan keterampilan teknis dan soft-skill yang relevan dengan kebutuhan industri.' }}
            </p>
            <p style="line-height: 1.8; margin: 0;">
                Durasi fleksibel mengikuti kebijakan kampus/sekolah. Mode kerja tersedia onsite dan hybrid sesuai kebutuhan divisi.
            </p>
        </div>
    </section>

    <section style="text-align: center; margin: 3rem 0 4rem;">
        <a href="#" class="btn-start" style="background: #ff6b35; color: white; padding: 0.9rem 2.2rem; border-radius: 30px; font-weight: 700; text-transform: uppercase; box-shadow: 0 4px 15px rgba(255, 107, 53, 0.5); transition: all 0.3s ease; display: inline-block; text-decoration: none;">
            Pelajari Selengkapnya
        </a>
    </section>
@endsection
