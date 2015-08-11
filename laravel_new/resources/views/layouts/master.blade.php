<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags --}}
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="../../favicon.ico">

    <title>ABM</title>
    <link href="/css/foda.css" rel="stylesheet">
    <style>
        .facebook-block, .twitter-block {
            max-height: 300px;
            overflow-y: auto;
        }

        .margin-bottom {
            margin-bottom: 10px;
        }

        .label-list {
            width: 100%;
            cursor: pointer;
        }

        .label-list:hover {
            background-color: rgb(238, 238, 238);
        }

    </style>

    <script src="{{ config('app.url') }}/js/jquery.min.js" type="text/javascript"></script>
    <script src="{{ config('app.url') }}/js/script.js" type="text/javascript"></script>
    <script src="/js/foda.js" type="text/javascript"></script>


    <link rel='stylesheet prefetch'
          href='http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css'>
    <link rel='stylesheet prefetch' href='http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
    <link rel='stylesheet prefetch' href='http://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<!--start header -->
@include('partials.header')
        <!--end header -->

<!--start content -->
@yield('content')
        <!--end content -->

<!--start footer -->
@yield('footer')
        <!--end footer -->

</body>
</html>
