<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $path         = '/admin/best-practice';

    public function index()
    {
        $data = [
            'c_menu'            => $this->menu->select('id', 'title', 'url', 'main_menu_id')->where('disabled', 0)->where('url', $this->path)->first(),
            'data'              => $this->article->where('disabled', 0)->get(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0) abort(403);

        return view('admin.management.article.index', $data);
    }

    public function create()
    {
        $data = [
            'c_menu'            => $this->menu->select('id', 'title', 'url', 'main_menu_id')->where('disabled', 0)->where('url', $this->path)->first(),
            'app_param'         => $this->application_parameter->select('title', 'value')->whereIn('id', [5, 6])->get(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 && $data['access']->add == 0) abort(403);

        return view('admin.management.article.create', $data);
    }

    public function store(Request $request)
    {
        $app_param = $this->application_parameter->select('title', 'value')->whereIn('id', [5, 6])->get();

        $validate = $request->validate([
            'title'             => 'required',
            'picture'           => 'required|'.$app_param[0]->value.'|'.$app_param[1]->value,
            'description'       => 'required',
        ]);
        
        $data = [
            'title'             => $request->title,
            'subtitle'          => $request->subtitle,
            'description'       => $request->description,
            'hashtag'           => $request->hashtag,
            'type'              => 'content',
            'created_at'        => now(),
            'created_by'        => session()->get('sname').' ('.session()->get('srole').')',
        ];
        
        if ($request->picture) {
            $file = $request->file('picture');
            $extension = $request->picture->getClientOriginalExtension();  // Get Extension
            $fileName = date('Y-m-d H-i-s', strtotime(now())).'_'.$request->title.$request->doctor.session()->get('sid').'.'.$extension;  // Concatenate both to get FileName
            (env('APP_ENV') == 'local') ? $filePath = $file->storeAs('articles/pictures/'.session()->get('srole').session()->get('suser_id'), $fileName, 'public')
                : $filePath = $file->storeAs('storage/articles/pictures/'.session()->get('srole').session()->get('suser_id'), $fileName, 'public');
            // $file->move(storage_path().'/', $filePath);  
            $data += [
                'picture'                   => $filePath,
                'picture_name'              => $fileName,
            ]; 
        }
        
        $this->article->insert($data);
        
        return redirect($this->path)->with('status', 'Data berhasil Ditambahkan.');
    }

    public function show($id)
    {
        $data = [
            'c_menu'            => $this->menu->select('id', 'title', 'url', 'main_menu_id')->where('disabled', 0)->where('url', $this->path)->first(),
            'detail'            => $this->article->where('disabled', 0)->where('id', $id)->first(),
            'app_param'         => $this->application_parameter->select('title', 'value')->whereIn('id', [5, 6])->get(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 && $data['access']->show == 0) abort(403);

        return view('admin.management.article.show', $data);
    }

    public function edit($id)
    {
        $data = [
            'c_menu'            => $this->menu->select('id', 'title', 'url', 'main_menu_id')->where('disabled', 0)->where('url', $this->path)->first(),
            'data'              => $this->article_document->where('disabled', 0)->where('article_id', $id)->get(),
            'detail'            => $this->article->where('disabled', 0)->where('id', $id)->first(),
            'app_param'         => $this->application_parameter->select('title', 'value')->whereIn('id', [5, 6])->get(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 && $data['access']->edit == 0) abort(403);

        return view('admin.management.article.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $app_param = $this->application_parameter->select('title', 'value')->whereIn('id', [5, 6])->get();

        $validate = $request->validate([
            'title'             => 'required',
            'picture'           => 'required|'.$app_param[0]->value.'|'.$app_param[1]->value,
            'description'       => 'required',
        ]);
        
        $data = [
            'title'             => $request->title,
            'subtitle'          => $request->subtitle,
            'description'       => $request->description,
            'hashtag'           => $request->hashtag,
            'type'              => $request->type,
            'updated_at'        => now(),
            'updated_by'        => session()->get('sname').' ('.session()->get('srole').')',
        ];
        
        if ($request->picture) {
            if ($request->old_picture) File::delete(storage_path('app/public/'.$request->old_picture));
            $file = $request->file('picture');
            $extension = $request->picture->getClientOriginalExtension();  // Get Extension
            $fileName = date('Y-m-d H-i-s', strtotime(now())).'_'.$request->title.$request->doctor.session()->get('sid').'.'.$extension;  // Concatenate both to get FileName
            (env('APP_ENV') == 'local') ? $filePath = $file->storeAs('articles/pictures/'.session()->get('srole').session()->get('suser_id'), $fileName, 'public')
                : $filePath = $file->storeAs('storage/articles/pictures/'.session()->get('srole').session()->get('suser_id'), $fileName, 'public');
            // $file->move(storage_path().'/pictures', $filePath);  
            $data += [
                'picture'                   => $filePath,
                'picture_name'              => $fileName,
            ]; 
        }

        $this->article->where('id', $id)->update($data);

        return redirect($this->path.'/'.$id.'/edit')->with('status', 'Data berhasil Diubah.');
    }

    public function destroy($id)
    {
        $data = [
            'disabled'                          => 1,
            'updated_at'                        => now(),
            'updated_by'                        => session()->get('sname').' ('.session()->get('srole').')',
        ];

        if (session()->get('srole') == 'adm') {
            $this->article->where('id', $id)->update($data);

            return redirect($this->path)->with('status', 'Data Berhasil Dihapus.');
        } else {
            $check = $this->article->where('id', $id)->where('disabled', 0)->first();

            $data += [
                'title'                         => $check->title,
                'course_teacher_id'             => $check->course_teacher_id,
                'category_id'                   => $check->category_id,
                'level_id'                      => $check->level_id,
                'description'                   => $check->description,
                'picture'                       => $check->picture,
                'picture_name'                  => $check->picture_name,
                'action'                        => 'delete',
                'article_id'              => $id,
            ];

            $this->article_approval->insert($data);

            return redirect($this->path)->with('status', 'Data yang Dihapus Menunggu Approval.');
        }
    }
}
