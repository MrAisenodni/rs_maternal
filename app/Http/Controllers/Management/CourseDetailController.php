<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CourseDetailController extends Controller
{
    protected $path = '/admin/course-detail';

    public function create($id)
    {
        $data = [
            'id'            => $id,
            'c_menu'        => $this->submenu->select('id', 'title', 'url', 'menu_id')->where('disabled', 0)->where('url', $this->path)->first(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('submenu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 || $data['access']->add == 0) abort(403);

        return view('admin.management.course_detail.create', $data);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'title'                             => 'required',
            'video'                             => 'required|max:257000|file|mimes:mp4,mkv',
        ]);
        
        $data = [
            'course_header_id'                  => $request->id,
            'title'                             => $request->title,
            'description'                       => $request->description,
            'created_at'                        => now(),
            'created_by'                        => session()->get('suser_id'),
        ];
        
        if (session()->get('srole') == 'adm') {
            if ($request->video) {
                $file = $request->file('video');
                $extension = $request->video->getClientOriginalExtension();  // Get Extension
                $fileName =  date('Y-m-d H-i-s', strtotime(now())).'_'.$request->title.'_'.$request->doctor.'.'.$extension;  // Concatenate both to get FileName
                $filePath = $file->storeAs('videos', $fileName, 'public');
                // $file->move(storage_path().'/videos', $filePath);  
                $data += [
                    'video'                         => $filePath,
                    'video_name'                    => $fileName,
                ]; 
            }
        } else {
        }

        $this->course_detail->insert($data);

        return redirect('/admin/course-header/'.$request->id.'/edit')->with('status', 'Data Berhasil Ditambahkan.');
    }

    public function show($id)
    {
        $data = [
            'c_menu'        => $this->menu->select('id', 'title', 'url')->where('disabled', 0)->where('url', $this->path)->first(),
            'detail'        => $this->course_detail->select('id', 'course_header_id', 'title', 'video', 'description')->where('id', $id)->where('disabled', 0)->first(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 || $data['access']->detail == 0) abort(403);
        
        return view('admin.management.course_detail.show', $data);
    }

    public function edit($id)
    {

        $data = [
            'c_menu'        => $this->submenu->select('id', 'title', 'url', 'menu_id')->where('disabled', 0)->where('url', $this->path)->first(),
            'detail'        => $this->course_detail->select('id', 'course_header_id', 'title', 'video', 'description')->where('id', $id)->where('disabled', 0)->first(),
        ];
        $data += [
            'data'          => $this->course_detail_document->select('id', 'title', 'description')->where('disabled', 0)->where('course_detail_id', $data['detail']->id)->get(),
            'access'        => $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
                                    ->where('role', session()->get('srole'))->where('submenu_id', $data['c_menu']->id)->first(),
        ];
        if ($data['access']->view == 0 || $data['access']->edit == 0) abort(403);

        return view('admin.management.course_detail.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'title'                             => 'required',
            'video'                             => 'max:257000|file|mimes:mp4,mkv',
        ]);
        
        $data = [
            'course_header_id'                  => $request->id,
            'title'                             => $request->title,
            'description'                       => $request->description,
            'created_at'                        => now(),
            'created_by'                        => session()->get('suser_id'),
        ];
        
        if (session()->get('srole') == 'adm') {
            if ($request->video) {
                if ($request->old_video) File::delete(storage_path('app/public/'.$request->old_video));
                $file = $request->file('video');
                $extension = $request->video->getClientOriginalExtension();  // Get Extension
                $fileName =  date('Y-m-d H-i-s', strtotime(now())).'_'.$request->title.'_'.$request->doctor.'.'.$extension;  // Concatenate both to get FileName
                $filePath = $file->storeAs('videos', $fileName, 'public');
                // $file->move(storage_path().'/videos', $filePath);  
                $data += [
                    'video'                         => $filePath,
                    'video_name'                    => $fileName,
                ]; 
            }
    
            $this->course_detail->where('id', $id)->update($data);
        } else {

        }

        return redirect(url()->previous())->with('status', 'Data Berhasil Diubah.');
    }

    public function destroy($id)
    {
        $data = [
            'disabled'      => 1,
            'updated_at'    => now(),
            'updated_by'    => session()->get('suser_id'),
        ];

        $this->course_detail->where('id', $id)->update($data);

        return redirect(url()->previous())->with('status', 'Data Berhasil Dihapus.');
    }
}
