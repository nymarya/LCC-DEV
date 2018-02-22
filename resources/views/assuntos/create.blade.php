@extends('layouts.app')

@section('title')
    Cadastrar assunto
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('assuntos.store') }}" method="post">
                {{ csrf_field() }}
                <div class="box">
                    <div class="box-header">
                        Informações
                    </div>

                    <div class="box-body">
                        <div class="required form-group {{ $errors->has('assunto') ? ' has-error' : '' }}">
                            <label for="assunto">Nome</label>
                            <input type="text" id="assunto" name="assunto" value="{{ old('assunto') }}" maxlength="255"
                                   class="form-control">
                            @if ($errors->has('assunto'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('assunto') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Criar</button>
                        <a href="{{ route('assuntos.index') }}" class="btn btn-danger pull-right"
                           onclick="return confirm('Tem certeza que deseja cancelar a criação de assunto?');">
                            Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>&nbsp;
@endsection
