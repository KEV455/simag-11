@extends('layouts.base.base-template')

@section('title')
    <title>Manajemen Mitra | SiMagang</title>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Manajemen Mitra</h4>
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
                        <a href="{{ route('admin.mitra.create') }}" class="btn btn-primary px-4 mt-0 mb-3"
                            data-animation="bounce"><i class="mdi mdi-plus-circle-outline mr-2"></i>Tambah Mitra
                            Baru</a>
                        <div class="table-responsive">
                            @php
                                $no = 1;
                            @endphp
                            <table id="datatable" class="table">
                                <thead class="thead-light">
                                    <tr class="text-center">
                                        <th width="10%">No</th>
                                        <th class="text-left">Nama Mitra</th>
                                        <th class="text-center">Foto</th>
                                        <th class="text-left">Email</th>
                                        <th class="text-left">Website</th>
                                        <th class="text-left">Kategori Bidang</th>
                                        <th class="text-left">Status</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                    <!--end tr-->
                                </thead>

                                <tbody>
                                    @foreach ($mitras as $item)
                                        <tr class="text-center">
                                            <td>{{ $no }}</td>
                                            <td class="text-left">{{ $item->nama }}</td>
                                            <td class="text-center">
                                                <img width="150" class="img-thumbnail img-fluid"
                                                    src="{{ asset('storage/' . $item->foto) }}" alt="Foto Mitra">
                                            </td>
                                            <td class="text-left">{{ $item->email }}</td>
                                            <td class="text-left">{{ $item->website }}</td>
                                            <td class="text-left">{{ $item->kategori_bidang->nama_kategori }}</td>
                                            <td class="text-left">{{ $item->status }}</td>
                                            <td>
                                                <a href="{{ route('admin.mitra.edit', $item->id) }}" class="mr-2"
                                                    data-animation="bounce">
                                                    <i class="fas fa-edit text-info font-16"></i>
                                                </a>
                                                <a href="{{ route('admin.mitra.destroy', $item->id) }}">
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
