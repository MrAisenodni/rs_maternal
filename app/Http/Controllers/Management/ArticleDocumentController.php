<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{ File, Hash };

class ArticleDocumentController extends Controller
{
    protected $path = '/admin/best-practice-document';

    public function create($id)
    {
        $data = [
            'article'               => $this->article->select('id', 'title')->where('id', $id)->where('disabled', 0)->first(),
            'c_menu'                => $this->menu->select('id', 'title', 'url', 'main_menu_id')->where('disabled', 0)->where('url', $this->path)->first(),
            'app_param'             => $this->application_parameter->select('title', 'value')->whereIn('id', [1, 2])->get(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->add == 0) abort(403);

        return view('admin.management.article_document.create', $data);
    }

    public function store(Request $request)
    {
        $app_param = $this->application_parameter->select('title', 'value')->whereIn('id', [1, 2])->get();

        $validate = $request->validate([
            'title'                 => 'required',
            'document'              => 'required_with:title_document|'.$app_param[0]->value.'|file',
        ]);
        
        $data = [
            'article_id'            => $request->id,
            'title'                 => $request->title,
            'description'           => $request->description,
            'created_at'            => now(),
            'created_by'            => session()->get('sname').' ('.session()->get('srole').')',
        ];
        
        if ($request->document) {
            $file = $request->file('document');
            $extension = $request->document->getClientOriginalExtension();  // Get Extension
            $fileName = date('Y-m-d H-i-s', strtotime(now())).'_'.$request->title.$request->doctor.session()->get('sid').'.'.$extension;  // Concatenate both to get FileName
            (env('APP_ENV') == 'local') ? $filePath = $file->storeAs('articles/documents/'.session()->get('srole').session()->get('suser_id'), $fileName, 'public')
                : $filePath = $file->storeAs('storage/articles/documents/'.session()->get('srole').session()->get('suser_id'), $fileName, 'public');
            // $file->move(storage_path().'/documents', $filePath);  
            $data += [
                'file'                      => $filePath,
                'file_name'                 => $fileName,
            ];
        }

        $this->article_document->insert($data);

        return redirect('/admin/best-practice/'.$request->id.'/edit')->with('status', 'Data Berhasil Ditambahkan.');
    }

    public function show($id)
    {
        $data = [
            'c_menu'                => $this->menu->select('id', 'title', 'url')->where('disabled', 0)->where('url', $this->path)->first(),
            'detail'                => $this->article_document->select('id', 'article_id', 'title', 'description', 'file', 'file_name')->where('disabled', 0)->where('id', $id)->first(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 && $data['access']->detail == 0) abort(403);
        
        return view('admin.management.article_document.show', $data);
    }

    public function edit($id)
    {
        $data = [
            'c_menu'                => $this->menu->select('id', 'title', 'url')->where('disabled', 0)->where('url', $this->path)->first(),
            'detail'                => $this->article_document->select('id', 'article_id', 'title', 'description', 'file', 'file_name')->where('disabled', 0)->where('id', $id)->first(),
            'app_param'             => $this->application_parameter->select('title', 'value')->whereIn('id', [1, 2])->get(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 && $data['access']->edit == 0) abort(403);

        return view('admin.management.article_document.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $app_param = $this->application_parameter->select('title', 'value')->whereIn('id', [1, 2])->get();

        $validate = $request->validate([
            'title'                 => 'required',
            'document'              => 'required_with:title_document|'.$app_param[0]->value.'|file',
        ]);
        
        $data = [
            'article_id'            => $request->article_id,
            'title'                 => $request->title,
            'description'           => $request->description,
            'updated_at'            => now(),
            'updated_by'            => session()->get('sname').' ('.session()->get('srole').')',
        ];

        if ($request->document) {
            if ($request->old_document) (env('APP_ENV') == 'local') ? File::delete(storage_path('app/public/'.$request->old_document)) 
                : File::delete(storage_path('app/public/'.$request->old_document));
            $file = $request->file('document');
            $extension = $request->document->getClientOriginalExtension();  // Get Extension
            $fileName = date('Y-m-d H-i-s', strtotime(now())).'_'.$request->title.$request->doctor.session()->get('sid').'.'.$extension;  // Concatenate both to get FileName
            (env('APP_ENV') == 'local') ? $filePath = $file->storeAs('articles/documents/'.session()->get('srole').session()->get('suser_id'), $fileName, 'public')
                : $filePath = $file->storeAs('storage/articles/documents/'.session()->get('srole').session()->get('suser_id'), $fileName, 'public');
            // $file->move(storage_path().'/documents', $filePath);  
            $data += [
                'file'                      => $filePath,
                'file_name'                 => $fileName,
            ]; 
        }

        $this->article_document->where('id', $id)->update($data);

        return redirect(url()->previous())->with('status', 'Data Berhasil Diubah.');  
    }

    public function destroy($id)
    {
        $data = [
            'disabled'      => 1,
            'updated_at'    => now(),
            'updated_by'    => session()->get('sname').' ('.session()->get('srole').')',
        ];

        $this->article_document->where('id', $id)->update($data);

        return redirect(url()->previous())->with('status', 'Data Berhasil Dihapus.');
    }
}
