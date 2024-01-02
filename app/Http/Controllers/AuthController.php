<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Format email yang anda inputkan salah',
                'password.required' => 'Password wajib diisi'
            ]
        );
        
        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended("/");
        }
        // if (Auth::attempt($credentials)) {
        //     $request->session()->regenerate();
        //     return redirect()->intended('/');
        // }

        return back()->with(['error' => 'Password / email salah',])->onlyInput('email', 'password');
    }

    public function showRegistrationForm()
    {
        return view('pages.auth.register');
    }

    public function register(Request $request)
    {
        // Implement registration logic here
        $request->validate([
            'name' => 'required',
            'username' => 'required|min:8|unique:users',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:8',
            'foto_profile' => 'required|max:3072|image|mimes:jpeg,png,jpg,gif,svg,webp'
        ],
        [
            'name.required' => 'Nama wajib diisi',
            'username.required' => 'Username wajib diisi',
            'username.min' => 'Username minimal berisi 8 karakter',
            'username.unique' => 'Username tidak tersedia',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email yang anda inputkan salah',
            'email.unique' => 'Email tidak tersedia',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Panjang password minimal 8 karakter',
            'foto_profile.required' => 'Foto profile wajib diisi',
            'foto_profile.max' => 'Ukuran foto maximal 3 MB',
            'foto_profile.image' => 'File yang anda masukkan bukan gambar',
            'foto_profile.mimes' => 'Foto harus berformat jpeg,png,jpg,gif,svg,webp',
        ]
        );

        $foto_profile = $request->file('foto_profile');
        $foto_profile->storeAs('public/foto-profile', $foto_profile->hashName());

        $createUser = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password ),
            'foto_profile' => $foto_profile->hashName()
        ]);

        if($createUser) {
        return redirect('/login')->with('success', 'Registration successful! Please log in.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
     
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/login')->with([
            'success' => 'Logout Berhasil !'
        ]);
    }
}
