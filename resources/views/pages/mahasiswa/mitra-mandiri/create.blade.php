@extends('layouts.base.base-template')

@section('title')
    <title>Pengajuan Mitra Mandiri | SiMagang</title>
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
                    <h4 class="page-title">Ajukan Mitra Mandiri Baru</h4>
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
                        <form action="{{ route('mahasiswa.mitra.mandiri.store', Auth()->user()->id) }}"
                            enctype="multipart/form-data" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Nama Mitra</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            id="nama" name="nama" placeholder="Masukkan Nama Mitra Mandiri"
                                            value="{{ old('nama') }}">
                                        @error('nama')
                                            <div id="nama" class="form-text pb-1">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="narahubung">Narahubung</label>
                                        <input type="text" class="form-control @error('narahubung') is-invalid @enderror"
                                            id="narahubung" name="narahubung" placeholder="Masukkan Narahubung"
                                            value="{{ old('narahubung') }}">
                                        @error('narahubung')
                                            <div id="narahubung" class="form-text pb-1">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror"
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
                                        <label for="provinsi">Provinsi</label>
                                        <select class="form-control select2 @error('provinsi') is-invalid @enderror"
                                            id="provinsi" name="provinsi" required>
                                            <option value="">Pilih Provinsi</option>
                                            @foreach ($provinsis as $item)
                                                <option value="{{ $item->name }}"
                                                    {{ old('provinsi') == $item->name ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('provinsi')
                                            <div id="provinsi" class="form-text pb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kota">Kota</label>
                                        <select class="form-control select2 @error('kota') is-invalid @enderror"
                                            id="kota" name="kota" required>
                                            <option value="">Pilih Kota</option>
                                            @foreach ($kotas as $item)
                                                <option value="{{ $item->name }}"
                                                    {{ old('kota') == $item->name ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('kota')
                                            <div id="kota" class="form-text pb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" cols="30"
                                            rows="5" placeholder="Masukkan Alamat">{{ old('alamat') }}</textarea>
                                        @error('alamat')
                                            <div id="alamat" class="form-text pb-1">
                                                {{ $message }}</div>
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
