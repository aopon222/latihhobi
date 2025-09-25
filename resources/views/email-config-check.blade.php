<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Configuration Check - LatihHobi</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 2rem;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            padding: 2rem;
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .header h1 {
            color: #2d3748;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .status-card {
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid;
        }

        .status-success {
            background: #d1fae5;
            border-color: #10b981;
            color: #065f46;
        }

        .status-error {
            background: #fee2e2;
            border-color: #ef4444;
            color: #991b1b;
        }

        .status-warning {
            background: #fef3c7;
            border-color: #f59e0b;
            color: #92400e;
        }

        .config-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1.5rem;
        }

        .config-table th,
        .config-table td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        .config-table th {
            background: #f9fafb;
            font-weight: 600;
            color: #374151;
        }

        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            margin: 0.25rem;
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .btn-primary {
            background: #667eea;
            color: white;
        }

        .btn-success {
            background: #10b981;
            color: white;
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        .instructions {
            background: #f9fafb;
            border-radius: 8px;
            padding: 1.5rem;
            margin-top: 1.5rem;
        }

        .instructions h3 {
            color: #374151;
            margin-bottom: 1rem;
        }

        .instructions ol {
            margin-left: 1.5rem;
        }

        .instructions li {
            margin-bottom: 0.5rem;
            line-height: 1.6;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #667eea;
            text-decoration: none;
            margin-top: 1rem;
        }

        .back-link:hover {
            color: #5a67d8;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-envelope-check"></i> Email Configuration Check</h1>
            <p>Periksa konfigurasi email untuk sistem verifikasi LatihHobi</p>
        </div>

        @php
            $mailer = config('mail.default');
            $host = config('mail.mailers.' . $mailer . '.host');
            $port = config('mail.mailers.' . $mailer . '.port');
            $username = config('mail.mailers.' . $mailer . '.username');
            $scheme = config('mail.mailers.' . $mailer . '.scheme') ?? config('mail.mailers.' . $mailer . '.encryption');
            $fromAddress = config('mail.from.address');
            $fromName = config('mail.from.name');
            
            $isConfigured = $mailer && $host && $port && $username && $fromAddress && 
                           $username !== 'your-email@gmail.com' && 
                           config('mail.mailers.' . $mailer . '.password') !== 'your-app-password';
            
            $unverifiedUsers = \App\Models\User::whereNull('email_verified_at')->count();
        @endphp

        @if($isConfigured)
            <div class="status-card status-success">
                <h3><i class="fas fa-check-circle"></i> Email Dikonfigurasi dengan Benar</h3>
                <p>Sistem email sudah dikonfigurasi dan siap mengirim email verifikasi.</p>
            </div>
        @else
            <div class="status-card status-error">
                <h3><i class="fas fa-exclamation-triangle"></i> Email Belum Dikonfigurasi</h3>
                <p>Sistem email belum dikonfigurasi dengan benar. Email verifikasi tidak akan terkirim.</p>
            </div>
        @endif

        <h3>Konfigurasi Saat Ini:</h3>
        <table class="config-table">
            <tr>
                <th>Setting</th>
                <th>Value</th>
                <th>Status</th>
            </tr>
            <tr>
                <td>Mail Driver</td>
                <td>{{ $mailer ?: 'NOT SET' }}</td>
                <td>{!! $mailer ? '<i class="fas fa-check" style="color: green;"></i>' : '<i class="fas fa-times" style="color: red;"></i>' !!}</td>
            </tr>
            <tr>
                <td>SMTP Host</td>
                <td>{{ $host ?: 'NOT SET' }}</td>
                <td>{!! $host ? '<i class="fas fa-check" style="color: green;"></i>' : '<i class="fas fa-times" style="color: red;"></i>' !!}</td>
            </tr>
            <tr>
                <td>SMTP Port</td>
                <td>{{ $port ?: 'NOT SET' }}</td>
                <td>{!! $port ? '<i class="fas fa-check" style="color: green;"></i>' : '<i class="fas fa-times" style="color: red;"></i>' !!}</td>
            </tr>
            <tr>
                <td>Username</td>
                <td>{{ $username && $username !== 'your-email@gmail.com' ? $username : 'NOT SET' }}</td>
                <td>{!! $username && $username !== 'your-email@gmail.com' ? '<i class="fas fa-check" style="color: green;"></i>' : '<i class="fas fa-times" style="color: red;"></i>' !!}</td>
            </tr>
            <tr>
                <td>Encryption</td>
                <td>{{ $encryption ?: 'NOT SET' }}</td>
                <td>{!! $encryption ? '<i class="fas fa-check" style="color: green;"></i>' : '<i class="fas fa-times" style="color: red;"></i>' !!}</td>
            </tr>
            <tr>
                <td>From Address</td>
                <td>{{ $fromAddress ?: 'NOT SET' }}</td>
                <td>{!! $fromAddress ? '<i class="fas fa-check" style="color: green;"></i>' : '<i class="fas fa-times" style="color: red;"></i>' !!}</td>
            </tr>
        </table>

        @if($unverifiedUsers > 0)
            <div class="status-card status-warning">
                <h3><i class="fas fa-users"></i> Users Menunggu Verifikasi</h3>
                <p>Ada <strong>{{ $unverifiedUsers }}</strong> user yang belum memverifikasi email mereka.</p>
            </div>
        @endif

        <div style="text-align: center; margin: 2rem 0;">
            @if($isConfigured)
                <form method="POST" action="{{ route('test.email') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-paper-plane"></i> Test Kirim Email
                    </button>
                </form>
            @endif
            
            <a href="{{ route('register') }}" class="btn btn-primary">
                <i class="fas fa-user-plus"></i> Test Registrasi
            </a>
            
            <a href="{{ route('home') }}" class="btn btn-secondary">
                <i class="fas fa-home"></i> Kembali ke Home
            </a>
        </div>

        @if(!$isConfigured)
            <div class="instructions">
                <h3><i class="fas fa-cog"></i> Setup Gmail SMTP untuk reksanjsg@gmail.com:</h3>
                
                <div style="background: #e0f2fe; padding: 1rem; border-radius: 6px; margin-bottom: 1rem;">
                    <h4 style="color: #0369a1; margin-bottom: 0.5rem;">🚀 Quick Setup:</h4>
                    <p style="margin: 0; color: #0369a1;">
                        <strong>1.</strong> Buka: <a href="https://myaccount.google.com/security" target="_blank" style="color: #0369a1;">Google Account Security</a><br>
                        <strong>2.</strong> Enable "2-Step Verification" (jika belum aktif)<br>
                        <strong>3.</strong> Scroll ke "App passwords" → Pilih "Mail" → Generate<br>
                        <strong>4.</strong> Copy App Password (16 karakter)<br>
                        <strong>5.</strong> Ganti di file .env: <code>MAIL_PASSWORD=app-password-anda</code><br>
                        <strong>6.</strong> Jalankan: <code>php artisan config:clear</code>
                    </p>
                </div>

                <div style="background: #fef3c7; padding: 1rem; border-radius: 6px; margin-bottom: 1rem;">
                    <h4 style="color: #92400e; margin-bottom: 0.5rem;">⚠️ PENTING:</h4>
                    <ul style="margin: 0; color: #92400e;">
                        <li>Gunakan <strong>App Password</strong> (16 karakter), BUKAN password Gmail biasa</li>
                        <li>2-Step Verification HARUS aktif dulu</li>
                        <li>Jangan share App Password dengan siapa pun</li>
                    </ul>
                </div>

                <div style="text-align: center; margin: 1rem 0;">
                    <a href="https://myaccount.google.com/security" target="_blank" class="btn btn-primary">
                        <i class="fas fa-external-link-alt"></i> Buka Google Account Security
                    </a>
                </div>

                <details style="margin-top: 1rem;">
                    <summary style="cursor: pointer; font-weight: 600; color: #374151;">📖 Detailed Instructions</summary>
                    <ol style="margin-top: 1rem;">
                        <li><strong>Buka Google Account:</strong> <a href="https://myaccount.google.com/" target="_blank">https://myaccount.google.com/</a></li>
                        <li><strong>Klik "Security"</strong> di sidebar kiri</li>
                        <li><strong>Enable "2-Step Verification"</strong> jika belum aktif</li>
                        <li><strong>Scroll ke bawah</strong> dan klik <strong>"App passwords"</strong></li>
                        <li><strong>Pilih "Mail"</strong> dan generate app password baru</li>
                        <li><strong>Edit file .env</strong> dan ganti:</li>
                        <ul style="margin: 0.5rem 0;">
                            <li><code>MAIL_USERNAME=reksanjsg@gmail.com</code> ✅ (sudah benar)</li>
                            <li><code>MAIL_PASSWORD=your-gmail-app-password</code> ❌ (perlu diganti)</li>
                        </ul>
                        <li><strong>Jalankan:</strong> <code>php artisan config:clear</code></li>
                        <li><strong>Refresh halaman ini</strong> untuk cek konfigurasi</li>
                    </ol>
                </details>
            </div>
        @endif

        <a href="{{ route('home') }}" class="back-link">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Home
        </a>
    </div>
</body>
</html>