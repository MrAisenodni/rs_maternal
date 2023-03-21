<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CourseDetailDocumentController extends Controller
{
    protected $path = '/admin/course-detail_document';

    public function create($id)
    {
        $data = [
            'id'            => $id,
            'c_menu'        => $this->menu->select('id', 'title', 'url')->where('disabled', 0)->where('url', $this->path)->first(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 || $data['access']->add == 0) abort(403);

        return view('admin.management.course_detail_document.create', $data);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'title'             => 'required',
            'document'             => 'required',
        ]);
        
        $data = [
            'course_detail_id'                  => $request->id,
            'title'                             => $request->title,
            'description'                       => $request->description,
            'created_at'                        => now(),
            'created_by'                        => session()->get('suser_id'),
        ];
        
        if ($request->document) {
            $file = $request->file('document');
            $extension = $request->document->getClientOriginalExtension();  // Get Extension
            $fileName =  date('Y-m-d H-i-s', strtotime(now())).'_'.$request->id.'-'.$request->title.'.'.$extension;  // Concatenate both to get FileName
            $filePath = $file->storeAs('/courses/documents', $fileName, 'public');  
            $file->move(public_path().'/courses/documents', $filePath);  
            $data += [
                'file'                          => '/'.$filePath,
                'file_name'                     => $fileName,
            ]; 
        }

        $this->course_detail_document->insert($data);

        return redirect('/admin/course-detail/'.$request->id.'/edit')->with('status', 'Data Berhasil Ditambahkan.');
    }

    public function show($id)
    {
        $data = [
            'c_menu'        => $this->menu->select('id', 'title', 'url')->where('disabled', 0)->where('url', $this->path)->first(),
            'detail'        => $this->course_detail_document->select('id', 'course_detail_id', 'title', 'file', 'file_name', 'description')->where('id', $id)->where('disabled', 0)->first(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 || $data['access']->detail == 0) abort(403);
        
        return view('admin.management.course_detail_document.show', $data);
    }

    public function edit($id)
    {
        $data = [
            'c_menu'        => $this->menu->select('id', 'title', 'url')->where('disabled', 0)->where('url', $this->path)->first(),
            'detail'        => $this->course_detail_document->select('id', 'course_detail_id', 'title', 'file', 'file_name', 'description')->where('id', $id)->where('disabled', 0)->first(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 || $data['access']->edit == 0) abort(403);

        return view('admin.management.course_detail_document.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'title'             => 'required',
        ]);
        
        $data = [
            'course_detail_id'                  => $request->id,
            'title'                             => $request->title,
            'description'                       => $request->description,
            'created_at'                        => now(),
            'created_by'                        => session()->get('suser_id'),
        ];
        
        if ($request->document) {
            if ($request->old_document) File::delete(public_path().$request->old_document);
            $file = $request->file('document');
            $extension = $request->document->getClientOriginalExtension();  // Get Extension
            $fileName =  date('Y-m-d H-i-s', strtotime(now())).'_'.$request->id.'-'.$request->title.'.'.$extension;  // Concatenate both to get FileName
            $filePath = $file->storeAs('/courses/documents', $fileName, 'public');  
            $file->move(public_path().'/courses/documents', $filePath);  
            $data += [
                'file'                          => '/'.$filePath,
                'file_name'                     => $fileName,
            ]; 
        }

        $this->course_detail_document->where('id', $id)->update($data);

        return redirect('/admin/course-detail/'.$request->id.'/edit')->with('status', 'Data Berhasil Diubah.');
        // return redirect(url()->previous())->with('status', 'Data Berhasil Diubah.');
    }

    public function destroy($id)
    {
        $data = [
            'disabled'      => 1,
            'updated_at'    => now(),
            'updated_by'    => session()->get('suser_id'),
        ];

        $this->course_detail_document->where('id', $id)->update($data);

        return redirect(url()->previous())->with('status', 'Data Berhasil Dihapus.');
    }
}
