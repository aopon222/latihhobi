# 📧 Setup Email Verification - LatihHobi

## 🚨 PENTING: Email Tidak Terkirim?

Jika setelah registrasi tidak ada email verifikasi yang masuk, ikuti langkah-langkah berikut:

## 🔧 Langkah 1: Setup Gmail SMTP (Recommended)

### A. Persiapan Gmail Account
1. **Buka Google Account**: https://myaccount.google.com/
2. **Klik "Security"** di sidebar kiri
3. **Enable 2-Step Verification** jika belum aktif
4. **Scroll ke bawah** dan klik **"App passwords"**
5. **Pilih "Mail"** dan generate app password baru
6. **Copy password** yang dihasilkan (16 karakter)

### B. Update File .env
Buka file `.env` dan ganti bagian email:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=email-anda@gmail.com
MAIL_PASSWORD=app-password-16-karakter
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@latihhobi.com"
MAIL_FROM_NAME="LatihHobi"
```

**Ganti:**
- `email-anda@gmail.com` dengan email Gmail Anda
- `app-password-16-karakter` dengan App Password yang dihasilkan

### C. Clear Cache
Jalankan command ini di terminal:
```bash
php artisan config:clear
```

## 🔧 Langkah 2: Alternatif - Mailtrap (Untuk Testing)

Jika tidak ingin menggunakan Gmail, gunakan Mailtrap:

### A. Daftar Mailtrap
1. **Buka**: https://mailtrap.io
2. **Daftar akun gratis**
3. **Buat inbox baru**
4. **Copy SMTP credentials**

### B. Update .env
```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=username-mailtrap
MAIL_PASSWORD=password-mailtrap
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@latihhobi.com"
MAIL_FROM_NAME="LatihHobi"
```

### C. Cek Email di Mailtrap
- Email akan muncul di inbox Mailtrap Anda
- Tidak akan terkirim ke email asli (aman untuk testing)

## 🔧 Langkah 3: Test Email Configuration

### A. Test via Command Line
```bash
php artisan app:test-email your-email@example.com
```

### B. Test via Registration
1. Buka `http://127.0.0.1:8000/register`
2. Daftar dengan email yang valid
3. Cek inbox email Anda

## 🔧 Langkah 4: Troubleshooting

### Problem: "Username and Password not accepted"
**Solusi:**
- Pastikan menggunakan App Password, bukan password Gmail biasa
- Pastikan 2-Factor Authentication sudah aktif
- Cek kembali username dan password di .env

### Problem: "Connection refused"
**Solusi:**
- Cek koneksi internet
- Pastikan firewall tidak memblokir port 587
- Coba ganti MAIL_PORT ke 465 dan MAIL_ENCRYPTION ke ssl

### Problem: Email masuk ke Spam
**Solusi:**
- Cek folder Spam/Junk
- Tambahkan noreply@latihhobi.com ke contact
- Gunakan email domain yang valid untuk MAIL_FROM_ADDRESS

### Problem: Email tidak sampai sama sekali
**Solusi:**
- Jalankan: `php artisan config:clear`
- Restart server: `php artisan serve`
- Cek log error: `storage/logs/laravel.log`

## 🔧 Langkah 5: Verifikasi Manual (Development Only)

Jika masih bermasalah, gunakan verifikasi manual:

1. **Setelah registrasi**, di halaman verifikasi email
2. **Klik tombol "Verifikasi Manual (Testing Only)"**
3. **Email akan terverifikasi** tanpa perlu email

## 📋 Checklist Setup

- [ ] Gmail 2-Factor Authentication aktif
- [ ] App Password sudah dibuat
- [ ] File .env sudah diupdate dengan credentials yang benar
- [ ] `php artisan config:clear` sudah dijalankan
- [ ] Test email berhasil dikirim
- [ ] Registrasi baru menerima email verifikasi

## 🚀 Quick Setup Commands

```bash
# 1. Clear cache
php artisan config:clear

# 2. Test email
php artisan app:test-email your-email@gmail.com

# 3. Start server
php artisan serve
```

## 📞 Bantuan Lebih Lanjut

Jika masih mengalami masalah:

1. **Cek log error**: `storage/logs/laravel.log`
2. **Gunakan verifikasi manual** untuk testing
3. **Pastikan semua langkah** sudah diikuti dengan benar

## 🔒 Keamanan

**PENTING:**
- Jangan share App Password dengan siapa pun
- Gunakan email terpisah untuk aplikasi jika memungkinkan
- Untuk production, gunakan service email profesional

---

**Setelah setup selesai, setiap user yang mendaftar akan menerima email verifikasi dan harus memverifikasi email mereka sebelum bisa mengakses dashboard.**