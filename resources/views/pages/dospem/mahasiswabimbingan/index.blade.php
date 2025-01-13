@extends('layouts.base.base-template')

@section('title')
    <title>Manajemen Mahasiswa | SiMagang</title>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Manajemen Mahasiswa Magang || {{ $dosen_pembimbing->dosen->nama_dosen }}</h4>
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
                                        <th class="text-left">Prodi</th>
                                        <th class="text-left">Lowongan</th>
                                        <th class="text-left">Logbook</th>
                                        <th class="text-left">Laporan Akhir</th>
                                    </tr>
                                    <!--end tr-->
                                </thead>

                                <tbody>
                                    @foreach ($pembimbing_magang as $data)
                                        <tr class="text-center">
                                            <td>{{ $no }}</td>
                                            <td class="text-left">{{ $data->mahasiswa->nama_mahasiswa }}</td>
                                            <td class="text-center">{{ $data->mahasiswa->nim }}</td>
                                            <td class="text-left">{{ $data->mahasiswa->prodi->nama_program_studi }}</td>
                                            <td class="text-left">
                                                @foreach ($data->mahasiswa->pelamar_magang as $item)
                                                    {{ $item->lowongan->nama }} - {{ $item->lowongan->mitra->nama }}
                                                @endforeach
                                            </td>
                                            <td class="text-center">
                                                @foreach ($data->mahasiswa->pelamar_magang as $pelamar)
                                                    @foreach ($pelamar->peserta_magang as $peserta)
                                                        @if (isset($peserta->id))
                                                            {{-- Tautan logbook untuk peserta --}}
                                                            <a
                                                                href="{{ route('dospem.mahasiswa.bimbingan.logbook', ['id' => $peserta->id]) }}">
                                                                <i class="fa-solid fa-eye text-primary font-16"
                                                                    title="Logbook Mahasiswa"></i>
                                                            </a> &ensp;
                                                        @else
                                                            <span class="text-muted">Data tidak tersedia</span>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </td>

                                            <td class="text-left">
                                                <button type="button" class="btn btn-primary px-4 mt-0 mb-3"
                                                    data-toggle="modal" data-animation="bounce"
                                                    data-target="#modalView-{{ $data->id }}">
                                                    <i class="fa-solid fa-file-circle-check"></i>&ensp; Lihat
                                                </button>

                                            </td>
                                        </tr>
                                        <!--end tr-->
                                        @php
                                            $no++;
                                        @endphp
                                        <!--  Modal Add new content for the above example -->
                                        <div class="modal fade" id="modalView-{{ $data->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="modalLabel-{{ $data->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalLabel-{{ $data->id }}">Laporan
                                                            Akhir {{ $data->mahasiswa->nama_mahasiswa }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @foreach ($data->mahasiswa->pelamar_magang as $pelamar)
                                                            @php
                                                                // Mengumpulkan semua laporan akhir untuk pelamar
                                                                $laporanAkhirCollection = $pelamar->peserta_magang->flatMap(
                                                                    function ($peserta) {
                                                                        return $peserta->laporan_akhir_magang;
                                                                    },
                                                                );
                                                            @endphp

                                                            @if ($laporanAkhirCollection->isNotEmpty())
                                                                @foreach ($laporanAkhirCollection as $laporanAkhir)
                                                                    <iframe
                                                                        src="{{ asset('storage/' . $laporanAkhir->file_laporan_akhir) }}"
                                                                        width="100%" height="700px" style="border: none;">
                                                                    </iframe>
                                                                @endforeach
                                                            @else
                                                                <p class="text-muted">Laporan akhir belum tersedia.</p>
                                                            @endif
                                                        @endforeach


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
