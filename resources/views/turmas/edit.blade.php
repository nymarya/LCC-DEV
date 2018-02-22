@extends('layouts.app')

@section('title')
    Editar turma ingressante
@endsection

@section('header')
    @parent

    @include('partials.breadcrumbs', [
       'items' => [
        "Turmas" => route('turmas.index'),
        "Editar turma ingressante"=> route('turmas.edit', $turma->id),
       ],
   ])
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('turmas.update', $turma->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="box">
                    <div class="box-header">
                        Dados
                    </div>

                    <div class="box-body">
                        <div class="required form-group {{ $errors->has('codigo') ? ' has-error' : '' }}">
                            <label for="codigo">Código da Turma</label>
                            <input type="text" id="codigo" name="codigo" value="{{ $turma->codigo }}" maxlength="255"
                                   class="form-control">
                            @if ($errors->has('codigo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('codigo') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="required form-group{{ $errors->has('curso_id') ? ' has-error' : '' }}">
                            <label for="curso_id">Curso</label>
                            <select name="curso_id" id="curso_id" class="form-control select2" disabled>
                                <option value="{{$turma->curso->id}}">{{$turma->curso->nome}} </option>
                            </select>

                            @if ($errors->has('curso_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('curso_id') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="required form-group{{ $errors->has('municipio') ? ' has-error' : '' }}">
                            <label for="municipio">Município Sede</label>
                            <select name="municipio" id="municipio" class="form-control select2" disabled>
                                <option value="{{ $turma->municipio->id }}">{{ $turma->municipio->nome }}</option>
                            </select>
                        </div>

                        <div class="required form-group">
                            <label for="municipios_extras">Há mais de um município envolvido na oferta?</label>
                            <select class="form-control" id="municipios_extras">
                                @if(count(old('municipios', $turma->municipios)))
                                    <option value="0">Não</option>
                                    <option value="1" selected>Sim</option>
                                @else
                                    <option value="0" selected>Não</option>
                                    <option value="1">Sim</option>
                                @endif
                            </select>
                        </div>

                        <div class="required form-group{{ $errors->has('municipios.*') ? ' has-error' : '' }} hidden" id="municipios-container">
                            <label for="municipios">Municípios envolvidos na oferta</label>
                            <select name="municipios[]" id="municipios" class="form-control" multiple>
                                @foreach($turma->municipios as $municipio)
                                    <option value="{{ $municipio->id }}" selected>{{ $municipio->nome }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('municipios.*'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('municipios.*') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="required form-group{{ $errors->has('matriz_id') ? ' has-error' : '' }}">
                            <label for="matriz_id">Matriz Curricular</label>
                            <select name="matriz_id" id="matriz_id" class="form-control select2" disabled>
                                <option value="{{$turma->matrizCurricular->id}}">{{$turma->matrizCurricular->codigo}}</option>
                            </select>

                            @if ($errors->has('matriz_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('matriz_id') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="required form-group{{ $errors->has('vagas') ? ' has-error' : '' }}">
                            <label for="vagas">Vagas</label>
                            <input type="number" id="vagas" name="vagas" value="{{ old('vagas', $turma->vagas) }}"
                                   class="form-control">

                            @if ($errors->has('vagas'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('vagas') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="required form-group{{ $errors->has('custo_estimado_aluno') ? ' has-error' : '' }}">
                            <label for="custo_estimado_aluno">Custo estimado por aluno</label>
                            <input type="number" id="custo_estimado_aluno" name="custo_estimado_aluno" value="{{ old('custo_estimado_aluno', $turma->custo_estimado_aluno) }}"
                                   class="form-control">

                            @if ($errors->has('custo_estimado_aluno'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('custo_estimado_aluno') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="required form-group{{ $errors->has('instrumento_vinculacao_id') ? ' has-error' : '' }}">
                            <label for="instrumento_vinculacao_id">Instrumento de vinculação</label>
                            <select name="instrumento_vinculacao_id" id="instrumento_vinculacao_id" class="form-control select2">
                                <option value="">Selecione uma opção</option>
                                @if( $turma->instrumento_vinculacao_id) <option value="{{$turma->instrumento_vinculacao_id}}" selected> {{$turma->instrumento_vinculacao->numero . '/' . $turma->instrumento_vinculacao->ano}}</option> @endif>
                            </select>

                            @if ($errors->has('instrumento_vinculacao_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('instrumento_vinculacao_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class=" form-group{{ $errors->has('possui_edital') ? ' has-error' : '' }}">
                            <div class="required">
                                <label>Possui edital vinculado?</label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="possui_edital" id="opt_sim" value="1" {{ (old('possui_edital') == 1 || $turma->edital_id) ? ' checked' : '' }}>
                                    Sim
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="possui_edital" id="opt_nao" value="0" {{ (old('possui_edital') == 1 || !$turma->edital_id) ? ' checked' : '' }}>
                                    Não
                                </label>
                            </div>

                            @if ($errors->has('possui_edital'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('possui_edital') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div id="div_edital" class="required @if(!$turma->edital_id) hidden @endif form-group{{ $errors->has('edital_id') ? ' has-error' : '' }}">
                            <label for="edital_id">Edital</label>
                            <select id="edital_id" name="edital_id" class="select2 form-control" @if(!$turma->edital_id) disabled @endif>
                                <option value="">Selecione uma opção</option>
                                @if($turma->edital_id) <option value="{{$turma->edital_id}}" selected> {{$turma->edital->titulo}}</option> @endif>
                            </select>
                        </div>

                        <div class="required form-group{{ $errors->has('publico_alvo') ? ' has-error' : '' }}">
                            <label for="publico_alvo">Público-alvo</label>
                            <select class="multiple-select form-control" name="publico_alvo[]" id="publico_alvo" multiple="multiple">
                                @foreach ($turma->publico_alvo as $publico)
                                    <option value="{{ $publico }}" selected>{{ $publico }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('publico_alvo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('publico_alvo') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="required form-group{{ $errors->has('calendario_id') ? ' has-error' : '' }}">
                            <label for="calendario_id">Calendario de turmas ingressantes</label>
                            <select name="calendario_id" id="calendario_id" class="form-control select2">
                                @foreach ($calendarioTurmaIngressante as $calendario)
                                    <option value="{{ $calendario->id }}"{{ old('calendario_id', $turma->calendario_id) == $calendario->id ? ' selected' : '' }}>{!! $calendario->descricao !!}</option>
                                @endforeach"
                                            </select>

                                            @if ($errors->has('calendario_id'))
                                            <span class="help-block">
                                    <strong>{{ $errors->first('calendario_id') }}</strong>
                                    </span>
                            @endif
                        </div>

                    </div>


                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                        <a href="{{ route('turmas.index') }}" class="btn btn-danger pull-right"
                           onclick="return confirm('Tem certeza que deseja cancelar a edição de oferta de turma?');">
                            Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>&nbsp;
@endsection

@push('scripts')
<script>
    $(function () {
        $('.select2').select2({
            language: 'pt-BR',
            placeholder: 'Selecione uma opção'
        });

        $("#publico_alvo").select2({
            tags: true,
            tokenSeparators: [',', ' ', ';']
        });

        $('#opt_sim').on('click', function (){
            $('#edital_id').removeAttr('disabled');
            $('#div_edital').removeClass('hidden');
        });
        $('#opt_nao').on('click', function (){
            $('#div_edital').addClass('hidden');
            $('#edital_id').prop('disabled', true);
        });

        $("#edital_id").select2({
            language: 'pt-BR',
            placeholder: 'Selecione uma opção',
            ajax: {
                url: "{{ route('editais.select') }}",
                dataType: "json",
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term,
                        page: params.page
                    };
                }
            },
            width: "100%"
        });

        $("#instrumento_vinculacao_id").select2({
            language: 'pt-BR',
            placeholder: 'Selecione uma opção',
            ajax: {
                url: "{{ route('instrumentos_vinculacoes.select') }}",
                dataType: "json",
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term,
                        page: params.page
                    };
                }
            },
            width: "100%"
        });

        $('#municipios_extras').on('change', function () {
            $('#municipios-container').toggleClass('hidden', $(this).val() === '0');
            $('#municipios').prop('disabled', $(this).val() === '0');
        }).trigger('change');

        $('#municipios').select2({
            language: 'pt-BR',
            placeholder: 'Selecione uma opção',
            width: '100%',
            ajax: {
                url: "{{ route('instituicaoMunicipios.json') }}",
                dataType: "json",
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term,
                        page: params.page
                    };
                }
            }
        });
    });
</script>
@endpush
