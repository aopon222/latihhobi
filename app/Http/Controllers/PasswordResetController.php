<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;

class PasswordResetController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $token = Str::random(60);

        // Delete old tokens for this email
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        // Create new token
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        // For development: Always show the token link
        $resetUrl = url('/password/reset/' . $token . '?email=' . urlencode($request->email));
        
        // Try to send email, but show token regardless
        try {
            Mail::send('emails.password-reset', [
                'token' => $token, 
                'email' => $request->email
            ], function($message) use ($request) {
                $message->to($request->email);
                $message->subject('Reset Password - Latih Hobi');
            });

            return redirect()->back()->with('success', 
                'Link reset password telah dikirim ke email Anda! ' .
                '<br><br><strong>Untuk testing/development, Anda juga bisa langsung menggunakan link ini:</strong>' .
                '<br><a href="' . $resetUrl . '" style="color:#2563eb;text-decoration:underline;">' . $resetUrl . '</a>' .
                '<br><br><small>Copy link di atas dan paste di browser baru jika link tidak bisa diklik.</small>'
            );
        } catch (\Exception $e) {
            // If email fails, show token directly
            return redirect()->back()->with('success', 
                'Email gagal dikirim, tapi Anda bisa menggunakan link reset password ini:' .
                '<br><br><strong><a href="' . $resetUrl . '" style="color:#2563eb;text-decoration:underline;">' . $resetUrl . '</a></strong>' .
                '<br><br><small>Copy link di atas dan paste di browser baru.</small>' .
                '<br><br>Error email: ' . $e->getMessage()
            );
        }
    }

    public function showResetForm(Request $request, $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->email
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'token' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);

        $resetRecord = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$resetRecord) {
            return redirect()->back()->withErrors(['email' => 'Token reset password tidak valid.']);
        }

        // Check if token is not expired (24 hours)
        if (Carbon::parse($resetRecord->created_at)->addDay()->isPast()) {
            return redirect()->back()->withErrors(['email' => 'Token reset password sudah kadaluarsa.']);
        }

        // Update password
        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);

        // Delete the token
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Password berhasil direset! Silakan login dengan password baru.');
    }

    public function showChangePasswordForm()
    {
        return view('auth.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed'
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Password saat ini tidak benar.']);
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->back()->with('success', 'Password berhasil diubah!');
    }
}
