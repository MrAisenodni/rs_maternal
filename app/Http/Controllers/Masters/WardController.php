<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WardController extends Controller
{
    protected $path = '/master/kelurahan';

    public function index()
    {
        $data = [
            'menu'          => $this->submenu->select('id', 'title', 'menu_id', 'url')->where('url', $this->path)->first(),
            'data'          => $this->ward->select('id', 'post_code', 'name', 'district_id')->where('disabled', 0)->paginate(5000),
            'districts'     => $this->district->select('id', 'code', 'name')->where('disabled', 0)->get(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0) abort(403);

        return view('masters.ward.index', $data);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validate = $request->validate([
            'code'              => 'required|unique:mst_ward,code,1,disabled',
            'name'              => 'required',
            'district'           => 'required',
        ]);

        $data = [
            'post_code'     => $input['code'],
            'name'          => $input['name'],
            'district_id'   => $input['district'],
            'created_at'    => now(),
            'created_by'    => session()->get('user_id'),
        ];

        $this->ward->insert($data);

        return redirect(url()->previous())->with('status', 'Data Berhasil Ditambahkan.');
    }

    public function show($id)
    {
        $data = [
            'menu'          => $this->submenu->select('id', 'title', 'menu_id', 'url')->where('url', $this->path)->first(),
            'detail'        => $this->ward->select('id', 'post_code', 'name', 'district_id')->where('id', $id)->where('disabled', 0)->first(),
            'data'          => $this->ward->select('id', 'post_code', 'name', 'district_id')->where('disabled', 0)->paginate(5000),
            'districts'     => $this->district->select('id', 'code', 'name')->where('disabled', 0)->get(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 || $data['access']->detail == 0) abort(403);
        
        return view('masters.ward.index', $data);
    }

    public function edit($id)
    {
        $data = [
            'menu'          => $this->submenu->select('id', 'title', 'menu_id', 'url')->where('url', $this->path)->first(),
            'detail'        => $this->ward->select('id', 'post_code', 'name', 'district_id')->where('id', $id)->where('disabled', 0)->first(),
            'data'          => $this->ward->select('id', 'post_code', 'name', 'district_id')->where('disabled', 0)->paginate(5000),
            'districts'     => $this->district->select('id', 'code', 'name')->where('disabled', 0)->get(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 || $data['access']->edit == 0) abort(403);
        
        return view('masters.ward.index', $data);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $validate = $request->validate([
            'code'              => 'required|unique:mst_ward,code,'.$id.',id,disabled,1',
            'name'              => 'required',
            'district'           => 'required',
        ]);

        $data = [
            'post_code'     => $input['code'],
            'name'          => $input['name'],
            'district_id'   => $input['district'],
            'updated_at'    => now(),
            'updated_by'    => session()->get('user_id'),
        ];

        $this->ward->where('id', $id)->update($data);

        return redirect(url()->previous())->with('status', 'Data Berhasil Diubah.');
    }

    public function destroy($id)
    {
        $data = [
            'disabled'      => 1,
            'updated_at'    => now(),
            'updated_by'    => session()->get('user_id'),
        ];

        $this->ward->where('id', $id)->update($data);

        return redirect($this->path)->with('status', 'Data Berhasil Dihapus.');
    }
}
