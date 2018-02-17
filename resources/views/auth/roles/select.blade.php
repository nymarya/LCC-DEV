@extends('layouts.base')

<body class="login-page bg-indigo">
<div class="login-box">
    <div class="logo">
        <a href="javascript:void(0);">Fisio<b>CENTRO</b></a>
    </div>
    @if($errors)
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    @endif
    <div class="card">
        <div class="body">
                <div class="msg">
                    Selecionar perfil
                </div>
                <div class="input-group">
                    @forelse($ativos as $perfil)
                        <form role="form" method="POST" action="{{ route('perfis:trocar') }}">
                            {{ csrf_field() }}

                            <input type="hidden" name="perfil_id" value="{{ $perfil->id }}">

                            <button type="submit" style="white-space: normal" class="btn btn-warning btn-flat btn-block no-margin-bottom">
                                    {{ $perfil->papel->verbose }}
                                    @if($perfil->papel->hospital_id)
                                        ({{ $perfil->papel->hospital->sigla }})
                                    @endif
                            </button>
                        </form>
                    @empty
                        <p class="text-center">
                            Não há perfis disponíveis.
                        </p>

                        <form class="text-center" action="{{ route('logout') }}" method="post">
                            {{ csrf_field() }}
                            <button class="btn btn-default btn-flat">Sair</button>
                        </form>
                    @endforelse

                </div>
        </div>
    </div>
</div>
