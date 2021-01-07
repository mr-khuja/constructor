<!DOCTYPE html>
<html dir="ltr" lang="ru">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @php($array = explode('/', request()->path()))
        @if(count($array) > 1)
            {{isset(\Config::get('sidebar.menu')[$array[1]]['title']) ? \Config::get('sidebar.menu')[$array[1]]['title'] : \Config::get('sidebar.routes')[$array[1]]}}
        @else
            Главная
        @endif
        | Панель управления | {{$settings->sitename}}
    </title>
    <link type="image/png" sizes="16x16" rel="shortcut icon" href="{{$settings->favicon}}">
    <link rel="canonical" href="https://www.wrappixel.com/templates/xtremeadmin/"/>
    <link href="/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="/js/pages/chartist/chartist-init.css" rel="stylesheet">
    <link href="/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <link href="/libs/c3/c3.min.css" rel="stylesheet">
    <link href="/css/style.min.css" rel="stylesheet">
    <link href="/extra-libs/toastr/dist/build/toastr.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="/js/html5shiv.min.js"></script>
    <script src="/js/respond.min.js"></script>
    <![endif]-->
    @stack('css')
</head>

<body>
<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<div id="main-wrapper">
    @include('admin.blocks.header')
    @include('admin.blocks.sidebar')
    <div class="page-wrapper">
        <div class="row mb-0 page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <ol class="breadcrumb mb-0 p-0 bg-transparent">
                    <li class="breadcrumb-item"><a href="/admin">Главная</a></li>
                    @php($array = explode('/', request()->path()))
                    @if(count($array) == 2)
                        <li class="breadcrumb-item active">{{isset(\Config::get('sidebar.menu')[$array[1]]['title']) ? \Config::get('sidebar.menu')[$array[1]]['title'] : \Config::get('sidebar.routes')[$array[1]]}}</li>
                    @elseif(count($array) > 2)
                        <li class="breadcrumb-item">
                            <a href="/admin/{{$array[1]}}">{{\Config::get('sidebar.menu')[$array[1]]['title']}}</a>
                        </li>
                        @if($array[2] == 'edit')

                            <li class="breadcrumb-item active">Изменение</li>
                        @elseif($array[2] == 'logs')

                            <li class="breadcrumb-item active">Логи</li>
                        @else

                            <li class="breadcrumb-item active">Создание</li>
                        @endif
                    @endif
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>

</div>

<script src="/libs/jquery/dist/jquery.min.js"></script>
<script src="/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/js/app.min.js"></script>
<script src="/js/app.init.dark.js"></script>
<script src="/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="/js/waves.js"></script>
<script src="/js/sidebarmenu.js"></script>
<script src="/js/custom.js"></script>
<script src="/libs/d3/dist/d3.min.js"></script>
<script src="/libs/c3/c3.min.js"></script>
<script src="/js/pages/forms/jasny-bootstrap.js"></script>
<script src="/extra-libs/toastr/dist/build/toastr.min.js"></script>
<script src="/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<script src="/libs/inputmask/dist/inputmask/jquery.inputmask.js"></script>
<script src="/libs/inputmask/dist/inputmask/inputmask.extensions.js"></script>
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
