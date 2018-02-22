@extends('layouts.app')

@section('title')
    Turma
@endsection

@section('header')
    @parent

    @include('partials.breadcrumbs', [
       'items' => [
        "Turmas" => route('turmas.index'),
        $turma->codigo => route('turmas.index', $turma->id),
       ],
   ])
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    Informações sobre a turma

                </div>
                <table class="table">
                    <tr>
                        <th class="col-md-2">Código</th>
                        <td>{{ $turma->codigo }}</td>
                    </tr>

                </table>
            </div>

            <div class="box">
                <div class="box-header">
                    Alunos
                </div>
                <table class="table">
                    <tr>
                        <th>Matrícula</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th class="col-md-2">Opções</th>
                    </tr>
                    @if($alunos)
                        @foreach($alunos as $aluno)
                            <tr>
                                <td>{{ $aluno->perfil->usuario->nome }}</td>
                                <td>{{ $aluno->perfil->usuario->email }}</td>
                                <td>
                                    <a href="{{ route('alunos.show', $aluno->perfil->id) }}"  class="btn btn-xs btn-primary">Ver</a>
                                    @if($aluno->turma->curso->nivel_escolaridade->id == 1 || $aluno->turma->curso->nivel_escolaridade->id == 2 || $aluno->turma->curso->nivel_escolaridade->id == 4)
                                        <a class="btn btn-xs btn-warning" href="{{route('alunos.gerarRelatorioMatricula', $aluno)}}">Requerimento de matrícula</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </table>
                <div class="box-footer">
                    <a href="{{ route('turmas.index') }}" class="btn btn-xs btn-primary pull-right">
                        Voltar
                    </a>
                </div>
            </div>
        </div>
    </div>&nbsp;
@endsection