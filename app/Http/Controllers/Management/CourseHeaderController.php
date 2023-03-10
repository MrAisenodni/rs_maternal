<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CourseHeaderController extends Controller
{
    protected $path = '/admin/course_header';

    public function index()
    {
        $data = [
            'c_menu'    => $this->menu->select('id', 'title', 'url')->where('disabled', 0)->where('url', $this->path)->first(),
            'data'      => $this->course_header->select('id', 'title', 'picture', 'rating', 'category_id', 'level_id', 'description')->where('disabled', 0)->get(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0) abort(403);

        return view('admin.management.course_header.index', $data);
    }

    public function create()
    {
        $data = [
            'c_menu'        => $this->menu->select('id', 'title', 'url')->where('disabled', 0)->where('url', $this->path)->first(),
            'categories'    => $this->category->select('id', 'name')->where('disabled', 0)->get(),
            'levels'        => $this->level->select('id', 'name')->where('disabled', 0)->get(),
            'doctors'       => $this->user->select('id', 'nik', 'full_name')->where('disabled', 0)->where('role', 'tec')->get(),
            'doctor'        => $this->user->select('id', 'nik', 'full_name')->where('disabled', 0)->where('id', session()->get('suser_id'))->first(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 || $data['access']->add == 0) abort(403);

        return view('admin.management.course_header.create', $data);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'title'             => 'required',
            'category'          => 'required',
            'level'             => 'required',
            'picture'           => 'required',
        ]);
        
        $data = [
            'title'                             => $request->title,
            'course_detail_teacher_id'          => $request->doctor,
            'category_id'                       => $request->category,
            'level_id'                          => $request->level,
            'description'                       => $request->description,
            'created_at'                        => now(),
            'created_by'                        => session()->get('user_id'),
        ];
        
        if ($request->picture) {
            $file = $request->file('picture');
            $extension = $request->picture->getClientOriginalExtension();  // Get Extension
            $fileName =  date('Y-m-d H-i-s', strtotime(now())).'_'.$request->title.'_'.$request->doctor.'.'.$extension;  // Concatenate both to get FileName
            $filePath = $file->storeAs('/courses/pictures', $fileName, 'public');  
            $file->move(public_path().'/courses/pictures', $filePath);  
            $data += [
                'picture'       => '/'.$filePath,
            ]; 
        }

        $id = $this->course_header->insertGetId($data);

        return redirect($this->path.'/'.$id.'/edit')->with('status', 'Data Berhasil Ditambahkan.');
    }

    public function show($id)
    {
        $data = [
            'c_menu'        => $this->menu->select('id', 'title', 'url')->where('disabled', 0)->where('url', $this->path)->first(),
            'data'          => $this->course_detail->select('id', 'title', 'description')->where('disabled', 0)->where('course_header_id', $id)->get(),
            'detail'        => $this->course_header->select('id', 'title', 'course_detail_teacher_id', 'category_id', 'level_id', 'description', 'duration', 'picture')->where('id', $id)->where('disabled', 0)->first(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 || $data['access']->detail == 0) abort(403);
        
        return view('admin.management.course_header.show', $data);
    }

    public function edit($id)
    {
        $data = [
            'c_menu'        => $this->menu->select('id', 'title', 'url')->where('disabled', 0)->where('url', $this->path)->first(),
            'categories'    => $this->category->select('id', 'name')->where('disabled', 0)->get(),
            'data'          => $this->course_detail->select('id', 'title', 'description')->where('disabled', 0)->where('course_header_id', $id)->get(),
            'levels'        => $this->level->select('id', 'name')->where('disabled', 0)->get(),
            'detail'        => $this->course_header->select('id', 'title', 'course_detail_teacher_id', 'category_id', 'level_id', 'description', 'duration', 'picture')->where('id', $id)->where('disabled', 0)->first(),
            'doctors'       => $this->user->select('id', 'nik', 'full_name')->where('disabled', 0)->where('role', 'tec')->get(),
            'doctor'        => $this->user->select('id', 'nik', 'full_name')->where('disabled', 0)->where('id', session()->get('suser_id'))->first(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 || $data['access']->edit == 0) abort(403);

        return view('admin.management.course_header.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'title'             => 'required',
            'category'          => 'required',
            'level'             => 'required',
            'picture'           => 'required',
        ]);
        
        $data = [
            'title'                             => $request->title,
            'course_detail_teacher_id'          => $request->doctor,
            'category_id'                       => $request->category,
            'level_id'                          => $request->level,
            'description'                       => $request->description,
            'updated_at'                        => now(),
            'updated_by'                        => session()->get('user_id'),
        ];
        
        if ($request->picture) {
            if ($request->old_picture) File::delete(public_path().$request->old_picture);
            $file = $request->file('picture');
            $extension = $request->picture->getClientOriginalExtension();  // Get Extension
            $fileName =  date('Y-m-d H-i-s', strtotime(now())).'_'.$request->title.'_'.$request->doctor.'.'.$extension;  // Concatenate both to get FileName
            $filePath = $file->storeAs('/courses/pictures', $fileName, 'public');  
            $file->move(public_path().'/courses/pictures', $filePath);  
            $data += [
                'picture'       => '/'.$filePath,
            ]; 
        }

        $this->course_header->where('id', $id)->update($data);

        return redirect($this->path.'/'.$id.'/edit')->with('status', 'Data Berhasil Diubah.');
    }

    public function destroy($id)
    {
        $data = [
            'disabled'      => 1,
            'updated_at'    => now(),
            'updated_by'    => session()->get('user_id'),
        ];

        $this->course_header->where('id', $id)->update($data);

        return redirect($this->path)->with('status', 'Data Berhasil Dihapus.');
    }
}
