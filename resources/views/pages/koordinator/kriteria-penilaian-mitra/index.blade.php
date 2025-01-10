@extends('layouts.base.base-template')

@section('title')
    <title>Manajemen Kriteria Penilaian Mitra | SiMagang</title>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Manajemen Kriteria Penilaian Mitra || {{ $mitra->nama }}</h4>
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
                        <a href="{{ route('koordinator.kriteria.penilaian.mitra.create', $mitra->id) }}"
                            class="btn btn-primary px-4 mt-0 mb-3">
                            <i class="mdi mdi-plus-circle-outline mr-2"></i>Tambah Kriteria Penilaian Mitra Baru
                        </a>
                        <div class="table-responsive">
                            @php
                                $no = 1;
                            @endphp
                            <table id="datatable" class="table">
                                <thead class="thead-light">
                                    <tr class="text-center">
                                        <th width="10%">No</th>
                                        <th class="text-left">Nama Kriteria Penilaian</th>
                                        <th width="30%">Status</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                    <!--end tr-->
                                </thead>

                                <tbody>
                                    @foreach ($kriteria_penilaian_mitras as $item)
                                        <tr class="text-center">
                                            <td>{{ $no }}</td>
                                            <td class="text-left">{{ $item->kriteria_penilaian->nama_kriteria_penilaian }}
                                            </td>
                                            <td>{{ $item->status }}</td>
                                            <td>
                                                <a
                                                    href="{{ route('koordinator.kriteria.penilaian.mitra.destroy', $item->id) }}">
                                                    <i class="fas fa-trash-alt text-danger font-16"></i>
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
    <!--end row-->
@endsection
