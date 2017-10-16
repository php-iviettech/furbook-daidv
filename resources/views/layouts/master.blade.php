<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Furbook</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="container">
        <div class="page-header">
            @yield('header')
        </div>
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        @yield('content')
    </div>
</body>

</html>