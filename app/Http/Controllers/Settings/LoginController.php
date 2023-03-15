<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{ Auth, Hash };

class LoginController extends Controller
{
    public function index()
    {
        session()->put('surl', url()->previous());

        return view('login');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'username'              => 'required',
            'password'              => 'required',
        ]);
        
        $check = $this->login->where('username', $request->username)->where('disabled', 0)->first();
        
        if(!$check) {
            return back()->with('error', 'Nama Pengguna salah.')->withErrors([
                'username'  => 'Nama Pengguna yang Anda masukkan salah.',
            ]);
        } else {
            // Mengecek password
            if(Hash::check($request->password, $check->password)) {
                $request->session()->put('id', $check->id);
                $request->session()->put('user_id', $check->user_id);
                $request->session()->put('username', $check->username);
                $request->session()->put('password', $check->password);
                $request->session()->put('role', $check->user->role);
                $request->session()->put('remember_token', $check->remember_token);

                if (session()->get('url') != '/login') {
                    return redirect()->intended(session()->get('url'));
                } else {
                    return redirect()->intended('/');
                }
            } else {
                return back()->with('error', 'Kata Sandi salah.')->withErrors([
                    'password'  => 'Kata sandi yang Anda masukkan salah.',
                ])->withInput();
            }
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('status', 'Anda berhasil keluar.');
    }
}
