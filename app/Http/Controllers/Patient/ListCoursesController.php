<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListCoursesController extends Controller
{
    protected $path = '/list-courses';

    public function index(Request $request)
    {
        $search = $request->search;

        $data = [
            'c_menu'    => $this->menu->select('id', 'title', 'url', 'main_menu_id')->where('disabled', 0)->where('url', $this->path)->first(),
            'data'      => $this->course_header->select('id', 'title', 'picture', 'rating', 'category_id', 'level_id', 'description')->where('disabled', 0)->where('title', 'LIKE', '%'.$search.'%')->paginate(4),
            'search'    => $search,
        ];

        return view('patient.list_courses', $data);
    }
}
