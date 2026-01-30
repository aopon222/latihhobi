<?php
// Archived copy of test-login-web.php — moved to scripts/archived_tests
// Original script tested web login using curl.

require_once 'vendor/autoload.php';

// Test web login using curl (archived)
function testWebLogin($email, $password) {
    $url = 'http://localhost:8000/login';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
    $loginPage = curl_exec($ch);
    preg_match('/name="_token" value="([^"]+)"/', $loginPage, $matches);
    $csrfToken = $matches[1] ?? '';
    if (empty($csrfToken)) {
        echo "Could not find CSRF token\n";
        return false;
    }
    $postData = ['_token' => $csrfToken, 'email' => $email, 'password' => $password];
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $redirectUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    curl_close($ch);
    echo "HTTP Code: $httpCode - URL: $redirectUrl\n";
    return ($httpCode == 200 && (strpos($redirectUrl, 'dashboard') !== false || strpos($redirectUrl, 'home') !== false));
}
