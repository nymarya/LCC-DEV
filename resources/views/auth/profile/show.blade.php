@extends('layouts.app')

@section('title')
    Perfil
@endsection

@section('header')
    @parent

    @include('partials.breadcrumbs', [
       'items' => [
        "Perfil" => route('perfil')
       ],
   ])
@endsection

@section('content')
    <div class="alert alert-danger alert-dismissible hidden" id="avatar-size-error" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <strong>Aviso!</strong> O tamanho do arquivo não deve exceder 1 MB.
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="box box-default">
                <div class="box-header">
                    <h2 class="box-title">Meu perfil</h2>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-10">
                            <form method="POST" action="{{ route('perfil.avatar') }}" id="avatar-form"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div id="avatar-form-group"
                                     class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                                    <div class="avatar-container">
                                        <div class="avatar-container-content avatar-container-content-circle avatar-container-content-cover"
                                             id="avatar-image"
                                             style="background-image: url({{ asset($user->avatar) }})"></div>
                                        <input type="file" class="hidden" id="avatar" name="avatar">
                                    </div>

                                    @if ($errors->has('avatar'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('avatar') }}</strong>
                                        </span>
                                    @endif

                                    <span class="help-block text-center">
                                        <strong>Tamanho máximo: 1 MB</strong>
                                    </span>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-10 col-md-9 col-xs-8">
                            <div class="col-xs-12">
                                <p class="h4 text-muted no-margin-bottom">Nome</p>
                                <p class="h3 no-margin-top">{{ $user->nome }}</p>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <p class="h4 text-muted no-margin-bottom">CPF</p>
                                <p class="h3 no-margin-top" id="cpf">{{ $user->cpf }}</p>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <p class="h4 text-muted no-margin-bottom">RG</p>
                                <p class="h3 no-margin-top" id="rg"> {{ $user->rg }}</p>
                            </div>

                            <div class="col-md-12 col-lg-8">
                                <p class="h4 text-muted no-margin-bottom">Email</p>
                                <p class="h3 no-margin-top"> {{ $user->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                    <div class="box">
                    <form class="form-horizontal" action="{{ route('senha.alterar') }}" method="POST">
                        <div class="box-header">
                            <h2 class="box-title">Alterar Senha</h2>
                        </div>
                        <div class="box-body">
                            {{csrf_field()}}
                                <div class="col-md-6 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password">Senha</label>
                                    <input type="password" id="password" name="password" value="{{ old('password') }}"
                                           class="form-control">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                    @endif
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="password-confirm">Confirme a senha</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" value="{{ old('password') }}">
                                </div>
                            </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Criar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function () {
            $('#avatar').on('change', function () {
                if ((this.files[0].size / 1024 / 1024) > 1) {
                    $('#avatar-size-error').removeClass('hidden');
                } else {
                    $('#avatar-form').submit();
                }
            });

            $('#avatar-image').on('click', function () {
                $('#avatar').trigger('click');
            });
        });
    </script>
@endpush