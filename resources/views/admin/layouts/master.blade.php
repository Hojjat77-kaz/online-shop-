<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>VRU - @yield('title')</title>
    <link href="{{ asset('/css/admin.css') }}" rel="stylesheet">
    <!-- Custom styles for this template-->
    @yield('style')

</head>
<body id="page-top">

@include('sweetalert::alert')


<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    @include('admin.section.sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            <!-- Topbar -->
             @include('admin.section.topbar')
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

             @yield('content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        @include('admin.section.footer')
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
 @include('admin.section.scrollbar')
<!-- Logout Modal-->
<script src="{{ asset('/js/app.js') }}"></script>
<!-- Bootstrap core JavaScript-->
@yield('script')
</body>

</html>
