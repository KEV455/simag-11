@extends('layouts.base.base-template')

@section('title')
    <title>Update Profile DPL | SiMagang</title>
@endsection

@section('top-css')
    <link href="{{ asset('template/assets/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/assets/css/style.css') }}" rel="stylesheet" type="text/css" />\
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Ubah Profile DPL</h4>
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
                        <form action="{{ route('profile.dpl.update', $dpl_mitra->id) }}" method="POST">
                            @method('put')
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    {{-- Form DPL --}}
                                    <div class="ribbon-1">
                                        <div class="ribbon-box">
                                            <div class="ribbon ribbon-mark bg-primary">Data DPL</div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="nama">Nama DPL</label>
                                                        <input type="text"
                                                            class="form-control @error('nama') is-invalid @enderror"
                                                            id="nama" name="nama" placeholder="Ubah Nama DPL"
                                                            value="{{ $dpl_mitra->nama }}">
                                                        @error('nama')
                                                            <div id="nama" class="form-text pb-1">
                                                                {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="tanggal_lahir">Tanggal Lahir DPL</label>
                                                        <input type="date"
                                                            class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                                            id="tanggal_lahir" name="tanggal_lahir"
                                                            placeholder="Ubah Tanggal Lahir DPL"
                                                            value="{{ $dpl_mitra->tanggal_lahir }}">
                                                        @error('tanggal_lahir')
                                                            <div id="tanggal_lahir" class="form-text pb-1">
                                                                {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email">Email DPL</label>
                                                        <input type="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            id="email" name="email" placeholder="Ubah Alamat Email"
                                                            value="{{ $dpl_mitra->email }}">
                                                        @error('email')
                                                            <div id="email" class="form-text pb-1">
                                                                {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="nomor_telp">Nomor Telepon DPL</label>
                                                        <input type="number"
                                                            class="form-control @error('nomor_telp') is-invalid @enderror"
                                                            id="nomor_telp" name="nomor_telp" placeholder="08xxxxxxxxxx"
                                                            value="{{ $dpl_mitra->nomor_telp }}">
                                                        @error('nomor_telp')
                                                            <div id="nomor_telp" class="form-text pb-1">
                                                                {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Form User --}}
                                    <div class="ribbon-1">
                                        <div class="ribbon-box">
                                            <div class="ribbon ribbon-mark bg-info">Data User</div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="username">Username</label>
                                                        <input type="text"
                                                            class="form-control @error('username') is-invalid @enderror"
                                                            id="username" name="username" placeholder="Masukkan Username"
                                                            value="{{ $user->username }}">
                                                        @error('username')
                                                            <div id="username" class="form-text pb-1">
                                                                {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <span class="text-primary">*(Ketika di isi ulang, maka akan
                                                            mengubah password
                                                            sebelumnya)</span>
                                                        <input type="password"
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            id="password" name="password" placeholder="Masukkan password">
                                                        @error('password')
                                                            <div id="password" class="form-text pb-1">{{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="password_confirmation">Konfirmasi Password</label>
                                                        <input type="password"
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            id="password_confirmation" name="password_confirmation"
                                                            placeholder="Masukkan konfirmasi password">
                                                        @error('password_confirmation')
                                                            <div id="password_confirmation" class="form-text pb-1">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-sm btn-primary" id="sa-success">Update</button>
                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-danger"
                                data-dismiss="modal">Batal</a>
                        </form>
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div>
    </div>
@endsection

@section('bottom-script')
    <!-- jQuery  -->
    <script src="{{ asset('template/assets/js/jquery.min.js') }}"></script>

    <!-- Plugins js -->
    <script src="{{ asset('template/assets/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('template/assets/plugins/moment/moment.js') }}"></script>
    <script src="{{ asset('template/assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('template/assets/pages/jquery.forms-advanced.js') }}"></script>
@endsection
