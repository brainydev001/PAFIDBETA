{{-- success message --}}
@if (session()->has('success-message'))
    <div class="alert alert-success alert-dismissible w-1/2 justify-items-center">
        <button type="button" class="close text-red" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i> Alert!</h5>
        {{ session()->get('success-message') }}
    </div>
@endif

{{-- info message --}}
@if (session()->has('info-message'))
    <div class="alert alert-info alert-dismissible w-1/2 justify-items-center">
        <button type="button" class="close text-red" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i> Alert!</h5>
        {{ session()->get('info-message') }}
    </div>
@endif

{{-- warning message --}}
@if (session()->has('warning-message'))
    <div class="alert alert-warning alert-dismissible w-1/2 justify-items-center">
        <button type="button" class="close text-red" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i> Alert!</h5>
        {{ session()->get('warning-message') }}
    </div>
@endif

{{-- danger message --}}
@if (session()->has('danger-message'))
    <div class="alert alert-danger alert-dismissible w-1/2 justify-items-center">
        <button type="button" class="close text-red" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i> Alert!</h5>
        {{ session()->get('danger-message') }}
    </div>
@endif


