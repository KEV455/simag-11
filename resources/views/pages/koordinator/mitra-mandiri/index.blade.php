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
                                        <th class="text-left">Mahasiswa Pemohon</th>
                                        <th class="text-left">Status Disetujui</th>
                                        <th width="10%">Persetujuan</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                    <!--end tr-->
                                </thead>

                                <tbody>
                                    @foreach ($mitra_mandiris as $item)
                                        <tr class="text-center">
                                            <td>{{ $no }}</td>
                                            <td class="text-left">{{ $item->nama }}</td>
                                            <td class="text-left">{{ $item->email }}</td>
                                            <td class="text-left">{{ $item->narahubung }}</td>
                                            <td class="text-left">{{ $item->mahasiswa->nama_mahasiswa }}</td>
                                            <td class="text-left">{{ $item->status_disetujui }}</td>
                                            <td class="text-center">
                                                @if ($item->status_disetujui == 'Menunggu Persetujuan')
                                                    <a href="{{ route('koordinator.mitra.mandiri.diterima', $item->id) }}"
                                                        title="Diterima">
                                                        <i class="fa-solid fa-circle-check text-success font-16"></i>
                                                    </a>
                                                    &ensp;
                                                    <a href="{{ route('koordinator.mitra.mandiri.ditolak', $item->id) }}"
                                                        title="Ditolak">
                                                        <i class="fa-solid fa-circle-xmark text-salmon font-16"></i>
                                                    </a>
                                                    &ensp;
                                                @endif

                                                <a href="{{ route('koordinator.mitra.mandiri.show', $item->id) }}"
                                                    title="Detail Mita Mandiri">
                                                    <i class="fas fa-eye text-info font-16"></i>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('koordinator.mitra.mandiri.destroy', $item->id) }}">
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
