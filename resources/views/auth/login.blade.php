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
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="{{url('assets/login/images/img-01.png')}}" alt="IMG">
                </div>

                <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <span class="login100-form-title">
                        User Login
                    </span>

                    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="email" value="{{ old('email') }}" placeholder="Email">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>

                    </div>

                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif

                    <div class="wrap-input100 validate-input" data-validate = "Password is required">
                        <input class="input100" type="password" name="password" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>

                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                    
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" type="submit">
                            Login
                        </button>
                    </div>

                    <div class="text-center p-t-12">

                    </div>

                    <div class="text-center p-t-136">
                    </div>
                </form>
            </div>
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