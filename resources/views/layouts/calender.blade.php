<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <!-- jQuery -->
    <script src={{ asset('plugins/jquery/jquery.min.js') }}></script>
    <!-- DataTables -->
    <script src={{ asset('plugins/datatables/jquery.dataTables.js') }}></script>
    <!-- Tempusdominus Bbootstrap 4 -->
    {{-- <link rel="stylesheet" href={{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}> --}}
    <!-- iCheck -->
    {{-- <link rel="stylesheet" href={{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}> --}}
    <!-- JQVMap -->
    {{-- <link rel="stylesheet" href={{ asset('plugins/jqvmap/jqvmap.min.css') }}> --}}
    <!-- Theme style -->
    <link rel="stylesheet" href={{ asset('css/adminlte.min.css') }}>
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href={{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}>
    <!-- Daterange picker -->
    <link rel="stylesheet" href={{ asset('plugins/daterangepicker/daterangepicker.css') }}>
    <!-- summernote -->
    <link rel="stylesheet" href={{ asset('plugins/summernote/summernote-bs4.css') }}>
    <!-- DataTables -->
    <link rel="stylesheet" href={{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}>
    <!-- Theme style -->
    <link rel="stylesheet" href={{ asset('css/adminlte.min.css') }}>
    <!-- fontawsome -->
    <link rel="stylesheet" href={{ asset('fontawsome/css/all.css') }}>
    {{-- forms css --}}
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    {{-- custom auth css --}}
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <!-- jQuery -->
    <script src={{ 'plugins/jquery/jquery.min.js' }}></script>
    <!-- jQuery UI 1.11.4 -->
    <script src={{ 'plugins/jquery-ui/jquery-ui.min.js' }}></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- jQuery -->
    {{-- <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script> --}}
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    {{-- calender --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    {{-- page title --}}
    <title>PAFID ADMIN</title>

    {{-- <script>
        $(document).ready(function() {
            console.log(true);
            $('#calender').fullCalender({
                
            })
        });
    </script> --}}
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        @yield('page')

    </div>

    {{-- custom page scripts --}}
    @yield('adminScripts')


    {{-- scripts (js & jquery) --}}

    
    <!-- Bootstrap 4 -->
    <script src={{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}></script>
    <!-- ChartJS -->
    {{-- <script src={{ asset('plugins/chart.js/Chart.min.js') }}></script> --}}
    <!-- Sparkline -->
    {{-- <script src={{ asset('plugins/sparklines/sparkline.js') }}></script> --}}
    <!-- JQVMap -->
    {{-- <script src={{ asset('plugins/jqvmap/jquery.vmap.min.js') }}></script> --}}
    {{-- <script src={{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}></script> --}}
    <!-- jQuery Knob Chart -->
    {{-- <script src={{ asset('plugins/jquery-knob/jquery.knob.min.js') }}></script> --}}
    <!-- daterangepicker -->
    <script src={{ asset('plugins/moment/moment.min.js') }}></script>
    <script src={{ asset('plugins/daterangepicker/daterangepicker.js') }}></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src={{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}></script>
    <!-- Summernote -->
    <script src={{ asset('plugins/summernote/summernote-bs4.min.js') }}></script>
    <!-- overlayScrollbars -->
    <script src={{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}></script>
    <!-- AdminLTE App -->
    <script src={{ asset('js/adminlte.js') }}></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src={{ asset('js/dashboard.js') }}></script>
    <!-- AdminLTE for demo purposes -->
    <script src={{ asset('js/demo.js') }}></script>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/63ee8ea8c2f1ac1e2033b9ab/1gpdtqhsj';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
</body>

</html>
