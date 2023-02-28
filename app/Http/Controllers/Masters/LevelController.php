<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    protected $path = '/master/level';

    public function index()
    {
        $data = [
            'c_menu'        => $this->menu->select('id', 'title', 'url')->where('disabled', 0)->where('url', $this->path)->first(),
            'data'          => $this->level->select('id', 'name')->where('disabled', 0)->get(),
        ];

        return view('admin.masters.level.index', $data);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $data = [
            'name'          => $input['name'],
            'created_at'    => now(),
            'created_by'    => session()->get('user_id'),
        ];

        $this->level->insert($data);

        return redirect(url()->previous())->with('status', 'Data Berhasil Ditambahkan.');
    }

    public function show($id)
    {
        $data = [
            'c_menu'        => $this->menu->select('id', 'title', 'url')->where('url', $this->path)->first(),
            'detail'        => $this->level->select('id', 'name')->where('id', $id)->where('disabled', 0)->first(),
            'data'          => $this->level->select('id', 'name')->where('disabled', 0)->get(),
        ];
        
        return view('admin.masters.level.index', $data);
    }

    public function edit($id)
    {
        $data = [
            'c_menu'        => $this->menu->select('id', 'title', 'url')->where('url', $this->path)->first(),
            'detail'        => $this->level->select('id', 'name')->where('id', $id)->where('disabled', 0)->first(),
            'data'          => $this->level->select('id', 'name')->where('disabled', 0)->get(),
        ];
        
        return view('admin.masters.level.index', $data);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $data = [
            'name'          => $input['name'],
            'updated_at'    => now(),
            'updated_by'    => session()->get('user_id'),
        ];

        $this->level->where('id', $id)->update($data);

        return redirect(url()->previous())->with('status', 'Data Berhasil Diubah.');
    }

    public function destroy($id)
    {
        $data = [
            'disabled'      => 1,
            'updated_at'    => now(),
            'updated_by'    => session()->get('user_id'),
        ];

        $this->level->where('id', $id)->update($data);

        return redirect($this->path)->with('status', 'Data Berhasil Dihapus.');
    }
}
