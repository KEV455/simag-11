@extends('layouts.base.base-template')

@section('title')
    <title>Dashboard DPL | SiMagang</title>
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
                    @if (Auth()->user()->role == 'dpl')
                        <div class="col-lg-4">
                            <div class="card hospital-info card-hover card-rounded">
                                <a href="{{ route('profile.dpl.index') }}">
                                    <div class="card-body">
                                        <h4 class="header-title mt-0 mb-3">Ubah Biodata</h4>
                                        <div class="media">
                                            <div class="data-icon align-self-center">
                                                <i class="fa-solid fa-address-card rounded-circle text-primary"></i>
                                            </div>
                                            <div class="media-body ml-3 align-self-center text-right">
                                                <h5 class="mt-0">{{ Auth()->user()->name }}</h5>
                                                <p class="text-muted mb-0 text-nowrap">Informasi Pribadi Saya</p>
                                            </div><!--end media body-->
                                        </div>
                                    </div><!--end card-body-->
                                </a>
                            </div><!--end card-->
                        </div><!-- end col-->
                    @endif

                    @if (Auth()->user()->role == 'dpl')
                        <div class="col-lg-4">
                            <div class="card hospital-info card-hover card-rounded">
                                <a href="{{ route('dpl.nilai.dpl.index') }}">
                                    <div class="card-body">
                                        <h4 class="header-title mt-0 mb-3">Penilaian Magang</h4>
                                        <div class="media">
                                            <div class="data-icon align-self-center">
                                                <i class="fa-solid fa-check-double rounded-circle text-orange"></i>
                                            </div>
                                            <div class="media-body ml-3 align-self-center text-right">
                                                <h5 class="mt-0">{{ $dpl_mitra->mitra->nama }}</h5>
                                                <p class="text-muted mb-0 text-nowrap">Kelola Nilai Magang Mitra</p>
                                            </div><!--end media body-->
                                        </div>
                                    </div><!--end card-body-->
                                </a>
                            </div><!--end card-->
                        </div><!-- end col-->
                    @endif
                    @if (Auth()->user()->role == 'dpl')
                        <div class="col-lg-4">
                            <div class="card hospital-info card-hover card-rounded">
                                <a href="{{ route('dpl.validasi.logbook.index') }}">
                                    <div class="card-body">
                                        <h4 class="header-title mt-0 mb-3">Log Book Magang</h4>
                                        <div class="media">
                                            <div class="data-icon align-self-center">
                                                <i class="fa-solid fa-person-chalkboard rounded-circle text-success"></i>
                                            </div>
                                            <div class="media-body ml-3 align-self-center text-right">
                                                <h4 class="mt-0">{{ $dpl_mitra->mitra->nama }}</h4>
                                                <p class="text-muted mb-0 text-nowrap">Daftar Log Book Magang Mahasiswa</p>
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
