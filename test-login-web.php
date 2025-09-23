<?php
require_once 'vendor/autoload.php';

// Test web login menggunakan curl
function testWebLogin($email, $password) {
    $url = 'http://localhost:8000/login';
    
    // First get the CSRF token
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
    $loginPage = curl_exec($ch);
    
    // Extract CSRF token
    preg_match('/name="_token" value="([^"]+)"/', $loginPage, $matches);
    $csrfToken = $matches[1] ?? '';
    
    if (empty($csrfToken)) {
        echo "❌ Could not get CSRF token\n";
        return false;
    }
    
    echo "✅ CSRF Token found: " . substr($csrfToken, 0, 10) . "...\n";
    
    // Now submit login
    $postData = [
        '_token' => $csrfToken,
        'email' => $email,
        'password' => $password
    ];
    
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $redirectUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    
    curl_close($ch);
    
    echo "HTTP Code: $httpCode\n";
    echo "Final URL: $redirectUrl\n";
    
    if ($httpCode == 200 && strpos($redirectUrl, 'dashboard') !== false) {
        echo "✅ Login berhasil - redirect ke dashboard\n";
        return true;
    } else if ($httpCode == 200 && strpos($redirectUrl, 'home') !== false) {
        echo "✅ Login berhasil - redirect ke home\n";
        return true;
    } else {
        echo "❌ Login gagal\n";
        echo "Response preview:\n" . substr($response, -500) . "\n";
        return false;
    }
}

echo "=== Testing Web Login ===\n\n";

echo "Testing Admin Login:\n";
testWebLogin('multimedia.latihhobi@gmail.com', 'admin123');

echo "\nTesting User Login:\n";
testWebLogin('user@test.com', 'test123');

// Cleanup
if (file_exists('cookies.txt')) {
    unlink('cookies.txt');
}
?>