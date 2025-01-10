@extends('layouts.base.base-template')

@section('title')
    <title>Tambah Kriteria Penilaian Mitra | SiMagang</title>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Tambah Kriteria Penilaian Mitra || {{ $mitra->nama }}
                    </h4>
                </div>
            </div>
        </div>
        <form action="{{ route('koordinator.kriteria.penilaian.mitra.store', $mitra->id) }}" method="POST">
            @csrf

            @error('kriteria_penilaian_mitras')
                <div id="berkas" class="text-danger py-1">
                    *pilih minimal satu kriteria penilaian mitra
                </div>
            @else
                <div class="mb-3">
                    <small>(Mohon Pilih Minimal Satu Kriteria Penilaian Mitra)</small>
                </div>
            @enderror

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary px-4 mt-0 mb-3">Simpan</button>
                            <a href="{{ route('koordinator.kriteria.penilaian.mitra.index', $mitra->id) }}"
                                class="btn btn-info px-4 mt-0 mb-3">
                                Kembali
                            </a>

                            <div class="table-responsive">

                                <table id="datatable" class="table">
                                    <thead class="thead-light">
                                        <tr class="text-center">
                                            <th width="10%">#</th>
                                            <th class="text-left">Nama Kriteria Penilaian</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($kriteria_penilaian_mitras as $data)
                                            <tr class="text-center">
                                                <td>
                                                    <input class="form-check-input" type="checkbox"
                                                        name="kriteria_penilaian_mitras[]" id="{{ $data->id }}"
                                                        value="{{ $data->id }}">
                                                </td>
                                                <td class="text-left">{{ $data->nama_kriteria_penilaian }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
