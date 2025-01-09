@extends('layouts.base.base-template')

@section('title')
    <title>Manajemen Dosen Pembimbing | SiMagang</title>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Manajemen Dosen Pembimbing</h4>
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
                                class="mdi mdi-plus-circle-outline mr-2"></i>Tambah Dosen Pembimbing Baru</button>
                        <div class="table-responsive">
                            @php
                                $no = 1;
                            @endphp
                            <table id="datatable" class="table">
                                <thead class="thead-light">
                                    <tr class="text-center">
                                        <th width="10%">No</th>
                                        <th class="text-left">Nama Dosen</th>
                                        <th class="text-left">Kuota Dosen Pembimbing</th>
                                        <th class="text-left">Nama Program Studi</th>
                                        <th class="text-left">Status</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                    <!--end tr-->
                                </thead>

                                <tbody>

                                    @foreach ($dosen_pembimbing as $item)
                                        <tr class="text-center">
                                            <td>{{ $no }}</td>
                                            <td class="text-left">{{ $item->dosen->nama_dosen }}</td>
                                            <td class="text-left">{{ $item->kuota }}</td>
                                            <td class="text-left">{{ $item->dosen->prodi->nama_program_studi }}</td>
                                            <td class="text-left">{{ $item->status }}</td>
                                            <td>
                                                <a href="{{ route('kaprodi.pembimbing.magang.index', $item->id) }}"><i
                                                        class="fa-solid fa-eye text-primary font-16"
                                                        title="Mahasiswa"></i></a> &ensp;
                                                <a href="{{ route('kaprodi.dospem.update', $item->id) }}" class="mr-2"
                                                    data-toggle="modal" data-animation="bounce"
                                                    data-target=".modalUpdate{{ $item->id }}"><i
                                                        class="fas fa-edit text-info font-16"></i></a>

                                                <a href="{{ route('kaprodi.dospem.destroy', $item->id) }}"><i
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
                                                            Dosen Pembimbing</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('kaprodi.dospem.update', $item->id) }}"
                                                            method="POST">
                                                            @method('put')
                                                            @csrf

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="update_id_dosen">Dosen
                                                                            <span class="text-primary">*(Bawaan:
                                                                                {{ $item->dosen->nama_dosen }})</span>
                                                                        </label>
                                                                        <select
                                                                            class="form-control @error('update_id_dosen') is-invalid @enderror"
                                                                            id="update_id_dosen" name="update_id_dosen">
                                                                            <option value="">Pilih Dosen
                                                                            </option>
                                                                            @foreach ($dosen as $data)
                                                                                <option value="{{ $data->id }}"
                                                                                    {{ $item->id_dosen == $data->id ? 'selected' : '' }}>
                                                                                    {{ $data->nama_dosen }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('update_id_dosen')
                                                                            <div id="update_id_dosen" class="form-text pb-1">
                                                                                {{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="update_kuota">Kuota Dosen
                                                                            Pembimbing</label>
                                                                        <input type="number"
                                                                            class="form-control @error('update_kuota') is-invalid @enderror"
                                                                            id="update_kuota" name="update_kuota"
                                                                            placeholder="Masukkan Kuota Dospem"
                                                                            min="1" value="{{ $item->kuota }}">
                                                                        @error('update_kuota')
                                                                            <div id="update_kuota" class="form-text pb-1">
                                                                                {{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="update_status">Status</label>
                                                                        <select
                                                                            class="form-control @error('update_status') is-invalid @enderror"
                                                                            id="update_status" name="update_status">
                                                                            <option value="">Pilih Status
                                                                            </option>
                                                                            <option value="Aktif"
                                                                                {{ $item->status == 'Aktif' ? 'selected' : '' }}>
                                                                                Aktif</option>
                                                                            <option value="Tidak Aktif"
                                                                                {{ $item->status == 'Tidak Aktif' ? 'selected' : '' }}>
                                                                                Tidak Aktif</option>
                                                                        </select>
                                                                        @error('update_status')
                                                                            <div id="update_status" class="form-text pb-1">
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
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Tambah Dosen Pembimbing Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kaprodi.dospem.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="create_id_dosen">Dosen</label>
                                    <select class="form-control @error('create_id_dosen') is-invalid @enderror"
                                        id="create_id_dosen" name="create_id_dosen">
                                        <option value="">Pilih Dosen</option>
                                        @foreach ($dosen as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama_dosen }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('create_id_dosen')
                                        <div id="create_id_dosen" class="form-text pb-1">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="create_kuota">Kuota Dosen Pembimbing</label>
                                    <input type="number" class="form-control @error('create_kuota') is-invalid @enderror"
                                        id="create_kuota" name="create_kuota" placeholder="Masukkan Kuota Dospem"
                                        min="1">
                                    @error('create_kuota')
                                        <div id="create_kuota" class="form-text pb-1">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="create_status">Status</label>
                                    <select class="form-control @error('create_status') is-invalid @enderror"
                                        id="create_status" name="create_status">
                                        <option value="">Pilih Status</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Tidak Aktif">Tidak Aktif</option>
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
