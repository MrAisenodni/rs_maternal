<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{ File, Hash };

class CourseDetailDocumentController extends Controller
{
    protected $path = '/admin/course-detail-document';

    public function create($id)
    {
        $data = [
            'course_detail'                     => $this->course_detail->select('id', 'course_header_id', 'title')->where('id', $id)->where('disabled', 0)->first(),
            'c_menu'                            => $this->submenu->select('id', 'title', 'url', 'menu_id')->where('disabled', 0)->where('url', $this->path)->first(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('submenu_id', $data['c_menu']->id)->first();
        if ($data['access']->add == 0) abort(403);

        return view('admin.management.course_detail_document.create', $data);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'title'                             => 'required',
            'document'                          => 'required_with:title_document|max:51400|file',
        ]);
        
        $data = [
            'course_detail_id'                  => $request->id,
            'title'                             => $request->title,
            'description'                       => $request->description,
            'created_at'                        => now(),
            'created_by'                        => session()->get('sname').' ('.session()->get('srole').')',
        ];
        
        if (session()->get('srole') == 'adm') {
            if ($request->document) {
                $file = $request->file('document');
                $extension = $request->document->getClientOriginalExtension();  // Get Extension
                $fileName = date('Y-m-d H-i-s', strtotime(now())).'_'.$request->title.$request->doctor.session()->get('sid').'.'.$extension;  // Concatenate both to get FileName
                (env('APP_ENV') == 'local') ? $filePath = $file->storeAs('documents/'.session()->get('srole').session()->get('suser_id'), $fileName, 'public')
                    : $filePath = $file->storeAs('storage/documents/'.session()->get('srole').session()->get('suser_id'), $fileName, 'public');
                // $file->move(storage_path().'/documents', $filePath);  
                $data += [
                    'file'                      => $filePath,
                    'file_name'                 => $fileName,
                ];
            }

            $this->course_detail_document->insert($data);

            return redirect('/admin/course-detail/'.$request->id.'/edit')->with('status', 'Data Berhasil Ditambahkan.');
        } else {
            $data['action'] = 'add';

            if ($request->document) {
                $file = $request->file('document');
                $extension = $request->document->getClientOriginalExtension();  // Get Extension
                $fileName = date('Y-m-d H-i-s', strtotime(now())).'_'.$request->title.$request->doctor.session()->get('sid').'.'.$extension;  // Concatenate both to get FileName
                (env('APP_ENV') == 'local') ? $filePath = $file->storeAs('documents/'.session()->get('srole').session()->get('suser_id'), $fileName, 'public')
                    : $filePath = $file->storeAs('storage/documents/'.session()->get('srole').session()->get('suser_id'), $fileName, 'public');
                // $file->move(storage_path().'/documents', $filePath);  
                $data += [
                    'file'                      => $filePath,
                    'file_name'                 => $fileName,
                ];
            }

            $this->course_detail_document_approval->insert($data);

            return redirect('/admin/course-detail/'.$request->id.'/edit')->with('status', 'Data yang Ditambahkan Menunggu Approval.');
        }
    }

