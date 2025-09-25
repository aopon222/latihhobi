@extends('layout.app')
@section('title', 'Latih Hobi Karier')
@section('content')
    <section class="hero" style="background: linear-gradient(135deg, #00a8e6 0%, #ff6b35 100%); color: white; padding: 4rem 5% 3rem; text-align: center; border-radius: 15px; margin-top: 70px; position: relative; overflow: hidden;">
        <div class="hero-content" style="position: relative; z-index: 2;">
            <h1 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 1rem; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">Karier di Latih Hobi</h1>
            <p style="font-size: 1.1rem; max-width: 700px; margin: 0 auto 1.5rem; opacity: 0.9;">
                Bergabunglah dengan tim kami dan kembangkan karier Anda di lingkungan yang dinamis dan penuh semangat.
            </p>
            <a href="#career-opportunities" class="btn-start" style="background: white; color: #00a8e6; font-weight: 700; padding: 0.8rem 2.5rem; border-radius: 30px; text-transform: uppercase; box-shadow: 0 4px 15px rgba(255, 107, 53, 0.5); transition: all 0.3s ease; display: inline-block;">
                Jelajahi Karier
            </a>
        </div>
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=2071&q=80') no-repeat center center; background-size: cover; opacity: 0.1; z-index: 1;"></div>
    </section>

    <section id="career-opportunities" style="padding: 3rem 5%; max-width: 1200px; margin: 2rem auto;">
        <h2 style="text-align: center; font-size: 2.2rem; color: #00a8e6; font-weight: 700; margin-bottom: 1.5rem;">Peluang Karier</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
            <div class="service-card" style="background: #00a8e6; color: white; padding: 1.5rem; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,168,230,0.3); cursor: pointer; transition: all 0.3s; transform: translateY(0);">
                <div class="service-icon" style="font-size: 2.5rem; margin-bottom: 0.8rem;">
                    <i class="fas fa-laptop-code"></i>
                </div>
                <h3 class="service-title" style="font-weight: 700; font-size: 1.2rem; margin-bottom: 0.5rem;">Developer</h3>
                <p class="service-subtitle" style="opacity: 0.9; font-size: 0.95rem;">Berkontribusi dalam pengembangan aplikasi dan teknologi terbaru.</p>
            </div>
            <div class="service-card" style="background: #ff6b35; color: white; padding: 1.5rem; border-radius: 15px; box-shadow: 0 5px 15px rgba(255,107,53,0.3); cursor: pointer; transition: all 0.3s; transform: translateY(0);">
                <div class="service-icon" style="font-size: 2.5rem; margin-bottom: 0.8rem;">
                    <i class="fas fa-bullhorn"></i>
                </div>
                <h3 class="service-title" style="font-weight: 700; font-size: 1.2rem; margin-bottom: 0.5rem;">Marketing</h3>
                <p class="service-subtitle" style="opacity: 0.9; font-size: 0.95rem;">Membangun strategi pemasaran yang efektif dan kreatif.</p>
            </div>
            <div class="service-card" style="background: #00a8e6; color: white; padding: 1.5rem; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,168,230,0.3); cursor: pointer; transition: all 0.3s; transform: translateY(0);">
                <div class="service-icon" style="font-size: 2.5rem; margin-bottom: 0.8rem;">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <h3 class="service-title" style="font-weight: 700; font-size: 1.2rem; margin-bottom: 0.5rem;">Instruktur</h3>
                <p class="service-subtitle" style="opacity: 0.9; font-size: 0.95rem;">Membimbing dan menginspirasi peserta dalam berbagai bidang.</p>
            </div>
        </div>
    </section>

    <section id="benefits" style="background: #f8f9fa; padding: 3rem 5%; border-radius: 15px; max-width: 1200px; margin: 2rem auto;">
        <h2 style="text-align: center; font-size: 2.2rem; color: #ff6b35; font-weight: 700; margin-bottom: 1.5rem;">Keuntungan Bergabung</h2>
        <ul style="max-width: 800px; margin: 0 auto; list-style: none; padding: 0; display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem;">
            <li style="background: white; padding: 1.2rem; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); display: flex; align-items: center; gap: 0.8rem; transition: transform 0.3s ease;">
                <i class="fas fa-handshake" style="color: #00a8e6; font-size: 1.8rem;"></i>
                <span style="font-weight: 600; font-size: 1rem;">Lingkungan Kerja Kolaboratif</span>
            </li>
            <li style="background: white; padding: 1.2rem; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); display: flex; align-items: center; gap: 0.8rem; transition: transform 0.3s ease;">
                <i class="fas fa-graduation-cap" style="color: #ff6b35; font-size: 1.8rem;"></i>
                <span style="font-weight: 600; font-size: 1rem;">Pengembangan Profesional</span>
            </li>
            <li style="background: white; padding: 1.2rem; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); display: flex; align-items: center; gap: 0.8rem; transition: transform 0.3s ease;">
                <i class="fas fa-heart" style="color: #00a8e6; font-size: 1.8rem;"></i>
                <span style="font-weight: 600; font-size: 1rem;">Keseimbangan Kerja dan Kehidupan</span>
            </li>
        </ul>
    </section>

    <section id="call-to-action" style="text-align: center; margin: 4rem 0;">
        <h2 style="font-size: 2rem; font-weight: 700; margin-bottom: 1rem; color: #007bff;">Siap Bergabung?</h2>
        <p style="max-width: 600px; margin: 0 auto 2rem; font-size: 1.1rem; color: #555;">
            Kirimkan lamaran Anda sekarang dan jadilah bagian dari tim kami yang luar biasa!
        </p>
        <a href="/contact" class="btn-start" style="background: #ff6b35; color: white; padding: 1rem 3rem; border-radius: 30px; font-weight: 700; text-transform: uppercase; box-shadow: 0 4px 15px rgba(255, 107, 53, 0.5); transition: all 0.3s ease;">
            Lamar Sekarang
        </a>
    </section>
@endsection
