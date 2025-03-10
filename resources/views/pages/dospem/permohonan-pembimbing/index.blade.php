@extends('layouts.base.base-template')

@section('title')
    <title>Permohonan Dosen Pembimbing Mahasiswa | SiMagang</title>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Permohonan Dosen Pembimbing Mahasiswa || {{ $dospem->dosen->nama_dosen }}</h4>
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
                        <a href="{{ route('dospem.validasi.permohonan.disetujui.index') }}"
                            class="btn btn-success px-4 mt-0 mb-3" data-animation="bounce">
                            <i class="fa-solid fa-circle-check"></i>&ensp;Permohonan Disetujui
                        </a>&ensp;
                        <a href="{{ route('dospem.validasi.permohonan.ditolak.index') }}"
                            class="btn btn-danger px-4 mt-0 mb-3" data-animation="bounce">
                            <i class="fa-solid fa-circle-xmark"></i>&ensp;Permohonan Ditolak
                        </a>

                        <div class="table-responsive">
                            @php
                                $no = 1;
                            @endphp

                            <table id="datatable" class="table">
                                <thead class="thead-light">
                                    <tr class="text-center">
                                        <th width="10%">No</th>
                                        <th class="text-left">Nama Mahasiswa</th>
                                        <th class="text-left">Nim</th>
                                        <th class="text-left">Program Studi</th>
                                        <th class="text-left">Semester</th>
                                        <th width="10%" class="text-center">Action</th>
                                    </tr>
                                    <!--end tr-->
                                </thead>

                                <tbody>
                                    @foreach ($permohonan_dosen_pembimbing as $item)
                                        <tr class="text-center">
                                            <td>{{ $no }}</td>
                                            <td class="text-left">{{ $item->mahasiswa->nama_mahasiswa }}</td>
                                            <td class="text-left">{{ $item->mahasiswa->nim }}</td>
                                            <td class="text-left">{{ $item->mahasiswa->prodi->nama_program_studi }}</td>
                                            <td class="text-left">{{ $item->semester->nama_semester }}</td>
                                            <td>
                                                <a href="{{ route('dospem.validasi.permohonan.disetujui', $item->id) }}"
                                                    title="Diterima">
                                                    <i class="fa-solid fa-circle-check text-success font-16"></i>
                                                </a>
                                                &ensp;
                                                <a href="{{ route('dospem.validasi.permohonan.ditolak', $item->id) }}"
                                                    title="Ditolak">
                                                    <i class="fa-solid fa-circle-xmark text-salmon font-16"></i>
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
