# Dokumentasi Alert/Notification System

## Overview
Sistem alert/notification pada aplikasi LatihHobi menggunakan **Laravel Notification Channels** untuk mengirim email alert ketika terjadi error atau exception di aplikasi.

## Komponen Utama

### 1. **ErrorAlert Notification** (`app/Notifications/ErrorAlert.php`)
- Menerima exception sebagai parameter
- Mengirim email dengan detail error:
  - Error message
  - File dan line number
  - Stack trace lengkap

**Contoh:**
```php
$exception = new Exception('Database Connection Failed');
Notification::route('mail', 'admin@latihhobi.com')
    ->notify(new ErrorAlert($exception));
```

### 2. **Exception Handler** (`app/Exceptions/Handler.php`)
- Menangkap semua exception yang tidak ditangani
- Secara otomatis mengirim email notification ke admin
- Menggunakan callback `reportable()`

**Konfigurasi:**
```php
$this->reportable(function (Throwable $e) {
    Notification::route('mail', env('ADMIN_EMAIL', 'admin@latihhobi.com'))
        ->notify(new ErrorAlert($e));
});
```

## Konfigurasi

### Environment Variables (`.env`)
```env
# Admin email yang menerima alert
ADMIN_EMAIL=admin@latihhobi.com

# Mail configuration
MAIL_MAILER=log  # Gunakan 'log' untuk development, atau 'smtp' untuk production
MAIL_HOST=smtp.mailtrap.io  # Jika menggunakan SMTP
MAIL_PORT=2525
MAIL_USERNAME=your.username
MAIL_PASSWORD=your.password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="alert@latihhobi.com"
MAIL_FROM_NAME="LatihHobi Alert System"
```

### Mail Driver Options
- **log**: Email ditulis ke file log (development)
- **smtp**: Email dikirim via SMTP server (production)
- **mailgun**: Menggunakan Mailgun API
- **ses**: Menggunakan AWS SES
- **sendmail**: Menggunakan sendmail

## Testing

### Cara 1: Menggunakan Route Test
Akses URL berikut untuk mengirim test notification:
```
http://127.0.0.1:8000/test-error-alert
```

Response:
```
Email notifikasi error telah dikirim ke: admin@latihhobi.com
```

### Cara 2: Menjalankan Unit Test
```bash
php artisan test tests/Feature/ErrorAlertNotificationTest.php
```

### Cara 3: Menggunakan Tinker
```bash
php artisan tinker
> Notification::route('mail', 'admin@latihhobi.com')->notify(new \App\Notifications\ErrorAlert(new \Exception('Test')))
```

## Melihat Email Log (Development Mode)

Ketika `MAIL_MAILER=log`, email disimpan di file log:
```bash
# View latest logs
tail -f storage/logs/laravel.log

# Atau di Windows
Get-Content storage/logs/laravel.log -Wait
```

Cari bagian yang dimulai dengan `Message-ID:` untuk melihat email yang dikirim.

## Integrasi dengan SMTP (Production)

Untuk production, gunakan SMTP provider seperti:

### Mailtrap.io
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=xxxx
MAIL_PASSWORD=xxxx
MAIL_ENCRYPTION=null
```

### Gmail (Dengan App Password)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your.email@gmail.com
MAIL_PASSWORD=your.app.password
MAIL_ENCRYPTION=tls
```

### Mailgun
```env
MAIL_MAILER=mailgun
MAILGUN_SECRET=your.mailgun.secret
MAILGUN_DOMAIN=your.mailgun.domain
```

## Customization

### Mengubah Email Template
Edit file `app/Notifications/ErrorAlert.php` dan modifikasi method `toMail()`:

```php
public function toMail(object $notifiable): MailMessage
{
    return (new MailMessage)
        ->subject('Custom Subject')
        ->view('emails.error-alert', [
            'exception' => $this->exception,
            'url' => url('/'),
        ]);
}
```

Kemudian buat view di `resources/views/emails/error-alert.blade.php`.

### Menambahkan Channel Notification Lain

**Via Slack:**
```bash
composer require laravel/slack-notification-channel
```

Kemudian update notification:
```php
public function via(object $notifiable): array
{
    return ['mail', 'slack'];
}

public function toSlack(object $notifiable)
{
    return (new SlackMessage)
        ->error()
        ->content('Application Error: ' . $this->exception->getMessage());
}
```

**Via SMS (Twilio):**
```bash
composer require laravel/nexmo-notification-channel
```

## Monitoring

Untuk monitor semua exceptions yang terjadi:
```bash
# Real-time log monitoring
php artisan pail

# Atau dengan filtering
php artisan pail --filter=Exception
```

## Unit Kompetensi Tercakup

✅ **ALERT/NOTIF**: Sistem alert notification otomatis untuk error/exception
✅ **MONITORING**: Real-time monitoring via log files
✅ **DEBUGGING**: Detail exception trace untuk debugging
✅ **CODE REVIEW**: Custom exception handler dengan best practices

## Troubleshooting

### Email tidak terkirim
1. Pastikan `MAIL_MAILER` sudah dikonfigurasi
2. Untuk SMTP, verifikasi credentials
3. Check `storage/logs/laravel.log` untuk error messages
4. Pastikan `ADMIN_EMAIL` valid

### Route `/test-error-alert` tidak ditemukan
1. Jalankan `php artisan route:clear`
2. Akses route lagi
3. Pastikan tidak ada route caching yang conflict

### Exception handler tidak memanggil notification
1. Pastikan file `app/Exceptions/Handler.php` ada
2. Pastikan service provider sudah register handler
3. Clear cache: `php artisan config:clear && php artisan cache:clear`
