<!DOCTYPE html>
<html>
<head>
    <title>{{$contact_data->name_site}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="content-language" content="fa" />
    <meta name="document-type" content="Public" />
    <meta name="document-rating" content="General" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Ofoghata" />

    <link href="{{url('image/page/contacts/'.$contact_data->logo)}}" rel="shortcut icon" type="image/png">
    <link href="{{url('image/page/contacts/'.$contact_data->logo)}}" rel="apple-touch-icon" sizes="57x57">
    <link href="{{url('image/page/contacts/'.$contact_data->logo)}}" rel="apple-touch-icon" sizes="72x72">
    <link href="{{url('image/page/contacts/'.$contact_data->logo)}}" rel="apple-touch-icon" sizes="114x114">
    <link href="{{url('image/page/contacts/'.$contact_data->logo)}}" rel="apple-touch-icon" sizes="144x144">

    <link href="{{url('user/Css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{url('user/Css/bootstrap-rtl.min.css')}}" rel="stylesheet" />
    <link href="{{url('user/Css/animate.css')}}" rel="stylesheet" />
    <link href="{{url('user/Css/Style.css')}}" rel="stylesheet" />
    <link href="{{url('user/Css/owl-carousel/owl.carousel.min.css')}}" rel="stylesheet" />
    <link href="{{url('user/Css/sina-nav.min.css')}}" rel="stylesheet" />
    <script src="{{url('user/Js/jquery-2.0.0.min.js')}}"></script>
    <script src="{{url('user/Js/bootstrap.min.js')}}"></script>

    <script src="{{url('user/Js/owl.carousel.js')}}"></script>
    <script src="{{url('user/Js/custom.js')}}"></script>
    <script src="{{url('user/Js/sina-nav.min.js')}}"></script>
    <script src="{{ url('user/Js/users.js') }}" type="text/javascript"></script>
{{--    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" rel="stylesheet" />--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"></script>--}}
    <link rel="stylesheet" href="<?=url('user/Fonts/font-awesome-4.3.0/css/font-awesome.min.css')?>"/>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield('css')
    @yield('js')
    @yield('productFilter')

</head>
<body id="home">

@include('layouts.user.header')
@yield('content')
@include('layouts.user.footer')


@stack('js-section')
</body>
</html>
