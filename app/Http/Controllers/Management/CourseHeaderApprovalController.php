<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{ File, Hash, Storage };

class CourseHeaderApprovalController extends Controller
{
    protected $path         = '/admin/course-header-approval';

    public function index()
    {
        $data = [
            'c_menu'                            => $this->submenu->select('id', 'title', 'url', 'menu_id')->where('disabled', 0)->where('url', $this->path)->first(),
            'data'                              => $this->course_header_approval->select('id', 'title', 'course_header_id', 'category_id', 'level_id', 'action', 'created_at', 'created_by', 'updated_at', 'updated_by')->get(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('submenu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0) abort(403);

        return view('admin.management.course_header_approval.index', $data);
    }

    public function show($id)
    {
        $data['c_menu'] = $this->submenu->select('id', 'title', 'url', 'menu_id')->where('disabled', 0)->where('url', $this->path)->first();
        $check = $this->course_header_approval->select('action')->where('id', $id)->first();

        ($check->action == 'add') 
            ? $data['detail'] = $this->course_header_approval->select(
                    // Course Header Approval
                    'trx_course_header_approval.id', 'trx_course_header_approval.title', 'trx_course_header_approval.course_teacher_id', 
                    'trx_course_header_approval.category_id', 'trx_course_header_approval.level_id', 'trx_course_header_approval.description',
                    'trx_course_header_approval.duration', 'trx_course_header_approval.picture', 'trx_course_header_approval.picture_name',
                    'trx_course_header_approval.action', 'trx_course_header_approval.course_header_id', 
                    'trx_course_header_approval.created_by', 'trx_course_header_approval.created_at',
                    // Course Detail Approval
                    'trx_course_detail_approval.id AS course_detail_approval_id', 'trx_course_detail_approval.title AS course_detail_title', 
                    'trx_course_detail_approval.description AS course_detail_description', 'trx_course_detail_approval.video', 
                    'trx_course_detail_approval.video_name', 'trx_course_detail_approval.playtime', 
                    'trx_course_detail_approval.duration AS course_detail_duration', 'trx_course_detail_approval.action',
                    'trx_course_detail_approval.course_detail_id',
                    // Course Detail Document Approval
                    'trx_course_detail_document_approval.id AS course_detail_document_approval_id', 
                    'trx_course_detail_document_approval.title AS course_detail_document_title', 
                    'trx_course_detail_document_approval.description AS course_detail_document_description', 
                    'trx_course_detail_document_approval.file', 'trx_course_detail_document_approval.file_name',
                    'trx_course_detail_document_approval.action',
                    'trx_course_detail_document_approval.course_detail_document_id'
                )->join('trx_course_detail_approval', 'trx_course_detail_approval.course_header_id', '=', 'trx_course_header_approval.id')
                ->join('trx_course_detail_document_approval', 'trx_course_detail_document_approval.course_detail_id', '=', 'trx_course_detail_approval.id')
                ->where('trx_course_header_approval.id', $id)->first()
            : $data['detail'] = $this->course_header_approval->select(
                    'id', 'title', 'course_teacher_id', 'category_id', 'level_id', 'description', 'duration', 'picture', 
                    'picture_name', 'action', 'course_header_id', 'created_at', 'created_by', 'updated_at', 'updated_by',
                    'disabled'
                )->where('id', $id)->first();

        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('submenu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 || $data['access']->detail == 0) abort(403);
        
        return view('admin.management.course_header_approval.show', $data);
    }

    public function update(Request $request, $id)
    {
        $data = [
            'title'                             => $request->title,
            'course_teacher_id'                 => $request->doctor,
            'category_id'                       => $request->category,
            'level_id'                          => $request->level,
            'description'                       => $request->description,
            'disabled'                          => $request->disabled,
            'updated_at'                        => $request->updated_at,
            'updated_by'                        => $request->updated_by,
            'approved_at'                       => now(),
            'approved_by'                       => session()->get('sname').' ('.session()->get('srole').')',
        ];

        if ($request->action == 'edit')
            if ($request->picture) {
                if ($request->old_picture) File::delete(storage_path('app/public/'.$request->old_picture));
                (env('APP_ENV') == 'local') ? File::copy(storage_path().'/app/public/'.$request->picture, storage_path().'/app/public/'.str_replace('approval/', '', $request->picture))
                    : File::copy(storage_path().'/app/public/storage/'.$request->picture, storage_path().'/app/public/storage/'.str_replace('approval/', '', $request->picture));
                $data += [
                    'picture'                   => str_replace('approval/', '', $request->picture),
                    'picture_name'              => $request->picture_name,
                ];
                if ($request->picture) File::delete(storage_path('app/public/'.$request->picture));
            }

        if ($request->action == 'add') {
            $data = [
                'title'                             => $request->title,
                'course_teacher_id'                 => $request->doctor,
                'category_id'                       => $request->category,
                'level_id'                          => $request->level,
                'description'                       => $request->description,
                'duration'                          => $request->course_detail_duration,
                'picture'                           => $request->picture,
                'picture_name'                      => $request->picture_name,
                'created_at'                        => $request->created_at,
                'created_by'                        => $request->created_by,
                'approved_at'                       => now(),
                'approved_by'                       => session()->get('sname').' ('.session()->get('srole').')',
            ];

            $header_id = $this->course_header->insertGetId($data);
            $this->course_header_approval->where('id', $id)->delete();

            $data = [
                'title'                             => $request->course_detail_title,
                'course_header_id'                  => $header_id,
                'description'                       => $request->course_detail_description,
                'duration'                          => $request->course_detail_duration,
                'playtime'                          => $request->playtime,
                'video'                             => $request->video,
                'video_name'                        => $request->video_name,
                'created_at'                        => $request->created_at,
                'created_by'                        => $request->created_by,
                'approved_at'                       => now(),
                'approved_by'                       => session()->get('sname').' ('.session()->get('srole').')',
            ];

            $detail_id = $this->course_detail->insertGetId($data);
            $this->course_detail_approval->where('id', $request->course_detail_approval_id)->delete();

            $data = [
                'title'                             => $request->course_detail_document_title,
                'course_detail_id'                  => $detail_id,
                'description'                       => $request->course_detail_document_description,
                'file'                              => $request->file,
                'file_name'                         => $request->file_name,
                'created_at'                        => $request->created_at,
                'created_by'                        => $request->created_by,
                'approved_at'                       => now(),
                'approved_by'                       => session()->get('sname').' ('.session()->get('srole').')',
            ];

            $this->course_detail_document->insert($data);
            $this->course_detail_document_approval->where('id', $request->course_detail_document_approval_id)->delete();
        } else {
            $this->course_header->where('id', $request->course_header_id)->update($data);
            $this->course_header_approval->where('id', $id)->delete();
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
            $this->course_header->where('id', $id)->update($data);
        } else {
            $data += [
                'action'                        => 'delete',
                'course_header_id'              => $id,
            ];

            $this->course_header_approval->insert($data);
        }

        return redirect($this->path)->with('status', 'Data Berhasil Dihapus.');
    }
}
