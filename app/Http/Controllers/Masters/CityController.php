<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CityController extends Controller
{
    protected $path = '/master/city';

    public function index()
    {
        $data = [
            'c_menu'            => $this->menu->select('id', 'title', 'main_menu_id', 'url')->where('url', $this->path)->first(),
            'data'              => $this->city->select('id', 'code', 'name', 'province_id')->where('disabled', 0)->get(),
            'provinces'         => $this->province->select('id', 'code', 'name')->where('disabled', 0)->get(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0) abort(403);

        return view('admin.masters.city.index', $data);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validate = $request->validate([
            'code'              => 'required|unique:mst_city,code,1,disabled',
            'name'              => 'required',
            'province'          => 'required',
        ]);

        $data = [
            'code'              => $input['code'],
            'name'              => $input['name'],
            'province_id'       => $input['province'],
            'created_at'        => now(),
            'created_by'        => session()->get('sname').' ('.session()->get('srole').')',
        ];

        $this->city->insert($data);

        return redirect(url()->previous())->with('status', 'Data Berhasil Ditambahkan.');
    }

    public function show($id)
    {
        $data = [
            'c_menu'            => $this->menu->select('id', 'title', 'main_menu_id', 'url')->where('url', $this->path)->first(),
            'detail'            => $this->city->select('id', 'code', 'name', 'province_id')->where('id', $id)->where('disabled', 0)->first(),
            'data'              => $this->city->select('id', 'code', 'name', 'province_id')->where('disabled', 0)->get(),
            'provinces'         => $this->province->select('id', 'code', 'name')->where('disabled', 0)->get(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 || $data['access']->detail == 0) abort(403);
        
        return view('admin.masters.city.index', $data);
    }

    public function edit($id)
    {
        $data = [
            'c_menu'            => $this->menu->select('id', 'title', 'main_menu_id', 'url')->where('url', $this->path)->first(),
            'detail'            => $this->city->select('id', 'code', 'name', 'province_id')->where('id', $id)->where('disabled', 0)->first(),
            'data'              => $this->city->select('id', 'code', 'name', 'province_id')->where('disabled', 0)->get(),
            'provinces'         => $this->province->select('id', 'code', 'name')->where('disabled', 0)->get(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 || $data['access']->edit == 0) abort(403);
        
        return view('admin.masters.city.index', $data);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $validate = $request->validate([
            'code'              => 'required|unique:mst_city,code,'.$id.',id,disabled,1',
            'name'              => 'required',
            'province'          => 'required',
        ]);

        $data = [
            'code'              => $input['code'],
            'name'              => $input['name'],
            'province_id'       => $input['province'],
            'updated_at'        => now(),
            'updated_by'        => session()->get('sname').' ('.session()->get('srole').')',
        ];

        $this->city->where('id', $id)->update($data);

        return redirect(url()->previous())->with('status', 'Data Berhasil Diubah.');
    }

    public function destroy($id)
    {
        $data = [
            'disabled'          => 1,
            'updated_at'        => now(),
            'updated_by'        => session()->get('sname').' ('.session()->get('srole').')',
        ];

        $this->city->where('id', $id)->update($data);

        return redirect($this->path)->with('status', 'Data Berhasil Dihapus.');
    }
}
