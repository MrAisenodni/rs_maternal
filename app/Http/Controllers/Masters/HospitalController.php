<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    protected $path = '/master/hospital';

    public function index()
    {
        $data = [
            'c_menu'        => $this->menu->select('id', 'title', 'url')->where('disabled', 0)->where('url', $this->path)->first(),
            'data'          => $this->hospital->select('id', 'name', 'type')->where('type', 'int')->where('disabled', 0)->get(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0) abort(403);

        return view('admin.masters.hospital.index', $data);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name'          => 'required',
            'type'          => 'required',
        ]);

        $data = [
            'name'          => $request->name,
            'type'          => $request->type,
            'created_at'    => now(),
            'created_by'    => session()->get('sname').' ('.session()->get('srole').')',
        ];
        $id = $this->hospital->insertGetId($data);
        
        $results = $this->result->select('id')->get();
        if ($results)
        {
            for ($i = 0; $i < $results->count(); $i++) 
            {
                $detail_results = $this->detail_result->select('id')->where('result_id', $results[$i]->id)->get();
                if ($detail_results) 
                {
                    for ($a = 0; $a < $detail_results->count(); $a++) 
                    {
                        $companions = $this->companion->select('id')->get();
                        if ($companions)
                        {
                            for ($b = 0; $b < $companions->count(); $b++) 
                            {
                                $data = [
                                    'companion_id'      => $companions[$b]->id,
                                    'hospital_id'       => $id,
                                    'result_id'         => $results[$i]->id,
                                    'detail_result_id'  => $detail_results[$a]->id,
                                    'value'             => 0,
                                    'created_at'        => now(),
                                    'created_by'        => session()->get('sname').' ('.session()->get('srole').')',
                                ];

                                $this->clinic_results->insert($data);
                            }
                        }
                    }
                }
            }
        }

        return redirect(url()->previous())->with('status', 'Data Berhasil Ditambahkan.');
    }

    public function show($id)
    {
        $data = [
            'c_menu'        => $this->menu->select('id', 'title', 'url')->where('url', $this->path)->first(),
            'detail'        => $this->hospital->select('id', 'name', 'type')->where('type', 'int')->where('id', $id)->where('disabled', 0)->first(),
            'data'          => $this->hospital->select('id', 'name', 'type')->where('type', 'int')->where('disabled', 0)->get(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 || $data['access']->detail == 0) abort(403);
        
        return view('admin.masters.hospital.index', $data);
    }

    public function edit($id)
    {
        $data = [
            'c_menu'        => $this->menu->select('id', 'title', 'url')->where('url', $this->path)->first(),
            'detail'        => $this->hospital->select('id', 'name', 'type')->where('type', 'int')->where('id', $id)->where('disabled', 0)->first(),
            'data'          => $this->hospital->select('id', 'name', 'type')->where('type', 'int')->where('disabled', 0)->get(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 || $data['access']->edit == 0) abort(403);
        
        return view('admin.masters.hospital.index', $data);
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name'          => 'required',
            'type'          => 'required',
        ]);

        $data = [
            'name'          => $request->name,
            'type'          => $request->type,
            'updated_at'    => now(),
            'updated_by'    => session()->get('sname').' ('.session()->get('srole').')',
        ];

        $this->hospital->where('id', $id)->update($data);

        return redirect(url()->previous())->with('status', 'Data Berhasil Diubah.');
    }

    public function destroy($id)
    {
        $data = [
            'disabled'      => 1,
            'updated_at'    => now(),
            'updated_by'    => session()->get('sname').' ('.session()->get('srole').')',
        ];

        $this->hospital->where('id', $id)->update($data);

        return redirect($this->path)->with('status', 'Data Berhasil Dihapus.');
    }
}
