@extends('layouts.master')

@section('css', elixir('css/signup.css'))

@section('content')
    <div class="container signup">
      <div class="content-container">
      <div class="main-content">
      <div class="box">
        <!-- Login -->
        <div class="login-form">
          <form action="{{ route('auth::postSignup') }}" method="post">
            <div class="panel panel-default signup center-block animated fadeInDown">
                <div class="panel-body">
                    @if (count($errors))
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @endif

                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label for="email">Full name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}"  placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control"  placeholder="password">
                    </div>
                    <div class="form-group">
                        <label for="password">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="passwordConfirmation" class="form-control"  placeholder="confirm">
                    </div>
                </div>
            </div>
        <button type="submit" id="submit" class="btn btn-primary btn-lg">Register</button>
        </form>
        </div>

    <br>
        <!-- Help -->
        <div style="float:left;width: 100%;padding: 10px 0; text-align:center;">
        <a href="/" class="register">Login</a>
        <a href="#" class="forgot-password" title="Forgot password?">Forgot Password?</a>
        </div>
        </div>
        <div class="box right">
               <a class="facebook btn-social-login" href="{{ route('auth::socialLogin', ['provider' => 'facebook']) }}">
            <div class="btn-icon fb-icon"></div>
           <i class="fa fa-facebook"></i>  Signup with Facebook
          </a>
          <a class="twitter btn-social-login" href="{{ route('auth::socialLogin', ['provider' => 'twitter']) }}">
            <div class="twitter-icon btn-icon"></div>
         <i class="fa fa-twitter"></i>   Signup with Twitter
          </a>
        </div>
      </div>
      </div>
    </div>
@endsection
