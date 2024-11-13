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
                            <div class="card-body">
                                <h4 class="header-title mt-0 mb-3">Jurusan</h4>
                                <div class="media">
                                    <div class="data-icon align-self-center">
                                        <i class="fa-solid fa-building-columns rounded-circle text-pink"></i>
                                    </div>
                                    <div class="media-body ml-3 align-self-center text-right">
                                        <h3 class="mt-0">5</h3>
                                        <p class="text-muted mb-0 text-nowrap">Daftar Jurusan</p>
                                    </div><!--end media body-->
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!-- end col-->

                    <div class="col-lg-4">
                        <div class="card hospital-info card-hover">
                            <div class="card-body">
                                <h4 class="header-title mt-0 mb-3">Program Studi</h4>
                                <div class="media">
                                    <div class="data-icon align-self-center">
                                        <i class="fa-solid fa-school rounded-circle text-orange"></i>
                                    </div>
                                    <div class="media-body ml-3 align-self-center text-right">
                                        <h3 class="mt-0">10</h3>
                                        <p class="text-muted mb-0 text-nowrap">Daftar Prodi</p>
                                    </div><!--end media body-->
                                </div>
                            </div><!--end card-body-->
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

        {{-- Datatable --}}
        {{-- <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mt-0 mb-3">New Patients</h4>
                        <div class="table-responsive">
                            <table id="datatable" class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Patient Name</th>
                                        <th>Age</th>
                                        <th>ID</th>
                                        <th>Address</th>
                                        <th>Mobile No</th>
                                        <th>Last Visit</th>
                                        <th>Diseases</th>
                                        <th class="text-right">Action</th>
                                    </tr><!--end tr-->
                                </thead>

                                <tbody>
                                    <tr>
                                        <td><a href="../hospital/patient-profile.html"><img
                                                    src="{{ asset('template/assets/images/users/user-10.jpg') }}"
                                                    alt="" class="thumb-sm rounded-circle mr-2">Keith
                                                Jacobson</a>
                                        </td>
                                        <td>48</td>
                                        <td>#1236</td>
                                        <td>B28 University Street US</td>
                                        <td>+123456789</td>
                                        <td>18/07/2019</td>
                                        <td><span class="badge badge-soft-success">Ulcers</span></td>
                                        <td class="text-right">
                                            <a href="../hospital/patient-edit.html" class="mr-2"><i
                                                    class="fas fa-edit text-info font-16"></i></a>
                                            <a href="#"><i class="fas fa-trash-alt text-danger font-16"></i></a>
                                        </td>
                                    </tr><!--end tr-->
                                    <tr>
                                        <td><a href="../hospital/patient-profile.html"><img
                                                    src="{{ asset('template/assets/images/users/user-10.jpg') }}"
                                                    alt="" class="thumb-sm rounded-circle mr-2">Greg
                                                Crosby</a></td>
                                        <td>27</td>
                                        <td>#1236</td>
                                        <td>B28 University Street US</td>
                                        <td>+123456789</td>
                                        <td>18/07/2019</td>
                                        <td><span class="badge badge-soft-danger">HIV</span></td>
                                        <td class="text-right">
                                            <a href="../hospital/patient-edit.html" class="mr-2"><i
                                                    class="fas fa-edit text-info font-16"></i></a>
                                            <a href="#"><i class="fas fa-trash-alt text-danger font-16"></i></a>
                                        </td>
                                    </tr><!--end tr-->
                                    <tr>
                                        <td><a href="../hospital/patient-profile.html"><img
                                                    src="{{ asset('template/assets/images/users/user-10.jpg') }}"
                                                    alt="" class="thumb-sm rounded-circle mr-2">Fred
                                                Godina</a></td>
                                        <td>22</td>
                                        <td>#1236</td>
                                        <td>B28 University Street US</td>
                                        <td>+123456789</td>
                                        <td>18/07/2019</td>
                                        <td><span class="badge badge-soft-success">Virus Fever</span></td>
                                        <td class="text-right">
                                            <a href="../hospital/patient-edit.html" class="mr-2"><i
                                                    class="fas fa-edit text-info font-16"></i></a>
                                            <a href="#"><i class="fas fa-trash-alt text-danger font-16"></i></a>
                                        </td>
                                    </tr><!--end tr-->
                                    <tr>
                                        <td><a href="../hospital/patient-profile.html"><img
                                                    src="{{ asset('template/assets/images/users/user-10.jpg') }}"
                                                    alt="" class="thumb-sm rounded-circle mr-2">Peggy
                                                Doe</a></td>
                                        <td>51</td>
                                        <td>#7851</td>
                                        <td>B28 University Street US</td>
                                        <td>+123456789</td>
                                        <td>20/07/2019</td>
                                        <td><span class="badge badge-soft-success">heart attack</span></td>
                                        <td class="text-right">
                                            <a href="../hospital/patient-edit.html" class="mr-2"><i
                                                    class="fas fa-edit text-info font-16"></i></a>
                                            <a href="#"><i class="fas fa-trash-alt text-danger font-16"></i></a>
                                        </td>
                                    </tr><!--end tr-->
                                    <tr>
                                        <td><a href="../hospital/patient-profile.html"><img
                                                    src="{{ asset('template/assets/images/users/user-10.jpg') }}"
                                                    alt="" class="thumb-sm rounded-circle mr-2">Jennifer Doss</a>
                                        </td>
                                        <td>18</td>
                                        <td>#3654</td>
                                        <td>B28 University Street US</td>
                                        <td>+123456789</td>
                                        <td>19/07/2019</td>
                                        <td><span class="badge badge-soft-danger">Ebola</span></td>
                                        <td class="text-right">
                                            <a href="../hospital/patient-edit.html" class="mr-2"><i
                                                    class="fas fa-edit text-info font-16"></i></a>
                                            <a href="#"><i class="fas fa-trash-alt text-danger font-16"></i></a>
                                        </td>
                                    </tr><!--end tr-->
                                </tbody>
                            </table>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
        </div><!--end row--> --}}

    </div><!-- container -->
@endsection
