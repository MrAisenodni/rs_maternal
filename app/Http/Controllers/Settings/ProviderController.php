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
        ];

        return view('admin.settings.provider', $data);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'provider_npwp'         => 'required|unique:stg_provider,provider_npwp,'.$request->id.',id,disabled,1',
            'provider_name'         => 'required',
            'provider_email'        => 'unique:stg_provider,provider_email,'.$request->id.',id,disabled,1',
            'owner_npwp'            => 'unique:stg_provider,owner_npwp,'.$request->id.',id,disabled,1',
            'owner_nik'             => 'unique:stg_provider,owner_nik,'.$request->id.',id,disabled,1',
            'owner_email'           => 'unique:stg_provider,owner_email,'.$request->id.',id,disabled,1',
            'owner_address_2'       => 'min:1|max:3',
            'owner_address_3'       => 'min:1|max:3',
        ]);

        $data = [
            'provider_npwp'         => $request->provider_npwp,
            'provider_name'         => $request->provider_name,
            'provider_birth_place'  => $request->provider_birth_place,
            'provider_birth_date'   => date('Y-m-d', strtotime($request->provider_birth_date)),
            'provider_email'        => $request->provider_email,
            'provider_phone_number' => $request->provider_phone_number,
            'provider_address_1'    => $request->provider_address,
            'provider_district_id'  => $request->provider_district,
            'provider_ward'         => $request->provider_ward,
            'provider_logo'         => $request->old_provider_logo,
            'provider_picture'      => $request->old_provider_picture,
            'owner_npwp'            => $request->owner_npwp,
            'owner_nik'             => $request->owner_nik,
            'owner_name'            => $request->owner_name,
            'owner_birth_place'     => $request->owner_birth_place,
            'owner_birth_date'      => date('Y-m-d', strtotime($request->owner_birth_date)),
            'owner_email'           => $request->owner_email,
            'owner_phone_number'    => $request->owner_phone_number,
            'owner_address_1'       => $request->owner_address_1,
            'owner_address_2'       => $request->owner_address_2,
            'owner_address_3'       => $request->owner_address_3,
            'owner_district_id'     => $request->owner_district,
            'owner_ward'            => $request->owner_ward,
            'created_at'            => now(),
            'created_by'            => session()->get('sname').' ('.session()->get('srole').')',
        ];
        // dd($data);

        if ($request->provider_logo) {
            if ($request->old_provider_logo) File::delete(storage_path('app/public/'.$request->old_provider_logo));
            $file = $request->file('provider_logo');
            $extension = $request->provider_logo->getClientOriginalExtension();  // Get Extension
            $fileName = date('Y-m-d H-i-s', strtotime(now())).'_'.$request->title.$request->doctor.session()->get('sid').'.'.$extension;  // Concatenate both to get FileName
            (env('APP_ENV') == 'local') ? $filePath = $file->storeAs('provider/'.session()->get('srole').session()->get('suser_id'), $fileName, 'public')
                : $filePath = $file->storeAs('storage/provider/'.session()->get('srole').session()->get('suser_id'), $fileName, 'public');
            $data['provider_logo'] = $filePath;
        }

        if ($request->provider_picture) {
            if ($request->old_provider_picture) File::delete(storage_path('app/public/'.$request->old_provider_picture));
            $file = $request->file('provider_picture');
            $extension = $request->provider_picture->getClientOriginalExtension();  // Get Extension
            $fileName = date('Y-m-d H-i-s', strtotime(now())).'_'.$request->title.$request->doctor.session()->get('sid').'.'.$extension;  // Concatenate both to get FileName
            (env('APP_ENV') == 'local') ? $filePath = $file->storeAs('provider/'.session()->get('srole').session()->get('suser_id'), $fileName, 'public')
                : $filePath = $file->storeAs('storage/provider/'.session()->get('srole').session()->get('suser_id'), $fileName, 'public');
            $data['provider_picture'] = $filePath;
        }

        $this->provider->where('id', $request->id)->update($data);

        return redirect($this->path)->with('status', 'Perubahan Berhasil Disimpan.');
    }
}
