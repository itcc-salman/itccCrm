<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="{{ asset('assets/dist/img/ico/favicon.png') }}" type="image/x-icon">
        <!-- Bootstrap -->
        <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
        <!-- Pe-icon-7-stroke -->
        <link href="{{ asset('assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css') }}" rel="stylesheet" />
        <!-- style css -->
        <link href="{{ asset('assets/dist/css/stylecrm.css') }}" rel="stylesheet" />

    </head>
    <body>
        <!-- Content Wrapper -->
        <div class="login-wrapper">
            <div class="container-center">
            <div class="login-area">
                <div class="card panel-custom">
                    <div class="card-heading custom_head">
                        <div class="view-header">
                            <div class="header-icon">
                                <i class="pe-7s-unlock"></i>
                            </div>
                            <div class="header-title">
                                <h3>Login</h3>
                                <small><strong>Please enter your credentials to login.</strong></small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}" id="loginForm" aria-label="{{ __('Login') }}">
                            @csrf
                            <div class="form-group">
                                <label class="control-label" for="email">{{ __('E-Mail Address') }}</label>
                                <input type="text" placeholder="example@gmail.com" title="Please enter you email" required="" value="{{ old('email') }}" name="email" id="email" class="form-control">
                                <span class="help-block small">Your unique username to app</span><br>
                                @if($errors->has('email'))
                                  @foreach($errors->get('email') as $message)
                                    <span class="help-block small text-danger" for="email">{{$message}}</span><br>
                                  @endforeach
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" title="Please enter your password" placeholder="******" required="" value="" name="password" id="password" class="form-control">
                                <span class="help-block small">Your strong password</span><br>
                                @if($errors->has('password'))
                                  @foreach($errors->get('password') as $message)
                                    <span class="help-block small text-danger" for="password">{{$message}}</span><br>
                                  @endforeach
                                @endif
                            </div>
                            <div>
                                <button type="submit" class="btn green_btn">Login</button>
                                <a class="btn btn-warning" href="#">Register</a>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->
        <!-- jQuery -->
      <script src="{{ asset('assets/plugins/jQuery/jquery-1.12.4.min.js') }}" ></script>
      <!-- Bootstrap proper -->
      <script src="{{ asset('assets/bootstrap/js/popper.min.js') }}" ></script>
       <!-- Bootstrap -->
       <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}" ></script>
    </body>
</html>
