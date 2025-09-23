@echo off
echo ========================================
echo Gmail SMTP Setup untuk LatihHobi
echo ========================================
echo.
echo Email Anda: reksanjsg@gmail.com
echo.

echo Langkah-langkah setup:
echo 1. Setup Gmail App Password
echo 2. Update file .env
echo 3. Test email configuration
echo.

echo ========================================
echo Langkah 1: Setup Gmail App Password
echo ========================================
echo.
echo Buka browser dan ikuti langkah berikut:
echo 1. Pergi ke: https://myaccount.google.com/
echo 2. Klik "Security" di sidebar kiri
echo 3. Enable "2-Step Verification" (jika belum aktif)
echo 4. Scroll ke "App passwords" dan klik
echo 5. Pilih "Mail" dan generate password
echo 6. Copy password yang dihasilkan (16 karakter)
echo.

pause

echo.
echo ========================================
echo Langkah 2: Update File .env
echo ========================================
echo.
set /p apppassword="Masukkan Gmail App Password (16 karakter): "

if "%apppassword%"=="" (
    echo Error: App Password tidak boleh kosong!
    pause
    exit /b 1
)

echo.
echo Updating .env file...

powershell -Command "(Get-Content .env) -replace 'MAIL_PASSWORD=your-gmail-app-password', 'MAIL_PASSWORD=%apppassword%' | Set-Content .env"

echo File .env berhasil diupdate!
echo.

echo ========================================
echo Langkah 3: Clear Cache & Test
echo ========================================
echo.

echo Clearing Laravel cache...
php artisan config:clear

echo.
echo Testing email configuration...
php artisan app:test-email reksanjsg@gmail.com

echo.
echo ========================================
echo Setup Selesai!
echo ========================================
echo.
echo Sekarang coba:
echo 1. Buka: http://127.0.0.1:8000/register
echo 2. Daftar dengan email baru
echo 3. Cek inbox untuk email verification
echo.

pause