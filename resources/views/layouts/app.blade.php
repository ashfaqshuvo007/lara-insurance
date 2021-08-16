<!doctype html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{URL::asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/AdminLTE.min.css')}}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/responsive.css')}}">
    </head>
    
        @yield('content')
    
        <script src="{{URL::asset('bower_components/jquery/dist/jquery.min.js')}}"></script>

        <script src="{{URL::asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

        <script src="{{URL::asset('js/pages/dashboard2.js')}}"></script>
        <script src="{{ asset('js/app.js') }}"></script>

        {!! Toastr::message() !!}
</html>
