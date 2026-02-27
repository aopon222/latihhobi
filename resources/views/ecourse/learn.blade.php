@extends('layout.app')

@section('title', $course->name . ' - Belajar | LatihHobi')

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 100px 20px 40px;">
    <!-- Header Kursus -->
    <div style="background: white; border-radius: 12px; padding: 30px; margin-bottom: 30px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
        <div style="display: grid; grid-template-columns: 200px 1fr; gap: 30px; align-items: start;">
            <!-- Gambar Kursus -->
            <div style="background: transparent; border-radius: 8px; overflow: hidden;">
                <img src="{{ getEcourseImageUrl($course->image_url) }}" alt="{{ $course->name }}" style="width: 100%; height: 150px; object-fit: cover; border-radius: 8px;">
            </div>

            <!-- Info Kursus -->
            <div>
                <h1 style="font-size: 2.2rem; margin: 0 0 10px 0; color: #333;">{{ $course->name }}</h1>
                <p style="color: #666; font-size: 1.1rem; margin: 0 0 15px 0;">By {{ $course->course_by ?? 'Latihhobi' }}</p>

                <!-- Progress Bar -->
                <div style="margin-bottom: 20px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                        <span style="font-weight: bold; color: #333;">Progress Kursus</span>
                        <span class="progress-text" style="color: #667eea; font-weight: bold;">{{ $progressPercent }}%</span>
                    </div>
                    <div style="width: 100%; height: 8px; background: #e0e0e0; border-radius: 4px; overflow: hidden;">
                        <div class="progress-bar" style="width: {{ $progressPercent }}%; height: 100%; background: linear-gradient(90deg, #667eea, #764ba2); transition: width 0.3s;"></div>
                    </div>
                </div>

                <!-- Deskripsi Singkat -->
                <p style="color: #666; line-height: 1.6; margin: 0;">
                    @if($course->description)
                        {{ Str::limit($course->description, 200) }}
                    @else
                        Pelajari {{ $course->name }} dengan materi yang komprehensif dan praktis.
                    @endif
                </p>
            </div>
        </div>
    </div>

    <!-- Kurikulum dan Materi -->
    @if($course->weeks && $course->weeks->count() > 0)
        @foreach($course->weeks as $week)
        <div style="background: white; border-radius: 12px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); overflow: hidden;">
            <!-- Header Minggu -->
            <div style="background: #f8f9fa; padding: 20px; border-bottom: 1px solid #e0e0e0;">
                <h2 style="margin: 0; color: #333; font-size: 1.3rem;">Minggu {{ $week->week_number }}: {{ $week->title }}</h2>
                @if($week->description)
                <p style="margin: 5px 0 0 0; color: #666; font-size: 0.9rem;">{{ $week->description }}</p>
                @endif
            </div>

            <!-- Daftar Materi -->
            <div style="padding: 20px;">
                @if($week->materials && $week->materials->count() > 0)
                    @foreach($week->materials as $material)
                    <div data-material-id="{{ $material->id }}" style="border: 1px solid #e0e0e0; border-radius: 8px; margin-bottom: 15px; overflow: hidden;">
                        <div style="display: flex; align-items: center; padding: 15px; background: #fafafa;">
                            <!-- Icon Materi -->
                            <div style="margin-right: 15px;">
                                @if($material->type == 'video')
                                <span style="font-size: 2rem; color: #dc3545;">🎥</span>
                                @elseif($material->type == 'pdf')
                                <span style="font-size: 2rem; color: #dc3545;">📄</span>
                                @elseif($material->type == 'quiz')
                                <span style="font-size: 2rem; color: #ffc107;">❓</span>
                                @else
                                <span style="font-size: 2rem; color: #6c757d;">📚</span>
                                @endif
                            </div>

                            <!-- Info Materi -->
                            <div style="flex: 1;">
                                <h3 style="margin: 0 0 5px 0; color: #333; font-size: 1.1rem;">{{ $material->title }}</h3>
                                @if($material->description)
                                <p style="margin: 0; color: #666; font-size: 0.9rem;">{{ $material->description }}</p>
                                @endif
                                @if($material->duration)
                                <p style="margin: 5px 0 0 0; color: #999; font-size: 0.8rem;">Durasi: {{ $material->duration }} menit</p>
                                @endif
                            </div>


                            <!-- Status Progress -->
                            <div class="material-status" style="margin-right: 15px;">
                                @php
                                    $isCompleted = isset($progressData[$material->id]) && $progressData[$material->id];
                                @endphp
                                @if($isCompleted)
                                <span style="background: #28a745; color: white; padding: 6px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: bold;">✓ Selesai</span>
                                @else
                                <span style="background: #ffc107; color: #333; padding: 6px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: bold;">Belum Selesai</span>
                                @endif
                            </div>

                            <!-- Tombol Aksi -->
                            <div>
                                @if($material->type == 'video' && $material->content_url)
                                <button onclick="openMaterial('{{ $material->id }}', 'video', '{{ $material->content_url }}')" style="background: #667eea; color: white; border: none; padding: 10px 15px; border-radius: 6px; cursor: pointer; font-weight: bold;">Tonton</button>
                                @elseif($material->type == 'pdf' && $material->content_url)
                                <a href="{{ asset('storage/' . $material->content_url) }}" target="_blank" style="background: #28a745; color: white; text-decoration: none; padding: 10px 15px; border-radius: 6px; font-weight: bold; display: inline-block;">Baca PDF</a>
                                @elseif($material->type == 'quiz')
                                <button onclick="openMaterial('{{ $material->id }}', 'quiz', '{{ $material->content_url }}')" style="background: #ffc107; color: #333; border: none; padding: 10px 15px; border-radius: 6px; cursor: pointer; font-weight: bold;">Kerjakan Quiz</button>
                                @else
                                <button onclick="openMaterial('{{ $material->id }}', 'text', '{{ $material->content_url }}')" style="background: #6c757d; color: white; border: none; padding: 10px 15px; border-radius: 6px; cursor: pointer; font-weight: bold;">Baca</button>
                                @endif

                                @if(!$isCompleted)
                                <button class="mark-complete-btn" onclick="markComplete({{ $material->id }})" style="background: #28a745; color: white; border: none; padding: 10px 15px; border-radius: 6px; cursor: pointer; font-weight: bold; margin-left: 10px;">Tandai Selesai</button>
                                @endif
                            </div>
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
        <div style="background: white; border-radius: 12px; padding: 30px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
            <p style="color: #666; font-style: italic;">Kurikulum belum tersedia untuk kursus ini.</p>
        </div>
    @endif

    <!-- Modal untuk Video/Quiz -->
    <div id="materialModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 1000; justify-content: center; align-items: center;">
        <div style="background: white; border-radius: 12px; width: 90%; max-width: 800px; max-height: 80%; overflow: hidden; position: relative;">
            <div style="padding: 20px; border-bottom: 1px solid #e0e0e0; display: flex; justify-content: space-between; align-items: center;">
                <h3 id="modalTitle" style="margin: 0; color: #333;"></h3>
                <button onclick="closeModal()" style="background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #666;">×</button>
            </div>
            <div id="modalContent" style="padding: 20px; height: 400px; overflow-y: auto;">
                <!-- Konten akan diisi oleh JavaScript -->
            </div>
        </div>
    </div>
