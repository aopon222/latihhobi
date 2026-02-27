@extends('admin.layout')

@section('title', 'Edit E-course - Admin LatihHobi')

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
    <h1 style="font-size:2rem;font-weight:700;color:#2563eb;">Edit E-course</h1>
    <div style="display:flex;gap:12px;">
        <a href="{{ route('ecourse.show', $ecourse->id_course) }}" 
           style="background:#3b82f6;color:white;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600;display:flex;align-items:center;gap:8px;">
            <svg style="width:20px;height:20px;" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
            </svg>
            Lihat Detail
        </a>
        <a href="{{ route('admin.ecourses.index') }}" 
           style="background:#6b7280;color:white;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600;display:flex;align-items:center;gap:8px;">
            <svg style="width:20px;height:20px;" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0L2.586 11a2 2 0 010-2.828L6.293 4.465a1 1 0 011.414 1.414L4.414 9H17a1 1 0 110 2H4.414l3.293 3.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
            </svg>
            Kembali
        </a>
    </div>
</div>

<div style="background:#fff;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.04);padding:32px;">
    <form method="POST" action="{{ route('admin.ecourses.update', $ecourse) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <!-- Current values for comparison -->
        <div style="margin-bottom:20px;padding:12px;border:1px solid #e5e7eb;border-radius:8px;background:#f9fafb;">
            <h3 style="margin:0 0 8px 0;font-weight:700;color:#111827;">Nilai Saat Ini (sebelum perubahan)</h3>
            <div style="display:flex;gap:16px;flex-wrap:wrap;">
                <div style="min-width:200px;">
                    <span style="font-size:12px;color:#6b7280;">Nama:</span>
                    <div style="font-weight:600;">{{ $ecourse->name }}</div>
                </div>
                <div style="min-width:150px;">
                    <span style="font-size:12px;color:#6b7280;">Harga:</span>
                    <div style="font-weight:600;">Rp {{ number_format($ecourse->price, 0, ',', '.') }}</div>
                </div>
                <div style="min-width:150px;">
                    <span style="font-size:12px;color:#6b7280;">Level:</span>
                    <div style="font-weight:600;">{{ $ecourse->level ?? '-' }}</div>
                </div>
            </div>
        </div>

        <!-- Current Image Display with Debug Info -->
        @php 
            $adminMain = $ecourse->image_url ?? null;
            $mainDebug = \App\Helpers\ImageHelper::debugImagePath($adminMain);
        @endphp
        @if($adminMain)
        <div style="margin-bottom:24px;padding:16px;border:1px solid #e5e7eb;border-radius:8px;background:#f0fdf4;">
            <h4 style="margin:0 0 12px 0;font-weight:600;color:#166534;">Gambar Saat Ini</h4>
            <div style="display:flex;gap:16px;align-items:start;">
                <img src="{{ getEcourseImageUrl($adminMain) }}" 
                     alt="Current Image"
                     style="width:200px;height:150px;object-fit:cover;border-radius:8px;border:1px solid #e5e7eb;">
                <div style="flex:1;">
                    <div style="font-size:13px;margin-bottom:4px;">
                        <strong>Path di Database:</strong> {{ $adminMain }}
                    </div>
                    <div style="font-size:13px;margin-bottom:4px;color:{{ $mainDebug['storage_exists'] ? '#166534' : '#dc2626' }};">
                        <strong>Storage (course_images):</strong> {{ $mainDebug['storage_exists'] ? '✓ Ditemukan' : '✗ Tidak Ditemukan' }}
                    </div>
                    <div style="font-size:13px;margin-bottom:4px;color:{{ $mainDebug['public_exists'] ? '#166534' : '#dc2626' }};">
                        <strong>Public (images):</strong> {{ $mainDebug['public_exists'] ? '✓ Ditemukan' : '✗ Tidak Ditemukan' }}
                    </div>
                    <div style="font-size:13px;margin-bottom:8px;background:#e0e7ff;padding:8px;border-radius:4px;">
                        <strong>URL Akhir:</strong> <span style="word-break:break-all;">{{ $mainDebug['final_url'] }}</span>
                    </div>
                    @if(!$mainDebug['storage_exists'] && !$mainDebug['public_exists'])
                    <div style="background:#fef2f2;border:1px solid #fecaca;padding:8px;border-radius:4px;color:#dc2626;font-size:13px;">
                        ⚠️ <strong>Peringatan:</strong> File gambar tidak ditemukan! Silakan upload ulang gambar.
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif
        
        <!-- Basic Information -->
        <div style="margin-bottom:32px;">
            <h2 style="font-size:1.25rem;font-weight:600;color:#374151;margin-bottom:16px;border-bottom:2px solid #e5e7eb;padding-bottom:8px;">Informasi Dasar</h2>
            
            <div style="display:grid;grid-template-columns:2fr 1fr;gap:24px;margin-bottom:24px;">
                <div>
                    <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Judul E-course *</label>
                    <input type="text" name="name" value="{{ old('name', $ecourse->name) }}" required
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
                            <option value="{{ $value }}" {{ old('id_category', $ecourse->id_category) == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_category')
                        <p style="color:#ef4444;font-size:12px;margin-top:4px;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;margin-bottom:24px;">
                <div>
                    <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Instruktur/Pembuat</label>
                    <input type="text" name="course_by" value="{{ old('course_by', $ecourse->course_by) }}"
                           style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;"
                           placeholder="Nama instruktur">
                </div>
                
                <div>
                    <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Level *</label>
                    <select name="level" required
                            style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;">
                        <option value="">Pilih Level</option>
                        @foreach($levels as $level)
                            <option value="{{ $level }}" {{ old('level', $ecourse->level) == $level ? 'selected' : '' }}>
                                {{ $level }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div>
                <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Deskripsi Singkat</label>
                <textarea name="short_description" rows="2"
                          style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;"
                          placeholder="Deskripsi singkat e-course">{{ old('short_description', $ecourse->short_description) }}</textarea>
            </div>
        </div>

        <!-- Pricing -->
        <div style="margin-bottom:32px;">
            <h2 style="font-size:1.25rem;font-weight:600;color:#374151;margin-bottom:16px;border-bottom:2px solid #e5e7eb;padding-bottom:8px;">Harga</h2>
            
            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:24px;">
                <div>
                    <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Harga Normal (Rp) *</label>
                    <input type="number" id="original_price_input" name="original_price" value="{{ old('original_price', $ecourse->original_price) }}" required min="0"
                           style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;"
                           placeholder="Harga normal">
                </div>
                
                <div>
                    <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Diskon (Rp)</label>
                    <input type="number" id="discount_input" name="discount" value="{{ old('discount', $ecourse->original_price - $ecourse->price) }}" min="0"
                           style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;"
                           placeholder="Jumlah diskon">
                </div>
                
                <div>
                    <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Harga Akhir (Rp)</label>
                    <input type="number" id="price_input" name="price" value="{{ old('price', $ecourse->price) }}" required min="0"
                           style="width:100%;padding:12px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;background:#f9fafb;"
                           readonly>
                </div>
            </div>
        </div>

        <!-- Image Upload -->
        <div style="margin-bottom:32px;">
            <h2 style="font-size:1.25rem;font-weight:600;color:#374151;margin-bottom:16px;border-bottom:2px solid #e5e7eb;padding-bottom:8px;">Gambar Cover</h2>
            
            <div>
                <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;">Upload Gambar Baru (Opsional)</label>
                <input type="file" name="image" accept="image/*"
                       style="width:100%;padding:12px;border:2px dashed #d1d5db;border-radius:8px;font-size:14px;background:#f9fafb;">
                <p style="color:#6b7280;font-size:12px;margin-top:4px;">Format yang didukung: JPEG, PNG, JPG, GIF. Maksimal 2MB.</p>
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
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $ecourse->is_featured) ? 'checked' : '' }}
                           style="width:18px;height:18px;">
                    <span style="font-weight:500;color:#374151;">Jadikan sebagai featured course</span>
                </label>
                
                <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $ecourse->is_active) ? 'checked' : '' }}
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
                Update E-course
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
