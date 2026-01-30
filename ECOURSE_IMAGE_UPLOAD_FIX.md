# Fix: Ecourse Image Upload Not Displaying

**Issue**: Ketika menambah atau mengupdate e-course dari admin panel, gambar tidak ditampilkan meskipun file sudah terupload.

## Root Cause

Kode original menggunakan:
```php
$path = $request->file('image')->store('public/course_images');
```

Ini menyimpan file ke disk **'local'** (private disk) di path:
```
storage/app/private/public/course_images/...
```

Kemudian kode mencoba mengakses dengan:
```php
$rel = str_replace('public/', '', $path);
$data['image_url'] = $rel;
```

Hasilnya path yang disimpan di database adalah `course_images/filename.ext`, yang tidak dapat diakses melalui web karena:
1. File tersimpan di disk private, bukan public
2. Path salah untuk resolusi di helper function

## Solution

### 1. Ubah upload ke public disk (EcourseController)

**store() method:**
```php
// BEFORE
$path = $request->file('image')->store('public/course_images');
$rel = str_replace('public/', '', $path);
$data['image_url'] = $rel;

// AFTER
$path = $request->file('image')->store('course_images', 'public');
$data['image_url'] = $path;
```

**update() method:**
```php
// Sama seperti store()
$path = $request->file('image')->store('course_images', 'public');
$data['image_url'] = $path;
```

### 2. Update ImageHelper untuk gunakan disk public

```php
// BEFORE
if (strpos($imagePath, 'course_images') !== false) {
    return Storage::url($imagePath);  // Default disk 'local'
}

// AFTER
if (strpos($imagePath, 'course_images') !== false) {
    return Storage::disk('public')->url($imagePath);  // Explicit disk 'public'
}
```

## File Storage Structure

Setelah fix, gambar akan tersimpan di:
```
storage/app/public/course_images/filename.ext
```

Accessible melalui symlink:
```
public/storage/course_images/filename.ext
```

Web URL:
```
/storage/course_images/filename.ext
```

## Testing

1. Navigate ke `/admin/ecourses/create`
2. Upload gambar untuk course baru
3. Gambar harus muncul di:
   - Admin course list (thumbnail)
   - Course detail page (full image)
   - Frontend category pages

## Files Modified

- `app/Http/Controllers/Admin/EcourseController.php` - store() & update() methods
- `app/Helpers/ImageHelper.php` - getEcourseImageUrl() method

---
**Date Fixed**: 2026-01-30  
**Commit**: cfe6527b
