@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Создание услуги</h4>
                    <form class="form-material mt-4" method="post" enctype="multipart/form-data"
                          action="/admin/service/create">
                        @csrf
                        <div class="form-group">
                            <label for="title">Название</label>
                            <input type="text" id="title" name="title" value="{{old('title')}}"
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
                                <img alt="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="short">Краткое описание</label>
                            <textarea rows="3" id="short" name="short"
                                      class="form-control form-control-line">{{old('short')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="body">Полное описание</label>
                            <textarea rows="3" id="body" name="body"
                                      class="form-control form-control-line">{!! old('body') !!}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="created_at">Дата создания</label>
                                <input id="created_at" name="created_at" type="datetime-local" class="form-control"
                                       value="{{date('Y-m-d').'T'.date('H:i')}}:00">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="updated_at">Дата изменения</label>
                                <input id="updated_at" name="updated_at" type="datetime-local" class="form-control"
                                       value="{{date('Y-m-d').'T'.date('H:i')}}:00">
                            </div>
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
        var options = {
            removePlugins: 'easyimage, cloudservices',
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{ csrf_token() }}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{ csrf_token() }}'
        };
        CKEDITOR.replace('body', options);
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
