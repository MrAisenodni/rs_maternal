<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $path = '/pengaturan/pengguna';
    
    public function index()
    {
        $data = [
            'menu'          => $this->submenu->select('id', 'title', 'menu_id', 'url')->where('url', $this->path)->first(),
            'data'          => $this->user->select('id', 'nik', 'full_name', 'gender', 'birth_place', 'birth_date', 'email', 'phone_number', 'home_number', 'address', 'join_date', 'religion_id', 'position_id', 'access_code')->where('disabled', 0)->get(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail')->where('disabled', 0)
            ->where('login_id', session()->get('sid'))->where('submenu_id', $data['menu']->id)->first();
        if ($data['access']->view == 0) abort(403);

        return view('settings.user.index', $data);
    }

    public function create()
    {
        $data = [
            'menu'          => $this->submenu->select('id', 'title', 'menu_id', 'url')->where('url', $this->path)->first(),
            'religions'     => $this->religion->select('id','name')->where('disabled', 0)->get(),
            'positions'     => $this->position->select('id','name')->where('disabled', 0)->get(),
        ];
        $access = $this->menu_access->select('add')->where('disabled', 0)->where('submenu_id', $data['menu']->id)->where('login_id', session()->get('sid'))->first();
        if (!$access) abort(403);
        if ($access->add == 0) abort(403);

        return view('settings.user.create', $data);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validate = $request->validate([
            'nik'               => 'required|unique:mst_user,nik,1,disabled',
            'full_name'         => 'required',
        ]);

        $data = [
            'nik'           => $input['nik'],
            'full_name'     => $input['full_name'],
            'gender'        => $input['gender'],
            'birth_place'   => $input['birth_place'],
            'birth_date'    => $input['birth_date'],
            'email'         => $input['email'],
            'phone_number'  => $input['phone_number'],
            'home_number'   => $input['home_number'],
            'address'       => $input['address'],
            'join_date'     => $input['join_date'],
            'religion_id'   => $input['religion'],
            'position_id'   => $input['position'],
            'created_at'    => now(),
            'created_by'    => session()->get('user_id'),
        ];

        $this->user->insert($data);

        return redirect($this->path)->with('status', 'Data Berhasil Ditambahkan.');
    }

    public function show($id)
    {
        $data = [
            'menu'          => $this->submenu->select('id', 'title', 'menu_id', 'url')->where('url', $this->path)->first(),
            'religions'     => $this->religion->select('id','name')->where('disabled', 0)->get(),
            'positions'     => $this->position->select('id','name')->where('disabled', 0)->get(),
            'detail'        => $this->user->select('id', 'nik', 'full_name', 'gender', 'birth_place', 'birth_date', 'email', 'phone_number', 'home_number', 'address', 'join_date', 'religion_id', 'position_id', 'access_code')->where('id', $id)->where('disabled', 0)->first(),
        ];
        
        return view('settings.user.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        if ($request->delete) {
            $data = [
                'disabled'      => 1,
                'updated_at'    => now(),
                'updated_by'    => session()->get('user_id'),
            ];
    
            $this->user->where('id', $id)->update($data);
    
            return redirect($this->path)->with('status', 'Data Berhasil Dihapus.');
        } else {
            $validate = $request->validate([
                'nik'           => 'required|unique:mst_user,nik,'.$id.',id,disabled,0',
                'full_name'     => 'required',
            ]);
    
            $data = [
                'nik'           => $input['nik'],
                'full_name'     => $input['full_name'],
                'gender'        => $input['gender'],
                'birth_place'   => $input['birth_place'],
                'birth_date'    => $input['birth_date'],
                'email'         => $input['email'],
                'phone_number'  => $input['phone_number'],
                'home_number'   => $input['home_number'],
                'address'       => $input['address'],
                'join_date'     => $input['join_date'],
                'religion_id'   => $input['religion'],
                'position_id'   => $input['position'],
                'updated_at'    => now(),
                'updated_by'    => session()->get('user_id'),
            ];
    
            $this->user->where('id', $id)->update($data);
        }

        return redirect(url()->previous())->with('status', 'Data Berhasil Diubah.');
    }

    public function destroy($id)
    {
        $data = [
            'disabled'      => 1,
            'updated_at'    => now(),
            'updated_by'    => session()->get('user_id'),
        ];

        $this->user->where('id', $id)->update($data);

        return redirect($this->path)->with('status', 'Data Berhasil Dihapus.');
    }
}
