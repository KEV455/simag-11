@extends('layouts.base.base-template')

@section('title')
    <title>Update Mitra | SiMagang</title>
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
                    <h4 class="page-title">Edit Mitra</h4>
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
                        <form action="{{ route('koordinator.mitra.update', $mitra->id) }}" enctype="multipart/form-data"
                            method="POST">
                            @method('put')
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Nama Mitra</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            id="nama" name="nama" placeholder="Masukkan Nama Mitra"
                                            value="{{ $mitra->nama }}">
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
                                            value="{{ $mitra->narahubung }}">
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
                                            value="{{ $mitra->email }}">
                                        @error('email')
                                            <div id="email" class="form-text pb-1">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="website">Website</label>
                                        <input type="text" class="form-control @error('website') is-invalid @enderror"
                                            id="website" name="website" placeholder="Masukkan URL Website"
                                            value="{{ $mitra->website }}">
                                        @error('website')
                                            <div id="website" class="form-text pb-1">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control @error('status') is-invalid @enderror" id="status"
                                            name="status">
                                            <option value="">Pilih Status</option>
                                            <option value="Aktif" {{ $mitra->status == 'Aktif' ? 'selected' : '' }}>Aktif
                                            </option>
                                            <option value="Tidak Aktif"
                                                {{ $mitra->status == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif
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
                                        <label class="form-label" for="foto">Foto
                                            <span class="text-primary">*(Opsional, .png, .jpg, .jpeg 5Mb)</span>
                                        </label>
                                        <div class="custom-file mb-3">
                                            <input type="file"
                                                class="custom-file-input form-control @error('foto') is-invalid @enderror"
                                                id="foto" name="foto" onchange="displayFileName()">
                                            <label class="custom-file-label" for="foto" id="fileLabel">
                                                <!-- Menampilkan nama file yang diunggah sebelumnya jika ada -->
                                                @if (session('foto'))
                                                    {{ session('foto') }}
                                                @elseif ($mitra->foto)
                                                    {{ $mitra->foto }}
                                                @else
                                                    Choose file
                                                @endif
                                            </label>
                                            @error('foto')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
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
                                                    {{ $mitra->provinsi == $item->name ? 'selected' : '' }}>
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
                                                    {{ $mitra->kota == $item->name ? 'selected' : '' }}>
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
                                            rows="5" placeholder="Masukkan Alamat">{{ $mitra->alamat }}</textarea>
                                        @error('alamat')
                                            <div id="alamat" class="form-text pb-1">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
                                            cols="30" rows="5" placeholder="Masukkan Deskripsi">{{ $mitra->deskripsi }}</textarea>
                                        @error('deskripsi')
                                            <div id="deskripsi" class="form-text pb-1">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_kategori_bidang">Kategori Bidang</label>
                                        <select class="form-control @error('id_kategori_bidang') is-invalid @enderror"
                                            id="id_kategori_bidang" name="id_kategori_bidang"
                                            value="{{ old('id_kategori_bidang') }}">
                                            <option value="">Pilih Kategori</option>
                                            @foreach ($kategori_bidangs as $data)
                                                <option value="{{ $data->id }}"
                                                    {{ $mitra->id_kategori_bidang == $data->id ? 'selected' : '' }}>
                                                    {{ $data->nama_kategori }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_kategori_bidang')
                                            <div id="id_kategori_bidang" class="form-text pb-1">
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
