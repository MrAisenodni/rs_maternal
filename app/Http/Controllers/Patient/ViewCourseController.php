<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewCourseController extends Controller
{
    protected $path = '/view-course';

    public function index($id, $ids)
    {
        $getID3 = new \getID3;

        $data = [
            'c_menu'    => $this->menu->select('id', 'title', 'url')->where('disabled', 0)->where('url', $this->path)->first(),
            'data'      => $this->course_header->select('id', 'title', 'picture', 'rating', 'category_id', 'level_id', 'description', 'duration')->where('id', $id)->where('disabled', 0)->first(),
            'detail'    => $this->course_detail->select('id', 'course_header_id', 'title', 'video', 'description')->where('course_header_id', $id)->where('id', $ids)->where('disabled', 0)->first(),
            'getID3'    => $getID3,
        ];

        // $file = $getID3->analyze(substr($data['detail']->video, 1));

        // dd($file, gmdate('H:i:s', 1157.096767));

        return view('patient.view_course', $data);
    }
}
