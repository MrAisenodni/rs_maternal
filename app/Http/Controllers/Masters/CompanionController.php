<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanionController extends Controller
{
    protected $path = '/master/companion';

    public function index()
    {
        $data = [
            'c_menu'            => $this->menu->select('id', 'title', 'url')->where('disabled', 0)->where('url', $this->path)->first(),
            'data'              => $this->companion->select('id', 'title')->where('disabled', 0)->get(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 && $data['access']->add == 0) abort(403);

        return view('admin.masters.companion.index', $data);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $data = [
            'title'             => $input['title'],
            'created_at'        => now(),
            'created_by'        => session()->get('sname').' ('.session()->get('srole').')',
        ];

        $this->companion->insert($data);

        return redirect(url()->previous())->with('status', 'Data Berhasil Ditambahkan.');
    }

    public function show($id)
    {
        $data = [
            'c_menu'            => $this->menu->select('id', 'title', 'url')->where('url', $this->path)->first(),
            'detail'            => $this->companion->select('id', 'title')->where('id', $id)->where('disabled', 0)->first(),
            'data'              => $this->companion->select('id', 'title')->where('disabled', 0)->get(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 && $data['access']->detail == 0) abort(403);
        
        return view('admin.masters.companion.index', $data);
    }

    public function edit($id)
    {
        $data = [
            'c_menu'            => $this->menu->select('id', 'title', 'url')->where('url', $this->path)->first(),
            'detail'            => $this->companion->select('id', 'title')->where('id', $id)->where('disabled', 0)->first(),
            'data'              => $this->companion->select('id', 'title')->where('disabled', 0)->get(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 && $data['access']->edit == 0) abort(403);
        
        return view('admin.masters.companion.index', $data);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $data = [
            'title'             => $input['title'],
            'updated_at'        => now(),
            'updated_by'        => session()->get('sname').' ('.session()->get('srole').')',
        ];

        $this->companion->where('id', $id)->update($data);

        return redirect(url()->previous())->with('status', 'Data Berhasil Diubah.');
    }

    public function destroy($id)
    {
        $data = [
            'disabled'          => 1,
            'updated_at'        => now(),
            'updated_by'        => session()->get('sname').' ('.session()->get('srole').')',
        ];

        $this->companion->where('id', $id)->update($data);

        return redirect($this->path)->with('status', 'Data Berhasil Dihapus.');
    }
}
