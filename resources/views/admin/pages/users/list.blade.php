@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-left mt-2">Список пользователей</h4>
                    <a href="/admin/users/create"
                       class="waves-effect waves-light btn btn-primary float-right">Создать</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="default_order" class="table table-striped table-bordered display"
                               style="width:100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Имя</th>
                                <th>E-mail</th>
                                <th>Роль</th>
                                <th>Создано</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->role()}}</td>
                                    <td>{{date('d.m.Y', strtotime($item->created_at))}}</td>
                                    <td>
                                        <a href="/admin/users/edit/{{$item->id}}"
                                           class="btn btn-success waves-effect waves-light">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="/admin/users/logs/{{$item->id}}"
                                           class="btn btn-primary waves-effect waves-light">
                                            <i class="fas fa-history"></i>
                                        </a>
                                        <a href="/admin/users/delete/{{$item->id}}"
                                           class="btn btn-danger waves-effect waves-light">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Имя</th>
                                <th>E-mail</th>
                                <th>Роль</th>
                                <th>Создано</th>
                                <th>Действия</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link href="/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
@endpush
@push('js')
    <script src="/libs/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="/js/pages/datatable/custom-datatable.js"></script>
    <script>
        $('.copytext').on('click', function () {
            var copyText = $(this).data('text');
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(copyText).select();
            document.execCommand("copy");
            $temp.remove();
            $(function () {
                toastr.success('Ссылка скопрована', 'Успех');
            });
        })
        $('#default_order').DataTable({
            "order": [
                [0, "asc"]
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Russian.json"
            }
        });
    </script>
@endpush
