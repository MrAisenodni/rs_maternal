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
}
