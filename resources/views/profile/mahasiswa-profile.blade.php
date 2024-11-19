@extends('layouts.base.base-template')

@section('title')
    <title>Update Profile Mahasiswa | SiMagang</title>
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
                    <h4 class="page-title">Ubah Profile Mahasiswa</h4>
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
                        <form action="{{ route('profile.mahasiswa.update', Auth()->user()->id) }}" method="POST">
                            @method('put')
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    {{-- Form Mahasiswa --}}
                                    <div class="ribbon-1">
                                        <div class="ribbon-box">
                                            <div class="ribbon ribbon-mark bg-primary">Data Mahasiswa</div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="nama_mahasiswa">Nama Mahasiswa</label>
                                                        <input type="text"
                                                            class="form-control @error('nama_mahasiswa') is-invalid @enderror"
                                                            id="nama_mahasiswa" name="nama_mahasiswa"
                                                            placeholder="Masukkan Nama Mahasiswa"
                                                            value="{{ $mahasiswa->nama_mahasiswa }}">
                                                        @error('nama_mahasiswa')
                                                            <div id="nama_mahasiswa" class="form-text pb-1">
                                                                {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                                        <select
                                                            class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                                            id="jenis_kelamin" name="jenis_kelamin">
                                                            <option value="">Pilih Gender</option>
                                                            <option value="L"
                                                                {{ $mahasiswa->jenis_kelamin == 'L' ? 'selected' : '' }}>
                                                                Laki-laki
                                                            </option>
                                                            <option value="P"
                                                                {{ $mahasiswa->jenis_kelamin == 'P' ? 'selected' : '' }}>
                                                                Perempuan
                                                            </option>
                                                        </select>
                                                        @error('jenis_kelamin')
                                                            <div id="jenis_kelamin" class="form-text pb-1">
                                                                {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            id="email" name="email"
                                                            placeholder="Masukkan Alamat Email"
                                                            value="{{ $mahasiswa->email }}">
                                                        @error('email')
                                                            <div id="email" class="form-text pb-1">
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
                                                            value="{{ $mahasiswa->user->username }}" disabled>
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
                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</a>
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

    {{-- upload file name --}}
    <script>
        function displayFileName() {
            const input = document.getElementById('foto');
            const label = document.getElementById('fileLabel');
            const fileName = input.files[0].name;
            label.textContent = fileName;
        }
    </script>
@endsection
