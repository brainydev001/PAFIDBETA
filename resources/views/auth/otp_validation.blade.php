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
        OTP CONFIRMATION
    </div>

    {{-- include alert messages --}}
    @include('alerts.messages')

    {{-- include registration form --}}
    <div class="container bg-red  mt-4">
        <form action="{{ route('otp_validator', ['id' => $id]) }}" method="post">
            @csrf
            {{-- basic information --}}
            <div class="app-auth-form text-center">
                {{-- first_name form item --}}
                <div class="m-auto mt-4 p-2">
                    <label for="" class="app-text-medium">O.T.P:</label><br>
                    <div class="auth-form-msg"></div>
                    <input type="text" name="otp" placeholder="OTP" value="{{ old('otp') }}" required>
                    @error('otp')
                        <span class="text-sm text-red" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

            </div>

            {{-- submit button --}}
            <div class="pt-3 pb-3 text-center">
                <button class="btn btn-success btn-sm auth-btn" type="submit">SUBMIT</button>
            </div>

        </form>
    </div>
@endsection
