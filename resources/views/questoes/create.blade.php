@extends('layouts.app')

@section('title')
    Cadastrar questão
@endsection
@push('stylesheets')
    <link rel="stylesheet" href="{{asset('dist/css/avatar.css')}}">
@endpush

@section('header')
    @parent

    @include('partials.breadcrumbs', [
       'items' => [
        ucfirst(str_replace(['-', '_'], ' ', explode(".", Route::currentRouteName())[0])) => route(explode(".", Route::currentRouteName())[0] . '.index'),
        'Cadastrar questões' => route(Route::currentRouteName()),
       ],
   ])
@endsection
{{$errors}}
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form id="form" action="{{ route('questoes.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="box">
                    <div class="box-body">
                        <div class="form-group{{ $errors->has('arquivo') ? ' has-error' : '' }}">
                            <label for="arquivo">Arquivo</label>
                            <input type="file" id="arquivo" name="arquivo" class="form-control">

                            @if ($errors->has('arquivo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('arquivo') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="required form-group{{ $errors->has('assunto_id') ? ' has-error' : '' }}">
                            <label for="assunto_id">Assunto</label>
                            <select class="form-control" name="assunto_id">
                                <option value="" {{ ! old('assunto_id') ? ' selected' : '' }}>Selecione uma
                                    opção
                                </option>
                                @foreach($assuntos as $assunto)
                                    <option value="{{$assunto->id}}">{{$assunto->assunto}}
                                    </option>
                                @endforeach
                            </select>

                            @if ($errors->has('assunto_id'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('assunto_id') }}</strong>
                                        </span>
                            @endif
                        </div>
                        <div class="required form-group{{ $errors->has('questao') ? ' has-error' : '' }}">
                            <div>
                                <label for="questao" style="margin-left: 10px">Questão</label>
                                <input style="margin-left: 5px" type="text" id="questao" name="questao" value="{{ old('questao') }}" maxlength="255" class="form-control" required>

                                @if ($errors->has('questao'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('questao') }}</strong>
                                    </span>
                                @endif
                             </div>
                            <form-set :errors="{{ json_encode($errors->get('alternativas.*')) }}"
                                      :old="{{ json_encode(old('alternativas')) }}"
                                      :skeleton="{'correta': ''}"
                                      name="alternativas">
                                <template scope="props">
                                    <div class="box-header">
                                        <label for="questao">Alternativas</label>
                                    </div>

                                    <table class="table no-margin">
                                        <tbody>
                                        <tr v-for="(item, index) in props.data">
                                            <td class="required col-md-12 form-group" :class="{'has-error': ('alternativas.' + index + '.alternativa') in props.errors}">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                      <input type="checkbox" v-model="item.correta">
                                                    </span>
                                                    <input type="text" class="form-control " v-model="item.alternativa">
                                                </div>
                                                <span class="help-block" v-for="error in props.errors['alternativas.' + index + '.alternativa']">
                                                <span class="help-block" v-for="error in props.errors['alternativas.' + index + '.correta']">
                                            <strong>@{{ error }}</strong>
                                        </span>

                                            <td>
                                                <button type="button" class="btn btn-danger pull-right" @click="props.remove(index)">Remover</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="box-header">
                                        Nova alternativa
                                    </div>
                                    <table class="table no-margin">
                                        <tbody>
                                        <tr>
                                            <td class="required col-md-12 form-group{{ $errors->has('alternativas') ? ' has-error' : '' }}">
                                                <label for="alternativa" class="control-label">Texto</label>
                                                <input type="text" id="alternativa" class="form-control" v-model="props.current.alternativa" @keydown.enter.prevent="props.add">

                                                @if ($errors->has('alternativas'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('alternativas') }}</strong>
                                            </span>
                                                @endif
                                            </td>

                                            <td style="vertical-align: bottom">
                                                <button type="button" @click="props.add" class="btn btn-primary">Adicionar</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </template>
                            </form-set>
                        </div>

                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Criar</button>
                        <a href="{{ route('professores.index') }}" class="btn btn-danger pull-right"
                           onclick="return confirm('Tem certeza que deseja cancelar a criação do usuario?');">
                            Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>&nbsp;
@endsection

@push('scripts')
<script src="{{ asset('app.js') }}"></script>
<script src="{{ asset('dist/js/inputmask.min.js') }}"></script>
<script>
    $(function () {

        $("#cpf").inputmask({mask: '999.999.999-99', removeMaskOnSubmit: true});

        $('#form').on('submit', function () {
            $('select[disabled]').prop('disabled', false);
        });
    });
</script>

@yield('script')
@endpush
