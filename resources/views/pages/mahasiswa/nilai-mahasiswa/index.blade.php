@extends('layouts.base.base-template')

@section('title')
    <title>Penilaian Magang | SiMagang</title>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Penilaian Magang || {{ $pelamarMagang->mahasiswa->nama_mahasiswa }}
                    </h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-rounded">
                    <div class="card-body">
                        <ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="laporan_transkrip_tab" data-toggle="pill"
                                    href="#laporan_transkrip">Berkas Laporan dan Transkrip</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="form_penilaian_tab" data-toggle="pill" href="#form_penilaian">Lihat
                                    Nilai</a>
                            </li>
                        </ul>
                    </div><!--end card-body-->
                </div>
            </div>

            <div class="col-12">
                <div class="tab-content detail-list" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="laporan_transkrip">
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-rounded">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="met-basic-detail">
                                                    <div class="row">
                                                        {{-- Laporan Akhir --}}
                                                        @if ($laporan_akhir)
                                                            <div class="col-md-12">
                                                                {{-- Accordion --}}
                                                                <div class="accordion" id="accordionExample">
                                                                    <div class="card">
                                                                        <!-- Header untuk tombol accordion -->
                                                                        <div class="card-header" id="heading-laporan-akhir">
                                                                            <h5 class="mb-0">
                                                                                <button class="btn btn-link collapsed"
                                                                                    type="button" data-toggle="collapse"
                                                                                    data-target="#collapse-laporan-akhir"
                                                                                    aria-expanded="true"
                                                                                    aria-controls="collapse-laporan-akhir">
                                                                                    LAPORAN AKHIR MAGANG MAHASISWA
                                                                                </button>
                                                                            </h5>
                                                                        </div>

                                                                        <!-- Konten accordion -->
                                                                        <div id="collapse-laporan-akhir"
                                                                            class="collapse show"
                                                                            aria-labelledby="heading-laporan-akhir"
                                                                            data-parent="#accordionExample">
                                                                            <div class="card-body">
                                                                                <iframe
                                                                                    src="{{ asset('storage/' . $laporan_akhir->file_laporan_akhir) }}"
                                                                                    width="100%" height="700px"
                                                                                    style="border: none;"></iframe>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="col-md-12 mb-2">
                                                                <center>
                                                                    <span class="badge badge-soft-danger">Laporan Akhir
                                                                        Masih Belum Diunggah oleh Mahasiswa
                                                                    </span>
                                                                </center>
                                                            </div>
                                                        @endif

                                                        {{-- Transkrip Nilai DPL --}}
                                                        @if ($transkrip_nilai_dpl)
                                                            <div class="col-md-12">
                                                                {{-- Accordion --}}
                                                                <div class="accordion" id="accordionExample">
                                                                    <div class="card">
                                                                        <!-- Header untuk tombol accordion -->
                                                                        <div class="card-header"
                                                                            id="heading-transkrip-nilai">
                                                                            <h5 class="mb-0">
                                                                                <button class="btn btn-link collapsed"
                                                                                    type="button" data-toggle="collapse"
                                                                                    data-target="#collapse-transkrip-nilai"
                                                                                    aria-expanded="true"
                                                                                    aria-controls="collapse-transkrip-nilai">
                                                                                    TRANSKRIP NILAI DPL MAGANG MAHASISWA
                                                                                </button>
                                                                            </h5>
                                                                        </div>

                                                                        <!-- Konten accordion -->
                                                                        <div id="collapse-transkrip-nilai" class="collapse"
                                                                            aria-labelledby="heading-transkrip-nilai"
                                                                            data-parent="#accordionExample">
                                                                            <div class="card-body">
                                                                                <iframe
                                                                                    src="{{ asset('storage/' . $transkrip_nilai_dpl->file_transkrip_nilai) }}"
                                                                                    width="100%" height="700px"
                                                                                    style="border: none;"></iframe>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="col-md-12 mb-2">
                                                                <center>
                                                                    <span class="badge badge-soft-danger">Transkrip Nilai
                                                                        DPL Masih Belum
                                                                        Diunggah oleh Mahasiswa
                                                                    </span>
                                                                </center>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--end card-body-->
                                </div><!--end card-->
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end general detail-->
                    <div class="tab-pane fade" id="form_penilaian">
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-rounded">
                                    <div class="card-body">
                                        <div class="card-box">
                                            <!-- Informasi Mahasiswa dan Magang -->
                                            <div class="row mb-3">
                                                <!-- Baris Pertama -->
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex">
                                                        <span class="label"><strong>Nama Mahasiswa</strong></span>
                                                        <span class="value ms-2">:
                                                            {{ $pelamarMagang->mahasiswa->nama_mahasiswa }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex">
                                                        <span class="label"><strong>Dosen Pembimbing</strong></span>
                                                        <span class="value ms-2">:
                                                            {{ $pembimbingMagang->dosen_pembimbing->dosen->nama_dosen }}</span>
                                                    </div>
                                                </div>

                                                <!-- Baris Kedua -->
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex">
                                                        <span class="label"><strong>Nama Mitra</strong></span>
                                                        <span class="value ms-2">:
                                                            {{ $pelamarMagang->lowongan->mitra->nama }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex">
                                                        <span class="label"><strong>Nama Lowongan</strong></span>
                                                        <span class="value ms-2">:
                                                            {{ $pelamarMagang->lowongan->nama }}</span>
                                                    </div>
                                                </div>
                                            </div>



                                            <!-- Tabel Nilai -->
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Nama</th>
                                                        <th>Nilai Angka</th>
                                                        <th>Nilai Huruf</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($nilaiMagang as $nilai)
                                                        <tr>
                                                            <td>Magang Kerja Industri</td>
                                                            <td>{{ $nilai->nilai_angka }}</td>
                                                            <td>{{ $nilai->nilai_huruf }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="3" class="text-center"> Nilai belum
                                                                tersedia</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div> <!--end col-->
                            </div><!--end row-->
                        </div><!--end settings detail-->

                    </div><!--end tab-content-->

                </div><!--end col-->
            </div>
        </div>
    @endsection
