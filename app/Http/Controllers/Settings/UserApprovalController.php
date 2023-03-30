<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserApprovalController extends Controller
{
    protected $path = '/setting/user-approval';
    
    public function index()
    {
        $data = [
            'c_menu'        => $this->submenu->select('id', 'title', 'url', 'menu_id')->where('disabled', 0)->where('url', $this->path)->first(),
            'data'          => $this->user_approval->select('id', 'nik', 'full_name', 'gender', 'birth_place', 'birth_date', 'email', 'phone_number', 'home_number', 'address_1', 'address_2', 'address_3', 'religion_id', 'role')->where('disabled', 0)->get(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('submenu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0) abort(403);

        return view('admin.settings.user_approval.index', $data);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'address_2'         => 'max:3',
            'address_3'         => 'max:3',
            'email'             => 'unique:mst_user,email,1,disabled',
            'full_name'         => 'required',
            'gender'            => 'required',
            'home_number'       => 'unique:mst_user,home_number,1,disabled',
            'nik'               => 'required|unique:mst_user,nik,1,disabled',
            'phone_number'      => 'unique:mst_user,phone_number,1,disabled',
            'religion'          => 'required',
            'role'              => 'required',
            'username'          => 'required',
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
            'address_1'             => $request->address_1,
            'address_2'             => $request->address_2,
            'address_3'             => $request->address_3,
            'religion_id'           => $request->religion,
            'role'                  => $request->role,
            'created_at'            => $request->created_at,
            'created_by'            => 'Pengunjung',
            'approved_at'           => now(),
            'approved_by'           => session()->get('sname').' ('.session()->get('srole').')',
        ];

        $id = $this->user->insertGetId($data);
        $this->user_approval->where('id', $request->id)->delete();

        $data = [
            'user_id'               => $id,
            'username'              => $request->username,
            'password'              => $request->password,
            'created_at'            => $request->created_at,
            'created_by'            => 'Pengunjung',
            'approved_at'           => now(),
            'approved_by'           => session()->get('sname').' ('.session()->get('srole').')',
        ];

        $this->login->insert($data);
        $this->login_approval->where('id', $request->login_id)->delete();

        return redirect($this->path)->with('status', 'Data Berhasil Disetujui.');
    }

    public function show($id)
    {
        $data = [
            'c_menu'        => $this->submenu->select('id', 'title', 'url', 'menu_id')->where('disabled', 0)->where('url', $this->path)->first(),
            'detail'        => $this->user_approval->select('id', 'nik', 'full_name', 'gender', 'birth_date', 'birth_place', 'email', 'phone_number', 'home_number', 'address_1', 'address_2', 'address_3', 'religion_id', 'role', 'created_by', 'created_at')->where('disabled', 0)->where('id', $id)->first(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('submenu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 || $data['access']->detail == 0) abort(403);
        
        return view('admin.settings.user_approval.show', $data);
    }

    public function destroy($id)
    {
        $data = [
            'disabled'      => 1,
            'updated_at'    => now(),
            'updated_by'    => session()->get('sname').' ('.session()->get('srole').')',
        ];

        $this->user_approval->where('id', $id)->update($data);
        $this->login->where('user_id', $id)->update($data);

        return redirect($this->path)->with('status', 'Data Berhasil Dihapus.');
    }
}
