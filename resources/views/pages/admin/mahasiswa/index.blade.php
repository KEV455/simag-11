@extends('layouts.base.base-template')

@section('title')
    <title>Manajemen Mahasiswa | SiMagang</title>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Manajemen Mahasiswa</h4>
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
                        <a href="{{ route('admin.mahasiswa.create') }}" class="btn btn-primary px-4 mt-0 mb-3"
                            data-animation="bounce">
                            <i class="mdi mdi-plus-circle-outline mr-2"></i>Tambah Mahasiswa Baru
                        </a>

                        {{-- tombol modal import mahasiswa --}}
                        {{-- <button type="button" class="btn btn-success px-4 mt-0 mb-3" data-toggle="modal"
                            data-animation="bounce" data-target=".modalCreate">
                            <i class="fa-solid fa-cloud-arrow-up"></i>&ensp; Import
                        </button> --}}

                        <div class="table-responsive">
                            @php
                                $no = 1;
                            @endphp
                            <table id="datatable" class="table">
                                <thead class="thead-light">
                                    <tr class="text-center">
                                        <th width="10%">No</th>
                                        <th class="text-left">Nama Mahasiswa</th>
                                        <th class="text-center">Nim</th>
                                        <th class="text-left">Angkatan</th>
                                        <th class="text-left">Email</th>
                                        <th class="text-left">Jenis Kelamin</th>
                                        <th class="text-left">Prodi</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                    <!--end tr-->
                                </thead>

                                <tbody>
                                    @foreach ($mahasiswas as $item)
                                        <tr class="text-center">
                                            <td>{{ $no }}</td>
                                            <td class="text-left">{{ $item->nama_mahasiswa }}</td>
                                            <td class="text-center">{{ $item->nim }}</td>
                                            <td class="text-left">{{ $item->angkatan }}</td>
                                            <td class="text-left">{{ $item->email }}</td>
                                            <td class="text-left">{{ $item->jenis_kelamin }}</td>
                                            <td class="text-left">{{ $item->prodi->nama_program_studi }}</td>
                                            <td>
                                                <a href="{{ route('admin.mahasiswa.edit', $item->id) }}" class="mr-2"
                                                    data-animation="bounce">
                                                    <i class="fas fa-edit text-info font-16"></i>
                                                </a>
                                                <a href="{{ route('admin.mahasiswa.destroy', $item->id) }}">
                                                    <i class="fas fa-trash-alt text-danger font-16"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <!--end tr-->
                                        @php
                                            $no++;
                                        @endphp
                                    @endforeach
                                </tbody>
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

    <!--  Modal Import Mahasiswa -->
    {{-- <div class="modal fade modalCreate" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Import Data Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.mahasiswa.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="file">File Excel Mahasiswa<span
                                            class="text-primary">*(Wajib,
                                            .xlsx, .xls)</span></label>
                                    <div class="custom-file mb-3">
                                        <input type="file"
                                            class="custom-file-input form-control @error('file') is-invalid @enderror"
                                            id="file" name="file" onchange="displayFileName()">
                                        <label class="custom-file-label" for="file" id="fileLabel">
                                            <!-- Menampilkan nama file yang diunggah sebelumnya jika ada -->
                                            {{ session('file') ? session('file') : 'Choose file' }}
                                        </label>
                                        @error('file')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary" id="sa-success">Import</button>
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal --> --}}
@endsection

@section('bottom-script')
    {{-- upload file name --}}
    <script>
        function displayFileName() {
            const input = document.getElementById('file');
            const label = document.getElementById('fileLabel');
            const fileName = input.files[0].name;
            label.textContent = fileName;
        }
    </script>
@endsection
