@extends('layouts.master')

@section('title', trans('auth.login'))
@section('js', elixir('js/login.js'))

@section('content')
<div class="content-container">
<div class="main-content">
<div class="box">
  <!-- Login -->
  <div class="login-form">
    <form action="{{ route('auth::postLogin') }}" method="post">
                      <div class="panel panel-default center-block animated fadeInDown">
                          <div class="panel-body">
                              @if (count($errors))
                                  <div class="alert alert-danger">{{ $errors->first() }}</div>
                              @endif

                              {!! csrf_field() !!}

                              <div class="form-group">
                                  {{-- <label for="email">{{ trans('auth.email') }}</label> --}}
                                  <input type="text" name="email" id="email" class="form-control input-lg" value="{{ old('email') }}" placeholder="{{ trans('auth.email') }}">
                              </div>
                              <div class="form-group">
                                  {{--<label for="password">{{ trans('auth.password') }}</label> --}}
                                  <input type="password" name="password" id="password" class="form-control input-lg" placeholder="{{ trans('auth.password') }}">
                              </div>
                              <div class="checkbox clearfix">
                                  <label for="remember" class="pull-left">
                                      <input type="checkbox" name="remember" id="remember" value="checked"> {{ trans('auth.remember') }}
                                  </label>
                                  <label class="pull-right"><a href="{{ route('auth::getPasswordEmail') }}" title="{{ trans('auth.forgot_password') }}">{{ trans('auth.forgot_password') }}</a></label>
                              </div>
                              <button type="submit" class="btn btn-primary btn-lg">{{ trans('auth.login') }}</button>
                          </div>
                      </div>
                  </form>

  </div>

  <!-- Register -->

  <div class="register-form">
    <form action="{{ route('auth::postSignup') }}" method="post">
      <div class="panel panel-default signup center-block animated fadeInDown">
          <div class="panel-body">
              @if (count($errors))
                  <div class="alert alert-danger">{{ $errors->first() }}</div>
              @endif

              {!! csrf_field() !!}

              <div class="form-group">
                  <label for="email">Full name</label>
                  <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
              </div>
              <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}">
              </div>
              <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" id="password" class="form-control">
              </div>
              <div class="form-group">
                  <label for="password">Confirm Password</label>
                  <input type="password" name="password_confirmation" id="passwordConfirmation" class="form-control">
              </div>
          </div>
      </div>
      <div class="text-center"><button type="submit" class="btn btn-primary btn-lg">Signup</button></div>
  </form>
  </div>

  <!-- Submit -->

<input type="submit" id="submit" value="Login" style="float:left;">
  <br>
  <!-- Help -->
  <div style="float:left;width: 100%;padding: 10px 0; text-align:center;">
  <a href="register.htm" class="register">Register</a>
  <a href="#" class="forgot-password" title="Forgot password?">Forgot Password?</a>
  </div>
</form>
</div>
  <div class="box right">
         <a class="facebook btn-social-login" href="#">
      <div class="btn-icon fb-icon"></div>
     <i class="fa fa-facebook"></i>  Login with Facebook
    </a>
    <a class="twitter btn-social-login" href="#">
      <div class="twitter-icon btn-icon"></div>
   <i class="fa fa-twitter"></i>   Login with Twitter
    </a>
  </div>
</div>
</div>
@endsection
