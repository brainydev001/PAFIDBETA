@extends('layouts.admin')

@section('page')
    {{-- include top nav --}}
    @include('admin.inc.admin_top_nav')

    {{-- include side nav --}}
    @include('admin.inc.admin_side_nav') 

    {{-- form input --}}
    <form action="{{ route('main-store', $type )}}" method="post" enctype="multipart/form-data">
        @csrf

        {{-- include registration form --}}
        @include('admin.users.inc.crud')

        {{-- submit button --}}
        <div class="text-center mt-4 mb-4">
            <button class="btn btn-warning" type="submit">
                Create {{ $type }}
            </button>
        </div>
    </form>
@endsection
