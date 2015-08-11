@extends('layouts.master')

@section('css', elixir('css/login.css'))

@section('content')
<!--start inner content -->
<link href="http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-placeholder/2.1.2/jquery.placeholder.js"></script>
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
      @if(session('twitter'))
          <script type="text/javascript">
              $(document).ready(function () {
               listFollowers();
              });
          </script>
          <div id="twitter_friend"></div>
      @else
              {!! Form::button('Login with Twitter', ['class' => 'btn btn-primary btn-lg', 'id' => 'twitter_login']) !!}
      @endif
  @if(session('facebook'))
    <div id="facebook_friend"></div>
    @else
  <fb:login-button scope="public_profile,email,user_friends,read_custom_friendlists,publish_actions" onlogin="checkLoginState();" class='facebook_login_button'>
  </fb:login-button>
@endif
@if(session('twitter'))
<script type="text/javascript">
    $(document).ready(function () {
     listFollowers();
    });
</script>
@else
        {!! Form::button('Login with Twitter', ['class' => 'btn btn-primary btn-lg', 'id' => 'twitter_login']) !!}
@endif
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

{!! Form::close() !!}
</div>
@endif
        <!--end inner content -->
@stop

@section('footer')
        <!--start inner footer -->
<script>
    function statusChangeCallback(response) {
//    console.log('statusChangeCallback');
//    console.log(response);
        if (response.status === 'connected') {
            callAPI();
        }
        else
        {
            $(".fb_iframe_widget").removeClass('hide');
        }
    }
    function checkLoginState() {
        FB.getLoginStatus(function (response) {
            statusChangeCallback(response);
        });
    }
    window.fbAsyncInit = function () {
        FB.init({
            appId: '817593601681084',
            cookie: true,
            xfbml: true,
            version: 'v2.2'
        });
        FB.getLoginStatus(function (response) {
            statusChangeCallback(response);
        });
    };
// Load the SDK asynchronously
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    function callAPI() {
        $(".fb_iframe_widget").addClass('hide');
        FB.api('/me', {fields: 'id'}, function (response) {
            if (response.id)
            {
                var url = base + "/fb/updata";
                $.post(url, {id: response.id}, function (result) {
                    console.log(result)
                });
            }
        });
        FB.api("/me/taggable_friends?limit=25", function (response) {
            if (response && !response.error) {
                //document.getElementById('facebook_friend').innerHTML = JSON.stringify(response);
                console.log(response);
                listFriends(response);
                $(".fb_iframe_widget").addClass('hide');
            }
        });
    }
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        console.log("{!! Session::get('social') !!}");
        console.log('{!! Auth::user() !!}');
        setBase('{{config("app.url")}}');
    });
</script>
<!--start inner footer -->
@stop
