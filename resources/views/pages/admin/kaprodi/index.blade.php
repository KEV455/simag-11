@extends('layouts.base.base-template')

@section('title')
    <title>Manajemen Kaprodi | SiMagang</title>
@endsection

@php
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
@endphp

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Manajemen Kaprodi</h4>
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
                                class="mdi mdi-plus-circle-outline mr-2"></i>Tambah Kaprodi Baru</button>
                        <div class="table-responsive">
                            @php
                                $no = 1;
                            @endphp
                            <table id="datatable" class="table">
                                <thead class="thead-light">
                                    <tr class="text-center">
                                        <th width="10%">No</th>
                                        <th class="text-left">Nama Kaprodi</th>
                                        <th class="text-left">Nama Program Studi</th>
                                        <th class="text-left">Periode Mulai</th>
                                        <th class="text-left">Periode Selesai</th>
                                        <th class="text-left">Status</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                    <!--end tr-->
                                </thead>

                                <tbody>

                                    @foreach ($kaprodis as $item)
                                        <tr class="text-center">
                                            <td>{{ $no }}</td>
                                            <td class="text-left">{{ $item->user->name }}</td>
                                            <td class="text-left">{{ $item->prodi->nama_program_studi }}</td>
                                            <td class="text-left">{{ dateConversion($item->periode_mulai) }}</td>
                                            <td class="text-left">{{ dateConversion($item->periode_selesai) }}</td>
                                            <td class="text-left">{{ $item->status }}</td>
                                            <td>
                                                <a href="{{ route('admin.kaprodi.update', $item->id) }}" class="mr-2"
                                                    data-toggle="modal" data-animation="bounce"
                                                    data-target=".modalUpdate{{ $item->id }}"><i
                                                        class="fas fa-edit text-info font-16"></i></a>
                                                <a href="{{ route('admin.kaprodi.destroy', $item->id) }}"><i
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
                                                            Kaprodi</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.kaprodi.update', $item->id) }}"
                                                            method="POST">
                                                            @method('put')
                                                            @csrf

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="update_id_user">User Kaprodi
                                                                            <span class="text-primary">*(Bawaan:
                                                                                {{ $item->user->name }})</span>
                                                                        </label>
                                                                        <select
                                                                            class="form-control @error('update_id_user') is-invalid @enderror"
                                                                            id="update_id_user" name="update_id_user">
                                                                            <option value="">Pilih User Kaprodi
                                                                            </option>
                                                                            @foreach ($user_kaprodi_filter as $data)
                                                                                <option value="{{ $data->id }}"
                                                                                    {{ $item->id_user == $data->id ? 'selected' : '' }}>
                                                                                    {{ $data->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('update_id_user')
                                                                            <div id="update_id_user" class="form-text pb-1">
                                                                                {{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="update_id_prodi">Program Studi</label>
                                                                        <select
                                                                            class="form-control @error('update_id_prodi') is-invalid @enderror"
                                                                            id="update_id_prodi" name="update_id_prodi"
                                                                            disabled>
                                                                            <option value="">Pilih Prodi</option>
                                                                            @foreach ($prodi_all as $data)
                                                                                <option value="{{ $data->id }}"
                                                                                    {{ $item->id_prodi == $data->id ? 'selected' : '' }}>
                                                                                    {{ $data->nama_program_studi }}
                                                                                    ({{ $data->jurusan->nama_jurusan }})
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('update_id_prodi')
                                                                            <div id="update_id_prodi" class="form-text pb-1">
                                                                                {{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="update_periode_mulai">Tanggal Periode
                                                                            Mulai</label>
                                                                        <input type="date"
                                                                            class="form-control @error('update_periode_mulai') is-invalid @enderror"
                                                                            id="update_periode_mulai"
                                                                            name="update_periode_mulai"
                                                                            value="{{ $item->periode_mulai }}">
                                                                        @error('update_periode_mulai')
                                                                            <div id="update_periode_mulai"
                                                                                class="form-text pb-1">
                                                                                {{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="update_periode_selesai">Tanggal Periode
                                                                            Selesai</label>
                                                                        <input type="date"
                                                                            class="form-control @error('update_periode_selesai') is-invalid @enderror"
                                                                            id="update_periode_selesai"
                                                                            name="update_periode_selesai"
                                                                            value="{{ $item->periode_selesai }}">
                                                                        @error('update_periode_selesai')
                                                                            <div id="update_periode_selesai"
                                                                                class="form-text pb-1">
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
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Tambah Kaprodi Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.kaprodi.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="create_id_user">User Kaprodi</label>
                                    <select class="form-control @error('create_id_user') is-invalid @enderror"
                                        id="create_id_user" name="create_id_user">
                                        <option value="">Pilih User Kaprodi</option>
                                        @foreach ($user_kaprodi_filter as $data)
                                            <option value="{{ $data->id }}">{{ $data->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('create_id_user')
                                        <div id="create_id_user" class="form-text pb-1">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="create_id_prodi">Program Studi</label>
                                    <select class="form-control @error('create_id_prodi') is-invalid @enderror"
                                        id="create_id_prodi" name="create_id_prodi">
                                        <option value="">Pilih Prodi</option>
                                        @foreach ($prodi_filter as $data)
                                            <option value="{{ $data->id }}">
                                                {{ $data->nama_program_studi }} ({{ $data->jurusan->nama_jurusan }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('create_id_prodi')
                                        <div id="create_id_prodi" class="form-text pb-1">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="create_periode_mulai">Tanggal Periode Mulai</label>
                                    <input type="date"
                                        class="form-control @error('create_periode_mulai') is-invalid @enderror"
                                        id="create_periode_mulai" name="create_periode_mulai">
                                    @error('create_periode_mulai')
                                        <div id="create_periode_mulai" class="form-text pb-1">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="create_periode_selesai">Tanggal Periode Selesai</label>
                                    <input type="date"
                                        class="form-control @error('create_periode_selesai') is-invalid @enderror"
                                        id="create_periode_selesai" name="create_periode_selesai">
                                    @error('create_periode_selesai')
                                        <div id="create_periode_selesai" class="form-text pb-1">
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
