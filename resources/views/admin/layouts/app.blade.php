<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Test</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-100">

    @yield('content')


    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type','info') }}"
        switch(type){
            case 'info':
            swal("{{ Session::get('title') }}", "{{ Session::get('message') }}", "info");
            break;

            case 'success':
            swal("{{ Session::get('title') }}", "{{ Session::get('message') }}", "success");
            break;

            case 'warning':
            swal("{{ Session::get('title') }}", " {{ Session::get('message') }} ", "warning");
            break;

            case 'error':
            swal("{{ Session::get('title') }}", " {{ Session::get('message') }} ", "error");
            break; 
        }
    @endif 
    </script>
</body>

</html>