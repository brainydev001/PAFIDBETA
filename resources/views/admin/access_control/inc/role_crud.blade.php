{{-- info --}}
<sub class="app-text-bold mt-3 mb-3 text-green">
    <u>
        Fill in new role details
    </u>
</sub>

{{-- new role inputs --}}
<div class="row app-auth-form text-left border-bottom mb-2">
    {{--name form item --}}
    <div class="col-md-6 mt-4">
        <label for="" class="app-text-medium">Role Name:</label>
        <input type="name" name="name" placeholder="Role Name" required
            @error('name') form-invalid @enderror>
        @error('name')
            <span class="text-sm text-red" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    {{--display_name form item --}}
    <div class="col-md-6 mt-4">
        <label for="" class="app-text-medium">Display Name:</label>
        <input type="display_name" name="display_name" placeholder="Display Name" required
            @error('display_name') form-invalid @enderror>
        @error('display_name')
            <span class="text-sm text-red" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    {{--description form item --}}
    <div class="col-md-6 mt-4">
        <label for="" class="app-text-medium">Description:</label>
        <input type="description" name="description" placeholder="Description" required
            @error('description') form-invalid @enderror>
        @error('description')
            <span class="text-sm text-red" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    {{--created_by item --}}
    <div class="col-md-6 mt-4 mb-2">
        <label for="" class="app-text-medium">Created By:</label>
        <input type="created_by" name="created_by" value="{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}" placeholder="{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}"
            @error('created_by') form-invalid @enderror>
        @error('created_by')
            <span class="text-sm text-red" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>