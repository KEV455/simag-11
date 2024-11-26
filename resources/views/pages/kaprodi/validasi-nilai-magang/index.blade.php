@extends('layouts.base.base-template')

@section('title')
    <title>Daftar Dosen Pembimbing | SiMagang</title>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Daftar Dosen Pembimbing</h4>
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
                                        <th class="text-left">Nama Dosen</th>
                                        <th class="text-left">Nama Program Studi</th>
                                        <th class="text-left">Status</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                    <!--end tr-->
                                </thead>

                                <tbody>

                                    @foreach ($dosen_pembimbings as $item)
                                        <tr class="text-center">
                                            <td>{{ $no }}</td>
                                            <td class="text-left">{{ $item->dosen->nama_dosen }}</td>
                                            <td class="text-left">{{ $item->dosen->prodi->nama_program_studi }}</td>
                                            <td class="text-left">{{ $item->status }}</td>
                                            <td>
                                                <a href="{{ route('kaprodi.validasi.nilai.show', $item->id) }}">
                                                    <i class="fa-solid fa-eye text-primary font-16"
                                                        title="Lihat Mahasiswa"></i>
                                                </a> &ensp;
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
