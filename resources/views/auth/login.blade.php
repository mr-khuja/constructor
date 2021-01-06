<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{$settings->favicon}}">
    <title>Авторизация | {{$settings->sitename}}</title>
    <!-- Custom CSS -->
    <link href="/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="main-wrapper">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Login box.scss -->
    <!-- ============================================================== -->
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center"
         style="background:url(/images/background/login-register.jpg) no-repeat center center; background-size: cover;">
        <div class="auth-box p-4 bg-white rounded">
            <div id="loginform">
                <div class="logo text-center">
                        <span class="db"><img src="{{$settings->favicon}}" alt="logo"/><br/>
                            <img src="{{$settings->logo}}" alt="Home"/></span>
                </div>
                <!-- Form -->
                <div class="row">
                    <div class="col-12">
                        <form class="form-horizontal mt-3 form-material" id="loginform" action="/login" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <div class="col-xs-12">
                                    <input class="form-control" type="text" name="email" required=""
                                           placeholder="E-mail">
                                    @error('email')
                                    <span class="d-block invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="col-xs-12">
                                    <input class="form-control" type="password" name="password" required="" placeholder="Пароль">
                                    @error('password')
                                    <span class="d-block invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="d-flex">
                                    <div class="checkbox checkbox-info float-left pt-0">
                                        <input name="remember" id="checkbox-signup" type="checkbox"
                                               class="material-inputs chk-col-indigo">
                                        <label for="checkbox-signup">Запомнить меня</label>
                                    </div>
                                    <div class="ml-auto">
                                        <a href="javascript:void(0)" id="to-recover" class="text-muted float-right"><i
                                                class="fa fa-lock mr-1"></i> Забыли пароль?</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center mt-3">
                                <div class="col-xs-12">
                                    <button
                                        class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light"
                                        type="submit">Войти
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="recoverform">
                <div class="logo">
                    <h3 class="font-weight-medium mb-3">Восстановление пароля</h3>
                    <span>Введите свой E-mail и дальнейшие инструкции будут высланы туда!</span>
                </div>
                <div class="row mt-3">
                    <!-- Form -->
                    <form class="col-12 form-material" action="{{ route('password.email') }}" method="post">
                    @csrf
                    <!-- email -->
                        <div class="form-group row">
                            <div class="col-12">
                                <input class="form-control" type="email" required="" placeholder="E-mail">
                            </div>
                        </div>
                        <!-- pwd -->
                        <div class="row mt-3">
                            <div class="col-12">
                                <button class="btn btn-block btn-lg btn-primary text-uppercase" type="submit"
                                        name="action">Отправить
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    $('#to-recover').on("click", function () {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
</script>
</body>

</html>
