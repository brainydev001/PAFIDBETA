{{-- authentication layout --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- bootstrap 4 css --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    {{-- custom auth css --}}
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <!-- fontawsome -->
    <link rel="stylesheet" href={{ asset('fontawsome/css/all.css') }}>
    <!-- Theme style -->
    <link rel="stylesheet" href={{ asset("css/adminlte.min.css") }}>
    {{-- page title --}}
    <title>PAFID</title>
</head>
<body>
    {{-- include pages from auth sections --}}
    @yield('page')
 
    {{-- js and jquery scripts --}}
    <script src="{{ asset('js/jquery.js') }}"></script> 
    <script src="{{ asset('js/auth.js') }}"></script>
    <script>
        let old_countySelect = {
            county: "{{ old('county') ?? ($property->county ?? '') }}",
            sub_county: "{{ old('sub_county') ?? ($property->sub_county ?? '') }}"
        }
    </script>
    <script src="{{ asset('js/countySelect.js') }}"></script>
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