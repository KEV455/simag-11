@extends('layouts.base.base-template')

@section('title')
    <title>Manajemen Kriteria Penilaian | SiMagang</title>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Manajemen Kriteria Penilaian</h4>
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
                                class="mdi mdi-plus-circle-outline mr-2"></i>Tambah Kriteria Penilaian Baru</button>
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
                                    @foreach ($kriteria_penilaians as $item)
                                        <tr class="text-center">
                                            <td>{{ $no }}</td>
                                            <td class="text-left">{{ $item->nama_kriteria_penilaian }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>
                                                <a href="{{ route('koordinator.kriteria.penilaian.update', $item->id) }}"
                                                    class="mr-2" data-toggle="modal" data-animation="bounce"
                                                    data-target=".modalUpdate{{ $item->id }}"><i
                                                        class="fas fa-edit text-info font-16"></i></a>
                                                <a href="{{ route('koordinator.kriteria.penilaian.destroy', $item->id) }}"><i
                                                        class="fas fa-trash-alt text-danger font-16"></i></a>
                                            </td>
                                        </tr>
                                        <!--end tr-->
                                </tbody>
                                @php
                                    $no++;
                                @endphp

                                <!--  Modal Update content for the above example -->
                                <div class="modal fade modalUpdate{{ $item->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title mt-0" id="myLargeModalLabel">Ubah Kriteria Penilaian
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <form
                                                    action="{{ route('koordinator.kriteria.penilaian.update', $item->id) }}"
                                                    method="POST">
                                                    @method('put')
                                                    @csrf

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="update_nama_kriteria_penilaian">Nama
                                                                    Kriteria Penilaian</label>
                                                                <input type="text"
                                                                    class="form-control @error('update_nama_kriteria_penilaian') is-invalid @enderror"
                                                                    id="update_nama_kriteria_penilaian"
                                                                    name="update_nama_kriteria_penilaian"
                                                                    value="{{ $item->nama_kriteria_penilaian }}"
                                                                    placeholder="Masukkan Nama Kriteria Penilaian">
                                                                @error('update_nama_kriteria_penilaian')
                                                                    <div id="update_nama_kriteria_penilaian"
                                                                        class="form-text pb-1">
                                                                        {{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="update_status">Status</label>
                                                                <select
                                                                    class="form-control @error('update_status') is-invalid @enderror"
                                                                    id="update_status" name="update_status">
                                                                    <option value="">Pilih Status Kriteria Penilaian
                                                                    </option>
                                                                    <option value="true"
                                                                        {{ $item->status == true ? 'selected' : '' }}>
                                                                        Aktif
                                                                    </option>
                                                                    <option value="false"
                                                                        {{ $item->status == false ? 'selected' : '' }}>
                                                                        Non-Aktif
                                                                    </option>
                                                                </select>
                                                                @error('update_status')
                                                                    <div id="update_status" class="form-text pb-1">
                                                                        {{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        data-dismiss="modal">Batal</button>
                                                </form>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
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
    </div>
    </div>
    <!--end row-->

    <!--  Modal content for the above example -->
    <div class="modal fade modalCreate" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Tambah Kriteria Penilaian Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('koordinator.kriteria.penilaian.create') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="create_nama_kriteria_penilaian">Nama Kriteria Penilaian</label>
                                    <input type="text"
                                        class="form-control @error('create_nama_kriteria_penilaian') is-invalid @enderror"
                                        id="create_nama_kriteria_penilaian" name="create_nama_kriteria_penilaian"
                                        placeholder="Masukkan Nama Kriteria penilaian">
                                    @error('create_nama_kriteria_penilaian')
                                        <div id="create_nama_kriteria_penilaian" class="form-text pb-1">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="create_status">Status</label>
                                    <select class="form-control @error('create_status') is-invalid @enderror"
                                        id="create_status" name="create_status">
                                        <option value="">Pilih Status Kriteria Penilaian</option>
                                        <option value="true">Aktif</option>
                                        <option value="false">Non-Aktif</option>
                                    </select>
                                    @error('create_status')
                                        <div id="create_status" class="form-text pb-1">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary" id="sa-success">Tambah</button>
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
