<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{ File, Hash, Storage };

class CourseDetailDocumentApprovalController extends Controller
{
    protected $path         = '/admin/course-detail-document-approval';

    public function index()
    {
        $data = [
            'c_menu'                            => $this->submenu->select('id', 'title', 'url', 'menu_id')->where('disabled', 0)->where('url', $this->path)->first(),
            'data'                              => $this->course_detail_document_approval->select('id', 'title', 'course_detail_id', 'course_detail_document_id', 'action', 'created_at', 'created_by', 'updated_at', 'updated_by')->get(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('submenu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0) abort(403);

        return view('admin.management.course_detail_document_approval.index', $data);
    }

    public function show($id)
    {
        $data['c_menu'] = $this->submenu->select('id', 'title', 'url', 'menu_id')->where('disabled', 0)->where('url', $this->path)->first();
        $check = $this->course_detail_document_approval->select('action')->where('id', $id)->first();

        ($check->action == 'add') 
            ? $data['detail'] = $this->course_detail_document_approval->select(
                'id', 'title', 'course_detail_id', 'description', 'file',
                'file_name', 'action', 'course_detail_document_id', 'created_at', 'created_by', 'updated_at', 'updated_by',
                'disabled'
                )->where('id', $id)->first()
            : $data['detail'] = $this->course_detail_document_approval->select(
                    'id', 'title', 'course_detail_id', 'description', 'file',
                    'file_name', 'action', 'course_detail_document_id', 'created_at', 'created_by', 'updated_at', 'updated_by',
                    'disabled'
                )->where('id', $id)->first();

        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('submenu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 || $data['access']->detail == 0) abort(403);
        
        return view('admin.management.course_detail_document_approval.show', $data);
    }

    public function update(Request $request, $id)
    {
        $data = [
            'title'                             => $request->title,
            'description'                       => $request->description,
            'updated_at'                        => $request->updated_at,
            'updated_by'                        => $request->updated_by,
            'disabled'                          => $request->disabled,
            'approved_at'                       => now(),
            'approved_by'                       => session()->get('sname').' ('.session()->get('srole').')',
        ];

        if ($request->action == 'edit')
            if ($request->document) {
                if ($request->document) File::delete(storage_path('app/public/'.$request->document));
                (env('APP_ENV') == 'local') ? File::copy(storage_path().'/app/public/'.$request->document, storage_path().'/app/public/'.str_replace('approval/', '', $request->document))
                    : File::copy(storage_path().'/app/public/storage/'.$request->document, storage_path().'/app/public/storage/'.str_replace('approval/', '', $request->document));
                $data += [
                    'file'                      => str_replace('approval/', '', $request->document),
                    'file_name'                 => $request->document_name,
                ];
                if ($request->document) File::delete(storage_path('app/public/'.$request->document));
            }

        if ($request->action == 'add') {
            $data = [
                'title'                             => $request->title,
                'course_detail_id'                  => $request->course_detail_id,
                'description'                       => $request->description,
                'file'                              => $request->file,
                'file_name'                         => $request->file_name,
                'created_at'                        => $request->created_at,
                'created_by'                        => $request->created_by,
                'approved_at'                       => now(),
                'approved_by'                       => session()->get('sname').' ('.session()->get('srole').')',
            ];

            $detail_id = $this->course_detail_document->insertGetId($data);
            $this->course_detail_document_approval->where('id', $id)->delete();
        } else {
            $this->course_detail_document->where('id', $request->course_detail_document_id)->update($data);

            $this->course_detail_document_approval->where('id', $id)->delete();
        }

        return redirect($this->path)->with('status', 'Data Berhasil Disetujui.');
    }

    public function destroy($id)
    {
        $data = [
            'disabled'                          => 1,
            'updated_at'                        => now(),
            'updated_by'                        => session()->get('sname').' ('.session()->get('srole').')',
        ];

        if (session()->get('srole') == 'adm') {
            $this->course_detail_document->where('id', $id)->update($data);
        } else {
            $data += [
                'action'                        => 'delete',
                'course_detail_document_id'     => $id,
            ];

            $this->course_detail_document_approval->insert($data);
        }

        return redirect($this->path)->with('status', 'Data Berhasil Ditolak.');
    }
}
