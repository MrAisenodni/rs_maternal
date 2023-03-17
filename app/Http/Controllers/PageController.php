<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    protected $path = '/';

    public function index()
    {
        $data = [
            'c_menu'    => $this->menu->select('id', 'title', 'url')->where('disabled', 0)->where('url', $this->path)->first(),
        ];

        return view('patient.dashboard', $data);
    }

    public function download(Request $request) {
        return Storage::download($request->file_name);
    }
}
