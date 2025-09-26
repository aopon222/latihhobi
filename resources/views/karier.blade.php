@extends('layout.app')
@section('title', 'Latih Hobi Karier')
@section('content')
    <section class="hero" style="background: linear-gradient(135deg, #38547cff 0%, #0a2540 100%); color: white; padding: 4rem 5% 3rem; text-align: center; border-radius: 15px; margin-top: 70px; position: relative; overflow: hidden;">
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
                    <i class="fas fa-robot"></i>
                </div>
                <h3 class="service-title" style="font-weight: 700; font-size: 1.2rem; margin-bottom: 0.5rem;">Tutor Robotik</h3>
                <p class="service-subtitle" style="opacity: 0.9; font-size: 0.95rem;">Mengajar robotika untuk berbagai tingkat usia.</p>
            </div>
            <div class="service-card" style="background: #ff6b35; color: white; padding: 1.5rem; border-radius: 15px; box-shadow: 0 5px 15px rgba(255,107,53,0.3); cursor: pointer; transition: all 0.3s; transform: translateY(0);">
                <div class="service-icon" style="font-size: 2.5rem; margin-bottom: 0.8rem;">
                    <i class="fas fa-video"></i>
                </div>
                <h3 class="service-title" style="font-weight: 700; font-size: 1.2rem; margin-bottom: 0.5rem;">Tutor Film dan Konten Kreator</h3>
                <p class="service-subtitle" style="opacity: 0.9; font-size: 0.95rem;">Mengajar pembuatan film dan konten kreatif.</p>
            </div>
            <div class="service-card" style="background: #00a8e6; color: white; padding: 1.5rem; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,168,230,0.3); cursor: pointer; transition: all 0.3s; transform: translateY(0);">
                <div class="service-icon" style="font-size: 2.5rem; margin-bottom: 0.8rem;">
                    <i class="fas fa-bullseye"></i>
                </div>
                <h3 class="service-title" style="font-weight: 700; font-size: 1.2rem; margin-bottom: 0.5rem;">Tutor Panahan</h3>
                <p class="service-subtitle" style="opacity: 0.9; font-size: 0.95rem;">Membimbing teknik dasar hingga mahir panahan.</p>
            </div>
            <div class="service-card" style="background: #ff6b35; color: white; padding: 1.5rem; border-radius: 15px; box-shadow: 0 5px 15px rgba(255,107,53,0.3); cursor: pointer; transition: all 0.3s; transform: translateY(0);">
                <div class="service-icon" style="font-size: 2.5rem; margin-bottom: 0.8rem;">
                    <i class="fas fa-book-open"></i>
                </div>
                <h3 class="service-title" style="font-weight: 700; font-size: 1.2rem; margin-bottom: 0.5rem;">Tutor Komik</h3>
                <p class="service-subtitle" style="opacity: 0.9; font-size: 0.95rem;">Mengajar ilustrasi dan penceritaan komik.</p>
            </div>
            <div class="service-card" style="background: #00a8e6; color: white; padding: 1.5rem; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,168,230,0.3); cursor: pointer; transition: all 0.3s; transform: translateY(0);">
                <div class="service-icon" style="font-size: 2.5rem; margin-bottom: 0.8rem;">
                    <i class="fas fa-briefcase"></i>
                </div>
                <h3 class="service-title" style="font-weight: 700; font-size: 1.2rem; margin-bottom: 0.5rem;">Back office</h3>
                <p class="service-subtitle" style="opacity: 0.9; font-size: 0.95rem;">Mendukung operasional harian dan administrasi.</p>
            </div>
        </div>
    </section>

    <section id="call-to-action" style="text-align: center; margin: 4rem 0;">
        <h2 style="font-size: 2rem; font-weight: 700; margin-bottom: 1rem; color: #007bff;">Siap Bergabung?</h2>
        <p style="max-width: 600px; margin: 0 auto 2rem; font-size: 1.1rem; color: #555;">
            Kirimkan lamaran Anda sekarang dan jadilah bagian dari tim kami yang luar biasa!
        </p>
        <a href="https://forms.gle/vgt5hqrRi2yzefGTA" class="btn-start" style="background: #ff6b35; color: white; padding: 1rem 3rem; border-radius: 30px; font-weight: 700; text-transform: uppercase; box-shadow: 0 4px 15px rgba(255, 107, 53, 0.5); transition: all 0.3s ease;">
            Lamar Sekarang
        </a>
    </section>
@endsection
