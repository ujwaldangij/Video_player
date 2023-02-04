<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicons -->
    <link href="{{ asset('asset/admin/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('asset/admin/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    {{-- <link href="https://fonts.gstatic.com" rel="preconnect"> --}}
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('asset/admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/admin/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/admin/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/admin/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/admin/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/admin/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/admin/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/admin/datatable_folder/jquery.dataTables.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('asset/admin/css/style.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    @include('admin.include.header')
    @include('admin.include.sidebar')

    @yield('body')

    @include('admin.include.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('asset/admin/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('asset/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('asset/admin/datatable_folder/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('asset/admin/datatable_folder/jquery.dataTables.min.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('asset/admin/js/main.js') }}"></script>

</body>

</html>