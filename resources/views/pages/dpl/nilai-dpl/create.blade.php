@extends('layouts.base.base-template')

@section('title')
    <title>Penilaian DPL | SiMagang</title>
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
                    <h4 class="page-title">Penilaian DPL</h4>
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
                        <form action="{{ route('dpl.nilai.dpl.store', $pelamar_magang->id_mahasiswa) }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-bordered table-striped">
                                        <thead class="thead-light">
                                            <tr>
                                                <th style="width: 5%;" class="text-center">No</th>
                                                <th style="width: 50%;">Kriteria Penilaian</th>
                                                <th style="width: 45%;">Input Nilai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($kriteria_penilaian_mitras as $index => $item)
                                                <tr>
                                                    <td class="text-center">{{ $index + 1 }}</td>
                                                    <td>{{ $item->kriteria_penilaian->nama_kriteria_penilaian }}</td>
                                                    <td>
                                                        <input type="hidden"
                                                            name="id_kriteria_penilaian[{{ $index }}]"
                                                            value="{{ $item->id_kriteria_penilaian }}">
                                                        <input type="number" step="0.01"
                                                            class="form-control @error('nilai.' . $index) is-invalid @enderror"
                                                            name="nilai[{{ $index }}]" placeholder="Masukkan Nilai"
                                                            value="{{ old('nilai.' . $index, $nilai_dpls->where('id_kriteria_penilaian', $item->id_kriteria_penilaian)->first()->nilai ?? '') }}"
                                                            min="0" max="100" required>
                                                        @error('nilai.' . $index)
                                                            <div class="form-text text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="text-center" colspan="2">Jumlah</td>
                                                <td class="text-center"><b>{{ $jumlah_nilai }}</b></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center" colspan="2">Rata-Rata</td>
                                                <td class="text-center"><b>{{ $rata_rata_nilai }}</b></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-sm btn-primary" id="sa-success">Simpan</button>
                                <a href="{{ route('dpl.nilai.dpl.show', $pelamar_magang->id_lowongan) }}"
                                    class="btn btn-sm btn-info">Kembali</a>
                            </div>
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
