@extends('layouts.base.base-template')

@section('title')
    <title>Detail Lowongan | SiMagang</title>
@endsection

@section('top-css')
    <link href="{{ asset('template/assets/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/assets/css/style.css') }}" rel="stylesheet" type="text/css" />\
@endsection

@php
    function dateConversion($date)
    {
        $month = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];
        $slug = explode('-', $date);
        return $slug[2] . ' ' . $month[(int) $slug[1]] . ' ' . $slug[0];
    }
@endphp

@section('content')
    <div class="container-fluid">
        <!-- Page-Title -->
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            {{-- <li class="breadcrumb-item"><a href="javascript:void(0);">SiMagang</a></li> --}}
                            <li class="breadcrumb-item"><a href="javascript:void(0);">SiMagang</a></li>
                            <li class="breadcrumb-item active">Detail Lowongan </li>
                        </ol><!--end breadcrumb-->
                    </div><!--end /div-->
                    <h4 class="page-title">Detail Lowongan</h4>
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="met-basic-detail">
                            <div class="d-flex align-items-center">
                                <div>
                                    @if ($lowongan->mitra->foto)
                                        <img width="150" class="img-thumbnail img-fluid rounded-circle main-widgets-icon"
                                            src="{{ asset('storage/' . $lowongan->mitra->foto) }}" alt="Foto Mitra"
                                            title="Foto {{ $lowongan->mitra->nama }}">
                                    @else
                                        <img width="150" class="img-thumbnail img-fluid rounded-circle main-widgets-icon"
                                            src="{{ asset('images/profile-picture.jpg') }}" alt="Foto Mitra"
                                            title="Foto {{ $lowongan->mitra->nama }}">
                                    @endif

                                </div>

                                <div class="ml-3">
                                    <h3>{{ $lowongan->mitra->nama }}</h3>
                                    <p class="text-uppercase font-14">
                                        <i class="fa-solid fa-briefcase"></i>&ensp;
                                        {{ $lowongan->nama }} ({{ $lowongan->jumlah_lowongan }} Kuota)
                                    </p>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-6">
                                    {{-- Mitra --}}
                                    <h4 class="bg-success text-white py-2 px-3 rounded mb-3">Informasi Mitra</h4>
                                    <span class="font-14">
                                        <i class="fa-solid fa-user-tag"></i>&ensp;
                                        {{ $lowongan->mitra->narahubung }}
                                    </span><br>
                                    <span class="text-lowercase font-14">
                                        <i class="fa-solid fa-envelope"></i>&ensp;
                                        {{ $lowongan->mitra->email }}
                                    </span><br>
                                    <span class="text-lowercase font-14">
                                        <i class="fa-solid fa-globe"></i>&ensp;
                                        @if ($lowongan->mitra->website)
                                            @php
                                                $website = $lowongan->mitra->website;
                                                // Tambahkan protokol jika tidak ada
                                                if (!preg_match('/^(http|https):\/\//', $website)) {
                                                    $website = 'http://' . $website;
                                                }
                                            @endphp
                                            <a href="{{ $website }}" target="_blank" class="text-primary">
                                                {{ $lowongan->mitra->website }}
                                            </a>
                                        @else
                                            Belum ditambahkan
                                        @endif
                                    </span><br>
                                    <span class="text-uppercase font-14">
                                        <i class="fa-solid fa-location-dot"></i>&ensp;
                                        {{ $lowongan->mitra->kota }} - {{ $lowongan->mitra->provinsi }}
                                    </span><br>
                                    <span class="text-uppercase font-14">
                                        <i class="fa-solid fa-map-location-dot"></i>&ensp;
                                        {{ $lowongan->mitra->alamat }}
                                    </span><br>
                                </div>
                                <div class="col-md-6">
                                    {{-- Lowongan --}}
                                    <h4 class="bg-secondary text-white py-2 px-3 rounded mb-3">Informasi Lowongan</h4>
                                    <span>
                                        <i class="fa-regular fa-calendar-check"></i>&ensp;
                                        Pendaftaran dibuka hingga :
                                        {{ dateConversion($lowongan->tanggal_dibuka) }}
                                        -
                                        {{ dateConversion($lowongan->tanggal_ditutup) }}
                                    </span><br>
                                    <span>
                                        <i class="fa-solid fa-calendar-check"></i>&ensp;
                                        Magang Aktif dari :
                                        {{ dateConversion($lowongan->tanggal_magang_dimulai) }}
                                        -
                                        {{ dateConversion($lowongan->tanggal_magang_ditutup) }}
                                    </span><br><br>
                                    <p class="text-muted font-14">
                                        {{ $lowongan->deskripsi }}
                                    </p>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><b>Terbuka untuk Program Studi :</b></p>
                                    <ol>
                                        @if ($lowongan_prodis->count())
                                            @foreach ($lowongan_prodis as $dataLowonganProdi)
                                                <li>
                                                    {{ $dataLowonganProdi->prodi->jenjang_pendidikan }}
                                                    {{ $dataLowonganProdi->prodi->nama_program_studi }}
                                                </li>
                                            @endforeach
                                        @else
                                            <li>-</li>
                                        @endif
                                    </ol>
                                </div>
                                <div class="col-md-6">
                                    <p><b>Persyaratan Berkas :</b></p>
                                    <ol>
                                        @if ($berkas_lowongans->count())
                                            @foreach ($berkas_lowongans as $dataBerkas)
                                                <li>
                                                    {{ $dataBerkas->berkas->nama_berkas }}
                                                </li>
                                            @endforeach
                                        @else
                                            <li>-</li>
                                        @endif
                                    </ol>
                                </div>
                            </div>

                            <div class="my-3">
                                @if ($prodiMhsAvailable)
                                    <a href="#" class="btn btn-success px-3">Daftar Sekarang&ensp;<i
                                            class="fa-solid fa-right-to-bracket"></i></a>
                                @else
                                    <a href="{{ url()->previous() }}" class="btn btn-outline-danger px-3">Anda Tidak Bisa
                                        Mendaftar</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->
    </div><!-- container -->
@endsection

@section('bottom-script')
    <!-- jQuery  -->
    <script src="{{ asset('template/assets/js/jquery.min.js') }}"></script>

    <!-- Plugins js -->
    <script src="{{ asset('template/assets/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('template/assets/plugins/moment/moment.js') }}"></script>
    <script src="{{ asset('template/assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('template/assets/pages/jquery.forms-advanced.js') }}"></script>
@endsection
