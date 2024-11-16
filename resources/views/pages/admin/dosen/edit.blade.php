@extends('layouts.base.base-template')

@section('title')
    <title>Edit Dosen | SiMagang</title>
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
                    <h4 class="page-title">Edit Dosen</h4>
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
                        <form action="{{ route('admin.dosen.update', $dosen->id) }}" method="POST">
                            @method('put')
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_dosen">Nama Dosen</label>
                                        <input type="text" class="form-control @error('nama_dosen') is-invalid @enderror"
                                            id="nama_dosen" name="nama_dosen" placeholder="Masukkan Nama Dosen"
                                            value="{{ $dosen->nama_dosen }}">
                                        @error('nama_dosen')
                                            <div id="nama_dosen" class="form-text pb-1">
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
                                            <option value="L" {{ $dosen->jenis_kelamin == 'L' ? 'selected' : '' }}>
                                                Laki-laki
                                            </option>
                                            <option value="P" {{ $dosen->jenis_kelamin == 'P' ? 'selected' : '' }}>
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
                                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" placeholder="Masukkan Alamat Email"
                                            value="{{ $dosen->email }}">
                                        @error('email')
                                            <div id="email" class="form-text pb-1">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nomor_telp">Nomor Telepon</label>
                                        <input type="number" class="form-control @error('nomor_telp') is-invalid @enderror"
                                            id="nomor_telp" name="nomor_telp" placeholder="08xxxxxxxxxx"
                                            value="{{ $dosen->nomor_telp }}">
                                        @error('nomor_telp')
                                            <div id="nomor_telp" class="form-text pb-1">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nip">NIP</label>
                                        <input type="number" class="form-control @error('nip') is-invalid @enderror"
                                            id="nip" name="nip" placeholder="xxxxxxxxxxxxxxxxxx"
                                            value="{{ $dosen->nip }}">
                                        @error('nip')
                                            <div id="nip" class="form-text pb-1">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nidn">NIDN</label>
                                        <input type="number" class="form-control @error('nidn') is-invalid @enderror"
                                            id="nidn" name="nidn" placeholder="xxxxxxxxxxxxxxxxxx"
                                            value="{{ $dosen->nidn }}">
                                        @error('nidn')
                                            <div id="nidn" class="form-text pb-1">
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
                                                    {{ $dosen->id_prodi == $item->id ? 'selected' : '' }}>
                                                    {{ $item->nama_program_studi }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_prodi')
                                            <div id="id_prodi" class="form-text pb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" cols="30"
                                            rows="5" placeholder="Masukkan Alamat">{{ $dosen->alamat }}</textarea>
                                        @error('alamat')
                                            <div id="alamat" class="form-text pb-1">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-sm btn-primary" id="sa-success">Ubah</button>
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
