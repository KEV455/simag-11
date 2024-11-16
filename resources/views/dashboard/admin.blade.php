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

                    @if (Auth()->user()->role == 'admin')
                        <div class="col-lg-4">
                            <div class="card hospital-info card-hover card-rounded">
                                <a href="{{ route('admin.koordinator.index') }}">
                                    <div class="card-body">
                                        <h4 class="header-title mt-0 mb-3">Koordinator</h4>
                                        <div class="media">
                                            <div class="data-icon align-self-center">
                                                <i class="fa-solid fa-user-tie rounded-circle text-success"></i>
                                            </div>
                                            <div class="media-body ml-3 align-self-center text-right">
                                                <h3 class="mt-0">{{ $koordinator_count }}</h3>
                                                <p class="text-muted mb-0 text-nowrap">Daftar Koordinator</p>
                                            </div><!--end media body-->
                                        </div>
                                    </div><!--end card-body-->
                                </a>
                            </div><!--end card-->
                        </div><!-- end col-->
                    @endif

                    @if (Auth()->user()->role == 'admin')
                        <div class="col-lg-4">
                            <div class="card hospital-info card-hover card-rounded">
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
                    @endif

                    @if (Auth()->user()->role == 'admin')
                        <div class="col-lg-4">
                            <div class="card hospital-info card-hover card-rounded">
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
                    @endif

                    @if (Auth()->user()->role == 'admin')
                        <div class="col-lg-4">
                            <a href="{{ route('admin.kaprodi.index') }}">
                                <div class="card hospital-info card-hover card-rounded">
                                    <div class="card-body">
                                        <h4 class="header-title mt-0 mb-3">Kaprodi</h4>
                                        <div class="media">
                                            <div class="data-icon align-self-center">
                                                <i class="fa-solid fa-user-graduate rounded-circle text-salmon"></i>
                                            </div>
                                            <div class="media-body ml-3 align-self-center text-right">
                                                <h3 class="mt-0">{{ $kaprodi_count }}</h3>
                                                <p class="text-muted mb-0 text-nowrap">Daftar Kaprodi</p>
                                            </div><!--end media body-->
                                        </div>
                                    </div><!--end card-body-->
                                </div><!--end card-->
                            </a>
                        </div><!-- end col-->
                    @endif

                    @if (Auth()->user()->role == 'admin')
                        <div class="col-lg-4">
                            <a href="{{ route('admin.dosen.index') }}">
                                <div class="card hospital-info card-hover card-rounded">
                                    <div class="card-body">
                                        <h4 class="header-title mt-0 mb-3">Dosen</h4>
                                        <div class="media">
                                            <div class="data-icon align-self-center">
                                                <i class="fa-solid fa-user-graduate rounded-circle text-blue-violet"></i>
                                            </div>
                                            <div class="media-body ml-3 align-self-center text-right">
                                                <h3 class="mt-0">{{ $dosen_count }}</h3>
                                                <p class="text-muted mb-0 text-nowrap">Daftar Dosen</p>
                                            </div><!--end media body-->
                                        </div>
                                    </div><!--end card-body-->
                                </div><!--end card-->
                            </a>
                        </div><!-- end col-->
                    @endif

                    @if (Auth()->user()->role == 'admin')
                        <div class="col-lg-4">
                            <a href="{{ route('admin.mahasiswa.index') }}">
                                <div class="card hospital-info card-hover card-rounded">
                                    <div class="card-body">
                                        <h4 class="header-title mt-0 mb-3">Mahasiswa</h4>
                                        <div class="media">
                                            <div class="data-icon align-self-center">
                                                <i class="fa-solid fa-graduation-cap rounded-circle text-deep-sky-blue"></i>
                                            </div>
                                            <div class="media-body ml-3 align-self-center text-right">
                                                <h3 class="mt-0">{{ $mahasiswa_count }}</h3>
                                                <p class="text-muted mb-0 text-nowrap">Daftar Mahasiswa</p>
                                            </div><!--end media body-->
                                        </div>
                                    </div><!--end card-body-->
                                </div><!--end card-->
                            </a>
                        </div><!-- end col-->
                    @endif

                </div><!--end row-->
            </div><!--end col-->
        </div><!--end row-->

    </div><!-- container -->
@endsection
