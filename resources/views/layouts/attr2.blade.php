<!DOCTYPE html>
<html lang="en">
<head>
    <title>Larisso</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->  
    <link rel="icon" type="image/png" href="{{url('assets/login/images/icons/favicon.ico')}}"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{url('assets/login/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{url('assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{url('assets/login/vendor/animate/animate.css')}}">
    <!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="{{url('assets/login/vendor/css-hamburgers/hamburgers.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{url('assets/login/vendor/select2/select2.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{url('assets/login/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('assets/login/css/main.css')}}">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container">
            @yield('content')
        </div>
    </div>

    
    <!--===============================================================================================-->  
    <script src="{{url('assets/login/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{url('assets/login/vendor/bootstrap/js/popper.js')}}"></script>
    <script src="{{url('assets/login/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{url('assets/login/vendor/select2/select2.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{url('assets/login/vendor/tilt/tilt.jquery.min.js')}}"></script>
    <script >
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <!--===============================================================================================-->
    <script src="{{url('assets/login/js/main.js')}}"></script>

</body>
</html>