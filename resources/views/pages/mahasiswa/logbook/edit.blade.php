@extends('layouts.base.base-template')

@section('title')
    <title>Tambah Logbook | SiMagang</title>
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
                    <h4 class="page-title">Tambah Logbook Baru</h4>
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
                        <form action="{{ route('mahasiswa.logbook.update', $logbook->id) }}" enctype="multipart/form-data"
                            method="POST">
                            @method('put')
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="judul_kegiatan">Judul Kegiatan</label>
                                        <input type="text"
                                            class="form-control @error('judul_kegiatan') is-invalid @enderror"
                                            id="judul_kegiatan" name="judul_kegiatan"
                                            placeholder="Masukkan Judul Kegiatan Magang"
                                            value="{{ $logbook->judul_kegiatan }}">
                                        @error('judul_kegiatan')
                                            <div id="judul_kegiatan" class="form-text pb-1">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status Kehadiran</label>
                                        <select class="form-control @error('status') is-invalid @enderror" id="status"
                                            name="status">
                                            <option value="">Pilih Status</option>
                                            <option value="hadir"
                                                {{ $logbook->status_kehadiran == 'hadir' ? 'selected' : '' }}>Hadir
                                            </option>
                                            <option value="alpa"
                                                {{ $logbook->status_kehadiran == 'alpa' ? 'selected' : '' }}>Alpa
                                            </option>
                                            <option value="tidak ada keterangan"
                                                {{ $logbook->status_kehadiran == 'tidak ada keterangan' ? 'selected' : '' }}>
                                                Tidak Ada
                                                Keterangan
                                            </option>
                                        </select>
                                        @error('status')
                                            <div id="status" class="form-text pb-1">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Upload File --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="dokumentasi">Dokumentasi Kegiatan <span
                                                class="text-primary">*(Opsional,
                                                .png, .jpg, .jpeg 5Mb)</span></label>
                                        <div class="custom-file mb-3">
                                            <input type="file"
                                                class="custom-file-input form-control @error('dokumentasi') is-invalid @enderror"
                                                id="dokumentasi" name="dokumentasi" onchange="displayFileName()">
                                            <label class="custom-file-label" for="dokumentasi" id="fileLabel">
                                                <!-- Menampilkan nama file yang diunggah sebelumnya jika ada -->
                                                {{-- @if (session('dokumentasi'))
                                                    {{ session('dokumentasi') }}
                                                @elseif ($logbook->dokumentasi_kegiatan)
                                                    {{ $logbook->dokumentasi_kegiatan }}
                                                @else --}}
                                                Choose file
                                                {{-- @endif --}}
                                            </label>
                                            @error('dokumentasi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        @if ($logbook->dokumentasi_kegiatan !== null)
                                            <a href="{{ asset('storage/' . $logbook->dokumentasi_kegiatan) }}"
                                                target="_blank">
                                                <img width="250" class="img-thumbnail img-fluid"
                                                    src="{{ asset('storage/' . $logbook->dokumentasi_kegiatan) }}"
                                                    alt="Foto Kegiatan">
                                            </a>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggal_kegiatan">Tanggal Kegiatan</label>
                                        <input type="date"
                                            class="form-control @error('tanggal_kegiatan') is-invalid @enderror"
                                            id="tanggal_kegiatan" name="tanggal_kegiatan"
                                            placeholder="Masukkan Judul Kegiatan Magang"
                                            value="{{ $logbook->tanggal_kegiatan }}" required>
                                        @error('tanggal_kegiatan')
                                            <div id="tanggal_kegiatan" class="form-text pb-1">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi Kegiatan</label>
                                        <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" cols="30"
                                            rows="5" placeholder="Masukkan Deskripsi">{{ $logbook->deskripsi_kegiatan }}</textarea>
                                        @error('deskripsi')
                                            <div id="deskripsi" class="form-text pb-1">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-sm btn-primary" id="sa-success">Tambah</button>
                            <a href="{{ route('mahasiswa.logbook.index') }}" class="btn btn-sm btn-danger"
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
    <script src="{{ asset('template/assets/pages/jquery.form-editor.init.js') }}"></script>


    {{-- upload file name --}}
    <script>
        function displayFileName() {
            const input = document.getElementById('dokumentasi');
            const label = document.getElementById('fileLabel');
            const fileName = input.files[0].name;
            label.textContent = fileName;
        }
    </script>
@endsection
