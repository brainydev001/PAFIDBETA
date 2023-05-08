@extends('layouts.main')

@section('page')

    @include('inc.navbar')
    <style>
        body {
            background: #f5f5f5;
        }
    </style>
    {{-- register page --}}
    <div class="container-fluid nav-clearfix">
        {{-- form --}}
        <div class="col-md-6 mb-4 card p-2 rounded-0 mt-3 text-center" style="margin:auto;">
            <div class="text-left">
                <span>
                    <i class="fas fa-info-circle bg-green"></i>
                </span>
                <span class="pl-1">
                    <sub>To create an account successfully, Fill in all the <b>form inputs </b> in the <b>three parts</b> with the <b>CORRECT</b> information.</sub>
                </span>
            </div>
    
            {{-- method and route declaration --}}
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
                {{-- include registration page --}}
                @include('auth.inc.registration_page')

                {{-- submit button --}}
                <div class="mt-3 mb-3">
                    <button class="btn btn-success btn-sm auth-btn">CREATE</button>
                </div>

                {{-- redirect if user has account --}}
                <div class="app-text-normal">
                    Already have an account?<a href="{{ route('login') }}"> Login</a>
                </div>

            </form>
        </div>
    </div>

@endsection
