<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" dir="{{ __('voyager::generic.is_rtl') == 'true' ? 'rtl' : 'ltr' }}">
<head>
    <title>@yield('page_title', setting('admin.title') . " - " . setting('admin.description'))</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="baseurl" content="{{ url('/') }}"/>
    <meta name="assets-path" content="{{ route('voyager.voyager_assets') }}"/>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,900&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <?php $admin_favicon = Voyager::setting('admin.icon_image', ''); ?>
    @if($admin_favicon == '')
        <link rel="shortcut icon" href="{{ voyager_asset('images/logo-icon.png') }}" type="image/png">
    @else
        <link rel="shortcut icon" href="{{ Voyager::image($admin_favicon) }}" type="image/png">
    @endif



    <!-- App CSS -->
    <!-- <link rel="stylesheet" href="{{ voyager_asset('css/app.css') }}"> -->
    <link rel="stylesheet" href="{{ voyager_asset('css/bootstrap.min.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ voyager_asset('css/style.css') }}">
    <style type="text/css">
        #voyager-loader {
            background: #f9f9f9;
            position: fixed;
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
            z-index: 99;
        }
        #voyager-loader img {
            width: 100px;
            height: 100px;
            position: absolute;
            top: 50%;
            left: 50%;
            margin-left: -50px;
            margin-right: -50px;
            -webkit-animation: spin 1s linear infinite;
            animation: spin 1s linear infinite;
        }
    </style>
    @yield('css')
    @yield('head')
</head>

<body class="voyager @if(isset($dataType) && isset($dataType->slug)){{ $dataType->slug }}@endif" style="background-image:url({{ Voyager::image( Voyager::setting('admin.bg_image'), voyager_asset('images/bg.jpg') ) }});background-size:cover;font-family: 'Roboto', sans-serif;background-attachment:fixed;">

<div id="voyager-loader">
    <?php $admin_loader_img = Voyager::setting('admin.loader', ''); ?>
    @if($admin_loader_img == '')
        <img src="{{ voyager_asset('images/logo-icon.png') }}" alt="Loader..">
    @else
        <img src="{{ Voyager::image($admin_loader_img) }}" alt="Loader..">
    @endif
</div>

<?php
if (\Illuminate\Support\Str::startsWith(Auth::user()->avatar, 'http://') || \Illuminate\Support\Str::startsWith(Auth::user()->avatar, 'https://')) {
    $user_avatar = Auth::user()->avatar;
} else {
    $user_avatar = Voyager::image(Auth::user()->avatar);
}
?>
<div class="container">
  <form action="{{url('admin/logout')}}" method="POST" id="logout_id">
     @csrf
 </form>
    <div class="black_bg">
        <div class="top_header plr_50">
           <img src="{{voyager_asset('images/logo.png')}}" class="logo">
           <label class="white">{{auth()->user()->name}}
            <img src="{{voyager_asset('images/close.png')}}" class="close_img" onclick="jQuery('#logout_id').submit();">
           </label>
       </div>
       <div class="black_bg_inner plr_40">
           @include('voyager::dashboard.header')
           @yield('page_header')
           @yield('content')
           @include('voyager::partials.app-footer')
       </div>
    </div>
</div>


<!-- Javascript Libs -->


<script type="text/javascript" src="{{ voyager_asset('js/app.js') }}"></script>

<script>
    @if(Session::has('alerts'))
        let alerts = {!! json_encode(Session::get('alerts')) !!};
        helpers.displayAlerts(alerts, toastr);
    @endif

    @if(Session::has('message'))

    // TODO: change Controllers to use AlertsMessages trait... then remove this
    var alertType = {!! json_encode(Session::get('alert-type', 'info')) !!};
    var alertMessage = {!! json_encode(Session::get('message')) !!};
    var alerter = toastr[alertType];

    if (alerter) {
        alerter(alertMessage);
    } else {
        toastr.error("toastr alert-type " + alertType + " is unknown");
    }
    @endif
</script>
@include('voyager::media.manager')

@stack('javascript')
@if(!empty(config('voyager.additional_js')))<!-- Additional Javascript -->
    @foreach(config('voyager.additional_js') as $js)<script type="text/javascript" src="{{ asset($js) }}"></script>@endforeach
@endif
@include('voyager::modals')
<script src="/js/moment.js"></script>
<script src="/js/axios.js"></script>
<script src="/js/helpers.js"></script>
<script src="/js/config.js"></script>
@yield('javascript')
</body>
</html>
