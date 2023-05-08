<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- app css bootsrap 4 --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    {{-- custom css --}}
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <!-- setup -->
    <link rel="stylesheet" href={{ asset('css/setup.css') }}>
    <!-- fontawsome -->
    <link rel="stylesheet" href={{ asset('fontawsome/css/all.css') }}>
    <title>PAFID</title>
</head>

<body>
    {{-- web navigation bar --}}
    <div class="navbar nav border-bottom ">
        <li class="navbar-brand">
            <img src="{{ asset('img/pafid.png') }}" alt="" class="nav-photo">
        </li>
        <li class="text-right">
        <li class="mt-4 font-weight-bold nav-item">
            <a href="{{ url('/') }}" class="link" >
                HOME
            </a>
        </li>
        <li class="mt-4 font-weight-bold nav-item">
            <a href="https://www.pafidkenya.org/" class="link" >
                WEBSITE
            </a>
        </li>
        </li>
        <li class="text-right pr-2 mt-3 btn btn-login pr-4 pl-4 font-weight-bold">
            <a href="{{ route('login') }}" class="text-white">
                USER LOGIN
            </a>
        </li>
    </div>

    {{-- main body --}}

    <div>
        {{-- caurasel --}}
        <div class="carousel">
            <div class="app-carousel-bg"></div>
            <div class="app-carousel-bg app-carousel-bg2"></div>
            <div class="app-carousel-bg app-carousel-bg3"></div>
        </div>
        <!-- end carousel -->

        {{-- header --}}
        <div class="container-fluid app-text-bold mt-4 mb-4 ">
            <h3 class="text-white"><u>P.A.F.I.D Managment Information System</u></h3>
        </div>

        <div class="p-4 border-none">
            <div class="row">
                <div class="col-md-6 app-text-medium">
                    <p class="text-white text-xl p-1">
                        PAFID(Participatory Approaches for Integrated Development)
                        is a Kenyan NGO registered with the NGOs Co-ordination Board in 2005
                        to uplift the living standards of Kenya’s rural populations by integrating
                        development. PAFID has strong technical and managerial
                        capacity in project implementation and administration and a robust M&E system.
                    </p>
                    <p class="text-white text-xl p-1">
                        PAFID field staff have trained farmers in Conservation Farming
                        in 25 Counties in Kenya and focuses on the promotion of climate-smart
                        agriculture to improve the livelihoods of farmers, increase food security
                        and reduce the
                        negative impacts that conventional farming methods have on the environment.
                    </p>
                    <p class="text-white text-xl p-1">
                        This Managment Information System will help us achieve our mission which is, to have
                        an effective organization responsive to issues of food
                        security through maximizing the use and management of participatory approaches in
                        integrated development leading to vibrant, equitable and sustainable communities
                    </p>
                </div>
                <div class="col-md-6 side-img">
                    <img src="{{ asset('img/pafid-main.jpg') }}" alt="" class="w-100">
                </div>
            </div>
        </div>
    </div>
</body>

</html>
