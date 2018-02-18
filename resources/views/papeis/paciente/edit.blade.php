@extends('layouts.app')

@section('title')
    Editar paciente
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form id="form" action="{{ route('pacientes.update', $paciente->id) }}" method="post"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="box">
                    <div class="box-header">Identificação</div>
                    <div class="box-body">
                        <div class="row">
                            <div class="required col-md-6 form-group{{ $errors->has('registro') ? ' has-error' : '' }}">
                                <label for="registro">Registro</label>
                                <input type="number" id="registro" name="registro" value="{{ $paciente->registro }}"
                                       class="form-control" disabled>

                                @if ($errors->has('registro'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('registro') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="required col-md-6 form-group{{ $errors->has('plano_saude_id') ? ' has-error' : '' }}">
                                <label for="plano_saude_id">Plano de Saude</label>
                                <input type="text" class="form-control" name="plano_saude_id">

                                @if ($errors->has('plano_saude_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('plano_saude_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button href="#" type="submit" class="btn btn-primary">Editar</button>
                        <a href="{{ route('pacientes.index') }}" class="btn btn-danger pull-right"
                           onclick="return confirm('Tem certeza que deseja cancelar a edição do paciente?');">
                            Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
