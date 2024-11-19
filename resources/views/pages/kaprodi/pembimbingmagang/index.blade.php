@extends('layouts.base.base-template')

@section('title')
    <title>Manajemen Pembimbing Magang| SiMagang</title>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Manajemen Pembimbing Magang || {{ $dosen_pembimbing->dosen->nama_dosen }} </h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('kaprodi.pembimbing.magang.create', $dosen_pembimbing->id) }}"
                            class="btn btn-primary px-4 mt-0 mb-3" data-animation="bounce"><i
                                class="mdi mdi-plus-circle-outline mr-2"></i>Tambah Mahasiswa
                            Baru</a>
                        <div class="table-responsive">
                            @php
                                $no = 1;
                            @endphp
                            <table id="datatable" class="table">
                                <thead class="thead-light">
                                    <tr class="text-center">
                                        <th width="10%">No</th>
                                        <th class="text-left">Nim</th>
                                        <th class="text-left">Nama Mahasiswa</th>
                                        <th class="text-left">Angkatan</th>
                                        <th class="text-left">Nama Program Studi</th>
                                        <th class="text-left">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($pembimbing_magang as $data)
                                        <tr class="text-center">
                                            <td>{{ $no }}</td>
                                            <td class="text-left">{{ $data->mahasiswa->nim }}</td>
                                            <td class="text-left">{{ $data->mahasiswa->nama_mahasiswa }}</td>
                                            <td class="text-left">{{ $data->mahasiswa->angkatan }}</td>
                                            <td class="text-left">{{ $data->mahasiswa->prodi->nama_program_studi }}</td>
                                            <td>
                                                <a href="{{ route('kaprodi.pembimbing.magang.destroy', $data->id) }}"><i
                                                        class="fas fa-trash-alt text-danger font-16"></i></a>
                                            </td>
                                        </tr>
                                        @php
                                            $no++;
                                        @endphp
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
