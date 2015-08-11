@extends('layouts.master')

@section('css', elixir('css/login.css'))

@section('content')

@if(Auth::check())
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-offset-2">
            <p>Message Send...</p>
            <p><a href="{{url('messages')}}">New Message</a></p>
        </div>
    </div>
</div>
@endif
@endsection
