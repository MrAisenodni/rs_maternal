<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewArticleController extends Controller
{
    protected $path = '/best-practice';

    public function index(Request $request, $id, $ids)
    {
        $search = $request->search;
        $count = $this->count_history->select('id', 'count')->where('type', 'video')->where('foreign_id', $ids)->first();
        $template = $this->application_parameter->select('value')->where('id', 7)->first();

        $data = [
            'provider'  => $this->provider->select('id', 'provider_name', 'provider_logo')->where('disabled', 0)->first(),
            'c_menu'    => $this->menu->select('id', 'title', 'url')->where('disabled', 0)->where('url', $this->path)->first(),
            'detail'    => $this->article->where('id', $id)->where('disabled', 0)->first(),
            'popular'   => $this->count_history->selectRaw('foreign_id, SUM(count) as count')->where('disabled', 0)->where('type', 'video')->orderByDesc('count')->groupBy('foreign_id')->limit(5)->get(),
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
