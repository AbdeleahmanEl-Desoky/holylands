

@if (session()->has('success'))
    <script>
        Swal.fire({
            title: 'success!',
            text: '{{ session("success") }}',
            icon: 'success',
            confirmButtonText: 'Cool'
        })
    </script>

@endif

@if (session()->has('danger'))
    <script>
        Swal.fire({
            title: 'success!',
            text: '{{ session("success") }}',
            icon: 'success',
            confirmButtonText: 'Cool'
        })
    </script>
@endif

@if (session()->has('info'))
    <script>
        Swal.fire({
            title: 'success!',
            text: '{{ session("success") }}',
            icon: 'success',
            confirmButtonText: 'Cool'
        })
    </script>
@endif

@if ($errors->any())

    <script>
        Swal.fire({
            title: 'error!',
            html: '@foreach($errors->all() as $error){{ $error }} <br> @endforeach',
            icon: 'error',
            confirmButtonText: 'Cool'
        })
    </script>

@endif
