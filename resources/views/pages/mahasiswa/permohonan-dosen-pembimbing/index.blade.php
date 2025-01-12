@extends('layouts.base.base-template')

@section('title')
    <title>Permohonan Dosen Pembimbing | SiMagang</title>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Permohonan Dosen Pembimbing</h4>
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

                        @if ($tombolAjukanDitampilkan)
                            <a href="{{ route('mahasiswa.permohonan.dosen.pembimbing.create') }}"
                                class="btn btn-primary px-4 mt-0 mb-3" data-animation="bounce">
                                <i class="mdi mdi-plus-circle-outline mr-2"></i>Ajukan Dosen Pembimbing Baru
                            </a>
                        @endif
                        <div class="table-responsive">
                            @php
                                $no = 1;
                            @endphp
                            <table id="datatable" class="table">
                                <thead class="thead-light">
                                    <tr class="text-center">
                                        <th width="10%">No</th>
                                        <th class="text-left">NIM</th>
                                        <th class="text-left">Nama</th>
                                        <th class="text-left">Dosen Pembimbing</th>
                                        <th class="text-left">Semester</th>
                                        <th class="text-left">Status</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                    <!--end tr-->
                                </thead>

                                <tbody>

                                    @foreach ($permohonan_dosen_pembimbing as $data)
                                        <tr class="text-center">
                                            <td>{{ $no }}</td>
                                            <td class="text-left">{{ $data->mahasiswa->nim }}</td>
                                            <td class="text-left">{{ $data->mahasiswa->nama_mahasiswa }}</td>
                                            <td class="text-left">{{ $data->dosen_pembimbing->dosen->nama_dosen }}</td>
                                            <td class="text-left">{{ $data->semester->nama_semester }}</td>
                                            <td class="text-left">{{ $data->status }}</td>
                                            <td>
                                                @if ($data->status == 'disetujui')
                                                    -
                                                @else
                                                    <a
                                                        href="{{ route('mahasiswa.permohonan.dosen.pembimbing.destroy', $data->id) }}"><i
                                                            class="fa-solid fa-trash text-danger font-16"
                                                            title="hapus"></i></a> &ensp;
                                                @endif
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
