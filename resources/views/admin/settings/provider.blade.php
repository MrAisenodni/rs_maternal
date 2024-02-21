@extends('layouts.main')

@section('title', $c_menu->title)

@section('styles')
    {{-- Date Picker --}}
    <link href="{{ asset('/assets/plugins/datetimepicker/css/classic.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/plugins/datetimepicker/css/classic.date.css') }}" rel="stylesheet" />

    {{-- Select2 --}}
    <link href="{{ asset('/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
@endsection
    
@section('content')
    <div class="mdk-drawer-layout__content page ">

        <div class="container-fluid page__container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">{{ $c_menu->title }}</li>
            </ol>
            <h1 class="h2">{{ $c_menu->title }}</h1>

            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        @if (session('status'))
                            <div class="col-12">
                                <div class="alert alert-dismissible bg-success text-white border-0 fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>Sukses - </strong> {{ session('status') }}
                                </div>
                            </div>
                        @endif 
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ $c_menu->url }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $detail->id }}">
                                        <h6 class="mb-0 text-uppercase">Data Perusahaan</h6>
                                        <hr/>
                                        <div class="row mb-2">
                                            <div class="col-3">
                                                <div class="row mb-2">
                                                    <div class="col-12">
                                                        <label class="form-label" for="provider_logo">Logo Perusahaan</label>
                                                        <span class="desc"></span>
                                                        <img id="show_logo" class="img-fluid" src="{{ asset('/storage/'.$detail->provider_logo) }}" alt="" style="max-width:100%;">
                                                        <input type="hidden" name="old_provider_logo" value="{{ $detail->provider_logo }}">
                                                        <input type="file" class="form-control @error('provider_logo') is-invalid @enderror" id="image" name="provider_logo" value="{{ old('provider_logo', $detail->provider_logo) }}" onchange="readURLLogo(this)">
                                                        @error('provider_logo')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label" for="provider_picture">Label Perusahaan</label>
                                                        <span class="desc"></span>
                                                        <img id="show_picture" class="img-preview img-fluid mb-2" src="{{ asset('/storage/'.$detail->provider_picture) }}" alt="" style="max-width:100%;">
                                                        <input type="hidden" name="old_provider_picture" value="{{ $detail->provider_picture }}">
                                                        <input type="file" class="form-control @error('provider_picture') is-invalid @enderror" id="image" name="provider_picture" value="{{ old('provider_picture', $detail->provider_picture) }}" onchange="readURLPicture(this)">
                                                        @error('provider_picture')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="row mb-2">
                                                    <div class="col-3">
                                                        <label class="form-label" for="provider_npwp">NPWP Perusahaan</label>
                                                        <input type="text" class="form-control @error('provider_npwp') is-invalid @enderror" id="provider_npwp" name="provider_npwp" value="{{ old('provider_npwp', $detail->provider_npwp) }}">
                                                        @error('provider_npwp')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-9">
                                                        <label class="form-label" for="provider_name">Nama Perusahaan</label>
                                                        <input type="text" class="form-control @error('provider_name') is-invalid @enderror" id="provider_name" name="provider_name" value="{{ old('provider_name', $detail->provider_name) }}">
                                                        @error('provider_name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-3">
                                                        <label class="form-label" for="provider_birth_place">Tempat Didirikan</label>
                                                        <input type="text" class="form-control @error('provider_birth_place') is-invalid @enderror" id="provider_birth_place" name="provider_birth_place" value="{{ old('provider_birth_place', $detail->provider_birth_place) }}">
                                                        @error('provider_birth_place')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-3">
                                                        <label class="form-label" for="provider_birth_date">Tanggal Didirikan</label>
                                                        <input type="date" class="form-control @error('provider_birth_date') is-invalid @enderror" id="provider_birth_date" name="provider_birth_date" value="{{ old('provider_birth_date', date('d/m/Y', strtotime($detail->provider_birth_date))) }}">
                                                        @error('provider_birth_date')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label" for="provider_email">Email</label>
                                                        <input type="text" class="form-control @error('provider_email') is-invalid @enderror" id="provider_email" name="provider_email" value="{{ old('provider_email', $detail->provider_email) }}">
                                                        @error('provider_email')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-6">
                                                        <label class="form-label" for="provider_phone_number">Nomor HP</label>
                                                        <input type="text" class="form-control @error('provider_phone_number') is-invalid @enderror" id="provider_phone_number" name="provider_phone_number" value="{{ old('provider_phone_number', $detail->provider_phone_number) }}">
                                                        @error('provider_phone_number')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label" for="provider_home_number">Nomor Telepon</label>
                                                        <input type="text" class="form-control @error('provider_home_number') is-invalid @enderror" id="provider_home_number" name="provider_home_number" value="{{ old('provider_home_number', $detail->provider_home_number) }}">
                                                        @error('provider_home_number')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-12">
                                                        <label class="form-label" for="provider_address">Alamat</label>
                                                        <textarea name="provider_address" id="provider_address" class="form-control" cols="30" rows="10">{!! old('provider_address', $detail->provider_address) !!}</textarea>
                                                        @error('provider_address')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-6">
                                                        <label class="form-label" for="provider_district">Kecamatan</label>
                                                        <select class="select-min form-control @error('provider_district') is-invalid @enderror" id="provider_district" name="provider_district">
                                                            <option value="">=== SILAHKAN PILIH ===</option>
                                                            @if ($districts)
                                                                @foreach ($districts as $district)
                                                                    <option value="{{ $district->id }}" @if ($district->id == $detail->provider_district_id) selected @endif>{{ $district->name }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        @error('provider_district')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label" for="provider_ward">Kelurahan</label>
                                                        <input type="text" class="form-control @error('provider_ward') is-invalid @enderror" id="provider_ward" name="provider_ward" value="{{ old('provider_ward', $detail->provider_ward) }}">
                                                        @error('provider_ward')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            @if ($detail->social_media)
                                                @if ($detail->social_media->count() % 4 == 0)
                                                    @foreach ($detail->social_media as $item)
                                                        <div class="col-3 mb-2">
                                                            <div class="form-group">
                                                                <div class="input-group input-group-merge">
                                                                    <input type="text" class="form-control form-control-prepended @error('social'.$item->id) is-invalid @enderror" id="social{{ $item->id }}" name="social{{ $item->id }}" value="{{ old('social'.$item->id, ($item->link) ? $item->link : 'NA') }}">
                                                                    @error('social'.$item->id)
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">
                                                                            <span class="{{ $item->icon_1 }}"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @elseif ($detail->social_media->count() % 3 == 0)
                                                    @foreach ($detail->social_media as $item)
                                                        <div class="col-4 mb-2">
                                                            <div class="form-group">
                                                                <div class="input-group input-group-merge">
                                                                    <input type="text" class="form-control form-control-prepended @error('social'.$item->id) is-invalid @enderror" id="social{{ $item->id }}" name="social{{ $item->id }}" value="{{ old('social'.$item->id, ($item->link) ? $item->link : 'NA') }}">
                                                                    @error('social'.$item->id)
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">
                                                                            <span class="{{ $item->icon_1 }}"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @elseif ($detail->social_media->count() % 2 == 0)
                                                    @foreach ($detail->social_media as $item)
                                                        <div class="col-6 mb-2">
                                                            <div class="form-group">
                                                                <div class="input-group input-group-merge">
                                                                    <input type="text" class="form-control form-control-prepended @error('social'.$item->id) is-invalid @enderror" id="social{{ $item->id }}" name="social{{ $item->id }}" value="{{ old('social'.$item->id, ($item->link) ? $item->link : 'NA') }}">
                                                                    @error('social'.$item->id)
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">
                                                                            <span class="{{ $item->icon_1 }}"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    @foreach ($detail->social_media as $item)
                                                        <div class="col-12 mb-2">
                                                            <div class="form-group">
                                                                <div class="input-group input-group-merge">
                                                                    <input type="text" class="form-control form-control-prepended @error('social'.$item->id) is-invalid @enderror" id="social{{ $item->id }}" name="social{{ $item->id }}" value="{{ old('social'.$item->id, ($item->link) ? $item->link : 'NA') }}">
                                                                    @error('social'.$item->id)
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">
                                                                            <span class="{{ $item->icon_1 }}"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            @endif
                                        </div>
                                        <hr>
                                        <h6 class="mb-0 text-uppercase">Data Pemilik Perusahaan</h6>
                                        <hr>
                                        <div class="row mb-2">
                                            <div class="col-3">
                                                <label class="form-label" for="owner_npwp">NPWP</label>
                                                <input type="text" class="form-control @error('owner_npwp') is-invalid @enderror" id="owner_npwp" name="owner_npwp" value="{{ old('owner_npwp', $detail->owner_npwp) }}">
                                                @error('owner_npwp')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-3">
                                                <label class="form-label" for="owner_nik">NIK</label>
                                                <input type="text" class="form-control @error('owner_nik') is-invalid @enderror" id="owner_nik" name="owner_nik" value="{{ old('owner_nik', $detail->owner_nik) }}">
                                                @error('owner_nik')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label" for="owner_name">Nama Lengkap</label>
                                                <input type="text" class="form-control @error('owner_name') is-invalid @enderror" id="owner_name" name="owner_name" value="{{ old('owner_name', $detail->owner_name) }}">
                                                @error('owner_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-3">
                                                <label class="form-label" for="owner_birth_place">Tempat Lahir</label>
                                                <input type="text" class="form-control @error('owner_birth_place') is-invalid @enderror" id="owner_birth_place" name="owner_birth_place" value="{{ old('owner_birth_place', $detail->owner_birth_place) }}">
                                                @error('owner_birth_place')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-3">
                                                <label class="form-label" for="owner_birth_date">Tanggal Lahir</label>
                                                <input type="date" class="form-control @error('owner_birth_date') is-invalid @enderror" id="owner_birth_date" name="owner_birth_date" value="{{ old('owner_birth_date', date('d/m/Y', strtotime($detail->owner_birth_date))) }}">
                                                @error('owner_birth_date')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label" for="owner_email">Email</label>
                                                <input type="text" class="form-control @error('owner_email') is-invalid @enderror" id="owner_email" name="owner_email" value="{{ old('owner_email', $detail->owner_email) }}">
                                                @error('owner_email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6">
                                                <label class="form-label" for="owner_phone_number">Nomor HP</label>
                                                <input type="text" class="form-control @error('owner_phone_number') is-invalid @enderror" id="owner_phone_number" name="owner_phone_number" value="{{ old('owner_phone_number', $detail->owner_phone_number) }}">
                                                @error('owner_phone_number')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label" for="owner_home_number">Nomor Telepon</label>
                                                <input type="text" class="form-control @error('owner_home_number') is-invalid @enderror" id="owner_home_number" name="owner_home_number" value="{{ old('owner_home_number', $detail->owner_home_number) }}">
                                                @error('owner_home_number')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                <label class="form-label" for="owner_address_1">Alamat</label>
                                                <textarea name="owner_address_1" id="owner_address_1" class="form-control" cols="30" rows="10">{!! old('owner_address_1', $detail->owner_address_1) !!}</textarea>
                                                @error('owner_address_1')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-1">
                                                <label class="form-label" for="owner_address_2">RT</label>
                                                <input type="text" class="form-control @error('owner_address_2') is-invalid @enderror" id="owner_address_2" name="owner_address_2" value="{{ old('owner_address_2', $detail->owner_address_2) }}">
                                                @error('owner_address_2')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-1">
                                                <label class="form-label" for="owner_address_3">RW</label>
                                                <input type="text" class="form-control @error('owner_address_3') is-invalid @enderror" id="owner_address_3" name="owner_address_3" value="{{ old('owner_address_3', $detail->owner_address_3) }}">
                                                @error('owner_address_3')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-5">
                                                <label class="form-label" for="owner_district">Kecamatan</label>
                                                <select class="select-min form-control @error('owner_district') is-invalid @enderror" id="owner_district" name="owner_district">
                                                    <option value="">=== SILAHKAN PILIH ===</option>
                                                    @if ($districts)
                                                        @foreach ($districts as $district)
                                                            <option value="{{ $district->id }}" @if ($district->id == $detail->owner_district_id) selected @endif>{{ $district->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('owner_district')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-5">
                                                <label class="form-label" for="owner_ward">Kelurahan</label>
                                                <input type="text" class="form-control @error('owner_ward') is-invalid @enderror" id="owner_ward" name="owner_ward" value="{{ old('owner_ward', $detail->owner_ward) }}">
                                                @error('owner_ward')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12" style="text-align: right">
                                                <button type="submit" class="btn btn-success">SIMPAN</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- Date Picker --}}
    <script src="{{ asset('/assets/plugins/datetimepicker/js/legacy.js') }}"></script>
    <script src="{{ asset('/assets/plugins/datetimepicker/js/picker.js') }}"></script>
    <script src="{{ asset('/assets/plugins/datetimepicker/js/picker.date.js') }}"></script>
    <script src="{{ asset('/assets/js/form-date-time-pickes.js') }}"></script>

    {{-- Select2 --}}
    <script src="{{ asset('/assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('/assets/js/form-select2.js') }}"></script>

    <script>
        // For Upload Picture
        function readURLLogo(input) 
        {
            if (input.files && input.files[0])
            {
                var reader = new FileReader()
    
                reader.onload = function (e) 
                {
                    $('#show_logo').attr('src', e.target.result)
                }
    
                reader.readAsDataURL(input.files[0])
            }
        }
        function readURLPicture(input) 
        {
            if (input.files && input.files[0])
            {
                var reader = new FileReader()
    
                reader.onload = function (e) 
                {
                    $('#show_picture').attr('src', e.target.result)
                }
    
                reader.readAsDataURL(input.files[0])
            }
        }
    </script>
@endsection