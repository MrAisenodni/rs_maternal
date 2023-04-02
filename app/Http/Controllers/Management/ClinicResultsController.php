<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{ File, Hash };

class ClinicResultsController extends Controller
{
    protected $path         = '/admin/clinic-results';

    public function index()
    {
        $data = [
            'c_menu'                            => $this->menu->select('id', 'title', 'url', 'main_menu_id')->where('disabled', 0)->where('url', $this->path)->first(),
            'data'                              => $this->hospital->select('id', 'name', 'type')->where('type', 'int')->where('disabled', 0)->get(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0) abort(403);

        return view('admin.management.clinic_results.index', $data);
    }

    public function show($id)
    {
        $data = [
            'c_menu'                            => $this->menu->select('id', 'title', 'url', 'main_menu_id')->where('disabled', 0)->where('url', $this->path)->first(),
            'detail'                            => $this->hospital->select('id', 'name', 'type')->where('type', 'int')->where('disabled', 0)->where('id', $id)->first(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 && $data['access']->detail == 0) abort(403);
        
        return view('admin.management.clinic_results.show', $data);
    }

    public function edit($id)
    {
        $data = [
            'c_menu'                            => $this->menu->select('id', 'title', 'url', 'main_menu_id')->where('disabled', 0)->where('url', $this->path)->first(),
            'detail'                            => $this->hospital->select('id', 'name', 'type')->where('type', 'int')->where('disabled', 0)->where('id', $id)->first(),
            'companions'                        => $this->companion->select('id', 'title')->where('disabled', 0)->get(),
            'results'                           => $this->result->select('id', 'title', 'subtitle')->where('disabled', 0)->get(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 && $data['access']->edit == 0) abort(403);
        // dd($data['detail']->clinic_results);

        return view('admin.management.clinic_results.edit', $data);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $input = $request->all();

        for ($i=1; $i <= $request->count; $i++) { 
            $data = [
                'value'                         => $input['value'.$i],
                'updated_at'                    => now(),
                'updated_by'                    => session()->get('sname').' ('.session()->get('srole').')',
            ];

            // dd($data, $request->value1, $input['id'.$i]);
            $this->clinic_results->where('id', $input['id'.$i])->update($data);
        }

        return redirect($this->path.'/'.$id.'/edit')->with('status', 'Data Berhasil Disimpan.');
    }

}
