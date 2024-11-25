@extends('layouts.base.base-template')

@section('title')
    <title>Manajemen Transkrip Nilai DPL Magang | SiMagang</title>
@endsection

@section('top-css')
    <link href="{{ asset('template/assets/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/assets/css/style.css') }}" rel="stylesheet" type="text/css" />\
@endsection


@php
    function timestampConversion($timestamp)
    {
        $monthNames = [
            'Januari',
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

        // Ubah timestamp ke dalam format yang dapat diolah oleh PHP
        $date = strtotime($timestamp);

        if ($date === false) {
            return 'Format tanggal tidak valid';
        }

        $day = date('j', $date);
        $monthIndex = date('n', $date) - 1; // Kurangi 1 karena indeks bulan dimulai dari 0
        $year = date('Y', $date);

        return $day . ' ' . $monthNames[$monthIndex] . ' ' . $year;
    }

    function kbToMb($sizeInKB)
    {
        // Konversi ukuran dari KB ke MB
        $sizeInMB = $sizeInKB / 1024;

        // Menggunakan format angka dengan 2 desimal
        $formattedSize = number_format($sizeInMB, 2);

        return $formattedSize . ' MB';
    }
@endphp

@section('content')
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <!--end /div-->
                    <h4 class="page-title">Transkrip Nilai DPL</h4>
                </div>
                <!--end page-title-box-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->
        <!-- end page title end breadcrumb -->

        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mt-0 mb-3">Menu Transkrip Nilai DPL</h4>
                        <div class="files-nav">
                            <div class="nav flex-column nav-pills" id="files-tab" aria-orientation="vertical">
                                <a class="nav-link active" id="files-projects-tab" data-toggle="pill" href="#files-projects"
                                    aria-selected="true">
                                    <i class="em em-file_folder mr-3 text-warning d-inline-block"></i>
                                    <div class="d-inline-block align-self-center">
                                        <h5 class="m-0">Unggah Transkrip Nilai DPL</h5>
                                    </div>
                                </a>
                                <a class="nav-link  align-items-center" id="files-pdf-tab" data-toggle="pill"
                                    href="#files-pdf" aria-selected="false">
                                    <i class="em em-file_folder mr-3 text-warning d-inline-block"></i>
                                    <div class="d-inline-block align-self-center">
                                        <h5 class="m-0">Daftar Transkrip Nilai DPL</h5>
                                    </div>
                                    <span class="badge badge-success ml-auto">{{ $transkrip_nilai_dpl_count }}</span>
                                </a>
                            </div>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->

            <div class="col-lg-9">
                <div class="">
                    <div class="tab-content" id="files-tabContent">
                        <div class="tab-pane fade show active" id="files-projects">
                            {{-- Form Create Transkrip --}}
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('mahasiswa.transkrip.nilai.dpl.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="file">File Transkrip
                                                        <span class="text-primary">*(Wajib, .pdf only, max 5Mb)</span>
                                                    </label>
                                                    <div class="custom-file">
                                                        <input type="file"
                                                            class="custom-file-input form-control @error('file') is-invalid @enderror"
                                                            id="file" name="file" onchange="displayFileName()"
                                                            required>
                                                        <label class="custom-file-label" for="file"
                                                            id="fileLabel">Choose file</label>
                                                        @error('file')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if (!$flag_transkrip)
                                            <button type="submit" class="btn btn-sm btn-primary"
                                                id="sa-success">Submit</button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div><!--end tab-pane-->

                        <div class="tab-pane fade" id="files-pdf">
                            <h4 class="mt-0 header-title mb-3">Transkrip Nilai DPL Magang</h4>
                            <div class="file-box-content">
                                @if ($transkrip_nilai_dpl->isEmpty())
                                    <span>Transkrip Nilai DPL Belum Ditambahkan</span>
                                @else
                                    @foreach ($transkrip_nilai_dpl as $data)
                                        <div class="file-box" title="">
                                            <div class="row">
                                                <div class="col d-flex">
                                                    <a href="{{ route('mahasiswa.transkrip.nilai.dpl.destroy', $data->id) }}"
                                                        class="mr-auto my-auto">
                                                        <i
                                                            class="fa-regular fa-trash-can panduan-text-size text-danger"></i>
                                                    </a>
                                                </div>
                                                <div class="col d-flex">
                                                    <a href="{{ asset('storage/' . $data->file_transkrip_nilai) }}"
                                                        target="_blank" class="ml-auto my-auto">
                                                        <i class="fa-solid fa-download panduan-text-size text-success"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="text-center py-3">
                                                <i class="far fa-file-pdf text-primary"></i>
                                                <h6 class="text-truncate">
                                                    Transkrip_Nilai_DPL.pdf
                                                </h6>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div><!--end tab-pane-->

                        <div class="tab-pane fade" id="files-hide">
                            <h4 class="mt-0 header-title mb-3">Hide</h4>
                        </div><!--end tab-pane-->
                    </div> <!--end tab-content-->
                </div><!--end card-body-->
            </div><!--end col-->
        </div><!--end row-->

    </div><!-- container -->
    </div>
    <!-- end page content -->
@endsection

@section('script')
    {{-- upload file name --}}
    <script>
        function displayFileName() {
            const input = document.getElementById('file');
            const label = document.getElementById('fileLabel');

            // Pastikan ada file yang dipilih
            if (input.files && input.files.length > 0) {
                const fileName = input.files[0].name;
                label.textContent = fileName; // Tampilkan nama file di label
            } else {
                label.textContent = 'Choose file'; // Kembali ke teks default jika tidak ada file
            }
        }
    </script>
@endsection
