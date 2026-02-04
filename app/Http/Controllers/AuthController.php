<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($request->email === 'adminrental@gmail.com' && $request->password === 'adminrental123') {
            $cekAdmin = User::where('email', 'adminrental@gmail.com')->first();
            if (!$cekAdmin) {
                User::create([
                    'nama'     => 'Administrator',
                    'email'    => 'adminrental@gmail.com',
                    'password' => Hash::make('adminrental123'),
                    'role'     => 'admin',
                    'no_hp'    => '085706760096',
                    'alamat'   => 'Kantor Admin',
                ]);
            }
        }

        if ($request->email === 'adminrental@gmail.com' && $request->password === 'adminrental123') {
            $admin = User::where('email', 'adminrental@gmail.com')->first();

            if (!$admin) {
                $admin = User::create([
                    'nama' => 'Super Admin',
                    'email' => 'adminrental@gmail.com',
                    'password' =>   Hash::make('adminrental123'),
                    'role' => 'admin',
                    'alamat' => 'Kantor Pusat',
                    'no_hp' => '08123456789'
                ]);
            } else {
            }

            Auth::login($admin);
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        if (! Auth::attempt($credentials, $request->filled('remember'))) {
            return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
        }

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()->intended(route('user.dashboard'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
