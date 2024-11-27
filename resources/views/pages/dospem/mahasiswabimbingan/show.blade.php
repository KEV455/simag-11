@extends('layouts.base.base-template')

@section('title')
    <title>Manajemen Mahasiswa | SiMagang</title>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Manajemen Mahasiswa Magang</h4>
                </div>
            </div>
        </div>

        <!--begin row-->
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mt-0 mb-3">Experience</h4>
                        <div class="slimscroll education-activity">
                            <div class="activity">
                                <i class="mdi mdi-school icon-success"></i>
                                <div class="time-item">
                                    <div class="item-info">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="m-0">Oxford University</h6>
                                            <span class="text-muted">Oct-2009 to Oct-2011</span>
                                        </div>
                                        <p class="text-muted mt-3">There are many variations of passages of Lorem
                                            Ipsum
                                            available, but the majority have suffered alteration.
                                            <a href="#" class="text-info">[more info]</a>
                                        </p>
                                        <div>
                                            <span class="badge badge-soft-secondary">Design</span>
                                            <span class="badge badge-soft-secondary">HTML</span>
                                            <span class="badge badge-soft-secondary">Css</span>

                                        </div>
                                    </div>
                                </div>

                            </div><!--end activity-->
                        </div><!--end education-activity-->
                    </div> <!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
        </div>

    </div>
@endsection
