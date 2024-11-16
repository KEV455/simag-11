@extends('layouts.base.base-template')

@section('title')
    <title>Manajemen Lowongan | SiMagang</title>
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
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Manajemen Lowongan</h4>
                </div>
                <!--end page-title-box-->
            </div>
            <!--end col-->
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-primary px-4 mt-0 mb-3" data-toggle="modal"
                            data-animation="bounce" data-target=".modalCreate"><i
                                class="mdi mdi-plus-circle-outline mr-2"></i>Tambah Lowongan Baru</button>
                        <div class="table-responsive">
                            @php
                                $no = 1;
                            @endphp
                            <table id="datatable" class="table">
                                <thead class="thead-light">
                                    <tr class="text-center">
                                        <th class="text-left">No</th>
                                        <th class="text-left">Nama Lowongan</th>
                                        <th class="text-left">Mitra</th>
                                        <th class="text-left">Tanggal Dibuka Lowongan</th>
                                        <th class="text-left">Tanggal Ditutup Lowongan</th>
                                        <th class="text-left">Tanggal Dimulai Magang</th>
                                        <th class="text-left">Tanggal Ditutup Magang</th>
                                        <th class="text-left">Status</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                    <!--end tr-->
                                </thead>

                                <tbody>
                                    @foreach ($lowongan as $item)
                                        <tr class="text-center">
                                            <td>{{ $no }}</td>
                                            <td class="text-left">{{ $item->nama }}</td>
                                            <td class="text-left">{{ $item->mitra->nama }}</td>
                                            <td class="text-left">{{ dateConversion($item->tanggal_dibuka) }}</td>
                                            <td class="text-left">{{ dateConversion($item->tanggal_ditutup) }}</td>
                                            <td class="text-left">{{ dateConversion($item->tanggal_magang_dimulai) }}</td>
                                            <td class="text-left">{{ dateConversion($item->tanggal_magang_ditutup) }}</td>
                                            <td class="text-left">{{ $item->status }}</td>
                                            <td>
                                                <a href="{{ route('koordinator.lowongan.update', $item->id) }}"
                                                    class="mr-2" data-toggle="modal" data-animation="bounce"
                                                    data-target=".modalUpdate{{ $item->id }}"><i
                                                        class="fas fa-edit text-info font-16"></i></a>
                                                <a href="{{ route('koordinator.lowongan.destroy', $item->id) }}"><i
                                                        class="fas fa-trash-alt text-danger font-16"></i></a>
                                            </td>
                                        </tr>
                                        <!--end tr-->
                                </tbody>
                                @php
                                    $no++;
                                @endphp
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
            @foreach ($lowongan as $itemdata)
                <!--  Modal Update content for the above example -->
                <div class="modal fade modalUpdate{{ $itemdata->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title mt-0" id="myLargeModalLabel">Update
                                    Lowongan
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('koordinator.lowongan.update', $itemdata->id) }}" method="POST">
                                    @method('put')
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="mitra">Nama
                                                    Mitra</label>
                                                <select class="form-control @error('mitra') is-invalid @enderror"
                                                    id="mitra" name="mitra">
                                                    <option value="">Pilih Mitra
                                                    </option>
                                                    @foreach ($mitra as $data)
                                                        <option value="{{ $data->id }}"
                                                            {{ $itemdata->id_mitra == $data->id ? 'selected' : '' }}>
                                                            {{ $data->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('mitra')
                                                    <div id="mitra" class="form-text pb-1">
                                                        {{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nama_lowongan">Nama Lowongan</label>
                                                <input type="text"
                                                    class="form-control @error('nama_lowongan') is-invalid @enderror"
                                                    id="nama_lowongan" name="nama_lowongan"
                                                    placeholder="Masukkan Nama Lowongan" value="{{ $itemdata->nama }}">
                                                @error('nama_lowongan')
                                                    <div id="nama_lowongan" class="form-text pb-1">
                                                        {{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="jumlah_lowongan">Jumlah Lowongan</label>
                                                <input type="number"
                                                    class="form-control @error('jumlah_lowongan') is-invalid @enderror"
                                                    id="jumlah_lowongan" name="jumlah_lowongan"
                                                    placeholder="Jumlah Lowongan Dibuka"
                                                    value="{{ $itemdata->jumlah_lowongan }}">
                                                @error('jumlah_lowongan')
                                                    <div id="jumlah_lowongan" class="form-text pb-1">
                                                        {{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="tanggal_dibuka">Tanggal Dibuka</label>
                                                <input type="date"
                                                    class="form-control @error('tanggal_dibuka') is-invalid @enderror"
                                                    id="tanggal_dibuka" name="tanggal_dibuka"
                                                    placeholder="Jumlah Maksimal Hari Kerja Pelayanan"
                                                    value="{{ $itemdata->tanggal_dibuka }}">
                                                @error('tanggal_dibuka')
                                                    <div id="tanggal_dibuka" class="form-text pb-1">
                                                        {{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="tanggal_ditutup">Tanggal Ditutup</label>
                                                <input type="date"
                                                    class="form-control @error('tanggal_ditutup') is-invalid @enderror"
                                                    id="tanggal_ditutup" name="tanggal_ditutup"
                                                    placeholder="Jumlah Maksimal Hari Kerja Pelayanan"
                                                    value="{{ $itemdata->tanggal_ditutup }}">
                                                @error('tanggal_ditutup')
                                                    <div id="tanggal_ditutup" class="form-text pb-1">
                                                        {{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="tanggal_magang_dimulai">Tanggal Magang Dibuka</label>
                                                <input type="date"
                                                    class="form-control @error('tanggal_magang_dimulai') is-invalid @enderror"
                                                    id="tanggal_magang_dimulai" name="tanggal_magang_dimulai"
                                                    placeholder="Jumlah Maksimal Hari Kerja Pelayanan"
                                                    value="{{ $itemdata->tanggal_magang_dimulai }}">
                                                @error('tanggal_magang_dimulai')
                                                    <div id="tanggal_magang_dimulai" class="form-text pb-1">
                                                        {{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="tanggal_magang_ditutup">Tanggal Magang Ditutup</label>
                                                <input type="date"
                                                    class="form-control @error('tanggal_magang_ditutup') is-invalid @enderror"
                                                    id="tanggal_magang_ditutup" name="tanggal_magang_ditutup"
                                                    placeholder="Jumlah Maksimal Hari Kerja Pelayanan"
                                                    value="{{ $itemdata->tanggal_magang_ditutup }}">
                                                @error('tanggal_magang_ditutup')
                                                    <div id="tanggal_magang_ditutup" class="form-text pb-1">
                                                        {{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="deskripsi">Deskripsi Lowongan</label>
                                                <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
                                                    cols="30" rows="5" placeholder="Masukkan Deskripsi">{{ $itemdata->deskripsi }}</textarea>
                                                @error('deskripsi')
                                                    <div id="deskripsi" class="form-text pb-1">
                                                        {{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="status">Status Lowongan</label>
                                                <select class="form-control @error('status') is-invalid @enderror"
                                                    id="status" name="status">
                                                    <option value="">Pilih Status Lowongan</option>
                                                    <option value="Aktif"
                                                        {{ $itemdata->status == 'Aktif' ? 'selected' : '' }}>Aktif
                                                    </option>
                                                    <option value="Tidak Aktif"
                                                        {{ $itemdata->status == 'Tidak Aktif' ? 'selected' : '' }}>Tidak
                                                        Aktif
                                                    </option>
                                                </select>
                                                @error('status')
                                                    <div id="status" class="form-text pb-1">
                                                        {{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="text-nowrap">
                                                        <th>Program Studi
                                                            @error('prodi')
                                                                <div id="prodi" class="text-danger py-1">
                                                                    *pilih minimal satu prodi
                                                                </div>
                                                            @else
                                                                <small>(Mohon Pilih Minimal Satu Prodi)</small>
                                                            @enderror
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($prodi as $dataitem)
                                                        <tr>
                                                            <td class="d-flex">
                                                                <div class="form-check my-auto">
                                                                    @php
                                                                        $isChecked = false;
                                                                    @endphp

                                                                    @foreach ($lowongan_prodi as $item)
                                                                        @if ($item->id_lowongan == $itemdata->id && $item->id_prodi == $dataitem->id)
                                                                            @php
                                                                                $isChecked = true;
                                                                            @endphp
                                                                        @endif
                                                                    @endforeach

                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="{{ $dataitem->id }}" name="prodi[]"
                                                                        id="{{ $dataitem->id }}"
                                                                        @if ($isChecked) checked @endif>

                                                                    <label class="form-check-label"
                                                                        for="{{ $dataitem->id }}">
                                                                        {{ $dataitem->nama_program_studi }}
                                                                    </label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="col-md-12">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="text-nowrap">
                                                        <th>Berkas
                                                            @error('berkas')
                                                                <div id="berkas" class="text-danger py-1">
                                                                    *pilih minimal satu berkas
                                                                </div>
                                                            @else
                                                                <small>(Mohon Pilih Minimal Satu Berkas)</small>
                                                            @enderror
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($berkas as $dataitem)
                                                        <tr>
                                                            <td class="d-flex">
                                                                <div class="form-check my-auto">
                                                                    @php
                                                                        $isChecked = false;
                                                                    @endphp

                                                                    @foreach ($berkas_lowongan as $item)
                                                                        @if ($item->id_lowongan == $itemdata->id && $item->id_berkas == $dataitem->id)
                                                                            @php
                                                                                $isChecked = true;
                                                                            @endphp
                                                                        @endif
                                                                    @endforeach

                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="{{ $dataitem->id }}" name="berkas[]"
                                                                        id="{{ $dataitem->id }}"
                                                                        @if ($isChecked) checked @endif>

                                                                    <label class="form-check-label"
                                                                        for="{{ $dataitem->id }}">
                                                                        {{ $dataitem->nama_berkas }}
                                                                    </label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                    <button type="button" class="btn btn-sm btn-danger"
                                        data-dismiss="modal">Batal</button>
                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            @endforeach
        </div>
    </div>

    <!--  Modal content for the above example -->
    <div class="modal fade modalCreate" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Tambah Layanan Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('koordinator.lowongan.create') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="mitra">Nama Mitra</label>
                                    <select class="form-control @error('mitra') is-invalid @enderror" id="mitra"
                                        name="mitra">
                                        <option value="">Pilih Mitra</option>
                                        @foreach ($mitra as $dataMitra)
                                            <option value="{{ $dataMitra->id }}">{{ $dataMitra->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('mitra')
                                        <div id="mitra" class="form-text pb-1">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama_lowongan">Nama Lowongan</label>
                                    <input type="text"
                                        class="form-control @error('nama_lowongan') is-invalid @enderror"
                                        id="nama_lowongan" name="nama_lowongan" placeholder="Masukkan Nama Lowongan">
                                    @error('nama_lowongan')
                                        <div id="nama_lowongan" class="form-text pb-1">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="jumlah_lowongan">Jumlah Lowongan</label>
                                    <input type="number"
                                        class="form-control @error('jumlah_lowongan') is-invalid @enderror"
                                        id="jumlah_lowongan" name="jumlah_lowongan" placeholder="Jumlah Lowongan Dibuka">
                                    @error('jumlah_lowongan')
                                        <div id="jumlah_lowongan" class="form-text pb-1">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tanggal_dibuka">Tanggal Dibuka</label>
                                    <input type="date"
                                        class="form-control @error('tanggal_dibuka') is-invalid @enderror"
                                        id="tanggal_dibuka" name="tanggal_dibuka"
                                        placeholder="Jumlah Maksimal Hari Kerja Pelayanan">
                                    @error('tanggal_dibuka')
                                        <div id="tanggal_dibuka" class="form-text pb-1">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tanggal_ditutup">Tanggal Ditutup</label>
                                    <input type="date"
                                        class="form-control @error('tanggal_ditutup') is-invalid @enderror"
                                        id="tanggal_ditutup" name="tanggal_ditutup"
                                        placeholder="Jumlah Maksimal Hari Kerja Pelayanan">
                                    @error('tanggal_ditutup')
                                        <div id="tanggal_ditutup" class="form-text pb-1">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tanggal_magang_dimulai">Tanggal Magang Dibuka</label>
                                    <input type="date"
                                        class="form-control @error('tanggal_magang_dimulai') is-invalid @enderror"
                                        id="tanggal_magang_dimulai" name="tanggal_magang_dimulai"
                                        placeholder="Jumlah Maksimal Hari Kerja Pelayanan">
                                    @error('tanggal_magang_dimulai')
                                        <div id="tanggal_magang_dimulai" class="form-text pb-1">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tanggal_magang_ditutup">Tanggal Magang Ditutup</label>
                                    <input type="date"
                                        class="form-control @error('tanggal_magang_ditutup') is-invalid @enderror"
                                        id="tanggal_magang_ditutup" name="tanggal_magang_ditutup"
                                        placeholder="Jumlah Maksimal Hari Kerja Pelayanan">
                                    @error('tanggal_magang_ditutup')
                                        <div id="tanggal_magang_ditutup" class="form-text pb-1">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi Lowongan</label>
                                    <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
                                        cols="30" rows="5" placeholder="Masukkan Deskripsi">{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                        <div id="deskripsi" class="form-text pb-1">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="status">Status Lowongan</label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status"
                                        name="status">
                                        <option value="">Pilih Status Lowongan</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Tidak Aktif">Tidak Aktif</option>
                                    </select>
                                    @error('status')
                                        <div id="status" class="form-text pb-1">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-nowrap">
                                            <th>Program Studi

                                                @error('prodi')
                                                    <div id="prodi" class="text-danger py-1">
                                                        *pilih minimal satu prodi
                                                    </div>
                                                @else
                                                    <small>(Mohon Pilih Minimal Satu Prodi)</small>
                                                @enderror
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($prodi as $item)
                                            <tr>
                                                <td class="d-flex">
                                                    <div class="form-check my-auto">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="{{ $item->id }}" name="prodi[]"
                                                            id="{{ $item->id }}">
                                                        <label class="form-check-label" for="{{ $item->id }}">
                                                            {{ $item->nama_program_studi }}
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-nowrap">
                                            <th>Berkas

                                                @error('berkas')
                                                    <div id="berkas" class="text-danger py-1">
                                                        *pilih minimal satu berkas
                                                    </div>
                                                @else
                                                    <small>(Mohon Pilih Minimal Satu Berkas)</small>
                                                @enderror
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($berkas as $item)
                                            <tr>
                                                <td class="d-flex">
                                                    <div class="form-check my-auto">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="{{ $item->id }}" name="berkas[]"
                                                            id="{{ $item->id }}">
                                                        <label class="form-check-label" for="{{ $item->id }}">
                                                            {{ $item->nama_berkas }}
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-sm btn-primary" id="sa-success">Tambah</button>
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
