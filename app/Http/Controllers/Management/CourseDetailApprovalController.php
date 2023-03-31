<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{ File, Hash, Storage };

class CourseDetailApprovalController extends Controller
{
    protected $path         = '/admin/course-detail-approval';

    public function index()
    {
        $data = [
            'c_menu'                            => $this->submenu->select('id', 'title', 'url', 'menu_id')->where('disabled', 0)->where('url', $this->path)->first(),
            'data'                              => $this->course_detail_approval->select('id', 'title', 'course_header_id', 'course_detail_id', 'action', 'created_at', 'created_by', 'updated_at', 'updated_by')->get(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('submenu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0) abort(403);

        return view('admin.management.course_detail_approval.index', $data);
    }

    public function show($id)
    {
        $data['c_menu'] = $this->submenu->select('id', 'title', 'url', 'menu_id')->where('disabled', 0)->where('url', $this->path)->first();
        $check = $this->course_detail_approval->select('action')->where('id', $id)->first();

        ($check->action == 'add') 
            ? $data['detail'] = $this->course_detail_approval->select(
                'id', 'title', 'course_header_id', 'description', 'duration', 'playtime', 'video', 
                'video_name', 'action', 'course_detail_id', 'created_at', 'created_by', 'updated_at', 'updated_by',
                'disabled'
                )->where('id', $id)->first()
            : $data['detail'] = $this->course_detail_approval->select(
                    'id', 'title', 'course_header_id', 'description', 'duration', 'playtime', 'video', 
                    'video_name', 'action', 'course_detail_id', 'created_at', 'created_by', 'updated_at', 'updated_by',
                    'disabled'
                )->where('id', $id)->first();

        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('submenu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 || $data['access']->detail == 0) abort(403);
        
        return view('admin.management.course_detail_approval.show', $data);
    }

    public function update(Request $request, $id)
    {
        $data = [
            'title'                             => $request->title,
            'description'                       => $request->description,
            'duration'                          => $request->duration,
            'playtime'                          => $request->playtime,
            'updated_at'                        => $request->updated_at,
            'updated_by'                        => $request->updated_by,
            'approved_at'                       => now(),
            'approved_by'                       => session()->get('sname').' ('.session()->get('srole').')',
        ];

        if ($request->action == 'edit')
            if ($request->video) {
                if ($request->old_video) File::delete(storage_path('app/public/'.$request->old_video));
                (env('APP_ENV') == 'local') ? File::copy(storage_path().'/app/public/'.$request->video, storage_path().'/app/public/'.str_replace('approval/', '', $request->video))
                    : File::copy(storage_path().'/app/public/storage/'.$request->video, storage_path().'/app/public/storage/'.str_replace('approval/', '', $request->video));
                $data += [
                    'video'                   => str_replace('approval/', '', $request->video),
                    'video_name'              => $request->video_name,
                ];
                if ($request->video) File::delete(storage_path('app/public/'.$request->video));
            }

        if ($request->action == 'add') {
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

            $detail_id = $this->course_detail_approval->insertGetId($data);
            $this->course_detail_approval_approval->where('id', $request->course_detail_approval_id)->delete();
        } else {
            $this->course_detail->where('id', $request->course_detail_id)->update($data);
            $this->course_detail_approval->where('id', $id)->delete();
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
            $this->course_detail->where('id', $id)->update($data);
        } else {
            $data += [
                'action'                        => 'delete',
                'course_detail_id'              => $id,
            ];

            $this->course_detail_approval->insert($data);
        }

        return redirect($this->path)->with('status', 'Data Berhasil Ditolak.');
    }
}
