<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>{{ config('app.name') }}</title>
    <link href="{{ asset('theme/css/style.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('theme/css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('theme/css/custom.css') }}" rel="stylesheet" />
    <!-- Include Bootstrap CSS (optional) -->
    <link href="{{ asset('theme/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Include DataTable CSS -->
    <link href="{{ asset('theme/css/jquery.dataTables.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('theme/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('theme/js/all.js') }}" crossorigin="anonymous"></script>

    <!-- SweetAlert2 CSS -->
    <link href="{{ asset('theme/css/sweetalert2.min.css') }}" rel="stylesheet" />

    <!-- SweetAlert2 JS -->
    <script src="{{ asset('theme/css/sweetalert2.min.js') }}" crossorigin="anonymous"></script>
    @stack('styles')
</head>

<body class="sb-nav-fixed">

    @include('theme.header')

    <div id="layoutSidenav">

        @include('theme.sidebar')
        <div id="layoutSidenav_content">

            <main>
                @yield('content')
                @include('sweetalert::sweetalert')
            </main>

            @include('theme.footer')
        </div>
    </div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('theme/js/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('theme/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('theme/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('theme/js/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('theme/js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('theme/assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('theme/assets/demo/chart-bar-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="{{ asset('theme/js/datatables-simple-demo.js') }}"></script>
    @stack('scripts')
</body>

</html>
