<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class EmailTestController extends Controller
{
    public function showManualVerify()
    {
        return view('auth.manual-verify');
    }

    public function manualVerify(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && !$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            return redirect()->route('login')->with('success', 'Email berhasil diverifikasi secara manual! Silakan login.');
        }

        if ($user && $user->hasVerifiedEmail()) {
            return redirect()->back()->with('info', 'Email sudah terverifikasi sebelumnya.');
        }

        return redirect()->back()->withErrors(['email' => 'Email tidak ditemukan.']);
    }

    public function testEmail()
    {
        try {
            Mail::raw('Test email dari LatihHobi', function ($message) {
                $message->to('test@example.com')
                        ->subject('Test Email - LatihHobi');
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Email test berhasil dikirim! Check email Anda atau log email.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email gagal dikirim: ' . $e->getMessage()
            ]);
        }
    }

    public function showEmailStatus()
    {
        $user = Auth::user();
        $emailConfig = [
            'mailer' => config('mail.default'),
            'host' => config('mail.mailers.smtp.host'),
            'port' => config('mail.mailers.smtp.port'),
            'from' => config('mail.from.address'),
        ];

        return view('auth.email-status', compact('user', 'emailConfig'));
    }
}