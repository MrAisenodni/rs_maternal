<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    protected $path = '/';

    public function index()
    {
        $data = [
            'c_menu'    => $this->menu->select('id', 'title', 'url')->where('disabled', 0)->where('url', $this->path)->first(),
        ];

        return view('patient.dashboard', $data);
    }

    public function registration()
    {
        return view('registration');
    }

    public function store_registration(Request $request)
    {
        $validate = $request->validate([
            'email'                 => 'unique:mst_user,email,1,disabled',
            'full_name'             => 'required',
            'gender'                => 'required',
            'home_number'           => 'unique:mst_user,home_number,1,disabled',
            'nik'                   => 'required|unique:mst_user,nik,1,disabled',
            'phone_number'          => 'unique:mst_user,phone_number,1,disabled',
            'password'              => 'required|min:8',
            'repassword'            => 'required|same:password',
            'username'              => 'required|unique:stg_login,username,1,disabled',
        ]);

        $data = [
            'nik'                   => $request->nik,
            'full_name'             => $request->full_name,
            'gender'                => $request->gender,
            'birth_place'           => $request->birth_place,
            'birth_date'            => date('Y-m-d', strtotime($request->birth_date)),
            'email'                 => $request->email,
            'phone_number'          => $request->phone_number,
            'home_number'           => $request->home_number,
            'role'                  => 'pat',
        ];

        $id = $this->user->insertGetId($data);

        $date = [
            'created_at'            => now(),
            'created_by'            => $id,
        ];

        $this->user->where('id', $id)->update($data);

        $data = [
            'user_id'               => $id,
            'username'              => $request->username,
            'password'              => Hash::make($request->password),
        ];

        $this->login->insert($data);
        
        return redirect('/login')->with('status', 'Akun Anda berhasil didaftarkan.');
    }

    public function download(Request $request) {
        return Storage::download($request->file_name);
    }
}
