@echo off
echo ===================================
echo LatihHobi Email Setup Helper
echo ===================================
echo.

echo Checking current email configuration...
php check-email-config.php

echo.
echo ===================================
echo Setup Options:
echo ===================================
echo 1. Read setup instructions (recommended)
echo 2. Test current email configuration
echo 3. Clear Laravel cache
echo 4. Start Laravel server
echo.

set /p choice="Enter your choice (1-4): "

if "%choice%"=="1" (
    echo.
    echo Opening setup instructions...
    start SETUP_EMAIL_VERIFICATION.md
    echo.
    echo Please follow the instructions in the opened file.
    echo After setup, run this script again to test.
)

if "%choice%"=="2" (
    echo.
    set /p email="Enter email to test with: "
    echo Testing email configuration...
    php artisan app:test-email %email%
)

if "%choice%"=="3" (
    echo.
    echo Clearing Laravel cache...
    php artisan config:clear
    echo Cache cleared!
)

if "%choice%"=="4" (
    echo.
    echo Starting Laravel server...
    echo Server will start at http://127.0.0.1:8000
    echo Press Ctrl+C to stop the server
    php artisan serve
)

echo.
pause