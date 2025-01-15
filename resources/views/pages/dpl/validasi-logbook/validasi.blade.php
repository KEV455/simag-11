@extends('layouts.base.base-template')

@section('title')
    <title>Validasi Logbook | SiMagang</title>
@endsection

@php
    function dateConversion($date)
    {
        $month = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];
        $slug = explode('-', $date);
        return $slug[2] . ' ' . $month[(int) $slug[1]] . ' ' . $slug[0];
    }
@endphp

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Validasi Logbook ||
                        {{ $peserta_magang->pelamar_magang->mahasiswa->nama_mahasiswa }} -
                        {{ $peserta_magang->pelamar_magang->lowongan->nama }} -
                        {{ $peserta_magang->pelamar_magang->lowongan->mitra->nama }}</h4>
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
                                    @foreach ($logbook as $item)
                                        <tr class="text-center">
                                            <td>{{ $no }}</td>
                                            <td class="text-left">{{ $item->judul_kegiatan }}</td>
                                            <td class="text-center">
                                                <img width="150" class="img-thumbnail img-fluid"
                                                    src="{{ asset('storage/' . $item->dokumentasi_kegiatan) }}"
                                                    alt="Foto Kegiatan">
                                            </td>
                                            <td class="text-left">{{ $item->status_kehadiran }}</td>
                                            <td class="text-left">
                                                {{ $item->tanggal_kegiatan
                                                    ? \Carbon\Carbon::parse($item->tanggal_kegiatan)->locale('id')->translatedFormat('j F Y')
                                                    : '-' }}
                                            </td>
                                            <td class="text-left">{{ $item->deskripsi_kegiatan }}</td>
                                            <td>
                                                <a href="{{ route('dpl.validasi.logbook.show.logbook.diterima', $item->id) }}"
                                                    title="Diterima">
                                                    <i class="fa-solid fa-circle-check text-success font-16"></i>
                                                </a>
                                                &ensp;
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
