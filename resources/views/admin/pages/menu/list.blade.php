@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-left mt-2">Список меню</h4>
                    <a href="/admin/menu/create"
                       class="waves-effect waves-light btn btn-primary float-right">Создать</a>
                </div>
                <div class="card-body">
                    <div class="myadmin-dd-empty dd" id="nestable2">
                        <ol class="dd-list">
                            @foreach($data as $item)
                                <li class="dd-item dd3-item" data-id="{{$item->id}}">
                                    <div class="dd-handle dd3-handle"></div>
                                    <div class="dd3-content">
                                        {{$item->title}}
                                        <div class="btn-group float-right">
                                            <a href="/admin/menu/edit/{{$item->id}}/ru"
                                               class="badge badge-info waves-effect waves-light"><i
                                                    class="fas fa-edit"></i></a>
                                            <a href="/admin/menu/delete/{{$item->id}}"
                                               class="ml-1 badge badge-danger waves-effect waves-light"><i
                                                    class="fas fa-trash-alt"></i></a>
                                        </div>
                                    </div>
                                    @if(isset($item->children) && count($item->children) > 0)
                                        <ol class="dd-list">
                                            @foreach($item->children as $item2)
                                                <li class="dd-item dd3-item" data-id="{{$item2->id}}">
                                                    <div class="dd-handle dd3-handle"></div>
                                                    <div class="dd3-content">
                                                        {{$item2->title}}
                                                        <div class="btn-group float-right">
                                                            <a href="/admin/menu/edit/{{$item2->id}}/ru"
                                                               class="badge badge-info waves-effect waves-light"><i
                                                                    class="fas fa-edit"></i></a>
                                                            <a href="/admin/menu/delete/{{$item2->id}}"
                                                               class="ml-1 badge badge-danger waves-effect waves-light"><i
                                                                    class="fas fa-trash-alt"></i></a>
                                                        </div>
                                                    </div>
                                                    @if(isset($item2->children) && count($item2->children) > 0)
                                                        <ol class="dd-list">
                                                            @foreach($item2->children as $item3)
                                                                <li class="dd-item dd3-item" data-id="{{$item3->id}}">
                                                                    <div class="dd-handle dd3-handle"></div>
                                                                    <div class="dd3-content">
                                                                        {{$item3->title}}
                                                                        <div class="btn-group float-right">
                                                                            <a href="/admin/menu/edit/{{$item3->id}}/ru"
                                                                               class="badge badge-info waves-effect waves-light"><i
                                                                                    class="fas fa-edit"></i></a>
                                                                            <a href="/admin/menu/delete/{{$item3->id}}"
                                                                               class="ml-1 badge badge-danger waves-effect waves-light"><i
                                                                                    class="fas fa-trash-alt"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ol>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ol>
                                    @endif
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group mb-0 text-right">
                        <button type="button" id="saveit" class="btn btn-info waves-effect waves-light">Сохранить
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')

    <script src="/libs/nestable/jquery.nestable.js"></script>
    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            $('#saveit').on('click', function () {
                var order = $('#nestable2').nestable('serialize');
                $.ajax({
                    type: 'POST',
                    url: '/admin/menu/order',
                    data: {order},
                    success: function () {
                        location.reload();
                    }
                });
            });
            // Nestable
            var updateOutput = function (e) {
                var list = e.length ? e : $(e.target),
                    output = list.data('output');
                if (window.JSON) {
                    output.val(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
                } else {
                    output.val('JSON browser support required for this demo.');
                }
            };

            $('#nestable2').nestable({
                group: 1,
                maxDepth: 3
            }).on('change', updateOutput);

            updateOutput($('#nestable2').data('output', $('#nestable2-output')));
        });
    </script>
@endpush
