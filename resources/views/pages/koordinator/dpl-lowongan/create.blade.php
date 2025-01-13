@extends('layouts.base.base-template')

@section('title')
    <title>Tambah Lowongan DPL | SiMagang</title>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Tambah Lowongan DPL || {{ $dpl_mitra->nama }}
                    </h4>
                </div>
            </div>
        </div>
        <form action="{{ route('koordinator.dpl.lowongan.store', $dpl_mitra->id) }}" method="POST">
            @csrf

            @error('lowongans')
                <div id="berkas" class="text-danger py-1">
                    *pilih minimal satu lowongan
                </div>
            @else
                <div class="mb-3">
                    <small>(Mohon Pilih Minimal Satu Lowongan)</small>
                </div>
            @enderror

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary px-4 mt-0 mb-3">Simpan</button>
                            <a href="{{ route('koordinator.dpl.lowongan.index', $dpl_mitra->id) }}"
                                class="btn btn-info px-4 mt-0 mb-3">
                                Kembali
                            </a>

                            <div class="table-responsive">

                                <table id="datatable" class="table">
                                    <thead class="thead-light">
                                        <tr class="text-center">
                                            <th width="10%">#</th>
                                            <th class="text-left">Nama Lowongan</th>
                                            <th class="text-left">Nama Mitra</th>
                                            <th class="text-left">Tahun Ajaran</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($lowongans as $data)
                                            <tr class="text-center">
                                                <td>
                                                    <input class="form-check-input" type="checkbox" name="lowongans[]"
                                                        id="{{ $data->id }}" value="{{ $data->id }}">
                                                </td>
                                                <td class="text-left">{{ $data->nama }}</td>
                                                <td class="text-left">{{ $data->mitra->nama }}</td>
                                                <td class="text-left">{{ $data->semester->nama_semester }}</td>
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
