@extends('layouts.base.base-template')

@section('title')
    <title>Daftar Peserta Magang | SiMagang</title>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Daftar Peserta Magang || {{ $lowongan->nama }}</h4>
                </div>
                <!--end page-title-box-->
            </div>
            <!--end col-->
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
                                        <th class="text-left">No</th>
                                        <th class="text-left">Nama Mahasiswa</th>
                                        <th class="text-left">Lowongan</th>
                                        <th class="text-left">Mitra</th>
                                        <th class="text-left">Tahun Ajaran</th>
                                        <th width="10%">Logbook</th>
                                    </tr>
                                    <!--end tr-->
                                </thead>

                                <tbody>
                                    @foreach ($pelamar_magangs as $item)
                                        <tr class="text-center">
                                            <td>{{ $no }}</td>
                                            <td class="text-left">{{ $item->mahasiswa->nama_mahasiswa }}</td>
                                            <td class="text-left">{{ $item->lowongan->nama }}</td>
                                            <td class="text-left">{{ $item->lowongan->mitra->nama }}</td>
                                            <td class="text-left">{{ $item->lowongan->semester->nama_semester }}</td>
                                            <td>
                                                @if ($item->peserta_magang && $item->peserta_magang->isNotEmpty())
                                                    @foreach ($item->peserta_magang as $peserta)
                                                        <a href="{{ route('dpl.validasi.logbook.show.logbook', $peserta->id) }}"
                                                            class="mr-2">
                                                            <i class="fas fa-eye text-primary font-16"
                                                                title="Lihat Logbook"></i>
                                                        </a>
                                                    @endforeach
                                                @else
                                                    <span class="text-muted">Data tidak tersedia</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @php
                                            $no++;
                                        @endphp
                                    @endforeach

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
