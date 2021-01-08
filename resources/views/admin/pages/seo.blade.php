@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Настройки SEO</h4>
                    <ul class="nav nav-tabs mb-3">
                        @foreach(\Config::get('app.locales') as $lang)
                            <li class="nav-item">
                                <a href="/admin/seo/{{$lang}}"
                                   class="nav-link @if($lang == $l) active @endif">
                                    <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                                    <span class="d-none d-lg-block">{{\Config::get('app.locales_text')[$lang]}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <form class="form-material mt-4" method="post" enctype="multipart/form-data"
                          action="/admin/seo/edit/{{$l}}">
                        @csrf
                        <div class="form-group">
                            <label for="title">Название</label>
                            <input type="text" value="{{$data->title}}" id="title" name="title"
                                   class="form-control form-control-line">
                        </div>
                        <div class="form-group">
                            <label for="description">Описание</label>
                            <textarea rows="3" id="description" name="description"
                                      class="form-control form-control-line">{{$data->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="keywords">Ключевые слова</label>
                            <textarea rows="3" id="keywords" name="keywords"
                                      class="form-control form-control-line">{{$data->keywords}}</textarea>
                        </div>
                        <div class="btn-list">
                            <button type="submit" class="btn waves-effect waves-light btn-success">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Контакты сайта</h4>
                    <form class="form-material mt-4" method="post" enctype="multipart/form-data"
                          action="/admin/social/edit">
                        @csrf
                        <div class="form-group">
                            <label for="facebook">Facebook</label>
                            <input type="text" value="{{$socs->facebook}}" id="facebook" name="facebook"
                                   class="form-control form-control-line">
                        </div>
                        <div class="form-group">
                            <label for="telegram">Telegram</label>
                            <input type="text" value="{{$socs->telegram}}" id="telegram" name="telegram"
                                   class="form-control form-control-line">
                        </div>
                        <div class="form-group">
                            <label for="youtube">Youtube</label>
                            <input type="text" value="{{$socs->youtube}}" id="youtube" name="youtube"
                                   class="form-control form-control-line">
                        </div>
                        <div class="form-group">
                            <label for="instagram">Instagram</label>
                            <input type="text" value="{{$socs->instagram}}" id="instagram" name="instagram"
                                   class="form-control form-control-line">
                        </div>
                        <div class="form-group">
                            <label for="twitter">Twitter</label>
                            <input type="text" value="{{$socs->twitter}}" id="twitter" name="twitter"
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
        $(".international-inputmask").inputmask("+999 (99) 999-99-99");
        $('#logo').filemanager('image');
        $('#logo_light').filemanager('image');
        $('#favicon').filemanager('image');

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

        $("#favicon").change(function () {
            readURL(this);
        });
        $("#logo").change(function () {
            readURL(this);
        });
        $("#logo_light").change(function () {
            readURL(this);
        });
    </script>
@endpush
