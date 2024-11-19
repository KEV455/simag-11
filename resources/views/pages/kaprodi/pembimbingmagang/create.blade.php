@extends('layouts.base.base-template')

@section('title')
    <title>Tambah Mahasiswa| SiMagang</title>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Tambah Mahsiswa || Dosen Pembimbing {{ $dosen_pembimbing->dosen->nama_dosen }}
                    </h4>
                </div>
            </div>
        </div>
        <form action="{{ route('kaprodi.pembimbing.magang.store', $dosen_pembimbing->id) }}" method="POST">
            @csrf

            @error('mahasiswas')
                <div id="berkas" class="text-danger py-1">
                    *pilih minimal satu mahasiswa
                </div>
            @else
                <div class="mb-3">
                    <small>(Mohon Pilih Minimal Satu Mahasiswa)</small>
                </div>
            @enderror
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <button type="submit" class="btn btn-primary px-4 mt-0 mb-3">
                                Simpan</button>
                            <a href="{{ route('kaprodi.pembimbing.magang.index', $dosen_pembimbing->id) }}"
                                class="btn btn-info px-4 mt-0 mb-3">
                                Kembali</a>


                            <div class="table-responsive">

                                <table id="datatable" class="table">
                                    <thead class="thead-light">
                                        <tr class="text-center">
                                            <th width="10%">#</th>
                                            <th class="text-left">Nim</th>
                                            <th class="text-left">Nama Mahasiswa</th>
                                            <th class="text-left">Angkatan</th>
                                            <th class="text-left">Nama Program Studi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($mahasiswa as $data)
                                            <tr class="text-center">
                                                <td><input class="form-check-input" type="checkbox" name="mahasiswas[]"
                                                        id="{{ $data->id }}" value="{{ $data->id }}"></td>
                                                <td class="text-left">{{ $data->nim }}</td>
                                                <td class="text-left">{{ $data->nama_mahasiswa }}</td>
                                                <td class="text-left">{{ $data->angkatan }}</td>
                                                <td class="text-left">{{ $data->prodi->nama_program_studi }}</td>
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
