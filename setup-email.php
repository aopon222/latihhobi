<?php
/**
 * Email Setup Helper Script
 * Run this script to configure email settings for LatihHobi
 */

echo "=== LatihHobi Email Setup Helper ===\n\n";

echo "Choose your email configuration:\n";
echo "1. Gmail SMTP (recommended for production)\n";
echo "2. Mailtrap (for development/testing)\n";
echo "3. Use log driver (emails saved to log file)\n";
echo "4. Test current configuration\n";

$choice = readline("Enter your choice (1-4): ");

switch ($choice) {
    case '1':
        setupGmail();
        break;
    case '2':
        setupMailtrap();
        break;
    case '3':
        setupLogDriver();
        break;
    case '4':
        testCurrentConfig();
        break;
    default:
        echo "Invalid choice!\n";
        break;
}

function setupGmail() {
    echo "\n=== Gmail SMTP Setup ===\n";
    echo "Before proceeding, you need to:\n";
    echo "1. Enable 2-Factor Authentication on your Google Account\n";
    echo "2. Generate an App Password for Mail\n";
    echo "3. Go to: https://myaccount.google.com/apppasswords\n\n";
    
    $email = readline("Enter your Gmail address: ");
    $password = readline("Enter your Gmail App Password (not regular password): ");
    
    $envContent = file_get_contents('.env');
    
    // Update mail configuration
    $envContent = preg_replace('/MAIL_MAILER=.*/', 'MAIL_MAILER=smtp', $envContent);
    $envContent = preg_replace('/MAIL_HOST=.*/', 'MAIL_HOST=smtp.gmail.com', $envContent);
    $envContent = preg_replace('/MAIL_PORT=.*/', 'MAIL_PORT=587', $envContent);
    $envContent = preg_replace('/MAIL_USERNAME=.*/', "MAIL_USERNAME={$email}", $envContent);
    $envContent = preg_replace('/MAIL_PASSWORD=.*/', "MAIL_PASSWORD={$password}", $envContent);
    $envContent = preg_replace('/MAIL_ENCRYPTION=.*/', 'MAIL_ENCRYPTION=tls', $envContent);
    $envContent = preg_replace('/MAIL_FROM_ADDRESS=.*/', "MAIL_FROM_ADDRESS=\"noreply@latihhobi.com\"", $envContent);
    
    file_put_contents('.env', $envContent);
    
    echo "\n✅ Gmail SMTP configuration saved!\n";
    echo "Testing configuration...\n";
    
    // Test the configuration
    exec('php artisan config:clear');
    exec('php artisan app:test-email ' . $email, $output);
    
    foreach ($output as $line) {
        echo $line . "\n";
    }
}

function setupMailtrap() {
    echo "\n=== Mailtrap Setup ===\n";
    echo "1. Go to https://mailtrap.io and create a free account\n";
    echo "2. Create a new inbox\n";
    echo "3. Copy the SMTP credentials\n\n";
    
    $username = readline("Enter Mailtrap username: ");
    $password = readline("Enter Mailtrap password: ");
    
    $envContent = file_get_contents('.env');
    
    // Update mail configuration
    $envContent = preg_replace('/MAIL_MAILER=.*/', 'MAIL_MAILER=smtp', $envContent);
    $envContent = preg_replace('/MAIL_HOST=.*/', 'MAIL_HOST=sandbox.smtp.mailtrap.io', $envContent);
    $envContent = preg_replace('/MAIL_PORT=.*/', 'MAIL_PORT=2525', $envContent);
    $envContent = preg_replace('/MAIL_USERNAME=.*/', "MAIL_USERNAME={$username}", $envContent);
    $envContent = preg_replace('/MAIL_PASSWORD=.*/', "MAIL_PASSWORD={$password}", $envContent);
    $envContent = preg_replace('/MAIL_ENCRYPTION=.*/', 'MAIL_ENCRYPTION=tls', $envContent);
    
    file_put_contents('.env', $envContent);
    
    echo "\n✅ Mailtrap configuration saved!\n";
    exec('php artisan config:clear');
}

function setupLogDriver() {
    $envContent = file_get_contents('.env');
    $envContent = preg_replace('/MAIL_MAILER=.*/', 'MAIL_MAILER=log', $envContent);
    file_put_contents('.env', $envContent);
    
    echo "\n✅ Log driver configured!\n";
    echo "Emails will be saved to storage/logs/laravel.log\n";
    exec('php artisan config:clear');
}

function testCurrentConfig() {
    echo "\n=== Testing Current Configuration ===\n";
    
    // Load current config
    require_once 'vendor/autoload.php';
    
    $app = require_once 'bootstrap/app.php';
    $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
    
    $mailer = config('mail.default');
    $host = config('mail.mailers.smtp.host');
    $port = config('mail.mailers.smtp.port');
    $username = config('mail.mailers.smtp.username');
    
    echo "Current configuration:\n";
    echo "- Mailer: {$mailer}\n";
    echo "- Host: {$host}\n";
    echo "- Port: {$port}\n";
    echo "- Username: {$username}\n\n";
    
    $testEmail = readline("Enter email to test with: ");
    
    exec("php artisan app:test-email {$testEmail}", $output);
    
    foreach ($output as $line) {
        echo $line . "\n";
    }
}

echo "\nDone! Don't forget to run 'php artisan config:clear' after making changes.\n";
?>