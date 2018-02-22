@extends('layouts.app')

@section('title')
    Responder prova
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="#" method="post">
                {{ csrf_field() }}
                <div class="box">
                    <div class="box-header">
                        Informações
                    </div>

                    <div class="box-body">
                        @foreach($questoes as $questao)
                        <div class="form-group">
                            <label>{{$questao->questao}}</label>
                            <div class="radio">
                                <label>

                                @foreach($questao->alternativas as $alternativa)
                                    <input type="radio"  id="{{'option'.$alternativa->id}}" name="{{'name'.$questao->id}}" value="{{'option'.$alternativa->id}}" >
                                        {{$alternativa->alternativa}}<br>
                                @endforeach
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Criar</button>
                        <a href="#" class="btn btn-danger pull-right"
                           onclick="return confirm('Tem certeza que deseja cancelar a realização da prova?');">
                            Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>&nbsp;
@endsection
