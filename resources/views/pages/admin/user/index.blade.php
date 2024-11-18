@extends('layouts.base.base-template')

@section('title')
    <title>Manajemen User | SiMagang</title>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Manajemen User</h4>
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
                                class="mdi mdi-plus-circle-outline mr-2"></i>Tambah User Baru</button>

                        <div class="table-responsive">
                            @php
                                $no = 1;
                            @endphp
                            <table id="datatable" class="table">
                                <thead class="thead-light">
                                    <tr class="text-center">
                                        <th width="10%">No</th>
                                        <th class="text-left">Nama</th>
                                        <th class="text-left">Username</th>
                                        <th class="text-left">Email</th>
                                        <th class="text-left">Role</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                    <!--end tr-->
                                </thead>

                                <tbody>
                                    @foreach ($user as $data)
                                        <tr class="text-center">
                                            <td>{{ $no }}</td>
                                            <td class="text-left">{{ $data->name }}</td>
                                            <td class="text-left">{{ $data->username }}</td>
                                            <td class="text-left">{{ $data->email }}</td>
                                            <td class="text-left">{{ $data->role }}</td>
                                            <td>
                                                <a href="#" class="mr-2" data-animation="bounce">
                                                    <i class="fas fa-edit text-info font-16"></i>
                                                </a>
                                                <a href="{{ route('admin.user.destroy', $data->id) }}">
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
    <!--  Modal content for the above example -->
    <div class="modal fade modalCreate" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Tambah User Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.user.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="create_name">Nama</label>
                                    <input type="text" class="form-control @error('create_name') is-invalid @enderror"
                                        id="create_name" name="create_name" placeholder="Masukkan Nama ">
                                    @error('create_name')
                                        <div id="create_name" class="form-text pb-1">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="create_username">Username</label>
                                    <input type="text"
                                        class="form-control @error('create_username') is-invalid @enderror"
                                        id="create_username" name="create_username" placeholder="Masukkan username ">
                                    @error('create_username')
                                        <div id="create_username" class="form-text pb-1">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="create_email">Email</label>
                                    <input type="text" class="form-control @error('create_email') is-invalid @enderror"
                                        id="create_email" name="create_email" placeholder="Masukkan email ">
                                    @error('create_email')
                                        <div id="create_email" class="form-text pb-1">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="create_password">Password</label>
                                    <input type="password"
                                        class="form-control @error('create_password') is-invalid @enderror"
                                        id="create_password" name="create_password" placeholder="Masukkan password">
                                    @error('create_password')
                                        <div id="create_password" class="form-text pb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="create_password_confirmation">Konfirmasi Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="create_password_confirmation" name="create_password_confirmation"
                                        placeholder="Masukkan konfirmasi password">
                                    @error('create_password_confirmation')
                                        <div id="create_password_confirmation" class="form-text pb-1">{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="create_role">Role</label>
                                    <select class="form-control @error('create_role') is-invalid @enderror"
                                        id="create_role" name="create_role">
                                        <option value="">Pilih Role</option>
                                        <option value="admin">Admin</option>
                                        <option value="mahasiswa">Mahasiswa</option>
                                        <option value="dosen">Dosen</option>
                                        <option value="dospem">Dosen Pembimbing</option>
                                        <option value="kaprodi">Kaprodi</option>
                                        <option value="koordinator">Koordinator Magang</option>
                                    </select>
                                    @error('create_role')
                                        <div id="create_role" class="form-text pb-1">
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
