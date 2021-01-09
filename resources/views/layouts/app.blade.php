<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="shortcut icon" href="{{$settings->favicon}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$title}} | {{$settings->sitename}}</title>
    <link href="/extra-libs/toastr/dist/build/toastr.min.css" rel="stylesheet">
    <meta name="robots" content="index, follow"/>
    <meta name="keywords" content="{{$keywords}}"/>
    <meta name="description" content="{{$description}}"/>
    @auth
        <link href="/css/admin.css" rel="stylesheet">
    @endauth
    @stack('css')
    {!! RecaptchaV3::initJs() !!}
</head>
<body>
@auth
    @include('blocks.admin')
@endauth
@include('blocks.header')
@yield('content')
@include('blocks.footer')
<script src="/libs/jquery/dist/jquery.min.js"></script>
<script src="/extra-libs/toastr/dist/build/toastr.min.js"></script>
@auth
    <script src="/js/admin.js"></script>
@endauth
@stack('js')
@if(session('message'))
    <script>
        $(function () {
            toastr.success('{{session("message")}}', 'Успех');
        });
    </script>
@endif
@if(session('error'))
    <script>
        $(function () {
            toastr.error('{{session("error")}}', 'Ошибка');
        });
    </script>
@endif
@foreach($errors->all() as $error)
    <script>
        $(function () {
            toastr.error('{{$error}}', 'Ошибка');
        });
    </script>
@endforeach
{!! RecaptchaV3::field('register') !!}
</body>
</html>
