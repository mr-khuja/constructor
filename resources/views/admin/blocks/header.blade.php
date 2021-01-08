<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header">
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                <i class="ti-menu ti-close"></i>
            </a>
            <a class="navbar-brand" href="/admin">
                <b class="logo-icon">
                    <img src="{{$settings->favicon}}" alt="{{$settings->sitename}}" class="dark-logo"/>
                    <img src="{{$settings->favicon}}" alt="{{$settings->sitename}}" class="light-logo"/>
                </b>
                <span class="logo-text">
                    <img src="{{$settings->logo}}" alt="{{$settings->sitename}}" class="dark-logo"/>
                    <img src="{{$settings->logo_light}}" alt="{{$settings->sitename}}" class="light-logo"/>
                </span>
            </a>
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
               data-toggle="collapse" data-target="#navbarSupportedContent"
               aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="ti-more"></i>
            </a>
        </div>
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto float-left">
                <li class="nav-item">
                    <a class="nav-link sidebartoggler d-none d-md-block waves-effect waves-dark"
                       href="javascript:void(0)">
                        <i class="ti-menu"></i>
                    </a>
                </li>
{{--                <li class="nav-item d-none d-md-block search-box">--}}
{{--                    <a class="nav-link d-none d-md-block waves-effect waves-dark" href="javascript:void(0)">--}}
{{--                        <i class="ti-search"></i>--}}
{{--                    </a>--}}
{{--                    <form method="post" action="/admin/search" class="app-search">--}}
{{--                        @csrf--}}
{{--                        <input type="text" class="form-control" placeholder="Поиск">--}}
{{--                        <a class="srh-btn"><i class="ti-close"></i></a>--}}
{{--                    </form>--}}
{{--                </li>--}}
            </ul>
            <ul class="navbar-nav float-right">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <img src="{{auth()->user()->image}}" alt="{{auth()->user()->name}}" width="30"
                             class="profile-pic rounded-circle"/>
                    </a>
                    <div class="dropdown-menu mailbox dropdown-menu-right scale-up">
                        <ul class="dropdown-user list-style-none">
                            <li>
                                <div class="dw-user-box p-3 d-flex">
                                    <div class="u-img">
                                        <img src="{{auth()->user()->image}}" alt="{{auth()->user()->name}}"
                                             class="rounded" width="80">
                                    </div>
                                    <div class="u-text ml-2">
                                        <h4 class="mb-0">{{auth()->user()->name}}</h4>
                                        <p class="text-muted mb-1 font-14">{{auth()->user()->email}}</p>
                                        <a href="/admin/profile"
                                           class="btn btn-rounded btn-danger btn-sm text-white d-inline-block">Посмотреть</a>
                                    </div>
                                </div>
                            </li>
                            <li role="separator" class="dropdown-divider"></li>
                            <li class="user-list">
                                <a class="px-3 py-2" href="/admin/profile">
                                    <i class="ti-user"></i> Мой профиль
                                </a>
                            </li>
                            <li class="user-list">
                                <a class="px-3 py-2" href="/admin/profile/edit">
                                    <i class="ti-settings"></i> Настройки профиля
                                </a>
                            </li>
                            <li role="separator" class="dropdown-divider"></li>
                            <li class="user-list">
                                <a class="px-3 py-2" href="/admin/logout">
                                    <i class="fa fa-power-off"></i> Выйти
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-none d-md-block waves-effect waves-dark" href="/admin/logout">
                        <i class="fa fa-power-off"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
