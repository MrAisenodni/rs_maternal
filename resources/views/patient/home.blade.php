@extends('layouts.main')

@section('title', $c_menu->title)

@section('styles')
    {{-- Data Table --}}
    <link href="{{ asset('/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection
    
@section('content')
    <div class="mdk-drawer-layout__content page ">

        <div class="container-fluid page__container" style="max-width: 1075px">
            <ol class="breadcrumb">
                {{-- <li class="breadcrumb-item"><a href="/">Home</a></li> --}}
                <li class="breadcrumb-item active">{{ $c_menu->title }}</li>
            </ol>
            <h1 class="h2">Home</h1>

            {{-- Home Page --}}
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8 pr-5">
                            <img src="{{ asset('/storage/pictures/GERBANG Rumah Sakit Islam.png') }}" alt="image" class="mb-3" style="max-width: 100%">
                            <h3>E-Learning</h3>
                            <blockquote>
                                <p>E-Learning adalah proses pembelajaran yang menggunakan teknologi internet untuk memfasilitasi, menyampaikan, dan memungkinkan berjalannya proses pembelajaran jarak jauh.</p>
                            </blockquote>
                            <hr>
                            <h3>Visi</h3>
                            <blockquote>
                                <p>RSIJ Cempaka Putih "Menjadi Rumah Sakit Kepercayaan Masyarakat yang&nbsp;Unggul, Islami, dan Tangguh"</p>
                            </blockquote>
                            <hr>
                            <h3>Misi</h3>
                            <ul>
                                <li>Pelayanan kesehatan yang islami, profesional dan bermutu dengan tetap peduli pada kaum dhu’afa.</li>
                                <li>Mampu memimpin pengembangan Rumah Sakit Islam lainnya.</li>
                                <li>Mampu menyelenggarakan Pendidikan Kedokteran dan Kedokteran Spesialis serta Perkaderan bagi tenaga kesehatan lainnya.</li>
                                <li>Mewujudkan Tatakelola Manajemen Rumah Sakit yang Sustainable didukung oleh Tatakelola keuangan yang Akuntable.</li>
                                <li>Mampu mengembangkan Sinergitas Aliansi RSIJ.</li>
                            </ul>
                            <hr>
                            <h3>Motto</h3>
                            <blockquote>
                                <p>"Bekerja sebagai ibadah, Ihsan dalam pelayanan"</p>
                            </blockquote>
                            <hr>
                            <h3>Falsafah</h3>
                            <blockquote>
                                <p>Rumah Sakit Islam Jakarta adalah perwujudan dari Iman sebagai amal shaleh kepada ALLAH SWT dan menjadikannya sebagai sarana ibadah.</p>
                            </blockquote>
                            <hr>
                            <h3>Tujuan</h3>
                            <ul>
                                <li>Penyelenggaraan Pelayanan kesehatan di RSIJ Cempaka Putih bertujuan meningkatkan kualitaspelayanan kesehatan rujukan menuju RSIJ Cempaka Putih Unggul.</li>
                            </ul>
                        </div>
                        <div class="col-4">
                            <img src="{{ asset('/storage/pictures/rsi-wa-bpjs.png') }}" alt="image" style="max-width: 100%">
                            <img src="{{ asset('/storage/pictures/rsi-wa-umum-asuransi-perusahaan.png') }}" alt="image" style="max-width: 100%">
                            <a href="http://www.rsi.co.id/syarat-dan-ketentuan-pendaftaran-pasien-rawat-jalan-via-whatsapp" style="
                                font-size:80%; 
                                text-align:right; 
                                color: #257a32;
                                text-decoration: none;
                                -moz-transition: all 0.3s;
                                -webkit-transition: all 0.3s;
                                transition: all 0.3s;"
                            >Syarat dan Ketentuan</a>
                            <img src="{{ asset('/storage/pictures/klinik_vaksin_3.png') }}" alt="image" class="mb-3 mt-4" style="max-width: 100%">
                            <img src="{{ asset('/storage/pictures/rsijtv2015.png') }}" alt="image" class="mb-3" style="max-width: 100%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- Data Table --}}
    <script src="{{ asset('/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/assets/js/table-datatable.js') }}"></script>
@endsection