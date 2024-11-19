@extends('layouts.base.base-template')

@section('title')
    <title>Pengajuan Mitra Mandiri | SiMagang</title>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Pengajuan Mitra Mandiri</h4>
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
                        <a href="{{ route('mahasiswa.mitra.mandiri.create') }}" class="btn btn-primary px-4 mt-0 mb-3"
                            data-animation="bounce"><i class="mdi mdi-plus-circle-outline mr-2"></i>Ajukan Mitra Mandiri
                            Baru</a>
                        <div class="table-responsive">
                            @php
                                $no = 1;
                            @endphp

                            <table id="datatable" class="table">
                                <thead class="thead-light">
                                    <tr class="text-center">
                                        <th width="10%">No</th>
                                        <th class="text-left">Nama Mitra</th>
                                        <th class="text-left">Email</th>
                                        <th class="text-left">Narahubung</th>
                                        <th class="text-left">Status Disetujui</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                    <!--end tr-->
                                </thead>

                                <tbody>
                                    @foreach ($mitras as $item)
                                        <tr class="text-center">
                                            <td>{{ $no }}</td>
                                            <td class="text-left">{{ $item->nama }}</td>
                                            <td class="text-left">{{ $item->email }}</td>
                                            <td class="text-left">{{ $item->narahubung }}</td>
                                            <td class="text-left">{{ $item->status_disetujui }}</td>
                                            <td>    
                                                <a href="{{ route('mahasiswa.mitra.mandiri.destroy', $item->id) }}">
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
