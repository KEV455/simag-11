@extends('layouts.base.base-template')

@section('title')
    <title>Permohonan Magang Mahasiswa | SiMagang</title>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Permohonan Magang Mahasiswa</h4>
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
                                        <th class="text-left">Lowongan</th>
                                        <th class="text-left">Email</th>
                                        <th class="text-center">Berkas</th>
                                        <th class="text-left">Status Diterima</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                    <!--end tr-->
                                </thead>

                                <tbody>
                                    @foreach ($pelamar_magang as $item)
                                        <tr class="text-center">
                                            <td>{{ $no }}</td>
                                            <td class="text-left">{{ $item->lowongan->mitra->nama }}</td>
                                            <td class="text-left">{{ $item->lowongan->nama }}</td>
                                            <td class="text-left">{{ $item->lowongan->mitra->email }}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-primary px-4 mt-0 mb-3"
                                                    data-toggle="modal" data-animation="bounce" data-target=".modalView">
                                                    <i class="fa-solid fa-file-circle-check"></i>&ensp;
                                                    Lihat Berkas Saya
                                                </button>
                                            </td>
                                            <td class="text-left">{{ $item->status_diterima }}</td>
                                            <td>
                                                <a href="#">
                                                    <i class="fas fa-trash-alt text-danger font-16"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <!--end tr-->
                                        @php
                                            $no++;
                                        @endphp

                                        <!--  Modal Add new content for the above example -->
                                        <div class="modal fade modalView" tabindex="-1" role="dialog"
                                            aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title mt-0" id="myLargeModalLabel">Berkas Lamaran -
                                                            {{ $item->lowongan->nama }} ({{ $item->lowongan->mitra->nama }})
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                @if ($item->berkas_pelamar && $item->berkas_pelamar->count() > 0)
                                                                    @foreach ($item->berkas_pelamar as $dataBerkas)
                                                                        <div class="accordion-body collapse show"
                                                                            id="panel-body-1" data-parent="#accordion">
                                                                            <iframe
                                                                                src="{{ asset('storage/' . $dataBerkas->file) }}"
                                                                                width="100%" height="700px"></iframe>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
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
