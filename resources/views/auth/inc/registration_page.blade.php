{{-- registration page with error handling methods --}}

{{-- info --}}
<div class="font-weight-bold text-left border p-2 mt-2">
    (1) Basic User Information
</div>
{{-- basic information --}}
<div class="row app-auth-form text-left p-2">
    {{-- first_name form item --}}
    <div class="col-md-6 mt-4">
        <label for="" class="app-text-medium">First Name:</label><br>
        <div class="auth-form-msg"></div>
        <input type="text" name="first_name" placeholder="First Name" value="{{ old('first_name') }}" required>
        @error('first_name')
            <span class="text-sm text-red" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    {{-- last_name form item --}}
    <div class="col-md-6 mt-4">
        <label for="" class="app-text-medium">Last Name:</label><br>
        <div class="auth-form-msg"></div>
        <input type="text" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}" required>
        @error('last_name')
            <span class="text-sm text-red" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    {{-- phone_number form item --}}
    <div class="col-md-6 mt-4">
        <label for="" class="app-text-medium">Phone number:</label><br>
        <div class="auth-form-msg"></div>
        <input type="text" class="auth-phone" name="phone_number" placeholder="0712345678"
            value="{{ old('phone_number') }}" required>
        @error('phone_number')
            <span class="text-sm text-red" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    
    {{-- email form item --}}
    <div class="col-md-6 mt-4">
        <label for="" class="app-text-medium">Email:</label><br>
        <div class="auth-form-msg"></div>
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
        @error('email')
            <span class="text-sm text-red" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    {{-- gender --}}
    <div class="col-md-6 mt-4">
        <label for="" class="app-text-medium">Gender:</label><br>
        <div class="auth-form-msg"></div>
        <select name="gender" class="form-control">
            <option disabled>Choose your gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
        @error('gender')
            <span class="text-sm text-red" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    {{-- age form item --}}
    <div class="col-md-6 mt-4">
        <label for="" class="app-text-medium">Date of Birth:</label><br>
        <div class="auth-form-msg"></div>
        <input type="month" name="age" placeholder="Age" value="{{ old('age') }}"
            required>
        @error('age')
            <span class="text-sm text-red" role="alert">
                <strong class="font-red">{{ $message }}</strong>
            </span>
        @enderror
    </div>

    {{-- photo form item --}}
    <div class="col-md-6 mt-4">
        <label for="" class="app-text-medium">User Photo:</label><br>
        <div class="auth-form-msg"></div>
        <input type="file" name="photo" required>
        @error('photo')
            <span class="text-sm text-red" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

{{-- info --}}
<div class="font-weight-bold text-left border p-2 mt-2">
    (2) Additional Information.
</div>
{{-- additional information --}}
<div class="row app-auth-form text-left">
    {{-- county form item --}}
    <div class="col-md-6 mt-4">
        <label for="" class="app-text-medium">County:</label><br>
        <div class="auth-form-msg"></div>
        <select name="county" class="form-control select-county @error('county') form-invalid @enderror"
            value="{{ old('county') }}">
            <option value="" disabled selected>Select county</option>
        </select>
        @error('county')
            <span class="text-sm text-red" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    {{-- sub_county form item --}}
    <div class="col-md-6 mt-4">
        <label for="" class="app-text-medium">Sub county:</label><br>
        <div class="auth-form-msg"></div>
        <select name="sub_county" class="form-control select-subcounty @error('sub_county') form-invalid @enderror"
            value="{{ old('sub_county') }}">
            <option value="" disabled selected>Select subcounty</option>
        </select>
        @error('sub_county')
            <span class="text-sm text-red" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    {{-- region form item --}}
    <div class="col-md-6 mt-4">
        <label for="" class="app-text-medium">Region:</label><br>
        <div class="auth-form-msg"></div>
        <select name="region_id" class="form-control region @error('region') form-invalid @enderror"
            value="{{ old('region') }}">
            <option value="" disabled selected>Select region</option>
            @isset ($regions)
                @foreach ($regions as $region)
                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                @endforeach
            @endisset
        </select>
        @error('region')
            <span class="text-sm text-red" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    {{-- ward form item --}}
    <div class="col-md-6 mt-4">
        <label for="" class="app-text-medium">Ward:</label><br>
        <div class="auth-form-msg"></div>
        <input type="text" class="form-control" name="area_name" placeholder="Ward Name" required>
        @error('ward')
            <span class="text-sm text-red" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    {{-- type form item --}}
    <div class="col-md-6 mt-4">
        <label for="" class="app-text-medium">User Type:</label><br>
        <div class="auth-form-msg"></div>
        <select name="type_id" class="form-control type_id @error('type_id') form-invalid @enderror"
            value="{{ old('type_id') }}">
            <option value="" disabled selected>Select user type</option>
            @isset($staffs)
                @foreach ($staffs as $staff)
                    <option value="{{ $staff->id }}">{{ $staff->staff_name }}</option>
                @endforeach
            @endisset
        </select>
        @error('type')
            <span class="text-sm text-red" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

{{-- info --}}
<div class="font-weight-bold text-left border p-2 mt-2">
    (3) Security Information.
</div>
{{-- security part --}}
<div class="row app-auth-form text-left">
    {{-- password form item --}}
    <div class="col-md-6 mt-4">
        <label for="" class="app-text-medium">Password:</label><br>
        <div class="auth-form-msg"></div>
        <input type="password" class="auth-password" name="password" placeholder="Password" required>
    </div>

    {{-- confirm_password form item --}}
    <div class="col-md-6 mt-4">
        <label for="" class="app-text-medium">Confirm Password:</label><br>
        <div class="auth-form-msg"></div>
        <input type="password" class="auth-password-confirm" name="password_confirmation"
            placeholder="Confirm Password" required>
    </div>
</div>


