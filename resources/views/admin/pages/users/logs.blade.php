@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-xlg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Логи</h4>
                    <div class="profiletimeline mt-2">
                        @php($actions = ['visit' => 'Просмотр','logs' => 'Логи','create' => 'Создание','edit' => 'Изменение','delete' => 'Удаление',])
                        @foreach($data as $log)
                            <div class="sl-item">
                                <div class="sl-left">
                                    <img src="{{$user->image}}" alt="user"
                                         class="rounded-circle">
                                </div>
                                <div class="sl-right">
                                    <div>
                                        <a href="/admin/users/edit/{{$user->id}}" class="link">{{$user->name}}</a>
                                        <span class="sl-date">{{$log->created_at->diffForHumans()}}</span>
                                        <p>{{$actions[$log->action]}} <a
                                                href="/admin/{{$log->url}}"> {{\Config::get('sidebar.menu')[$log->url]['title']}}</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                        {{$data->links('vendor.pagination.default')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
