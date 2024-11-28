@extends('layouts.base.base-template')

@section('title')
    <title>Logbook Mahasiswa | SiMagang</title>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <!-- Mengambil nama mahasiswa dari item pertama dalam koleksi -->
                    <h4 class="page-title">Logbook Mahasiswa ||
                        {{ $namaMahasiswa }}
                    </h4>
                </div>
            </div>
        </div>



        <!--begin row-->
        <div class="row">

            <div class="col-lg-12">
                @if ($logbook->isEmpty())
                    <!-- Jika logbook kosong -->
                    <div class="alert alert-warning text-center">
                        Logbook belum ditambahkan.
                    </div>
                @else
                    <!-- Jika logbook tidak kosong -->
                    @foreach ($logbook as $bulan => $logbooks)
                        <div class="card">
                            <div class="card-body">
                                <div class="slimscroll education-activity">
                                    <h5 class="text-primary">{{ $bulan }}</h5> <!-- Judul Bulan -->
                                    @foreach ($logbooks as $data)
                                        <div class="d-flex align-items-start mb-4">
                                            <!-- Foto Kegiatan -->
                                            <img width="150" class="img-thumbnail img-fluid"
                                                src="{{ asset('storage/' . $data->dokumentasi_kegiatan) }}"
                                                alt="Foto Kegiatan">
                                            </a>

                                            <!-- Informasi Kegiatan -->
                                            <div class="activity flex-grow-1">
                                                <div class="time-item">
                                                    <div class="item-info">
                                                        <h6 class="m-0">{{ $data->judul_kegiatan }}</h6>
                                                        <span class="text-muted">
                                                            {{ $data->tanggal_kegiatan
                                                                ? \Carbon\Carbon::parse($data->tanggal_kegiatan)->locale('id')->translatedFormat('j F Y')
                                                                : '-' }}
                                                        </span>
                                                        <p class="text-muted mt-3">{{ $data->deskripsi_kegiatan }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div><!--end education-activity-->
                            </div> <!--end card-body-->
                        </div><!--end card-->
                    @endforeach
                @endif
            </div><!--end col-->


        </div>

    </div>
@endsection
