@extends('layouts.base.base-template')

@section('title')
    <title>Permohonan Magang Mahasiswa | SiMagang</title>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Permohonan Magang Mahasiswa</h4>
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
                        <div class="table-responsive">
                            @php
                                $no = 1;
                            @endphp

                            <table id="datatable" class="table">
                                <thead class="thead-light">
                                    <tr class="text-center">
                                        <th width="10%">No</th>
                                        <th class="text-left">Nama Mitra</th>
                                        <th class="text-left">Lowongan</th>
                                        <th class="text-left">Email</th>
                                        <th class="text-left">Status Diterima</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                    <!--end tr-->
                                </thead>

                                <tbody>
                                    @foreach ($pelamar_magang as $item)
                                        <tr class="text-center">
                                            <td>{{ $no }}</td>
                                            <td class="text-left">{{ $item->lowongan->mitra->nama }}</td>
                                            <td class="text-left">{{ $item->lowongan->nama }}</td>
                                            <td class="text-left">{{ $item->lowongan->mitra->email }}</td>
                                            <td class="text-left">{{ $item->status_diterima }}</td>
                                            <td>
                                                <a href="#">
                                                    <i class="fas fa-trash-alt text-danger font-16"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <!--end tr-->
                                        @php
                                            $no++;
                                        @endphp
                                    @endforeach
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
