@extends('layouts.base.base-template')

@section('title')
    <title>Pendaftaran Magang | SiMagang</title>
@endsection

@section('top-css')
    <link href="{{ asset('template/assets/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/assets/css/style.css') }}" rel="stylesheet" type="text/css" />\
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
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            {{-- <li class="breadcrumb-item"><a href="javascript:void(0);">SiMagang</a></li> --}}
                            <li class="breadcrumb-item"><a href="javascript:void(0);">SiMagang</a></li>
                            <li class="breadcrumb-item active">Daftar Magang </li>
                        </ol><!--end breadcrumb-->
                    </div><!--end /div-->
                    <h4 class="page-title">Daftar Magang</h4>
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->

        <!-- end page title end breadcrumb -->
        <div class="row mb-3">
            <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                <form action="{{ route('mahasiswa.daftar.magang.index') }}" method="GET">
                    @csrf

                    <div class="d-flex align-items-center py-2">
                        <!-- Dropdown Input -->
                        <div class="form-group mr-3" style="flex: 1;">
                            <label for="id_kategori_bidang" class="form-label">Filter Kategori Bidang</label>
                            <select class="form-control select2 @error('id_kategori_bidang') is-invalid @enderror"
                                id="id_kategori_bidang" name="id_kategori_bidang" required>
                                <option value="">Pilih Kategori Bidang Lowongan</option>
                                @foreach ($kategori_bidangs as $item)
                                    <option value="{{ $item->id }}"
                                        {{ request('id_kategori_bidang') == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_kategori_bidang')
                                <div id="id_kategori_bidang" class="form-text pb-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Button Cari -->
                        <div class="d-flex">
                            <button type="submit" class="btn btn-sm btn-primary fw-bold" id="sa-success">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <div class="row">
            @if ($lowongan_by_kategori->isEmpty())
                <div class="col-12">
                    <div class="d-flex">
                        <img class="mx-auto" src="{{ asset('images/empty-lowongan.svg') }}" width="350"
                            alt="Empty lowongan">
                    </div>
                    <center class="mt-4">
                        <h2 class="fw-bold">Oops, data lowongan masih belum ada.</h2>
                        <h4 class="fw-bold">Mohon pilih kategori bidang yang lain..</h4>
                    </center>
                </div>
            @else
                @foreach ($lowongan_by_kategori as $dataLowongan)
                    <div class="col-md-4">
                        <div class="card report-card card-hover ribbon-1">
                            <div class="card-body ribbon-box">
                                <div class="ribbon ribbon-mark bg-primary">{{ $dataLowongan->mitra->nama }}</div>
                                <div class="float-right">
                                    <img width="150" class="img-thumbnail img-fluid rounded-circle main-widgets-icon"
                                        src="{{ asset('storage/' . $dataLowongan->mitra->foto) }}" alt="Foto Mitra"
                                        title="Foto {{ $dataLowongan->mitra->nama }}">
                                </div>
                                <h4 class="title-text mt-0">{{ $dataLowongan->nama }}</h4>
                                <h3 class="my-2">{{ $dataLowongan->jumlah_lowongan }}<small>&ensp;Kuota</small></h3>
                                <p class="mb-0 text-muted text-truncate"> Open:
                                    <span class="text-success">
                                        {{ dateConversion($dataLowongan->tanggal_dibuka) }} -
                                        {{ dateConversion($dataLowongan->tanggal_ditutup) }}
                                    </span>
                                </p>
                            </div><!--end card-body-->
                            <div>
                                <ul>
                                    <p>Terbuka untuk Program Studi :</p>
                                    @if ($dataLowongan->lowongan_prodi->count())
                                        @foreach ($dataLowongan->lowongan_prodi as $lowonganProdi)
                                            <li>
                                                {{ $lowonganProdi->prodi->nama_program_studi }}
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            <div class="bg-white pb-3 d-flex">
                                <div class="ml-auto px-3">
                                    <a href="{{ route('mahasiswa.daftar.magang.show', $dataLowongan->id) }}"
                                        class="btn btn-sm btn-primary" id="sa-success">Detail
                                        Lowongan&ensp;<i class="fa-solid fa-circle-info"></i></a>
                                    <a href="{{ route('mahasiswa.pelamar.magang.index', $dataLowongan->id) }}"
                                        class="btn btn-sm btn-success" data-dismiss="modal">Daftar
                                        Sekarang&ensp;<i class="fa-solid fa-right-to-bracket"></i></a>
                                </div>
                            </div>
                        </div><!--end card-->
                    </div> <!--end col-->
                @endforeach
            @endif
        </div><!--end row-->
    </div><!-- container -->
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
