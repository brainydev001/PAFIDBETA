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