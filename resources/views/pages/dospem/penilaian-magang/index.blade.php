@extends('layouts.base.base-template')

@section('title')
    <title>Daftar Mahasiswa Bimbingan | SiMagang</title>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Daftar Mahasiswa Bimbingan || {{ $dosen_pembimbing->dosen->nama_dosen }} </h4>
                </div>
            </div>
        </div>
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
                                        <th class="text-left">Nim</th>
                                        <th class="text-left">Nama Mahasiswa</th>
                                        <th class="text-left">Angkatan</th>
                                        <th class="text-left">Nama Program Studi</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($pembimbing_magangs as $data)
                                        <tr class="text-center">
                                            <td>{{ $no }}</td>
                                            <td class="text-left">{{ $data->mahasiswa->nim }}</td>
                                            <td class="text-left">{{ $data->mahasiswa->nama_mahasiswa }}</td>
                                            <td class="text-left">{{ $data->mahasiswa->angkatan }}</td>
                                            <td class="text-left">{{ $data->mahasiswa->prodi->nama_program_studi }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('dospem.penilaian.magang.show', $data->id) }}"
                                                    title="Penilaian Magang">
                                                    <i class="fa-solid fa-file-pen text-primary font-16"></i>
                                                </a>
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
