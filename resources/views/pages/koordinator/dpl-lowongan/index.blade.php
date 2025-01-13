@extends('layouts.base.base-template')

@section('title')
    <title>Manajemen Lowongan DPL | SiMagang</title>
@endsection

{{-- @php
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
@endphp --}}

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Manajemen Lowongan DPL || {{ $dpl_mitra->nama }}</h4>
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
                        <a href="{{ route('koordinator.dpl.lowongan.create', $dpl_mitra->id) }}" type="button"
                            class="btn btn-primary px-4 mt-0 mb-3">
                            <i class="mdi mdi-plus-circle-outline mr-2"></i>
                            Ubah Lowongan DPL
                        </a>
                        <div class="table-responsive">
                            @php
                                $no = 1;
                            @endphp
                            <table id="datatable" class="table">
                                <thead class="thead-light">
                                    <tr class="text-center">
                                        <th width="10%">No</th>
                                        <th width="10%" class="text-left">Nama DPL</th>
                                        <th width="10%">Nama Mitra</th>
                                        <th width="10%">Nama Lowongan</th>
                                        <th width="10%">Tahun Ajaran</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                    <!--end tr-->
                                </thead>

                                <tbody>
                                    @foreach ($dpl_lowongans as $item)
                                        <tr class="text-center">
                                            <td>{{ $no }}</td>
                                            <td class="text-left">{{ $item->dpl_mitra->nama }}</td>
                                            <td>{{ $item->dpl_mitra->mitra->nama }}</td>
                                            <td>{{ $item->lowongan->nama }}</td>
                                            <td>{{ $item->lowongan->semester->nama_semester }}</td>
                                            <td>
                                                <a href="{{ route('koordinator.dpl.lowongan.destroy', $item->id) }}">
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
