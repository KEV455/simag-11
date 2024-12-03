@extends('layouts.base.base-template')

@section('title')
    <title>Dashboard Dosen Pembimbing | SiMagang</title>
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
                    @if (Auth()->user()->role == 'dospem')
                        {{-- <div class="col-lg-4">
                            <div class="card hospital-info card-hover card-rounded">
                                <a href="#">
                                    <div class="card-body">
                                        <h4 class="header-title mt-0 mb-3">Laporan Akhir</h4>
                                        <div class="media">
                                            <div class="data-icon align-self-center">
                                                <i class="fa-solid fa-folder-open rounded-circle text-purple"></i>
                                            </div>
                                            <div class="media-body ml-3 align-self-center text-right">
                                                <h3 class="mt-0">--</h3>
                                                <p class="text-muted mb-0 text-nowrap">Daftar Laporan Akhir Mahasiswa</p>
                                            </div><!--end media body-->
                                        </div>
                                    </div><!--end card-body-->
                                </a>
                            </div><!--end card-->
                        </div><!-- end col--> --}}
                        <div class="col-lg-4">
                            <a href="{{ route('dospem.mahasiswa.bimbingan.index') }}">
                                <div class="card hospital-info card-hover card-rounded">
                                    <div class="card-body">
                                        <h4 class="header-title mt-0 mb-3">Mahasiswa</h4>
                                        <div class="media">
                                            <div class="data-icon align-self-center">
                                                <i class="fa-solid fa-graduation-cap rounded-circle text-deep-sky-blue"></i>
                                            </div>
                                            <div class="media-body ml-3 align-self-center text-right">
                                                <h3 class="mt-0">{{ $pembimbing_magang_count }}</h3>
                                                <p class="text-muted mb-0 text-nowrap">Daftar Mahasiswa Bimbingan</p>
                                            </div><!--end media body-->
                                        </div>
                                    </div><!--end card-body-->
                                </div><!--end card-->
                            </a>
                        </div><!-- end col-->
                    @endif

                    @if (Auth()->user()->role == 'dospem')
                        <div class="col-lg-4">
                            <div class="card hospital-info card-hover card-rounded">
                                <a href="{{ route('dospem.penilaian.magang.index') }}">
                                    <div class="card-body">
                                        <h4 class="header-title mt-0 mb-3">Penilaian Magang</h4>
                                        <div class="media">
                                            <div class="data-icon align-self-center">
                                                <i class="fa-solid fa-square-poll-vertical rounded-circle text-orange"></i>
                                            </div>
                                            <div class="media-body ml-3 align-self-center text-right">
                                                <h4 class="mt-0">{{ Auth()->user()->name }}</h4>
                                                <p class="text-muted mb-0 text-nowrap">Konversi Nilai Magang Mahasiswa</p>
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
