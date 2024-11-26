@extends('layouts.base.base-template')

@section('title')
    <title>Penilaian Magang | SiMagang</title>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Penilaian Magang || {{ $pembimbing_magang->mahasiswa->nama_mahasiswa }}
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
                                <a class="nav-link" id="form_penilaian_tab" data-toggle="pill" href="#form_penilaian">Form
                                    Penilaian</a>
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
                                        <form action="{{ route('dospem.penilaian.magang.store', $pembimbing_magang->id) }}"
                                            class="card-box" method="POST">
                                            @csrf

                                            <div class="row">
                                                {{-- Nama Mahasiswa --}}
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="nama_mahasiswa">Nama Mahasiswa</label>
                                                        <input type="text"
                                                            class="form-control @error('nama_mahasiswa') is-invalid @enderror"
                                                            id="nama_mahasiswa" name="nama_mahasiswa"
                                                            placeholder="Masukkan Nama Mahasiswa"
                                                            value="{{ $pembimbing_magang->mahasiswa->nama_mahasiswa }}"
                                                            disabled>
                                                        @error('nama_mahasiswa')
                                                            <div id="nama_mahasiswa" class="form-text pb-1">
                                                                {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                {{-- Nama Dosen Pembimbing --}}
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="nama_dosen">Nama Dosen Pembimbing</label>
                                                        <input type="text"
                                                            class="form-control @error('nama_dosen') is-invalid @enderror"
                                                            id="nama_dosen" name="nama_dosen"
                                                            placeholder="Masukkan Nama Dosen Pembimbing"
                                                            value="{{ $pembimbing_magang->dosen_pembimbing->dosen->nama_dosen }}"
                                                            disabled>
                                                        @error('nama_dosen')
                                                            <div id="nama_dosen" class="form-text pb-1">
                                                                {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="nilai_angka">Nilai Angka</label>
                                                        <input type="number"
                                                            class="form-control @error('nilai_angka') is-invalid @enderror"
                                                            id="nilai_angka" name="nilai_angka"
                                                            placeholder="Masukkan Nilai Angka"
                                                            value="{{ old('nilai_angka', $nilai->nilai_angka ?? '') }}"
                                                            required>
                                                        @error('nilai_angka')
                                                            <div id="nilai_angka" class="form-text pb-1">
                                                                {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="nilai_huruf">Nilai Huruf</label>
                                                        <select
                                                            class="form-control @error('nilai_huruf') is-invalid @enderror"
                                                            id="nilai_huruf" name="nilai_huruf">
                                                            <option value="">Pilih Nilai Huruf</option>
                                                            <option value="A"
                                                                {{ old('nilai_huruf', $nilai->nilai_huruf ?? '') == 'A' ? 'selected' : '' }}>
                                                                A (81 - 100)</option>
                                                            <option value="AB"
                                                                {{ old('nilai_huruf', $nilai->nilai_huruf ?? '') == 'AB' ? 'selected' : '' }}>
                                                                AB (71 - 80)</option>
                                                            <option value="B"
                                                                {{ old('nilai_huruf', $nilai->nilai_huruf ?? '') == 'B' ? 'selected' : '' }}>
                                                                B (66 - 70)</option>
                                                            <option value="BC"
                                                                {{ old('nilai_huruf', $nilai->nilai_huruf ?? '') == 'BC' ? 'selected' : '' }}>
                                                                BC (61 - 65)</option>
                                                            <option value="C"
                                                                {{ old('nilai_huruf', $nilai->nilai_huruf ?? '') == 'C' ? 'selected' : '' }}>
                                                                C (56 - 60)</option>
                                                            <option value="D"
                                                                {{ old('nilai_huruf', $nilai->nilai_huruf ?? '') == 'D' ? 'selected' : '' }}>
                                                                D (41 - 55)</option>
                                                            <option value="E"
                                                                {{ old('nilai_huruf', $nilai->nilai_huruf ?? '') == 'E' ? 'selected' : '' }}>
                                                                E (0 - 40)</option>
                                                        </select>
                                                        @error('nilai_huruf')
                                                            <div id="nilai_huruf" class="form-text pb-1">
                                                                {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            @if ($nilai == 'Belum Disetuui')
                                                @if (!$laporan_akhir)
                                                    <div class="alert alert-warning">
                                                        Berkas Laporan Akhir belum diunggah.
                                                    </div>
                                                @endif

                                                @if (!$transkrip_nilai_dpl)
                                                    <div class="alert alert-warning">
                                                        Berkas Transkrip Nilai DPL belum diunggah.
                                                    </div>
                                                @endif

                                                @if ($laporan_akhir && $transkrip_nilai_dpl)
                                                    <button type="submit" class="btn btn-sm btn-primary"
                                                        id="sa-success">Simpan</button>
                                                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-danger"
                                                        data-dismiss="modal">Batal</a>
                                                @else
                                                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-danger"
                                                        data-dismiss="modal">Kembali</a>
                                                @endif
                                            @else
                                                <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-danger"
                                                    data-dismiss="modal">Nilai Sudah Divalidasi</a>
                                            @endif
                                        </form>
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
