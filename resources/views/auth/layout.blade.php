<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TSMana - SignIn</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{asset('assets/fonts/material-icon/css/material-design-iconic-font.min.css')}}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">

</head>
<body>

    <div class="main">
        @yield('auth-content')
    </div>

    <!-- JS -->
    <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
</body>
</html>