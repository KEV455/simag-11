@extends('layouts.base.base-template')

@section('title')
    <title>Manajemen Jurusan | SiMagang</title>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Manajemen Jurusan</h4>
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
                        <button type="button" class="btn btn-primary px-4 mt-0 mb-3" data-toggle="modal"
                            data-animation="bounce" data-target=".modalCreate"><i
                                class="mdi mdi-plus-circle-outline mr-2"></i>Tambah Jurusan Baru</button>
                        <div class="table-responsive">
                            @php
                                $no = 1;
                            @endphp
                            <table id="datatable" class="table">
                                <thead class="thead-light">
                                    <tr class="text-center">
                                        <th width="10%">No</th>
                                        <th class="text-left">Nama Jurusan</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                    <!--end tr-->
                                </thead>

                                <tbody>
                                    @foreach ($jurusans as $item)
                                        <tr class="text-center">
                                            <td>{{ $no }}</td>
                                            <td class="text-left">{{ $item->nama_jurusan }}</td>
                                            <td>
                                                <a href="{{ route('admin.jurusan.update', $item->id) }}" class="mr-2"
                                                    data-toggle="modal" data-animation="bounce"
                                                    data-target=".modalUpdate{{ $item->id }}"><i
                                                        class="fas fa-edit text-info font-16"></i></a>
                                                <a href="{{ route('admin.jurusan.destroy', $item->id) }}"><i
                                                        class="fas fa-trash-alt text-danger font-16"></i></a>
                                            </td>
                                        </tr>
                                        <!--end tr-->
                                        @php
                                            $no++;
                                        @endphp
                                        <div class="modal fade modalUpdate{{ $item->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title mt-0" id="myLargeModalLabel">Ubah
                                                            Jurusan</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.jurusan.update', $item->id) }}"
                                                            method="POST">
                                                            @method('put')
                                                            @csrf

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="update_nama_jurusan">Nama
                                                                            Jurusan</label>
                                                                        <input type="text"
                                                                            class="form-control @error('update_nama_jurusan') is-invalid @enderror"
                                                                            id="update_nama_jurusan"
                                                                            name="update_nama_jurusan"
                                                                            placeholder="Masukkan Nama Jurusan"
                                                                            value="{{ $item->nama_jurusan }}">
                                                                        @error('update_nama_jurusan')
                                                                            <div id="update_nama_jurusan"
                                                                                class="form-text pb-1">
                                                                                {{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <button type="submit"
                                                                class="btn btn-sm btn-primary">Simpan</button>
                                                            <button type="button" class="btn btn-sm btn-danger"
                                                                data-dismiss="modal">Batal</button>
                                                        </form>
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


    <!--  Modal Add new content for the above example -->
    <div class="modal fade modalCreate" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Tambah Jurusan Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.jurusan.create') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="create_nama_jurusan">Nama Jurusan</label>
                                    <input type="text"
                                        class="form-control @error('create_nama_jurusan') is-invalid @enderror"
                                        id="create_nama_jurusan" name="create_nama_jurusan"
                                        placeholder="Masukkan Nama Jurusan">
                                    @error('create_nama_jurusan')
                                        <div id="create_nama_jurusan" class="form-text pb-1">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary" id="sa-success">Tambah</button>
                                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
