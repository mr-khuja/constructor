@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Изменение слайда</h4>
                    <ul class="nav nav-tabs mb-3">
                        @foreach(\Config::get('app.locales') as $lang)
                            <li class="nav-item">
                                <a href="/admin/slider/edit/{{$id}}/{{$lang}}"
                                   class="nav-link @if($lang == $l) active @endif">
                                    <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                                    <span class="d-none d-lg-block">{{\Config::get('app.locales_text')[$lang]}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <form class="form-material mt-4" method="post" enctype="multipart/form-data"
                          action="/admin/slider/edit/{{$id}}/{{$l}}">
                        @csrf
                        <div class="form-group">
                            <label for="title">Название</label>
                            <input type="text" id="title" name="title" value="{{$data->title}}"
                                   class="form-control form-control-line">
                        </div>
                        <div class="form-group">
                            <label for="subtitle">Подзаголовок</label>
                            <input type="text" id="subtitle" name="subtitle" value="{{$data->subtitle}}"
                                   class="form-control form-control-line">
                        </div>
                        <div class="form-group">
                            <label>Изображение</label>

                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="image" data-input="image-th" data-preview="image_holder"
                                       class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Выбрать файл
                                    </a>
                                </span>
                                <input id="image-th" class="form-control" type="text" name="image">
                            </div>
                            <div id="image_holder" style="margin-top:15px;max-height:100px;">
                                <img alt="" src="{{$data->image}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="path">Ссылка</label>
                            <input type="text" id="path" name="path" value="{{$data->path}}"
                                   class="form-control form-control-line">
                        </div>
                        <div class="form-group">
                            <label for="order">Очередь</label>
                            <input type="number" id="order" name="order" value="{{$data->order}}"
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
@push('js')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

    <script>
        $('#image').filemanager('image');

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var id = '#' + input.id + '_id';
                reader.onload = function (e) {
                    $(id).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image").change(function () {
            readURL(this);
        });
    </script>
@endpush
