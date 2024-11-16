@extends('layouts.base.base-template')

@section('title')
    <title>Tambah Mahasiswa | SiMagang</title>
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
                    <h4 class="page-title">Tambah Mahasiswa Baru</h4>
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
                        <form action="{{ route('admin.mahasiswa.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_mahasiswa">Nama Mahasiswa</label>
                                        <input type="text"
                                            class="form-control @error('nama_mahasiswa') is-invalid @enderror"
                                            id="nama_mahasiswa" name="nama_mahasiswa" placeholder="Masukkan Nama Mahasiswa"
                                            value="{{ old('nama_mahasiswa') }}">
                                        @error('nama_mahasiswa')
                                            <div id="nama_mahasiswa" class="form-text pb-1">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                        <select class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                            id="jenis_kelamin" name="jenis_kelamin">
                                            <option value="">Pilih Gender</option>
                                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>
                                                Laki-laki
                                            </option>
                                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>
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
                                        <label for="nim">Nim</label>
                                        <input type="number" class="form-control @error('nim') is-invalid @enderror"
                                            id="nim" name="nim" placeholder="Masukkan Nim Mahasiswa"
                                            value="{{ old('nim') }}">
                                        @error('nim')
                                            <div id="nim" class="form-text pb-1">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="angkatan">Angkatan</label>
                                        <input type="number" class="form-control @error('angkatan') is-invalid @enderror"
                                            id="angkatan" name="angkatan" placeholder="2024"
                                            value="{{ old('angkatan') }}">
                                        @error('angkatan')
                                            <div id="angkatan" class="form-text pb-1">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" placeholder="Masukkan Alamat Email"
                                            value="{{ old('email') }}">
                                        @error('email')
                                            <div id="email" class="form-text pb-1">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_prodi">Prodi</label>
                                        <select class="form-control select2 @error('id_prodi') is-invalid @enderror"
                                            id="id_prodi" name="id_prodi" required>
                                            <option value="">Pilih Prodi</option>
                                            @foreach ($prodis as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('id_prodi') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->nama_program_studi }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_prodi')
                                            <div id="id_prodi" class="form-text pb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-sm btn-primary" id="sa-success">Tambah</button>
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
@endsection
