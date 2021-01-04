@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card">
                <div class="card-body">
                    <center class="mt-4"><img src="{{auth()->user()->image}}" class="rounded-circle" width="150">
                        <h4 class="card-title mt-2">{{auth()->user()->name}}</h4>
                        <h6 class="card-subtitle">{{auth()->user()->role()}}</h6>
                        <a href="/admin/profile/edit"
                           class="btn btn-rounded btn-danger btn-sm text-white d-inline-block">Изменить профиль</a>
                    </center>
                </div>
                <div>
                    <hr>
                </div>
                <div class="card-body">
                    <small class="text-muted">Email</small>
                    <h6>{{auth()->user()->email}}</h6>
                    <small class="text-muted">Зарегистрирован</small>
                    <h6>{{date('d.m.Y H:i', strtotime(auth()->user()->created_at))}}</h6>
                    <small class="text-muted">Изменен</small>
                    <h6>{{date('d.m.Y H:i', strtotime(auth()->user()->updated_at))}}</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Логи</h4>
                    <div class="profiletimeline mt-2">
                        <div class="sl-item">
                            <div class="sl-left">
                                <img src="../assets/images/users/1.jpg" alt="user"
                                                      class="rounded-circle">
                            </div>
                            <div class="sl-right">
                                <div>
                                    <a href="javascript:void(0)" class="link">John Doe</a>
                                    <span class="sl-date">5 minutes ago</span>
                                    <p>assign a new task <a href="javascript:void(0)"> Design weblayout</a></p>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
