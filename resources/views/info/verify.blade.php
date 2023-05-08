@extends('layouts.app')

@section('page')
    {{-- include top navigation --}}
    <!-- Navbar -->
    <nav class=" navbar navbar-expand navbar-white navbar-light">

        <!-- SEARCH FORM -->
        <form class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->


            {{-- logout --}}
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/logout') }}">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    {{-- heading --}}
    <div class="container-fluid text-center m-auto font-weight-bold text-xl mt-2 mb-4">
        USER CONFIRMATION
    </div>

    {{-- include alert messages --}}
    @include('alerts.messages')

    {{-- include alert form --}}
    <div class="container bg-red  mt-4">
        <div class="text-center text-white">
            <p>
                You account has not been verified. Contact your administrator to verify your account.
            </p>
        </div>
    </div>
@endsection
