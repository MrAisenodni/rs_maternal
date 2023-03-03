<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{ Auth, Hash };

class LoginController extends Controller
{
    public function index()
    {
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
                $request->session()->put('sid', $check->id);
                $request->session()->put('suser_id', $check->user_id);
                $request->session()->put('susername', $check->username);
                $request->session()->put('spassword', $check->password);
                $request->session()->put('sremember_token', $check->remember_token);

                return redirect()->intended('/');
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
