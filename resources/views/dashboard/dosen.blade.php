@extends('layouts.base.base-template')

@section('title')
    <title>Dashboard Dosen | SiMagang</title>
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
                    @if (Auth()->user()->role == 'dosen')
                        <div class="col-lg-4">
                            <div class="card hospital-info card-hover card-rounded">
                                <a href="#">
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

                </div><!--end row-->
            </div><!--end col-->
        </div><!--end row-->

    </div><!-- container -->
@endsection
