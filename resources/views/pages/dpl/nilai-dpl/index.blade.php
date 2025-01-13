@extends('layouts.base.base-template')

@section('title')
    <title>Daftar Lowongan | SiMagang</title>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Daftar Lowongan</h4>
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
                                        <th class="text-left">Nama Lowongan</th>
                                        <th class="text-left">Mitra</th>
                                        <th class="text-left">Status</th>
                                        <th class="text-left">Tahun Ajaran</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                    <!--end tr-->
                                </thead>

                                <tbody>
                                    @foreach ($dpl_lowongans as $item)
                                        <tr class="text-center">
                                            <td>{{ $no }}</td>
                                            <td class="text-left">{{ $item->lowongan->nama }}</td>
                                            <td class="text-left">{{ $item->lowongan->mitra->nama }}</td>
                                            <td class="text-left">{{ $item->lowongan->status }}</td>
                                            <td class="text-left">{{ $item->lowongan->semester->nama_semester }}</td>
                                            <td>
                                                <a href="{{ route('dpl.nilai.dpl.show', $item->id_lowongan) }}"
                                                    class="mr-2">
                                                    <i class="fas fa-eye text-primary font-16"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <!--end tr-->
                                </tbody>
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
