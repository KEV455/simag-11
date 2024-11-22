@extends('layouts.base.base-template')

@section('title')
    <title>Permohonan Magang Mahasiswa Ditolak | SiMagang</title>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Permohonan Magang Mahasiswa Ditolak</h4>
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
                        <a href="{{ route('koordinator.pelamar.magang.index') }}" class="btn btn-warning px-4 mt-0 mb-3"
                            data-animation="bounce">
                            <i class="fa-solid fa-clock"></i>&ensp;Lamaran Menunggu
                        </a>&ensp;
                        <a href="{{ route('koordinator.pelamar.magang.diterima.index') }}"
                            class="btn btn-success px-4 mt-0 mb-3" data-animation="bounce">
                            <i class="fa-solid fa-circle-xmark"></i>&ensp;Lamaran Diterima
                        </a>

                        <div class="table-responsive">
                            @php
                                $no = 1;
                            @endphp

                            <table id="datatable" class="table">
                                <thead class="thead-light">
                                    <tr class="text-center">
                                        <th width="10%">No</th>
                                        <th class="text-left">Nama Mahasiswa</th>
                                        <th class="text-left">Nim Mahasiswa</th>
                                        <th class="text-left">Program Studi</th>
                                        <th class="text-left">Nama Mitra</th>
                                        <th class="text-left">Lowongan</th>
                                        <th class="text-center">Berkas</th>
                                    </tr>
                                    <!--end tr-->
                                </thead>

                                <tbody>
                                    @foreach ($pelamar_magang_menunggu as $item)
                                        <tr class="text-center">
                                            <td>{{ $no }}</td>
                                            <td class="text-left">{{ $item->mahasiswa->nama_mahasiswa }}</td>
                                            <td class="text-left">{{ $item->mahasiswa->nim }}</td>
                                            <td class="text-left">{{ $item->mahasiswa->prodi->nama_program_studi }}</td>
                                            <td class="text-left">{{ $item->lowongan->mitra->nama }}</td>
                                            <td class="text-left">{{ $item->lowongan->nama }}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-primary px-4 mt-0 mb-3"
                                                    data-toggle="modal" data-animation="bounce" data-target=".modalView">
                                                    <i class="fa-solid fa-file-circle-check"></i>&ensp;
                                                    Lihat Berkas Saya
                                                </button>
                                            </td>
                                        </tr>
                                        <!--end tr-->
                                        @php
                                            $no++;
                                        @endphp

                                        <!--  Modal Add new content for the above example -->
                                        <div class="modal fade modalView" tabindex="-1" role="dialog"
                                            aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title mt-0" id="myLargeModalLabel">Berkas Lamaran -
                                                            {{ $item->lowongan->nama }}
                                                            ({{ $item->lowongan->mitra->nama }})
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                @if ($item->berkas_pelamar && $item->berkas_pelamar->count() > 0)
                                                                    {{-- Accordion --}}
                                                                    <div class="accordion" id="accordionExample">
                                                                        @foreach ($item->berkas_pelamar as $index => $dataBerkas)
                                                                            <div class="card">
                                                                                <!-- Header untuk tombol accordion -->
                                                                                <div class="card-header"
                                                                                    id="heading-{{ $index }}">
                                                                                    <h5 class="mb-0">
                                                                                        <button
                                                                                            class="btn btn-link {{ $loop->first ? '' : 'collapsed' }}"
                                                                                            type="button"
                                                                                            data-toggle="collapse"
                                                                                            data-target="#collapse-{{ $index }}"
                                                                                            aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                                                                            aria-controls="collapse-{{ $index }}">
                                                                                            {{ $dataBerkas->berkas_lowongan->berkas->nama_berkas }}
                                                                                        </button>
                                                                                    </h5>
                                                                                </div>

                                                                                <!-- Konten accordion -->
                                                                                <div id="collapse-{{ $index }}"
                                                                                    class="collapse {{ $loop->first ? 'show' : '' }}"
                                                                                    aria-labelledby="heading-{{ $index }}"
                                                                                    data-parent="#accordionExample">
                                                                                    <div class="card-body">
                                                                                        <iframe
                                                                                            src="{{ asset('storage/' . $dataBerkas->file) }}"
                                                                                            width="100%" height="700px"
                                                                                            style="border: none;">
                                                                                        </iframe>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                @else
                                                                    <p class="text-muted">Berkas pelamar belum tersedia.</p>
                                                                @endif
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
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
    <script>
        $(document).ready(function() {
            // Menyimpan status elemen yang terbuka
            $('#accordionExample .collapse').on('shown.bs.collapse', function() {
                localStorage.setItem('activeAccordion', $(this).attr('id'));
            });

            // Menghapus status jika elemen tertutup
            $('#accordionExample .collapse').on('hidden.bs.collapse', function() {
                localStorage.removeItem('activeAccordion');
            });

            // Membuka elemen berdasarkan status terakhir
            var activeAccordion = localStorage.getItem('activeAccordion');
            if (activeAccordion) {
                $('#' + activeAccordion).collapse('show');
            }
        });
    </script>
@endsection
