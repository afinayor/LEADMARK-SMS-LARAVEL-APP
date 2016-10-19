@if(Session::has('info'))
    <script>
        swal(
                'Good job!',
                "{{Session::get('info')}}",
                'success')
    </script>
@endif
@if(Session::has('signininfo'))
    <script>
        swal(
                'Welcome {{Auth::User()->getUsername()}}',
                "{{Session::get('signininfo')}}",
                'success')
    </script>
@endif
@if(Session::has('error'))
    <script>
        swal(
                'Error',
                "{{Session::get('error')}}",
                'warning')
    </script>
@endif

