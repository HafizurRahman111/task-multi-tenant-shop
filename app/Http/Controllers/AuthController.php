<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // handle login request
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // check the user's role and redirect accordingly
            if ($user->role === 'admin') {
                $request->session()->regenerate();
                return redirect()->intended('/admin/dashboard');
            } elseif ($user->role === 'merchant') {
                $request->session()->regenerate();
                return redirect()->intended('/merchant/dashboard');
            } else {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'You do not have permission to access this system.',
                ])->withInput($request->only('email'));
            }
        }

        // if authentication fails, return with error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    // handle logout request
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }


    public function showRegistrationForm()
    {
        return view('auth.register');
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tenant_email' => 'required|email|max:255|exists:tenants,email',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'shop_name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $tenant = Tenant::where('email', $request->tenant_email)->first();

        if (!$tenant) {
            return back()->withErrors(['tenant_email' => 'The provided tenant email does not exist.'])->withInput();
        }

        if (User::where('tenant_id', $tenant->id)->exists()) {
            return back()->withErrors(['tenant_email' => 'A user is already registered under this tenant.'])->withInput();
        }

        $user = User::create([
            'tenant_id' => $tenant->id,
            'name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'shop_name' => $request->shop_name,
        ]);

        return redirect()->route('login')->with('success', 'Registration successful! You can now login.');
    }

}
