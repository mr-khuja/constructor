@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Изменение отзыва</h4>
                    <form class="form-material mt-4" method="post" enctype="multipart/form-data"
                          action="/admin/feedback/edit/{{$id}}">
                        @csrf
                        <div class="form-group">
                            <label for="title">Ф.И.О.</label>
                            <input type="text" id="title" name="title" value="{{$data->title}}"
                                   class="form-control form-control-line">
                        </div>
                        <div class="form-group">
                            <label for="position">Должность</label>
                            <input type="text" id="position" name="position" value="{{$data->position}}"
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
                                <input id="image-th" value="{{$data->image}}" class="form-control" type="text"
                                       name="image">
                            </div>
                            <div id="image_holder" style="margin-top:15px;max-height:100px;">
                                <img alt="" src="{{$data->image}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comment">Сообщение</label>
                            <textarea id="comment" name="comment"
                                      class="form-control form-control-line">{{$data->comment}}</textarea>
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
