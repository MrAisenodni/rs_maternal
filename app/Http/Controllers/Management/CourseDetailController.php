<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{ File, Hash };

class CourseDetailController extends Controller
{
    protected $path = '/admin/course-detail';

    public function create($id)
    {
        $data = [
            'id'                                => $id,
            'c_menu'                            => $this->submenu->select('id', 'title', 'url', 'menu_id')->where('disabled', 0)->where('url', $this->path)->first(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('submenu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 && $data['access']->add == 0) abort(403);

        return view('admin.management.course_detail.create', $data);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'title'                             => 'required',
            'video'                             => 'required|max:514000|file|mimes:mp4,mkv',
        ]);
        
        $data = [
            'course_header_id'                  => $request->id,
            'title'                             => $request->title,
            'description'                       => $request->description,
            'created_at'                        => now(),
            'created_by'                        => session()->get('sname').' ('.session()->get('srole').')',
        ];
        
        if (session()->get('srole') == 'adm') {
            if ($request->video) {
                $file = $request->file('video');
                $extension = $request->video->getClientOriginalExtension();  // Get Extension
                $fileName = date('Y-m-d H-i-s', strtotime(now())).'_'.$request->title.$request->doctor.session()->get('sid').'.'.$extension;  // Concatenate both to get FileName
                (env('APP_ENV') == 'local') ? $filePath = $file->storeAs('videos/'.session()->get('srole').session()->get('suser_id'), $fileName, 'public')
                    : $filePath = $file->storeAs('storage/videos/'.session()->get('srole').session()->get('suser_id'), $fileName, 'public');
                // $file->move(storage_path().'/videos', $filePath);  
                $data += [
                    'duration'                  => $this->getID3->analyze($request->video)['playtime_seconds'],
                    'playtime'                  => $this->getID3->analyze($request->video)['playtime_string'],
                    'video'                     => $filePath,
                    'video_name'                => $fileName,
                ];
            }

            $this->course_detail->insert($data);
            $sum = $this->course_detail->selectRaw('SUM(duration) AS duration')->where('course_header_id', $request->id)->where('disabled', 0)->first();
            $data = [
                'duration'                      => $sum->duration,
                'updated_at'                    => now(),
                'updated_by'                    => session()->get('sname').' ('.session()->get('srole').')',
            ];
            $this->course_header->where('id', $request->id)->update($data);

            return redirect('/admin/course-header/'.$request->id.'/edit')->with('status', 'Data Berhasil Ditambahkan.');
        } else {
            $data['action'] = 'add';

            if ($request->video) {
                $file = $request->file('video');
                $extension = $request->video->getClientOriginalExtension();  // Get Extension
                $fileName = date('Y-m-d H-i-s', strtotime(now())).'_'.$request->title.$request->doctor.session()->get('sid').'.'.$extension;  // Concatenate both to get FileName
                (env('APP_ENV') == 'local') ? $filePath = $file->storeAs('videos/'.session()->get('srole').session()->get('suser_id'), $fileName, 'public')
                    : $filePath = $file->storeAs('storage/videos/'.session()->get('srole').session()->get('suser_id'), $fileName, 'public');
                // $file->move(storage_path().'/videos', $filePath);  
                $data += [
                    'duration'                  => $this->getID3->analyze($request->video)['playtime_seconds'],
                    'playtime'                  => $this->getID3->analyze($request->video)['playtime_string'],
                    'video'                     => $filePath,
                    'video_name'                => $fileName,
                ];
            }

            $this->course_detail_approval->insert($data);

            return redirect('/admin/course-header/'.$request->id.'/edit')->with('status', 'Data yang Ditambahkan Menunggu Approval.');
        }
    }

    public function show($id)
    {
        $data = [
            'c_menu'                            => $this->menu->select('id', 'title', 'url')->where('disabled', 0)->where('url', $this->path)->first(),
            'detail'                            => $this->course_detail->select('id', 'course_header_id', 'title', 'video', 'description')->where('id', $id)->where('disabled', 0)->first(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 && $data['access']->detail == 0) abort(403);
        
        return view('admin.management.course_detail.show', $data);
    }

    public function edit($id)
    {

        $data = [
            'c_menu'                            => $this->submenu->select('id', 'title', 'url', 'menu_id')->where('disabled', 0)->where('url', $this->path)->first(),
            'detail'                            => $this->course_detail->select('id', 'course_header_id', 'title', 'video', 'description')->where('id', $id)->where('disabled', 0)->first(),
            'detail'                            => $this->course_detail->select(
                                                        'trx_course_detail.id', 'trx_course_detail_approval.id AS approval_id', 'trx_course_detail.title', 'trx_course_detail.description', 
                                                        'trx_course_detail.course_header_id', 'trx_course_detail.video', 'trx_course_detail.video_name'
                                                    )->leftJoin('trx_course_detail_approval', 'trx_course_detail_approval.course_detail_id', '=', 'trx_course_detail.id')
                                                    ->where('trx_course_detail.disabled', 0)->where('trx_course_detail.id', $id)->first(),
        ];
        $data += [
            'data'                              => $this->course_detail_document->select(
                                                        'trx_course_detail_document.id', 'trx_course_detail_document_approval.id AS approval_id', 'trx_course_detail_document.title', 'trx_course_detail_document.description', 
                                                        'trx_course_detail_document.course_detail_id', 'trx_course_detail_document.file', 'trx_course_detail_document.file_name'
                                                    )->leftJoin('trx_course_detail_document_approval', 'trx_course_detail_document_approval.course_detail_document_id', '=', 'trx_course_detail_document.id')
                                                    ->where('trx_course_detail_document.disabled', 0)->where('trx_course_detail_document.course_detail_id', $data['detail']->id)->get(),
            'access'                            => $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
                                                    ->where('role', session()->get('srole'))->where('submenu_id', $data['c_menu']->id)->first(),
        ];
        
        if ($data['access']->view == 0 && $data['access']->edit == 0) abort(403);

        return view('admin.management.course_detail.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'title'                             => 'required',
            'video'                             => 'max:514000|file|mimes:mp4,mkv',
        ]);
        
        $data = [
            'course_header_id'                  => $request->id,
            'title'                             => $request->title,
            'description'                       => $request->description,
            'updated_at'                        => now(),
            'updated_by'                        => session()->get('sname').' ('.session()->get('srole').')',
        ];
        
        if (session()->get('srole') == 'adm') {
            if ($request->video) {
                if ($request->old_video) (env('APP_ENV') == 'local') ? File::delete(storage_path('app/public/'.$request->old_video)) 
                    : File::delete(storage_path('app/public/'.$request->old_video));
                $file = $request->file('video');
                $extension = $request->video->getClientOriginalExtension();  // Get Extension
                $fileName = date('Y-m-d H-i-s', strtotime(now())).'_'.$request->title.$request->doctor.session()->get('sid').'.'.$extension;  // Concatenate both to get FileName
                (env('APP_ENV') == 'local') ? $filePath = $file->storeAs('videos/'.session()->get('srole').session()->get('suser_id'), $fileName, 'public')
                    : $filePath = $file->storeAs('storage/videos/'.session()->get('srole').session()->get('suser_id'), $fileName, 'public');
                // $file->move(storage_path().'/videos', $filePath);  
                $data += [
                    'duration'                  => $this->getID3->analyze($request->video)['playtime_seconds'],
                    'playtime'                  => $this->getID3->analyze($request->video)['playtime_string'],
                    'video'                     => $filePath,
                    'video_name'                => $fileName,
                ]; 
            }
    
            $this->course_detail->where('id', $id)->update($data);
            $sum = $this->course_detail->selectRaw('SUM(duration) AS duration')->where('course_header_id', $request->id)->where('disabled', 0)->first();
            $data = [
                'duration'                      => $sum->duration,
                'updated_at'                    => now(),
                'updated_by'                    => session()->get('sname').' ('.session()->get('srole').')',
            ];
            $this->course_header->where('id', $request->id)->update($data);

            return redirect(url()->previous())->with('status', 'Data Berhasil Diubah.');
        } else {
            $data += [
                'action'                        => 'edit',
                'course_detail_id'              => $id,
            ];

            if ($request->video) {
                $file = $request->file('video');
                $extension = $request->video->getClientOriginalExtension();  // Get Extension
                $fileName = date('Y-m-d H-i-s', strtotime(now())).'_'.$request->title.$request->doctor.session()->get('sid').'.'.$extension;  // Concatenate both to get FileName
                (env('APP_ENV') == 'local') ? $filePath = $file->storeAs('videos/'.session()->get('srole').session()->get('suser_id'), $fileName, 'public')
                    : $filePath = $file->storeAs('storage/videos/'.session()->get('srole').session()->get('suser_id'), $fileName, 'public');
                // $file->move(storage_path().'/videos', $filePath);  
                $data += [
                    'duration'                  => $this->getID3->analyze($request->video)['playtime_seconds'],
                    'playtime'                  => $this->getID3->analyze($request->video)['playtime_string'],
                    'video'                     => $filePath,
                    'video_name'                => $fileName,
                ]; 
            }
            $this->course_detail_approval->insert($data);

            return redirect('/admin/course-header/'.$request->id.'/edit')->with('status', 'Data yang Diubah Menunggu Approval.');
        }
    }

    public function destroy(Request $request, $id)
    {
        $data = [
            'disabled'                          => 1,
            'updated_at'                        => now(),
            'updated_by'                        => session()->get('sname').' ('.session()->get('srole').')',
        ];

        if (session()->get('srole') == 'adm') {
            $this->course_detail->where('id', $id)->update($data);
            $sum = $this->course_detail->selectRaw('SUM(duration) AS duration')->where('course_header_id', $request->id)->where('disabled', 0)->first();
            $data = [
                'duration'                      => $sum->duration,
                'updated_at'                    => now(),
                'updated_by'                    => session()->get('sname').' ('.session()->get('srole').')',
            ];
            $this->course_header->where('id', $request->id)->update($data);

            return redirect(url()->previous())->with('status', 'Data Berhasil Dihapus.');
        } else {
            $check = $this->course_detail->where('id', $id)->where('disabled', 0)->first();

            $data += [
                'title'                         => $check->title,
                'description'                   => $check->description,
                'video'                         => $check->video,
                'video_name'                    => $check->video_name,
                'course_header_id'              => $check->course_header_id,
                'action'                        => 'delete',
                'course_detail_id'              => $id,
            ];

            $this->course_detail_approval->insert($data);

            return redirect('/admin/course-header/'.$id.'/edit')->with('status', 'Data yang Dihapus Menunggu Approval.');
        }
    }
}
