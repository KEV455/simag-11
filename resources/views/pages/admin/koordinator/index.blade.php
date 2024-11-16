@extends('layouts.base.base-template')

@section('title')
    <title>Manajemen Koordinator | SiMagang</title>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Manajemen Koordinator</h4>
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
                                class="mdi mdi-plus-circle-outline mr-2"></i>Tambah Koordinator Baru</button>
                        <div class="table-responsive">
                            @php
                                $no = 1;
                            @endphp
                            <table id="datatable" class="table">
                                <thead class="thead-light">
                                    <tr class="text-center">
                                        <th width="10%">No</th>
                                        <th class="text-left">Nama Koordinator</th>
                                        <th class="text-left">Alamat Email</th>
                                        <th class="text-left">Nomor Telepon</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                    <!--end tr-->
                                </thead>

                                <tbody>

                                    @foreach ($koordinators as $item)
                                        <tr class="text-center">
                                            <td>{{ $no }}</td>
                                            <td class="text-left">{{ $item->nama }}</td>
                                            <td class="text-left">{{ $item->email }}</td>
                                            <td class="text-left">{{ $item->nomor_telp }}</td>
                                            <td>
                                                <a href="{{ route('admin.koordinator.update', $item->id) }}" class="mr-2"
                                                    data-toggle="modal" data-animation="bounce"
                                                    data-target=".modalUpdate{{ $item->id }}"><i
                                                        class="fas fa-edit text-info font-16"></i></a>
                                                <a href="{{ route('admin.koordinator.destroy', $item->id) }}"><i
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
                                                            Koordinator</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.koordinator.update', $item->id) }}"
                                                            method="POST">
                                                            @method('put')
                                                            @csrf

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="update_nama">Nama
                                                                            Koodinator</label>
                                                                        <input type="text"
                                                                            class="form-control @error('update_nama') is-invalid @enderror"
                                                                            id="update_nama" name="update_nama"
                                                                            placeholder="Masukkan Nama Koordinator"
                                                                            value="{{ $item->nama }}">
                                                                        @error('update_nama')
                                                                            <div id="update_nama" class="form-text pb-1">
                                                                                {{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="update_email">Email</label>
                                                                        <input type="text"
                                                                            class="form-control @error('update_email') is-invalid @enderror"
                                                                            id="update_email" name="update_email"
                                                                            placeholder="Masukkan Alamat Email"
                                                                            value="{{ $item->email }}">
                                                                        @error('update_email')
                                                                            <div id="update_email" class="form-text pb-1">
                                                                                {{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="update_nomor_telp">Nomor Telepon</label>
                                                                        <input type="number"
                                                                            class="form-control @error('update_nomor_telp') is-invalid @enderror"
                                                                            id="update_nomor_telp" name="update_nomor_telp"
                                                                            placeholder="08xxxxxxxxxx"
                                                                            value="{{ $item->nomor_telp }}">
                                                                        @error('update_nomor_telp')
                                                                            <div id="update_nomor_telp" class="form-text pb-1">
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
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Tambah Koordinator Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.koordinator.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="create_nama">Nama Koordinator</label>
                                    <input type="text" class="form-control @error('create_nama') is-invalid @enderror"
                                        id="create_nama" name="create_nama" placeholder="Masukkan Nama Koordinator">
                                    @error('create_nama')
                                        <div id="create_nama" class="form-text pb-1">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="create_email">Email</label>
                                    <input type="text" class="form-control @error('create_email') is-invalid @enderror"
                                        id="create_email" name="create_email" placeholder="Masukkan Alamat Email">
                                    @error('create_email')
                                        <div id="create_email" class="form-text pb-1">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="create_nomor_telp">Nomor Telepon</label>
                                    <input type="number"
                                        class="form-control @error('create_nomor_telp') is-invalid @enderror"
                                        id="create_nomor_telp" name="create_nomor_telp" placeholder="08xxxxxxxxxx">
                                    @error('create_nomor_telp')
                                        <div id="create_nomor_telp" class="form-text pb-1">
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
