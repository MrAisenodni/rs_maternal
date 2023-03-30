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
            'c_menu'                => $this->menu->select('id', 'title', 'url', 'main_menu_id')->where('disabled', 0)->where('url', $this->path)->first(),
            'companion'             => $this->companion->select('trx_companion.id', 'trx_companion.title', 'trx_standard_process.description', 'trx_standard_process.standard', 'trx_standard_process.process')
                                        ->join('trx_standard_process', 'trx_standard_process.companion_id', '=', 'trx_companion.id')
                                        ->where('trx_companion.disabled', 0)->get(),
            'count_user'            => $this->user->selectRaw('COUNT(role) AS count, role')->where('disabled', 0)->where('role', '!=', 'adm')->groupBy('role')->orderBy('role')->get(),
            'count_video'           => $this->course_detail->select('id')->where('disabled', 0)->count(),
            'count_document'        => $this->course_detail_document->select('id')->where('disabled', 0)->count(),
        ];
        
        return view('patient.dashboard', $data);
    }

    public function registration()
    {
        $data = [
            'religions'             => $this->religion->select('id', 'name')->where('disabled', 0)->get(),
        ];

        return view('registration', $data);
    }

    public function store_registration(Request $request)
    {
        $validate = $request->validate([
            'email'                 => 'unique:mst_user,email,1,disabled|unique:mst_user_approval,email,1,disabled',
            'full_name'             => 'required',
            'gender'                => 'required',
            'home_number'           => 'unique:mst_user,home_number,1,disabled|unique:mst_user_approval,home_number,1,disabled',
            'nik'                   => 'required|unique:mst_user,nik,1,disabled|unique:mst_user_approval,nik,1,disabled',
            'phone_number'          => 'unique:mst_user,phone_number,1,disabled|unique:mst_user_approval,phone_number,1,disabled',
            'password'              => 'required|min:8',
            'repassword'            => 'required|same:password',
            'username'              => 'required|unique:stg_login,username,1,disabled|unique:stg_login_approval,username,1,disabled',
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
            'role'                  => $request->role,
        ];

        $id = $this->user_approval->insertGetId($data);

        $date = [
            'created_at'            => now(),
            'created_by'            => $id,
        ];

        $this->user_approval->where('id', $id)->update($data);

        $data = [
            'user_id'               => $id,
            'username'              => $request->username,
            'password'              => Hash::make($request->password),
        ];

        $this->login_approval->insert($data);
        
        return redirect('/login')->with('status', 'Akun Anda berhasil diajukan. Silahkan tunggu hingga akun Anda disetujui.');
    }

    public function download(Request $request) {
        return Storage::download($request->file_name);
    }
}
