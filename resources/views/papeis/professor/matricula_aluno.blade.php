@extends('layouts.app')
@section('title')
    Matrícula de aluno em turma
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form id="form" action="{{ route('matricular_aluno', $aluno->id) }}" method="post"
                  enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="box">
                    <div class="box-header">Matrícula aluno</div>
                    <div class="box-body">
                        <div class="row" id="identificacao">
                            <div class="box-header">Turma ingressante</div>
                            <div class="box-body">
                                <div class="required form-group{{ $errors->has('turma_id') ? ' has-error' : '' }}">
                                    <label for="turma_id">Turma</label>
                                    <select class="form-control" name="turma_id">
                                        <option value="" {{ ! old('turma_id') ? ' selected' : '' }}>Selecione uma
                                            opção
                                        </option>
                                        @foreach($turmas as $turma)
                                            <option value="{{$turma->id}}">{{$turma->codigo}}
                                            </option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('turma_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('turma_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Criar</button>
                        <a href="{{ route('alunosmatricula') }}" class="btn btn-danger pull-right"
                           onclick="return confirm('Tem certeza que deseja cancelar a matrícula do aluno?');">
                            Cancelar
                        </a>
                    </div>
                    <div class="overlay" hidden>
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>
            </form>
        </div>
    </div>&nbsp;
@endsection
