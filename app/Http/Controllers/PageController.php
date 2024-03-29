<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    protected $path = '/';

    public function index(Request $request)
    {
        $search = $request->search;
        $count = $this->count_history->select('id', 'count')->where('type', 'guest')->first();
        $template = $this->application_parameter->select('value')->where('id', 7)->first();

        ($count) ? $this->count_history->where('id', $count->id)->update(['count' => $count->count + 1])
            : $this->count_history->insert(['type' => 'guest', 'count' => 1]);

        $data = [
            'provider'              => $this->provider->select('id', 'provider_name', 'provider_logo')->where('disabled', 0)->first(),
            'c_menu'                => $this->menu->select('id', 'title', 'url', 'main_menu_id')->where('disabled', 0)->where('url', $this->path)->first(),
            'detail'                => $this->article->where('type', 'home')->first(),
            'popular'               => $this->count_history->selectRaw('foreign_id, SUM(count) as count')->where('disabled', 0)->where('type', 'video')->orderByDesc('count')->groupBy('foreign_id')->limit(5)->get(),
            'reviews'               => $this->count_history->selectRaw('type, SUM(count) AS count')->where('disabled', 0)->orderBy('type')->groupBy('type')->get(),
            'search'                => $search,
        ];

        return view('patient'.$template->value.'.home', $data);
    }

    public function dashboard(Request $request)
    {
        $search = $request->search;
        $template = $this->application_parameter->select('value')->where('id', 7)->first();

        $data = [
            'provider'              => $this->provider->select('id', 'provider_name', 'provider_logo')->where('disabled', 0)->first(),
            'approvals'             => $this->course_header_approval->selectRaw("'Detail Materi', COUNT(id) AS Jumlah")
                                        ->union(
                                            $this->course_detail_approval->selectRaw("'Detail Video', COUNT(id) AS Jumlah")
                                        ),
            'c_menu'                => $this->menu->select('id', 'title', 'url', 'main_menu_id')->where('disabled', 0)->where('url', '/dashboard')->first(),
            'companions'            => $this->companion->select('id', 'title')->where('disabled', 0)->get(),
            'hospitals'             => $this->hospital->select('id', 'name')->where('disabled', 0)->where('type', 'int')->get(),
            'results'               => $this->result->select('id', 'title', 'subtitle')->where('disabled', 0)->get(),
            'clinic_results'        => $this->clinic_results->select('id', 'companion_id', 'hospital_id', 'result_id', 'detail_result_id', 'value')->where('hospital_id', 1)->where('disabled', 0)->get(),
            // 'companion'             => $this->companion->select('trx_companion.id', 'trx_companion.title', 'trx_standard_process.description', 'trx_standard_process.standard', 'trx_standard_process.process')
            //                             ->join('trx_standard_process', 'trx_standard_process.companion_id', '=', 'trx_companion.id')
            //                             ->where('trx_companion.disabled', 0)->get(),
            'count_user'            => $this->user->selectRaw("'pat', COUNT(id) AS jumlah")->where('disabled', 0)->where('role', 'pat')
                                        ->union(
                                            $this->user->selectRaw("'tec', COUNT(id) AS jumlah")->where('disabled', 0)->where('role', 'tec')
                                        )->get(),
            'count_video'           => $this->course_detail->select('id')->where('disabled', 0)->count(),
            'count_document'        => $this->course_detail_document->select('id')->where('disabled', 0)->count(),
            'history'               => $this->count_history->selectRaw('type, SUM(count) AS count')->where('disabled', 0)->groupBy('type')->orderBy('type')->get(),
            'search'                => $search,
        ];
        
        if ($search) $data['clinic_results'] = $this->clinic_results->select('id', 'companion_id', 'hospital_id', 'result_id', 'detail_result_id', 'value')->where('hospital_id', $search)->where('disabled', 0)->get();
        
        return view('patient'.$template->value.'.dashboard', $data);
    }

    public function registration()
    {
        $data = [
            'religions'             => $this->religion->select('id', 'name')->where('disabled', 0)->get(),
        ];

        return view('registration', $data);
    }

    public function store_registration(Request $request)
    {
        $validate = $request->validate([
            'email'                 => 'required|unique:mst_user,email,1,disabled|unique:mst_user_approval,email,1,disabled',
            'full_name'             => 'required',
            'gender'                => 'required',
            'home_number'           => 'unique:mst_user,home_number,1,disabled|unique:mst_user_approval,home_number,1,disabled',
            'nik'                   => 'required|unique:mst_user,nik,1,disabled|unique:mst_user_approval,nik,1,disabled',
            'phone_number'          => 'unique:mst_user,phone_number,1,disabled|unique:mst_user_approval,phone_number,1,disabled',
            'password'              => 'required|min:8',
            'repassword'            => 'required|same:password',
            'username'              => 'required|unique:stg_login,username,1,disabled|unique:stg_login_approval,username,1,disabled',
        ]);

        $data = [
            'nik'                   => $request->nik,
            'full_name'             => $request->full_name,
            'gender'                => $request->gender,
            'birth_place'           => $request->birth_place,
            'birth_date'            => date('Y-m-d', strtotime($request->birth_date)),
            'email'                 => $request->email,
            'phone_number'          => $request->phone_number,
            'home_number'           => $request->home_number,
            'religion_id'           => $request->religion,
            'role'                  => $request->role,
        ];

        $id = $this->user_approval->insertGetId($data);

        $data = [
            'created_at'            => now(),
            'created_by'            => $id,
        ];

        $this->user_approval->where('id', $id)->update($data);

        $data = [
            'user_id'               => $id,
            'username'              => $request->username,
            'password'              => Hash::make($request->password),
        ];

        $this->login_approval->insert($data);
        
        return redirect('/login')->with('status', 'Akun Anda berhasil diajukan. Silahkan tunggu hingga akun Anda disetujui.');
    }

    public function download($id) {     
        $count = $this->count_history->select('id', 'count')->where('type', 'document')->where('foreign_id', $id)->first();
        
        ($count) ? $this->count_history->where('id', $count->id)->update(['count' => $count->count + 1])
            : $this->count_history->insert(['type' => 'document', 'foreign_id' => $id, 'count' => 1]);

        return false;
    }
}
