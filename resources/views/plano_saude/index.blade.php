@extends('layouts.app')

@section('title')
    Planos de Saúde
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    Planos de saúde
                    <a href="{{ route('planos.create') }}" class="btn btn-xs btn-primary pull-right">
                        Adicionar plano
                    </a>
                </div>

                @if(count($planos))
                    <div class="box-body">
                        <table id="tabela" class="table table-bordered table-striped dataTable" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th class="col-md-2">Motora - UTI</th>
                            <th class="col-md-2">Motora - APT</th>
                            <th class="col-md-2">Respiratória - UTI</th>
                            <th class="col-md-2">Respiratória - APT</th>
                            <th class="col-md-2">Opções</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($planos as $plano)
                            <tr>
                                <td>{{ $plano->nome }}</td>
                                <td>{{ $plano->motora_UTI }}</td>
                                <td>{{ $plano->motora_APT }}</td>
                                <td>{{ $plano->resp_UTI }}</td>
                                <td>{{ $plano->resp_APT }}</td>
                                <td style="text-align: center">
                                    <div class="btn-group-vertical" style="min-width: 50px; max-width: 80%">
                                    <a style="border-radius: 0" href="{{ route('planos.edit', $plano->id) }}"
                                       class="btn btn-xs btn-warning">Editar</a>
                                    <form action="{{ route('planos.destroy', $plano->id) }}"
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
<link rel="stylesheet" type="text/css" href="/plugins/dataTable/css/dataTables.bootstrap.min.css" as="style">
<link rel="stylesheet" type="text/css" href="/plugins/dataTable/css/responsive.bootstrap.min.css" as="style">
@endpush

@push('scripts')
<script type="text/javascript" charset="utf8" src="/plugins/dataTable/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="/plugins/dataTable/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" charset="utf8" src="/plugins/dataTable/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" charset="utf8" src="/plugins/dataTable/js/responsive.bootstrap.min.js"></script>
<script type="text/javascript" charset="utf8" src="/plugins/dataTable/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="/plugins/dataTable/js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf8" src="/plugins/dataTable/js/jszip.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#tabela').DataTable({
//
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
    } );
</script>
@endpush