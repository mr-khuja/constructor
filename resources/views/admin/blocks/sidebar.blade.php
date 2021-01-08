<aside class="left-sidebar">
    <div class="scroll-sidebar">
        <div class="user-profile position-relative"
             style="background: url(/images/background/user-info.jpg) no-repeat;">
            <div class="profile-img"><img src="{{auth()->user()->image}}" alt="user" class="rounded-circle w-100"/>
            </div>
            <div class="profile-text pt-1">
                <a href="#" class="dropdown-toggle u-dropdown w-100 text-white d-block position-relative"
                   data-toggle="dropdown" role="button" aria-haspopup="true"
                   aria-expanded="true">{{auth()->user()->name}}</a>
                <div class="dropdown-menu animated flipInY">
                    <a class="dropdown-item" href="/admin/profile">
                        <i class="ti-user"></i> Мой профиль
                    </a>
                    <a class="dropdown-item" href="/admin/profile/edit">
                        <i class="ti-settings"></i> Настройки профиля
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/admin/logout">
                        <i class="fa fa-power-off"></i> Выйти
                    </a>
                </div>
            </div>
        </div>
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">Навигация</span>
                </li>
                @foreach(\Config::get('sidebar.menu') as $key => $item)
                    @if($item['visible'])
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/admin/{{$key}}"
                               aria-expanded="false">
                                <i class="mdi {{$item['icon']}}"></i>
                                <span class="hide-menu">
                                    {{$item['title']}}
                                </span>
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>
    </div>
    <div class="sidebar-footer">
        <a href="/admin/settings" class="link" data-toggle="tooltip" title="Настройки"><i class="ti-settings"></i></a>
        <a href="/admin/seo/ru" class="link" data-toggle="tooltip" title="SEO и Соц. сети"><i
                class=" fas fa-globe"></i></a>
        <a href="/admin/logout" class="link" data-toggle="tooltip" title="Выйти"><i class="mdi mdi-power"></i></a>
    </div>
</aside>
