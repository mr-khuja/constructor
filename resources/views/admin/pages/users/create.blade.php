@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Создание пользователя</h4>
                    <form class="form-material mt-4" method="post" enctype="multipart/form-data"
                          action="/admin/users/create">
                        @csrf
                        <div class="form-group">
                            <label for="name">Имя</label>
                            <input type="text" id="name" name="name"
                                   class="form-control form-control-line">
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" id="email" name="email"
                                   class="form-control form-control-line">
                        </div>
                        <div class="form-group">
                            <label>Изображение</label>
                            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                <div class="form-control" data-trigger="fileinput">
                                    <i class="fa fa-file fileinput-exists"></i>
                                    <span class="fileinput-filename"></span>
                                </div>
                                <span class="input-group-addon btn btn-secondary btn-file">
                                            <span class="fileinput-new">Выбрать файл</span>
                                            <span class="fileinput-exists">Изменить</span>
                                            <input type="hidden"><input type="file" id="logo" name="image">
                                        </span>
                                <a href="#" class="input-group-addon btn btn-secondary fileinput-exists"
                                   data-dismiss="fileinput">Удалить</a>
                            </div>
                            <img id="logo_id" class="mt-3 img-fluid w-25" alt="Изображение">
                        </div>
                        <div class="form-group">
                            <label for="role">Роль</label>
                            <select name="role" id="role" class="form-control form-control-line">
                                <option value="0">Гость</option>
                                <option value="1">Модератор</option>
                                <option value="2">Админ</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Новый пароль</label>
                            <input type="password" id="password" name="password"
                                   class="form-control form-control-line">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Подтвердите пароль</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
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
    <script>

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

        $("#logo").change(function () {
            readURL(this);
        });
    </script>
@endpush
