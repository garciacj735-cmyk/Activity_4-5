<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request): RedirectResponse
    {
        // ✅ VALIDATE
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // ❌ INVALID LOGIN
        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()->withErrors([
                'email' => 'Invalid credentials',
            ]);
        }

        // ✅ REGENERATE SESSION
        $request->session()->regenerate();

        $user = Auth::user();

        // 🔥 ROLE-BASED REDIRECT (STRICT REQUIREMENT)
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('dashboard');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
