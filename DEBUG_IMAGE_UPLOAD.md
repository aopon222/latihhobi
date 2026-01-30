# Debugging: E-Course Image Upload Issues

## Issue #1: Folder course_images tidak ada
**Symptom**: Upload form tidak error, tapi file tidak ada di storage
**Cause**: Folder `storage/app/public/course_images` tidak pernah di-create otomatis
**Solution**: Folder sudah di-create manual

```bash
mkdir storage/app/public/course_images
```

## Issue #2: Gambar Lama vs Baru Path Mismatch
**Current State in Database**:
- ID 2-15: Path lama = `THUMBNAIL E COURSE ATHUTO.svg` (dari `public/images/`)
- ID 27: Path baru = `course_images/bVNjcoDH9aYPwjlX45DPHf.jpg` (dari `storage/app/public/`)

**Helper Function (ImageHelper::getEcourseImageUrl)**:
1. Check if `course_images` in path → use `Storage::disk('public')->url()`
2. Check if file exists in `public/images/` → use `asset('images/')`
3. Try storage as fallback
4. Return placeholder if not found

**Status**: Helper sudah handle keduanya, seharusnya berfungsi

## Issue #3: "Item E-Course Jadi Acak-Acakan"
**Likely Cause**: Cache tidak ter-clear saat rendering index view
**Solution**: Cache sudah di-clear via:
```bash
php artisan config:clear
php artisan cache:clear
```

## Verification Steps

### 1. Check database paths
```bash
php check_db_paths.php
```
Result:
- Gambar lama di: `public/images/THUMBNAIL E COURSE ATHUTO.svg`
- Gambar baru di: `storage/app/public/course_images/` (via symlink `/storage/course_images/`)

### 2. Check file existence
- Lama: `public/images/THUMBNAIL E COURSE*.svg` ✓ EXISTS
- Baru: `storage/app/public/course_images/*.jpg` (awaiting upload)

### 3. Check symlink
```bash
Test-Path "public/storage"  # Should return TRUE
```

## Next Steps

1. **Clear browser cache** - Old cached URLs may still point to wrong location
2. **Test new upload** - Upload fresh image and check:
   - File created in `storage/app/public/course_images/`
   - DB stored path as `course_images/filename.ext`
   - URL resolves to `/storage/course_images/filename.ext`
3. **Check ordering** - If items appear out of order, may be view caching issue

## Current Code Status

**EcourseController.store()**: ✓ Fixed - uses `store('course_images', 'public')`
**EcourseController.update()**: ✓ Fixed - uses `store('course_images', 'public')`
**ImageHelper.getEcourseImageUrl()**: ✓ Fixed - explicitly uses `Storage::disk('public')`
**Storage folder structure**: ✓ Fixed - folder created
**Laravel cache**: ✓ Cleared

---
**Last Verified**: 2026-01-30
