@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Изменение категории</h4>
                    <ul class="nav nav-tabs mb-3">
                        @foreach(\Config::get('app.locales') as $lang)
                            <li class="nav-item">
                                <a href="/admin/category/edit/{{$id}}/{{$lang}}"
                                   class="nav-link @if($lang == $l) active @endif">
                                    <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                                    <span class="d-none d-lg-block">{{\Config::get('app.locales_text')[$lang]}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <form class="form-material mt-4" method="post" enctype="multipart/form-data"
                          action="/admin/category/edit/{{$id}}/{{$l}}">
                        @csrf
                        <div class="form-group">
                            <label for="title">Название</label>
                            <input type="text" id="title" name="title" value="{{$data->title}}"
                                   class="form-control form-control-line">
                        </div>
                        <div class="btn-list">
                            <button type="submit" class="btn waves-effect waves-light btn-success">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
