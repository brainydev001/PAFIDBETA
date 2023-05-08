@extends('layouts.main')

@section('page')
@include('inc.navbar')
<style>
    body{
        background: #f5f5f5;
    }
</style>

{{-- login page --}}
<div class="container-fluid nav-clearfix">
    {{-- form --}}
    <div class="col-md-6 mb-4 card p-2 rounded-0 mt-3 text-center" style="margin:auto;">
        <h3 class="app-text-bold mt-3 mb-3">Login</h3>
        @if ($errors->has('phone_number'))
            <div class="alert alert-danger p-3 app-text-medium">
                Incorrect phone number or password
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="row app-auth-form text-left">
                {{-- form item --}}
                <div class="col-md-6 mt-4">
                    <label for="" class="app-text-medium">Phone Number:</label>
                    <input type="text" name="phone_number" placeholder="Phone Number" required>
                    <div class="auth-form-msg"></div>
                </div>
                {{-- form item --}}
                <div class="col-md-6 mt-4">
                    <label for="" class="app-text-medium">Password:</label><br>
                    <input type="password" class="auth-password" name="password" placeholder="Password" required>
                </div>
            </div>
            <div class="mt-3 mb-3">
                <button class="btn btn-success btn-sm auth-btn">LOGIN</button>
            </div>
            <div class="app-text-normal">
                Don't have an account?<a href="{{route('register')}}"> Register</a>
            </div>
            <div class="app-text-normal">
                <a href="{{url('reset_password')}}"> Forgot password</a>
            </div>
        </form>
    </div>
</div>

@endsection
