@extends('layouts.app')

@section('title')
    Cadastrar paciente
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form id="form" action="{{ route($rota) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="box">
                    <div class="box-header">Identificação</div>
                    <div class="box-body">
                        <div class="row">
                            <div class="required col-md-6 form-group{{ $errors->has('registro') ? ' has-error' : '' }}">
                                <label for="registro">Registro</label>
                                <input type="number" id="registro" name="registro" value="{{ old('registro') }}" class="form-control">

                                @if ($errors->has('registro'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('registro') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="required col-md-6 form-group{{ $errors->has('plano_saude_id') ? ' has-error' : '' }}">
                                <label for="plano_saude_id">Plano de Saude</label>
                                <input type="text" class="form-control">

                                @if ($errors->has('plano_saude_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('plano_saude_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button href="#" type="submit" class="btn btn-primary">Cadastrar</button>
                        <a href="{{ route('pacientes.index') }}" class="btn btn-danger pull-right"
                           onclick="return confirm('Tem certeza que deseja cancelar o cadastro do paciente?');">
                            Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
