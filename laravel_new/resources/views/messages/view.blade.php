@extends('layouts.master')
<!--
@section('css', elixir('css/login.css')) -->

@section('content')


<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-offset-2">
      <br>
      <!-- {{$user}} -->


    @if ($data['type'] == "image")

      <img src="{!! $data['content'] !!}">

      @elseif ($data['type'] == "video")
          {!! $data['code'] !!}

      @endif

      </div>
    </div>
  </div>

  @endsection
