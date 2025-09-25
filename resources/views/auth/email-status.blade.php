@extends('layout.app')

@section('title', 'Email Status - LatihHobi')

@section('content')
<div style="min-height:100vh;background:#f8fafc;padding:2rem;">
    <div style="max-width:800px;margin:0 auto;">
        <div style="background:#fff;border-radius:16px;box-shadow:0 4px 16px rgba(0,0,0,0.08);padding:2rem;">
            <h1 style="font-size:2rem;font-weight:700;color:#2563eb;margin-bottom:2rem;">📧 Email Configuration Status</h1>
            
            <!-- User Info -->
            <div style="background:#f8fafc;border-radius:8px;padding:1.5rem;margin-bottom:2rem;">
                <h2 style="font-size:1.25rem;font-weight:600;color:#374151;margin-bottom:1rem;">👤 User Information</h2>
                <div style="display:grid;grid-template-columns:auto 1fr;gap:0.5rem;">
                    <strong>Name:</strong> <span>{{ $user->name }}</span>
                    <strong>Email:</strong> <span>{{ $user->email }}</span>
                    <strong>Verified:</strong> 
                    <span style="color:{{ $user->hasVerifiedEmail() ? '#10b981' : '#ef4444' }};">
                        {{ $user->hasVerifiedEmail() ? '✅ Verified' : '❌ Not Verified' }}
                    </span>
                    <strong>Registered:</strong> <span>{{ $user->created_at->format('d M Y H:i') }}</span>
                </div>
            </div>

            <!-- Email Config -->
            <div style="background:#f8fafc;border-radius:8px;padding:1.5rem;margin-bottom:2rem;">
                <h2 style="font-size:1.25rem;font-weight:600;color:#374151;margin-bottom:1rem;">⚙️ Email Configuration</h2>
                <div style="display:grid;grid-template-columns:auto 1fr;gap:0.5rem;">
                    <strong>Mailer:</strong> <span>{{ $emailConfig['mailer'] }}</span>
                    <strong>Host:</strong> <span>{{ $emailConfig['host'] }}</span>
                    <strong>Port:</strong> <span>{{ $emailConfig['port'] }}</span>
                    <strong>From Address:</strong> <span>{{ $emailConfig['from'] }}</span>
                </div>
            </div>

            <!-- Actions -->
            <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));gap:1rem;margin-bottom:2rem;">
                <button onclick="testEmail()" 
                        style="background:#2563eb;color:#fff;padding:1rem;border:none;border-radius:8px;font-weight:600;cursor:pointer;">
                    🧪 Test Email Connection
                </button>
                
                @if(!$user->hasVerifiedEmail())
                <a href="{{ route('manual.verify') }}" 
                   style="background:#10b981;color:#fff;padding:1rem;border-radius:8px;font-weight:600;text-decoration:none;text-align:center;">
                    ✅ Manual Verification
                </a>
                @endif
                
                <a href="{{ route('password.request') }}" 
                   style="background:#f59e0b;color:#fff;padding:1rem;border-radius:8px;font-weight:600;text-decoration:none;text-align:center;">
                    🔐 Test Password Reset
                </a>
            </div>

            <!-- Email Logs -->
            <div style="background:#f8fafc;border-radius:8px;padding:1.5rem;">
                <h2 style="font-size:1.25rem;font-weight:600;color:#374151;margin-bottom:1rem;">📝 Email Troubleshooting</h2>
                <div id="email-result" style="margin-top:1rem;padding:1rem;border-radius:8px;display:none;"></div>
                
                <div style="color:#6b7280;font-size:0.875rem;">
                    <p><strong>Catatan:</strong></p>
                    <ul style="margin:0.5rem 0;padding-left:1.5rem;">
                        <li>Jika email tidak sampai, gunakan manual verification</li>
                        <li>Check folder spam/junk di email Anda</li>
                        <li>Untuk development, email akan tersimpan di log Laravel</li>
                        <li>Password reset token akan ditampilkan langsung jika email gagal</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function testEmail() {
    const button = event.target;
    const resultDiv = document.getElementById('email-result');
    
    button.textContent = '⏳ Testing...';
    button.disabled = true;
    
    fetch('/email/test', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        resultDiv.style.display = 'block';
        if (data.status === 'success') {
            resultDiv.style.background = '#d1fae5';
            resultDiv.style.color = '#065f46';
            resultDiv.innerHTML = '✅ ' + data.message;
        } else {
            resultDiv.style.background = '#fee2e2';
            resultDiv.style.color = '#991b1b';
            resultDiv.innerHTML = '❌ ' + data.message;
        }
    })
    .catch(error => {
        resultDiv.style.display = 'block';
        resultDiv.style.background = '#fee2e2';
        resultDiv.style.color = '#991b1b';
        resultDiv.innerHTML = '❌ Error: ' + error.message;
    })
    .finally(() => {
        button.textContent = '🧪 Test Email Connection';
        button.disabled = false;
    });
}
</script>
@endsection