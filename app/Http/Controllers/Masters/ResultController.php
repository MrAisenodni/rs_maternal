<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    protected $path = '/master/result';

    public function index()
    {
        $data = [
            'c_menu'            => $this->menu->select('id', 'title', 'url')->where('disabled', 0)->where('url', $this->path)->first(),
            'data'              => $this->result->select('id', 'title', 'subtitle')->where('disabled', 0)->get(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 && $data['access']->add == 0) abort(403);

        return view('admin.masters.result.index', $data);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $data = [
            'title'             => $input['title'],
            'created_at'        => now(),
            'created_by'        => session()->get('sname').' ('.session()->get('srole').')',
        ];

        $this->result->insert($data);

        return redirect(url()->previous())->with('status', 'Data Berhasil Ditambahkan.');
    }

    public function show($id)
    {
        $data = [
            'c_menu'            => $this->menu->select('id', 'title', 'url')->where('url', $this->path)->first(),
            'detail'            => $this->result->select('id', 'title', 'subtitle')->where('id', $id)->where('disabled', 0)->first(),
            'data'              => $this->result->select('id', 'title', 'subtitle')->where('disabled', 0)->get(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 || $data['access']->detail == 0) abort(403);
        
        return view('admin.masters.result.index', $data);
    }

    public function edit($id)
    {
        $data = [
            'c_menu'            => $this->menu->select('id', 'title', 'url')->where('url', $this->path)->first(),
            'detail'            => $this->result->select('id', 'title', 'subtitle')->where('id', $id)->where('disabled', 0)->first(),
            'data'              => $this->result->select('id', 'title', 'subtitle')->where('disabled', 0)->get(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 || $data['access']->edit == 0) abort(403);
        
        return view('admin.masters.result.index', $data);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $data = [
            'title'             => $input['title'],
            'updated_at'        => now(),
            'updated_by'        => session()->get('sname').' ('.session()->get('srole').')',
        ];

        $this->result->where('id', $id)->update($data);

        return redirect(url()->previous())->with('status', 'Data Berhasil Diubah.');
    }

    public function destroy($id)
    {
        $data = [
            'disabled'          => 1,
            'updated_at'        => now(),
            'updated_by'        => session()->get('sname').' ('.session()->get('srole').')',
        ];

        $this->result->where('id', $id)->update($data);

        return redirect($this->path)->with('status', 'Data Berhasil Dihapus.');
    }
}
