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
    {{-- forms css --}}
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <title>PAFID</title>
</head>

<body>
    {{-- web navigation bar --}}
    <div class="navbar nav border-bottom ">
        <li class="navbar-brand">
            <img src="{{ asset('img/pafid.png') }}" alt="" class="nav-photo">
        </li>
        
        <li class="text-right pr-2 mt-3 btn btn-login pr-4 pl-4 font-weight-bold">
            <a href="{{ url('/') }}" class="text-white">
                Home
            </a>
        </li>
    </div>

    {{-- main body --}}
    {{-- login page --}}
    <div class="container-fluid nav-clearfix">
        {{-- form --}}
        <div class="col-md-6 mb-4 card p-2 rounded-0 mt-3 text-center" style="margin:auto;">
            <h3 class="app-text-bold mt-3 mb-3">Authorization</h3>
            {{-- include error handler --}}
            @include('alerts.messages')

            <form method="POST" action="{{ route('setupAuth') }}">
                @csrf
                <div class="row app-auth-form text-left">
                    {{-- form item --}}
                    <div class="col-md-6 mt-4">
                        <label for="" class="app-text-medium">Username:</label>
                        <input type="username" name="username" placeholder="Username" required>
                        <div class="auth-form-msg"></div>
                    </div>
                    {{-- form item --}}
                    <div class="col-md-6 mt-4">
                        <label for="" class="app-text-medium">Password:</label><br>
                        <input type="password" class="auth-password" name="password" placeholder="Password" required>
                    </div>
                </div>
                <div class="mt-3 mb-3">
                    <button class="btn btn-success btn-sm auth-btn" type="submit">Setup</button>
                </div>

            </form>
        </div>
    </div>

</body>

</html>
