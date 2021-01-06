@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Создание категории</h4>
                    <form class="form-material mt-4" method="post" enctype="multipart/form-data"
                          action="/admin/category/create">
                        @csrf
                        <div class="form-group">
                            <label for="title">Название</label>
                            <input type="text"  id="title" name="title" value="{{old('title')}}"
                                   class="form-control form-control-line">
                        </div>
                        <div class="form-group">
                            <label for="path">Ссылка</label>
                            <input type="text"  id="path" name="path" value="{{old('path')}}"
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
