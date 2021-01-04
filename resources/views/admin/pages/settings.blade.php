@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Настройки сайта</h4>
                    <form class="form-material mt-4" method="post" enctype="multipart/form-data"
                          action="/admin/settings">
                        @csrf
                        <div class="form-group">
                            <label for="sitename">Название сайта</label>
                            <input type="text" value="{{$data->sitename}}" id="sitename" name="sitename"
                                   class="form-control form-control-line">
                        </div>

                        <div class="form-group">
                            <label>Логотип</label>

                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="logo" data-input="logo-th" data-preview="logo_holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Выбрать файл
                                    </a>
                                </span>
                                <input id="logo-th" class="form-control" type="text" name="logo">
                            </div>
                            <div id="logo_holder" style="margin-top:15px;max-height:100px;">
                                <img src="{{$data->logo}}" alt="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Логотип (белый)</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="logo_light" data-input="logo_light-th" data-preview="logo_light_holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Выбрать файл
                                    </a>
                                </span>
                                <input id="logo_light-th" class="form-control" type="text" name="logo_light">
                            </div>
                            <div id="logo_light_holder" style="margin-top:15px;max-height:100px;">
                                <img src="{{$data->logo_light}}" alt="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Иконка</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="favicon" data-input="favicon-th" data-preview="favicon_holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Выбрать файл
                                    </a>
                                </span>
                                <input id="favicon-th" class="form-control" type="text" name="favicon">
                            </div>
                            <div id="favicon_holder" style="margin-top:15px;max-height:100px;">
                                <img src="{{$data->favicon}}" alt="">
                            </div>
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
                          action="/admin/contact">
                        @csrf
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" value="{{$data->email}}" id="email" name="email"
                                   class="form-control form-control-line">
                        </div>
                        <div class="form-group">
                            <label for="phone">Номер телефона <small class="text-muted">+998 (71)
                                    123-45-67</small></label>
                            <input name="phone" id="phone" value="{{$data->phone}}" type="text"
                                   class="form-control international-inputmask"
                                   id="international-mask">
                        </div>
                        <div class="form-group">
                            <label for="mobile">Номер телефона 2 <small class="text-muted">+998 (71)
                                    123-45-67</small></label>
                            <input name="mobile" id="mobile" value="{{$data->mobile}}" type="text"
                                   class="form-control international-inputmask"
                                   id="international-mask">
                        </div>
                        <div class="form-group">
                            <label for="address">Адрес</label>
                            <textarea name="address" id="address" class="form-control"
                                      rows="5">{{$data->address}}</textarea>
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
