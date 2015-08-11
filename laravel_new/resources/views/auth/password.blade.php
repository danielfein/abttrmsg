@extends('layouts.master')

@section('css', elixir('css/reset_password.css'))

@section('content')
    <div class="container reset-password">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default center-block animated fadeInDown">
                    <div class="panel-body">
                        <h3>We'll help you remember your password</h3>
                        @if (count($errors))
                            <div class="alert alert-danger">{{ $errors->first() }}</div>
                        @endif
                        <form action="{{ route('auth::postPasswordEmail') }}" method="post">
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <input type="text" name="email" id="email" class="form-control input-lg" value="{{ old('email') }}" placeholder="Email">
                            </div>                            
                            <button type="submit" class="btn btn-primary btn-lg">Retrieve Password</button>
                        </form>                        
                    </div>
                </div>                
            </div>        
        </div>
    </div>
@endsection