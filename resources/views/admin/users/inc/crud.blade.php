<!-- Content Wrapper. Contains page content -->
@if ($type == 'User')
    <div class="content-wrapper">
        {{-- breadcrumbs --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 justify-items-center">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Create New {{ $type }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard_index') }}">Dashboard</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        {{-- include alert messages --}}
        @include('alerts.messages')

        <div class="container-fluid">
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
                    <input type="text" name="first_name" placeholder="First Name" value="{{ old('first_name') }}"
                        required>
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
                    <input type="text" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}"
                        required>
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
                    <input type="month" name="age" placeholder="Age" value="{{ old('age') }}" required>
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
                    <select name="sub_county"
                        class="form-control select-subcounty @error('sub_county') form-invalid @enderror"
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
                        @isset($regions)
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

            {{-- info --}}
            <div class="font-weight-bold text-left border p-2 mt-2">
                (4) Check the boxes to assign roles.
            </div>

            {{-- roles --}}
            <div class="mt-4">
                @isset($roles)
                    @if (count($roles) > 0)
                        <div class="row">
                            @foreach ($roles as $role)
                                <div class="col-md-4 d-flex mt-2 mb-1">
                                    <label for="" class="mt-3">
                                        {{ $role->display_name }}
                                    </label>
                                    <input type="radio" name="role_id" value="{{ $role->id }}"
                                        class="form-control mt-2 w-25">
                                </div>
                            @endforeach
                        </div>
                    @else
                        No roles found
                    @endif
                @endisset
            </div>
        </div>

    </div>

    {{-- farmer create component --}}
@elseif($type == 'Farmer')
    <div class="content-wrapper">
        {{-- breadcrumbs --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 justify-items-center">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Create New {{ $type }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard_index') }}">Dashboard</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        {{-- include alert messages --}}
        @include('alerts.messages')

        <div class="container-fluid">
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
                    <input type="text" name="first_name" placeholder="First Name"
                        value="{{ old('first_name') }}" required>
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
                    <input type="text" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}"
                        required>
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

                {{-- age form item --}}
                <div class="col-md-6 mt-4">
                    <label for="" class="app-text-medium">Age:</label><br>
                    <div class="auth-form-msg"></div>
                    <select name="age" id="" class="form-control">
                        <option disabled>Choose age group</option>
                        <option value="Under 35">Under 35</option>
                        <option value="Between 35 - 60">Between 35 - 60</option>
                        <option value="Above 60">Above 60</option>
                    </select>
                    @error('age')
                        <span class="text-sm text-red" role="alert">
                            <strong class="font-red">{{ $message }}</strong>
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

                {{--  form item --}}
                <div class="col-md-6 mt-4">
                    <label for="" class="app-text-medium">Farmer Type:</label><br>
                    <div class="auth-form-msg"></div>
                    <select name="type" class="form-control">
                        <option value="Under Training">Under Training</option>
                        <option value="Adopter Farmer">Adopter Farmer</option>
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
                    <select name="sub_county"
                        class="form-control select-subcounty @error('sub_county') form-invalid @enderror"
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
                        @isset($regions)
                            @if (count($regions) > 0)
                                @foreach ($regions as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            @else
                                <option value="" disabled selected>Select region</option>
                            @endif
                        @endisset
                    </select>
                    @error('region')
                        <span class="text-sm text-red" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{--  form item --}}
                <div class="col-md-6 mt-4">
                    <label for="" class="app-text-medium">Ward Name:</label><br>
                    <div class="auth-form-msg"></div>
                    <input type="text" name="ward_name" class="form-control" placeholder="Ward Name">
                    @error('ward_name')
                        <span class="text-sm text-red" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            {{-- info --}}
            <div class="font-weight-bold text-left border p-2 mt-2">
                (2) Disability form.
            </div>
            <small class="text-green font-bold">Only fill in if farmer is disabled</small>
            {{-- additional information --}}
            <div class="row app-auth-form text-left">
                {{-- county form item --}}
                <div class="col-md-6 mt-4">
                    <label for="" class="app-text-medium">Disability Type:</label><br>
                    <small class="text-red">Optional</small>
                    <div class="auth-form-msg"></div>
                    <select name="disability_name"
                        class="form-control select disability_name @error('disability_name') form-invalid @enderror"
                        value="{{ old('disability_name') }}">
                        <option value="" disabled selected>Select Disability Type</option>
                        <option value="Eyesight" name="disability_name">Eyesight</option>
                        <option value="Hearing/communication" name="disability_name">Hearing/communication</option>
                        <option value="Limbs (physical)" name="disability_name">Limbs (physical)</option>
                        <option value="Cognitive/mental disorders" name="disability_name">Cognitive/mental disorders
                        </option>
                        <option value="Other" name="disability_name">Other</option>
                    </select>
                    @error('disability_name')
                        <span class="text-sm text-red" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-6 mt-4">
                    <label for="" class="app-text-medium">Provide a note if need be:</label><br>
                    <small class="text-red">Optional</small>
                    <div class="auth-form-msg"></div>
                    <textarea name="note" id="" cols="50" rows="3" class="form-control"></textarea>
                    @error('note')
                        <span class="text-sm text-red" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

            </div>
        </div>

    </div>
@endif

{{-- include js --}}
{{-- js and jquery scripts --}}
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/auth.js') }}"></script>
<script>
    let old_countySelect = {
        county: "{{ old('county') ?? ($property->county ?? '') }}",
        sub_county: "{{ old('sub_county') ?? ($property->sub_county ?? '') }}"
    }
</script>
<script src="{{ asset('js/countySelect.js') }}"></script>
