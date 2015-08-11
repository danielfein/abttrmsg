@extends('layouts.master')

@section('css', elixir('css/login.css'))

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="col-lg-8 col-md-offset-2">
                <div class="form-group">
                </div>
            </div>
            <div class="col-md-12">
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        var temp = window.self;
        temp.opener = window.self;
        temp.close();
    });
</script>
@endsection
