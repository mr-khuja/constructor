@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-left mt-2">Контактная форма</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="default_order" class="table table-striped table-bordered display"
                               style="width:100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Имя</th>
                                <th>Телефон</th>
                                <th>E-mail</th>
                                <th>Сообщение</th>
                                <th>Создано</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>
                                        <button class="copytext btn btn-primary" data-toggle="modal"
                                                data-target="#bs-{{$item->id}}">
                                            <i class=" mdi mdi-eye"></i>
                                        </button>
                                        <div class="modal fade" id="bs-{{$item->id}}" tabindex="-1" role="dialog"
                                             aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header d-flex align-items-center">
                                                        <h4 class="modal-title" id="my-{{$item->id}}">{{$item->name}}</h4>
                                                        <button type="button" class="close ml-auto" data-dismiss="modal"
                                                                aria-hidden="true">×
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>{{$item->message}}</p>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div>
                                    </td>
                                    <td>{{date('d.m.Y', strtotime($item->created_at))}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Имя</th>
                                <th>Телефон</th>
                                <th>E-mail</th>
                                <th>Сообщение</th>
                                <th>Создано</th>
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
    <link href="
                                        /libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
@endpush
@push('js')
    <script src="/libs/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="/js/pages/datatable/custom-datatable.js"></script>
    <script>
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
