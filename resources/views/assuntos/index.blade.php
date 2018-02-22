@extends('layouts.app')

@section('title')
    Turmas ingressantes
@endsection

@section('header')
    @parent

    @include('partials.breadcrumbs', [
       'items' => [
        "Assuntos" => route('assuntos.index'),
       ],
   ])
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    Turma
                        <a href="{{ route('assuntos.create') }}" class="btn btn-xs btn-primary pull-right">
                            Cadastrar assunto
                        </a>
                </div>
                @if(count($assuntos))
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped" style="width: 100%;">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th class="col-md-2">Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($assuntos as $assunto)
                                <tr>
                                    <td>{{ $assunto->assunto }}</td>
                                    <td style="text-align: center">
                                        <div class="btn-group-vertical" style="min-width: 50px; max-width: 80%">
                                            <form action="{{ route('assuntos.destroy', $assunto->id) }}"
                                                  class="btn-group" style="margin-top: 10px;" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-xs btn-danger"
                                                        onclick="return confirm('Você tem certeza que deseja excluir esse assunto?');">
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
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
@endpush
