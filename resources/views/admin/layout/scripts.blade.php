<script src="{{ asset('admin/assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('admin/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('admin/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/dist/js/app-style-switcher.js') }}"></script>
<script src="{{ asset('admin/dist/js/feather.min.js') }}"></script>
<script src="{{ asset('admin/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('admin/dist/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('admin/dist/js/custom.min.js') }}"></script>
<script src="{{ asset('admin/assets/extra-libs/c3/d3.min.js') }}"></script>
<script src="{{ asset('admin/assets/extra-libs/c3/c3.min.js') }}"></script>
<script src="{{ asset('admin/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js') }}"></script>
<script src="{{ asset('admin/assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('admin/assets/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('admin/assets/DataTables/datatables.min.js') }}"></script>


<script>
    @php
    $success = '';
    if(\Session::has('success'))
    $success = \Session::get('success');

        $error = '';
        if(\Session::has('error'))
            $error = \Session::get('error');
    @endphp
    
    var success = "{{ $success }}";
    var error = "{{ $error }}";

    if(success != ''){
        toastr.success(success, 'Success');
    }

    if(error != ''){
        toastr.error(error, 'error');
    }
</script>
@yield('scripts')