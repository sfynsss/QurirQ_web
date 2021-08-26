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
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">{{ __('Reset Password') }}</div>

            <div class="card-body">
              <form method="POST" action="{{url('auth/gantiPassword')}}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group row">
                  <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                  <div class="col-md-6">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>

                <div class="form-group row">
                  <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                  <div class="col-md-6">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                    @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>

                <div class="form-group row">
                  <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                  <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                  </div>
                </div>

                <div class="form-group row mb-0">
                  <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                      {{ __('Reset Password') }}
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
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