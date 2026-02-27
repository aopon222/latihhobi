@extends('admin.layout')

@section('title', 'Tambah E-course - Admin LatihHobi')

@section('admin-content')
<style>
    /* Hide number input spinners */
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    input[type="number"] {
        -moz-appearance: textfield;
    }
</style>
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:32px;">
    <h1 style="font-size:2rem;font-weight:700;color:#2563eb;">Tambah E-course</h1>
    <a href="{{ route('admin.ecourses.index') }}" 
       style="background:#6b7280;color:white;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600;display:flex;align-items:center;gap:8px;">
        <svg style="width:20px;height:20px;" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0L2.586 11a2 2 0 010-2.828L6.293 4.465a1 1 0 011.414 1.414L4.414 9H17a1 1 0 110 2H4.414l3.293 3.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
        </svg>
        Kembali
    </a>
</div>

<div style="background:#fff;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.04);padding:32px;">
    <form method="POST" action="{{ route('admin.ecourses.store') }}" enctype="multipart/form-data">
        @csrf
        
        <!-- Basic Information -->
        <div style="margin-bottom:32px;">
            <h2 style="font-size:1.25rem;font-weight:600;color:#374151;margin-bottom:16px;border-bottom:2px solid #e5e7eb;padding-bottom:8px;">Informasi Dasar</h2>
            
            <div style="display:grid;grid-template-columns:2fr 1fr;gap:24px;margin-bottom:24px;">
                <div>
                    <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Judul E-course *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           style="width:100%;padding:12px;border:1px solid {{ $errors->has('name') ? '#ef4444' : '#d1d5db' }};border-radius:8px;font-size:14px;"
                           placeholder="Masukkan judul e-course">
                    @error('name')
                        <p style="color:#ef4444;font-size:12px;margin-top:4px;">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Kategori *</label>
                    <div style="display:flex;gap:8px;align-items:flex-start;">
                        <div style="flex:1;">
                            <select name="id_category" id="category-select"
                                    style="width:100%;padding:12px;border:1px solid {{ $errors->has('id_category') ? '#ef4444' : '#d1d5db' }};border-radius:8px;font-size:14px;">
                                <option value="">Pilih Kategori atau Buat Baru</option>
                                @foreach($categories as $value => $label)
                                    <option value="{{ $value }}" {{ old('id_category') == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                                <option value="__new__" style="color:#2563eb;font-weight:600;">+ Buat Kategori Baru</option>
                            </select>
                            @error('id_category')
                                <p style="color:#ef4444;font-size:12px;margin-top:4px;">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Hidden input for new category name -->
                    <input type="hidden" name="new_category_name" id="new-category-name" value="">
                    
                    <!-- Modal for creating new category -->
                    <div id="category-modal" style="display:none;position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(0,0,0,0.5);z-index:9999;align-items:center;justify-content:center;">
                        <div style="background:white;border-radius:12px;padding:32px;max-width:400px;width:90%;">
                            <h3 style="font-size:1.25rem;font-weight:600;color:#374151;margin-bottom:16px;">Buat Kategori Baru</h3>
                            <div style="margin-bottom:24px;">
                                <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Nama Kategori *</label>
                                <input type="text" id="new-category-input" placeholder="Contoh: Web Development"
                                       style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;">
                                <p id="category-error" style="color:#ef4444;font-size:12px;margin-top:4px;display:none;"></p>
                            </div>
                            <div style="display:flex;gap:12px;justify-content:flex-end;">
                                <button type="button" id="cancel-category" style="background:#6b7280;color:white;padding:10px 20px;border:none;border-radius:8px;font-weight:600;cursor:pointer;">
                                    Batal
                                </button>
                                <button type="button" id="submit-category" style="background:#2563eb;color:white;padding:10px 20px;border:none;border-radius:8px;font-weight:600;cursor:pointer;">
                                    Buat
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    (function() {
                        const categorySelect = document.getElementById('category-select');
                        const categoryModal = document.getElementById('category-modal');
                        const newCategoryInput = document.getElementById('new-category-input');
                        const categoryError = document.getElementById('category-error');
                        const submitBtn = document.getElementById('submit-category');
                        const cancelBtn = document.getElementById('cancel-category');
                        const newCategoryNameInput = document.getElementById('new-category-name');
                        
                        categorySelect.addEventListener('change', function(e) {
                            if (this.value === '__new__') {
                                categoryModal.style.display = 'flex';
                                newCategoryInput.focus();
                            }
                        });
                        
                        cancelBtn.addEventListener('click', function() {
                            categoryModal.style.display = 'none';
                            categorySelect.value = '';
                            newCategoryInput.value = '';
                            categoryError.style.display = 'none';
                        });
                        
                        submitBtn.addEventListener('click', function() {
                            const categoryName = newCategoryInput.value.trim();
                            if (!categoryName) {
                                categoryError.textContent = 'Nama kategori tidak boleh kosong';
                                categoryError.style.display = 'block';
                                return;
                            }
                            if (categoryName.length > 100) {
                                categoryError.textContent = 'Nama kategori maksimal 100 karakter';
                                categoryError.style.display = 'block';
                                return;
                            }
                            // Store the new category name in hidden input
                            newCategoryNameInput.value = categoryName;
                            categoryModal.style.display = 'none';
                            // Update select display to show new category
                            categorySelect.innerHTML = '<option value="">✓ Kategori baru: ' + categoryName + '</option>' + categorySelect.innerHTML;
                            categorySelect.value = '';
                            newCategoryInput.value = '';
                            categoryError.style.display = 'none';
                        });
                        
                        // Allow Enter key to submit
                        newCategoryInput.addEventListener('keypress', function(e) {
                            if (e.key === 'Enter') {
                                submitBtn.click();
                            }
                        });
                    })();
                </script>
            </div>
            
            <div style="margin-bottom:24px;">
                <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Deskripsi Singkat *</label>
                <textarea name="short_description" required rows="3"
                          style="width:100%;padding:12px;border:1px solid {{ $errors->has('short_description') ? '#ef4444' : '#d1d5db' }};border-radius:8px;font-size:14px;resize:vertical;"
                          placeholder="Deskripsi singkat untuk preview (maksimal 500 karakter)">{{ old('short_description') }}</textarea>
                @error('short_description')
                    <p style="color:#ef4444;font-size:12px;margin-top:4px;">{{ $message }}</p>
                @enderror
            </div>
            
            <div style="margin-bottom:24px;">
                <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Deskripsi Lengkap *</label>
                <textarea name="description" required rows="6"
                          style="width:100%;padding:12px;border:1px solid {{ $errors->has('description') ? '#ef4444' : '#d1d5db' }};border-radius:8px;font-size:14px;resize:vertical;"
                          placeholder="Deskripsi detail tentang e-course ini">{{ old('description') }}</textarea>
                @error('description')
                    <p style="color:#ef4444;font-size:12px;margin-top:4px;">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Course Details -->
        <div style="margin-bottom:32px;">
            <h2 style="font-size:1.25rem;font-weight:600;color:#374151;margin-bottom:16px;border-bottom:2px solid #e5e7eb;padding-bottom:8px;">Detail Kursus</h2>
            
            <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));gap:24px;margin-bottom:24px;">
                <div>
                    <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Harga Asli (Rp) *</label>
                    <input type="number" id="original_price_input" name="original_price" value="{{ old('original_price') }}" required min="0"
                           style="width:100%;padding:12px;border:1px solid {{ $errors->has('original_price') ? '#ef4444' : '#d1d5db' }};border-radius:8px;font-size:14px;"
                           placeholder="Contoh: 500000">
                    <p style="color:#6b7280;font-size:12px;margin-top:4px;">Harga normal sebelum diskon</p>
                    @error('original_price')
                        <p style="color:#ef4444;font-size:12px;margin-top:4px;">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Diskon (Rp)</label>
                    <input type="number" id="discount_input" value="{{ old('discount', 0) }}" min="0"
                           style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;"
                           placeholder="Contoh: 150000">
                    <p style="color:#6b7280;font-size:12px;margin-top:4px;">Isi hanya jika ada diskon. Contoh: harga asli 500000, diskon 150000 -> harga jual 350000.</p>
                </div>
                
                <div>
                    <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Harga Jual (Rp) *</label>
                    <input type="number" id="price_input" name="price" value="{{ old('price') }}" required min="0" readonly
                           style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;background:#f9fafb;cursor:not-allowed;"
                           placeholder="Auto-calculated">
                    <p style="color:#10b981;font-size:12px;margin-top:4px;font-weight:600;">Otomatis = Harga Asli - Diskon</p>
                    @error('price')
                        <p style="color:#ef4444;font-size:12px;margin-top:4px;">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Durasi *</label>
                    <input type="text" name="duration" value="{{ old('duration') }}" required
                           style="width:100%;padding:12px;border:1px solid {{ $errors->has('duration') ? '#ef4444' : '#d1d5db' }};border-radius:8px;font-size:14px;"
                           placeholder="Contoh: 4 Minggu">
                    @error('duration')
                        <p style="color:#ef4444;font-size:12px;margin-top:4px;">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Total Pelajaran *</label>
                    <input type="number" name="total_lessons" value="{{ old('total_lessons') }}" required min="1"
                           style="width:100%;padding:12px;border:1px solid {{ $errors->has('total_lessons') ? '#ef4444' : '#d1d5db' }};border-radius:8px;font-size:14px;"
                           placeholder="Contoh: 12">
                    @error('total_lessons')
                        <p style="color:#ef4444;font-size:12px;margin-top:4px;">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Level *</label>
                    <select name="level" required
                            style="width:100%;padding:12px;border:1px solid {{ $errors->has('level') ? '#ef4444' : '#d1d5db' }};border-radius:8px;font-size:14px;">
                        <option value="">Pilih Level</option>
                        @foreach($levels as $value => $label)
                            <option value="{{ $value }}" {{ old('level') == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('level')
                        <p style="color:#ef4444;font-size:12px;margin-top:4px;">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Video Demo (URL)</label>
                    <input type="url" name="demo_video" value="{{ old('demo_video') }}"
                           style="width:100%;padding:12px;border:1px solid {{ $errors->has('demo_video') ? '#ef4444' : '#d1d5db' }};border-radius:8px;font-size:14px;"
                           placeholder="https://youtube.com/watch?v=...">
                    @error('demo_video')
                        <p style="color:#ef4444;font-size:12px;margin-top:4px;">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Media Files -->
        <div style="margin-bottom:32px;">
            <h2 style="font-size:1.25rem;font-weight:600;color:#374151;margin-bottom:16px;border-bottom:2px solid #e5e7eb;padding-bottom:8px;">Media</h2>
            
            <div style="display:grid;grid-template-columns:1fr;gap:24px;">
                <div>
                          <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Gambar Utama</label>
                          <input type="file" name="image" accept="image/*"
                              style="width:100%;padding:12px;border:1px solid {{ $errors->has('image') ? '#ef4444' : '#d1d5db' }};border-radius:8px;font-size:14px;">
                    <p style="color:#6b7280;font-size:12px;margin-top:4px;">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB</p>
                    @error('image')
                        <p style="color:#ef4444;font-size:12px;margin-top:4px;">{{ $message }}</p>
                    @enderror
                </div>
                

            </div>
        </div>

        <!-- Course Content -->
        <div style="margin-bottom:32px;">
            <h2 style="font-size:1.25rem;font-weight:600;color:#374151;margin-bottom:16px;border-bottom:2px solid #e5e7eb;padding-bottom:8px;">Konten Kursus</h2>
            
            <div style="margin-bottom:24px;">
                <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Prasyarat</label>
                <textarea name="prerequisites" rows="4"
                          style="width:100%;padding:12px;border:1px solid {{ $errors->has('prerequisites') ? '#ef4444' : '#d1d5db' }};border-radius:8px;font-size:14px;resize:vertical;"
                          placeholder="Masukkan setiap prasyarat di baris baru, contoh:&#10;Pengetahuan dasar komputer&#10;Akses internet stabil&#10;Laptop/PC">{{ old('prerequisites') }}</textarea>
                <p style="color:#6b7280;font-size:12px;margin-top:4px;">Pisahkan setiap prasyarat dengan baris baru</p>
                @error('prerequisites')
                    <p style="color:#ef4444;font-size:12px;margin-top:4px;">{{ $message }}</p>
                @enderror
            </div>
            
            <div style="margin-bottom:24px;">
                <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Hasil Pembelajaran</label>
                <textarea name="learning_outcomes" rows="4"
                          style="width:100%;padding:12px;border:1px solid {{ $errors->has('learning_outcomes') ? '#ef4444' : '#d1d5db' }};border-radius:8px;font-size:14px;resize:vertical;"
                          placeholder="Masukkan setiap hasil pembelajaran di baris baru, contoh:&#10;Mampu membuat website responsif&#10;Memahami konsep pemrograman dasar&#10;Dapat menggunakan framework modern">{{ old('learning_outcomes') }}</textarea>
                <p style="color:#6b7280;font-size:12px;margin-top:4px;">Pisahkan setiap hasil pembelajaran dengan baris baru</p>
                @error('learning_outcomes')
                    <p style="color:#ef4444;font-size:12px;margin-top:4px;">{{ $message }}</p>
                @enderror
            </div>
            
            <div style="margin-bottom:24px;">
                <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Tools yang Dibutuhkan</label>
                <textarea name="tools_needed" rows="4"
                          style="width:100%;padding:12px;border:1px solid {{ $errors->has('tools_needed') ? '#ef4444' : '#d1d5db' }};border-radius:8px;font-size:14px;resize:vertical;"
                          placeholder="Masukkan setiap tool di baris baru, contoh:&#10;Visual Studio Code&#10;Node.js&#10;Web Browser (Chrome/Firefox)">{{ old('tools_needed') }}</textarea>
                <p style="color:#6b7280;font-size:12px;margin-top:4px;">Pisahkan setiap tool dengan baris baru</p>
                @error('tools_needed')
                    <p style="color:#ef4444;font-size:12px;margin-top:4px;">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Settings -->
        <div style="margin-bottom:32px;">
            <h2 style="font-size:1.25rem;font-weight:600;color:#374151;margin-bottom:16px;border-bottom:2px solid #e5e7eb;padding-bottom:8px;">Pengaturan</h2>
            
            <div style="display:flex;gap:32px;">
                <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                           style="width:18px;height:18px;">
                    <span style="font-weight:500;color:#374151;">Jadikan sebagai featured course</span>
                </label>
                
                <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                           style="width:18px;height:18px;">
                    <span style="font-weight:500;color:#374151;">Aktifkan course</span>
                </label>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div style="display:flex;gap:16px;justify-content:end;border-top:1px solid #e5e7eb;padding-top:24px;">
            <a href="{{ route('admin.ecourses.index') }}" 
               style="background:#6b7280;color:white;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600;">
                Batal
            </a>
            <button type="submit" 
                    style="background:#2563eb;color:white;padding:12px 24px;border:none;border-radius:8px;font-weight:600;cursor:pointer;">
                Simpan E-course
            </button>
        </div>
    </form>
</div>

<script>
(function() {
    const originalPriceInput = document.getElementById('original_price_input');
    const discountInput = document.getElementById('discount_input');
    const priceInput = document.getElementById('price_input');
    
    function calculatePrice() {
        const originalPrice = parseFloat(originalPriceInput.value) || 0;
        const discount = parseFloat(discountInput.value) || 0;
        const finalPrice = Math.max(0, originalPrice - discount);
        priceInput.value = finalPrice;
    }
    
    // Calculate on page load
    calculatePrice();
    
    // Recalculate when inputs change
    originalPriceInput.addEventListener('input', calculatePrice);
    discountInput.addEventListener('input', calculatePrice);
})();
</script>
@endsection