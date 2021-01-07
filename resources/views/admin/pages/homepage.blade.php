@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Изменение новости</h4>
                    <ul class="nav nav-tabs mb-3">
                        @foreach(\Config::get('app.locales') as $lang)
                            <li class="nav-item">
                                <a href="/admin/homepage/edit/{{$lang}}"
                                   class="nav-link @if($lang == $l) active @endif">
                                    <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                                    <span class="d-none d-lg-block">{{\Config::get('app.locales_text')[$lang]}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <form class="form-material mt-4" method="post" enctype="multipart/form-data"
                          action="/admin/homepage/edit/{{$l}}">
                        @csrf
                        <div class="form-group">
                            <label for="about_title">Название описании "О нас"</label>
                            <input type="text" id="about_title" name="about_title" value="{{$data->about_title}}"
                                   class="form-control form-control-line">
                        </div>
                        <div class="form-group">
                            <label for="about_text">Краткое описание "О нас"</label>
                            <textarea rows="3" id="about_text" name="about_text"
                                      class="form-control form-control-line">{{$data->about_text}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Изображение "О нас"</label>

                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="image" data-input="image-th" data-preview="image_holder"
                                       class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Выбрать файл
                                    </a>
                                </span>
                                <input id="image-th" class="form-control" type="text" name="about_image">
                            </div>
                            <div id="image_holder" style="margin-top:15px;max-height:100px;">
                                <img alt="" src="{{$data->about_image}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="figures_title">Название описании цыфр</label>
                            <input type="text" id="figures_title" name="figures_title" value="{{$data->figures_title}}"
                                   class="form-control form-control-line">
                        </div>
                        <div class="form-group">
                            <label for="figures_text">Краткое описание цыфр</label>
                            <textarea rows="3" id="figures_text" name="figures_text"
                                      class="form-control form-control-line">{{$data->figures_text}}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="figures_title_first">Название цыфры 1</label>
                                    <input type="text" id="figures_title_first" name="figures_title_first"
                                           value="{{$data->figures_title_first}}"
                                           class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="figures_value_first">Значение цыфры 1</label>
                                    <input type="text" id="figures_value_first" name="figures_value_first"
                                           value="{{$data->figures_value_first}}"
                                           class="form-control form-control-line">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="figures_title_second">Название цыфры 2</label>
                                    <input type="text" id="figures_title_second" name="figures_title_second"
                                           value="{{$data->figures_title_second}}"
                                           class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="figures_value_second">Значение цыфры 2</label>
                                    <input type="text" id="figures_value_second" name="figures_value_second"
                                           value="{{$data->figures_value_second}}"
                                           class="form-control form-control-line">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="figures_title_third">Название цыфры 3</label>
                                    <input type="text" id="figures_title_third" name="figures_title_third"
                                           value="{{$data->figures_title_third}}"
                                           class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="figures_value_third">Значение цыфры 3</label>
                                    <input type="text" id="figures_value_third" name="figures_value_third"
                                           value="{{$data->figures_value_third}}"
                                           class="form-control form-control-line">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="figures_title_fourth">Название цыфры 4</label>
                                    <input type="text" id="figures_title_fourth" name="figures_title_fourth"
                                           value="{{$data->figures_title_fourth}}"
                                           class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="figures_value_fourth">Значение цыфры 4</label>
                                    <input type="text" id="figures_value_fourth" name="figures_value_fourth"
                                           value="{{$data->figures_value_fourth}}"
                                           class="form-control form-control-line">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="footer">Текст на футере</label>
                            <textarea rows="3" id="footer" name="footer"
                                      class="form-control form-control-line">{{$data->footer}}</textarea>
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
    <script src="/js/ckeditor/ckeditor.js"></script>

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
