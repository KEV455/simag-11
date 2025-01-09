@extends('layouts.base.base-template')

@section('title')
    <title>Manajemen Semester | SiMagang</title>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Manajemen Semester</h4>
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
                                class="mdi mdi-plus-circle-outline mr-2"></i>Tambah Semester Baru</button>
                        <div class="table-responsive">
                            @php
                                $no = 1;
                            @endphp
                            <table id="datatable" class="table">
                                <thead class="thead-light">
                                    <tr class="text-center">
                                        <th width="10%">No</th>
                                        <th class="text-left">Nama Semester</th>
                                        <th class="text-left">Kode Semester</th>
                                        <th class="text-left">Semester</th>
                                        <th class="text-left">Tahun Ajaran</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                    <!--end tr-->
                                </thead>

                                <tbody>
                                    @foreach ($semesters as $item)
                                        <tr class="text-center">
                                            <td>{{ $no }}</td>
                                            <td class="text-left">{{ $item->nama_semester }}</td>
                                            <td class="text-left">{{ $item->kode_semester }}</td>
                                            <td class="text-left">{{ $item->semester }}</td>
                                            <td class="text-left">{{ $item->tahun_ajaran }}</td>
                                            <td>
                                                <a href="{{ route('admin.semester.update', $item->id) }}" class="mr-2"
                                                    data-toggle="modal" data-animation="bounce"
                                                    data-target=".modalUpdate{{ $item->id }}">
                                                    <i class="fas fa-edit text-info font-16"></i>
                                                </a>
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
                                                            Semester</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.semester.update', $item->id) }}"
                                                            method="POST">
                                                            @method('put')
                                                            @csrf

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="update_nama_semester">Nama
                                                                            Semester</label>
                                                                        <input type="text"
                                                                            class="form-control @error('update_nama_semester') is-invalid @enderror"
                                                                            id="update_nama_semester"
                                                                            name="update_nama_semester"
                                                                            placeholder="Masukkan Nama Semester"
                                                                            value="{{ $item->nama_semester }}">
                                                                        @error('update_nama_semester')
                                                                            <div id="update_nama_semester"
                                                                                class="form-text pb-1">
                                                                                {{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="update_kode_semester">Kode
                                                                            Semester</label>
                                                                        <input type="text"
                                                                            class="form-control @error('update_kode_semester') is-invalid @enderror"
                                                                            id="update_kode_semester"
                                                                            name="update_kode_semester"
                                                                            placeholder="Masukkan Kode Semester"
                                                                            value="{{ $item->kode_semester }}">
                                                                        @error('update_kode_semester')
                                                                            <div id="update_kode_semester"
                                                                                class="form-text pb-1">
                                                                                {{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="update_semester">Semester</label>
                                                                        <select
                                                                            class="form-control @error('update_semester') is-invalid @enderror"
                                                                            id="update_semester" name="update_semester">
                                                                            <option value="">Pilih Semester
                                                                            </option>
                                                                            <option value="1"
                                                                                {{ $item->semester == '1' ? 'selected' : '' }}>
                                                                                1 (Ganjil)</option>
                                                                            <option value="2"
                                                                                {{ $item->semester == '2' ? 'selected' : '' }}>
                                                                                2 (Genap)</option>
                                                                        </select>
                                                                        @error('update_semester')
                                                                            <div id="update_semester" class="form-text pb-1">
                                                                                {{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="update_tahun_ajaran">Tahun
                                                                            Ajaran</label>
                                                                        <input type="text"
                                                                            class="form-control @error('update_tahun_ajaran') is-invalid @enderror"
                                                                            id="update_tahun_ajaran"
                                                                            name="update_tahun_ajaran"
                                                                            placeholder="Masukkan Tahun Ajaran"
                                                                            value="{{ $item->tahun_ajaran }}">
                                                                        @error('update_tahun_ajaran')
                                                                            <div id="update_tahun_ajaran"
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
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Tambah Semester Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.semester.create') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="create_nama_semester">Nama Semester</label>
                                    <input type="text"
                                        class="form-control @error('create_nama_semester') is-invalid @enderror"
                                        id="create_nama_semester" name="create_nama_semester"
                                        placeholder="Masukkan Nama Semester">
                                    @error('create_nama_semester')
                                        <div id="create_nama_semester" class="form-text pb-1">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="create_kode_semester">Kode Semester</label>
                                    <input type="number"
                                        class="form-control @error('create_kode_semester') is-invalid @enderror"
                                        id="create_kode_semester" name="create_kode_semester"
                                        placeholder="Masukkan Kode Semester">
                                    @error('create_kode_semester')
                                        <div id="create_kode_semester" class="form-text pb-1">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="create_semester">Semester</label>
                                    <select class="form-control @error('create_semester') is-invalid @enderror"
                                        id="create_semester" name="create_semester">
                                        <option value="">Pilih Semester</option>
                                        <option value="1">1 (Ganjil)</option>
                                        <option value="2">2 (Genap)</option>
                                    </select>
                                    @error('create_semester')
                                        <div id="create_semester" class="form-text pb-1">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="create_tahun_ajaran">Tahun Ajaran</label>
                                    <input type="number"
                                        class="form-control @error('create_tahun_ajaran') is-invalid @enderror"
                                        id="create_tahun_ajaran" name="create_tahun_ajaran"
                                        placeholder="Masukkan Tahun Ajaran">
                                    @error('create_tahun_ajaran')
                                        <div id="create_tahun_ajaran" class="form-text pb-1">
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
