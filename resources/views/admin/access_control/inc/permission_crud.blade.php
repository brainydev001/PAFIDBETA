{{-- info --}}
<sub class="app-text-bold mt-4 mb-3 text-green">
    <u>
        Check to assign permission or permissions to the above role
    </u>
</sub>

{{-- permission checkboxes --}}
{{-- permissions in groups by display name --}}
<div class="row app-auth-form text-left">
    {{-- user permissions item --}}
    <div class="col-md-12 mt-4 border-bottom">
        @isset($perm_users)
                <h6>
                    <u>Users Permissions</u>
                </h6>
                @if (count($perm_users) > 0)
                    <div class="row p-3">
                        @foreach ($perm_users as $perm_user)
                            <div class="col-4">
                                <label for="">
                                    <span>
                                        {{ $perm_user->name }}
                                    </span>
                                    <span>
                                        <input type="checkbox" name="perm[]" id="{{ $perm_user->id }}"
                                            value="{{ $perm_user->id }}">
                                    </span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                @else
                @endif
        @endisset
    </div>

    {{-- region permissions item --}}
    <div class="col-md-12 mt-4 border-bottom">
        @isset($perm_regions)
            <h6>
                <u>
                    Region Permissions
                </u>
            </h6>
            @if (count($perm_regions) > 0)
                <div class="row p-3">
                    @foreach ($perm_regions as $perm_region)
                        <div class="col-4 mt-2">
                            <label for="">
                                <span>
                                    {{ $perm_region->name }}
                                </span>
                                <span>
                                    <input type="checkbox" name="perm[]" id="{{ $perm_region->id }}"
                                        value="{{ $perm_region->id }}">
                                </span>
                            </label>
                        </div>
                    @endforeach
                </div>
            @else
            @endif
        @endisset
    </div>

    {{-- access control permissions item --}}
    <div class="col-md-12 mt-4 border-bottom">
        @isset($perm_accessControls)
            <h6>
                <u>
                    Access Control & Security Permissions
                </u>
            </h6>
            @if (count($perm_accessControls) > 0)
                <div class="row p-3">
                    @foreach ($perm_accessControls as $perm_accessControl)
                    <div class="col-4 mt-2">
                        <label for="">
                            <span>
                                {{ $perm_accessControl->display_name }}
                            </span>
                            <span>
                                <input type="checkbox" name="perm[]" id="{{ $perm_accessControl->id }}"
                                    value="{{ $perm_accessControl->id }}">
                            </span>
                        </label>
                    </div>
                @endforeach
                </div>
            @else
            @endif
        @endisset
    </div>

    {{-- Role permissions item --}}
    <div class="col-md-12 mt-4">
        @isset($perm_roles)
            <h6>
                <u>
                    Role Permissions
                </u>
            </h6>
            @if (count($perm_roles) > 0)
                <div class="row p-3">
                    @foreach ($perm_roles as $perm_role)
                    <div class="col-4 mt-2">
                        <label for="">
                            <span>
                                {{ $perm_role->name }}
                            </span>
                            <span>
                                <input type="checkbox" name="perm[]" id="{{ $perm_role->id }}"
                                    value="{{ $perm_role->id }}">
                            </span>
                        </label>
                    </div>
                @endforeach
                </div>
            @else
            @endif
        @endisset
    </div>

</div>
