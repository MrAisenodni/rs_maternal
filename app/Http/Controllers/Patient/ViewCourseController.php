<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewCourseController extends Controller
{
    protected $path = '/view-course';

    public function index($id, $ids)
    {
        $data = [
            'c_menu'    => $this->menu->select('id', 'title', 'url')->where('disabled', 0)->where('url', $this->path)->first(),
            'data'      => $this->course_header->select('id', 'title', 'picture', 'picture_name', 'rating', 'category_id', 'level_id', 'description', 'duration', 'course_teacher_id')->where('id', $id)->where('disabled', 0)->first(),
            'detail'    => $this->course_detail->select('id', 'course_header_id', 'title', 'video', 'video_name', 'description', 'playtime', 'duration')->where('course_header_id', $id)->where('id', $ids)->where('disabled', 0)->first(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0) abort(403);

        return view('patient.view_course', $data);
    }
}
