@extends('layouts.base.base-template')

@section('title')
    <title>Pendaftaran Magang | SiMagang</title>
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
                    <h4 class="page-title">Pendaftaran Magang || {{ $lowongan->mitra->nama }} - {{ $lowongan->nama }} </h4>
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
                        <form action="{{ route('mahasiswa.pelamar.magang.store', $lowongan->id) }}"
                            enctype="multipart/form-data" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Nama Mitra</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            id="nama" name="nama" placeholder="Masukkan Nama Mitra Mandiri"
                                            value="{{ $lowongan->mitra->nama }}" disabled>
                                        @error('nama')
                                            <div id="nama" class="form-text pb-1">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Nama Lowongan</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            id="nama" name="nama" placeholder="Masukkan nama"
                                            value="{{ $lowongan->nama }}" disabled>
                                        @error('nama')
                                            <div id="nama" class="form-text pb-1">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggal_dibuka">tanggal Dibuka</label>
                                        <input type="text"
                                            class="form-control @error('tanggal_dibuka') is-invalid @enderror"
                                            id="tanggal_dibuka" name="tanggal_dibuka"
                                            placeholder="Masukkan Alamat tanggal_dibuka"
                                            value="{{ $lowongan->tanggal_dibuka }}" disabled>
                                        @error('tanggal_dibuka')
                                            <div id="tanggal_dibuka" class="form-text pb-1">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggal_ditutup">Tanggal Ditutup</label>
                                        <input type="text"
                                            class="form-control @error('tanggal_ditutup') is-invalid @enderror"
                                            id="tanggal_ditutup" name="tanggal_ditutup"
                                            placeholder="Masukkan Alamat tanggal_ditutup"
                                            value="{{ $lowongan->tanggal_ditutup }}" disabled>
                                        @error('tanggal_ditutup')
                                            <div id="tanggal_ditutup" class="form-text pb-1">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                @foreach ($berkas_lowongan as $index => $berkas)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="file-{{ $index }}">{{ $berkas->berkas->nama_berkas }} <span
                                                    class="text-primary">*(.pdf 5Mb)</span></label>
                                            <input type="file"
                                                class="form-control @error('file.' . $index) is-invalid @enderror"
                                                id="file-{{ $index }}" name="file[]" required>
                                            @error('file.' . $index)
                                                <div id="file-{{ $index }}" class="form-text pb-1">{{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                            @if ($prodiMhsAvailable)
                                <button type="submit" class="btn btn-sm btn-primary" id="sa-success">Submit</button>
                                <a href="{{ url()->previous() }}" class="btn btn-sm btn-danger"
                                    data-dismiss="modal">Batal</a>
                            @else
                                <a href="{{ url()->previous() }}" class="btn btn-outline-danger px-3">Anda Tidak Bisa
                                    Mendaftar</a>
                            @endif
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
