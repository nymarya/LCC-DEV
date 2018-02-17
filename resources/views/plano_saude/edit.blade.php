@extends('layouts.app')

@section('title')
    Editar plano de saúde
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('planos.update', $plano->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="box">
                    <div class="box-header">
                        Informações
                    </div>

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12 required form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                                <label for="nome">Nome</label>
                                <input type="text" id="nome" name="nome" value="{{ old('nome', $plano->nome) }}"
                                       maxlength="255" class="form-control">

                                @if ($errors->has('nome'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nome') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="box-header">
                        Fisioterapia Motora
                    </div>

                    <div class="box-body">
                        <div class="row">
                            <div class="required col-md-6 form-group{{ $errors->has('motora_UTI') ? ' has-error' : '' }}">
                                <label for="motora_UTI">UTI</label>
                                <input type="text" id="motora_UTI" name="motora_UTI" value="{{ old('motora_UTI', $plano->motora_UTI) }}"
                                       maxlength="255" class="form-control">

                                @if ($errors->has('motora_UTI'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('motora_UTI') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="required col-md-6 form-group{{ $errors->has('motora_APT') ? ' has-error' : '' }}">
                                <label for="motora_APT">Apartamento</label>
                                <input type="text" id="motora_APT" name="motora_APT" value="{{ old('motora_APT', $plano->motora_APT) }}"
                                       maxlength="255" class="form-control">

                                @if ($errors->has('motora_APT'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('motora_APT') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="box-header">
                        Fisioterapia Respiratória
                    </div>

                    <div class="box-body">
                        <div class="row">
                            <div class="required col-md-6 form-group{{ $errors->has('resp_UTI') ? ' has-error' : '' }}">
                                <label for="resp_UTI">UTI</label>
                                <input type="text" id="resp_UTI" name="resp_UTI" value="{{ old('resp_UTI', $plano->resp_UTI) }}"
                                       maxlength="255" class="form-control">

                                @if ($errors->has('resp_UTI'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('resp_UTI') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="required col-md-6 form-group{{ $errors->has('resp_APT') ? ' has-error' : '' }}">
                                <label for="resp_APT">Apartamento</label>
                                <input type="text" id="resp_APT" name="resp_APT" value="{{ old('resp_APT', $plano->resp_APT) }}"
                                       maxlength="255" class="form-control">

                                @if ($errors->has('resp_APT'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('resp_APT') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Editar</button>
                        <a href="{{ route('planos.index') }}" class="btn btn-danger pull-right"
                           onclick="return confirm('Tem certeza que deseja cancelar a edição de plano de saúde?');">
                            Cancelar
                        </a>
                    </div>
            </form>
        </div>
    </div>    &nbsp;
@endsection
@push('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>

    <script>
        $("#motora_UTI").mask("##0.00", {reverse: true});
        $("#motora_APT").mask("##0.00", {reverse: true});
        $("#resp_UTI").mask("##0.00", {reverse: true});
        $("#resp_APT").mask("##0.00", {reverse: true});
    </script>
@endpush
