<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$settings->sitename}}</title>
    <link href="/extra-libs/toastr/dist/build/toastr.min.css" rel="stylesheet">
    @stack('css')
</head>
<body>
@include('blocks.header')
@yield('content')
@include('blocks.footer')
<script src="/libs/jquery/dist/jquery.min.js"></script>
<script src="/extra-libs/toastr/dist/build/toastr.min.js"></script>
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
</body>
</html>