</div>

<script>
    function openMaterial(materialId, type, contentUrl) {
        const modal = document.getElementById('materialModal');
        const modalTitle = document.getElementById('modalTitle');
        const modalContent = document.getElementById('modalContent');

        modalTitle.textContent = 'Memuat materi...';
        modalContent.innerHTML = '<p style="text-align: center;">Memuat...</p>';
        modal.style.display = 'flex';

        if (type === 'video') {
            modalTitle.textContent = 'Video Materi';
            modalContent.innerHTML = `
                <video controls style="width: 100%; height: 350px;">
                    <source src="${contentUrl}" type="video/mp4">
                    Browser Anda tidak mendukung video.
                </video>
            `;
        } else if (type === 'quiz') {
            modalTitle.textContent = 'Quiz';
            modalContent.innerHTML = `
                <p>Quiz akan dimuat di sini. Konten: ${contentUrl}</p>
                <button onclick="submitQuiz(${materialId})" style="background: #667eea; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer;">Kirim Jawaban</button>
            `;
        } else {
            modalTitle.textContent = 'Materi Teks';
            modalContent.innerHTML = `<p>${contentUrl}</p>`;
        }
    }

    function closeModal() {
        document.getElementById('materialModal').style.display = 'none';
    }

    function markComplete(materialId) {
        fetch(`/ecourse/mark-complete/${materialId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ is_completed: true })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update progress bar tanpa reload
                const progressBar = document.querySelector('.progress-bar');
                const progressText = document.querySelector('.progress-text');
                if (progressBar && progressText && data.progress_percent !== undefined) {
                    progressBar.style.width = data.progress_percent + '%';
                    progressText.textContent = data.progress_percent + '%';
                }

                // Update status materi
                const materialElement = document.querySelector(`[data-material-id="${materialId}"]`);
                if (materialElement) {
                    const statusElement = materialElement.querySelector('.material-status');
                    if (statusElement) {
                        statusElement.innerHTML = '<span style="background: #28a745; color: white; padding: 6px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: bold;">✓ Selesai</span>';
                    }

                    // Remove mark complete button
                    const markButton = materialElement.querySelector('.mark-complete-btn');
                    if (markButton) {
                        markButton.remove();
                    }
                }

                // Show success message
                showMessage('Materi berhasil ditandai selesai!', 'success');
            } else {
                showMessage('Gagal menandai materi selesai', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showMessage('Terjadi kesalahan', 'error');
        });
    }

    function showMessage(message, type) {
        const messageDiv = document.createElement('div');
        messageDiv.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            padding: 12px 18px;
            border-radius: 8px;
            color: white;
            font-weight: bold;
            max-width: 300px;
        `;

        if (type === 'success') {
            messageDiv.style.backgroundColor = '#28a745';
        } else {
            messageDiv.style.backgroundColor = '#dc3545';
        }

        messageDiv.textContent = message;
        document.body.appendChild(messageDiv);

        setTimeout(() => {
            document.body.removeChild(messageDiv);
        }, 3000);
    }

    function submitQuiz(materialId) {
        // Implementasi submit quiz
        alert('Quiz submitted for material ' + materialId);
        closeModal();
    }
</script>

<!-- Success/Error Messages -->
@if(session('success'))
    <div style="position:fixed;top:20px;right:20px;z-index:9999;">
        <div style="background:#d4edda;color:#155724;padding:12px 18px;border-radius:8px;border:1px solid #c3e6cb;">
            {!! session('success') !!}
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
