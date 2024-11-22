@extends('layouts.base.base-template')

@section('title')
    <title>Manajemen Logbook | SiMagang</title>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Manajemen Logbook</h4>
                </div>
                <!--end page-title-box-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{#" class="btn btn-primary px-4 mt-0 mb-3" data-animation="bounce"><i
                                class="mdi mdi-plus-circle-outline mr-2"></i>Tambah Logbook
                            Baru</a>
                        <div class="table-responsive">
                            @php
                                $no = 1;
                            @endphp
                            <table id="datatable" class="table">
                                <thead class="thead-light">
                                    <tr class="text-center">
                                        <th width="10%">No</th>
                                        <th class="text-left">Judul Kegiatan</th>
                                        <th class="text-center">Dokumentasi</th>
                                        <th class="text-left">Kehadiran</th>
                                        <th class="text-left">Tanggal Kegiatan</th>
                                        <th class="text-left">Deskripsi Kegiatan</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                    <!--end tr-->
                                </thead>

                                <tbody>

                                    <tr class="text-center">
                                        <td>{{ $no }}</td>
                                        <td class="text-left"></td>
                                        <td class="text-center">
                                            {{-- <img width="150" class="img-thumbnail img-fluid"
                                                    src="{{ asset('storage/' . $item->foto) }}" alt="Foto Mitra"> --}}
                                        </td>
                                        <td class="text-left"></td>
                                        <td class="text-left"></td>
                                        <td class="text-left"></td>
                                        <td>
                                            <a href="#" class="mr-2" data-animation="bounce">
                                                <i class="fas fa-edit text-info font-16"></i>
                                            </a>
                                            <a href="#">
                                                <i class="fas fa-trash-alt text-danger font-16"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <!--end tr-->
                                    @php
                                        $no++;
                                    @endphp
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div>
    </div>
@endsection
