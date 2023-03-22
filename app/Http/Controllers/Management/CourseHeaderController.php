<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{ File, Hash };

class CourseHeaderController extends Controller
{
    protected $path = '/admin/course-header';

    public function index()
    {
        $data = [
            'c_menu'    => $this->submenu->select('id', 'title', 'url', 'menu_id')->where('disabled', 0)->where('url', $this->path)->first(),
            'data'      => $this->course_header->select('id', 'title', 'picture', 'picture_name', 'rating', 'category_id', 'level_id', 'description')->where('disabled', 0)->get(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('submenu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0) abort(403);

        return view('admin.management.course_header.index', $data);
    }

    public function create()
    {
        $data = [
            'c_menu'        => $this->submenu->select('id', 'title', 'url', 'menu_id')->where('disabled', 0)->where('url', $this->path)->first(),
            'categories'    => $this->category->select('id', 'name')->where('disabled', 0)->get(),
            'levels'        => $this->level->select('id', 'name')->where('disabled', 0)->get(),
            'doctors'       => $this->user->select('id', 'nik', 'full_name')->where('disabled', 0)->where('role', 'tec')->get(),
            'doctor'        => $this->user->select('id', 'nik', 'full_name')->where('disabled', 0)->where('id', session()->get('suser_id'))->first(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('submenu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 || $data['access']->add == 0) abort(403);

        return view('admin.management.course_header.create', $data);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'title'                             => 'required',
            'category'                          => 'required',
            'doctor'                            => 'required',
            'document'                          => 'required_with:title_document|max:5140|file',
            'level'                             => 'required',
            'picture'                           => 'required|max:5140|file|mimes:png,jpg,jpeg',
            'title_detail'                      => 'required',
            'title_document'                    => 'required_with:document',
            'video'                             => 'required|max:257000|file|mimes:mp4,mkv',
        ]);
        
        $data = [
            'title'                             => $request->title,
            'course_teacher_id'                 => $request->doctor,
            'category_id'                       => $request->category,
            'level_id'                          => $request->level,
            'description'                       => $request->description,
            'created_at'                        => now(),
            'created_by'                        => session()->get('suser_id'),
        ];
        
        if (session()->get('srole') == 'adm') {
            // if ($request->picture) {
            //     $file = $request->file('picture');
            //     $extension = $request->picture->getClientOriginalExtension();  // Get Extension
            //     $fileName =  date('Y-m-d H-i-s', strtotime(now())).'_'.$request->title.'_'.$request->doctor.'.'.$extension;  // Concatenate both to get FileName
            //     $filePath = $file->storeAs('pictures/'.session()->get('srole').'_'.session()->get('suser_id'), $fileName, 'public');
            //     // $file->move(storage_path().'/', $filePath);  
            //     $data += [
            //         'picture'                       => $filePath,
            //         'picture_name'                  => $fileName,
            //     ]; 
            // }
            if ($request->picture) {
                $file = $request->file('picture');
                $extension = $request->picture->getClientOriginalExtension();  // Get Extension
                $fileName =  date('Y-m-d H-i-s', strtotime(now())).'_'.$request->title.'_'.$request->doctor.'.'.$extension;  // Concatenate both to get FileName
                $filePath = $file->storeAs('pictures/'.Hash::make(session()->get('srole').session()->get('suser_id')), $fileName, 'public');
                // $file->move(storage_path().'/', $filePath);  
                $data += [
                    'picture'                       => $filePath,
                    'picture_name'                  => $fileName,
                ]; 
            }
    
            $header_id = $this->course_header->insertGetId($data);
    
            $data = [
                'title'                             => $request->title_detail,
                'course_header_id'                  => $header_id,
                'description'                       => $request->description_detail,
                'created_at'                        => now(),
                'created_by'                        => session()->get('suser_id'),
            ];
    
            // if ($request->video) {
            //     $file = $request->file('video');
            //     $extension = $request->video->getClientOriginalExtension();  // Get Extension
            //     $fileName =  date('Y-m-d H-i-s', strtotime(now())).'_'.$request->title.'_'.$request->doctor.'.'.$extension;  // Concatenate both to get FileName
            //     $filePath = $file->storeAs('videos/'.session()->get('srole').'_'.session()->get('suser_id'), $fileName, 'public');
            //     // $file->move(storage_path().'/videos', $filePath);  
            //     $data += [
            //         'video'                         => $filePath,
            //         'video_name'                    => $fileName,
            //     ]; 
            // }
            if ($request->video) {
                $file = $request->file('video');
                $extension = $request->video->getClientOriginalExtension();  // Get Extension
                $fileName =  date('Y-m-d H-i-s', strtotime(now())).'_'.$request->title.'_'.$request->doctor.'.'.$extension;  // Concatenate both to get FileName
                $filePath = $file->storeAs('videos/'.Hash::make(session()->get('srole').session()->get('suser_id')), $fileName, 'public');
                // $file->move(storage_path().'/videos', $filePath);  
                $data += [
                    'video'                         => $filePath,
                    'video_name'                    => $fileName,
                ]; 
            }
    
            $detail_id = $this->course_detail->insertGetId($data);
    
            $data = [
                'title'                             => $request->title_document,
                'course_detail_id'                  => $detail_id,
                'description'                       => $request->description_document,
                'created_at'                        => now(),
                'created_by'                        => session()->get('suser_id'),
            ];
    
            if ($request->title_document && $request->document) {
                if ($request->document) {
                    if ($request->old_document) File::delete(storage_path('app/public/'.$request->old_document));
                    $file = $request->file('document');
                    $extension = $request->document->getClientOriginalExtension();  // Get Extension
                    $fileName =  date('Y-m-d H-i-s', strtotime(now())).'_'.$request->title.'_'.$request->doctor.'.'.$extension;  // Concatenate both to get FileName
                    $filePath = $file->storeAs('documents/'.session()->get('srole').'_'.session()->get('suser_id'), $fileName, 'public');
                    // $file->move(storage_path().'/documents', $filePath);  
                    $data += [
                        'file'                          => $filePath,
                        'file_name'                     => $fileName,
                    ]; 
                }
        
                $this->course_detail_document->insert($data);
            }
        } else {

        }

        return redirect($this->path.'/'.$header_id.'/edit')->with('status', 'Data Berhasil Ditambahkan.');
    }

    public function show($id)
    {
        $data = [
            'c_menu'        => $this->menu->select('id', 'title', 'url')->where('disabled', 0)->where('url', $this->path)->first(),
            'data'          => $this->course_detail->select('id', 'title', 'description')->where('disabled', 0)->where('course_header_id', $id)->get(),
            'detail'        => $this->course_header->select('id', 'title', 'course_teacher_id', 'category_id', 'level_id', 'description', 'duration', 'picture', 'picture_name')->where('id', $id)->where('disabled', 0)->first(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('submenu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 || $data['access']->detail == 0) abort(403);
        
        return view('admin.management.course_header.show', $data);
    }

    public function edit($id)
    {
        $data = [
            'c_menu'        => $this->submenu->select('id', 'title', 'url', 'menu_id')->where('disabled', 0)->where('url', $this->path)->first(),
            'categories'    => $this->category->select('id', 'name')->where('disabled', 0)->get(),
            'data'          => $this->course_detail->select('id', 'title', 'description')->where('disabled', 0)->where('course_header_id', $id)->get(),
            'levels'        => $this->level->select('id', 'name')->where('disabled', 0)->get(),
            'detail'        => $this->course_header->select('id', 'title', 'course_teacher_id', 'category_id', 'level_id', 'description', 'duration', 'picture', 'picture_name')->where('id', $id)->where('disabled', 0)->first(),
            'doctors'       => $this->user->select('id', 'nik', 'full_name')->where('disabled', 0)->where('role', 'tec')->get(),
            'doctor'        => $this->user->select('id', 'nik', 'full_name')->where('disabled', 0)->where('id', session()->get('suser_id'))->first(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('submenu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 || $data['access']->edit == 0) abort(403);

        return view('admin.management.course_header.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'title'             => 'required',
            'category'          => 'required',
            'level'             => 'required',
            'picture'           => 'required|max:5140|file|mimes:png,jpg,jpeg',
        ]);
        
        $data = [
            'title'                             => $request->title,
            'course_teacher_id'                 => $request->doctor,
            'category_id'                       => $request->category,
            'level_id'                          => $request->level,
            'description'                       => $request->description,
            'updated_at'                        => now(),
            'updated_by'                        => session()->get('suser_id'),
        ];

        if (session()->get('srole') == 'adm') {
            if ($request->picture) {
                if ($request->old_picture) File::delete(storage_path('app/public/'.$request->old_picture));
                $file = $request->file('picture');
                $extension = $request->picture->getClientOriginalExtension();  // Get Extension
                $fileName =  date('Y-m-d H-i-s', strtotime(now())).'_'.$request->title.'_'.$request->doctor.'.'.$extension;  // Concatenate both to get FileName
                $filePath = $file->storeAs('pictures/'.session()->get('srole').'_'.session()->get('suser_id'), $fileName, 'public');
                // $file->move(storage_path().'/pictures', $filePath);  
                $data += [
                    'picture'                       => $filePath,
                    'picture_name'                  => $fileName,
                ]; 
            }
    
            $this->course_header->where('id', $id)->update($data);
        } else {
            $data += [
                'action'                        => 'edit',
                'course_header_id'              => $id,
            ];

            if ($request->picture) {
                if ($request->old_picture) File::delete(storage_path('app/public/'.$request->old_picture));
                $file = $request->file('picture');
                $extension = $request->picture->getClientOriginalExtension();  // Get Extension
                $fileName =  date('Y-m-d H-i-s', strtotime(now())).'_'.$request->title.'_'.$request->doctor.'.'.$extension;  // Concatenate both to get FileName
                $filePath = $file->storeAs('pictures/'.session()->get('srole').'_'.session()->get('suser_id'), $fileName, 'public');
                // $file->move(storage_path().'/pictures', $filePath);  
                $data += [
                    'picture'                       => $filePath,
                    'picture_name'                  => $fileName,
                ]; 
            }
    
            $this->course_header_approval->where('id', $id)->update($data);
        }

        return redirect($this->path.'/'.$id.'/edit')->with('status', 'Data Berhasil Diubah.');
    }

    public function destroy($id)
    {
        $data = [
            'disabled'      => 1,
            'updated_at'    => now(),
            'updated_by'    => session()->get('suser_id'),
        ];

        if (session()->get('srole') == 'adm') {
            $this->course_header->where('id', $id)->update($data);
        } else {
            $data += [
                'action'                        => 'delete',
                'course_header_id'              => $id,
            ];

            $this->course_header_approval->where('id', $id)->update($data);
        }

        return redirect($this->path)->with('status', 'Data Berhasil Dihapus.');
    }
}
