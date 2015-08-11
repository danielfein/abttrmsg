@extends('layouts.master')

@section('css', elixir('css/login.css'))

@section('content')
<style>
.gridster {
  display: block;
  width: 100%;
}
div:not(.gridster) {
  background: gray;
  display: inline-block;
}
</style>
<link href="https://rawgit.com/ducksboard/gridster.js/master/dist/jquery.gridster.min.css" rel="stylesheet" />
<link href="http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="js/gridster.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-placeholder/2.1.2/jquery.placeholder.js"></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery.gridster/0.5.6/jquery.gridster.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.js'></script>
<script type="text/javascript">
$(function (){
    // Click Event
    $('.tabs li').click(function(){

        // Allow for multiple tabs
        var $this = $(this).closest('.tabs')

        // Remove & add .active class
        $this.find('li').removeClass('active');
        $(this).addClass('active');

        // Display the proper content
        var $tab = $(this).index();
        //console.log($tab);
        //$('#type_block1').val($tab);
        console.log("original: " + $("input[name=type_block1]").val());
$("input[name=type_block1]").val($tab);

console.log("after: " + $("input[name=type_block1]").val());
        $('.tbl').css({'display':'none'});
        $this.find('> div')
          .removeClass('visible')
          .eq($tab).addClass('visible')
          .find('.tbl').fadeIn(1000);

    });
});



</script>

@if(Auth::check())
<div class="container">

    <!-- <div class="row">
        @include('errors/errors')
        {{ $data['title']}}
        html: {{ $data['url']}}<br>
        code: {!! $data['code'] !!}<br>
        {!! Form::open(['action' => 'MessagesController@postSend', 'id' => 'mainForm']) !!}
        {!! Form::radio('layout', '0') !!}Layout 1<br>
              {!! Form::radio('layout', '1') !!}Layout2<br>
        <div class="col-md-12">
            <div class="col-lg-8 col-md-offset-2">
                <div class="form-group">
                    {!! Form::textarea('message', '', ['class' => 'form-control input-lg', 'id' => 'message', 'placeholder' => 'Enter your message here', 'size' => '30x5', 'required']) !!}
                </div>
            </div>
            <div class="col-md-12">
                <label>Facebook friends</label>
                <div class="form-group clearfix facebook-block">

                    {!! Form::button('Login with Facebook', ['class' => 'btn btn-primary btn-lg hide', 'id' => 'facebook_login']) !!}
                    <fb:login-button scope="public_profile,email,user_friends,read_custom_friendlists,publish_actions" onlogin="checkLoginState();" class='facebook_login_button'>
                    </fb:login-button>
                    <div id="facebook_friend"></div>
                    {!! Form::button('Post on FB', ['class' => 'btn btn-primary btn-lg hide','id' => 'facebook_post']) !!}
                </div>
                <label>Twitter Followers</label>
                <div class="form-group clearfix twitter-block">
                    {!! Form::button('Login with Twitter', ['class' => 'btn btn-primary btn-lg', 'id' => 'twitter_login']) !!}
                    @if(session('social') == "twitter")
                    <script type="text/javascript">
                        $(document).ready(function () {
                         listFollowers();
                        });
                    </script>
                    @endif
                    <div id="twitter_friend"></div>
                </div>
                <label>Send to email's</label>
                <div class="form-group">
                    {!! Form::hidden('type_block1','1' ) !!}
                    {!! Form::hidden('content_block1','https://www.youtube.com/watch?v=dQw4w9WgXcQ' ) !!}


                    {!! Form::text('emails', '', ['class' => 'form-control input-lg', 'id'=>'emails', 'placeholder' => 'Enter email']) !!}

                    <span class="help-block">Write coma(,) separated email's.</span>
                </div>
                <div class="form-group">
                    {!! Form::submit('Send', ['class' => 'btn btn-primary btn-lg submit_form']) !!}
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div> -->
    <!-- {!! Form::radio('layout', '0') !!}Layout 1<br>
         {!! Form::radio('layout', '1') !!}Layout 2<br> -->
    <!-- {!! Form::textarea('message', '', ['class' => 'form-control input-lg', 'id' => 'message', 'placeholder' => 'Enter your message here', 'size' => '30x5', 'required']) !!} -->
    {!! Form::open(['action' => 'MessagesController@postSend', 'id' => 'mainForm', 'enctype'=> 'multipart/form-data', 'files' => true])  !!}


  <div class="tabs">
    <ul class="menu">
      <li class="active"><span>Video</span></li>
      <li><span>Image</span></li>
      <li><span>Text</span></li>
        <li><span>Audio</span></li>
    </ul>
    <div id="video" class="visible">
      <h3>Tab #1 Header</h3>
           {!! Form::text('content_block1[]') !!}
    </div>
    <div  id="image" >
      <h3>Tab #2 Header</h3>
           {!! Form::file('content_block1_file') !!}
      <p>Curabitur euismod ac erat eu egestas. Integer pellentesque lacus et mi tincidunt, sit amet lacinia dui imperdiet. Nam lacinia iaculis sem, fermentum aliquet ligula aliquet nec. Praesent auctor fermentum neque vel laoreet. Ut mollis ullamcorper odio, non mollis justo sagittis eget.</p>
    </div>
    <div  id="text" >
      <h3>Tab #3 Header</h3>
          {!! Form::text('content_block1[]') !!}
      <p>Suspendisse sed dolor sed metus sagittis ornare vel ut metus. Donec eget ante aliquet, ornare tortor a, mattis ipsum. Maecenas accumsan dictum mi in auctor. Maecenas iaculis luctus diam et consectetur. Praesent lobortis lectus at neque interdum ullamcorper. Nam ullamcorper, risus et gravida eleifend, tortor diam consectetur sem, ut commodo sem quam eget arcu. Aenean consectetur mattis quam vel rutrum.</p>
    </div>
    <div  id="audio" >
      <h3>Tab #3 Header</h3>
          {!! Form::text('content_block1[]') !!}
      <p>Suspendisse sed dolor sed metus sagittis ornare vel ut metus. Donec eget ante aliquet, ornare tortor a, mattis ipsum. Maecenas accumsan dictum mi in auctor. Maecenas iaculis luctus diam et consectetur. Praesent lobortis lectus at neque interdum ullamcorper. Nam ullamcorper, risus et gravida eleifend, tortor diam consectetur sem, ut commodo sem quam eget arcu. Aenean consectetur mattis quam vel rutrum.</p>
    </div>
  </div>




{!! Form::hidden('type_block1','0' ) !!}
{!! Form::submit('Send', ['class' => 'none']) !!}
</div>
@endif
@endsection

@section('footer')
@endsection
