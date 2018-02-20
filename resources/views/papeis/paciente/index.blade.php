@extends('layouts.app')

@section('title')
    {{ucfirst(str_replace(['-', '_'], ' ', $tipo))}}
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    {{ ucwords(str_replace(['-', '_'], ' ', $tipo)) }}
                    <a href="{{ route($tipo.'.create') }}" class="btn btn-xs btn-primary pull-right">
                        Adicionar {{ str_replace(['-', '_'], ' ', $tipo) }}
                    </a>
                </div>

                @if(count($vinculos))
                    <div class="box-body">
                        <table id="tabela" class="table table-bordered table-striped dataTable" style="width: 100%;">
                            <thead>
                            <tr>
                                <th class="col-md-2">Registro</th>
                                <th class="col-md-6">Nome</th>
                                <th class="col-md-2">Plano de Saude</th>
                                <th class="col-md-2">Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($vinculos as $vinculo)
                                <tr>
                                    <td>{{ $vinculo->paciente->registro }}</td>
                                    <td>{{ $vinculo->paciente->perfil->usuario->name }}</td>
                                    <td>{{ $vinculo->planoSaude->nome }}</td>
                                    <td style="text-align: center">
                                        <div class="btn-group-vertical" style="min-width: 50px; max-width: 80%">
                                            <a style="border-radius: 0" href="{{ route('pacientes.edit', $vinculo->id) }}"
                                               class="btn btn-xs btn-warning">Editar</a>
                                            <form action="{{ route('pacientes.destroy', $vinculo->id) }}"
                                                  class="btn-group" style="margin-top: 10px;" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-xs btn-danger"
                                                        onclick="return confirm('Você tem certeza que deseja excluir esse plano?');">
                                                    Excluir
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="box-body">
                        Não há registros disponíveis.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@push('stylesheets')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" as="style">
@endpush

@push('scripts')
    <script type="text/javascript" charset="utf8"
            src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" charset="utf8"
            src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset ("bower_components/jquery-slimscroll/jquery.slimscroll.min.js") }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#tabela').DataTable({
                responsive: true,
                "bLengthChange": false,
                "language": {
                    url: "//cdn.datatables.net/plug-ins/1.10.13/i18n/Portuguese-Brasil.json"
                },
                "aoColumnDefs": [
                    {'bSortable': false, 'aTargets': [1]}
                ],
                "drawCallback": function (settings) {
                    var pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
                    pagination.toggle(this.api().page.info().pages > 1);
                }
            });
        });
    </script>
@endpush