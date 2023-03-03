<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProviderController extends Controller
{
    protected $path = '/setting/provider';

    public function index()
    {
        $data = [
            'c_menu'            => $this->menu->select('id', 'title', 'main_menu_id', 'url')->where('url', $this->path)->first(),
            'detail'            => $this->provider->where('disabled', 0)->first(),
            'districts'         => $this->district->select('id', 'name')->where('disabled', 0)->get(),
            // 'wards'         => $this->ward->select('id', 'name', 'post_code')->where('disabled', 0)->get(),
            // 'wards'         => $this->ward->select('id', 'name', 'post_code')->where('disabled', 0)->paginate(100),
        ];

        return view('admin.settings.provider', $data);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validate = $request->validate([
            'provider_npwp'         => 'required|unique:stg_provider,provider_npwp,'.$input['id'].',id,disabled,1',
            'provider_name'         => 'required',
        ]);

        $data = [
            'provider_npwp'         => $input['provider_npwp'],
            'provider_name'         => $input['provider_name'],
            'provider_birth_place'  => $input['provider_birth_place'],
            'provider_birth_date'   => date('Y-m-d', strtotime(str_replace('/', '-', $input['provider_birth_date']))),
            'provider_email'        => $input['provider_email'],
            'provider_phone_number' => $input['provider_phone_number'],
            'provider_address'      => $input['provider_address'],
            'provider_ward_id'      => $input['provider_ward'],
            'provider_logo'         => $input['old_provider_logo'],
            'provider_picture'      => $input['old_provider_picture'],
            'owner_npwp'            => $input['owner_npwp'],
            'owner_nik'             => $input['owner_nik'],
            'owner_name'            => $input['owner_name'],
            'owner_birth_place'     => $input['owner_birth_place'],
            'owner_birth_date'      => date('Y-m-d', strtotime(str_replace('/', '-', $input['owner_birth_date']))),
            'owner_email'           => $input['owner_email'],
            'owner_phone_number'    => $input['owner_phone_number'],
            'owner_address_1'       => $input['owner_address_1'],
            'owner_address_2'       => $input['owner_address_2'],
            'owner_address_3'       => $input['owner_address_3'],
            'owner_ward_id'         => $input['owner_ward'],
            'created_at'            => now(),
            'created_by'            => session()->get('user_id'),
        ];
        // dd($data);

        if ($request->provider_logo) {
            if ($request->old_provider_logo) File::delete(public_path().$request->old_provider_logo);
            $file = $request->file('provider_logo');
            // $extension = $request->provider_logo->getClientOriginalExtension();  //Get Image Extension
            // $fileName =  strtotime(now()).'_'.$request->nis.'_'.$request->full_name.'.'.$extension;  //Concatenate both to get FileName (eg: file.jpg)
            $file->move(public_path(), '/favicon.ico');  
            $data['provider_logo'] = '/favicon.ico'; 
        }

        if ($request->provider_picture) {
            if ($request->old_provider_picture) File::delete(public_path().$request->old_provider_picture);
            $file = $request->file('provider_picture');
            // $extension = $request->provider_picture->getClientOriginalExtension();  //Get Image Extension
            // $fileName =  strtotime(now()).'_'.$request->nis.'_'.$request->full_name.'.'.$extension;  //Concatenate both to get FileName (eg: file.jpg)
            $file->move(public_path(), '/images/favicon-32x32.png');  

            $data['provider_picture'] = '/images/favicon-32x32.png'; 
        }
        // dd($data);

        $this->provider->where('id', $input['id'])->update($data);

        return redirect($this->path)->with('status', 'Perubahan Berhasil Disimpan.');
    }
}
