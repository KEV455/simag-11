<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />

    {{-- title --}}
    @yield('title')

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A premium admin dashboard template by Mannatthemes" name="description" />
    <meta content="Mannatthemes" name="author" />

    {{-- icon taskbar image --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo-title-poliwangi.png') }}" />

    <!-- DataTables -->
    <link href="{{ asset('template/assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('template/assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{ asset('template/assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- App css -->
    <link href="{{ asset('template/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/assets/css/metisMenu.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/assets/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    {{-- Font awesome icon cdn --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- top-script --}}
    @yield('top-script')

    {{-- top-css --}}
    @yield('top-css')

</head>

<body>
    {{-- sweet alert --}}
    @include('sweetalert::alert')

    {{-- import navbar --}}
    @include('layouts.partials.base-navbar')

    <div class="page-wrapper">
        <!-- Page Content-->
        <div class="page-content">

            {{-- custom content --}}
            @yield('content')

        </div>
        <!-- end page content -->
    </div>
    <!-- end page-wrapper -->

    {{-- bottom-script --}}
    @yield('bottom-script')

    <!-- jQuery  -->
    <script src="{{ asset('template/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/waves.min.js') }}"></script>

    <script src="{{ asset('template/assets/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('template/assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('template/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

    {{-- Datatable --}}
    <script src="{{ asset('template/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/assets/pages/jquery.hospital_dashboard.init.js') }}"></script>
</body>

</html>
