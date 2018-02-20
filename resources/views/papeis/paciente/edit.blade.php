@extends('layouts.app')

@section('title')
    Editar paciente
@endsection

@push('stylesheets')
    <link href="{{ asset('bower_components/select2/dist/css/select2.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}"
          rel="stylesheet">
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form id="form" action="{{ route('pacientes.update', $vinculo->id) }}" method="post"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="box">
                    <div class="box-header">Identificação</div>
                    <div class="box-body">
                        <div class="row">
                            <div class="required col-md-6 form-group{{ $errors->has('registro') ? ' has-error' : '' }}">
                                <label for="registro">Registro</label>
                                <input type="number" id="registro" name="registro" value="{{ $vinculo->paciente->registro }}"
                                       class="form-control" disabled>

                                @if ($errors->has('registro'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('registro') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="required col-md-6 form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                                <label for="nome">Nome</label>
                                <input type="text" id="nome" name="nome" value="{{ $vinculo->paciente->perfil->usuario->name }}"
                                       class="form-control">

                                @if ($errors->has('nome'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nome') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="required col-md-4 form-group{{ $errors->has('plano_saude_id') ? ' has-error' : '' }}">
                                <label for="plano_saude_id">Plano de Saude</label>
                                <select id="plano_saude_id" class="form-control select2" name="plano_saude_id"
                                        width="100%">
                                    <option selected value="{{ $vinculo->planoSaude->id }}">{{ $vinculo->planoSaude->nome }} </option>
                                </select>

                                @if ($errors->has('plano_saude_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('plano_saude_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="required col-md-4 form-group{{ $errors->has('admissao') ? ' has-error' : '' }}">
                                <label>Admissão:</label>

                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="admissao" name="admissao" value="{{ date_format(date_create($vinculo->admissao), 'd/m/Y') }}">
                                </div>
                                @if ($errors->has('admissao'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('admissao') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="required col-md-4 form-group{{ $errors->has('local_id') ? ' has-error' : '' }}">
                                <label for="local_id">Local do exame</label>
                                <select id="local_id" class="form-control select2" name="local_id" width="100%">
                                    <option selected value="{{ $vinculo->local->id }}">{{ $vinculo->local->nome }} </option>
                                </select>

                                @if ($errors->has('local_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('local_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="required col-md-4 form-group{{ $errors->has('quant_mot') ? ' has-error' : '' }}">
                                <label for="quant_mot">Quantidade de Motoras</label>
                                <input id="quant_mot" class="form-control select2" name="quant_mot" type="number"
                                       value="{{ $vinculo->quant_mot }}">

                                @if ($errors->has('quant_mot'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('quant_mot') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="required col-md-4 form-group{{ $errors->has('quant_resp') ? ' has-error' : '' }}">
                                <label for="quant_resp">Quantidade de respiratórias</label>
                                <input id="quant_resp" class="form-control select2" name="quant_resp" type="number"
                                       value="{{ $vinculo->quant_resp }}">

                                @if ($errors->has('quant_resp'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('quant_resp') }}</strong>
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

@push('scripts')
    <script src="{{ asset('bower_components/select2/dist/js/select2.full.js') }}"></script>
    <script src="{{ asset('bower_components/select2/dist/js/i18n/pt-BR.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.pt-BR.min.js') }}"></script>
    <script>
        $('#admissao').datepicker({
            autoclose: true,
            format: 'dd/mm/yyyy',
            language: 'pt-BR',
        })
    </script>
    <script>
        $(document).ready(function () {
            $("#plano_saude_id").select2({
                containerCssClass: 'wrap',
                placeholder: 'Selecione uma opção',
                ajax: {
                    dataType: 'json',
                    url: "{{ route('api.planos_saude') }}",
                    delay: 400,
                    data: function (params) {
                        return {
                            q: params.term,
                            page: params.page
                        };
                    },
                    results: function (data, page) {
                        return {
                            results: data
                        };
                    },
                }
            });
        });

        $(document).ready(function () {
            $("#local_id").select2({
                containerCssClass: 'wrap',
                placeholder: 'Selecione uma opção',
                ajax: {
                    dataType: 'json',
                    url: "{{ route('api.locais') }}",
                    delay: 400,
                    data: function (params) {
                        return {
                            q: params.term,
                            page: params.page
                        };
                    },
                    results: function (data, page) {
                        return {
                            results: data
                        };
                    },
                }
            });
        });
    </script>
@endpush
