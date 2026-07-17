<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    // Reset password disediakan melalui PasswordResetController (route khusus)


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Toleran terhadap skema tabel users yang berbeda di XAMPP:
        // - Ada kemungkinan kolom adalah: email/password (skema Laravel normal)
        // - atau: username/password (skema custom dari project lain)
        $attemptPayload = $credentials;

        $userTableColumns = \Illuminate\Support\Facades\DB::select('SHOW COLUMNS FROM users');
        $hasEmailColumn = collect($userTableColumns)->contains(fn($c) => ($c->Field ?? null) === 'email');
        $hasUsernameColumn = collect($userTableColumns)->contains(fn($c) => ($c->Field ?? null) === 'username');

        if (! $hasEmailColumn && $hasUsernameColumn) {
            // Kalau kolom email tidak ada, input "email" dari form dipakai sebagai "username".
            $attemptPayload = [
                'username' => $credentials['email'],
                'password' => $credentials['password'],
            ];
        }

        // Kalau user tabel memakai username tapi password tidak lolos di atas (misalnya format input berbeda),
        // coba fallback: username = bagian sebelum @ dari input email.
        if (! $hasEmailColumn && $hasUsernameColumn) {
            $maybeUsername = explode('@', (string) $credentials['email'])[0];
            $attemptPayload = [
                'username' => $maybeUsername,
                'password' => $credentials['password'],
            ];
        }

        if (Auth::attempt($attemptPayload, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

return back()->withErrors([
            'email' => 'Username/email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

