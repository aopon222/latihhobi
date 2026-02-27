# TODO: Create Laravel Routes for Database "Sarana"

## Information Gathered
- Database "sarana" contains the following tables:
  - siswa (id_siswa, nama_siswa, kelas, jurusan, no_hp, email)
  - kategori (id_kategori, nama_kategori)
  - admin (id_admin, nama_admin, username, password, level)
  - input_aspirasi (id_input, id_siswa, id_kategori, judul, isi, tanggal_input)
  - aspirasi (id_aspirasi, id_input, status, tanggal_proses, tanggal_selesai, feedback)
- Migrations for these tables already exist in database/migrations/
- Models do not exist yet
- Controllers do not exist yet
- web.php exists but does not have routes for these tables

## Plan
1. Create Eloquent models for each table:
   - App/Models/Admin.php
   - App/Models/Siswa.php
   - App/Models/Kategori.php
   - App/Models/InputAspirasi.php
   - App/Models/Aspirasi.php

2. Create resource controllers for each model:
   - App/Http/Controllers/Admin/AdminController.php
   - App/Http/Controllers/Admin/SiswaController.php
   - App/Http/Controllers/Admin/KategoriController.php
   - App/Http/Controllers/Admin/InputAspirasiController.php
   - App/Http/Controllers/Admin/AspirasiController.php

3. Add resource routes to routes/web.php for each controller

## Dependent Files to be edited
- routes/web.php (add routes)
- New files: 5 models, 5 controllers

## Followup Steps
- Test routes by accessing them
- Create basic views if needed for CRUD operations
- Ensure database connections work properly
