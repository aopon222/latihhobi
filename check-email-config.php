<?php
/**
 * Email Configuration Checker
 * Run this to check if email is properly configured
 */

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== LatihHobi Email Configuration Checker ===\n\n";

// Check current configuration
$mailer = config('mail.default');
$host = config('mail.mailers.' . $mailer . '.host');
$port = config('mail.mailers.' . $mailer . '.port');
$username = config('mail.mailers.' . $mailer . '.username');
$encryption = config('mail.mailers.' . $mailer . '.encryption');
$fromAddress = config('mail.from.address');
$fromName = config('mail.from.name');

echo "📧 Current Email Configuration:\n";
echo "- Mailer: " . ($mailer ?: 'NOT SET') . "\n";
echo "- Host: " . ($host ?: 'NOT SET') . "\n";
echo "- Port: " . ($port ?: 'NOT SET') . "\n";
echo "- Username: " . ($username ?: 'NOT SET') . "\n";
echo "- Encryption: " . ($encryption ?: 'NOT SET') . "\n";
echo "- From Address: " . ($fromAddress ?: 'NOT SET') . "\n";
echo "- From Name: " . ($fromName ?: 'NOT SET') . "\n\n";

// Check if configuration is complete
$isConfigured = $mailer && $host && $port && $username && $fromAddress;

if (!$isConfigured) {
    echo "❌ Email is NOT properly configured!\n\n";
    echo "Missing configuration:\n";
    if (!$mailer) echo "- MAIL_MAILER\n";
    if (!$host) echo "- MAIL_HOST\n";
    if (!$port) echo "- MAIL_PORT\n";
    if (!$username) echo "- MAIL_USERNAME\n";
    if (!$fromAddress) echo "- MAIL_FROM_ADDRESS\n";
    
    echo "\n📋 To fix this:\n";
    echo "1. Edit the .env file\n";
    echo "2. Set up Gmail SMTP or other email service\n";
    echo "3. Run: php artisan config:clear\n";
    echo "4. Read SETUP_EMAIL_VERIFICATION.md for detailed instructions\n\n";
} else {
    echo "✅ Email configuration looks complete!\n\n";
    
    // Test email sending
    echo "🧪 Testing email sending...\n";
    
    try {
        $testEmail = $username; // Send test to the configured email
        
        Illuminate\Support\Facades\Mail::raw('Test email from LatihHobi - ' . date('Y-m-d H:i:s'), function ($message) use ($testEmail) {
            $message->to($testEmail)
                    ->subject('LatihHobi - Email Configuration Test');
        });
        
        echo "✅ Test email sent successfully to: $testEmail\n";
        echo "📬 Check your inbox (and spam folder) for the test email\n\n";
        
    } catch (Exception $e) {
        echo "❌ Failed to send test email!\n";
        echo "Error: " . $e->getMessage() . "\n\n";
        
        echo "🔧 Common solutions:\n";
        echo "- Check your Gmail App Password (not regular password)\n";
        echo "- Ensure 2-Factor Authentication is enabled\n";
        echo "- Check internet connection\n";
        echo "- Try different SMTP settings\n\n";
    }
}

// Check if there are any users waiting for verification
try {
    $unverifiedUsers = \App\Models\User::whereNull('email_verified_at')->count();
    
    if ($unverifiedUsers > 0) {
        echo "👥 Users waiting for email verification: $unverifiedUsers\n";
        echo "📧 They will receive verification emails once email is properly configured\n\n";
    }
} catch (Exception $e) {
    echo "⚠️  Could not check user verification status\n\n";
}

echo "📖 For detailed setup instructions, read: SETUP_EMAIL_VERIFICATION.md\n";
echo "🧪 To test with a specific email: php artisan app:test-email your-email@example.com\n";
?>