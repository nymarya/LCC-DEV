@extends('layouts.app')

@section('title')
    Criar usuário
@endsection

@section('header')
    @parent

    @include('partials.breadcrumbs', [
       'items' => [
        ucfirst(str_replace(['-', '_'], ' ', explode(".", Route::currentRouteName())[0])) => route(explode(".", Route::currentRouteName())[0] . '.index'),
        'Criar usuário' => route(Route::currentRouteName()),
       ],
   ])
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form id="form" action="{{ route($rota) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="box">
                    <div class="overlay" hidden></div>
                    <div class="box-header">Identificação</div>
                    <div class="box-body">
                        <div class="row">
                            <div class="required col-md-6 form-group{{ $errors->has('cpf') ? ' has-error' : '' }}">
                                <label for="cpf">CPF</label>
                                <input type="text" id="cpf" name="cpf" value="{{ old('cpf') }}" maxlength="15" class="form-control">

                                @if ($errors->has('cpf'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cpf') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="required col-md-6 form-group{{ $errors->has('rg') ? ' has-error' : '' }}">
                                <label for="rg">Identidade</label>
                                <input type="text" id="rg" name="rg" value="{{ old('rg') }}" maxlength="30" class="form-control">

                                @if ($errors->has('rg'))
                                    <span class="help-block">
                                                <strong>{{ $errors->first('rg') }}</strong>
                                            </span>
                                @endif
                            </div>

                        </div>
                        <div class="row" id="identificacao">
                            <div class="required col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name">Nome</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" maxlength="255" class="form-control" required>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">Email</label>
                                <input type="text" id="email" name="email" value="{{ old('email') }}" class="form-control">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password">Senha</label>
                                <input type="password" id="password" name="password" value="{{ old('password') }}" class="form-control">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                @endif
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="password-confirm">Confirme a senha</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="{{ old('password') }}">
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Criar</button>
                        <a href="{{ route('administradores.index') }}" class="btn btn-danger pull-right"
                           onclick="return confirm('Tem certeza que deseja cancelar a criação do usuario?');">
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

@push('scripts')
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
