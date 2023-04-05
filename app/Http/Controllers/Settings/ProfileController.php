<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{ File, Hash };

class ProfileController extends Controller
{
    protected $path = '/profile';

    public function show($id)
    {
        $data = [
            'c_menu'        => $this->menu->select('id', 'title', 'url', 'main_menu_id')->where('disabled', 0)->where('url', $this->path)->first(),
            'detail'        => $this->user->where('disabled', 0)->where('id', $id)->first(),
            'religions'     => $this->religion->select('id', 'name')->where('disabled', 0)->get(),
        ];
        $data['access'] = $this->menu_access->select('view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)
            ->where('role', session()->get('srole'))->where('menu_id', $data['c_menu']->id)->first();
        if ($data['access']->view == 0 || $data['access']->detail == 0) abort(403);
        if ($id != session()->get('sid')) abort(403);
        
        return view('admin.settings.profile.show', $data);
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'address_2'                 => 'max:3',
            'address_3'                 => 'max:3',
            'email'                     => 'required|unique:mst_user,email,'.$id.',id,disabled,0',
            'full_name'                 => 'required',
            'gender'                    => 'required',
            'home_number'               => 'unique:mst_user,home_number,'.$id.',id,disabled,0',
            'nik'                       => 'required|unique:mst_user,nik,'.$id.',id,disabled,0',
            'phone_number'              => 'required|unique:mst_user,phone_number,'.$id.',id,disabled,0',
            'current_password'          => 'required_with:new_password',
            'new_password'              => 'required_with:current_password',
            'repassword'                => 'required_with:current_password|same:new_password',
            'religion'                  => 'required',
            'new_username'              => 'unique:stg_login,username,'.$id.',user_id,disabled,0'
        ]);

        $check = $this->user->where('disabled', 0)->where('id', $id)->first();

        $data = [
            'nik'                       => $request->nik,
            'full_name'                 => $request->full_name,
            'gender'                    => $request->gender,
            'birth_place'               => $request->birth_place,
            'birth_date'                => date('Y-m-d', strtotime($request->birth_date)),
            'email'                     => $request->email,
            'phone_number'              => $request->phone_number,
            'home_number'               => $request->home_number,
            'address_1'                 => $request->address_1,
            'address_2'                 => $request->address_2,
            'address_3'                 => $request->address_3,
            'religion_id'               => $request->religion,
            'biography'                 => $request->biography,
            'twitter'                   => $request->twitter,
            'facebook'                  => $request->facebook,
            'instagram'                 => $request->instagram,
            'github'                    => $request->github,
            'updated_at'                => now(),
            'updated_by'                => session()->get('sname').' ('.session()->get('srole').')',
        ];

        if ($request->picture) {
            if ($request->old_picture) File::delete(storage_path('app/public/'.$request->old_picture));
            $file = $request->file('picture');
            $extension = $request->picture->getClientOriginalExtension();  // Get Extension
            $fileName = date('Y-m-d H-i-s', strtotime(now())).'_'.$request->title.$request->doctor.session()->get('sid').'.'.$extension;  // Concatenate both to get FileName
            (env('APP_ENV') == 'local') ? $filePath = $file->storeAs('pictures/'.session()->get('srole').session()->get('suser_id'), $fileName, 'public')
                : $filePath = $file->storeAs('storage/pictures/'.session()->get('srole').session()->get('suser_id'), $fileName, 'public');
            session()->put('spicture', $filePath) ;
            
            $data += [
                'picture'                   => $filePath,
                'picture_name'              => $fileName,
            ]; 
        }

        $this->user->where('id', $id)->update($data);

        if ($request->current_password) 
            if (Hash::check($request->current_password, $check->login->password)) {
                if (Hash::check($request->new_password, $check->login->password)) {
                    return redirect(url()->previous())->with([
                        'error'                 => 'Kata Sandi Baru tidak boleh sama dengan Kata Sandi Lama.',
                        'err_new_password'      => 'Kata Sandi Baru tidak boleh sama dengan Kata Sandi Lama.',
                    ])->withInput();
                } else {
                    $data = [
                        'password'              => Hash::make($request->new_password),
                        'updated_at'            => now(),
                        'updated_by'            => session()->get('sname').' ('.session()->get('srole').')',
                    ];

                    $this->login->where('user_id', $id)->update($data);
                }
            } else {
                return redirect(url()->previous())->with([
                    'error'                     => 'Kata Sandi Lama salah.',
                    'err_current_password'      => 'Kata Sandi Lama salah.',
                ])->withInput();
            }

        return redirect(url()->previous())->with('status', 'Data Berhasil Diubah.');
    }
}
