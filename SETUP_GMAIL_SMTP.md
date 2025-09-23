# 🔧 Setup Gmail SMTP untuk Email Verification

## 📧 Email Anda: reksanjsg@gmail.com

Ikuti langkah-langkah berikut untuk mengaktifkan email verification:

## 🚀 Langkah 1: Setup Gmail App Password

### A. Buka Google Account Settings
1. **Buka browser** dan pergi ke: https://myaccount.google.com/
2. **Login** dengan akun Gmail Anda (reksanjsg@gmail.com)

### B. Enable 2-Step Verification
1. **Klik "Security"** di sidebar kiri
2. **Scroll ke bawah** sampai menemukan "2-Step Verification"
3. **Klik "2-Step Verification"**
4. **Follow instruksi** untuk mengaktifkan 2FA (jika belum aktif)
   - Masukkan nomor HP Anda
   - Verifikasi dengan SMS/call
   - Simpan backup codes

### C. Generate App Password
1. **Setelah 2-Step Verification aktif**, kembali ke halaman Security
2. **Scroll ke bawah** sampai menemukan "App passwords"
3. **Klik "App passwords"**
4. **Pilih "Mail"** dari dropdown
5. **Klik "Generate"**
6. **Copy password** yang dihasilkan (16 karakter, contoh: abcd efgh ijkl mnop)

## 🚀 Langkah 2: Update File .env

1. **Buka file `.env`** di folder latihhobi
2. **Cari bagian email configuration**
3. **Ganti `your-gmail-app-password`** dengan App Password yang baru dibuat

Contoh:
```env
MAIL_USERNAME=reksanjsg@gmail.com
MAIL_PASSWORD=abcd efgh ijkl mnop
```

**PENTING:** Gunakan App Password (16 karakter), BUKAN password Gmail biasa!

## 🚀 Langkah 3: Clear Cache & Test

1. **Buka Command Prompt/Terminal**
2. **Masuk ke folder latihhobi:**
   ```cmd
   cd c:\xampp\htdocs\latihhobi
   ```

3. **Clear Laravel cache:**
   ```cmd
   php artisan config:clear
   ```

4. **Test email configuration:**
   ```cmd
   php artisan app:test-email reksanjsg@gmail.com
   ```

## 🚀 Langkah 4: Test Registration

1. **Buka browser** dan pergi ke: http://127.0.0.1:8000/register
2. **Daftar dengan email baru** (bukan reksanjsg@gmail.com)
3. **Cek inbox email** untuk verification link
4. **Klik link** di email untuk verifikasi

## ✅ Troubleshooting

### Problem: "Username and Password not accepted"
**Solusi:**
- Pastikan menggunakan App Password (16 karakter)
- Pastikan 2-Step Verification sudah aktif
- Generate App Password baru jika perlu

### Problem: Email tidak sampai
**Solusi:**
- Cek folder Spam/Junk
- Tunggu beberapa menit (delay SMTP)
- Pastikan internet connection stabil

### Problem: "Less secure app access"
**Solusi:**
- JANGAN aktifkan "Less secure app access"
- Gunakan App Password sebagai gantinya

## 🎯 Expected Result

Setelah setup berhasil:
1. ✅ Registration form berfungsi normal
2. ✅ Email verification otomatis terkirim
3. ✅ User menerima email di inbox
4. ✅ Klik link → email terverifikasi
5. ✅ User bisa akses dashboard

## 📞 Need Help?

Jika masih ada masalah:
1. **Cek file log:** `storage/logs/laravel.log`
2. **Test email config:** `php artisan app:test-email`
3. **Gunakan verifikasi manual** untuk testing sementara

---

**⚠️ PENTING:** Jangan share App Password dengan siapa pun!