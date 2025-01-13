@extends('layouts.base.base-template')

@section('title')
    <title>Manajemen DPL Mitra | SiMagang</title>
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
                    <h4 class="page-title">Manajemen DPL Mitra || {{ $mitra->nama }}</h4>
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
                        <button type="button" class="btn btn-primary px-4 mt-0 mb-3" data-toggle="modal"
                            data-animation="bounce" data-target=".modalCreate"><i
                                class="mdi mdi-plus-circle-outline mr-2"></i>Tambah DPL Mitra Baru</button>
                        <div class="table-responsive">
                            @php
                                $no = 1;
                            @endphp
                            <table id="datatable" class="table">
                                <thead class="thead-light">
                                    <tr class="text-center">
                                        <th width="10%">No</th>
                                        <th width="20%" class="text-left">Nama DPL Mitra</th>
                                        <th width="20%">Tanggal Lahir</th>
                                        <th width="30%">Email</th>
                                        <th width="10%">Nomor Telepon</th>
                                        <th width="20%">Action</th>
                                    </tr>
                                    <!--end tr-->
                                </thead>

                                <tbody>
                                    @foreach ($dpl_mitras as $item)
                                        <tr class="text-center">
                                            <td>{{ $no }}</td>
                                            <td class="text-left">{{ $item->nama }}</td>
                                            <td>{{ dateConversion($item->tanggal_lahir) }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->nomor_telp }}</td>
                                            <td>
                                                <a href="{{ route('koordinator.dpl.lowongan.index', $item->id) }}"
                                                    class="mr-2" title="Lowongan DPL">
                                                    <i class="fas fa-briefcase text-purple font-16"></i>
                                                </a>
                                                <a href="{{ route('koordinator.dpl.mitra.update', $item->id) }}"
                                                    class="mr-2" data-toggle="modal" data-animation="bounce"
                                                    data-target=".modalUpdate{{ $item->id }}" title="Edit DPL Mitra">
                                                    <i class="fas fa-edit text-info font-16"></i>
                                                </a>
                                                <a href="{{ route('koordinator.dpl.mitra.destroy', $item->id) }}"
                                                    title="Hapus DPL Mitra">
                                                    <i class="fas fa-trash-alt text-danger font-16"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <!--end tr-->
                                </tbody>
                                @php
                                    $no++;
                                @endphp

                                <!--  Modal Update content for the above example -->
                                <div class="modal fade modalUpdate{{ $item->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title mt-0" id="myLargeModalLabel">Ubah DPL Mitra
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('koordinator.dpl.mitra.update', $item->id) }}"
                                                    method="POST">
                                                    @method('put')
                                                    @csrf

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="update_nama">Nama DPL Mitra</label>
                                                                <input type="text"
                                                                    class="form-control @error('update_nama') is-invalid @enderror"
                                                                    id="update_nama" name="update_nama"
                                                                    placeholder="Ubah Nama DPL Mitra"
                                                                    value="{{ $item->nama }}">
                                                                @error('update_nama')
                                                                    <div id="update_nama" class="form-text pb-1">
                                                                        {{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="update_tanggal_lahir">Tanggal Lahir DPL
                                                                    Mitra</label>
                                                                <input type="date"
                                                                    class="form-control @error('update_tanggal_lahir') is-invalid @enderror"
                                                                    id="update_tanggal_lahir" name="update_tanggal_lahir"
                                                                    placeholder="Ubah Tanggal Lahir DPL Mitra"
                                                                    value="{{ $item->tanggal_lahir }}">
                                                                @error('update_tanggal_lahir')
                                                                    <div id="update_tanggal_lahir" class="form-text pb-1">
                                                                        {{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="update_email">Email DPL Mitra</label>
                                                                <input type="email"
                                                                    class="form-control @error('update_email') is-invalid @enderror"
                                                                    id="update_email" name="update_email"
                                                                    placeholder="Ubah Email DPL Mitra"
                                                                    value="{{ $item->email }}">
                                                                @error('update_email')
                                                                    <div id="update_email" class="form-text pb-1">
                                                                        {{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="update_nomor_telp">Nomor Telepon DPL
                                                                    Mitra</label>
                                                                <input type="number" min="1"
                                                                    class="form-control @error('update_nomor_telp') is-invalid @enderror"
                                                                    id="update_nomor_telp" name="update_nomor_telp"
                                                                    placeholder="08xxxxxxxxxx"
                                                                    value="{{ $item->nomor_telp }}">
                                                                @error('update_nomor_telp')
                                                                    <div id="update_nomor_telp" class="form-text pb-1">
                                                                        {{ $message }}</div>
                                                                @enderror
                                                            </div>
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
                            </table>
                        </div>
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div>
    </div>
    <!--end row-->

    <!--  Modal content for the above example -->
    <div class="modal fade modalCreate" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Tambah DPL Mitra Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('koordinator.dpl.mitra.store', $mitra->id) }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="create_nama">Nama DPL Mitra</label>
                                    <input type="text" class="form-control @error('create_nama') is-invalid @enderror"
                                        id="create_nama" name="create_nama" placeholder="Masukkan Nama DPL Mitra">
                                    @error('create_nama')
                                        <div id="create_nama" class="form-text pb-1">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="create_tanggal_lahir">Tanggal Lahir DPL Mitra</label>
                                    <input type="date"
                                        class="form-control @error('create_tanggal_lahir') is-invalid @enderror"
                                        id="create_tanggal_lahir" name="create_tanggal_lahir"
                                        placeholder="Masukkan Tanggal Lahir DPL Mitra">
                                    @error('create_tanggal_lahir')
                                        <div id="create_tanggal_lahir" class="form-text pb-1">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="create_email">Email DPL Mitra</label>
                                    <input type="email" class="form-control @error('create_email') is-invalid @enderror"
                                        id="create_email" name="create_email" placeholder="Masukkan Email DPL Mitra">
                                    @error('create_email')
                                        <div id="create_email" class="form-text pb-1">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="create_nomor_telp">Nomor Telepon DPL Mitra</label>
                                    <input type="number" min="1"
                                        class="form-control @error('create_nomor_telp') is-invalid @enderror"
                                        id="create_nomor_telp" name="create_nomor_telp" placeholder="08xxxxxxxxxx">
                                    @error('create_nomor_telp')
                                        <div id="create_nomor_telp" class="form-text pb-1">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary" id="sa-success">Tambah</button>
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>

                    </form>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
@endsection
