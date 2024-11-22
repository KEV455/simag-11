@extends('layouts.base.base-template')

@section('title')
    <title>Dashboard Mahasiswa | SiMagang</title>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            {{-- <li class="breadcrumb-item"><a href="javascript:void(0);">SiMagang</a></li> --}}
                            <li class="breadcrumb-item"><a href="javascript:void(0);">SiMagang</a></li>
                            <li class="breadcrumb-item active">Dashboard </li>
                        </ol><!--end breadcrumb-->
                    </div><!--end /div-->
                    <h4 class="page-title">Dashboard {{ Auth()->user()->role }}</h4>
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->

        <!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    @if (Auth()->user()->role == 'mahasiswa')
                        <div class="col-lg-4">
                            <div class="card hospital-info card-hover card-rounded">
                                <a href="{{ route('mahasiswa.mitra.mandiri.index') }}">
                                    <div class="card-body">
                                        <h4 class="header-title mt-0 mb-3">Pengajuan Mitra Mandiri</h4>
                                        <div class="media">
                                            <div class="data-icon align-self-center">
                                                <i class="fa-solid fa-file-lines rounded-circle text-danger"></i>
                                            </div>
                                            <div class="media-body ml-3 align-self-center text-right">
                                                <h3 class="mt-0">{{ $mitras_mandiri_count }}</h3>
                                                <p class="text-muted mb-0 text-nowrap">Daftar Pengajuan Mitra Mandiri Saya
                                                </p>
                                            </div><!--end media body-->
                                        </div>
                                    </div><!--end card-body-->
                                </a>
                            </div><!--end card-->
                        </div><!-- end col-->
                    @endif

                    @if (Auth()->user()->role == 'mahasiswa')
                        <div class="col-lg-4">
                            <div class="card hospital-info card-hover card-rounded">
                                <a href="{{ route('mahasiswa.daftar.magang.index') }}">
                                    <div class="card-body">
                                        <h4 class="header-title mt-0 mb-3">Daftar Magang</h4>
                                        <div class="media">
                                            <div class="data-icon align-self-center">
                                                <i class="fa-solid fa-briefcase rounded-circle text-primary"></i>
                                            </div>
                                            <div class="media-body ml-3 align-self-center text-right">
                                                <h5 class="mt-0">Cari Lowongan Magang</h5>
                                                <p class="text-muted mb-0 text-nowrap">Pendaftaran Program Magang</p>
                                            </div><!--end media body-->
                                        </div>
                                    </div><!--end card-body-->
                                </a>
                            </div><!--end card-->
                        </div><!-- end col-->
                    @endif

                    @if (Auth()->user()->role == 'mahasiswa')
                        <div class="col-lg-4">
                            <div class="card hospital-info card-hover card-rounded">
                                <a href="{{ route('mahasiswa.permohonan.magang.index') }}">
                                    <div class="card-body">
                                        <h4 class="header-title mt-0 mb-3">Permohonan Magang</h4>
                                        <div class="media">
                                            <div class="data-icon align-self-center">
                                                <i class="fa-solid fa-file-circle-check rounded-circle text-warning"></i>
                                            </div>
                                            <div class="media-body ml-3 align-self-center text-right">
                                                <h3 class="mt-0">{{ $pelamar_magang_count }}</h3>
                                                <p class="text-muted mb-0 text-nowrap">Permohonan Magang Saya</p>
                                            </div><!--end media body-->
                                        </div>
                                    </div><!--end card-body-->
                                </a>
                            </div><!--end card-->
                        </div><!-- end col-->
                    @endif

                    @if (Auth()->user()->role == 'mahasiswa')
                        <div class="col-lg-4">
                            <div class="card hospital-info card-hover card-rounded">
                                <a href="#">
                                    <div class="card-body">
                                        <h4 class="header-title mt-0 mb-3">Log Book Magang</h4>
                                        <div class="media">
                                            <div class="data-icon align-self-center">
                                                <i class="fa-solid fa-person-chalkboard rounded-circle text-success"></i>
                                            </div>
                                            <div class="media-body ml-3 align-self-center text-right">
                                                <h3 class="mt-0">--</h3>
                                                <p class="text-muted mb-0 text-nowrap">Daftar Log Book Magang Saya</p>
                                            </div><!--end media body-->
                                        </div>
                                    </div><!--end card-body-->
                                </a>
                            </div><!--end card-->
                        </div><!-- end col-->
                    @endif

                    @if (Auth()->user()->role == 'mahasiswa')
                        <div class="col-lg-4">
                            <div class="card hospital-info card-hover card-rounded">
                                <a href="#">
                                    <div class="card-body">
                                        <h4 class="header-title mt-0 mb-3">Laporan Akhir</h4>
                                        <div class="media">
                                            <div class="data-icon align-self-center">
                                                <i class="fa-regular fa-folder-open rounded-circle text-purple"></i>
                                            </div>
                                            <div class="media-body ml-3 align-self-center text-right">
                                                <h3 class="mt-0">--</h3>
                                                <p class="text-muted mb-0 text-nowrap">Upload Laporan Akhir Magang</p>
                                            </div><!--end media body-->
                                        </div>
                                    </div><!--end card-body-->
                                </a>
                            </div><!--end card-->
                        </div><!-- end col-->
                    @endif

                </div><!--end row-->
            </div><!--end col-->
        </div><!--end row-->

    </div><!-- container -->
@endsection
