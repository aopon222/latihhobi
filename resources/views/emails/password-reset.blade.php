<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Latih Hobi</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .content {
            padding: 30px;
        }
        .button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 10px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
        }
        .footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #666;
        }
        .warning {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔐 Reset Password</h1>
            <p>Latih Hobi - Platform Pembelajaran</p>
        </div>
        
        <div class="content">
            <h2>Halo!</h2>
            <p>Kami menerima permintaan untuk mereset password akun Anda dengan email: <strong>{{ $email }}</strong></p>
            
            <p>Klik tombol di bawah ini untuk mereset password Anda:</p>
            
            <div style="text-align: center;">
                <a href="{{ url('/password/reset/' . $token . '?email=' . urlencode($email)) }}" class="button">
                    Reset Password Sekarang
                </a>
            </div>
            
            <p>Atau copy dan paste link berikut di browser Anda:</p>
            <p style="word-break: break-all; background: #f8f9fa; padding: 10px; border-radius: 5px; font-family: monospace;">
                {{ url('/password/reset/' . $token . '?email=' . urlencode($email)) }}
            </p>
            
            <div class="warning">
                <strong>⚠️ Penting:</strong>
                <ul>
                    <li>Link ini akan kadaluarsa dalam 24 jam</li>
                    <li>Jika Anda tidak meminta reset password, abaikan email ini</li>
                    <li>Jangan bagikan link ini kepada siapa pun</li>
                </ul>
            </div>
        </div>
        
        <div class="footer">
            <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
            <p>&copy; {{ date('Y') }} Latih Hobi. All rights reserved.</p>
        </div>
    </div>
</body>
</html>