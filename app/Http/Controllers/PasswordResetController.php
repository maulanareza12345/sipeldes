<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class PasswordResetController extends Controller
{
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        // SESUAI permintaan: 1) Tanpa email -> user masukin email, sistem menampilkan token reset di browser.
        $data = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $data['email'])->first();

        if (! $user) {
            return back()->withErrors(['email' => 'Email tidak terdaftar.'])->onlyInput('email');
        }

        $token = Str::random(64);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            [
                'token' => $token,
                'created_at' => now(),
            ]
        );

        return redirect()->route('password.reset', ['token' => $token])
            ->with('success', 'Token reset berhasil dibuat. Silakan masukkan password baru.');
    }

    public function showResetForm(string $token)
    {
        $record = DB::table('password_reset_tokens')->where('token', $token)->first();

        if (! $record) {
            return redirect()->route('password.request')->withErrors(['token' => 'Token reset tidak valid.']);
        }

        return view('auth.reset-password', [
            'token' => $token,
        ]);
    }

    public function resetPassword(Request $request, string $token)
    {
        $data = $request->validate([
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'password_confirmation' => ['required'],
        ]);

        $record = DB::table('password_reset_tokens')->where('token', $token)->first();

        if (! $record) {
            return back()->withErrors(['token' => 'Token reset tidak valid.']);
        }

        $createdAt = Carbon::parse($record->created_at);
        if ($createdAt->lt(now()->subHour())) {
            return back()->withErrors(['token' => 'Token reset sudah kedaluwarsa.']);
        }

        $user = User::where('email', $record->email)->first();
        if (! $user) {
            return back()->withErrors(['email' => 'Akun tidak ditemukan.']);
        }

        $user->forceFill([
            'password' => Hash::make($data['password']),
        ])->save();

        DB::table('password_reset_tokens')->where('email', $record->email)->delete();

        return redirect()->route('login')->with('success', 'Password berhasil diperbarui. Silakan login.');
    }
}

