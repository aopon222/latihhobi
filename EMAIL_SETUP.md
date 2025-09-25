# Email Verification Setup Guide

## Current Status
✅ **FIXED**: Registration system now works properly with email verification
✅ **FIXED**: Error handling for email sending failures
✅ **FIXED**: User creation and authentication flow
✅ **FIXED**: Email verification middleware and routes

## How It Works Now

### 1. Registration Process
- User fills registration form at `/register`
- System validates input (name, email, password with complexity requirements)
- User account is created in database
- System attempts to send email verification
- User is logged in and redirected to verification notice page
- If email sending fails, user still gets account but sees warning message

### 2. Email Verification
- **Development Mode**: Uses `log` driver - emails are saved to `storage/logs/laravel.log`
- **Production Mode**: Configure SMTP settings in `.env` file
- Users can resend verification emails
- Manual verification link available in development mode

### 3. Access Control
- Unverified users can access verification pages
- Dashboard and profile require email verification (`verified` middleware)
- Users are redirected to verification notice if trying to access protected routes

## Email Configuration

### For Development (Current Setup)
```env
MAIL_MAILER=log
```
- Emails are logged to `storage/logs/laravel.log`
- No actual emails sent
- Use manual verification for testing

### For Production with Gmail SMTP
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@yourdomain.com"
MAIL_FROM_NAME="LatihHobi"
```

#### Gmail App Password Setup:
1. Enable 2-Factor Authentication on your Google Account
2. Go to Google Account Settings > Security > 2-Step Verification
3. Scroll down to "App passwords"
4. Generate new app password for "Mail"
5. Use this app password (not your regular Gmail password) in `MAIL_PASSWORD`

### Alternative Email Services

#### Using Mailtrap (Development)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_ENCRYPTION=tls
```

#### Using SendGrid
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your-sendgrid-api-key
MAIL_ENCRYPTION=tls
```

## Testing Email Functionality

### 1. Test Email Configuration
```bash
php artisan app:test-email your-email@example.com
```

### 2. Check Email Logs (Development)
```bash
tail -f storage/logs/laravel.log
```

### 3. Manual Verification (Development Only)
- Visit `/email/verify` after registration
- Click "Verifikasi Manual (Testing Only)" button
- This bypasses email verification for testing

### 4. Test Registration Flow
1. Go to `/register`
2. Fill form with valid data
3. Submit registration
4. Should redirect to `/email/verify`
5. Check logs or use manual verification

## Troubleshooting

### Common Issues

#### 1. "Username and Password not accepted" (Gmail)
- **Solution**: Use App Password, not regular Gmail password
- **Solution**: Enable 2-Factor Authentication first
- **Solution**: Check if "Less secure app access" is disabled (use App Password instead)

#### 2. Email not received
- **Check**: Spam/Junk folder
- **Check**: Email logs: `storage/logs/laravel.log`
- **Check**: SMTP credentials in `.env`

#### 3. "Connection refused" error
- **Check**: SMTP host and port settings
- **Check**: Firewall blocking outgoing SMTP connections
- **Check**: Internet connection

#### 4. Verification link not working
- **Check**: APP_URL in `.env` matches your domain
- **Check**: Link hasn't expired (default: 60 minutes)
- **Check**: User hasn't already verified email

### Debug Commands

```bash
# Test email configuration
php artisan app:test-email

# Clear config cache
php artisan config:clear

# Check current mail configuration
php artisan tinker
>>> config('mail')

# Check if user is verified
php artisan tinker
>>> App\Models\User::find(1)->hasVerifiedEmail()
```

## Security Notes

### Production Recommendations
1. Remove manual verification route
2. Use proper SMTP service (not Gmail for production)
3. Set up proper DNS records (SPF, DKIM, DMARC)
4. Use environment-specific `.env` files
5. Enable HTTPS for verification links

### Remove Development Features
Before deploying to production, remove these lines from:

**routes/web.php:**
```php
// Remove this entire block
Route::get('/manual-verify/{user}', function (App\Models\User $user) {
    // ... manual verification code
})->name('manual.verify');
```

**resources/views/auth/verify-email.blade.php:**
```php
// Remove this entire block
@if (app()->environment('local'))
    <div style="...">
        <!-- Manual verification button -->
    </div>
@endif
```

## File Structure

### Key Files Modified
- `app/Http/Controllers/AuthController.php` - Registration and verification logic
- `app/Models/User.php` - Email verification methods
- `app/Notifications/VerifyEmail.php` - Email notification
- `routes/web.php` - Authentication and verification routes
- `resources/views/auth/` - Authentication views
- `.env` - Email configuration

### Email Templates
- Email verification uses `app/Notifications/VerifyEmail.php`
- Customize email content in the `toMail()` method
- Email templates can be published and customized if needed

## Next Steps

1. **For Development**: Current setup works with log driver
2. **For Production**: Configure proper SMTP service
3. **Testing**: Use manual verification or check logs
4. **Customization**: Modify email templates as needed
5. **Security**: Remove development features before production deployment

The registration system is now fully functional with proper error handling and email verification workflow!