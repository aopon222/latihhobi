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
                    <select name="id_category" required
                            style="width:100%;padding:12px;border:1px solid {{ $errors->has('id_category') ? '#ef4444' : '#d1d5db' }};border-radius:8px;font-size:14px;">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $value => $label)
                            <option value="{{ $value }}" {{ old('id_category') == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_category')
                        <p style="color:#ef4444;font-size:12px;margin-top:4px;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:24px;margin-bottom:24px;">
                <div>
                    <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Instruktur/Pembuat</label>
                    <input type="text" name="course_by" value="{{ old('course_by') }}"
                           style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;"
                           placeholder="Nama instruktur">
                </div>
                
                <div>
                    <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Level *</label>
                    <select name="level" required
                            style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;">
                        <option value="">Pilih Level</option>
                        @foreach($levels as $level)
                            <option value="{{ $level }}" {{ old('level') == $level ? 'selected' : '' }}>
                                {{ $level }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Jumlah Minggu *</label>
                    <input type="number" name="total_weeks" value="{{ old('total_weeks', 4) }}" required min="1" max="52"
                           style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;"
                           placeholder="Jumlah minggu">
                    <small style="color:#6b7280;font-size:11px;">Materi akan dibuat otomatis</small>
                </div>
            </div>
            
            <div>
                <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Deskripsi Singkat</label>
                <textarea name="short_description" rows="2"
                          style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;"
                          placeholder="Deskripsi singkat e-course">{{ old('short_description') }}</textarea>
            </div>
        </div>

        <!-- Pricing -->
        <div style="margin-bottom:32px;">
            <h2 style="font-size:1.25rem;font-weight:600;color:#374151;margin-bottom:16px;border-bottom:2px solid #e5e7eb;padding-bottom:8px;">Harga</h2>
            
            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:24px;">
                <div>
                    <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Harga Normal (Rp) *</label>
                    <input type="number" id="original_price_input" name="original_price" value="{{ old('original_price') }}" required min="0"
                           style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;"
                           placeholder="Harga normal">
                </div>
                
                <div>
                    <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Diskon (Rp)</label>
                    <input type="number" id="discount_input" name="discount" value="{{ old('discount') }}" min="0"
                           style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;"
                           placeholder="Jumlah diskon">
                </div>
                
                <div>
                    <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Harga Akhir (Rp)</label>
                    <input type="number" id="price_input" name="price" value="{{ old('price') }}" required min="0"
                           style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;background:#f9fafb;"
                           readonly>
                </div>
            </div>
        </div>

        <!-- Image Upload -->
        <div style="margin-bottom:32px;">
            <h2 style="font-size:1.25rem;font-weight:600;color:#374151;margin-bottom:16px;border-bottom:2px solid #e5e7eb;padding-bottom:8px;">Gambar Cover</h2>
            
            <div>
                <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Upload Gambar</label>
                <input type="file" name="image" accept="image/*"
                       style="width:100%;padding:12px;border:2px dashed #d1d5db;border-radius:8px;font-size:14px;background:#f9fafb;">
                <p style="color:#6b7280;font-size:12px;margin-top:4px;">Format yang didukung: JPEG, PNG, JPG, GIF. Maksimal 2MB.</p>
                <p style="color:#2563eb;font-size:12px;margin-top:4px;">
                    💡 <strong>Info:</strong> Gambar akan disimpan di folder <code>storage/app/public/course_images</code> dan dapat diakses melalui URL <code>/storage/course_images/</code>
                </p>
                @error('image')
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
