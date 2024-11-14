@extends('layouts.base.base-template')

@section('title')
    <title>Manajemen Prodi | SiMagang</title>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Manajemen Prodi</h4>
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
                                class="mdi mdi-plus-circle-outline mr-2"></i>Tambah Prodi Baru</button>
                        <div class="table-responsive">
                            @php
                                $no = 1;
                            @endphp
                            <table id="datatable" class="table">
                                <thead class="thead-light">
                                    <tr class="text-center">
                                        <th width="10%">No</th>
                                        <th class="text-left">Jenjang Pendidikan</th>
                                        <th class="text-left">Nama Program Studi</th>
                                        <th class="text-left">Jurusan</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                    <!--end tr-->
                                </thead>

                                <tbody>

                                    @foreach ($prodis as $item)
                                        <tr class="text-center">
                                            <td>{{ $no }}</td>
                                            <td class="text-left">{{ $item->jenjang_pendidikan }}</td>
                                            <td class="text-left">{{ $item->nama_program_studi }}</td>
                                            <td class="text-left">{{ $item->jurusan->nama_jurusan }}</td>
                                            <td>
                                                <a href="{{ route('admin.prodi.update', $item->id) }}" class="mr-2"
                                                    data-toggle="modal" data-animation="bounce"
                                                    data-target=".modalUpdate{{ $item->id }}"><i
                                                        class="fas fa-edit text-info font-16"></i></a>
                                                <a href="{{ route('admin.prodi.destroy', $item->id) }}"><i
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
                                                            Prodi</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.prodi.update', $item->id) }}"
                                                            method="POST">
                                                            @method('put')
                                                            @csrf

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="update_nama_program_studi">Nama
                                                                            Program Studi</label>
                                                                        <input type="text"
                                                                            class="form-control @error('update_nama_program_studi') is-invalid @enderror"
                                                                            id="update_nama_program_studi"
                                                                            name="update_nama_program_studi"
                                                                            placeholder="Masukkan Nama Program Studi"
                                                                            value="{{ $item->nama_program_studi }}">
                                                                        @error('update_nama_program_studi')
                                                                            <div id="update_nama_program_studi"
                                                                                class="form-text pb-1">
                                                                                {{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="update_jenjang_pendidikan">Jenjang
                                                                            Pendidikan</label>
                                                                        <select
                                                                            class="form-control @error('update_jenjang_pendidikan') is-invalid @enderror"
                                                                            id="update_jenjang_pendidikan"
                                                                            name="update_jenjang_pendidikan">
                                                                            <option value="">Pilih Jenjang Pendidikan
                                                                            </option>
                                                                            <option value="D3"
                                                                                {{ $item->jenjang_pendidikan == 'D3' ? 'selected' : '' }}>
                                                                                D3</option>
                                                                            <option value="D4"
                                                                                {{ $item->jenjang_pendidikan == 'D4' ? 'selected' : '' }}>
                                                                                D4</option>
                                                                            <option value="S1"
                                                                                {{ $item->jenjang_pendidikan == 'S1' ? 'selected' : '' }}>
                                                                                S1</option>
                                                                        </select>
                                                                        @error('update_jenjang_pendidikan')
                                                                            <div id="update_jenjang_pendidikan"
                                                                                class="form-text pb-1">
                                                                                {{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="update_id_jurusan">Jurusan</label>
                                                                        <select
                                                                            class="form-control @error('update_id_jurusan') is-invalid @enderror"
                                                                            id="update_id_jurusan" name="update_id_jurusan">
                                                                            <option value="">Pilih Jurusan
                                                                            </option>
                                                                            @foreach ($jurusans as $data)
                                                                                <option value="{{ $data->id }}"
                                                                                    {{ $item->id_jurusan == $data->id ? 'selected' : '' }}>
                                                                                    {{ $data->nama_jurusan }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('update_id_jurusan')
                                                                            <div id="update_id_jurusan" class="form-text pb-1">
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
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Tambah Prodi Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.prodi.create') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="create_nama_program_studi">Nama Program Studi</label>
                                    <input type="text"
                                        class="form-control @error('create_nama_program_studi') is-invalid @enderror"
                                        id="create_nama_program_studi" name="create_nama_program_studi"
                                        placeholder="Masukkan Nama Program Studi">
                                    @error('create_nama_program_studi')
                                        <div id="create_nama_program_studi" class="form-text pb-1">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="create_jenjang_pendidikan">Jenjang Pendidikan</label>
                                    <select class="form-control @error('create_jenjang_pendidikan') is-invalid @enderror"
                                        id="create_jenjang_pendidikan" name="create_jenjang_pendidikan">
                                        <option value="">Pilih Jenjang Pendidikan</option>
                                        <option value="D3">D3</option>
                                        <option value="D4">D4</option>
                                        <option value="S1">S1</option>
                                    </select>
                                    @error('create_jenjang_pendidikan')
                                        <div id="create_jenjang_pendidikan" class="form-text pb-1">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="create_id_jurusan">Jurusan</label>
                                    <select class="form-control @error('create_id_jurusan') is-invalid @enderror"
                                        id="create_id_jurusan" name="create_id_jurusan">
                                        <option value="">Pilih Divisi</option>
                                        @foreach ($jurusans as $dataJurusan)
                                            <option value="{{ $dataJurusan->id }}">{{ $dataJurusan->nama_jurusan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('create_id_jurusan')
                                        <div id="create_id_jurusan" class="form-text pb-1">
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