    public function show($id)
    {
        $data = [
            'c_menu'                            => $this->submenu->select('id', 'title', 'url')->where('disabled', 0)->where('url', $this->path)->first(),
            'detail'                            => $this->course_detail_document->select(
                                                        'trx_course_detail_document.id', 'trx_course_detail_document_approval.id AS approval_id', 'trx_course_detail_document.title', 'trx_course_detail_document.description', 
                                                        'trx_course_detail_document.course_detail_id', 'trx_course_detail_document.file', 'trx_course_detail_document.file_name'
                                                    )->leftJoin('trx_course_detail_document_approval', 'trx_course_detail_document_approval.course_detail_document_id', '=', 'trx_course_detail_document.id')
                                                    ->where('trx_course_detail_document.disabled', 0)->where('trx_course_detail_document.id', $id)->first(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('submenu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 && $data['access']->detail == 0) abort(403);
        
        return view('admin.management.course_detail_document.show', $data);
    }

    public function edit($id)
    {
        $data = [
            'c_menu'                            => $this->submenu->select('id', 'title', 'url')->where('disabled', 0)->where('url', $this->path)->first(),
            'detail'                            => $this->course_detail_document->select('id', 'course_detail_id', 'title', 'file', 'file_name', 'description')->where('id', $id)->where('disabled', 0)->first(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('submenu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 && $data['access']->edit == 0) abort(403);

        return view('admin.management.course_detail_document.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'title'                             => 'required',
            'document'                          => 'required_with:title_document|max:51400|file',
        ]);
        
        $data = [
            'course_detail_id'                  => $request->id,
            'title'                             => $request->title,
            'description'                       => $request->description,
            'updated_at'                        => now(),
            'updated_by'                        => session()->get('sname').' ('.session()->get('srole').')',
        ];

        if (session()->get('srole') == 'adm') {
            if ($request->document) {
                if ($request->old_document) (env('APP_ENV') == 'local') ? File::delete(storage_path('app/public/'.$request->old_document)) 
                    : File::delete(storage_path('app/public/'.$request->old_document));
                $file = $request->file('document');
                $extension = $request->document->getClientOriginalExtension();  // Get Extension
                $fileName = date('Y-m-d H-i-s', strtotime(now())).'_'.$request->title.$request->doctor.session()->get('sid').'.'.$extension;  // Concatenate both to get FileName
                (env('APP_ENV') == 'local') ? $filePath = $file->storeAs('documents/'.session()->get('srole').session()->get('suser_id'), $fileName, 'public')
                    : $filePath = $file->storeAs('storage/documents/'.session()->get('srole').session()->get('suser_id'), $fileName, 'public');
                // $file->move(storage_path().'/documents', $filePath);  
                $data += [
                    'file'                      => $filePath,
                    'file_name'                 => $fileName,
                ]; 
            }
    
            $this->course_detail_document->where('id', $id)->update($data);

            return redirect(url()->previous())->with('status', 'Data Berhasil Diubah.');
        } else {
            $data += [
                'action'                        => 'edit',
                'course_detail_document_id'     => $id,
            ];

            if ($request->document) {
                $file = $request->file('document');
                $extension = $request->document->getClientOriginalExtension();  // Get Extension
                $fileName = date('Y-m-d H-i-s', strtotime(now())).'_'.$request->title.$request->doctor.session()->get('sid').'.'.$extension;  // Concatenate both to get FileName
                (env('APP_ENV') == 'local') ? $filePath = $file->storeAs('documents/'.session()->get('srole').session()->get('suser_id'), $fileName, 'public')
                    : $filePath = $file->storeAs('storage/documents/'.session()->get('srole').session()->get('suser_id'), $fileName, 'public');
                // $file->move(storage_path().'/documents', $filePath);  
                $data += [
                    'file'                      => $filePath,
                    'file_name'                 => $fileName,
                ]; 
            }
            $this->course_detail_document_approval->insert($data);

            return redirect('/admin/course-detail/'.$request->id.'/edit')->with('status', 'Data yang Diubah Menunggu Approval.');
        }
    }

    public function destroy($id)
    {
        $data = [
            'disabled'      => 1,
            'updated_at'    => now(),
            'updated_by'    => session()->get('sname').' ('.session()->get('srole').')',
        ];

        if (session()->get('srole') == 'adm') {
            $this->course_detail_document->where('id', $id)->update($data);

            return redirect(url()->previous())->with('status', 'Data Berhasil Dihapus.');
        } else {
            $check = $this->course_detail_document->where('id', $id)->where('disabled', 0)->first();

            $data += [
                'title'                         => $check->title,
                'description'                   => $check->description,
                'file'                          => $check->file,
                'file_name'                     => $check->file_name,
                'course_detail_id'              => $check->course_detail_id,
                'action'                        => 'delete',
                'course_detail_document_id'     => $id,
            ];

            $this->course_detail_document_approval->insert($data);

            return redirect('/admin/course-detail/'.$check->course_detail_id.'/edit')->with('status', 'Data yang Dihapus Menunggu Approval.');
        }
    }
}
