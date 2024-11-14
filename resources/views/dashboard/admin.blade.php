@extends('layouts.base.base-template')

@section('title')
    <title>Dashboard Admin | SiMagang</title>
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
                    <div class="col-lg-4">
                        <div class="card hospital-info card-hover">
                            <div class="card-body">
                                <h4 class="header-title mt-0 mb-3">Mitra</h4>
                                <div class="media">
                                    <div class="data-icon align-self-center">
                                        <i class="fa-solid fa-handshake rounded-circle text-primary"></i>
                                    </div>
                                    <div class="media-body ml-3 align-self-center text-right">
                                        <h3 class="mt-0">40</h3>
                                        <p class="text-muted mb-0 text-nowrap">Daftar Mitra</p>
                                    </div><!--end media body-->
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!-- end col-->

                    <div class="col-lg-4">
                        <div class="card hospital-info card-hover">
                            <div class="card-body card-hover">
                                <h4 class="header-title mt-0 mb-3">Lowongan</h4>
                                <div class="media">
                                    <div class="data-icon align-self-center">
                                        <i class="fa-solid fa-clipboard-list rounded-circle text-success"></i>
                                    </div>
                                    <div class="media-body ml-3 align-self-center text-right">
                                        <h3 class="mt-0">21</h3>
                                        <p class="text-muted mb-0 text-nowrap">Daftar Lowongan</p>
                                    </div><!--end media body-->
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!-- end col-->

                    <div class="col-lg-4">
                        <div class="card hospital-info card-hover">
                            <div class="card-body">
                                <h4 class="header-title mt-0 mb-3">Mitra Mandiri</h4>
                                <div class="media">
                                    <div class="data-icon align-self-center">
                                        <i class="fa-solid fa-handshake-angle rounded-circle text-bg-info"></i>
                                    </div>
                                    <div class="media-body ml-3 align-self-center text-right">
                                        <h3 class="mt-0">10</h3>
                                        <p class="text-muted mb-0 text-nowrap">Daftar Mitra Mandiri</p>
                                    </div><!--end media body-->
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!-- end col-->

                    <div class="col-lg-4">
                        <div class="card hospital-info card-hover">
                            <div class="card-body">
                                <h4 class="header-title mt-0 mb-3">Permohonan Magang</h4>
                                <div class="media">
                                    <div class="data-icon align-self-center">
                                        <i class="fa-solid fa-user-plus rounded-circle text-warning"></i>
                                    </div>
                                    <div class="media-body ml-3 align-self-center text-right">
                                        <h3 class="mt-0">15</h3>
                                        <p class="text-muted mb-0 text-nowrap">Daftar Pelamar Magang</p>
                                    </div><!--end media body-->
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!-- end col-->

                    <div class="col-lg-4">
                        <div class="card hospital-info card-hover">
                            <div class="card-body">
                                <h4 class="header-title mt-0 mb-3">Berkas Persyaratan</h4>
                                <div class="media">
                                    <div class="data-icon align-self-center">
                                        <i class="fa-solid fa-folder-open rounded-circle text-danger"></i>
                                    </div>
                                    <div class="media-body ml-3 align-self-center text-right">
                                        <h3 class="mt-0">40</h3>
                                        <p class="text-muted mb-0 text-nowrap">Kelola Berkas Magang</p>
                                    </div><!--end media body-->
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!-- end col-->

                    <div class="col-lg-4">
                        <div class="card hospital-info card-hover">
                            <a href="{{ route('admin.jurusan.index') }}">
                                <div class="card-body">
                                    <h4 class="header-title mt-0 mb-3">Jurusan</h4>
                                    <div class="media">
                                        <div class="data-icon align-self-center">
                                            <i class="fa-solid fa-building-columns rounded-circle text-pink"></i>
                                        </div>
                                        <div class="media-body ml-3 align-self-center text-right">
                                            <h3 class="mt-0">{{ $jurusan_count }}</h3>
                                            <p class="text-muted mb-0 text-nowrap">Daftar Jurusan</p>
                                        </div><!--end media body-->
                                    </div>
                                </div><!--end card-body-->
                            </a>
                        </div><!--end card-->
                    </div><!-- end col-->

                    <div class="col-lg-4">
                        <div class="card hospital-info card-hover">
                            <a href="{{ route('admin.prodi.index') }}">
                                <div class="card-body">
                                    <h4 class="header-title mt-0 mb-3">Program Studi</h4>
                                    <div class="media">
                                        <div class="data-icon align-self-center">
                                            <i class="fa-solid fa-school rounded-circle text-orange"></i>
                                        </div>
                                        <div class="media-body ml-3 align-self-center text-right">
                                            <h3 class="mt-0">{{ $prodi_count }}</h3>
                                            <p class="text-muted mb-0 text-nowrap">Daftar Prodi</p>
                                        </div><!--end media body-->
                                    </div>
                                </div><!--end card-body-->
                            </a>
                        </div><!--end card-->
                    </div><!-- end col-->

                    <div class="col-lg-4">
                        <div class="card hospital-info card-hover">
                            <div class="card-body">
                                <h4 class="header-title mt-0 mb-3">Dosen</h4>
                                <div class="media">
                                    <div class="data-icon align-self-center">
                                        <i class="fa-solid fa-user-graduate rounded-circle text-blue-violet"></i>
                                    </div>
                                    <div class="media-body ml-3 align-self-center text-right">
                                        <h3 class="mt-0">10</h3>
                                        <p class="text-muted mb-0 text-nowrap">Daftar Dosen</p>
                                    </div><!--end media body-->
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!-- end col-->

                    <div class="col-lg-4">
                        <div class="card hospital-info card-hover">
                            <div class="card-body">
                                <h4 class="header-title mt-0 mb-3">Mahasiswa</h4>
                                <div class="media">
                                    <div class="data-icon align-self-center">
                                        <i class="fa-solid fa-graduation-cap rounded-circle text-deep-sky-blue"></i>
                                    </div>
                                    <div class="media-body ml-3 align-self-center text-right">
                                        <h3 class="mt-0">10</h3>
                                        <p class="text-muted mb-0 text-nowrap">Daftar Mahasiswa</p>
                                    </div><!--end media body-->
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!-- end col-->

                </div><!--end row-->
            </div><!--end col-->
        </div><!--end row-->

    </div><!-- container -->
@endsection
