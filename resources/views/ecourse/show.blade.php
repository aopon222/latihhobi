@extends('layout.app')

@section('title', $course->name . ' - LatihHobi')

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 100px 20px 40px;">
    <div style="display: grid; grid-template-columns: 1fr 420px; gap: 40px; margin-bottom: 40px; align-items: start;">
        <!-- Course Image (left, flexible) -->
        <div style="background:transparent;padding:0;border-radius:12px;overflow:hidden;max-width:100%;">
            <img src="{{ getEcourseImageUrl($course->image_url) }}" alt="{{ $course->name }}" style="width:100%;height:260px;max-height:260px;object-fit:cover;aspect-ratio:16/9;border-radius:12px;box-shadow:0 6px 18px rgba(0,0,0,0.08);display:block;">
        </div>

        <!-- Course Info (right sidebar, fixed width) -->
        <aside>
            <div style="margin-bottom: 20px;">
                <h1 style="font-size: 2rem; margin: 0 0 10px 0; color: #333;">{{ $course->name }}</h1>
                <p style="color: #666; font-size: 1.1rem; margin: 0;">By {{ $course->course_by ?? 'Latihhobi' }}</p>
            </div>

            <!-- Category -->
            @if($course->category)
            <div style="margin-bottom: 20px;">
                <span style="display: inline-block; background: #667eea; color: white; padding: 8px 16px; border-radius: 20px; font-size: 0.9rem;">
                    {{ $course->category->name }}
                </span>
            </div>
            @endif

            <!-- Price -->
            <div style="margin-bottom: 30px; padding: 20px; background: #f5f5f5; border-radius: 8px;">
                <p style="margin: 0 0 10px 0; color: #666; font-size: 0.9rem;">Harga Kursus</p>
                <h2 style="margin: 0; font-size: 2.5rem; color: #667eea;">Rp {{ number_format($course->price, 0, ',', '.') }}</h2>
            </div>

            <!-- Buttons -->
            <div style="display: flex; gap: 15px; margin-bottom: 30px;">
                @auth
                    @if($enrollment)
                        <a href="{{ route('ecourse.learn', $course->id_course) }}" style="flex: 1; padding: 15px; background: #28a745; color: white; border: none; border-radius: 8px; font-size: 1rem; font-weight: bold; cursor: pointer; text-align: center; text-decoration: none; display: flex; align-items: center; justify-content: center; transition: background 0.3s;">
                            📚 Belajar Sekarang
                        </a>
                    @else
                        <form action="{{ route('ecourse.addToCart', $course->id_course) }}" method="POST" style="flex: 1;">
                            @csrf
                            <button type="submit" style="width: 100%; padding: 15px; background: #667eea; color: white; border: none; border-radius: 8px; font-size: 1rem; font-weight: bold; cursor: pointer; transition: background 0.3s;">
                                🛒 Tambah ke Keranjang
                            </button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" style="flex: 1; padding: 15px; background: #667eea; color: white; border: none; border-radius: 8px; font-size: 1rem; font-weight: bold; cursor: pointer; text-align: center; text-decoration: none; display: flex; align-items: center; justify-content: center; transition: background 0.3s;">
                        🔒 Login untuk Membeli
                    </a>
                @endauth

                <a href="{{ route('ecourse.index') }}" style="flex: 1; padding: 15px; background: #e0e0e0; color: #333; border: none; border-radius: 8px; font-size: 1rem; font-weight: bold; cursor: pointer; text-align: center; text-decoration: none; display: flex; align-items: center; justify-content: center; transition: background 0.3s;">
                    ← Kembali
                </a>
            </div>

            <!-- Course Stats -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 30px;">
                <div style="padding: 15px; background: #f9f9f9; border-radius: 8px; text-align: center;">
                    <p style="margin: 0 0 5px 0; color: #666; font-size: 0.9rem;">Peserta</p>
                    <p style="margin: 0; font-size: 1.5rem; font-weight: bold; color: #333;">{{ $course->enrolled ?? 0 }}</p>
                </div>
                <div style="padding: 15px; background: #f9f9f9; border-radius: 8px; text-align: center;">
                    <p style="margin: 0 0 5px 0; color: #666; font-size: 0.9rem;">Rating</p>
                    <p style="margin: 0; font-size: 1.5rem; font-weight: bold; color: #f5a623;">★★★★★</p>
                </div>
            </div>
        </aside>
    </div>

    <!-- Tabs Navigation -->
    <div style="background: white; border-radius: 8px; border: 1px solid #e0e0e0; margin-bottom: 20px;">
        <div style="display: flex; border-bottom: 1px solid #e0e0e0;">
            <button onclick="showTab('overview')" style="flex: 1; padding: 15px; background: none; border: none; border-bottom: 3px solid #667eea; color: #667eea; font-weight: bold; cursor: pointer;" id="overview-tab">Ringkasan</button>
            <button onclick="showTab('curriculum')" style="flex: 1; padding: 15px; background: none; border: none; color: #666; cursor: pointer;" id="curriculum-tab">Kurikulum</button>
        </div>

        <!-- Overview Tab -->
        <div id="overview-content" style="padding: 30px; display: block;">
            <h2 style="margin-top: 0; color: #333;">Tentang Kursus Ini</h2>
            <p style="color: #666; line-height: 1.6; margin-bottom: 20px;">
                Pelajari {{ $course->name }} dengan materi yang komprehensif dan praktis. Kursus ini dirancang untuk pemula hingga tingkat lanjut.
            </p>

            <h3 style="color: #333; margin-bottom: 15px;">Yang Akan Anda Dapatkan:</h3>
            <ul style="color: #666; line-height: 1.8;">
                @if($course->ebook)
                <li>✅ E-book lengkap</li>
                @endif
                @if($course->worksheet)
                <li>✅ Worksheet praktis</li>
                @endif
                @if($course->live_session)
                <li>✅ Live session eksklusif</li>
                @endif
                @if($course->mini_competition)
                <li>✅ Mini competition dengan hadiah</li>
                @endif
                @if($course->certificate)
                <li>✅ Sertifikat resmi</li>
                @endif
                <li>✅ Akses seumur hidup</li>
                <li>✅ Support dari instruktur</li>
                <li>✅ Update materi gratis selamanya</li>
            </ul>

            <h3 style="color: #333; margin-bottom: 15px; margin-top: 25px;">Level Kursus:</h3>
            <p style="color: #666;">
                <span style="display: inline-block; background: #e8f5e9; color: #2e7d32; padding: 6px 12px; border-radius: 20px; font-size: 0.9rem;">
                    {{ $course->level ?? 'Semua Level' }}
                </span>
            </p>
        </div>

        <!-- Curriculum Tab -->
        <div id="curriculum-content" style="padding: 30px; display: none;">
            <h2 style="margin-top: 0; color: #333;">Kurikulum Kursus</h2>
            <p style="color: #666; margin-bottom: 30px;">Berikut adalah struktur materi kursus yang akan Anda pelajari.</p>

            @if($course->weeks && $course->weeks->count() > 0)
                @foreach($course->weeks as $week)
                <div style="margin-bottom: 20px; border: 1px solid #e0e0e0; border-radius: 8px; overflow: hidden;">
                    <div style="background: #f8f9fa; padding: 15px; border-bottom: 1px solid #e0e0e0;">
                        <h3 style="margin: 0; color: #333; font-size: 1.1rem;">Minggu {{ $week->week_number }}: {{ $week->title }}</h3>
                        @if($week->description)
                        <p style="margin: 5px 0 0 0; color: #666; font-size: 0.9rem;">{{ $week->description }}</p>
                        @endif
                    </div>
                    <div style="padding: 15px;">
                        @if($week->materials && $week->materials->count() > 0)
                            @foreach($week->materials as $material)
                            <div style="display: flex; align-items: center; padding: 10px 0; border-bottom: 1px solid #f0f0f0;">
                                <div style="flex: 1;">
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        @if($material->type == 'video')
                                        <span style="color: #dc3545;">🎥</span>
                                        @elseif($material->type == 'pdf')
                                        <span style="color: #dc3545;">📄</span>
                                        @elseif($material->type == 'quiz')
                                        <span style="color: #ffc107;">❓</span>
                                        @else
                                        <span style="color: #6c757d;">📚</span>
                                        @endif
                                        <div>
                                            <h4 style="margin: 0; color: #333; font-size: 1rem;">{{ $material->title }}</h4>
                                            @if($material->description)
                                            <p style="margin: 2px 0 0 0; color: #666; font-size: 0.85rem;">{{ $material->description }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div style="color: #666; font-size: 0.9rem;">
                                    @if($material->duration)
                                    {{ $material->duration }} menit
                                    @else
                                    -
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        @else
                            <p style="color: #666; font-style: italic; margin: 10px 0;">Belum ada materi untuk minggu ini.</p>
                        @endif
                    </div>
                </div>
                @endforeach
            @else
                <p style="color: #666; font-style: italic;">Kurikulum belum tersedia untuk kursus ini.</p>
            @endif
        </div>
    </div>

    <script>
        function showTab(tabName) {
            // Hide all tab contents
            document.getElementById('overview-content').style.display = 'none';
            document.getElementById('curriculum-content').style.display = 'none';

            // Remove active styling from tabs
            document.getElementById('overview-tab').style.borderBottom = 'none';
            document.getElementById('overview-tab').style.color = '#666';
            document.getElementById('curriculum-tab').style.borderBottom = 'none';
            document.getElementById('curriculum-tab').style.color = '#666';

            // Show selected tab content
            document.getElementById(tabName + '-content').style.display = 'block';

            // Add active styling to selected tab
            document.getElementById(tabName + '-tab').style.borderBottom = '3px solid #667eea';
            document.getElementById(tabName + '-tab').style.color = '#667eea';
        }
    </script>
</div>

<!-- Success/Error Messages -->
@if(session('success'))
    <div style="position:fixed;top:20px;right:20px;z-index:9999;">
        <div style="background:#d4edda;color:#155724;padding:12px 18px;border-radius:8px;border:1px solid #c3e6cb;">
            {!! session('success') !!}
        </div>
    </div>
@endif

@if(session('info'))
    <div style="position:fixed;top:20px;right:20px;z-index:9999;">
        <div style="background:#d1ecf1;color:#0c5460;padding:12px 18px;border-radius:8px;border:1px solid #bee5eb;">
            {!! session('info') !!}
        </div>
    </div>
@endif

@if(session('error'))
    <div style="position:fixed;top:20px;right:20px;z-index:9999;">
        <div style="background:#f8d7da;color:#721c24;padding:12px 18px;border-radius:8px;border:1px solid #f5c6cb;">
            {!! session('error') !!}
        </div>
    </div>
@endif

@endsection
