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
                            <div class="required col-md-12 form-group{{ $errors->has('cpf') ? ' has-error' : '' }}">
                                <label for="cpf">CPF</label>
                                <input type="text" id="cpf" name="cpf" value="{{ old('cpf') }}" maxlength="15" class="form-control">

                                @if ($errors->has('cpf'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cpf') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>
                        <div class="row hidden" id="identificacao">
                            <div class="required col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name">Nome</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" maxlength="255" class="form-control" required>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="required col-md-12 form-group{{ $errors->has('rg') ? ' has-error' : '' }}">
                                <label for="rg">Identidade</label>
                                <input type="text" id="rg" name="rg" value="{{ old('rg') }}" maxlength="30" class="form-control">

                                @if ($errors->has('rg'))
                                    <span class="help-block">
                                                <strong>{{ $errors->first('rg') }}</strong>
                                            </span>
                                @endif
                            </div>
                            <div class="col-md-12 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">Email</label>
                                <input type="text" id="email" name="email" value="{{ old('email') }}" class="form-control">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="box-footer" style="text-align: center;">
                        <button type="submit" class="btn btn-primary" id="criar" style="float:left">Criar</button>
                        @yield('button')
                        <?php $array = explode('/', url()->previous()); ?>
                        <a href="{{ route(explode('.', $rota)[0].'.index') }}" class="btn btn-danger "
                           onclick="return confirm('Tem certeza que deseja cancelar a criação de usuário?');" style="float:right">
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
<script src="{{ asset('js/vendor/inputmask.min.js') }}"></script>
<script src="{{ asset('plugins/select2/i18n/pt-BR.js') }}"></script>
<script>
    $(function () {

        $(".select2").select2({
            'language': 'pt-BR',
            placeholder: 'Selecione uma opção',
            width: '100%'
        });

        $("#cpf").inputmask({mask: '999.999.999-99', removeMaskOnSubmit: true});

        $('#form').on('submit', function () {
            $('select[disabled]').prop('disabled', false);
        });
    });
</script>

@yield('script')
@endpush
