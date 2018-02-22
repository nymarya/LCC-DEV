@extends('layouts.diarios.base')

@section('title')
    Editar enquete
@endsection

@section('header')
    @parent

    @include('partials.breadcrumbs', [
       'items' => [
        "Enquetes" => route('questoes.index', $questao->id),
        "Editar questao" => route('questoes.edit', [$diario->id, $questao->id]),
       ],
   ])
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form id="form" action="{{ route('questoes.update', $questao->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="box">
                    <div class="box-header">
                        Informações
                    </div>

                    <div class="box-body">
                        <div class="required form-group{{ $errors->has('questao') ? ' has-error' : '' }}">
                            <label for="questao">Texto</label>
                            <input type="text" id="questao" name="questao" value="{{ old('questao', $questao->questao) }}" maxlength="255"
                                   class="form-control">

                            @if ($errors->has('questao'))
                                <span class="help-block">
                                <strong>{{ $errors->first('questao') }}</strong>
                            </span>
                            @endif
                        </div>


                    <form-set :errors="{{ json_encode($errors->get('alternativas.*')) }}" :old="{{ json_encode(old('alternativas', $enquete->alternativas)) }}" name="alternativas">
                        <template scope="props">
                            <div class="box-header">
                                Alternativas
                            </div>
                            <table class="table no-margin">
                                <tbody>
                                <tr v-for="(item, index) in props.data">
                                    <td class="required col-md-12 form-group" :class="{'has-error': ('alternativas.' + index + '.texto') in props.errors}">
                                        <input type="text" class="form-control" v-model="item.texto">

                                        <span class="help-block" v-for="error in props.errors['alternativas.' + index + '.texto']">
                                            <strong>@{{ error }}</strong>
                                        </span>
                                    </td>

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
                                        <input type="text" id="alternativa" class="form-control" v-model="props.current.texto" @keydown.enter.prevent="props.add">

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

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                        <a href="{{ route('questoes.index', $questao->id) }}" class="btn btn-danger pull-right"
                           onclick="return confirm('Tem certeza que deseja cancelar a edição de enquete?');">
                            Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    &nbsp;
@endsection

