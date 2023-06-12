<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListArticlesController extends Controller
{
    protected $path = '/best-practice';

    public function index(Request $request)
    {
        $search = $request->search;
        $template = $this->application_parameter->select('value')->whereIn('id', [7, 8])->get();

        $data = [
            'c_menu'    => $this->menu->select('id', 'title', 'url', 'main_menu_id')->where('disabled', 0)->where('url', $this->path)->first(),
            'data'      => $this->article->select('id', 'title', 'subtitle', 'picture')->where('type', 'content')->where('disabled', 0)->where('title', 'LIKE', '%'.$search.'%')->paginate($template[1]->value),
            'search'    => $search,
        ];

        return view('patient'.$template[0]->value.'.list_articles', $data);
    }

    public function show(Request $request, $id)
    {
        $search = $request->search;
        $count = $this->count_history->select('id', 'count')->where('type', 'article')->where('foreign_id', $id)->first();
        $template = $this->application_parameter->select('value')->where('id', 7)->first();

        $data = [
            'c_menu'    => $this->menu->select('id', 'title', 'url')->where('disabled', 0)->where('url', $this->path)->first(),
            'detail'    => $this->article->where('id', $id)->where('disabled', 0)->first(),
            'popular'   => $this->count_history->selectRaw('foreign_id, SUM(count) as count')->where('disabled', 0)->where('type', 'video')->orderByDesc('count')->groupBy('foreign_id')->limit(5)->get(),
            'reviews'   => $this->count_history->selectRaw('type, SUM(count) AS count')->where('disabled', 0)->orderBy('type')->groupBy('type')->get(),
            'review'    => $this->count_history->select('count')->where('foreign_id', $id)->where('disabled', 0)->where('type', 'article')->first(),
            'search'    => $search,
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0) abort(403);
        
        ($count) ? $this->count_history->where('id', $count->id)->update(['count' => $count->count + 1])
            : $this->count_history->insert(['type' => 'article', 'foreign_id' => $id, 'count' => 1]);

        return view('patient'.$template->value.'.view_article', $data);
    }
}
