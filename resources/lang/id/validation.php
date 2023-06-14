<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute harus diterima.',
    'accepted_if' => ':attribute harus diterima jika :other berisi :value.',
    'active_url' => ':attribute berisi URL tidak valid.',
    'after' => ':attribute harus setelah :date.',
    'after_or_equal' => ':attribute harus berisi tanggal setelah atau sama dengan :date.',
    'alpha' => ':attribute hanya boleh berisi huruf.',
    'alpha_dash' => ':attribute hanya boleh berisi huruf, angka, dash (-) dan underscore (_).',
    'alpha_num' => ':attribute hanya boleh berisi huruf dan angka.',
    'array' => ':attribute harus berisi array.',
    'before' => ':attribute harus berisi tanggal sebelum :date.',
    'before_or_equal' => ':attribute harus berisi tanggal sebelum atau sama dengan :date.',
    'between' => [
        'numeric' => ':attribute harus antara :min dan :max.',
        'file' => ':attribute harus antara :min dan :max kilobytes.',
        'string' => ':attribute harus antara :min dan :max karakter.',
        'array' => ':attribute harus berada diantara :min dan :max item.',
    ],
    'boolean' => ':attribute harus berisi benar atau salah.',
    'confirmed' => 'Konfirmasi :attribute tidak cocok.',
    'current_password' => 'Kata Sandi Lama salah.',
    'date' => ':attribute bukan tanggal yang valid.',
    'date_equals' => ':attribute harus berisi tanggal yang sama dengan :date.',
    'date_format' => ':attribute tidak cocok dengan format :format.',
    'declined' => ':attribute harus ditolak.',
    'declined_if' => ':attribute harus ditolak jika :other berisi :value.',
    'different' => ':attribute dan :other harus berbeda.',
    'digits' => ':attribute harus berisi :digits digit.',
    'digits_between' => ':attribute harus antara :min dan :max digit.',
    'dimensions' => ':attribute memiliki dimensi gambar yang tidak valid.',
    'distinct' => ':attribute memiliki nilai duplikat.',
    'email' => ':attribute harus berisi email yang valid.',
    'ends_with' => ':attribute harus diakhiri dengan salah satu dari: :values.',
    'enum' => ':attribute yang dipilih tidak valid.',
    'exists' => ':attribute yang dipilih tidak valid.',
    'file' => ':attribute harus berupa file.',
    'filled' => ':attribute harus memiliki nilai.',
    'gt' => [
        'numeric' => ':attribute harus lebih besar dari :value.',
        'file' => ':attribute harus lebih besar dari :value kilobytes.',
        'string' => ':attribute harus lebih besar dari :value karakter.',
        'array' => ':attribute harus lebih dari :value item.',
    ],
    'gte' => [
        'numeric' => ':attribute harus lebih besar dari atau sama dengan :value.',
        'file' => ':attribute harus lebih besar dari atau sama dengan :value kilobytes.',
        'string' => ':attribute harus lebih besar dari atau sama dengan :value karakter.',
        'array' => ':attribute harus memiliki :value item atau lebih.',
    ],
    'image' => ':attribute harus berupa gambar.',
    'in' => ':attribute yang dipilih tidak valid.',
    'in_array' => ':attribute tidak ada di :other.',
    'integer' => ':attribute harus berupa bilangan bulat.',
    'ip' => ':attribute harus berisi IP address yang valid.',
    'ipv4' => ':attribute harus berisi IPv4 address yang valid.',
    'ipv6' => ':attribute harus berisi IPv6 address yang valid.',
    'json' => ':attribute harus berisi JSON string yang valid.',
    'lt' => [
        'numeric' => ':attribute harus kurang dari :value.',
        'file' => ':attribute harus kurang dari :value kilobytes.',
        'string' => ':attribute harus kurang dari :value karakter.',
        'array' => ':attribute harus kurang dari :value item.',
    ],
    'lte' => [
        'numeric' => ':attribute harus kurang dari atau sama dengan :value.',
        'file' => ':attribute harus kurang dari atau sama dengan :value kilobytes.',
        'string' => ':attribute harus kurang dari atau sama dengan :value karakter.',
        'array' => ':attribute tidak boleh lebih dari :value item.',
    ],
    'mac_address' => ':attribute harus berisi MAC address yang valid.',
    'max' => [
        'numeric' => ':attribute tidak boleh lebih besar dari :max.',
        'file' => ':attribute tidak boleh lebih besar dari :max kilobytes.',
        'string' => ':attribute tidak boleh lebih besar dari :max karakter.',
        'array' => ':attribute tidak boleh lebih dari :max item.',
    ],
    'mimes' => ':attribute harus berformat: :values.',
    'mimetypes' => ':attribute harus berformat: :values.',
    'min' => [
        'numeric' => ':attribute minimal berisi :min.',
        'file' => ':attribute minimal berukuran :min kilobytes.',
        'string' => ':attribute harus lebih besar dari :min karakter.',
        'array' => ':attribute harus memiliki setidaknya :min item.',
    ],
    'multiple_of' => ':attribute harus berupa kelipatan dari :value.',
    'not_in' => ':attribute yang dipilih tidak valid.',
    'not_regex' => ':Format attribute tidak valid.',
    'numeric' => ':attribute harus berupa angkat.',
    'password' => 'Kata Sandi salah.',
    'present' => ':attribute harus ada.',
    'prohibited' => ':attribute dilarang.',
    'prohibited_if' => ':attribute dilarang jika :other berisi :value.',
    'prohibited_unless' => ':attribute dilarang kecuali :other ada di :values.',
    'prohibits' => ':attribute field prohibits :other from being present.',
    'regex' => ':Format attribute tidak valid.',
    'required' => ':attribute harus diisi.',
    'required_array_keys' => ':attribute harus berisi masukkan untuk: :values.',
    'required_if' => ':attribute harus diisi jika :other berisi :value.',
    'required_unless' => ':attribute harus diisi kecuali :other ada di :values.',
    'required_with' => ':attribute harus diisi jika :values terisi.',
    'required_with_all' => ':attribute harus diisi jika :values terisi.',
    'required_without' => ':attribute harus diisi jika :values tidak terisi.',
    'required_without_all' => ':attribute harus diisi jika :values tidak terisi.',
    'same' => ':attribute dan :other harus sama.',
    'size' => [
        'numeric' => ':attribute harus berisi :size.',
        'file' => ':attribute harus berisi :size kilobytes.',
        'string' => ':attribute harus berisi :size karakter.',
        'array' => ':attribute harus berisi :size item.',
    ],
    'starts_with' => ':attribute harus dimulai dengan salah satu dari berikut ini: :values.',
    'string' => ':attribute harus berupa string.',
    'timezone' => ':attribute harus zona waktu yang valid.',
    'unique' => ':attribute sudah digunakan.',
    'uploaded' => ':attribute gagal diunggah.',
    'url' => ':attribute harus URL yang valid.',
    'uuid' => ':attribute harus UUID yang valid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'address_1'                     => 'Alamat',
        'address_2'                     => 'RT',
        'address_3'                     => 'RW',
        'birth_date'                    => 'Tanggal Lahir',
        'birth_place'                   => 'Tempat Lahir',
        'category'                      => 'Kategori',
        'current_password'              => 'Kata Sandi Lama',
        'description'                   => 'Deskripsi',
        'description_detail'            => 'Deskripsi',
        'description_document'          => 'Deskripsi Dokumen',
        'document'                      => 'Dokumen',
        'doctor'                        => 'Dokter',
        'email'                         => 'Email',
        'file'                          => 'Dokumen',
        'full_name'                     => 'Nama Lengkap',
        'gender'                        => 'Jenis Kelamin',
        'home_number'                   => 'Nomor Telepon',
        'level'                         => 'Tingkatan',
        'new_password'                  => 'Kata Sandi Baru',
        'new_username'                  => 'Nama Pengguna Baru',
        'nik'                           => 'NIK',
        'password'                      => 'Kata Sandi',
        'phone_number'                  => 'Nomor HP',
        'picture'                       => 'Foto/Gambar',
        'picture_header'                => 'Foto/Gambar Header',
        'religion'                      => 'Agama',
        'repassword'                    => 'Kata Sandi Ulang',
        'role'                          => 'Peran',
        'username'                      => 'Nama Pengguna',
        'title'                         => 'Judul',
        'title_detail'                  => 'Judul',
        'title_document'                => 'Judul Dokumen',
        'video'                         => 'Video',
    ],

];
