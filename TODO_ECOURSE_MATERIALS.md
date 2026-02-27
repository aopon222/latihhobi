# TODO: Container Bahan Ajar E-course (LMS)

## Informasi
- Membuat container bahan ajar untuk e-course mirip LMS universitas
- Sudah ada struktur: Ecourse, EcourseWeek, EcourseMaterial
- Need to add progress tracking untuk siswa

## Plan

### Step 1: Update Database - Tambah Migration untuk Progress Tracking
- [x] `database/migrations/2026_02_01_000004_create_ecourse_material_progress_table.php`
  - Table: ecourse_material_progress
  - Fields: id, user_id, material_id, is_completed, completed_at

### Step 2: Update Model
- [x] `app/Models/EcourseMaterial.php` - Tambah relasi ke progress

### Step 3: Create New Views
- [x] `resources/views/ecourse/learn.blade.php` - Halaman belajar untuk siswa enroll
- [x] Update `resources/views/ecourse/show.blade.php` - Tambah tombolBelajar Sekarang untuk user enroll

### Step 4: Update Controller
- [x] `app/Http/Controllers/EcourseController.php`
  - Tambah method `learn($id)` - halaman belajar
  - Tambah method `markComplete()` - tandai materi selesai

### Step 5: Add Routes
- [x] `routes/web.php` - Tambah route untuk learn dan progress

## Dependent Files
- app/Http/Controllers/EcourseController.php (sudah ada learn & markComplete)
- app/Models/EcourseMaterial.php
- resources/views/ecourse/show.blade.php (sudah ada tombol enroll)
- resources/views/ecourse/learn.blade.php (BARU - sudah dibuat)
- routes/web.php (sudah ada route)

## Followup Steps
- Test enroll dan akses materi
- Test progress tracking
- Tambah styling untuk video player
