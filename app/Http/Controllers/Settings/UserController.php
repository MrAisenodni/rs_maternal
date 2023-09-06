<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $path = '/setting/user';
    
    public function index()
    {
        $data = [
            'c_menu'        => $this->submenu->select('id', 'title', 'url', 'menu_id')->where('disabled', 0)->where('url', $this->path)->first(),
            'data'          => $this->user->select('id', 'nik', 'full_name', 'gender', 'birth_place', 'birth_date', 'email', 'phone_number', 'home_number', 'address_1', 'address_2', 'address_3', 'religion_id', 'role')->where('disabled', 0)->get(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('submenu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0) abort(403);

        return view('admin.settings.user.index', $data);
    }

    public function create()
    {
        $data = [
            'c_menu'        => $this->submenu->select('id', 'title', 'url', 'menu_id')->where('disabled', 0)->where('url', $this->path)->first(),
            'religions'     => $this->religion->select('id', 'name')->where('disabled', 0)->get(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('submenu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 || $data['access']->add == 0) abort(403);

        return view('admin.settings.user.create', $data);
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
            'password'          => 'required|min:8',
            'repassword'        => 'required|same:password',
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
            'created_at'            => now(),
            'created_by'            => session()->get('sname').' ('.session()->get('srole').')',
        ];

        $id = $this->user->insertGetId($data);

        $data = [
            'user_id'               => $id,
            'username'              => $request->username,
            'password'              => Hash::make($request->password),
        ];

        $this->login->insert($data);

        return redirect($this->path)->with('status', 'Data Berhasil Ditambahkan.');
    }

    public function show($id)
    {
        $data = [
            'c_menu'        => $this->submenu->select('id', 'title', 'url', 'menu_id')->where('disabled', 0)->where('url', $this->path)->first(),
            'detail'        => $this->user->select('id', 'nik', 'full_name', 'gender', 'birth_date', 'birth_place', 'email', 'phone_number', 'home_number', 'address_1', 'address_2', 'address_3', 'religion_id', 'role')->where('disabled', 0)->where('id', $id)->first(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('submenu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 || $data['access']->detail == 0) abort(403);
        
        return view('admin.settings.user.show', $data);
    }

    public function edit($id)
    {
        $data = [
            'c_menu'        => $this->submenu->select('id', 'title', 'url', 'menu_id')->where('disabled', 0)->where('url', $this->path)->first(),
            'detail'        => $this->user->select('id', 'nik', 'full_name', 'gender', 'birth_date', 'birth_place', 'email', 'phone_number', 'home_number', 'address_1', 'address_2', 'address_3', 'religion_id', 'role')->where('disabled', 0)->where('id', $id)->first(),
            'religions'     => $this->religion->select('id', 'name')->where('disabled', 0)->get(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('submenu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 || $data['access']->edit == 0) abort(403);
        
        return view('admin.settings.user.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'address_2'                 => 'max:3',
            'address_3'                 => 'max:3',
            'email'                     => 'unique:mst_user,email,'.$id.',id,disabled,0',
            'full_name'                 => 'required',
            'gender'                    => 'required',
            'home_number'               => 'unique:mst_user,home_number,'.$id.',id,disabled,0',
            'nik'                       => 'required|unique:mst_user,nik,'.$id.',id,disabled,0',
            'phone_number'              => 'unique:mst_user,phone_number,'.$id.',id,disabled,0',
            'religion'                  => 'required',
            'role'                      => 'required',
            'username'                  => 'required',
        ]);

        if (session()->get('srole') != 'adm') {
            $validate = $request->validate([
                'current_password'          => 'required_with:new_password|min:8',
                'new_password'              => 'required_with:current_password|different:current_password',
            ]);
        }

        $data = [
            'nik'                       => $request->nik,
            'full_name'                 => $request->full_name,
            'gender'                    => $request->gender,
            'birth_place'               => $request->birth_place,
            'birth_date'                => date('Y-m-d', strtotime($request->birth_date)),
            'email'                     => $request->email,
            'phone_number'              => $request->phone_number,
            'home_number'               => $request->home_number,
            'address_1'                 => $request->address_1,
            'address_2'                 => $request->address_2,
            'address_3'                 => $request->address_3,
            'religion_id'               => $request->religion,
            'role'                      => $request->role,
            'updated_at'                => now(),
            'updated_by'                => session()->get('sname').' ('.session()->get('srole').')',
        ];

        $this->user->where('id', $id)->update($data);

        $check = $this->login->select('username', 'password')->where('user_id', $id)->where('disabled', 0)->first();

        if (session()->get('srole') != 'adm') {
            if (Hash::check($request->current_password, $check->password)) {
                $data = [
                    'password'              => Hash::make($request->new_password),
                ];
            
                $this->login->where('id', $id)->update($data);
            }
        } else {
            $data = [
                'password'              => Hash::make($request->new_password),
            ];
        
            $this->login->where('id', $id)->update($data);
        }

        return redirect(url()->previous())->with('status', 'Data Berhasil Diubah.');
    }

    public function destroy($id)
    {
        $data = [
            'disabled'      => 1,
            'updated_at'    => now(),
            'updated_by'    => session()->get('sname').' ('.session()->get('srole').')',
        ];

        $this->user->where('id', $id)->update($data);
        $this->login->where('user_id', $id)->update($data);

        return redirect($this->path)->with('status', 'Data Berhasil Dihapus.');
    }
}
