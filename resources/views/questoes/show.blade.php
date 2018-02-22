@extends('layouts.app')

@section('title')
Questão
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <table class="table">
                    <tr>
                        <th>Texto</th>
                        <td>{{$questao->questao}}</td>
                    </tr>
                </table>

                <div class="box-header">
                    Alternativas
                </div>

                <table class="table">
                    <thead>
                    <tr>
                        <th>Texto</th>
                        <th>Correta</th>
                    </tr>
                    </thead>
                    @foreach($questao->alternativas as $alternativa)
                        <tr>
                            <td>{{ $alternativa->alternativa }}</td>
                            <td>
                                @if($alternativa->correta)
                                <i class="fa fa-check-circle"></i>
                                    @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div class="box-footer">
                    <a href="{{ route( 'questoes.index') }}" class="btn btn-xs btn-primary pull-right">
                        Voltar
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection