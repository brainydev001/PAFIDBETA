
<!-- Bootstrap 4 -->
<script src={{ asset("plugins/bootstrap/js/bootstrap.bundle.min.js") }}></script>
<!-- DataTables -->
<script src={{ asset("plugins/datatables-bs4/js/dataTables.bootstrap4.js") }}></script>
<!-- AdminLTE App -->
<script src={{ asset("js/adminlte.min.js") }}></script>
<!-- AdminLTE for demo purposes -->
<script src={{ asset("js/demo.js") }}></script>
<script>
    $(function () {
      $("#example1").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
      });
    });
</script>

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