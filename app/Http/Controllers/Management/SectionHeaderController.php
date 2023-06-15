<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{ File, Hash };

class SectionHeaderController extends Controller
{
    protected $path = '/admin/section-header';

    public function index()
    {
        $data = [
            'c_menu'                            => $this->menu->select('id', 'title', 'url', 'main_menu_id')->where('disabled', 0)->where('url', $this->path)->first(),
            'data'                              => $this->section_header->select('id', 'title', 'title_color', 'menu_id', 'created_at', 'created_by', 'updated_at', 'updated_by')->get(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0) abort(403);

        return view('admin.management.section_header.index', $data);
    }

    public function edit($id)
    {
        $data = [
            'c_menu'                            => $this->menu->select('id', 'title', 'url', 'main_menu_id')->where('disabled', 0)->where('url', $this->path)->first(),
            'detail'                            => $this->section_header->select('id', 'title', 'title_color', 'menu_id', 'picture', 'picture_name', 'picture_header', 'picture_header_name', 'created_at', 'created_by', 'updated_at', 'updated_by')->where('disabled', 0)->where('id', $id)->first(),
            'app_param'                         => $this->application_parameter->select('title', 'value')->whereIn('id', [5, 6])->get(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 || $data['access']->edit == 0) abort(403);
        
        return view('admin.management.section_header.edit', $data);
    }
    
    public function show($id)
    {
        $data = [
            'c_menu'                            => $this->menu->select('id', 'title', 'url', 'main_menu_id')->where('disabled', 0)->where('url', $this->path)->first(),
            'detail'                            => $this->section_header->select('id', 'title', 'title_color', 'menu_id', 'picture', 'picture_name', 'picture_header', 'picture_header_name', 'created_at', 'created_by', 'updated_at', 'updated_by')->where('disabled', 0)->where('id', $id)->first(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 || $data['access']->detail == 0) abort(403);
        
        return view('admin.management.section_header.show', $data);
    }

    public function update(Request $request, $id)
    {
        $app_param = $this->application_parameter->select('title', 'value')->whereIn('id', [5, 6])->get();

        $validate = $request->validate([
            'title'                             => 'required',
            'picture'                           => $app_param[0]->value.'|'.$app_param[1]->value,
            'picture_header'                    => $app_param[0]->value.'|'.$app_param[1]->value,
        ]);

        $data = [
            'title'                             => $request->title,
            'title_color'                       => $request->title_color,
            'updated_at'                        => now(),
            'updated_by'                        => session()->get('sname').' ('.session()->get('srole').')',
        ];
        
        if ($request->picture) {
            if ($request->old_picture) File::delete(storage_path('app/public/'.$request->old_picture));
            $file = $request->file('picture');
            $extension = $request->picture->getClientOriginalExtension();  // Get Extension
            $fileName = date('Y-m-d H-i-s', strtotime(now())).'_'.$request->title.$request->doctor.session()->get('sid').'.'.$extension;  // Concatenate both to get FileName
            (env('APP_ENV') == 'local') ? $filePath = $file->storeAs('articles/headers/'.session()->get('srole').session()->get('suser_id'), $fileName, 'public')
                : $filePath = $file->storeAs('storage/articles/headers/'.session()->get('srole').session()->get('suser_id'), $fileName, 'public');
            // $file->move(storage_path().'/pictures', $filePath);  
            $data += [
                'picture'                   => $filePath,
                'picture_name'              => $fileName,
            ]; 
        }

        if ($request->picture_header) {
            if ($request->old_picture_header) File::delete(storage_path('app/public/'.$request->old_picture_header));
            $file = $request->file('picture_header');
            $extension = $request->picture_header->getClientOriginalExtension();  // Get Extension
            $fileName = date('Y-m-d H-i-s', strtotime(now())).'_'.$request->title.$request->doctor.session()->get('sid').'.'.$extension;  // Concatenate both to get FileName
            (env('APP_ENV') == 'local') ? $filePath = $file->storeAs('articles/headers/'.session()->get('srole').session()->get('suser_id'), $fileName, 'public')
                : $filePath = $file->storeAs('storage/articles/headers/'.session()->get('srole').session()->get('suser_id'), $fileName, 'public');
            // $file->move(storage_path().'/picture_headers', $filePath);  
            $data += [
                'picture_header'             => $filePath,
                'picture_header_name'        => $fileName,
            ]; 
        }

        $this->section_header->where('id', $id)->update($data);

        return redirect($this->path)->with('status', 'Data Berhasil Diubah.');
    }

    public function destroy($id)
    {
        $data = [
            'disabled'                          => 1,
            'updated_at'                        => now(),
            'updated_by'                        => session()->get('sname').' ('.session()->get('srole').')',
        ];

        if (session()->get('srole') == 'adm') {
            $this->course_detail->where('id', $id)->update($data);
        } else {
            $data += [
                'action'                        => 'delete',
                'course_detail_id'              => $id,
            ];

            $this->section_header->insert($data);
        }

        return redirect($this->path)->with('status', 'Data Berhasil Ditolak.');
    }
}
