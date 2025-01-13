@extends('layouts.base.base-template')

@section('title')
    <title>Ajukan Permohonan Dosen Pembimbing | SiMagang</title>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Ajukan Permohonan Dosen Pembimbing</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            @php $no = 1; @endphp
                            <table id="datatable" class="table">
                                <thead class="thead-light">
                                    <tr class="text-center">
                                        <th width="10%">No</th>
                                        <th class="text-left">Nama Dosen</th>
                                        <th class="text-left">NIP</th>
                                        <th class="text-left">Kuota Dosen Pembimbing</th>
                                        <th class="text-left">Nama Program Studi</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dosen_pembimbing as $data)
                                        <tr class="text-center">
                                            <td>{{ $no }}</td>
                                            <td class="text-left">{{ $data->dosen->nip }}</td>
                                            <td class="text-left">{{ $data->dosen->nama_dosen }}</td>
                                            <td class="text-left">{{ $data->kuota }}</td>
                                            <td class="text-left">{{ $data->dosen->prodi->nama_program_studi }}</td>
                                            <td>
                                                <form
                                                    action="{{ route('mahasiswa.permohonan.dosen.pembimbing.store', $data->id) }}"
                                                    enctype="multipart/form-data" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fa-solid fa-user-plus text-white font-16"
                                                            title="Ajukan Permohonan"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @php $no++; @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
