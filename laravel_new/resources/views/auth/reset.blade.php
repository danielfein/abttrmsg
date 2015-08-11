@extends('layouts.master')

@section('css', elixir('css/reset_password.css'))

@section('content')
    <div class="container reset-password">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">                
                <form action="{{ route('auth::postPasswordReset') }}" method="post">
                    <div class="panel panel-default center-block animated fadeInDown">
                        <div class="panel-body">
                            <h1>Reset Password</h1>
                            @if (count($errors))
                                <div class="alert alert-danger">{{ $errors->first() }}</div>
                            @endif
                            
                            {!! csrf_field() !!}
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group">
                                <input type="text" name="email" id="email" class="form-control input-lg" value="{{ old('email') }}" placeholder="{{ trans('auth.email') }}">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" id="password" class="form-control input-lg" placeholder="{{ trans('auth.new_password') }}">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password_confirmation" id="passwordConfirmation" class="form-control input-lg" placeholder="{{ trans('auth.confirm_new_password') }}">
                            </div>                           
                            <button type="submit" class="btn btn-primary btn-lg">Reset Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection