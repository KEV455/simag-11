@extends('layouts.base.base-template')

@section('title')
    <title>Validasi Nilai Magang | SiMagang</title>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Validasi Nilai Magang || {{ $dosen_pembimbing->dosen->nama_dosen }} </h4>
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
                                        <th class="text-left">Nama Mahasiswa</th>
                                        <th class="text-left">Nim</th>
                                        <th class="text-left">Nilai Angka</th>
                                        <th class="text-left">Nilai Huruf</th>
                                        <th class="text-center">Transkrip Nilai DPL</th>
                                        <th class="text-center">Status Validasi</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($nilai_magangs as $data)
                                        <tr class="text-center">
                                            <td>{{ $no }}</td>
                                            <td class="text-left">
                                                {{ $data->peserta_magang->pelamar_magang->mahasiswa->nama_mahasiswa }}
                                            </td>
                                            <td class="text-left">
                                                {{ $data->peserta_magang->pelamar_magang->mahasiswa->nim }}
                                            </td>
                                            <td class="text-left">{{ $data->nilai_angka }}</td>
                                            <td class="text-center">{{ $data->nilai_huruf }}</td>
                                            <td class="text-center">
                                                <a href="{{ asset('storage/' . $data->transkrip_nilai_dpl->file_transkrip_nilai) }}"
                                                    target="_blank" class="btn btn-success">
                                                    Unduh&ensp;<i class="fa-solid fa-download"></i>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                @if ($data->validasi == 'Belum Divalidasi')
                                                    <span class="badge badge-soft-warning">
                                                        {{ $data->validasi }}
                                                    </span>
                                                @elseif ($data->validasi == 'Tidak Setuju')
                                                    <span class="badge badge-soft-danger">
                                                        {{ $data->validasi }}
                                                    </span>
                                                @elseif ($data->validasi == 'Setuju')
                                                    <span class="badge badge-soft-success">
                                                        {{ $data->validasi }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($data->validasi == 'Belum Divalidasi')
                                                    <a href="{{ route('kaprodi.validasi.nilai.validasi', $data->id) }}"
                                                        title="Setujui">
                                                        <i class="fa-solid fa-circle-check text-success font-16"></i>
                                                    </a>
                                                @elseif ($data->validasi == 'Setuju')
                                                    <a href="#" title="Sudah Divalidasi">
                                                        <i class="fa-solid fa-ban text-info font-16"></i>
                                                    </a>
                                                    &ensp;
                                                @endif
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
